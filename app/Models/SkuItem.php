<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkuItem extends Model
{
    use HasFactory;
    protected $table = 'sku_items';
    protected $fillable = [
        'sku_id',
        'material_id',
        'qty'
    ];

    public function sku(){
        return $this->belongsTo(Sku::class,'sku_id','id');
    }
}
