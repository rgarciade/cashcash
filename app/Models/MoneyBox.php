<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyBox extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'creation_date',
        'money',
		'remove_to_box'
    ];
}
