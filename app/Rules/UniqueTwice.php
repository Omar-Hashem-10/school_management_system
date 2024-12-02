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
        $this->currentId = $currentId; // ID of the current record
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
        // إذا لم يتم تمرير المعرف الحالي، افترض أن القاعدة ستعمل للإضافة
        if (!$this->currentId) {
            $count = DB::table($this->table)
                ->where($this->column, $value)
                ->count();

            return $count < 2; // السماح بتكرار القيمة مرتين فقط
        }

        // تحقق من القيمة الحالية للسجل
        $currentValue = DB::table($this->table)
            ->where('id', $this->currentId)
            ->value($this->column);

        // السماح إذا لم تتغير القيمة
        if ($currentValue == $value) {
            return true;  // السماح بتحديث القيمة الحالية إذا كانت نفس القيمة
        }

        // التحقق من عدد التكرارات مع تجاهل السجل الحالي
        $count = DB::table($this->table)
            ->where($this->column, $value)
            ->where('id', '!=', $this->currentId)
            ->count();

        return $count < 2; // السماح بتكرار القيمة مرتين فقط
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
