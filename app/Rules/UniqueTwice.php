<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueTwice implements Rule
{
    protected $table;
    protected $column;
    protected $currentId;

    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @param string $column
     * @param int|null $currentId
     */
    public function __construct($table, $column, $currentId = null)
    {
        $this->table = $table;
        $this->column = $column;
        $this->currentId = $currentId;
    }

    /**
     * Validate the rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$this->currentId) {
            $count = DB::table($this->table)
                ->where($this->column, $value)
                ->count();

            return $count < 2;
        }

        $currentValue = DB::table($this->table)
            ->where('id', $this->currentId)
            ->value($this->column);

        if ($currentValue == $value) {
            return true;
        }

        $count = DB::table($this->table)
            ->where($this->column, $value)
            ->where('id', '!=', $this->currentId)
            ->count();

        return $count < 2;
    }

    /**
     * Get the error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute can only be unique up to two times.';
    }
}
