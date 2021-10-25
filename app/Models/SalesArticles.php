<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesArticles extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'sales_id',
        'creation_date',
        'articleId',
        'description',
        'article_price',
        'units'
    ];
    public function sales()
    {
        return $this->belongsTo(Sales::class);
    }
}
