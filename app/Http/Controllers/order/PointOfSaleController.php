<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Http\Requests\order\CashierSessionRequest;
use App\Models\Employee;
use App\Models\menu\Lounge;
use App\Models\menu\MenuCategory;
use App\Models\menu\MenuItem;
use App\Models\Person;
use App\Models\User;
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
                $response = $this->cashierSessionService->closeCashRegister($request->id, $request->note ?? ' ');

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
    public function listEmployeer()
    {
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
    public function assignedWaiter()
    {
        $Waiter = User::select('username as name', 'id')->get();
        return response()->json($Waiter);
    }
    public function clientDataFilt(Request $request)
    {
        $query = $request->input('query');
        $limit = $request->input('limit', 5);
        $offset = $request->input('offset', 0);

        // Inicializamos la consulta de búsqueda básica
        $personsQuery = Person::query();

        // Verificamos si el query contiene un RUC o DNI en formato Ruc:XXXX|nombre o Dni:XXXX|nombre
        if (preg_match('/^(ruc|dni):(\d+)\|(.+)$/', $query, $matches)) {
            $documentType = $matches[1];  // Tipo de documento (Ruc o Dni)
            $documentNumber = $matches[2];
            $name = $matches[3];

            // Filtrar tanto por número de documento como por nombre
            $personsQuery->where('document_number', 'like', "%$documentNumber%")
                ->where('name', 'like', "%$name%");
        } else {
            // Si no está en el formato específico, buscar por nombre o documento
            $personsQuery->where('name', 'like', "%$query%")
                ->orWhere('document_number', 'like', "%$query%");
        }

        // Ejecutar la consulta con límites y offset
        $persons = $personsQuery->skip($offset)
            ->take($limit)
            ->get();

        // Formatear los resultados
        $formattedPersons = $persons->map(function ($person) {
            $prefix = strlen($person->document_number) == 11 ? 'Ruc:' : 'Dni:';
            return [
                'id' => $person->id,
                'name' => $prefix . $person->document_number . '|' . $person->name
            ];
        });

        return response()->json(['items' => $formattedPersons]);
    }
    public function newOrderClient(Request $request)
    {
        $Navigation = $this->NavigationPonit;
        $Category = MenuCategory::select('name', 'id')->get();
        if ($request->id == null | $request->code == null | $request->sale == null) {
            return response()->json(['mesage' => 'No se puede accesdeder sin datos']);
        }
        $Data = [
            'id' => $request->id,
            'code' => $request->code,
            'sale' => $request->sale
        ];
        return view('order.new_order_client', compact('Navigation', 'Category', 'Data'));
    }
    public function listItemFiltCategory(Request $request)
    {
        $Item = MenuItem::where('category_id', $request->id)->select('name', 'id', 'display_order', 'price')->get();
        return response()->json($Item);
    }
    public function listTakeawayOrders(){

        //Datos de prueva para los pedidos de mostrador
        $nombres = [
            'Juan Pérez', 'María López', 'Carlos Rivera', 'Ana García', 'Luis Torres',
            'Sofía Martínez', 'Miguel Vega', 'Laura Morales', 'Fernando Ruiz', 'Paola Castillo',
            'Ricardo Flores', 'Claudia Gómez', 'Diego Sánchez', 'Andrea Valdez', 'Josefina Ramos',
            'Martín Suárez', 'Rosa Medina', 'Alberto Vargas', 'Camila Silva', 'Daniel Ortega',
            'Patricia Muñoz', 'Javier Paredes', 'Carmen Herrera', 'Roberto Castro', 'Lucía Guzmán',
            'Manuel Delgado', 'Lorena Salas', 'Gabriel Torres', 'Sara Morales', 'Iván Rojas',
            'Estela Fernández', 'Oscar Navarro', 'Elsa Ponce', 'Héctor Domínguez', 'Julia Quintana',
            'Ramiro Espinoza', 'Mónica León', 'Victor Soto', 'Isabel Vega', 'Cristina Montes',
            'Pedro Aguilar', 'Ángel Palma', 'Clara Esteban', 'Francisco Arce', 'Valeria Reyes',
            'Santiago Peña', 'Tania Vargas', 'Leonardo Mendoza', 'Verónica Flores', 'Natalia Fuentes'
        ];

        $pedidos = [];

        for ($i = 1; $i <= 50; $i++) {
            $pedidos[] = [
                'id' => $i,
                'order' => 'ORD-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'date' => \Carbon\Carbon::create(2024, 11, 20, 14, 0, 0)->addMinutes(rand(0, 360))->format('Y-m-d H:i:s'),
                'client' => $nombres[array_rand($nombres)],
                'total' => round(rand(100, 1000) + rand(0, 99) / 100, 2), // Valores entre 100.00 y 1000.99
            ];
        }
        // Retornar los datos como JSON
        return response()->json($pedidos);
    }
}
