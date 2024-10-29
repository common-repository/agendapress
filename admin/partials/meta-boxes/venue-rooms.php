
<table width="100%">
	<?php if($rooms) { foreach ($rooms as $key => $room) { ?>
	<tr>
		<td>
			<input type="text" name="rooms[]" value="<?php echo $room; ?>">
		</td>
	</tr>
	<?php } } ?>
	<tr>
		<td>
			<button type="button" id="add-new-room">Add New</button>
		</td>
		
	</tr>
</table>