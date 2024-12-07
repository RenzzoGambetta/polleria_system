<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Models\menu\Lounge;
use App\Models\menu\MenuCategory;
use App\Models\menu\MenuItem;
use App\Models\menu\Table;
use Exception;
use Illuminate\Http\Request;

class MozoController extends Controller
{
    protected $Navigation = [
        'seccion' => 10,
        'sub_seccion' => 10.0,
        'color' => 100
    ];
    public function showPanelMozo(Request $request)
    {
        
        $Data = $this->queryDataSaleOption(7,$request->lounge_id ?? false);
        $Navigation = $this->Navigation;
        $Option = [
            'id' => 0
        ];
        $Lounge = Lounge::all();
        return view('order.mozo_panel', compact('Data', 'Option', 'Lounge', 'Navigation'));
    }
    public function showPanelOrderMozo(Request $request)
    {
        try{
            $loungeData = Table::where('id', $request->id)->first();
            $Option = [
                'id' => $loungeData->lounge_id,
                'lounge_id' => $loungeData->lounge_id,
                'id_table' => $request->id
            ];
            //return response()->json($Option);
            $Items = MenuItem::query()->select( 'category_id', 'id', 'name', 'price', 'is_combo', 'display_order')->orderBy('display_order')->get();
            $Category = MenuCategory::query()->select('name', 'id')->orderBy('display_order')->get();
            $Data = $this->queryDataSaleOption(7,$loungeData->lounge_id);
            $Navigation = $this->Navigation;
    
            return view('order.order_mozo_to_client', compact('Option',  'Navigation', 'Data','Category','Items'));
        }catch(Exception $e){
            return response()->json(['Text' => 'No se puede axederpor modificaciones en la URL', 'error' => $e->getMessage()]);
        }
    }
    public function shoqwPanelToTableData(Request $request)
    {   
        try{
            if ($request->lounge_id) {
    
                $Option = [
                    'id' => $request->lounge_id,
                    'lounge_name' => Lounge::where('id', $request->lounge_id)->value('name')
                ];
                $Data = $this->queryDataSaleOption(7,$request->lounge_id);
                $Navigation = $this->Navigation;
                $Navigation['color'] = 99999;
    
                $Tables = Table::where('lounge_id',$request->lounge_id)->get();

                return view('order.order_mozo_to_table', compact('Data', 'Option', 'Navigation', 'Tables'));
            } else {
                return redirect()->route('mozo');
            }
        }catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }
    private function queryDataSaleOption(int $quantityBase,int $lounge_id){

        if ($lounge_id) {

            $currentId = $lounge_id;
            $currentLounge = Lounge::find($currentId);

            if (!$currentLounge) {
                abort(404, 'Sala no encontrada');
            }

            $previousLounges = Lounge::where('id', '<', $currentId)
                ->orderBy('id', 'desc')
                ->take(($quantityBase - 1) / 2)
                ->get();

            $nextLounges = Lounge::where('id', '>', $currentId)
                ->orderBy('id', 'asc')
                ->take(($quantityBase - 1) / 2)
                ->get();

            if ($previousLounges->count() < ($quantityBase - 1) / 2) {

                $quantityItem = ($quantityBase - 1) - $previousLounges->count();

                $nextLoungesReform = Lounge::where('id', '>', $currentId)
                    ->orderBy('id', 'asc')
                    ->take(value: $quantityItem)
                    ->get();

                return $previousLounges
                    ->reverse()
                    ->merge(collect([$currentLounge]))
                    ->merge($nextLoungesReform);
            } else if ($nextLounges->count() < ($quantityBase - 1) / 2) {

                $quantityItem = ($quantityBase - 1) - $nextLounges->count();

                $previousLoungesReform = Lounge::where('id', '<', $currentId)
                    ->orderBy('id', 'desc')
                    ->take($quantityItem)
                    ->get();

                return $previousLoungesReform
                    ->reverse()
                    ->merge(collect([$currentLounge]))
                    ->merge($nextLounges);
            } else {
                return $previousLounges
                    ->reverse()
                    ->merge(collect([$currentLounge]))
                    ->merge($nextLounges);
            }
           
        } else {
            return Lounge::take($quantityBase)->get();
        }
    }
}
