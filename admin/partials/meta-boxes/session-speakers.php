
<table width="100%">
	<tr>
		<td width="150">
			<b><?php _e('Speaker','agendapress'); ?></b>
		</td>
		<td>
			<select name="speaker[]" multiple>
				<option value="0">Select Speaker</option>
				<?php echo self::get_post_as_option('speaker', $speaker); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<a href="">Add New Speaker</a>
		</td>
	</tr>
</table>

