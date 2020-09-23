<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ExistsId implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $table;


    public function __construct($table, $cols = null, $vals = null)
    {
        $this->table = $table;
        $this->cols = $cols;
        $this->vals = $vals;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $query = DB::table($this->table)->where('id', $value)->where('deleted_at', null);
        $this->cols != null and $this->vals != null ? $query->where($this->cols, $this->vals) : '';
        $result = !empty($query->first()) ? true : false;
        return $result;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The id is not exist.';
    }
}
