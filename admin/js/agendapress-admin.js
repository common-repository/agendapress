(function($) {
	'use strict';
	document.addEventListener('DOMContentLoaded', function() {

		var calendarEl = document.getElementById('calendar');
		
		if(null!==calendarEl) {

			var calendars = [];
			var Calendar = FullCalendar.Calendar;
			var Draggable = FullCalendarInteraction.Draggable;
			var containerEl = document.getElementById('external-events');
			
			var checkbox = document.getElementById('drop-remove');
			var timeIncrements = document.getElementById('time-increments');
			var startDateEl = document.getElementById('start-date');
			var endDateEl = document.getElementById('end-date');
			var timepicker1 = document.getElementById('timepicker1');
			var timepicker2 = document.getElementById('timepicker2');
			var clocktype1 = document.getElementById('clock-type1');
			var clocktype2 = document.getElementById('clock-type2');


			new Draggable(containerEl, {
				itemSelector: '.fc-event',
				eventData: function(eventEl) {
					return {
						id: eventEl.getAttribute('data-id'),
						title: eventEl.getElementsByClassName('title')[0].innerHTML,
						duration: '00:15:00',
						editlink: eventEl.getElementsByClassName('editlink')[0].innerHTML,
					};
				}
			});

			var deletelink = $('.deletelink a');

			$.each(deletelink, function(key, value){
				console.log(value);

				$(value).click(function(){

					var conf = confirm('Confirm?');
					if (conf == true) {
						var id = $(this).data('id');
						console.log(id);
						var data = {
							'action': 'delete_session',
							'id': id,
						};
						deleteSession(data);
						$(this).parents('.fc-event').remove();
					} 

					return false;
				})

			})

			var calendarOptions = {
				plugins: ['interaction', 'resourceDayGrid', 'resourceTimeGrid', 'list'],
				timeZone: 'UTC',
				defaultDate: '2019-03-26',
				validRange: {
					start: '2017-05-01',
					end: '2017-06-01'
				},
				defaultView: 'resourceTimeGridDay',
				editable: true,
				slotLabelInterval: '00:10',
				slotDuration: '00:05',
				contentHeight: 'auto',
				selectable: true,
				minTime: '08:00:00',
				maxTime: '16:00:00',
				eventLimit: true,
				allDaySlot: false,
				slotLabelFormat: [{
					hour: '2-digit',
					minute: '2-digit',
					hour12: true,
				}],
				header: {
					left: 'prev,next',
					center: 'title',
					right: 'resourceTimeGridDay,resourceTimeGridCustomDay,listDay,listWeek'
				},
				views: {
					resourceTimeGridCustomDay: {
						type: 'resourceTimeGrid',
						duration: {
							days: 2
						},
						buttonText: '2 days',
					},
					listDay: {
						buttonText: 'list day'
					},
					listWeek: {
						buttonText: 'list week'
					}
				},
				resources: agendapress.site_url+'/wp-json/agendapress/v1/agenda/'+agendapress.post_id+'/resources',
				editable: true,
				droppable: true,
				eventDrop: function(info) {
					console.log('eventDrop');

					var data = {
						'action': 'update_agenda_session',
						'post_id': agendapress.post_id,
						'id': info.event.id,
						'type': 'update',
						'resourceId': info.event.getResources()[0].id,
						'start': info.event.start.toUTCString(),
						'old_start': info.oldEvent.start.toUTCString(),
						'end': info.event.end.toUTCString(),
					};
					if(info.newResource) {
						data.resourceId = info.newResource.id;
					}
					updateAgendaSession(data);
				},
				eventResize: function(info) {
					console.log('eventResize');

					var data = {
						'action': 'update_agenda_session',
						'type': 'update',
						'post_id': agendapress.post_id,
						'id': info.event.id,
						'resourceId': info.event.getResources()[0].id,
						'start': info.event.start.toUTCString(),
						
						'end': info.event.end.toUTCString(),
					};
					updateAgendaSession(data);
				},
				drop: function(info) {
					console.log('drop');

					var data = {
						'action': 'update_agenda_session',
						'type': 'add',
						'post_id': agendapress.post_id,
						'id': info.draggedEl.getAttribute('data-id'),

						'resourceId': info.resource.id,
						'start': info.date.toUTCString(),
					};
					updateAgendaSession(data);
					if(!info.draggedEl.getAttribute('data-repeat')){
						info.draggedEl.parentNode.removeChild(info.draggedEl);
					}
				},
				eventRender: function(info) { 
					if(info.view.type==='resourceTimeGridCustomDay' || info.view.type==='resourceTimeGridCustomDay' || info.view.type==='resourceTimeGridDay'){
						
						var deleteEl = document.createElement('div');
						deleteEl.className = 'fc-delete';
						deleteEl.innerHTML = '<span class="fc-delete">X</span>';
						info.el.getElementsByClassName('fc-content')[0].appendChild(deleteEl);
						info.el.getElementsByClassName('fc-delete')[0].addEventListener('click', function(){
							console.log(info);
							var data = {
								'action': 'delete_agenda_session',
								'type': 'delete',
								'post_id': agendapress.post_id,
								'id': info.event.id,
								'start': info.event.start.toUTCString(),
							};

							deleteAgendaSession(data);
							info.event.remove();
						});
					}

					if(info.view.type==='resourceTimeGridDay' || info.view.type==='resourceTimeGridCustomDay') {
						var editlinkEl = document.createElement('span');
						editlinkEl.className = 'editlink';
						editlinkEl.innerHTML = info.event.extendedProps.editlink;
						console.log(editlinkEl)
						info.el.getElementsByClassName('fc-content')[0].appendChild(editlinkEl);
					}


				},
				datesRender: function(info) {},
				events: agendapress.site_url+'/wp-json/agendapress/v1/agenda/'+agendapress.post_id+'/sessions/',
			};



			var calendar = new FullCalendar.Calendar(calendarEl, calendarOptions);
			calendar.render();
			calendars.push(calendar);
			reRender();
			timeIncrements.onchange = function changeEventHandler(event) {
				reRender();
			};
			startDateEl.onchange = function changeEventHandler(event) {
				reRender();
			};
			endDateEl.onchange = function changeEventHandler(event) {
				reRender();
			};
			timepicker1.onchange = function changeEventHandler(event) {
				reRender();
			};
			timepicker2.onchange = function changeEventHandler(event) {
				reRender();
			};
			clocktype1.onchange = function changeEventHandler(event) {
				reRender();
			};
			clocktype2.onchange = function changeEventHandler(event) {
				reRender();
			};

		}

		function zeroPad(num, places) {
			var zero = places - num.toString().length + 1;
			return Array(+(zero > 0 && zero)).join("0") + num;
		}

		function reRender() {
			console.log('reRender');
			for(var i = 0; i < calendars.length; i++) {
				calendars[i].destroy();
			}
			var startDate = new Date(startDateEl.value);


			var endDate = new Date(endDateEl.value);
			var dayDuration = (endDate - startDate) / 1000 / 60 / 60 / 24;

			var minTime = timepicker1.value;
			var maxTime = timepicker2.value;

			var date = new Date('0000', '00', '00', '00', timeIncrements.value);
			var slotLabelInterval = zeroPad(date.getHours(), 2) + ':' + zeroPad(date.getMinutes(), 2) + ':' + zeroPad(date.getSeconds(), 2);
			
			if(clocktype1.checked) {
				minTime = ConvertTimeformat(minTime);
				maxTime = ConvertTimeformat(maxTime);
				calendarOptions.slotLabelFormat = [{
					hour: '2-digit',
					minute: '2-digit',
					hour12: true,
				}];
			}

			if(clocktype2.checked) {
				minTime = minTime;
				maxTime = maxTime;
				calendarOptions.slotLabelFormat = [{
					hour: '2-digit',
					minute: '2-digit',
					hour12: false,
				}];
			}

			calendarOptions.validRange.start = startDate.toUTCString();
			endDate = new Date(endDate.setDate(endDate.getDate()+1));
			calendarOptions.validRange.end = endDate.toUTCString();
			calendarOptions.slotLabelInterval = slotLabelInterval;
			calendarOptions.views.resourceTimeGridCustomDay.duration.days = 1 + dayDuration;
			calendarOptions.views.resourceTimeGridCustomDay.buttonText = 1 + dayDuration + ' days';

			calendarOptions.minTime = minTime;
			calendarOptions.maxTime = maxTime;

			var calendar = new FullCalendar.Calendar(calendarEl, calendarOptions);
			calendar.render();
			calendar.gotoDate(startDate.toUTCString());
			calendars.push(calendar);




		}

		function ConvertTimeformat(str) {
			var hours = Number(str.match(/^(\d+)/)[1]);
			var minutes = Number(str.match(/:(\d+)/)[1]);
			var AMPM = str.match(/\s?([AaPp][Mm]?)$/)[1];
			var pm = ['P', 'p', 'PM', 'pM', 'pm', 'Pm'];
			var am = ['A', 'a', 'AM', 'aM', 'am', 'Am'];
			if(pm.indexOf(AMPM) >= 0 && hours < 12) hours = hours + 12;
			if(am.indexOf(AMPM) >= 0 && hours == 12) hours = hours - 12;
			var sHours = hours.toString();
			var sMinutes = minutes.toString();
			if(hours < 10) sHours = "0" + sHours;
			if(minutes < 10) sMinutes = "0" + sMinutes;
			return (sHours + ":" + sMinutes);
		}

		function updateAgendaSession(data){
			jQuery.post(agendapress.ajax_url, data, function(response) {
				console.log(response);
			});
		}

		function deleteAgendaSession(data){
			jQuery.post(agendapress.ajax_url, data, function(response) {
				console.log(response);
			});
		}

		function deleteSession(data){
			jQuery.post(agendapress.ajax_url, data, function(response) {
				console.log(response);
			});
		}

	});

	jQuery(window).on('load', function(){
		jQuery('.agandapress-session-type-menu a').click(function(){
			var id = jQuery(this).attr('href');
			jQuery('.agandapress-session-type-menu-tab-single').hide();
			jQuery(id).show();
			return false;
		});



		jQuery('.add_new_session_pop_button, .pop_title span').click(function(){
			jQuery('#add_new_session_pop').toggle();
			jQuery('body').toggleClass('modal-open');
			return false;
		})

		jQuery('.add_new_session_button').click(function(){

			var event = jQuery('input[name="event"]').val();
			var title = jQuery('input[name="title"]').val();
			var session_type = jQuery('select[name="session_type"] option:selected').val();
			var venue = jQuery('select[name="venue"] option:selected').val();
			
			if(!title){
				alert('Session title is requird');
				return false;
			}

			if(!session_type){
				alert('Session type is requird');
				return false;
			}

			if(!venue){
				alert('Venue is requird');
				return false;
			}

	        var speakers = [];
	        jQuery.each(jQuery('select[name="speaker[]"] :selected'), function(){            
	            speakers.push(jQuery(this).val());
	        });
	        var session_general_info_summery = '';
	        var session_general_info_aditional_details = '';
if(tinymce.get('meta_content_editor_session_general_info_summery')){
var session_general_info_summery = tinymce.get('meta_content_editor_session_general_info_summery').getContent();
}
if (tinymce.get('session_general_info_aditional_details')){
	var session_general_info_aditional_details = tinymce.get('session_general_info_aditional_details').getContent();
}
	        
	        

			var data = { 
				action: 'create_new_session_aj',
				title: title,
				event: event,
				session_type: session_type,
				repeat: jQuery('input[name="repeat"]:checked').val(),
				session_general_info_summery: session_general_info_summery,
				session_general_info_aditional_details: session_general_info_aditional_details,
				more_link: jQuery('input[name="more_link"]:checked').val(),
				speaker: speakers,
				venue: venue,
			};

			jQuery.post(agendapress.ajax_url, data, function(response) {
				console.log(response);
				if(response==='success') {
					location.reload();
				}
			});


			return false;
		})


	})



	jQuery(function() {


		jQuery('#start-date, #end-date').datepicker({
			showOn: "both",
			beforeShow: customRange,
			dateFormat: "yy-mm-dd",
		});
		
		jQuery('#timepicker1, #timepicker2').timepicker({
			'timeFormat': 'h:ia'
		});

		if(jQuery('.clock_type:checked').val() === '12') {
			jQuery('#timepicker1, #timepicker2').timepicker({
				'timeFormat': 'h:ia'
			});
		}

		if(jQuery('.clock_type:checked').val() === '24') {
			jQuery('#timepicker1, #timepicker2').timepicker({
				'timeFormat': 'H:i:s'
			});
		}

		jQuery('.clock_type').change(function() {
			if(jQuery('.clock_type:checked').val() === '12') {
				jQuery('#timepicker1, #timepicker2').timepicker({
					'timeFormat': 'h:ia'
				});
			}
			if(jQuery('.clock_type:checked').val() === '24') {
				jQuery('#timepicker1, #timepicker2').timepicker({
					'timeFormat': 'H:i:s'
				});
			}
		});

		jQuery('#add-new-room').click(function(){
			var html = '/\
			<tr>\
				<td>\
					<input type="text" name="rooms[]" value="">\
				</td>\
			</tr>\
			';

			jQuery(this).parents('table tr:last').before(html)

		})
	});


	function customRange(input) {
		if(input.id == 'end-date') {
			var minDate = new Date(jQuery('#start-date').val());
			minDate.setDate(minDate.getDate())
			return {
				minDate: minDate
			};
		}
		return {}
	}











})(jQuery);