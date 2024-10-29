<table width="100%">
	<tr>
		<td width="150">
			<b><?php _e('Venue','agendapress'); ?></b>
		</td>
		<td>
			<select name="venue">
				<option value="0">Select Venue</option>
				<?php echo self::get_post_as_option_group('venue', $venue); ?>
			</select>
		</td>
	</tr>
</table>
