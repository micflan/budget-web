<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Budget extends Model
{
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    protected $fillable = ['key', 'start', 'end', 'cash'];

    protected $dates = ['created_at', 'updated_at', 'start', 'end'];

    protected $casts = [
        'cash' => 'double',
    ];

    public function setKeyAttribute($value)
    {
        $this->attributes['key'] = sha1($value);
    }

    public function getCashAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function setCashAttribute($value)
    {
        $this->attributes['cash'] = Crypt::encrypt($value);
    }
}
