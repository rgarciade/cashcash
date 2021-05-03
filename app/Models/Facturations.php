<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturations extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'company_id',
        'credit_card',
        'paymentType',
        'creation_date',
		'price',
		'vat',
		'paid'
    ];
    public function company(){
        return $this->belongsTo(Companys::class);
    }
}
