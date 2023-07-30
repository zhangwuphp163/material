<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class InboundItem extends Model implements Auditable
{
    use HasFactory;
    use DefaultDatetimeFormat;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    protected $table = 'inbound_items';
    protected $fillable = [
        'inbound_id',
        'material_id',
        'plan_qty',
        'actual_qty',
        'plan_unit_price',
        'actual_unit_price',
        'inbound_at',
        'confirmed_at'
    ];

    public function order(){
        return $this->belongsTo(Inbound::class);
    }

    public function material(){
        return $this->belongsTo(Material::class);
    }
}
