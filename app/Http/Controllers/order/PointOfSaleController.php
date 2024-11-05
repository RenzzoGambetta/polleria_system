<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Models\menu\Lounge;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PointOfSaleController extends Controller
{
    protected $NavigationPonit = [
        'seccion' => 6,
        'sub_seccion' => 6.0,
        'color' => 60
    ];
    protected $NavigationSessions = [
        'seccion' => 6,
        'sub_seccion' => 6.1,
        'color' => 61
    ];
    public function showPointOfSale(Request $request)
    {
        $Lounge = Lounge::all();
        $Navigation = $this->NavigationPonit;
        return view('order.point_of_sale', compact('Navigation', 'Lounge'));
    }
    public function showCashierSessions(Request $request)
    {

        if (DB::table('cashier_sessions')->count() > 0) {
            $option = DB::table('cashier_sessions')
                ->latest('id')
                ->value('cash_close_at') === null;
        } else {
            $option = false;
        }

        $Navigation = $this->NavigationSessions;

        if ($option) {

            $Data = [
                'Title' => 'Cierre de Caja',
                'SubTitle' => 'Serra la caja',
                'Option' => true
            ];
            $specs = DB::table('cashier_sessions')
                ->join('employees', 'cashier_sessions.employee_id', '=', 'employees.id')
                ->join('persons', 'employees.person_id', '=', 'persons.id')
                ->select('cashier_sessions.*', 'persons.firstname as name')
                ->orderBy('cashier_sessions.id', 'desc')
                ->first();

            $format = $this->formatDateInSpanish($specs->cash_open_at);
            //return response()->json($format);
            return view('order.cashier_sessions', compact('Navigation', 'Data', 'specs', 'format'));
        } else {

            $Data = [
                'Title' => 'Apertura de Caja',
                'SubTitle' => 'Abrir la caja',
                'Option' => false
            ];

            return view('order.cashier_sessions', compact('Navigation', 'Data'));
        }
    }
    public function listEmployeesOpenBox()
    {
        $Lounge = Lounge::all();
    }
    public function registerSessionCashBox(Request $request)
    {
        $user = Auth::user();
        $note = $request->note ?? ' ';


        if ($request->opening_balance !== null && $request->employee_id !== null) {
            DB::table('cashier_sessions')->insert([
                'user_id' => $user->id,
                'employee_id' => $request->employee_id,
                'opening_balance' => $request->opening_balance,
                'cash_open_at' => now(),
                'cash_close_at' => null,
                'note' => $note,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('cashier_sessions')->withInput()->with([
                'Message' => 'Se aperturó la caja satisfactoriamente.',
                'Type' => 'success'
            ]);
        }
        if($request->user_id != null){
            
        }

        return redirect()->route('cashier_sessions')->withInput()->with([
            'Message' => 'Verifica bien los datos.',
            'Type' => 'error'
        ]);
    }
    private function formatDateInSpanish($dateTime)
    {
        $date = new DateTime($dateTime);

        $formattedDate = $date->format('l, j \d\e F');
        $formattedTime = $date->format('g:i:s a');

        $translateDays = [
            'Monday' => 'lunes',
            'Tuesday' => 'martes',
            'Wednesday' => 'miércoles',
            'Thursday' => 'jueves',
            'Friday' => 'viernes',
            'Saturday' => 'sábado',
            'Sunday' => 'domingo'
        ];
        $translateMonths = [
            'January' => 'enero',
            'February' => 'febrero',
            'March' => 'marzo',
            'April' => 'abril',
            'May' => 'mayo',
            'June' => 'junio',
            'July' => 'julio',
            'August' => 'agosto',
            'September' => 'septiembre',
            'October' => 'octubre',
            'November' => 'noviembre',
            'December' => 'diciembre'
        ];

        $formattedDate = strtr($formattedDate, $translateDays);
        $formattedDate = strtr($formattedDate, $translateMonths);

        return [
            'date' => $formattedDate,
            'time' => $formattedTime
        ];
    }
}
