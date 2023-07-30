<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Material;
use App\Models\Sku;
use App\Models\SkuItem;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Table;

class SkuController extends AdminController
{
    protected $title = 'SKU';
    public static function table(){
        $table = new Table(new Sku());
        $table->column('id', 'ID')->sortable();
        $table->column('barcode', '条码')->sortable()->modal("明细",function($model){
            /** @var SkuItem $model */
            $items = $model->items()->get();
            $data = [];
            foreach($items as $item){
                $data[] = [
                    $item->material->name,
                    $item->qty

                ];
            }
            return new \Encore\Admin\Widgets\Table(['物料名称','数量'],$data);
        });;
        $table->column('name', '名称')->sortable()->text();
        $table->column('description', '描述')->text();
        $table->column('created_at', '创建时间')->datetime();
        $table->filter(function(Table\Filter $filter){
            $filter->column(1/2,function(Table\Filter $filter){
                $filter->like('barcode', '条码');
            });
            $filter->column(1/2,function(Table\Filter $filter){
                $filter->like('name', '名称');
                $filter->between('created_at', '创建时间')->datetime(['format' => 'Y-m-d H:i:s']);
            });

        });
        $table->actions(function ($actions) {
            $actions->disableDelete();
        });
        return $table;
    }
    public function index(Content $content)
    {
        $table = self::table();
        return $content
            ->title('商品管理')
            //->description('')
            //->row("商品管理")
            ->body($table);
    }

    public function create(Content $content)
    {
        $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'));
        return $this->renderModalForm($this->form()->create(), $content);
    }

    public static function form(){
        $form = new Form(new Sku());
        $form->text('barcode')->rules(['required']);
        $form->text('name')->rules(['required']);
        $form->text('description')->rules(['required']);
        $form->hasMany('items','明细',function(Form\NestedForm $form){
            $form->hidden('sku_id');
            $form->row(function(Form\Layout\Row $row){
                $row->select('material_id','物料名称')->rules(['required'])->options(Material::pluck('name','id')->toArray());
                $row->number('qty');
            });
        });
        $form->tools(function (Form\Tools $tools) {
            // 去掉`删除`按钮
            $tools->disableDelete();


            // 添加一个按钮, 参数可以是字符串, 或者实现了Renderable或Htmlable接口的对象实例
            //$tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });
        return $form;
    }

}
