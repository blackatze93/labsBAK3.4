require('qtip2/dist/jquery.qtip.css');
require('fullcalendar/dist/fullcalendar.css');
require('fullcalendar-scheduler/dist/scheduler.css');

require('qtip2');
require('fullcalendar');
require('fullcalendar/dist/locale/es');
require('fullcalendar-scheduler');

$(function () {
    var tooltip = $('<div/>').qtip({
        id: 'fullcalendar',
        prerender: true,
        overwrite: true,
        content: {
            text: ' ',
            title: {
                button: true
            }
        },
        position: {
            my: 'bottom center',
            at: 'top center',
            target: 'event',
            viewport: $('#fullcalendar'),
            adjust: {
                mouse: false,
                scroll: false
            }
        },
        hide: false,
        style: {
            classes: 'qtip-bootstrap'
        }
    }).qtip('api');

    $('#calendar').fullCalendar({
        locale: 'es',
        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        // General display options
        defaultView: 'agendaDay',
        header: {
            left: 'prev, next, today',
            center: 'title',
            right: 'agendaDay, timelineWeek, timelineMonth'
        },
        contentHeight: 'auto',
        allDaySlot: false,
        views: {
            timeline: {
                resourceAreaWidth: '10%',
                resourceLabelText: 'Lugares',
                slotWidth: 50
            },
            timelineMonth: {
                slotWidth: 100
            },
            agenda: {
                slotDuration: '01:00:00'
            }
        },
        // Agenda options
        minTime: '06:00:00',
        maxTime: '22:00:00',
        // Current date options
        nowIndicator: true,
        // Clicking & Hovering
        navLinks: true,
        // Event Data options
        events: {
            url: Routing.generate('fullcalendar_eventos'),
            type: 'POST'
        },
        // Resource Data options
        resources: {
            url: Routing.generate('fullcalendar_lugares'),
            type: 'POST'
        },

        eventClick: function(event) {
            if (event.url) {
                return false;
            }
        },

        // Eventos
        eventMouseover: function(event, element) {
            var texto = '';

            var titulo = '<b>' + event.tipo + '</b>';

            texto += '<b>Asignatura:</b> ';
            texto += event.asignatura ? event.asignatura : 'Ninguna';

            texto +='<br><b>Grupo:</b> ';
            texto += event.grupo ? event.grupo : 'Ninguno';

            texto += '<br><b>Observaciones:</b> ';
            texto += event.observaciones ? event.observaciones : 'Ninguna';

            texto += event.url ? '<br><b>Edición: </b><a target="_blank" href="' + event.url + '"<b>Editar</b></a>' : '';

            tooltip.set({
                'content.text': texto,
                'content.title' : titulo
            }).reposition(element).show(element);

        },

        dayClick: function() { tooltip.hide(); },
        eventResizeStart: function() { tooltip.hide(); },
        eventDragStart: function() { tooltip.hide(); },
        viewDisplay: function() { tooltip.hide(); }
    });
});