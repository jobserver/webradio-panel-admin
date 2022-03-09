angular.module("ui.materialize", ["ui.materialize.ngModel","ui.materialize.materialboxed","ui.materialize.material_select","ui.materialize.tabs", "ui.materialize.sidenav","ui.materialize.slider","ui.materialize.collapsible", "ui.materialize.inputfield", "ui.materialize.input_date","ui.materialize.modal","ui.materialize.dropdown"]);

angular.module("ui.materialize.ngModel", [])
.directive("ngModel",["$timeout", function($timeout){
 return {
  restrict: 'A',
       priority: -1, // lower priority than built-in ng-model so it runs first
       link: function(scope, element, attr) {
       	scope.$watch(attr.ngModel,function(value){
       		$timeout(function () {
       			if (value){
       				element.trigger("change");
       			} else if(element.attr('placeholder') === undefined) {
       				if(!element.is(":focus"))
       					element.trigger("blur");
       			}
       		});
       	});
       }
     };
   }]);



    /*     example usage:
    <!-- normal materialboxed -->
    <img materialboxed class="materialboxed responsive-img" width="650" src="images/sample-1.jpg">

    <!-- caption materialboxed -->
    <img materialboxed class="materialboxed" data-caption="A picture of some deer and tons of trees" width="250" src="iamges/nature_portrait_by_pw_fotografie-d63tx0n.jpg">

     */
    angular.module("ui.materialize.materialboxed", [])
        .directive("materialboxed", ["$timeout", function($timeout){
            return {
                restrict: 'A',
                link: function(scope, element, attrs) {

                    $timeout(function(){
                        element.materialbox();
                    });

                }
            };
        }]);

angular.module('ui.materialize.tabs',[])
.directive("tabs", function ($timeout, $parse) {
 return {    
  link: function ($scope, element, $attrs) 
  {
   return $timeout(function () {

// element.tabs({ swipeable: true,duration:100 });
// 			 		element.tabs({ duration:100 });


if (element.length) 
{
 var instance = M.Tabs.init(element, {});
}
if ("watch" in $attrs) {
 $scope.$watch(function () {
  return element[0].innerHTML;
}, function (oldVal, newVal) {		
  if (oldVal !== newVal) {
   $timeout(function () {                                  
    if (element.length) {
     var instance = M.Tabs.init(element, {});
   }
 });
 }
});
}
});


 }
};
});


angular.module("ui.materialize.sidenav",[])
.directive("sidenav", function ($timeout, $parse) {

 return {
  link: function ($scope, element, $attrs) {
   element.sidenav({                     
    edge: $attrs.direcao ? $attrs.direcao : "left", 				
  });

   $(element).on('click','.waves-effect',function() 
   {    
    var instance = M.Sidenav.getInstance(element);  
    // instance.close();
  });

   $(element).on('change','select',function() 
   {    
    var instance = M.Sidenav.getInstance(element);	
    // instance.close();
  });

 }
};
});

angular.module("ui.materialize.slider", [])
.directive("slider", ["$timeout", function($timeout){
 return {
  restrict: 'A',
  scope: { 
   height: '=',
   transition: '=',
   interval: '=',
   indicators: '='
 },
 link: function(scope, element, attrs) {
   element.addClass("slider");
   $timeout(function(){
    element.slider({
     height: (angular.isDefined(scope.height)) ? scope.height : 400,
     transition: (angular.isDefined(scope.transition)) ? scope.transition : 500,
     interval: (angular.isDefined(scope.interval)) ? scope.interval : 6000,
     indicators: (angular.isDefined(scope.indicators)) ? scope.indicators : true
   });
  });
 }
};
}]);

angular.module("ui.materialize.collapsible", [])
.directive("collapsible", function ($timeout,$parse) {
 return {
  link: function ($scope, element, $attrs) {
   element.addClass('collapsible');
   return 	$timeout(function () {				
    element.collapsible();
  });
   if ("watch" in attrs) {
    scope.$watch(function () {
     return element[0].innerHTML;
   }, function (oldVal, newVal) {
     if (oldVal !== newVal) {
      $timeout(function () {
       element.collapsible();
     });
    }
  });
  }

}
};
});

 // This works, unless the content inside the select changes.
    angular.module("ui.materialize.material_select", [])
        .directive("materialSelect", ["$compile", "$timeout", function ($compile, $timeout) {
            return {
                link: function (scope, element, attrs) {
                    if (element.is("select")) {
                        $compile(element.contents())(scope);
                        function initSelect() {
                            element.siblings(".caret").remove();
                            element.formSelect();
                        }
                        $timeout(initSelect);
                        if (attrs.ngModel) {
                            scope.$watch(attrs.ngModel, initSelect);
                        }
                        if ("watch" in attrs) {
                            scope.$watch(function () {
                                return element[0].innerHTML;
                            }, function (oldVal, newVal) {
                                if (oldVal !== newVal) {
                                    $timeout(initSelect);
                                }
                            });
                        }
                    }
                }
            };
        }]);


  /**
     * Instead of adding the .input-field class to a div surrounding a label and input, add the attribute input-field.
     * That way it will also work when angular destroys/recreates the elements.
     *
     * Example:
     <inputfield style="margin-top:10px">
     <label>{{name}}:</label>
     <input type="text" name="{{name}}" ng-model="value">
     </inputfield>
     */
     angular.module("ui.materialize.inputfield", [])
     .directive('inputField', ["$compile", "$timeout", function ($compile, $timeout) {
      return {
       transclude: true,
       scope: {},
       link: function (scope, element) {
        $timeout(function () {
         M.updateTextFields();

                        // The "> > [selector]", is to restrict to only those tags that are direct children of the directive element. Otherwise we might hit to many elements with the selectors.

                        // Triggering autoresize of the textareas.
                        element.find("> > .materialize-textarea").each(function () {
                         var that = $(this);
                         that.addClass("materialize-textarea");
                         that.trigger("autoresize");
                         var model = that.attr("ng-model");
                         if (model) {
                          scope.$parent.$watch(model, function (a, b) {
                           if (a !== b) {
                            $timeout(function () {
                             that.trigger("autoresize");
                           });
                          }
                        });
                        }
                      });

                        // Adding char-counters.
                        element.find('> > .materialize-textarea, > > input').each(function (index, countable) {
                         countable = angular.element(countable);
                         if (!countable.siblings('span[class="character-counter"]').length) {
                          countable.characterCounter();
                        }
                      });
                      });
      },
      template: '<div ng-transclude class="input-field"></div>'
    };
  }]);

    /**
     * Add pickadate directive
     * Type text is mandatory
     * Example:
     <input input-date
        type="text"
        name="created"
        id="inputCreated"
        ng-model="currentTime"
        format="dd/mm/yyyy"
        months-full="{{ monthFr }}"
        months-short="{{ monthShortFr }}"
        weekdays-full="{{ weekdaysFullFr }}"
        weekdays-short="{{ weekdaysShortFr }}"
        weekdays-letter="{{ weekdaysLetterFr }}"
        disable="disable"
        today="today"
        clear="clear"
        close="close"
        on-start="onStart()"
        on-render="onRender()"
        on-open="onOpen()"
        on-close="onClose()"
        on-set="onSet()"
        on-stop="onStop()" />
        */
        angular.module("ui.materialize.input_date", [])
        .directive('inputDate', ["$compile", "$timeout", function ($compile, $timeout) {
            // Fix for issue 46. This gotta be a bug in the materialize code, but this fixes it.
            var style = $('<style>#inputCreated_root {outline: none;}</style>');
            $('html > head').append(style);

            // Define Prototype Date format
            // Use like this
            // today = new Date();
            // var dateString = today.format("dd-m-yy");
            var dateFormat = function () {

             var token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
             timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
             timezoneClip = /[^-+\dA-Z]/g,
             pad = function (val, len) {
              val = String(val);
              len = len || 2;
              while (val.length < len) {
               val = "0" + val;
             }
             return val;
           };

                // Regexes and supporting functions are cached through closure
                return function (date, mask, utc) {

                 var dF = dateFormat;

                    // You can't provide utc if you skip other args (use the "UTC:" mask prefix)
                    if (arguments.length === 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
                     mask = date;
                     date = undefined;
                   }

                    // Passing date through Date applies Date.parse, if necessary
                    date = date ? new Date(date) : new Date();
                    if (isNaN(date)) throw SyntaxError("invalid date");

                    mask = String(dF.masks[mask] || mask || dF.masks["default"]);

                    // Allow setting the utc argument via the mask
                    if (mask.slice(0, 4) == "UTC:") {
                     mask = mask.slice(4);
                     utc = true;
                   }

                   var _ = utc ? "getUTC" : "get",
                   d = date[ _ + "Date" ](),
                   D = date[ _ + "Day" ](),
                   m = date[ _ + "Month" ](),
                   y = date[ _ + "FullYear" ](),
                   H = date[ _ + "Hours" ](),
                   M = date[ _ + "Minutes" ](),
                   s = date[ _ + "Seconds" ](),
                   L = date[ _ + "Milliseconds" ](),
                   o = utc ? 0 : date.getTimezoneOffset(),
                   flags = {
                     d:    d,
                     dd:   pad(d),
                     ddd:  dF.i18n.dayNames[D],
                     dddd: dF.i18n.dayNames[D + 7],
                     m:    m + 1,
                     mm:   pad(m + 1),
                     mmm:  dF.i18n.monthNames[m],
                     mmmm: dF.i18n.monthNames[m + 12],
                     yy:   String(y).slice(2),
                     yyyy: y,
                     h:    H % 12 || 12,
                     hh:   pad(H % 12 || 12),
                     H:    H,
                     HH:   pad(H),
                     M:    M,
                     MM:   pad(M),
                     s:    s,
                     ss:   pad(s),
                     l:    pad(L, 3),
                     L:    pad(L > 99 ? Math.round(L / 10) : L),
                     t:    H < 12 ? "a"  : "p",
                     tt:   H < 12 ? "am" : "pm",
                     T:    H < 12 ? "A"  : "P",
                     TT:   H < 12 ? "AM" : "PM",
                     Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
                     o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
                     S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
                   };

                   return mask.replace(token, function ($0) {
                     return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
                   });
                 };
               }();

            // Some common format strings
            dateFormat.masks = {
             "default":      "ddd mmm dd yyyy HH:MM:ss",
             shortDate:      "m/d/yy",
             mediumDate:     "mmm d, yyyy",
             longDate:       "mmmm d, yyyy",
             fullDate:       "dddd, mmmm d, yyyy",
             shortTime:      "h:MM TT",
             mediumTime:     "h:MM:ss TT",
             longTime:       "h:MM:ss TT Z",
             isoDate:        "yyyy-mm-dd",
             isoTime:        "HH:MM:ss",
             isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
             isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
           };

            // Internationalization strings
            dateFormat.i18n = {
             dayNames: [
             "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
             "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
             ],
             monthNames: [
             "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
             "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
             ]
           };

            // For convenience...
            Date.prototype.format = function (mask, utc) {
             return dateFormat(this, mask, utc);
           };

            /**
             * Validate date object
             * @param  {Date}  date
             * @return {Boolean}
             */
             var isValidDate = function(date) {
              if( Object.prototype.toString.call(date) === '[object Date]' ) {
               return !isNaN(date.getTime());
             } 
             return false;
           };

           return {
            require: 'ngModel',
            scope: {
             container: "@",
             format: "@",
             formatSubmit: "@",
             monthsFull: "@",
             monthsShort: "@",
             weekdaysFull: "@",
             weekdaysLetter: "@",
             disable: "=",
             today: "=",
             clear: "=",
             close: "=",
             selectYears: "=",
             onStart: "&",
             onRender: "&",
             onOpen: "&",
             onClose: "&",
             onSet: "&",
             onStop: "&",
             ngReadonly: "=?",
             max: "@",
             min: "@"
           },
           link: function (scope, element, attrs, ngModelCtrl) {

             ngModelCtrl.$formatters.unshift(function (modelValue) {
              if (modelValue) {
               var date = new Date(modelValue);
               return (angular.isDefined(scope.format)) ? date.format(scope.format) : date.format('d mmmm, yyyy');
             }
             return null;
           });

             var monthsFull = (angular.isDefined(scope.monthsFull)) ? scope.$eval(scope.monthsFull) : undefined,
             monthsShort = (angular.isDefined(scope.monthsShort)) ? scope.$eval(scope.monthsShort) : undefined,
             weekdaysFull = (angular.isDefined(scope.weekdaysFull)) ? scope.$eval(scope.weekdaysFull) : undefined,
             weekdaysLetter = (angular.isDefined(scope.weekdaysLetter)) ? scope.$eval(scope.weekdaysLetter) : undefined;


             $compile(element.contents())(scope);
             if (!(scope.ngReadonly)) {
              $timeout(function () {
               var pickadateInput = element.pickadate({
                container : (angular.isDefined(scope.container)) ? scope.container : 'body',
                format: (angular.isDefined(scope.format)) ? scope.format : undefined,
                formatSubmit: (angular.isDefined(scope.formatSubmit)) ? scope.formatSubmit : undefined,
                monthsFull: (angular.isDefined(monthsFull)) ? monthsFull : undefined,
                monthsShort: (angular.isDefined(monthsShort)) ? monthsShort : undefined,
                weekdaysFull: (angular.isDefined(weekdaysFull)) ? weekdaysFull : undefined,
                weekdaysLetter: (angular.isDefined(weekdaysLetter)) ? weekdaysLetter : undefined,
                disable: (angular.isDefined(scope.disable)) ? scope.disable : undefined,
                today: (angular.isDefined(scope.today)) ? scope.today : undefined,
                clear: (angular.isDefined(scope.clear)) ? scope.clear : undefined,
                close: (angular.isDefined(scope.close)) ? scope.close : undefined,
                selectYears: (angular.isDefined(scope.selectYears)) ? scope.selectYears : undefined,
                onStart: (angular.isDefined(scope.onStart)) ? function(){ scope.onStart(); } : undefined,
                onRender: (angular.isDefined(scope.onRender)) ? function(){ scope.onRender(); } : undefined,
                onOpen: (angular.isDefined(scope.onOpen)) ? function(){ scope.onOpen(); } : undefined,
                onClose: (angular.isDefined(scope.onClose)) ? function(){ scope.onClose(); } : undefined,
                onSet: (angular.isDefined(scope.onSet)) ? function(){ scope.onSet(); } : undefined,
                onStop: (angular.isDefined(scope.onStop)) ? function(){ scope.onStop(); } : undefined
              });
                            //pickadate API
                            var picker = pickadateInput.pickadate('picker');

                            //watcher of min and max
                            scope.$watch('max', function(newMax) {
                             if( picker ) {
                              var maxDate = new Date(newMax);
                              picker.set({max: isValidDate(maxDate) ? maxDate : false});
                            }
                          });
                            scope.$watch('min', function(newMin) {
                             if( picker ) {
                              var minDate = new Date(newMin);
                              picker.set({min: isValidDate(minDate) ? minDate : false});
                            }
                          });
                          });
            }
          }
        };
      }]);




angular.module('ui.materialize.modal',[])
.directive("modal", function ($timeout, $parse) {
 return {  
  scope:true,
  link: function ($scope, element, $attrs) 
  {
   return $timeout(function () {
    if (element.length) 
    {
     // element.addClass('modal-trigger');
     var instance = M.Modal.init($('.modal'), {inDuration:70,outDuration:70,dismissible:false});
   }
   if ("watch" in $attrs) {
     $scope.$watch(function () {
      return element[0].innerHTML;
    }, function (oldVal, newVal) {  
      if (oldVal !== newVal) {
       $timeout(function () {                                  
        if (element.length) {
         element.addClass('modal-trigger');
         var instance = M.Modal.init($('.modal'), {});
       }
     });
     }
   });
   }

 });
 }
};
});


/*
     Example usage, notice the empty dropdown tag in the dropdown trigger.
     <!-- Dropdown Trigger -->
     <a class='dropdown-button btn' href='javascript:void(0);' data-activates='demoDropdown' 
        dropdown constrain-width="false">
        Select a demo
     </a>
     <!-- Dropdown Structure -->
     <ul id='demoDropdown' class='dropdown-content'>
     <li ng-repeat="demo in demoDefiniftions">
     <a href="javascript:void(0);" ng-click="selectDemo(demo)">{{demo.name}}</a>
     </li>
     </ul>*/
    angular.module("ui.materialize.dropdown", [])
        .directive("dropdown", ["$compile", "$timeout", function ($compile, $timeout) {
            return {
                scope: {
                    inDuration: "@",
                    outDuration: "@",
                    constrainWidth: "@",
                    hover: "@",
                    alignment: "@",
                    gutter: "@",
                    belowOrigin: "@"
                },
                link: function (scope, element, attrs) {
                    $timeout(function () {
                        $compile(element.contents())(scope);

                        M.Dropdown.init(element,{});
                        // element.dropdown({
                        //     inDuration: (angular.isDefined(scope.inDuration)) ? scope.inDuration : undefined,
                        //     outDuration: (angular.isDefined(scope.outDuration)) ? scope.outDuration : undefined,
                        //     constrain_width: (angular.isDefined(scope.constrainWidth)) ? scope.constrainWidth : undefined,
                        //     hover: (angular.isDefined(scope.hover)) ? scope.hover : undefined,
                        //     alignment: (angular.isDefined(scope.alignment)) ? scope.alignment : undefined,
                        //     gutter: (angular.isDefined(scope.gutter)) ? scope.gutter : undefined,
                        //     belowOrigin: (angular.isDefined(scope.belowOrigin)) ? scope.belowOrigin : undefined
                        // });
                    });
                }
            };
        }]);