<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inbound;
use App\Models\Material;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Table;

class InboundController extends AdminController
{
    protected $title = '入出库管理';
    public static function table(){
        $table = new Table(new Inbound());
        $table->column('id', 'ID')->sortable();
        $table->column('inbound_number', '入库编号')->sortable()->text();
        $table->column('remark', '备注')->text();
        $table->column('created_at', '创建时间')->sortable()->datetime();
        $table->column('ata_at', '预期入库时间')->sortable()->text();
        $table->column('inbound_at', '入库时间')->sortable();
        //$table->column('confirmed_at', '确认入库时间')->sortable();
        $table->filter(function(Table\Filter $filter){
            $filter->column(1/2,function(Table\Filter $filter){
                $filter->between('created_at', '创建时间')->datetime();
            });
            $filter->column(1/2,function(Table\Filter $filter){
                $filter->like('name', '名称');
                $filter->between('inbound_at', '入库时间')->datetime(['format' => 'Y-m-d H:i:s']);
            });
        });
        return $table;
    }
    public function index(Content $content)
    {

        $table = self::table();
        return $content
            ->title('入库管理')
            //->description('')
            //->row("客户管理")
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
        $form = new Form(new Inbound());
        $form->tab('入库信息',function($form){
            $form->text('inbound_number')->rules(['required']);
            $form->text('remark');
            $form->date('ata_at');
        });
        $form->tab('入库明细',function($form){
            $form->hasMany('items','明细',function(Form\NestedForm $form){
                $form->hidden('inbound_id');
                $form->row(function(Form\Layout\Row $row){
                    $row->select('material_id','物料名称')->rules(['required'])->options(Material::pluck('name','id')->toArray());
                    $row->number('plan_qty');
                    $row->decimal('unit_price');
                });
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
