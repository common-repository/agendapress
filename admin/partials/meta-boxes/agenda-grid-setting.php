<table style="max-width: 800px; width: 100%;">
	<tr>
		<td><?php _e('Start Date','agendapress'); ?></td>
		<td>
			<input type="text" class="datepicker-start-1" id="start-date" name="gt[start_date]" value="<?php echo $start_date; ?>">
		</td>
		<td><?php _e('End Date','agendapress'); ?></td>
		<td>
			<input type="text" class="datepicker-end-1" id="end-date" name="gt[end_date]" value="<?php echo $end_date; ?>">
		</td>
	</tr>
	<tr>
		<td><?php _e('Start Time','agendapress'); ?></td>
		<td>
			<input type="text" id="timepicker1" name="gt[satrt_time]" value="<?php echo $satrt_time; ?>">
		</td>
		<td><?php _e('End Time','agendapress'); ?></td>
		<td>
			<input type="text" id="timepicker2" name="gt[end_time]" value="<?php echo $end_time; ?>">
		</td>
	</tr>	
	<tr>
		<td width="25%"><?php _e('Time Format','agendapress'); ?></td>
		<td width="25%" colspan="2">
			<div class="checkbox-group">
				<input <?php if($clock_type==='12') {echo "Checked";} ?> id="clock-type1" type="radio" name="gt[clock_type]" class="clock_type" value="12"> <?php _e('12 Hour Clock','agendapress'); ?>
				<input <?php if($clock_type==='24') {echo "Checked";} ?> id="clock-type2" type="radio" name="gt[clock_type]" class="clock_type" value="24">  <?php _e('24 Hour Clock','agendapress'); ?>
			</div>
		</td>
		<td width="25%"></td>
	</tr>
	<tr>
		<td><?php _e('Time Increments','agendapress'); ?></td>
		<td>
			<select id="time-increments" name="gt[time_increments]">
				<option <?php if($time_increments==='05'){echo 'selected="selected'; } ?> >5</option>
				<option <?php if($time_increments==='10'){echo 'selected="selected'; } ?> value="10">10</option>
				<option <?php if($time_increments==='15'){echo 'selected="selected'; } ?> value="15">15</option>
				<option <?php if($time_increments==='30'){echo 'selected="selected'; } ?> value="30">30</option>
				<option <?php if($time_increments==='45'){echo 'selected="selected'; } ?> value="45">45</option>
				<option <?php if($time_increments==='60'){echo 'selected="selected'; } ?> value="60">60</option>
			</select>
		</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">
			<div class="checkbox-group">	
				<input checked="checked" type="checkbox" name="gt[dispaly_first_col]"> 
				<?php _e('Display Times in First Column','agendapress'); ?>
			</div>
		</td>
		<td>
		</td>
	</tr>
</table>

