
<table width="100%">
	<tr>
		<td>
			<b><?php 
_e( 'Event', 'agendapress' );
?></b>
		</td>
		<td>
			<select name="gt[event]">
				<option value="0">Select Event</option>
				<?php 
echo  self::get_post_as_option( 'agenda', $event ) ;
?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<b><?php 
_e( 'Session Type', 'agendapress' );
?></b>
		</td>
		<td>
			<select name="gt[session_type]">
				<option value="0">Select Session Type</option>
<?php 

if ( age_fs()->is_not_paying() ) {
    ?>
		<option <?php 
    if ( $session_type === 'Plenary' ) {
        echo  "selected" ;
    }
    ?> value="Plenary">Plenary</option>
		<?php 
}

?>



			</select>
		</td>
	</tr>
	<tr>
		<td>
			<b></b>
		</td>
		<td>
			<input type="checkbox" name="repeat"  <?php 
if ( $repeat ) {
    echo  'checked' ;
}
?>> <?php 
_e( 'Repeatable', 'agendapress' );
?>
		</td>
	</tr>
	<tr>
		<td valign="top" width="150">
			<br>
			<br>
			<b><?php 
_e( 'Summery', 'agendapress' );
?></b>
		</td>
		<td>
			<?php 
$meta_content = wpautop( self::meta_content_editor_get_meta( 'session_general_info_summery' ), true );
wp_editor( $meta_content, 'meta_content_editor_session_general_info_summery', array(
    'wpautop'       => true,
    'media_buttons' => false,
    'textarea_name' => 'session_general_info_summery',
    'textarea_rows' => 5,
    'teeny'         => true,
) );
?>
			<br>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<br>
			<br>
			<b><?php 
_e( 'Aditional Details', 'agendapress' );
?></b>
		</td>
		<td>
			<?php 
$meta_content = wpautop( self::meta_content_editor_get_meta( 'session_general_info_aditional_details' ), true );
wp_editor( $meta_content, 'meta_content_editor_session_general_info_aditional_details', array(
    'wpautop'       => true,
    'media_buttons' => false,
    'textarea_name' => 'session_general_info_aditional_details',
    'textarea_rows' => 5,
    'teeny'         => true,
) );
?>
			<br>
			<label>
				<input type="checkbox" name="more_link" <?php 
if ( $more_link ) {
    echo  "checked" ;
}
?>> Show/Hide 'More' Link
			</label>
			<br>
		</td>
	</tr>
</table>