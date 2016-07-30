<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Expense extends Model
{
    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    protected $fillable = ['date', 'value'];

    protected $dates = ['created_at', 'updated_at', 'date'];

    protected $casts = [
        'value' => 'double',
    ];

    public function getValueAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = Crypt::encrypt($value);
    }
}
