<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'companys_id',
        'email',
        'name',
        'location',
        'telephone',
        'facturacion'
    ];
    public function company()
    {
        return $this->belongsTo(Companys::class);
    }
}
