<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class PaymentHistoryController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $student_id = $request->query('student_id');

        $payments = Payment::where('student_id', $student_id)->get();

        return $this->responseSuccess('Data Retrieved Successfully!',$payments->toArray());
    }
}
