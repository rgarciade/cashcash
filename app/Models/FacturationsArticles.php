<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturationsArticles extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'facturations_id',
        'creation_date',
        'articleId',
        'description',
        'article_price',
        'units'
    ];
    public function facturations(){
        return $this->belongsTo(Facturations::class);
    }

}
