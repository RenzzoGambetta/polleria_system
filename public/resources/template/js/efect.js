$(document).ready(function() {
    const links = $('.submenu-toggle');

    links.each(function() {
        $(this).on('click', function(event) {
            if ($(this).attr('id') === 'accion') {
                links.each(function() {
                    if ($(this).hasClass('inac')) {
                        $(this).removeClass('inac').addClass('acti');
                    }
                });
                return;
            }

            if ($(this).hasClass('acti')) {
                event.preventDefault();
            }

            links.each(function() {
                if ($(this).hasClass('inac')) {
                    $(this).removeClass('inac').addClass('acti');
                }
            });

            $(this).removeClass('acti').addClass('inac');
        });
    });
});
