<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Models\menu\Lounge;
use Illuminate\Http\Request;

class MozoController extends Controller
{

    public function showPanelMozo(Request $request)
    {
        $quantityBase = 9;
        
        if ($request->lounge_id) {

            $currentId = $request->lounge_id;
            $currentLounge = Lounge::find($currentId);

            if (!$currentLounge) {
                abort(404, 'Sala no encontrada');
            }

            $previousLounges = Lounge::where('id', '<', $currentId)
                ->orderBy('id', 'desc')
                ->take(($quantityBase - 1 ) / 2)
                ->get();

            $nextLounges = Lounge::where('id', '>', $currentId)
                ->orderBy('id', 'asc')
                ->take(($quantityBase - 1 ) / 2)
                ->get();

            if($previousLounges->count() < 4){

                $quantityItem = ($quantityBase - 1) - $previousLounges->count();
                
                $nextLoungesReform = Lounge::where('id', '>', $currentId)
                ->orderBy('id', 'asc')
                ->take(value: $quantityItem)
                ->get();

                $Data = $previousLounges
                ->reverse()
                ->merge(collect([$currentLounge]))
                ->merge($nextLoungesReform);

            }else if($nextLounges->count() < 4){
                
                $quantityItem = ($quantityBase - 1) - $nextLounges->count();

                $previousLoungesReform = Lounge::where('id', '<', $currentId)
                ->orderBy('id', 'desc')
                ->take($quantityItem)
                ->get();

                $Data = $previousLoungesReform
                ->reverse()
                ->merge(collect([$currentLounge]))
                ->merge($nextLounges);

            }else{
                $Data = $previousLounges
                ->reverse()
                ->merge(collect([$currentLounge]))
                ->merge($nextLounges);
            }
            $Option = [
                'id' => $currentId
            ];
        } else {
            $Data = Lounge::take(9)->get();
            $Option = [
                'id' => 0
            ];
        }
        $Lounge = Lounge::all();
        return view('order.mozo_panel', compact('Data', 'Option', 'Lounge'));
    }
}
