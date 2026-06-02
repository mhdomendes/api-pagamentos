<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessPaymentJob; 
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $idempotencyKey = $request->header('Idempotency-Key');

        $payment = Payment::where(
            'idempotency_key',
            $idempotencyKey
        )->first();

        if ($payment) {
            return response()->json($payment);
        }

        $payment = Payment::create([
            'external_id' => Str::uuid(),
            'idempotency_key' => $idempotencyKey,
            'amount' => $request->amount,
            'status' => 'pending'
        ]);

        ProcessPaymentJob::dispatch($payment->id);

        return response()->json($payment, 201);
    }

    public function show(Payment $payment)
    {
        return response()->json($payment);
    }
}