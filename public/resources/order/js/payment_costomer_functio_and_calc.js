new SearchBoxClient('No se encuntro el Cliente...', '.search-box-data-client', '#search-client', '#search-label-client', '.suggestions-client', '#id-waiter-client', '/client_data_filt', 5, 0);
var totalPaymentClient, optionTypePayment = 'efectivo', optionTypePaymentGroup = 1, isActiveCombinePayment = false, isEfectivoOption = false;
totalPaymentClientVal()

$(document).ready(function () {
    $('.amount-button').on('click', function () {
        var amount = $(this).data('amount');
        var input = $('input[name="input-total-payment"]');
        var currentValue = parseInt(input.val()) || 0;

        if ([10, 20, 50, 100, 200].includes(currentValue)) {
            input.val(currentValue + amount);
        } else {
            input.val(amount);
        }
        calcPriceReturn(input)
    });
});

function totalPaymentClientVal() {
    var totalPayment = $('#primary-total-payment').text();
    totalPaymentClient = parseFloat(totalPayment.replace(/[^0-9.-]+/g, ''));
}

function calcPriceReturn(input) {
    var amountClient = parseInt(input.val()) || 0;
    var calc = amountClient - totalPaymentClient;
    $('#return-money-client').text(calc);
}
$(document).ready(function () {
    $('input[name="input-total-payment"]').on('input', function () {
        var inputValue = parseInt($(this).val()) || 0; // Aseguramos que sea numérico
        var calc = 0; // Inicializamos el cálculo

        if (optionTypePaymentGroup === 1) {
            calc = inputValue - (totalPaymentClient || 0); // Calculamos para el grupo 1
        } else if (optionTypePaymentGroup === 3) {
            var targetInput = parseInt($('input[name="input-payment-option-2"]').val()) || 0;
            calc = (inputValue + targetInput) - (totalPaymentClient || 0); // Calculamos para el grupo 3
        }

        $('#return-money-client').text(calc); // Actualizamos el resultado
    });
});

$(document).ready(function () {
    var inputValue = 0; // Inicializamos como número
    $('input[name="input-payment-option-2"]').on('input', function () {
        inputValue = parseInt($(this).val()) || 0; // Convertimos a número o usamos 0 si está vacío

        if (optionTypePaymentGroup === 3) {
            var targetInput = parseInt($('input[name="input-total-payment"]').val()) || 0; // Aseguramos que sea un número
            var calc = (inputValue + targetInput) - (totalPaymentClient || 0); // totalPaymentClient se inicializa como 0 si es undefined
            $('#return-money-client').text(calc); // Mostramos el resultado
        }
    });
});

function selectOptionTypePayment(type, option) {
    $(".cash-register-amount-input").val('');
    $('#return-money-client').text('0');

    if (isActiveCombinePayment) {
        isActiveCombinePayment = false;
        setActiveButtonTypePayment('mixto', 3, type);
    } else {
        $("#combine-type-payment-button").css("background-color", "#d85700");
        if (option == 1) {
            $("#frame-efectivo-type").fadeIn(200);
            $("#frame-efectivo-fast").fadeIn(200);
            $("#type-data-form-sub-payment").hide();
            $("#button-option-type-payment").css({
                "border-bottom-left-radius": "0px",
                "border-bottom-right-radius": "0px"
            });
            $("#sub-title-efectivo-mount").text('INGRESE MONTO');
        } else if (option == 2) {
            $("#frame-efectivo-type").fadeOut(200);
            $("#frame-efectivo-fast").fadeOut(200);
            $("#button-option-type-payment").css({
                "border-bottom-left-radius": "10px",
                "border-bottom-right-radius": "10px"
            });
        }
        setActiveButtonTypePayment(type, option);
    }
}
function setActiveButtonTypePayment(type, option, subType = null) {
    if (option != 3) {
        $(".button-type-payment").removeClass("active");
        $("#" + type).addClass("active");
        $("input[name='input-sub-type-payment']").val('');

    } else {
        if (isEfectivoOption && subType == "efectivo") {
            isActiveCombinePayment = true;
            return;
        }
        $("#" + subType).addClass("active");
        if (subType != "efectivo") {
            $("input[name='input-sub-type-payment']").val(subType);
            $("#sub-title-type-payment-option").text(subType);
        } else {
            $("input[name='input-sub-type-payment']").val(optionTypePayment);
            $("#sub-title-type-payment-option").text(optionTypePayment);
        }
        isEfectivoOption = false;
    }
    if (option == 3) {
        $("#loader-option-combine-payment").fadeOut(200);
        $("#type-data-form-sub-payment").show();
        $("#sub-title-efectivo-mount").text('Monto en efectivo');
        setTimeout(function () {
            $("#frame-efectivo-type").fadeIn(600);
            $("#frame-efectivo-fast").fadeIn(400);
        }, 500);
    }

    $("input[name='input-type-payment']").val(type);
    $("input[name='input-type-payment-group']").val(option);
    optionTypePayment = type;
    optionTypePaymentGroup = option;
    //console.log(option);
}
function combinePaymentType() {
    if (optionTypePaymentGroup == 3) {
        return;
    }
    var subOptionTypePaymentGroup = optionTypePaymentGroup;
    isActiveCombinePayment = true;
    if (subOptionTypePaymentGroup != 1) {
        $("input[name='input-sub-type-payment']").val(optionTypePayment);
        isEfectivoOption = false;
        selectOptionTypePayment('efectivo', 1)
    } else {
        $("#frame-efectivo-type").fadeOut(400);
        $("#frame-efectivo-fast").fadeOut(400);
        setTimeout(function () {
            $("#loader-option-combine-payment").fadeIn(600);
        }, 500);
        isEfectivoOption = true;
    }
    $("#combine-type-payment-button").css("background-color", "#d80000");
}
function clearOptionDataClient(){
    $("input[name='id_person']").val('');
    $("input[name='document_and_name_to_person']").val('');    
}
function newRegisterClientData(){
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Something went wrong!",
        footer: '<a href="#">Why do I have this issue?</a>'
      });
}