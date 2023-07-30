<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class OutboundItem extends Model implements Auditable
{
    use HasFactory;
    use DefaultDatetimeFormat;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    protected $table = 'outbound_items';
    protected $fillable = [
        'outbound_id',
        'sku_id',
        'order_qty',
        'actual_qty',
        'outbound_at',
        'unit_price',
        'unit_material_costs'
    ];

    public function outbound(){
       return $this->belongsTo(Outbound::class);
    }

    public function sku(){
        return $this->belongsTo(Sku::class);
    }
}
