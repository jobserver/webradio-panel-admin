<div class="row" ng-controller="programacao" ng-init="getProgramacao()" >	
	<div class="">
		<div  class="demo">
			<div class="demo-calendar">
				<div id="calendario" fc fc-options="calendarOptions" ng-model="events" class="calendar">
				</div>
			</div>
		</div>
	</div>
</div>

<style type="text/css" scoped="scoped">
    /*@import url('https://fonts.googleapis.com/css?family=Open+Sans');*/

body {
  /*font-family: 'Open Sans', sans-serif;*/
  /*color:#F6F6F6;*/
}
/*h1 {font-weight: bolder !important;}*/
/*.title {
  color:white !important;
}*/
/*h1,h2,h3,h4,h5,h6 {
  color: #1a608a !important;
}*/
/*h2, .h2 {
    font-size: 13px !important;
}
p {
  font-size: 15px;
}*/
.fc-button-group button{
  border:0px;  
  height: 3.1em !important;
}

.fc-state-default
{
  background-image: none !important;
    border-radius: 0px !important; 
}
.fc-center h2{
  font-size: 19px !important;
}
/*.fc-state-default.fc-corner-left {
   
}*/

.fc .fc-row .fc-content-skeleton table, .fc .fc-row .fc-content-skeleton td, .fc .fc-row .fc-helper-skeleton td {
    color: #000000;
}
.fc-unthemed .fc-content, .fc-unthemed .fc-divider, .fc-unthemed .fc-list-heading td, .fc-unthemed .fc-list-view, .fc-unthemed .fc-popover, .fc-unthemed .fc-row, .fc-unthemed tbody, .fc-unthemed td, .fc-unthemed th, .fc-unthemed thead {
    color: #000;
}
.fc-toolbar.fc-header-toolbar {
    margin-bottom: 0em !important;
}

.header-title {
  padding:80px 0px;
  background-image: linear-gradient(-45deg, #37ecba 0%, #72afd3 100%);
}
.header-title  p {
  color:white;
}
.title-icon { color: white; font-size: 30px; opacity: 0.4;}
.header-title-container{
  text-align: center;
}
.header-description {
  margin-bottom: 30px;
}
.header-link {
  padding:15px;
  border:solid 1px white;
  color: white;
  text-decoration: none;
  border-radius: 50px
}
.header-link:hover{
  background:white;
  color:gray;
  text-decoration: none;
}
.demo {text-align: center; padding: 0px; width: 100%; margin: auto; }
.demo-container{ background: #fbfbfb;}
.demo-calendar {
  /*max-width: 768px;*/
  margin: auto;
}
.btn-fullcalendar-primary {
  border: 3px solid #27d2d2 !important;
  background: transparent !important;
  color: #27d2d2 ;
}
.btn-fullcalendar-primary:hover {
  background-color: #27d2d2 !important;
  color: white !important ;
}
.footer {
  margin-bottom: 100px;
}

  </style>

  <script>
    $(function(){

    $('#calendario').fullCalendar('render');
    });

  </script>