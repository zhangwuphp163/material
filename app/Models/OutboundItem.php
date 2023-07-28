<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutboundItem extends Model
{
    use HasFactory;
    protected $table = 'outbound_items';
    protected $fillable = [
        'outbound_id',
        'sku_id',
        'order_qty',
        'actual_qty',
        'outbound_at',
        'unit_price'
    ];

    public function outbound(){
       return $this->belongsTo(Outbound::class);
    }
}
