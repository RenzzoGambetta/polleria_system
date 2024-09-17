<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductStockController extends Controller
{
    protected $Navigation = [
        'seccion' => 3,
        'sub_seccion' => 3.1,
        'color' => 31
    ];
    public function showPanelRegisterEntry()
    {

        $Suppliers = [
            ['id' => 1, 'name' => 'Distribuciones Morales'],
            ['id' => 2, 'name' => 'Servicios Martínez'],
            ['id' => 3, 'name' => 'Comercial López'],
            ['id' => 4, 'name' => 'Suministros García'],
            ['id' => 5, 'name' => 'Productos Fernández'],
            ['id' => 6, 'name' => 'Importaciones Pérez'],
            ['id' => 7, 'name' => 'Logística Gómez'],
            ['id' => 8, 'name' => 'Ventas Ruiz'],
            ['id' => 9, 'name' => 'Comercial Ortega'],
            ['id' => 10, 'name' => 'Proveedores Sánchez'],
        ];
        $Navigation = $this->Navigation;

        return view('inventory_management.product_stock_entry', compact('Navigation', 'Suppliers'));

    }
    public function supplierProductList(Request $request)
    {

        $idData = validator::make(
            $request->all(),
            [
                'id' => 'required|size:5',
            ]
        );

        $id = $request->input('id');
        if ($id == 1) {
            $produc = [
                [
                    'id' => 1,
                    'name' => 'Pollo entero',
                    'quantity' => 100, // en unidades
                    'price_per_unit' => 12.00 // en moneda local
                ],
                [
                    'id' => 2,
                    'name' => 'Papas',
                    'quantity' => 500, // en kilogramos
                    'price_per_unit' => 1.50 // en moneda local
                ],
            ];
        } else if ($id == 2) {
            $produc = [
                [
                    'id' => 5,
                    'name' => 'Pimienta',
                    'quantity' => 20, // en kilogramos
                    'price_per_unit' => 5.00 // en moneda local
                ],
                [
                    'id' => 6,
                    'name' => 'Ajo',
                    'quantity' => 100, // en kilogramos
                    'price_per_unit' => 4.00 // en moneda local
                ],
                [
                    'id' => 7,
                    'name' => 'Ají panca',
                    'quantity' => 80, // en kilogramos
                    'price_per_unit' => 6.00 // en moneda local
                ]
            ];
        } else if ($id == 3) {
            $produc = [
                [
                    'id' => 9,
                    'name' => 'Culantro',
                    'quantity' => 50, // en manojos
                    'price_per_unit' => 2.00 // en moneda local
                ],
                [
                    'id' => 10,
                    'name' => 'Vinagre',
                    'quantity' => 150, // en litros
                    'price_per_unit' => 2.50 // en moneda local
                ]
            ];
        } else if ($id == 4) {
            $produc = [
                [
                    'id' => 4,
                    'name' => 'Sal',
                    'quantity' => 50, // en kilogramos
                    'price_per_unit' => 0.50 // en moneda local
                ],
                [
                    'id' => 5,
                    'name' => 'Pimienta',
                    'quantity' => 20, // en kilogramos
                    'price_per_unit' => 5.00 // en moneda local
                ],
                [
                    'id' => 6,
                    'name' => 'Ajo',
                    'quantity' => 100, // en kilogramos
                    'price_per_unit' => 4.00 // en moneda local
                ],
                [
                    'id' => 7,
                    'name' => 'Ají panca',
                    'quantity' => 80, // en kilogramos
                    'price_per_unit' => 6.00 // en moneda local
                ],
                [
                    'id' => 8,
                    'name' => 'Comino',
                    'quantity' => 30, // en kilogramos
                    'price_per_unit' => 7.00 // en moneda local
                ],
                [
                    'id' => 9,
                    'name' => 'Culantro',
                    'quantity' => 50, // en manojos
                    'price_per_unit' => 2.00 // en moneda local
                ]
            ];
        } else {
            $produc = [
                [
                    'id' => 1,
                    'name' => 'Pollo entero',
                    'quantity' => 100, // en unidades
                    'price_per_unit' => 12.00 // en moneda local
                ],
                [
                    'id' => 2,
                    'name' => 'Papas',
                    'quantity' => 500, // en kilogramos
                    'price_per_unit' => 1.50 // en moneda local
                ],
                [
                    'id' => 3,
                    'name' => 'Aceite vegetal',
                    'quantity' => 200, // en litros
                    'price_per_unit' => 3.00 // en moneda local
                ],
                [
                    'id' => 4,
                    'name' => 'Sal',
                    'quantity' => 50, // en kilogramos
                    'price_per_unit' => 0.50 // en moneda local
                ],
                [
                    'id' => 5,
                    'name' => 'Pimienta',
                    'quantity' => 20, // en kilogramos
                    'price_per_unit' => 5.00 // en moneda local
                ],
                [
                    'id' => 6,
                    'name' => 'Ajo',
                    'quantity' => 100, // en kilogramos
                    'price_per_unit' => 4.00 // en moneda local
                ],
                [
                    'id' => 7,
                    'name' => 'Ají panca',
                    'quantity' => 80, // en kilogramos
                    'price_per_unit' => 6.00 // en moneda local
                ],
                [
                    'id' => 8,
                    'name' => 'Comino',
                    'quantity' => 30, // en kilogramos
                    'price_per_unit' => 7.00 // en moneda local
                ],
                [
                    'id' => 9,
                    'name' => 'Culantro',
                    'quantity' => 50, // en manojos
                    'price_per_unit' => 2.00 // en moneda local
                ],
                [
                    'id' => 10,
                    'name' => 'Vinagre',
                    'quantity' => 150, // en litros
                    'price_per_unit' => 2.50 // en moneda local
                ]
            ];
        }

        // Devuelve los productos como una respuesta JSON
        return response()->json($produc);
    }
    public function listOfProducts()
    {
        $product = [
            [
                'id' => 1,
                'name' => 'Pollo',
            ],
            [
                'id' => 2,
                'name' => 'Carne de Res',
            ],
            [
                'id' => 3,
                'name' => 'Pescado',
            ],
            [
                'id' => 4,
                'name' => 'Cerdo',
            ],
            [
                'id' => 5,
                'name' => 'Pavo',
            ],
            [
                'id' => 6,
                'name' => 'Cordero',
            ],
            [
                'id' => 7,
                'name' => 'Salchichas',
            ],
            [
                'id' => 8,
                'name' => 'Hamburguesas',
            ],
            [
                'id' => 9,
                'name' => 'Tacos',
            ],
            [
                'id' => 10,
                'name' => 'Costillas',
            ],
        ];
        return response()->json($product);
    }
    public function anchorProductProvider(Request $request)
    {
        $idData = validator::make(
            $request->all(),
            [
                'supplierId' => 'required',
                'productId' => 'required',
            ]
        );

        $productId = $request->input('productId');
        $supplierId = $request->input('supplierId');
        if($productId != "null"){
            $reply = [

                'producto' => $productId,
                'provedor' => $supplierId,
                'mensage' => 'Totos los productos fueron registrados con exito'

            ];
        }else{
            $reply = [

                'producto' => $productId,
                'provedor' => $supplierId,
                'mensage' => 'El registro no se pude realizar'

            ];
        }

        return response()->json($reply);

    }
    public function registerProductEntry(Request $request)
    {
        // Obtén los datos del request
        $data = $request->all();

        // Inicializa un array para almacenar los ítems formateados
        $items = [];

        // Verifica que las claves 'id', 'quantity', 'price' y 'total_amount' existan en los datos
        if (isset($data['id']) && isset($data['quantity']) && isset($data['price']) && isset($data['total_amount'])) {
            // Recorre cada ítem y crea el formato deseado
            foreach ($data['id'] as $index => $id) {
                $items[] = [
                    'id' => $id,
                    'quantity' => $data['quantity'][$index],
                    'price' => $data['price'][$index],
                    'total_amount' => $data['total_amount'][$index]
                ];
            }
        }

        // Reorganiza los datos en el formato requerido
        $formattedItems = [];
        foreach ($items as $index => $item) {
            $formattedItems["iten-" . str_pad($index + 1, 2, '0', STR_PAD_LEFT)] = $item;
        }
        $formattedData = [
            '_token' => $data['_token'] ?? '',
            'supplier_id' => $data['supplier_id'] ?? '',
            'comment' => $data['comment'] ?? '',
            'items' => $formattedItems
        ];
        // Imprime los datos formateados (puedes devolverlos como respuesta o hacer otras operaciones)
        return response()->json($formattedData);
    }
}
