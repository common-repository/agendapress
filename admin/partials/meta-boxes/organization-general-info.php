
<table width="100%">
	<tr>
		<td valign="top" width="150">
			<br>
			<br>
			<b><?php _e('Profile','agendapress'); ?></b>
		</td>
		<td>
			<?php 
			$meta_content = wpautop( self::meta_content_editor_get_meta( 'organization_general_info_profile' ), true);
			wp_editor($meta_content, 'meta_content_editor_organization_general_info_profile', array(
					'wpautop'       =>  true,
					'media_buttons' =>      false,
					'textarea_name' =>      'organization_general_info_profile',
					'textarea_rows' =>      10,
					'teeny'         =>  true
			));
			?>
			<br>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<b><?php _e('Address','agendapress'); ?></b>
		</td>
		<td>
			<input type="text" name="gt[address]" value="<?php echo $address; ?>">
		</td>
	</tr>
	<tr>
		<td valign="top">
			<b><?php _e('Phone','agendapress'); ?></b>
		</td>
		<td>
			<input type="text" name="gt[phone]" value="<?php echo $phone; ?>">
		</td>
	</tr>
	<tr>
		<td valign="top">
			<b><?php _e('Email','agendapress'); ?></b>
		</td>
		<td>
			<input type="text" name="gt[email]" value="<?php echo $email; ?>">
		</td>
	</tr>
	<tr>
		<td valign="top">
			<b><?php _e('Website','agendapress'); ?></b>
		</td>
		<td>
			<input type="text" name="gt[website]" value="<?php echo $website; ?>">
		</td>
	</tr>

	<tr>
		<td valign="top">
			<b><?php _e('LinkedIn','agendapress'); ?></b>
		</td>
		<td>
			<input type="text" name="gt[linkedin]" value="<?php echo $linkedin; ?>">
		</td>
	</tr>
	<tr>
		<td valign="top">
			<b><?php _e('Facebook','agendapress'); ?></b>
		</td>
		<td>
			<input type="text" name="gt[facebook]" value="<?php echo $facebook; ?>">
		</td>
	</tr>
	<tr>
		<td valign="top">
			<b><?php _e('Twitter','agendapress'); ?></b>
		</td>
		<td>
			<input type="text" name="gt[twitter]" value="<?php echo $twitter; ?>">
		</td>
	</tr>
</table>

