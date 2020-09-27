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



const projectCalendar = function (calendarEl,urlResources, urlEvents, slotMinTimeHour = 7,slotMaxTimeHour = 17) {
  var calendar = new Calendar(calendarEl, {
    now: '2020-01-01',
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
        duration: { days: 5 },
        buttonText: '7 days',
          slotDuration: (slotMaxTimeHour-slotMinTimeHour)+':00',
          resourceAreaWidth: '10%'
      }
    },
    resources: urlResources,
    events: urlEvents,
    
    eventContent: function(arg) {
      let htmlResources = ""
      let htmlOpenResources = "";
      let htmlBookableResources = "";

     if(arg.event.extendedProps.managedShiftWorks){
      
      htmlOpenResources = arg.event.extendedProps.managedShiftWorks.map(function(managedShiftWork){
        let htmlHead = "";
        let htmlOpenShift = "";
        let htmlBookedResources = "";
  

       // htmlHead = "<b>" + managedShiftWork.resourceGroup.name + "</b>";

        if(managedShiftWork.openNumber > 0){
          //<div class="col-sm droppable" data-droppable-shift="{{managedShift.getShift().id}}" >
           // htmlOpenShift = "offen " + managedShiftWork.openNumber + '<br />';
            htmlOpenShift = '<div class="droppable" data-droppable-shift="'+managedShiftWork.shift.id+'" data-droppable-resourcegroupid="'+managedShiftWork.resourceGroup.id+'" style="position:relative;"><img class="rounded-circle" style="width:100%;"src="/portrait_placeholder_light.png"><div class="vertical-center text-center text-danger" style="font-size:16px;">'+ managedShiftWork.openNumber +'</div><small>'+managedShiftWork.resourceGroup.name+'</small></div>';
          // 
        }

        if(managedShiftWork.shiftWorks){
          htmlBookedResources = managedShiftWork.shiftWorks.map(function(shiftWork){
            return '<div><img class="rounded-circle" style="max-width:100%;"src="https://randomuser.me/api/portraits/men/'+shiftWork.resource.id+'.jpg"><small>'+shiftWork.resource.name+'</small></div>';
          }).join("");
      }
        
        return '<div class="p-2">'+htmlHead + htmlOpenShift + htmlBookedResources + "</div>";
      }).join("");

/*

      <div class="draggable" data-draggable-resource-resourcegroups="{% for resourceGroup in resourcesBookable.getResourceGroups() %}{{resourceGroup.id}} {% endfor %}" data-draggable-resourceid="{{resourcesBookable.id}}">
      <div class="media ">
          <div class="media-left align-self-center ml">
              <img class="rounded-circle" src="https://randomuser.me/api/portraits/men/{{resourcesBookable.id}}.jpg">
              <div>
              {{resourcesBookable.name}}
              </div>
          </div>
      </div>
      */
   }
   htmlBookableResources = arg.event.extendedProps.bookableResources.map(function(bookableResource){
      


      return   `<div class="draggable" data-draggable-resource-resourcegroups="`+bookableResource.resourceGroups.map(function(resourceGroup){return resourceGroup.id}).join(" ")+ ` " data-draggable-resourceid="`+bookableResource.id+`">
   
              <img class="rounded-circle" src="https://randomuser.me/api/portraits/men/`+bookableResource.id+`.jpg">
           
              `+bookableResource.name+`
            
      </div> `
   }).join("");
  

      return { html:  htmlOpenResources + "<p>Buchbar:</p>" +htmlBookableResources }
    },
    eventsSet: function(){
      setTimeout(function(){ calendar.setOption('aspectRatio', 1.8);}, 100);

      setTimeout(function(){ 
      
        initDragAndDrop();
      }, 2000);
    }
    });
  return calendar;
}

global.projectCalendar = projectCalendar;

