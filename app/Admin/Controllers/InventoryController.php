<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Inventory;
use App\Models\Material;
use App\Models\Sku;
use App\Models\SkuItem;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Table;

class InventoryController extends AdminController
{
    protected $title = '库存管理';
    public static function table(){
        $table = new Table(new Inventory());
        $table->model()->whereNull('outbound_at');
        $table->column('id', 'ID')->sortable();
        $table->column('material.barcode', '物料条码')->sortable();
        $table->column('material.name', '物料名称')->sortable();
        $table->column('qty', '数量')->sortable();
        $table->column('unit_price', '单价')->sortable();
        $table->column('inbound.inbound_number', '入库单号')->sortable();
        $table->actions(function ($actions) {
            $actions->disableDelete();
        });
        return $table;
    }
    public function detail($id){
        $show = new Show(Inventory::findOrFail($id));
        return $show;
    }
    public function index(Content $content)
    {
        $table = self::table();
        return $content
            ->title('库存管理')
            ->body($table);
    }

}
