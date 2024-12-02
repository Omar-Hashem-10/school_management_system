<?php

namespace App\Http\Controllers;

use App\Events\EducationPaymentEvent;
use App\Models\Payment;
use App\Models\Student;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    public function payment($student_id, $term_id)
    {
        $student = Student::findOrFail($student_id);

        $totalAmount = $student->classRoom->level->amount /2;

        $data = [];
        $data['items'] = [
            [
                'name' => "Student Fees - Term {$term_id}",
                'price' => $totalAmount,
                'desc' => "Fees for the student for term {$term_id}",
                'qty' => 1
            ]
        ];

        $data['invoice_id'] = "{$student_id}_term_{$term_id}";
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('dashboard.guardian.payment.success', ['student_id' => $student_id, 'term_id' => $term_id]);
        $data['cancel_url'] = route('dashboard.guardian.payment.cancel', ['student_id' => $student_id, 'term_id' => $term_id]);
        $data['total'] = $totalAmount;

        $provider = new ExpressCheckout;

        $response = $provider->setExpressCheckout($data);

        return redirect($response['paypal_link']);
    }


    public function cancel($student_id, $term_id)
    {
        return redirect()->route('dashboard.guardian.payment-history.show', ['student_id' => $student_id])->with('error', 'Payment Cancelled');
    }

    public function success(Request $request, $student_id, $term_id)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $student = Student::findOrFail($student_id);
            $term = AcademicYear::findOrFail($term_id);

            // Create payment record
            $payment = Payment::create([
                'student_id' => $student_id,
                'guardian_id' => auth()->user()->guardian->id,
                'academic_year_id' => $term->id,
                'level_id' => $student->classRoom->level_id,
                'term_id' => $term_id,
                'total' => $response['AMT'],
            ]);

            // Prepare email data
            $data = [
                'guardianName' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
                'paymentDate' => $payment->created_at->format('Y-m-d H:i:s'),
                'amountPaid' => 'EGY' . number_format($response['AMT'], 2),
                'semester' => $term->semester,
                'academicYear' => $term->year,
                'studentAcademicYear' => $student->classRoom->level->name,
            ];

            // Get guardian's email
            $email = auth()->user()->email;

            // Dispatch payment event
            event(new EducationPaymentEvent($data, $email));

            // Save student ID in session
            session()->put('student_id', $student->id);

            return redirect()
                ->route('dashboard.guardian.payment-history.show', ['student' => session('student_id')])
                ->with('success', 'Payment Successful');
        }

        return redirect()
            ->route('dashboard.guardian.payment-history.show', ['student_id' => session('student_id')])
            ->with('error', 'Payment Failed');
    }


}
