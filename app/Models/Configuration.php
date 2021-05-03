<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $table = 'configuration';
    protected $fillable = [
        'vat',
        'banknumber',
        'mail',
        'mailpassword',
        'mailhost',
        'mailport',
        'secure',
        'tls',
        'mailimg',
        'tiketsprinter',
        'facturationprinter'
    ];
}
