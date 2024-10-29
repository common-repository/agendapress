
<table width="100%">

	<tr>
		<td valign="top" width="150">
			<br>
			<br>
			<b><?php _e('Description','agendapress'); ?></b>
		</td>
		<td>
			<?php 
			$meta_content = wpautop( self::meta_content_editor_get_meta( 'agenda_general_info_description' ), true);
			wp_editor($meta_content, 'meta_content_editor_agenda_general_info_description', array(
					'wpautop'       =>  true,
					'media_buttons' =>      false,
					'textarea_name' =>      'agenda_general_info_description',
					'textarea_rows' =>      10,
					'teeny'         =>  true
			));
			?>
			<br>
		</td>
	</tr>

</table>

