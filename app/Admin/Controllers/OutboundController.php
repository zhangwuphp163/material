<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\MaterialForm;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Material;
use App\Models\Outbound;
use App\Models\Sku;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Table;

class OutboundController extends AdminController
{
    protected $title = '出库管理';
    public static function table(){
        $table = new Table(new Outbound());
        $table->column('id', 'ID')->sortable();
        $table->column('outbound_number', '出库编号')->sortable()->text();
        $table->column('remark', '备注')->text();
        $table->column('created_at', '创建时间')->sortable();
        $table->column('ata_at', '计划出库时间')->sortable()->text();
        $table->column('time_consuming', '生产用时')->sortable()->text();
        $table->column('processing_costs', '加工成本（人工,加工费等）')->sortable()->text();
        $table->column('freight', '运费')->sortable()->text();
        $table->column('outbound_at', '出库库时间')->sortable();
        $table->filter(function(Table\Filter $filter){
            $filter->column(1/2,function(Table\Filter $filter){
                $filter->between('created_at', '创建时间')->datetime(['format' => 'Y-m-d H:i:s']);
            });
            $filter->column(1/2,function(Table\Filter $filter){
                $filter->like('name', '名称');
                $filter->between('outbound_at', '出库时间')->datetime(['format' => 'Y-m-d H:i:s']);
            });
        });
        return $table;
    }
    public function index(Content $content)
    {

        $table = self::table();
        return $content
            ->title('出库管理')
            //->description('')
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
        $form = new Form(new Outbound());

        $form->tab("订单信息",function($form){
            $form->text('outbound_number')->rules(['required']);
            $form->date('ata_at');
            $form->text('remark');
            $form->decimal('time_consuming','生产用时');
            $form->decimal('processing_costs','加工成本（人工，加工费等）');
            $form->decimal('freight','运费');
        });
        $form->tab("订单详情",function($form){
            $form->hasMany('items','明细',function(Form\NestedForm $form){
                $form->hidden('outbound_id');
                $form->row(function(Form\Layout\Row $row){
                    $row->select('sku_id','商品名称')->rules(['required'])->options(Sku::pluck('name','id')->toArray());
                    $row->number('order_qty',"数量");
                    $row->decimal('unit_price',"单价");
                });

            });
        });
        /*$form->row(function(Form\Layout\Row $row) {
            $row->column(6, function (Form\Layout\Column $column) {
                $column->text('outbound_number')->rules(['required']);
                $column->date('ata_at');
                $column->text('remark');
                $column->decimal('time_consuming','生产用时');
                $column->decimal('processing_costs','加工成本（人工，加工费等）');
                $column->decimal('freight','运费');
            });
            $row->column(6, function (Form\Layout\Column $column) {
                $column->hasMany('items','明细',function(Form\NestedForm $form){
                    $form->row(function(Form\Layout\Row $row){
                        $row->number('outbound_id')->setDisplay(false);
                        $row->select('sku_id','商品名称')->rules(['required'])->options(Sku::pluck('name','id')->toArray());
                        $row->number('order_qty',"数量");
                        $row->decimal('unit_price',"单价");
                    });
                });
            });
        });*/


        $form->tools(function (Form\Tools $tools) {
            // 去掉`删除`按钮
            $tools->disableDelete();


            // 添加一个按钮, 参数可以是字符串, 或者实现了Renderable或Htmlable接口的对象实例
            //$tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });
        return $form;
    }

}
