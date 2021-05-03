<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturationsArticles extends Model
{
    use HasFactory;

    protected $fillable = [
        'facturation_id',
        'creation_date',
        'articleId',
        'description',
        'article_price',
        'units'
    ];
    public function facturation(){
        return $this->belongsTo(Facturations::class);
    }

}
