$(document).ready(function() {
    $('#checkbox-preference-input').change(function() {
        updateLabelColor();
    });
});
selectorItenandAnimation('selected-unit-of-measurement-product-new', 'options-unit-of-measurement-product-new', 'option-unit-of-measurement-product-new', 'sub-title-div','option-unit-of-measurement-product-new');


$(function() {
    $('#switch-data').change(function() {
        $('#stock-data').prop('disabled', !this.checked)
            .css({
                'background-color': this.checked ? '' : 'var(--color-input-background-border)',
                'border': this.checked ? '' : 'var(--color-input-background-border)'
            });
    }).change();
});

let listo = false;
$('input').on('input change', function() {
    const nombre = $('input[name="name"]').val().trim();
    const sistema = $('input[name="measurement_system"]:checked').val();
    if (nombre && sistema && !listo) {
        $('.register-or-edit').css('display', 'block');
        $('.cancel-btn').css({
            'border-top-right-radius': '0vh',
            'border-bottom-right-radius': '0vh'
        });
        listo = true;
    } else if (!nombre) {
        $('.register-or-edit').css('display', 'none');
        $('.cancel-btn').css({
            'border-top-right-radius': '2vh',
            'border-bottom-right-radius': '2vh'
        });
        listo = false;
    }
});

function exit(){
    history.back();
}
