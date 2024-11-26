<?php


namespace App\Traits;

trait HelperFunctionsTrait
{
    /**
     * Redirect back with an error message if the condition is met.
     *
     * @param mixed $condition
     * @param string $message
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function getError($condition, $message)
    {
        if ($condition) {
            return redirect()->back()->with('error', $message);
        }

        return null;
    }
    public function redirectWithError($route, $message)
    {
        return redirect()->route($route)->with('error', $message);
    }

}

