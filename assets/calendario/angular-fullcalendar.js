/*!
 * angular-fullcalendar
 * https://github.com/JavyMB/angular-fullcalendar#readme
 * Version: 1.0.1 - 2017-09-14T15:14:58.066Z
 * License: ISC
 */


 (function () { 
    'use strict';
    angular.module('angular-fullcalendar',[])
    .value('CALENDAR_DEFAULTS',{
        locale:'pt-br',
        defaultView: "agendaWeek",
        height: 500,
        nowIndicator: true,
        titleFormat: "D MMM, YYYY",        
        timeFormat: 'H(:mm)',
                columnFormat:'ddd D/M',
        header: {
            right: "prev,next",
            center: "title",
 // left: "month,agendaWeek,agendaDay,listWeek"
 left: "agendaWeek,listWeek,agendaDay"
 // right: "month,listWeek"
},
monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab']         
})
    .directive('fc',['CALENDAR_DEFAULTS',fcDirectiveFn]);

    function fcDirectiveFn(CALENDAR_DEFAULTS) {
        return {
            restrict : 'A',
            scope : {
                eventSource : '=ngModel',options : '=fcOptions'
            },
            link:function (scope, elm) {
                var calendar;
                init();
                scope.$watch('eventSource', watchDirective,true);
                scope.$watch('options',watchDirective,true);
                scope.$on('$destroy', function () { destroy();});
                function init() {
                    if (!calendar) {
                        calendar = $(elm).html('');
                    }
                    calendar.fullCalendar(getOptions(scope.options));
                }
                function destroy() {
                  if(calendar && calendar.fullCalendar){
                      calendar.fullCalendar('destroy');
                  }
              }
              function getOptions(options) {
                return angular.extend(CALENDAR_DEFAULTS,{
                    events:scope.eventSource
                },options);
            }
            function watchDirective(newOptions,oldOptions) {
                if (newOptions !== oldOptions) {
                    destroy();
                    init();
                } else if ((newOptions && angular.isUndefined(calendar))) {
                    init();
                }
            }
        }
    };

}

}());