<style type="text/css">
	#external-events-container {
		padding: 4px;
		border: 1px solid #d5d5d5;
	}

	#external-events-container .fc-event {
	    padding: 8px;
	    float: left;
	    margin:4px;
	}
	#external-events-container .fc-event h4{
	   margin: 2px 0 5px;
	   display: inline-block;
	}
	#external-events-container .fc-event .editlink {
	    display: inline-block;
	    color: #1a252f;
	    background: #fff;
	    border-radius: 3px;
	    text-decoration: none;
	    margin-left: 3px;
	}
	#external-events-container .fc-event .deletelink {
	    display: inline-block;
	    color: #1a252f;
	    background: #fff;
	    border-radius: 3px;
	    text-decoration: none;
	    margin-left: 3px;
	}



	#external-events-container .fc-event .editlink  a{
	    display: inline-block;
	    color: #1a252f;
	    background: #fff;
	    padding: 1px 7px;
	    border-radius: 3px;
	    text-decoration: none;
	}
	#external-events-container .fc-event .deletelink  a{
	    display: inline-block;
	    color: #fff;
	    background: #f00;
	    padding: 1px 7px;
	    border-radius: 3px;
	    text-decoration: none;
	}



	#add_new_session_pop {
    position: fixed;
    left: 50%;
    top: 0;
	right: 0;
    z-index: 1000000;
	bottom: 0;

	}
	#add_new_session_pop_over {
    background: #000;
    opacity: 0.7;
    filter: alpha(opacity=70);
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 100050;
	}

	#add_new_session_pop_inner_inner {
    position: fixed;
    z-index: 100051;
    width: 600px;
    height: 550px;
    left: 50%;
    background: #fff;
    top: 50px;

    
    transform: translate(-50%, -0%);


    background-color: #fff;

    -webkit-box-shadow: 0 3px 6px rgba( 0, 0, 0, 0.3 );
    box-shadow: 0 3px 6px rgba( 0, 0, 0, 0.3 );




	}
	.pop_cont {
		overflow-y: scroll;
		height: 490px;
		padding: 15px;
	}.pop_title{
		background: #fcfcfc;
    border-bottom: 1px solid #ddd;
    line-height: 29px;
    padding-left: 15px;
    height: 29px;
	}
.pop_title span{
	font-size: 29px;
    position: absolute;
    right: 0px;
    line-height: 20px;
    right: 0px;
    height: 29px;
    width: 29px;
    text-align: center;
    cursor: pointer;
}

</style>
<div id='external-events-container' class="wp-clearfix">
	<div id='external-events'>
		<?php foreach ($session as $key => $value) { ?>
			<div class='fc-event' data-id="<?php echo $value->ID; ?>" <?php if(get_post_meta($value->ID, 'repeat', true)) {?> data-repeat="true" <?php } ?>> 
				<h4 class="title"> <?php echo get_the_title($value->ID); ?>
				</h4>
				<span class="editlink">
					<a href="<?php echo get_edit_post_link($value->ID); ?>">Edit</a>
				</span>
				<span class="deletelink">
					<a href="#" data-id="<?php echo $value->ID; ?>">Delete</a>
				</span>
			</div>
		<?php } ?>
	</div>
</div>
<br>



<a class="button button-primary button-large add_new_session_pop_button" href="#" title="Add New Session">Add New Session</a>

<div id="add_new_session_pop" style="display:none;">
	<div id="add_new_session_pop_over"></div>

<div id="add_new_session_pop_inner">

<div id="add_new_session_pop_inner_inner">

<div class="pop_title">
	<b>Add New Session</b> <span>&times;</span>
</div>
<div class="pop_cont">
	<input type="hidden" name="event" value="<?php echo $post->ID; ?>">
	<table width="100%">
		<tr>
			<td>
				<b><?php _e('Session Title','agendapress'); ?></b>
			</td>
			<td>
				<input type="text" name="title" style="width: 100%">
			</td>
		</tr>
		<tr>
			<td>
				<b><?php _e('Session Type','agendapress'); ?></b>
			</td>
			<td>
				<select name="session_type">
					<option value="0">Select Session Type</option>
					<option value="Plenary">Plenary</option>
					<option value="Relax">Relax</option>
					<option value="Blank">Blank</option>
					<option value="Break Out">Break Out</option>
					<option value="Workshop">Workshop</option>
					<option value="Optional">Optional</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<b></b>
			</td>
			<td>
				<input type="checkbox" name="repeat"> <?php _e('Repeatable','agendapress'); ?>
			</td>
		</tr>
		<tr>
			<td valign="top" width="150">
				<br>
				<br>
				<b><?php _e('Summery','agendapress'); ?></b>
			</td>
			<td>
				<?php 
		
				wp_editor('', 'meta_content_editor_session_general_info_summery', array(
						'wpautop'       =>  true,
						'media_buttons' =>      false,
						'textarea_name' =>      'session_general_info_summery',
						'textarea_rows' =>      5,
						'teeny'         =>  true,
						'dfw'           => true,
						'tinymce' => true,
						
				));
				?>
				<br>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<br>
				<br>
				<b><?php _e('Aditional Details','agendapress'); ?></b>
			</td>
			<td>
				<?php 
		
				wp_editor('', 'meta_content_editor_session_general_info_aditional_details', array(
						'wpautop'       =>  true,
						'media_buttons' => false,
						'textarea_name' => 'session_general_info_aditional_details',
						'textarea_rows' => 5,
						'teeny'         => true,
						'dfw'           => true,
						//'tinymce' => array(  )
				));
				?>
				<br>
				<label>
					<input type="checkbox" name="more_link"> Show/Hide 'More' Link
				</label>
				<br>
			</td>
		</tr>
		<tr>
			<td width="150" valign="top">
				<b><?php _e('Speaker','agendapress'); ?></b>
			</td>
			<td>
				<select name="speaker[]" multiple>
					<option value="0">Select Speaker</option>
					<?php echo self::get_post_as_option('speaker', false); ?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="150" valign="top">
				<b><?php _e('Venue','agendapress'); ?></b>
			</td>
			<td>
				<select name="venue">
					<option value="0">Select Venue</option>
					<?php echo self::get_post_as_option_group('venue', false); ?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="150" valign="top">
				
			</td>
			<td>
				<br>
			<button class="button button-primary button-large add_new_session_button" type="button">Add New Session</button>
			</td>
		</tr>

	</table>
</div>
</div>
</div>
</div>