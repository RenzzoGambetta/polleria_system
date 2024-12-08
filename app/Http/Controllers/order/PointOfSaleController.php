<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Http\Requests\order\CashierSessionRequest;
use App\Http\Requests\order\CreateOrderRequest;
use App\Models\Employee;
use App\Models\menu\Lounge;
use App\Models\menu\MenuCategory;
use App\Models\menu\MenuItem;
use App\Models\menu\Table;
use App\Models\order\Order;
use App\Models\Person;
use App\Models\User;
use App\Services\IdentificationDocumentService;
use App\Services\order\CashierSessionService;
use App\Services\order\ClientService;
use App\Services\order\OrderService;
use App\Services\order\PaymentService;
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
    protected $orderService;
    public function __construct(CashierSessionService $cashierSessionService, OrderService $orderService)
    {
        $this->cashierSessionService = $cashierSessionService;
        $this->orderService = $orderService;
    }

    public function showPointOfSale(Request $request)
    {
        $user = Auth::user();
        
        if (DB::table('cashier_sessions')->where('user_id', $user->id)->whereNull('cash_close_at')->exists()) {
            $Lounge = Lounge::all();
            $Navigation = $this->NavigationPonit;
            return view('order.point_of_sale', compact('Navigation', 'Lounge'));
        } else {
            return redirect()->route('cashier_sessions')->with([
                'Message' => 'Se recomienda abrir la caja para comensar con las ventas',
                'Type' => 'error',
                'Time' => 3,
                'Redirect' => 'poin_of_sale'
            ]);
        }
    }
    public function showPaymentService(Request $request)
    {
        $Item = $this->orderService->getAllOrderDetailsOfTable($request->id);
        $Data = Table::where('id', $request->id)->first();
        $Navigation = $this->NavigationPonit;
        $Data['sub_total'] = array_sum(array_column($Item, 'total_price'));
        return view('order.payment_customer_order', compact('Navigation', 'Item', 'Data'));
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
        //return response()->json($request);
        try {
            $user = Auth::user();

            if ($request->filled(['opening_balance', 'employee_id'])) {

                $request['user_id'] = $user->id;

                $validatedData = $request->validate((new CashierSessionRequest)->rules()); //validacion de CashierSessionRequest

                $response = $this->cashierSessionService->openCashRegister($validatedData);
                if ($request->redirect == 'poin_of_sale') {
                    return redirect()->route('point_of_sale')->with([
                        'Message' => 'Se aperturó la caja satisfactoriamente.',
                        'Type' => 'success',
                        'Time' => 1
                    ]);
                } else {
                    return redirect()->route('cashier_sessions')->with([
                        'Message' => 'Se aperturó la caja satisfactoriamente.',
                        'Type' => 'success'
                    ]);
                }
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

    /*
        Convertir a cervisio
    */
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
        $typeFacture = $request->input('type');

        // Inicializamos la consulta del modelo `Person`
        $personsQuery = Person::query();

        // Filtrar por `document_type_id` si el tipo de factura es 'factura'
        if ($typeFacture === 'factura') {
            $personsQuery->where('document_type_id', 2);
        }

        // Verificar si el query contiene un formato específico Ruc:XXXX|nombre o Dni:XXXX|nombre
        if (preg_match('/^(ruc|dni):(\d+)\|(.+)$/', $query, $matches)) {
            $documentType = $matches[1];  // Ruc o Dni
            $documentNumber = $matches[2];
            $name = $matches[3];

            // Filtrar tanto por documento como por nombre
            $personsQuery->where('document_number', 'like', "%$documentNumber%")
                ->where('name', 'like', "%$name%");
        } else {
            // Búsqueda genérica por nombre o documento
            $personsQuery->where(function ($subQuery) use ($query) {
                $subQuery->where('name', 'like', "%$query%")
                    ->orWhere('document_number', 'like', "%$query%");
            });
        }

        // Aplicar límites y ejecutar la consulta
        $persons = $personsQuery->skip($offset)
            ->take($limit)
            ->get();

        // Formatear resultados
        $formattedPersons = $persons->map(function ($person) {
            $prefix =  $person->document_type_id == 2 ? 'Ruc:' : 'Dni:';
            return [
                'id' => $person->id,
                'name' => $prefix . $person->document_number . '|' . $person->name
            ];
        });

        return response()->json(['items' => $formattedPersons]);
    }

    /*Fin*/
    public function newOrderClient(Request $request)
    {
        $Navigation = $this->NavigationPonit;
        $Category = MenuCategory::query()->select('name', 'id')->orderBy('display_order')->get();
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
    public function listTakeawayOrders(Request $Data)
    {

        //Datos de prueva para los pedidos de mostrador
        $nombres = [
            'Juan Pérez',
            'María López',
            'Carlos Rivera',
            'Ana García',
            'Luis Torres',
            'Sofía Martínez',
            'Miguel Vega',
            'Laura Morales',
            'Fernando Ruiz',
            'Paola Castillo',
            'Ricardo Flores',
            'Claudia Gómez',
            'Diego Sánchez',
            'Andrea Valdez',
            'Josefina Ramos',
            'Martín Suárez',
            'Rosa Medina',
            'Alberto Vargas',
            'Camila Silva',
            'Daniel Ortega',
            'Patricia Muñoz',
            'Javier Paredes',
            'Carmen Herrera',
            'Roberto Castro',
            'Lucía Guzmán',
            'Manuel Delgado',
            'Lorena Salas',
            'Gabriel Torres',
            'Sara Morales',
            'Iván Rojas',
            'Estela Fernández',
            'Oscar Navarro',
            'Elsa Ponce',
            'Héctor Domínguez',
            'Julia Quintana',
            'Ramiro Espinoza',
            'Mónica León',
            'Victor Soto',
            'Isabel Vega',
            'Cristina Montes',
            'Pedro Aguilar',
            'Ángel Palma',
            'Clara Esteban',
            'Francisco Arce',
            'Valeria Reyes',
            'Santiago Peña',
            'Tania Vargas',
            'Leonardo Mendoza',
            'Verónica Flores',
            'Natalia Fuentes'
        ];

        $pedidos = [];

        if ($Data->type == 'order') {
            for ($i = 1; $i <= 50; $i++) {
                $pedidos[] = [
                    'id' => $i,
                    'order' => 'ORD-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'date' => \Carbon\Carbon::create(2024, 11, 20, 14, 0, 0)->addMinutes(rand(0, 360))->format('Y-m-d H:i:s'),
                    'client' => $nombres[array_rand($nombres)],
                    'total' => round(rand(100, 1000) + rand(0, 99) / 100, 2), // Valores entre 100.00 y 1000.99
                ];
            }
        } else if ($Data->type == 'preparation') {
            for ($i = 1; $i <= 15; $i++) {
                $type = ['Efectivo', 'Tarjeta', 'Transferencia'][array_rand(['Efectivo', 'Tarjeta', 'Transferencia'])];
                switch ($type) {
                    case 'Efectivo':
                        $color = '#088d00bd';
                        break;
                    case 'Tarjeta':
                        $color = '#0006f3a1';
                        break;
                    case 'Transferencia':
                        $color = '#53008dbd';
                        break;
                    default:
                        $color = '#53008dbd';
                        break;
                }
                $pedidos[] = [
                    'id' => $i,
                    'order' => 'ORD-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'date' => \Carbon\Carbon::create(2024, 11, 20, 14, 0, 0)->addMinutes(rand(0, 360))->format('Y-m-d H:i:s'),
                    'client' => $nombres[array_rand($nombres)],
                    'pay' => $type,
                    'color' => $color,
                    'total' => round(rand(100, 1000) + rand(0, 99) / 100, 2), // Valores entre 100.00 y 1000.99
                ];
            }
        } else if ($Data->type == 'history') {
            for ($i = 1; $i <= 1520; $i++) {
                $type = ['Efectivo', 'Tarjeta', 'Transferencia'][array_rand(['Efectivo', 'Tarjeta', 'Transferencia'])];
                switch ($type) {
                    case 'Efectivo':
                        $color = '#088d00bd';
                        break;
                    case 'Tarjeta':
                        $color = '#0006f3a1';
                        break;
                    case 'Transferencia':
                        $color = '#53008dbd';
                        break;
                    default:
                        $color = '#53008dbd';
                        break;
                }
                $pedidos[] = [
                    'id' => $i,
                    'order' => 'ORD-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'date' => \Carbon\Carbon::create(2024, 11, 20, 14, 0, 0)->addMinutes(rand(0, 360))->format('Y-m-d H:i:s'),
                    'client' => $nombres[array_rand($nombres)],
                    'pay' => $type,
                    'color' => $color,
                    'total' => round(rand(100, 1000) + rand(0, 99) / 100, 2), // Valores entre 100.00 y 1000.99
                ];
            }
        }

        return response()->json($pedidos);
    }
    public function createOrderClient(Request $request)
    {
        $requestFilt = [
            'table_id' => (int) $request->table_id,
            'waiter_id' => (int) Auth::user()->id,
            'is_delibery' => filter_var($request->is_delibery, FILTER_VALIDATE_BOOLEAN),
            'commentary' => $request->commentary ?? '',
            'menu_item_ids' => array_map('intval', $request->menu_item_ids),
            'prices' => array_map('floatval', $request->prices),
            'quantities' => array_map('intval', $request->quantities),
            'total_prices' => array_map('floatval', $request->total_prices),
            'is_delibery_details' => array_map(function ($value) {
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            }, $request->is_delibery_details),
            'notes' => $request->notes ?? [],
        ];
        //return response()->json($requestFilt);

        try {
            $response = $this->orderService->createOrderWithDetails($requestFilt);
            if ($request->type != 'mozo') {
                return redirect()->route('point_of_sale')->withInput()->with([
                    'Message' => 'Se creo la orden satisfactoriamente para la Mesa: ' . $response->table->code . ' / ' . $response->table->lounge->name,
                    'Type' => 'success',
                    'Time' => 1
                ]);
            } else {
                return redirect()->route('table_to_mozo', ['lounge_id' => $request->lounge])->withInput()->with([
                    'Message' => 'Se creo la orden satisfactoriamente para la Mesa: ' . $response->table->code . ' / ' . $response->table->lounge->name,
                    'Type' => 'success',
                    'Time' => 1
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error en el registro de la orden',
                'errors' => $e
            ], 422);
        }
    }
    public function allOrderDetailsOfTable(Request $Data)
    {
        try {
            $response = $this->orderService->getAllOrderDetailsOfTable($Data->id);
            $order = Order::where('table_id', $Data->id)->first();
            return response()->json([
                'data' => $response,
                'messenger' => $order->commentary
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error en la validación de los datos',
                'errors' => $e
            ], 422);
        }
    }
    public function fetchClientData(Request $Data)
    {
        try {
            if ($Data->type == 'dni') {
                $response = (new IdentificationDocumentService())->fetchDataByDni($Data->document);
                $response['status'] = true;
            } else if ($Data->type == 'ruc') {
                $response = (new IdentificationDocumentService())->fetchDataByRuc($Data->document);
                $response['status'] = true;
            } else {
                $respnser = [
                    'status' => false
                ];
            }
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'status' => false
            ]);
        }
    }
    public function registerNewPersonDataBase(Request $Data)
    {
        try {
            $DataFilt = $Data->toArray();
            $DataFilt['dni'] = $Data->document;

            if ($Data->option == 'create') {
                $response = (new ClientService())->createClient($DataFilt);

                if (isset($response['document_number']) && isset($response['id']) && isset($response['name'])) {
                    $prefix = strlen($response['document_number']) === 11 ? 'Ruc:' : 'Dni:';
                    return response()->json([
                        'id' => $response['id'],
                        'name_compact' => $prefix . $response['document_number'] . '|' . $response['name'],
                        'status' => true
                    ]);
                }
                return response()->json([
                    'status' => false,
                    'data' => $response
                ]);
            }
            return response()->json([
                'status' => false,
                'data' => $DataFilt
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'data' => $Data->toArray()
            ]);
        }
    }
    public function registerExpressDataClient(Request $Data)
    {
        try {
            // Validar tipo de documento
            if ($Data->type === 'dni') {
                $responseClient = (new IdentificationDocumentService())->fetchDataByDni($Data->document);
            } elseif ($Data->type === 'ruc') {
                $responseClient = (new IdentificationDocumentService())->fetchDataByRuc($Data->document);
            } else {
                return response()->json(['status' => false, 'message' => 'Tipo de documento no válido.']);
            }
            return $this->registerFastDataClient($responseClient, $Data->toArray());
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error inesperado en el servidor.',
                'error' => env('APP_DEBUG') ? $e->getMessage() : null,
            ]);
        }
    }
    private function registerFastDataClient(array $responseClient, array $Data)
    {
        if (isset($responseClient['response']) && $responseClient['response'] === true) {
            $responseRegister = [];

            if ($Data['type'] === 'dni') {
                if (isset($responseClient['dni'], $responseClient['name'], $responseClient['paternal_surname'], $responseClient['maternal_surname'])) {
                    $DataFilt = [
                        'dni' => $responseClient['dni'], //se modifico a dni
                        'name' => $responseClient['name'],
                        'lastname' => trim(($responseClient['paternal_surname'] ?? '') . ' ' . ($responseClient['maternal_surname'] ?? '')),
                    ];
                    $responseRegister = (new ClientService())->createClient($DataFilt);
                } else {
                    return ['status' => false, 'message' => 'Información incompleta para el DNI.'];
                }
            } elseif ($Data['type'] === 'ruc') {
                // Verificar si las claves necesarias existen en la respuesta pendiente 
                if (isset($responseClient['numeroDocumento'], $responseClient['nombre'], $responseClient['razonSocial'], $responseClient['viaNombre'])) {
                    $DataFilt = [
                        'document_number' => $responseClient['numeroDocumento'],
                        'name' => $responseClient['nombre'] ?? $responseClient['razonSocial'],
                        'lastname' => $responseClient['viaNombre'],
                    ];
                } else {
                    return ['status' => false, 'message' => 'Información incompleta para el RUC.'];
                }
            }

            if (isset($responseRegister['document_number']) && isset($responseRegister['id']) && isset($responseRegister['name'])) {
                $prefix = strlen($responseRegister['document_number']) === 11 ? 'RUC:' : 'DNI:';

                return [
                    'status' => true,
                    'response' => true,
                    'id' => $responseRegister['id'],
                    'name_compact' => $prefix . $responseRegister['document_number'] . ' | ' . $responseRegister['name'],
                ];
            } else {
                return ['status' => false, 'message' => 'Error al registrar cliente.'];
            }
        } else {
            return $responseClient;
        }
    }
    public function tiketCancelClientOrder(Request $request)
    {

/*
        $RegisterData = [
            'voucher_serie_id' => 1,
            'issuance_date' => new DateTime(),
            'expiration_date' => new DateTime(),
            'payment_type' => 'contado',
            'commentary' => null,
            'amounts' => [50.00, 30.00, 20.00],
            'payment_methods' => 'efectivo',
        ];

        $responseRegister = (new PaymentService())->payOrder(1,$RegisterData);
        return response()->json($responseRegister);
*/
        try{
            $data = $request->input();
            $dataClient = Person::where('id', $request->idClient)->first();
            $dataTable = Table::where('id', $request->idTable)->first();

            $igb = round($data['primaryTotalPayment'] * 0.18, 2);

            switch ($request->typeFacture) {
                case 'boleta':
                    $textTypeFacture = 'Boleta de venta electronica';
                    break;
                case 'factura':
                    $textTypeFacture = 'Factura electronica';
                    break;
                case 'nota':
                    $textTypeFacture = 'Nota de venta';
                    break;
                default:
                    $textTypeFacture = 'Nota simple';
                    break;
            }


            $newArray = [
                'dataCompany' => [
                    'ruc' => 20612460401,
                    'phone' => 948447099,
                    'address' => 'Alfonso Ugarte III ET Mz. A5 Lt:11',
                ],
                'dataDocument' => [
                    'typeDocument' => $textTypeFacture,
                    'salesNumber' => 'BA02-00000938',
                    'dateOfIssue' => '14/12/2024',
                    'timeOfIssue' => '12:45:12',
                    'areaOfAttention' => $dataTable->lounge->name . ' - Mesa : ' . $dataTable->code,
                ],
                'dataClient' => [
                    'nameClient' => ($dataClient->name ?? '') . ' .' . ($dataClient->lastname ?? ''),
                    'documentClient' => ($dataClient->document_number ?? '00000000000'),
                    'documentClientType' => $dataClient->document_type_id == 1 ? 'DNI' : 'RUC',
                ],
                'dataPayment' => [
                    'optionPayment' => $data['optionPayment'],
                    'typeFacture' => $data['typeFacture'],
                    'cashPaid' => $data['cashPaid'],
                    'anotherPaymentMethod' => $data['anotherPaymentMethod'],
                    'primaryTotalPayment' => $data['primaryTotalPayment'],
                    'totalPayment' => $data['primaryTotalPayment'],
                    'returnMoneyClient' => $data['returnMoneyClient'],
                    'textCashPaid' => 'VENTIDOS CON 00/100 Soles',
                    'opGravada' => round($data['primaryTotalPayment'] - $igb, 2),
                    'opExonerada' => 0,
                    'igb' => $igb,
                ],
                'items' => array_map(function ($item) {
                    return [
                        'id' => $item['id'],
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'total_price' => $item['total_price'],
                    ];
                }, $data['items']),
            ];

            return response()->json($newArray);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
