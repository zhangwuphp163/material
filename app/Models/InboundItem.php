<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InboundItem extends Model
{
    use HasFactory;
    protected $table = 'inbound_items';
    protected $fillable = [
        'inbound_id',
        'material_id',
        'plan_qty',
        'actual_qty',
        'unit_price',
        'inbound_at',
        'confirmed_at'
    ];

    public function order(){
        return $this->belongsTo(Inbound::class);
    }
}
