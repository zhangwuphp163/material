<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\Href;
use App\Admin\Actions\Post\InboundConfirmPost;
use App\Http\Controllers\Controller;
use App\Models\Inbound;
use App\Models\InboundItem;
use App\Models\Material;;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Table;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class InboundController extends AdminController
{
    protected $title = '入出库管理';
    public static function table(){
        $table = new Table(new Inbound());
        $table->column('id', 'ID')->sortable();
            //->expand(function($model){
            /** @var Inbound $model */
            //$items = $model->items()->get(['plan_qty'])->toArray();
            //return new \Encore\Admin\Widgets\Table(['Plan QTY'],$items);
        //});
        $table->column('inbound_number', '入库编号')->sortable()->modal("明细",function($model){
            /** @var Inbound $model */
            $items = $model->items()->get();
            $data = [];
            foreach($items as $item){
                $data[] = [
                    $item->material->name,
                    $item->plan_qty,
                    $item->actual_qty,
                    $item->plan_unit_price,
                    $item->actual_unit_price

                ];
            }
            return new \Encore\Admin\Widgets\Table(['物料名称','预算数量','实际数量','预算价格','实际价格'],$data);
        });
        $table->column('status', '状态')->sortable()->display(function($status){
            return $status == 0?'待定':'入库完成';
        });
        $table->column('remark', '备注')->text();
        $table->column('ata_at', '预期入库日期')->sortable()->date();
        $table->column('inbound_at', '入库时间')->sortable();
        //$table->column('confirmed_at', '确认入库时间')->sortable();
        $table->column('created_at', '创建时间')->sortable();
        $table->filter(function(Table\Filter $filter){
            $filter->column(1/2,function(Table\Filter $filter){
                $filter->between('created_at', '创建时间')->datetime();
            });
            $filter->column(1/2,function(Table\Filter $filter){
                $filter->like('name', '名称');
                $filter->between('inbound_at', '入库时间')->datetime(['format' => 'Y-m-d H:i:s']);
            });
        });

        $table->actions(function($actions){
            $row = $actions->row;
            if($row->status == 0){
                $actions->add(new Href("/admin/inbound/items/"));
            }
        });

        return $table;
    }
    public function index(Content $content)
    {
        $table = self::table();
        return $content
            ->title('入库管理')
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
                    $row->decimal('plan_unit_price');
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

    public function detail($id){
        $show = new Show(Inbound::findOrFail($id));
        return $show;
    }

    public function items(int $inbound_id,Content $content)
    {
        $table = new Table(new InboundItem());
        $table->model()->where('inbound_id',$inbound_id);
        $table->column('id', 'ID');
        $table->column('material_id', 'Material')->display(function($material_id){
            $material = Material::where('id',$material_id)->first();
            return $material->name;
        });
        $table->column('plan_qty', '预算数量')->sortable();
        $table->column('plan_unit_price', '预算单价')->sortable()->decimal();
        $table->column('actual_qty', '实际数量')->sortable()->integer();
        $table->column('actual_unit_price', '实际单价')->sortable()->integer();
        $table->actions(function ($actions) {
            $actions->disableEdit();
            $actions->disableView();
        });
        $table->disableCreateButton();
        $table->disableFilter();
        $table->disableExport();
        $table->disableRowSelector();
        $table->tools(function (Table\Tools $tools) use ($inbound_id){
            $class = new InboundConfirmPost($inbound_id);
            $class->inbound_id = $inbound_id;
            //$class->attribute("id",strval($inbound_id));
            $tools->append($class);
        });
        return $content
            ->title('详情')
            ->body($table);
    }

    public function itemUpdate($inbound_id,$item_id,Request $request){
        /** @var InboundItem $inboundItem */
        $inboundItem = InboundItem::where('id',$item_id)->first();
        $fillables = collect($inboundItem->getFillable());
        foreach ($fillables As $fillable) {
            if ($request->exists($fillable)) {
                $inboundItem->$fillable = $request->get($fillable);
            }
        }
        $inboundItem->save();
        return [
            'status' => true,
            'message' => '更新成功',
            'display' => []
        ];

    }

}
