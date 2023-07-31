<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Inventory extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use DefaultDatetimeFormat;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'inventories';
    protected $fillable = [
        'material_id',
        'inbound_id',
        'inbound_item_id',
        'outbound_id',
        'outbound_item_id',
        'qty',
        'unit_price',
        'inbound_at',
        'outbound_at'
    ];

    public function material(){
        return $this->belongsTo(Material::class);
    }

    public function inbound(){
        return $this->belongsTo(Inbound::class);
    }

    public function outbound(){
        return $this->belongsTo(Outbound::class);
    }

    public function inboundItem(){
        return $this->belongsTo(InboundItem::class);
    }
    public function outboundItem(){
        return $this->belongsTo(OutboundItem::class);
    }
}
