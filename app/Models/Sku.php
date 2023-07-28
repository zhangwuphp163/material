<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;
    protected $table = 'skus';
    protected $fillable = [
        'barcode',
        'name',
        'description'
    ];

    public function items(){
        return $this->hasMany(SkuItem::class);
    }
}
