require('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css');

require('eonasdan-bootstrap-datetimepicker');

var opDefault = {
    locale: 'es',
    showTodayButton: true,
    showClear: true,
    showClose: true,
    useCurrent: false,
    disabledHours: [0,1,2,3,4,5,22,23],
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        today: "fa fa-calendar-check-o",
        clear: "fa fa-trash-o",
        close: "fa fa-window-close-o"
    },
    tooltips: {
        today: 'Hoy',
        clear: 'Limpiar',
        close: 'Cerrar',
        selectTime: 'Seleccionar hora',
        incrementHour: 'Aumentar hora',
        incrementMinute: 'Aumentar minuto',
        decrementHour: 'Disminuir hora',
        decrementMinute: 'Disminuir minuto',
        pickHour: 'Seleccionar hora',
        pickMinute: 'Seleccionar minuto',
        selectMonth: 'Seleccionar mes',
        prevMonth: 'Mes anterior',
        nextMonth: 'Siguiente mes',
        selectYear: 'Seleccionar año',
        prevYear: 'Año anterior',
        nextYear: 'Siguiente año',
        selectDecade: 'Seleccionar década',
        prevDecade: 'Década anterior',
        nextDecade: 'Siguiente década',
        prevCentury: 'Siglo anterior',
        nextCentury: 'Siguiente siglo'
    }
};

var opDateTime = {
    format: 'YYYY-MM-DD HH:mm'
};

$.extend(opDateTime, opDefault);

var opDate = {
    format: 'YYYY-MM-DD'
};

$.extend(opDate, opDefault);

var opTime = {
    format: 'HH:mm'
};

$.extend(opTime, opDefault);

$(function() {
    $('#main').find('form input[data-widget=datepicker]').datetimepicker(opDate);
});

$(function() {
    $('#main').find('form input[data-widget=timepicker]').datetimepicker(opTime);
});

$(function() {
    $('#main').find('form input[data-widget=datetimepicker]').datetimepicker(opDateTime);
});
