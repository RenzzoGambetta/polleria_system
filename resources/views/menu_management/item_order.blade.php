<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($MenuTable) }}">
<link rel="stylesheet" href="{{ asset($ItemOrder) }}">
@csrf

<div class="header">
    <div class="left">
        <h1 id="title">{{ $Data['Title'] }}</h1>
        <ul class="breadcrumb">
            <a href="{{ route('menu') }}" class="sub-link">
                Menu
            </a>
            <li>
                /
            </li>
            <a href="{{ route('category_carte') }}" class="sub-link">
                Cartas
            </a>
            <li>
                /
            </li>
            <a href="{{ route('show_order_item') }}?category_id={{ $Data['Id'] }}" class="active">
                Carta {{ $Data['Title'] }}
            </a>

        </ul>
    </div>
</div>
<div class="option-data">
    <button type="button" class="new-item-btn" onclick="urlGet('{{ route('registro_menu') }}',{'direction':'cart','id':{{ $Data['Id'] }}})">Nuevo Item</button>
    <button type="button" class="oreden-btn" onclick="saveOrder()">Guardar Orden</button>
</div>
<div class="container-item" id="container">
    @foreach ($Item as $Items)
        <div class="item-data" id="{{ $Items->id }}" data-order="{{ $Items->display_order }}">
            <span class="order-number">{{ $Items->display_order }}</span>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFd45svOiyV8P9xIMiBH2FwNyr9r4w74-Tfw&s" alt="{{ $Items->display_order }}.png" draggable="false">
            <div class="item-data-info">
                <h2>{{ $Items->name }}</h2>
                <p class="price">Precio: S/. {{ $Items->price }}</p>
            </div>
        </div>
    @endforeach

</div>
<script src="{{ $DragAndDrop }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let order = [];
    const container = document.getElementById('container');

    Sortable.create(container, {
        animation: 150,
        onStart: function(evt) {
            evt.item.classList.add('dragging');
        },
        onEnd: function(evt) {
            evt.item.classList.remove('dragging');
            updateOrderNumbers();
        }
    });

    function updateOrderNumbers() {
        const items = container.querySelectorAll('.item-data');
        items.forEach((item, index) => {
            const orderNumber = item.querySelector('.order-number');
            orderNumber.textContent = index + 1;
            item.setAttribute('data-order', index + 1);
        });
        $('.oreden-btn').css('background-color', '#cf5400');
    }

    function saveOrder() {
        const items = container.querySelectorAll('.item-data');
        order = Array.from(items).map(item => ({
            id: item.id,
            display_order: item.getAttribute('data-order'),
        }));
        sectionData();
    }
    async function sectionData() {
        var csrfToken = document.querySelector('input[name="_token"]').value;

        var orderObject = order.reduce((acc, item) => {
            acc[item.id] = item.display_order;
            return acc;
        }, {});
        alertTime('Estamos guardando...','Los cambios se guardaran en <b></b> milisegundos',1500)
        fetch('/edit_to_order_item', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(orderObject)
            })
            .then(response => response.json())
            .then(data => $('.new-item').hide())
            .catch(error => console.error('Error:', error));
            $('.oreden-btn').css('background-color', '#88807a');
    }

    function alertTime(title, subTitle, time) {
        let timerInterval;
        Swal.fire({
            title: title,
            html: subTitle,
            timer: time,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                    timer.textContent = `${Swal.getTimerLeft()}`;
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log("I was closed by the timer");
            }
        });
    }
</script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
