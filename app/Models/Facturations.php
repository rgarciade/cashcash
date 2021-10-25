<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturations extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'company_id',
        'paymentType',
        'creation_date',
        'price',
        'vat',
        'paid'
    ];
    public function company()
    {
        return $this->belongsTo(Companys::class);
    }
    public function articles()
    {
        return $this->hasMany(FacturationsArticles::class);
    }
}
