<?php

namespace App\Traits;

trait JsonResponseTrait
{
    /**
     * Make unified Http response success
     * Summary of responseSuccess
     * @param string $message
     * @param array $data
     * @return void
     */
    public function responseSuccess(string $message = '', array $data = null)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data
        ]);
    }

    /**
     * Make unified Http response failure
     * @param string $message
     * @param int $status
     * @return void
     */

    public function responseFailure(string $message = '', int $status)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $status);
    }
}
