var site_url='http://'+window.location.host+'/citiair';

function add_img_row()
{
	var num=parseInt($('#total_img_row').val());
	num+=1;
	
	$('.hotel_imgs').append('<div class="control-group"><label class="control-label" for="title_'+num+'">Image Title</label><div class="controls small"><input id="title_'+num+'" class="input-xlarge" type="text"  maxlength="255" name="data[img][image_'+num+'][title]"></div><label class="control-label" for="fileInput">Select Image</label><div class="controls small"><div id="uniform-fileInput" class="uploader"><input id="fileInput" class="input-file uniform_on" type="file" name="data[img][image_'+num+']" size="19" ><span class="filename" style="-moz-user-select: none;">No file selected</span><span class="action" style="-moz-user-select: none;">Choose File</span></div></div>');
	$('#total_img_row').val(num);
		
}

function show_select_fields(val,type,field)
{
	$.post(site_url+'/packages/get_table_values',{type:type,id:val},function(data){						
			$(field).html(data);
		});
}

function toggle_classes(val)
{
	var show_class=".private_journey";
	var	hide_class=".shared_journey";	
	if(val==1)
	{
		show_class=".shared_journey";
		hide_class=".private_journey";	
	}
	$(hide_class).toggle();
	$(hide_class +' input').removeAttr('required');
	//alert(show_class);
	$(show_class).toggle();
	$(show_class +' input').attr('required',true);	
}

function add_another_schedule()
{
	var num=$('#added_schedule').val();
	$('.schedule').append('<div id="sch_'+num+'"><div class="control-group"><label class="control-label" for="TransferScheduleType">Type</label><div class="controls"><select name="data[TransferSchedule]['+num+'][type]"><option value="1">InBound</option><option value="2">OutBound</option></select></div></div><div class="control-group"><label class="control-label">From Date</label><div class="controls"><input class="input" type="text" required="required" maxlength="255" name="data[TransferSchedule]['+num+'][from_date]"></div></div><div class="control-group"><label class="control-label">To Date</label><div class="controls"><input class="input" type="text" required="required" maxlength="255" name="data[TransferSchedule]['+num+'][to_date]"></div></div><div class="control-group"><label class="control-label">Days of week</label><div class="controls"><select name="data[TransferSchedule]['+num+'][days][]" multiple="multiple" onchange="check_selected_days(this.value);"><option value="'+num+'">Daily</option><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option></select></div></div><div class="control-group"><label class="control-label">From Time</label><div class="controls"><input class="input" type="text" required="required" maxlength="255" name="data[TransferSchedule]['+num+'][from_time]"></div></div><div class="control-group"><label class="control-label">To Time</label><div class="controls"><input class="input" type="text" required="required" maxlength="255" name="data[TransferSchedule]['+num+'][to_time]"></div></div><div class="control-group"><label class="control-label">Departure Point</label><div class="controls"><input class="input" type="text" required="required" maxlength="255" name="data[TransferSchedule]['+num+'][departure_point]"></div></div><div class="control-group"><label class="control-label">Drop Off Point</label><div class="controls"><input class="input" type="text" required="required" maxlength="255" name="data[TransferSchedule]['+num+'][dropoff_point]"></div></div></div>');	
	num=parseInt(num)+1;
	$('#added_schedule').val(num);
}

function add_another_vehicle()
{
	var num=$('#added_vehicle').val();
	$('.privatevehicle').append('<div class="control-group private_journey"><label class="control-label">Vehicle</label><div class="controls"><input class="input-xlarge" type="text" required="required" maxlength="255" name="data[TransferVehicle]['+num+'][vehicle]"></div></div><div class="control-group private_journey"><label class="control-label">Maximum Passengers</label><div class="controls"><input class="input-xlarge" type="number" required="required" min="0" maxlength="255" name="data[TransferVehicle]['+num+'][max_people]"></div></div><div class="control-group private_journey"><label class="control-label">Maximum Luggage</label><div class="controls"><input class="input-xlarge" type="number" required="required" min="0" maxlength="255" name="data[TransferVehicle]['+num+'][max_luggage]"></div></div><div class="control-group private_journey"><label class="control-label">Cost</label><div class="controls"><input class="input-xlarge" type="number" required="required" min="0" maxlength="255" name="data[TransferVehicle]['+num+'][cost]"></div></div>');	
	num=parseInt(num)+1;
	$('#added_vehicle').val(num);
}

function check_selected_days(val)
{
	if(val==0)
	{
		$('#TransferScheduleDays option').prop('selected',true);	
	}	
}