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


const projectCalendar = function (calendarEl,urlResources, urlEvents, slotMinTimeHour = 6,slotMaxTimeHour = 18) {
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
    resources: urlResources,
    events: urlEvents,
    
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
  return calendar;
}

global.projectCalendar = projectCalendar;

