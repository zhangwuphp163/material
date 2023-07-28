<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outbound extends Model
{
    use HasFactory;
    protected $table = 'outbounds';
    protected $fillable = [
        'outbound_number',
        'remark',
        'ata_at',
        'time_consuming',
        'processing_costs',
        'freight',
        'outbound_at'
    ];

    public function items(){
        return $this->hasMany(OutboundItem::class);
    }
}
