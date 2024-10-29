<?php
namespace Agendapress\Agendapress_Admin;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wordpress.org/plugins/agendapress
 * @since      1.0.0
 *
 * @package    Agendapress
 * @subpackage Agendapress/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Agendapress
 * @subpackage Agendapress/admin
 * @author     Md Kabir Uddin <bd.kabiruddin@gmail.com>
 */
class Agendapress_Admin {

	use \Agendapress\Includes\Traits\Agendapress_Posts;

	use \Agendapress\Includes\Traits\Agendapress_Post_Meta;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Agendapress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Agendapress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name.'-jquery-ui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.css', array(), $this->version, 'all');
		wp_enqueue_style( $this->plugin_name.'-core', plugin_dir_url( __FILE__ ) . 'css/core/main.min.css', array(), $this->version, 'all');
		wp_enqueue_style( $this->plugin_name.'-daygrid', plugin_dir_url( __FILE__ ) . 'css/daygrid/main.min.css', array(), $this->version, 'all');
		wp_enqueue_style( $this->plugin_name.'-timegrid', plugin_dir_url( __FILE__ ) . 'css/timegrid/main.min.css', array(), $this->version, 'all');
		wp_enqueue_style( $this->plugin_name.'-list', plugin_dir_url( __FILE__ ) . 'css/list/main.min.css', array(), $this->version, 'all');
		wp_enqueue_style( $this->plugin_name.'-timepicker', plugin_dir_url( __FILE__ ) . 'css/timepicker/jquery.timepicker.css', array(), $this->version, 'all');
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/agendapress-admin.css', array(), $this->version, 'all' );
	}




	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Agendapress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Agendapress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_style( 'jquery-ui' );
		wp_enqueue_script( $this->plugin_name.'-core', plugin_dir_url( __FILE__ ) . 'js/core/main.min.js');
		wp_enqueue_script( $this->plugin_name.'-interaction', plugin_dir_url( __FILE__ ) . 'js/interaction/main.min.js');
		wp_enqueue_script( $this->plugin_name.'-daygrid', plugin_dir_url( __FILE__ ) . 'js/daygrid/main.min.js');
		wp_enqueue_script( $this->plugin_name.'-timegrid', plugin_dir_url( __FILE__ ) . 'js/timegrid/main.min.js');
		wp_enqueue_script( $this->plugin_name.'-resource-common', plugin_dir_url( __FILE__ ) . 'js/resource-common/main.min.js');
		wp_enqueue_script( $this->plugin_name.'-resource-daygrid', plugin_dir_url( __FILE__ ) . 'js/resource-daygrid/main.min.js');
		wp_enqueue_script( $this->plugin_name.'-resource-timegrid', plugin_dir_url( __FILE__ ) . 'js/resource-timegrid/main.min.js');
		wp_enqueue_script( $this->plugin_name.'-moment', plugin_dir_url( __FILE__ ) . 'js/moment.min.js');
		wp_enqueue_script( $this->plugin_name.'-list', plugin_dir_url( __FILE__ ) . 'js/list/main.min.js');
		wp_enqueue_script( $this->plugin_name.'-timepicker', plugin_dir_url( __FILE__ ) . 'js/timepicker/jquery.timepicker.js');
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/agendapress-admin.js', array( 'jquery' ), $this->version, false );

		global $post;
		if($post) {
			$translation_array = array(
				'site_url' => site_url(),
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'post_id' => $post->ID
			);

			wp_localize_script( $this->plugin_name, $this->plugin_name, $translation_array );
		}

	}

	/**
	 * Register the Admin menu for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function admin_menu() {
		add_menu_page( __( 'AgendaPress', 'agendapress' ), __( 'AgendaPress', 'agendapress' ), 'manage_options', 'agendapress', array( $this, 'options_panel' ), 'dashicons-calendar', 25 );
		add_submenu_page( 'agendapress', __( 'Settings', 'agendapress' ), __( 'Settings', 'agendapress' ), 'manage_options', 'agendapress-settings', array( $this, 'settings_panel' ) );
	}


	/**
	 * Register the 
	 *
	 * @since    1.0.0
	 */
	public function register_rest_route_agenda_sessions (){
		register_rest_route('agendapress/v1', '/agenda/(?P<id>\d+)/sessions', array(
			'methods' => 'GET',
			'callback' => array($this , 'route_agenda_sessions'),
			'permission_callback' => array($this , 'permission_callback_func'),
		));
	}

	/**
	 * Register the 
	 *
	 * @since    1.0.0
	 */
	public function register_rest_route_agenda_resources (){
		register_rest_route('agendapress/v1', '/agenda/(?P<id>\d+)/resources', array(
			'methods' => 'GET',
			'callback' => array($this , 'route_agenda_resources'),
			'permission_callback' => array($this , 'permission_callback_func'),

		));
	}
	/**
	 * Register the 
	 *
	 * @since    1.0.0
	 */
	public function permission_callback_func (){
		return true;
	}

	/**
	 * Register the 
	 *
	 * @since    1.0.0
	 */
	public function settings_panel (){

		$active_tab = isset( $_GET[ 'tab' ] ) ? sanitize_text_field($_GET[ 'tab' ]) : 'general';

		?>
		<style type="text/css">
			.screen-elements th,
			.screen-elements td{
				padding: 8px;
			}
		</style>




			<div class="wrap">
			<h2 class="nav-tab-wrapper">
				<a href="?page=agendapress-settings&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>"><?php _e('General Settings', 'agendapress'); ?>  </a>
				<?php do_action( 'rename_fields',  $active_tab); ?>
			</h2>
			<br>

			<?php
			if( $active_tab == 'screen' ) {
				if(isset($_POST['submit'])){
					check_admin_referer( 'screen_elements' );
					
					if(isset($_POST['screen_type'])){
						$screen_type = $_POST['screen_type'];
						update_option( 'screen_type', 'custom' );
						$screen_elements = $_POST['screen_elements'];
						
					} else {
						$screen_type = 'default';
						update_option( 'screen_type', 'default' );
						$screen_elements = array();
					}


					update_option( 'screen_elements', $screen_elements );

					
					

				}

			?>
				<h2>Screen Elements</h2>
				

				<?php 
				$screen_type = get_option( 'screen_type');
				$screen_elements = get_option( 'screen_elements');


				?>
				<div class="screen-elements">
					<form method="post" action="">
						<?php wp_nonce_field( 'screen_elements' ); // check_admin_referer( 'screen_elements' ); ?>
					
				<table border="1">
					<tr>
						<th>Word Used In AgendaPress</th>
						<th colspan="4">Equivalent Term for a Different Type of Event</th>
					</tr>
					<tr>
						<th valign="top">Default <br> </th>
						<th valign="top"><label>Custom <br> <input <?php if($screen_type==='custom'){echo "checked";} ?> type="checkbox" name="screen_type"></label></th>

					</tr>
					<tr>
						<td>Agenda/ Agendas</td>
						<td><input type="text" name="screen_elements[custom][agenda]" value="<?php echo $screen_elements['custom']['agenda']; ?>"></td>

					</tr>

					<tr>
						<td>Meeting / Meetings</td>
						<td><input type="text" name="screen_elements[custom][meeting]" value="<?php echo $screen_elements['custom']['meeting']; ?>"></td>

					</tr>
					<tr>
						<td>Organization / Organizations</td>
						<td><input type="text" name="screen_elements[custom][organization]" value="<?php echo $screen_elements['custom']['organization']; ?>"></td>

					</tr>
					<tr>
						<td>Session / Sessions</td>
						<td><input type="text" name="screen_elements[custom][session]" value="<?php echo $screen_elements['custom']['session']; ?>"></td>

					</tr>
					<tr>
						<td>Speaker / Speakers</td>
						<td><input type="text" name="screen_elements[custom][speaker]" value="<?php echo $screen_elements['custom']['speaker']; ?>"></td>

					</tr>
					<tr>
						<td>Venue / Venues</td>
						<td><input type="text" name="screen_elements[custom][venue]" value="<?php echo $screen_elements['custom']['venue']; ?>"></td>

					</tr>
					<tr>
						<td colspan="5">
							<input type="submit" name="submit">
						</td>
					</tr>
				</table>
</form>
				</div>

			<?php
			 }
			?>

			</div>
		<?php
	}

	/**
	 * Register the 
	 *
	 * @since    1.0.0
	 */
	public function route_agenda_sessions($object_id){
		$session = get_post_meta($object_id['id'], 'listed_session', true) ? get_post_meta($object_id['id'], 'listed_session', true) : array();
		foreach ($session as $key => $value) {
			$value->title = get_the_title($value->id);
			$value->editlink = '<a href="'.site_url().'/wp-admin/post.php?post='.$value->id.'&action=edit">Edit</a>';
		}
		$sessionnew = array();
		foreach ($session as $key => $value1) {
			array_push($sessionnew, $value1);
		}
		return $sessionnew;
	}

	/**
	 * Register the 
	 *
	 * @since    1.0.0
	 */
	public function route_agenda_resources($object_id){
		return $this->get_agenda_resources($object_id['id']);
	}

	public function get_agenda_resources($post_id){
		$args = array(
			'post_type'  => 'session',
			'meta_query' => array(
				array(
					'key'     => 'event',
					'value'   => $post_id,
					'compare' => 'IN',
				),
			),
		);
		$query = new \WP_Query( $args );
		$venue = array();
		$in_out_room = array();
		if($query->posts){
			foreach ($query->posts as $key => $session) {

				$venue_id = get_post_meta($session->ID, 'venue', true);
				if($venue_id) {
					$venue_id = explode(':', $venue_id);
					if( count($venue_id) === 2) {
						array_push($in_out_room, 'in');
					}
					if( count($venue_id) === 1 ) {
						array_push($in_out_room, 'out');
					}
					$venue_id = $venue_id[0];
					array_push($venue, $venue_id);
				}
			}
		}
		$venue = array_unique($venue);

		$in_out_room = array_unique($in_out_room);
		$venue = current($venue);

		$allres = array();

		if(in_array('out', $in_out_room)){
			array_push($allres, 'Open Ground');
		}
		
		if(in_array('in', $in_out_room)){
			$rooms = get_post_meta($venue, 'rooms', true) ? get_post_meta($venue, 'rooms', true) : array();
			foreach ($rooms as $key => $value) {
				array_push($allres, $value);
			}
		}


		$resources = array();

		foreach ($allres as $key => $ress) {
			array_push($resources, array(
					'id'=>strtolower(str_replace(' ', '_', $ress)), 
					'title'=> $ress 
				)
			);
		}
		
		if(empty($resources)){
			$resources = array( array(
				'id'=> 'no', 
				'title'=> '' 
			));
		}

		return $resources;

	}




	public function update_agenda_session(){

		$post_id = null;
		if(isset($_POST['post_id'])){
			$post_id = $_POST['post_id'];
			unset($_POST['action']);
			unset($_POST['post_id']);
		}

		$listed_session = get_post_meta($post_id, 'listed_session', true) ? get_post_meta($post_id, 'listed_session', true) : array();

		$start = new \DateTime($_POST['start']);

		$_POST['start'] = $start->format(\DateTime::ATOM);

		if(isset($_POST['old_start'])){
			$old_start = new \DateTime($_POST['old_start']);
			$_POST['old_start'] = $old_start->format(\DateTime::ATOM);
		} else {
			$_POST['old_start'] = null;
		}

		if(isset($_POST['end'])){
			$end = new \DateTime($_POST['end']);
			$_POST['end'] = $end->format(\DateTime::ATOM);
		} else {
			$start->add(new \DateInterval('PT15M'));
			$_POST['end'] = $start->format(\DateTime::ATOM);
		}

		if($_POST['type']=='add'){
			unset($_POST['type']);
			array_push($listed_session, (object) $_POST);
		}

		if($_POST['type']=='update'){
			unset($_POST['type']);

			$uniqkeyx = null;

			if($_POST['id']) {
				if( get_post_meta($_POST['id'], 'repeat', true)) {
					if($_POST['old_start']){
						$uniqkeyx = $_POST['resourceId'].'_'.$_POST['id'].'_'.preg_replace('/[^a-zA-Z0-9]+/', '', $_POST['old_start']);
					} else {
						$uniqkeyx = $_POST['resourceId'].'_'.$_POST['id'].'_'.preg_replace('/[^a-zA-Z0-9]+/', '', $_POST['start']);
					}
				} else {
					$uniqkeyx = $_POST['id'];
				}
			}

			foreach ($listed_session as $keyv => $value) {
				if($value->id) {
					if( get_post_meta($value->id, 'repeat', true)) {
						$uniqkeyxy = $value->resourceId.'_'.$value->id.'_'.preg_replace('/[^a-zA-Z0-9]+/', '', $value->start);
					} else {
						$uniqkeyxy = $value->id;
					}
				}
				if($uniqkeyxy===$uniqkeyx) {
					$listed_session[$keyv] = (object) $_POST;
				}
			}
		}

		$unq = array();
		
		foreach ($listed_session as $key => $value) {
			if($value->id) {
				if( get_post_meta($value->id, 'repeat', true)) {
					$uniqkey = $value->resourceId.'_'.$value->id.'_'.preg_replace('/[^a-zA-Z0-9]+/', '', $value->start);
				} else {
					$uniqkey = $value->id;
				}
				$unq[$uniqkey] = $value;
			}
		}

		$un2 = array();
		foreach ($unq as $key2 => $value2) {
			array_push($un2 , $value2);
		}
		update_post_meta($post_id, 'listed_session', $un2);
		die();
	}

	public function delete_agenda_session(){
		$post_id = null;
		if(isset($_POST['post_id'])){
			$post_id = $_POST['post_id'];
		}
		$start = new \DateTime($_POST['start']);
		$_POST['start'] = $start->format(\DateTime::ATOM);
		$listed_session = get_post_meta($post_id, 'listed_session', true) ? get_post_meta($post_id, 'listed_session', true) : array();
		foreach ($listed_session as $key => $value) {
			if($value->id===$_POST['id'] && $value->start===$_POST['start']){
				unset($listed_session[$key]);
			}
		}
		update_post_meta($post_id, 'listed_session', $listed_session);
		die();
	}

	public function delete_session(){
		$id = null;
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			wp_delete_post($id);
		}
		die();
	}


	public function set_agenda_columns($columns) {
		$columns['shortcode'] = __( 'Shortcode', 'agendapress' );
		return $columns;
	}
	public function agenda_columns( $column, $post_id ) {
		switch ( $column ) {
			case 'shortcode' :
				echo '[agenda id='.$post_id.']'; 
				break;
		}
	}

	public function set_session_columns($columns) {
		$columns['event'] = __( 'Event', 'agendapress' );
		$columns['venue'] = __( 'Venue', 'agendapress' );
		$columns['session_type'] = __( 'Type', 'agendapress' );
		return $columns;
	}

	public function set_session_sortable_columns($columns) {
		$columns['event'] = 'event';
		$columns['session_type'] = 'session_type';
		$columns['venue'] = 'venue';
		return $columns;
	}

	public function session_columns( $column, $post_id ) {
		switch ( $column ) {
			case 'event' :
				if(get_post_meta($post_id, 'event', true)){
					echo get_the_title(get_post_meta($post_id, 'event', true));
				}
				break;
			case 'venue' :
				if(get_post_meta($post_id, 'venue', true)){
					$venue = get_post_meta($post_id, 'venue', true);
					$venue = explode(':', $venue);
					if(count($venue)>1){
						echo get_the_title($venue[0]).' : '.$venue[1];
					} else {
						echo get_the_title($venue[0]);
					}
				}
				break;
			case 'session_type' :
				if(get_post_meta($post_id, 'session_type', true)){
					echo get_post_meta($post_id, 'session_type', true);
				}
				break;
		}
	}

	public function set_venue_columns($columns) {
		$columns['shortcode'] = __( 'Shortcode', 'agendapress' );
		return $columns;
	}
	public function venue_columns( $column, $post_id ) {
		switch ( $column ) {
			case 'shortcode' :
				echo '[venue id='.$post_id.']'; 
				break;
		}
	}

	public function set_speaker_columns($columns) {
		$columns['organization'] = __( 'Organization', 'agendapress' );
		$columns['shortcode'] = __( 'Shortcode', 'agendapress' );
		return $columns;
	}

	public function set_speaker_sortable_columns($columns) {
		$columns['organization'] = 'organization';
		return $columns;
	}

	public function speaker_columns( $column, $post_id ) {
		switch ( $column ) {
			case 'organization' :
				if(get_post_meta($post_id, 'organization', true)){
					echo  get_the_title(get_post_meta($post_id, 'organization', true));
				}
				
				break; 	    	
			case 'shortcode' :
				echo '[speaker id='.$post_id.']'; 
				break;
		}
	}

	public function set_organization_columns($columns) {
		$columns['shortcode'] = __( 'Shortcode', 'agendapress' );
		return $columns;
	}

	public function organization_columns( $column, $post_id ) {
		switch ( $column ) {
			case 'shortcode' :
				echo '[organization id='.$post_id.']'; 
				break;
		}
	}


	public function custom_orderby( $query ) {
		
		$orderby = $query->get( 'orderby');
		
		if( 'organization' == $orderby ) {
			$query->set('meta_key','organization');
			$query->set('orderby','meta_value');
		}

		if( 'session_type' == $orderby ) {
			$query->set('meta_key','session_type');
			$query->set('orderby','meta_value');
		}

		if( 'event' == $orderby ) {
			$query->set('meta_key','event');
			$query->set('orderby','meta_value');
		}
	}

	public function create_new_session_aj(  ) {
		
		// Create post object
		$my_post = array(
		  'post_title'    => wp_strip_all_tags( $_POST['title'] ),
		  'post_content'  => false,
		  'post_status'   => 'publish',
		  'post_type' => 'session',
		);
		 
		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );

		if($post_id){

			if ( isset( $_POST['event'] ) ){

				update_post_meta( $post_id, 'event',  $_POST['event']  );
			} else {
				delete_post_meta( $post_id, 'event');
			}

			if ( isset( $_POST['session_type'] ) ){
				update_post_meta( $post_id, 'session_type',  $_POST['session_type']  );
			} else {
				delete_post_meta( $post_id, 'session_type');
			}

			if ( isset( $_POST['session_general_info_summery'] ) ){
				update_post_meta( $post_id, 'session_general_info_summery', $_POST['session_general_info_summery'] );
			}

			if ( isset( $_POST['session_general_info_aditional_details'] ) ){
				update_post_meta( $post_id, 'session_general_info_aditional_details', $_POST['session_general_info_aditional_details'] );
			}

			if ( isset( $_POST['more_link'] ) ){
				update_post_meta( $post_id, 'more_link',  $_POST['more_link']  );
			} else {
				delete_post_meta( $post_id, 'more_link');
			}

			if ( isset( $_POST['repeat'] ) ){
				update_post_meta( $post_id, 'repeat',  $_POST['repeat']  );
			} else {
				delete_post_meta( $post_id, 'repeat');
			}

			if ( isset( $_POST['speaker'] ) ){
				update_post_meta( $post_id, 'speaker', $_POST['speaker'] );
			}

			if ( isset( $_POST['venue'] ) ){
				update_post_meta( $post_id, 'venue',  $_POST['venue']  );
			}
			echo "success";

		}
		die();
	}





}