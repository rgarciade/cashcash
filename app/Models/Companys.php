<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companys extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'cif',
        'name',
        'contact',
        'location',
        'telephone',
        'email',
        'street',
        'city',
        'province',
        'cta',
        'state',
        'postalcode',
        'banck',
        'mobile',
        'notas'
    ];
    public function contacts()
    {
        return $this->hasMany(Contacts::class);
    }
}
