<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Http\Requests\order\CashierSessionRequest;
use App\Models\Employee;
use App\Models\menu\Lounge;
use App\Services\order\CashierSessionService;
use DateTime;
use Exception;
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
    protected $cashierSessionService;
    public function __construct(CashierSessionService $cashierSessionService)
    {
        $this->cashierSessionService = $cashierSessionService;
    }

    public function showPointOfSale(Request $request)
    {
        $Lounge = Lounge::all();
        $Navigation = $this->NavigationPonit;
        return view('order.point_of_sale', compact('Navigation', 'Lounge'));
    }
    public function showCashierSessions(Request $request)
    {
        $user = Auth::user();

        if (DB::table('cashier_sessions')->where('user_id', $user->id)->count() > 0) {
            $option = DB::table('cashier_sessions')
                ->where('user_id', $user->id)
                ->whereNull('cash_close_at')
                ->exists();
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
                ->where('user_id', $user->id)
                ->join('employees', 'cashier_sessions.employee_id', '=', 'employees.id')
                ->join('persons', 'employees.person_id', '=', 'persons.id')
                ->select('cashier_sessions.*', 'persons.name as name')
                ->orderBy('cashier_sessions.id', 'desc')
                ->first();

            $format = $this->formatDateInSpanish($specs->cash_open_at);

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
        try {
            $user = Auth::user();

            if ($request->filled(['opening_balance', 'employee_id'])) {

                $request['user_id'] = $user->id;

                $validatedData = $request->validate((new CashierSessionRequest)->rules()); //validacion de CashierSessionRequest

                $response = $this->cashierSessionService->openCashRegister($validatedData);

                return redirect()->route('cashier_sessions')->withInput()->with([
                    'Message' => 'Se aperturó la caja satisfactoriamente.',
                    'Type' => 'success'
                ]);
            }
            if ($request->id != null) {
                $response = $this->cashierSessionService->closeCashRegister($request->id, $request->note);

                return redirect()->route('cashier_sessions')->withInput()->with([
                    'Message' => 'Se cerro la caja satisfactoriamente.',
                    'Type' => 'success'
                ]);
            }

            return redirect()->route('cashier_sessions')->withInput()->with([
                'Message' => $response ?? 'Verifica bien los datos.',
                'Type' => 'error'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error en la validación de los datos',
                'errors' => $e // Devuelve los mensajes de error
            ], 422);
        }
    }
    public function listEmployeer(){
        $data = Employee::select('employees.id', 'persons.name as name')
        ->join('persons', 'employees.person_id', '=', 'persons.id')
        ->get();
        return response()->json($data);
    }
    //se puede toamar como servisio
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
