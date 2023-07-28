<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inbound extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'inbounds';
    protected $fillable = [
        'inbound_number',
        'ata_at',
        'inbound_at',
        'confirmed_at',
        'remark'
    ];

    public function items(){
        return $this->hasMany(InboundItem::class);
    }
}
