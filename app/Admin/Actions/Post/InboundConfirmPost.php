<?php

namespace App\Admin\Actions\Post;

use App\Models\Inbound;
use App\Models\InboundItem;
use App\Models\Inventory;
use Carbon\Carbon;
use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InboundConfirmPost extends Action
{
    protected $selector = '.inbound-confirm-post';


    public $inbound_id;

    /**
     * @param Request $request
     * @return $this
     */
    public function handle(Request $request)
    {
        try{
            DB::beginTransaction();
            $inbound_at = $request->get('inbound_at')??Carbon::now();
            /** @var Inbound $inbound */
            $inbound = Inbound::where('id',$request->get('id'))->lockForUpdate()->first();
            if($inbound->status == 1) throw new \Exception("入库订单已经被入库（{$inbound->confirmed_at}）");
            $inbound->status = 1;
            $inbound->inbound_at = $inbound_at;
            $inbound->confirmed_at = $inbound_at;
            $inbound->save();

            /** @var InboundItem $item */
            foreach($inbound->items as $item){
                if($item->actual_unit_price <= 0){
                    $item->actual_unit_price = $item->plan_unit_price??$item->material->price;
                }
                if($item->actual_qty <= 0){
                    $item->actual_qty = $item->plan_qty;
                }
                $item->inbound_at = $inbound_at;
                $item->confirmed_at = $inbound_at;
                $item->save();
            }

            //添加库存
            foreach($inbound->items as $item){
                $data = [
                    'material_id' => $item->material_id,
                    'inbound_id' => $inbound->id,
                    'inbound_item_id' => $item->id,
                    'qty' => $item->actual_qty,
                    'unit_price' => $item->actual_unit_price,
                    'inbound_at' => $inbound_at
                ];
                Inventory::create($data);
            }

            DB::commit();
            return $this->response()->success('入库成功')->redirect('/admin/inbound');
        }catch(\Exception $e){
            DB::rollBack();
            return $this->response()->error($e->getMessage());
        }
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-success inbound-confirm-post">确认入库</a>
HTML;
    }

    public function form(){
        $this->hidden("id")->value($this->inbound_id);
        $this->datetime("inbound_at",'入库时间')->value(Carbon::now());
    }
}