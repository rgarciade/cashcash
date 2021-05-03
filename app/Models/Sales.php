<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'paymentType',
        'creation_date',
		'price',
		'vat',
		'paid'
    ];
    public function articles(){
        return $this->hasMany(SalesArticles::class);
    }
    public function salesarticles(){
        return $this->hasMany(SalesArticles::class);
    }
}
