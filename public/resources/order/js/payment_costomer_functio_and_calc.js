const searchBox1 = new SearchBoxClient('No se encuntro el Cliente...', '.search-box-data-client', '#search-client', '#search-label-client', '.suggestions-client', '#id-waiter-client', '/client_data_filt', 5, 0);
var quantityAlertLenghtDocument, totalPaymentClient, optionTypePayment = 'efectivo', optionTypePaymentGroup = 1, isActiveCombinePayment = false, isEfectivoOption = false;
const URL_TEMPLATE = "/resources/order/template/";
const URL_TEMPLATE_TIKET = "/resources/document/template/";
let timerInterval, typeFactureGlobal = 'nota';
let pdfData;
let itemPaySelect = items;

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
        var inputValue = parseFloat($(this).val()) || 0; // Aseguramos que sea numérico
        var calc = 0; // Inicializamos el cálculo

        if (optionTypePaymentGroup === 1) {
            calc = inputValue - (totalPaymentClient || 0); // Calculamos para el grupo 1
        } else if (optionTypePaymentGroup === 3) {
            var targetInput = parseFloat($('input[name="input-payment-option-2"]').val()) || 0;
            calc = (inputValue + targetInput) - (totalPaymentClient || 0); // Calculamos para el grupo 3
        }

        $('#return-money-client').text((calc).toFixed(2)); // Actualizamos el resultado
    });
});

$(document).ready(function () {
    var inputValue = 0; // Inicializamos como número
    $('input[name="input-payment-option-2"]').on('input', function () {
        inputValue = parseFloat($(this).val()) || 0; // Convertimos a número o usamos 0 si está vacío

        if (optionTypePaymentGroup === 3) {
            var targetInput = parseFloat($('input[name="input-total-payment"]').val()) || 0; // Aseguramos que sea un número
            var calc = ((inputValue + targetInput) - (totalPaymentClient || 0)); // totalPaymentClient se inicializa como 0 si es undefined
            $('#return-money-client').text((calc).toFixed(2)); // Mostramos el resultado
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
function clearOptionDataClient() {
    $("input[name='id_person']").val('');
    $("input[name='document_and_name_to_person']").val('');
}
async function newRegisterClientData(data = null) {
    const url = `${URL_TEMPLATE}new_client_register.html`;
    const htmlContent = await loadHtmlFromFile(url);

    Swal.fire({
        html: htmlContent,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Registrar",
        didOpen: (popup) => {
            if (typeof urlPostDeleteStyle === 'function') {
                urlPostDeleteStyle(popup);
            }
            $(popup).find('.swal2-close').css('display', 'block');

            $(document).ready(function () {

                $('#document_number_client').on('keydown', function (e) {
                    if (e.key === 'Enter') {
                        documentSearchApi()
                        $('#firstname_client').focus();
                    }
                });

                if (typeFactureGlobal != 'factura') {
                    $('#firstname_client').on('keydown', function (e) {
                        if (e.key === 'Enter') {
                            if (quantityAlertLenghtDocument == 11) {
                                $('.swal2-confirm').click()
                            } else {
                                $('#lastname_client').focus();
                            }
                        }
                    });

                    setupEnterFocusChange('#lastname_client', '#', true)
                    setupEnterFocusChange('#birthdate_client', '#phone_client');
                    setupEnterFocusChange('#phone_client', '#email_client');
                    setupEnterFocusChange('#email_client', '#', true)
                } else {
                    setupEnterFocusChange('#firstname_client', '#', true)
                    setupEnterFocusChange('#phone_client', '#email_client');
                    setupEnterFocusChange('#email_client', '#', true);
                    $('#div-lastname-client-alert').hide();
                    $('#gender-option-client-data').hide();
                    $('#birthdate-client-data').hide();
                    $('#phone-client-data-frame').css('margin', '20px 40px');
                    $('#text-data-document').text('RUC');
                }

            });

            if (data && data.document) {
                $(popup).find('#document_number_client').val(data.document);
                $(popup).find('.seach-document-to-data').hide();
                Swal.showValidationMessage(data.message);
                console.log(data.document)
            }


        },
        preConfirm: () => {
            const document = $('#document_number_client').val().trim();
            const name = $('#firstname_client').val().trim();
            const lastName = $('#lastname_client').val().trim();
            const digitCount = /^\d+$/.test(document) ? document.length : null;
            if (digitCount == 11) var portValidate = false;
            else var portValidate = !lastName;

            if (!document || !name || portValidate) {


                Swal.showValidationMessage("Por favor, ingresa los campose obligatorios.");

                $('#document_number_client').css('border-color', '#b5b5b5');
                $('#firstname_client').css('border-color', '#b5b5b5');

                if (!document) $('#document_number_client').css('border-color', 'red');
                if (!name) $('#firstname_client').css('border-color', 'red');
                if (digitCount != 11) {
                    $('#lastname_client').css('border-color', '#b5b5b5');
                    if (!lastName) $('#lastname_client').css('border-color', 'red');
                }
                return false;
            }
            return {
                option: 'create',
                document,
                name,
                lastname: lastName,
                birthdate: $('#birthdate_client').val() || null,
                phone: $('#phone_client').val() || null,
                email: $('#email_client').val() || null,
                gender: $('input[name="gender_client"]:checked').val() || null
            };
        }
    }).then(async (result) => {
        if (result.isConfirmed && result.value) {
            const data = await consultDataPost("/register_new_person_data_base", result.value);
            console.log(data);
            if (data.status) {
                $('input[name="id_person"]').val(data.id);
                $('input[name="document_and_name_to_person"]').val(data.name_compact);
            } else {
                console.log(data);
            }
        } else {

        }
    });
}
function limitInputLength(input, maxLength, documentLimit = false) {
    if (input.value.length > maxLength) {
        input.value = input.value.slice(0, maxLength);
    }
    if (documentLimit && typeFactureGlobal != 'factura') {

        if (input.value.length == 11) { $("#div-lastname-client-alert").fadeOut(400); }
        else $("#div-lastname-client-alert").fadeIn(600);
        quantityAlertLenghtDocument = input.value.length;
    }
}
async function documentSearchApi() {
    const document = $('#document_number_client').val().trim();

    if (document.length === 8 && !isNaN(document) && typeFactureGlobal != 'factura') {
        try {
            const data = await consultDataPost("/fetch_client_data", { type: 'dni', document });
            if (data.status) {
                $('#firstname_client').val(data.name || '');
                $('#lastname_client').val(
                    `${data.paternal_surname || ''} ${data.maternal_surname || ''}`.trim()
                );
                if (!data.response) Swal.showValidationMessage(data.message || 'No se encontró información para el DNI ingresado.');
            }
        } catch (error) {
            Swal.showValidationMessage('Error al consultar el DNI. Intente nuevamente.');
            console.error(error);
        }
    } else if (document.length === 11 && !isNaN(document)) {
        try {
            const data = await consultDataPost("/fetch_client_data", { type: 'ruc', document });
            if (data.status) {
                $('#firstname_client').val(data.name || '');
                $('#lastname_client').val(
                    `${data.paternal_surname || ''} ${data.maternal_surname || ''}`.trim()
                );
                if (!data.response) Swal.showValidationMessage(data.message || 'No se encontró información para el RUC ingresado.');
            }

        } catch (error) {
            Swal.showValidationMessage('Error al consultar el RUC. Intente nuevamente.');
            console.error(error);
        }
    } else {
        $('#firstname_client').val('');
        $('#lastname_client').val('');
        if (typeFactureGlobal == 'factura') {
            Swal.showValidationMessage(
                'El documento ingresado no coincide con el RUC (11 dígitos).'
            );
        } else {
            Swal.showValidationMessage(
                'El documento ingresado no coincide con los formatos de DNI (8 dígitos) o RUC (11 dígitos).'
            );
        }
    }
}

function setupEnterFocusChange(sourceId, targetId, alertConfirm = false) {
    $(sourceId).on('keydown', function (e) {
        if (e.key === 'Enter') {
            if (alertConfirm) $('.swal2-confirm').click()
            else $(targetId).focus();
        }
    });
}

$(document).on('click', function (event) {
    if (!$(event.target).closest('#search-client').length && !$(event.target).closest('#suggestions').length) {
        searchBox1.setStatusDivOpen(0);
    }
});

$('#search-client').on('focus', function () {
    $('#suggestions').addClass('open');
    searchBox1.setStatusDivOpen(1);
});
function autoCompletionDataInputField(id, name_compact) {
    $('input[name="id_person"]').val(id);
    $('input[name="document_and_name_to_person"]').val(name_compact);
}

function showAlert(message = 'Mensaje de prueba', duration = 10) {
    const $alertContainer = $('#alert-container');
    const $timerElement = $('#timer');
    const $messageElement = $('#alert-message');

    if ($alertContainer.is(':visible')) {
        clearInterval(timerInterval);
        $timerElement.text(`${duration}s`);
    } else {
        $alertContainer.fadeIn(200);
    }

    $messageElement.text(message);

    let timeLeft = duration;
    $timerElement.text(`${timeLeft}s`);

    timerInterval = setInterval(() => {
        timeLeft--;
        $timerElement.text(`${timeLeft}s`);
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            $alertContainer.fadeOut(200);
        }
    }, 1000);
}
$(document).ready(function () {

    $('input[name="toggle"]').on('change', function () {
        const selectedValue = $(this).val();
        typeFactureGlobal = selectedValue;
        searchBox1.setValueTypeFacture(typeFactureGlobal);
        $('#search-client').val('');
        $('#search-client').css('border','2px solid var(--color-input-background-border)');
        
    });
});

async function payBill() {

    $('#pay-bill').fadeOut(100);
    let timerInterval;
    const nameClient = $('#search-client').val();
    const idClient = $('#id-waiter-client').val() || 0;
    const cashPaid = $('input[name="input-total-payment"]').val() || totalPaymentClient;
    const anotherPaymentMethod = $('input[name="input-payment-option-2"]').val() || 0;
    const primaryTotalPayment = parseFloat($('#primary-total-payment').text()) || 0;
    const returnMoneyClient = parseFloat($('#return-money-client').text()) || 0;
    const idTable = $('input[name="id_table"]').val();
    Data = {
        idTable: idTable,
        optionPayment: optionTypePayment,
        typeFacture: typeFactureGlobal,
        nameClient: nameClient,
        idClient: idClient,
        cashPaid: cashPaid,
        anotherPaymentMethod: anotherPaymentMethod,
        primaryTotalPayment: primaryTotalPayment,
        returnMoneyClient: returnMoneyClient,
        items: itemPaySelect
    }

    try {
        Swal.fire({
            title: "Cargando...",
            html: "<b></b> segundos restantes",
            timer: 5000, // Ajusta el tiempo de carga si es necesario
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector('b');

                if (timer) {
                    timerInterval = setInterval(() => {
                        if (timer) { // Verifica si el elemento sigue existiendo
                            timer.textContent = `${Math.ceil(Swal.getTimerLeft() / 1000)} segundos restantes`;
                        }
                    }, 1000);
                }
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        });


        const Tiket = await consultDataPost('/tiket_cancel_client', Data);

        if (!Tiket) {
            throw new Error('No se pudieron obtener los datos del tiket.');
        }

        const { jsPDF } = window.jspdf;

        const response = await fetch(URL_TEMPLATE_TIKET + "document-type-data-gender.html");
        let templateHtml = await response.text();

        templateHtml = replacePlaceholders(templateHtml, {
            ruc: Tiket.dataCompany.ruc,
            phone: Tiket.dataCompany.phone,
            address: Tiket.dataCompany.address,
            typeDocument: Tiket.dataDocument.typeDocument,
            salesNumber: Tiket.dataDocument.salesNumber,
            dateOfIssue: Tiket.dataDocument.dateOfIssue,
            timeOfIssue: Tiket.dataDocument.timeOfIssue,
            areaOfAttention: Tiket.dataDocument.areaOfAttention,
            nameClient: Tiket.dataClient.nameClient,
            documentClient: Tiket.dataClient.documentClient,
            documentClientType: Tiket.dataClient.documentClientType,
            optionPayment: Tiket.dataPayment.optionPayment,
            typeFacture: Tiket.dataPayment.typeFacture,
            cashPaid: Tiket.dataPayment.cashPaid || 0,
            anotherPaymentMethod: Tiket.dataPayment.anotherPaymentMethod,
            primaryTotalPayment: Tiket.dataPayment.primaryTotalPayment || 0,
            totalPayment: Tiket.dataPayment.totalPayment || 0,
            returnMoneyClient: Tiket.dataPayment.returnMoneyClient || 0,
            textCashPaid: Tiket.dataPayment.textCashPaid,
            opGravada: Tiket.dataPayment.opGravada || 0,
            opExonerada: Tiket.dataPayment.opExonerada || 0,
            igb: Tiket.dataPayment.igb || 0
        });

        const tableRows = Tiket.items.map(item => `
            <tr>
                <td>${item.name}</td>
                <td class="right">${item.quantity}</td>
                <td class="right">${item.price}</td>
                <td class="right">${item.total_price}</td>
            </tr>
        `).join('');


        templateHtml = templateHtml.replace(
            '<tr id="items-all-data"></tr>',
            tableRows
        );

        const container = document.querySelector('main');
        if (!container) {
            throw new Error('El contenedor con la clase "container-item-data" no existe en el DOM.');
        }

        const tempDiv = document.createElement('div');
        tempDiv.classList.add('frame-tiket');
        tempDiv.innerHTML = templateHtml;
        container.appendChild(tempDiv);

        const pdfWidth = 80;
        const pdfHeight = tempDiv.offsetHeight * (pdfWidth / tempDiv.offsetWidth);

        const pdf = new jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: [pdfWidth, pdfHeight]
        });

        const canvas = await html2canvas(tempDiv, {
            scale: 2,
            useCORS: true
        });
        pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, pdfWidth, pdfHeight);


        container.removeChild(tempDiv);
        // Generar blob del PDF
        const pdfBlob = pdf.output('blob');
        pdfData = {
            pdf: pdfBlob,
            title: Tiket.dataDocument.typeDocument
        };
        const pdfUrl = URL.createObjectURL(pdfBlob);

        // pdf.save(`D-Brazza-${Tiket.dataDocument.salesNumber}.pdf`); 

        let htmlContent = `
        <style>
            .swal2-popup.swal2-modal.swal2-show {
            width: 80%;
            }
            samp.title-alert-docuement {
                font-size: 1.4rem;
                font-family: monospace;
            }
            div#swal2-html-container {
                margin-top: 13px;
            }
        </style>
        
        <samp  class="title-alert-docuement">${Tiket.dataDocument.typeDocument}</samp>
        <iframe id="pdfFrame" src="" frameborder="1"></iframe>
        <div class="button-action-alet-document">
            <button class="print-ticket" onclick="printTicket()">Inprimir</button>
            <button class="send-whatsapp">Envir whatsapp</button>
            <button class="send-mail">Enviar Gmail</button>
        </div>
        `;
        await Swal.fire({
            html: htmlContent,
            showConfirmButton: false,
            showCancelButton: false,
            didOpen: (popup) => {
                if (typeof urlPostDeleteStyle === 'function') {
                    urlPostDeleteStyle(popup);
                }
                $('div#swal2-html-container').css('padding', '13px 0 0 0');
                $('.continue-button').remove();
                $('.option-edit-list-order').remove();
                $('.button-container-list').append('<button class="option-add-order-to-client" title="Agregar orden al cliente"><i class="fi fi-ss-shopping-cart-add center-icon"></i>Agregar</button>');
                $(popup).find('.swal2-close').css('display', 'block');
                $('div:where(.swal2-container).swal2-center > .swal2-popup').css('grid-row', '1');

                const pdfFrame = document.getElementById('pdfFrame');
                if (!pdfFrame) {
                    throw new Error('El elemento #pdfFrame no se encontró en el DOM.');
                }

                // Asignar el URL al iframe
                pdfFrame.src = pdfUrl;
            },

        })


    } catch (error) {
        console.error('Error al generar el PDF:', error);
        alert('Hubo un error al generar el PDF. Revise la consola para más detalles.');
    }

    setTimeout(function () {
        $('#remember-account').fadeIn(100);
    })
}


function replacePlaceholders(template, data, defaultValue = 'Anónimo') {
    for (const [key, value] of Object.entries(data)) {
        template = template.replace(new RegExp(`{{${key}}}`, 'g'), value ?? defaultValue);
    }
    return template;
}
async function refrehtPdf() {

    const pdfUrl = URL.createObjectURL(pdfData.pdf);
    let htmlContent = `
    <style>
        .swal2-popup.swal2-modal.swal2-show {
        width: 80%;
        }
        samp.title-alert-docuement {
            font-size: 1.4rem;
            font-family: monospace;
        }
        div#swal2-html-container {
            margin-top: 13px;
        }

    </style>
    
    <samp  class="title-alert-docuement">${pdfData.title}</samp>
    <div class="button-action-alet-document">
        <button class="print-ticket" onclick="printTicket()">Inprimir</button>
        <button class="send-whatsapp">Envir whatsapp</button>
        <button class="send-mail">Enviar Gmail</button>
    </div>
    `;
    await Swal.fire({
        html: htmlContent,
        showConfirmButton: false,
        showCancelButton: false,
        didOpen: (popup) => {
            if (typeof urlPostDeleteStyle === 'function') {
                urlPostDeleteStyle(popup);
            }
            $('div#swal2-html-container').css('padding', '13px 0 0 0');
            $('.continue-button').remove();
            $('.option-edit-list-order').remove();
            $('.button-container-list').append('<button class="option-add-order-to-client" title="Agregar orden al cliente"><i class="fi fi-ss-shopping-cart-add center-icon"></i>Agregar</button>');
            $(popup).find('.swal2-close').css('display', 'block');
            $('div:where(.swal2-container).swal2-center > .swal2-popup').css('grid-row', '1');

            const pdfFrame = document.getElementById('pdfFrame');
            if (!pdfFrame) {
                throw new Error('El elemento #pdfFrame no se encontró en el DOM.');
            }

            // Asignar el URL al iframe
            pdfFrame.src = pdfUrl;
        },

    })

}
function printTicket(){
    const pdfFrame = document.getElementById('pdfFrame');
    if (pdfFrame) {
        pdfFrame.contentWindow.print();
    } else {
        console.error('El elemento #pdfFrame no se encontró en el DOM.');
    }
}