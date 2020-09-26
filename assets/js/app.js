/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';


require('jquery-ui/ui/widgets/droppable');
require('jquery-ui/ui/widgets/sortable');
require('jquery-ui/ui/widgets/selectable');

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';

global.$ = global.jQuery = $;
import '../css/app.scss'



import { Calendar } from '@fullcalendar/core';
import resourceTimelinePlugin from '@fullcalendar/resource-timeline';


document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');


  let slotMinTimeHour = 6;
  let slotMaxTimeHour = 18;

  var calendar = new Calendar(calendarEl, {
    now: '2020-09-07',
    plugins: [ resourceTimelinePlugin ],
    scrollTime: '00:00', // undo default 6am scrollTime
    editable: true, // enable draggable events
    selectable: true,
    slotMinTime: slotMinTimeHour+ ':00:00',
    slotMaxTime: slotMaxTimeHour+':00:00',
    headerToolbar: {
      left: 'today prev,next',
      center: 'title',
      //right: 'resourceTimelineInDays'
    },
    initialView: 'resourceTimelineInDays',
    views: {
      resourceTimelineInDays: {
        type: 'resourceTimeline',
        duration: { days: 7 },
        buttonText: '7 days',
         slotDuration: (slotMaxTimeHour-slotMinTimeHour)+':00',
          resourceAreaWidth: '10%'
      }
    },
    resources: [
      { id: 'a', title: 'Schicht C350 left', status: 'OK' },
      { id: 'b', title: 'Schicht C350 rechts' , eventColor: 'green' },
      { id: 'c', title: 'Studentenkurs 01', eventColor: 'red' },
    ],
    events: [
      { id: '1', resourceId: 'a', start: '2020-09-07T07:00:00', end: '2020-09-07T12:00:00', title: 'Schicht 01', resources: [1,2,3,4,5] },
      { id: '1', resourceId: 'a', start: '2020-09-07T12:00:00', end: '2020-09-07T17:00:00', title: 'Schicht 02', resources: [7,5] },
      { id: '2', resourceId: 'c', start: '2020-09-07T05:00:00', end: '2020-09-07T22:00:00', title: 'event 2' },
      { id: '3', resourceId: 'd', start: '2020-09-06', end: '2020-09-08', title: 'event 3' },
      { id: '4', resourceId: 'e', start: '2020-09-07T03:00:00', end: '2020-09-07T08:00:00', title: 'event 4' },
      { id: '5', resourceId: 'f', start: '2020-09-07T00:30:00', end: '2020-09-07T02:30:00', title: 'event 5' }
    ],
    eventContent: function(arg) {
      let htmlResources = ""
      if(arg.event.extendedProps.resources){
         htmlResources = arg.event.extendedProps.resources.map(function(resource){
           return '<div> Name <img class="rounded-circle" style="max-width:100%;"src="https://randomuser.me/api/portraits/men/'+resource+'.jpg">'+resource+' </div>';
         }).join();
      }

    
     
      return { html: htmlResources }
    },
    eventDidMount: function(){
      setTimeout(function(){ calendar.setOption('aspectRatio', 1.8);}, 100);
    }
  });

  calendar.render();
});

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

