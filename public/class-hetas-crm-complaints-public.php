<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://squareone.software
 * @since      1.0.0
 *
 * @package    Hetas_Crm_Complaints
 * @subpackage Hetas_Crm_Complaints/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Hetas_Crm_Complaints
 * @subpackage Hetas_Crm_Complaints/public
 * @author     Elliott Richmond <elliott@squareonemd.co.uk>
 */
class Hetas_Crm_Complaints_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hetas_Crm_Complaints_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hetas_Crm_Complaints_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hetas-crm-complaints-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hetas_Crm_Complaints_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hetas_Crm_Complaints_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hetas-crm-complaints-public.js', array( 'jquery', 'jquery-ui-datepicker' ), $this->version, true );
		wp_localize_script( $this->plugin_name, 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'nextNonce' => wp_create_nonce( 'ajax-call-nonce' ) ) );

	}
	
	public function hetas_submit_complaint_questionnaire($template) {

		if ( is_page( 'hetas-complaints-questionnaire' ) ) {

			$new_template = plugin_dir_path( __FILE__ ) . 'partials/hetas-crm-complaints-questionnaire.php';
			if ( !empty( $new_template ) ) {
				return $new_template;
			}
		}
	
		if ( is_page( 'hetas-process-complaint' ) ) {

			$new_template = plugin_dir_path( __FILE__ ) . 'partials/hetas-crm-process-complaint.php';
			if ( !empty( $new_template ) ) {
				return $new_template;
			}
		}
	
		if ( is_page( 'hetas-complaint-submitted' ) ) {

			$new_template = plugin_dir_path( __FILE__ ) . 'partials/hetas-complaint-submitted.php';
			if ( !empty( $new_template ) ) {
				return $new_template;
			}
		}
	
		return $template;

	}

	/*
	 * Add an ajax search for notification reference.
	 */
	public function crm_search_notification_reference() {
		
	    $nonce = $_POST['nextNonce'];
		if ( ! wp_verify_nonce( $nonce, 'ajax-call-nonce' ) ) {
			die ( 'Busted!' );
		}
		
		$van_name = $_POST['van_name'];
		
		$call = new Dynamics_crm('crm','1.0.0');
		$response = $call->get_crm_notification_by_van_name($van_name);
		$notification_items = $call->get_notification_items_by_notification_id($response->value[0]->van_notificationid);
		$consumer = $call->get_contact_by_contact_id($response->value[0]->_van_consumerid_value);
		$installing_operative = $call->get_operative_by_van_operativeid($notification_items->value[0]->_van_operativeid_value);
		$business = $call->get_business_by_accountid($response->value[0]->_van_businessid_value);
		//$scheme = $call->get_scheme_by_id($response->value[0]->_van_schemeid_value);
		$scheme = $call->get_schemes_by_business_id($response->value[0]->_van_businessid_value);
		
		$array = array(
			$response->value[0],
			$consumer->value[0],
			$business->value[0],
			$scheme->value[0],
			$notification_items->value,
			$installing_operative
		);
		
		//wp_send_json( $response->value[0] );
		wp_send_json( $array );
		
		
		
	    // Don't forget to stop execution afterward.
	    wp_die();
	}
	
	/*
	 * Add an ajax search for operative by operative id.
	 */
	public function get_operative_by_operative_id() {
		
	    $nonce = $_POST['nextNonce'];
		if ( ! wp_verify_nonce( $nonce, 'ajax-call-nonce' ) ) {
			die ( 'Busted!' );
		}
		
		$call = new Dynamics_crm('crm','1.0.0');
		$operative = $call->get_operative_by_van_operativeid($_POST['operative_id']);
		
		wp_send_json( $operative );
	}


	
	/**
	 * prepare contact object
	 *
	 * @since    1.0.0
	 * @return   array
	 */	
	public function create_contact_object($postdata) {
		
		$object = array(
			'firstname' => $postdata['firstname'],
			'lastname' => $postdata['lastname'],
			'address1_name' => $postdata['address1_name'],
			'address1_line1' => $$postdata['address1_line1'],
			'address1_line2' => $postdata['address1_line2'],
			'address1_line3' => $$postdata['address1_line3'],
			'address1_city' => $postdata['address1_city'],
			'address1_county' => $$postdata['address1_county'],
			'address1_postalcode' => $postdata['address1_postalcode'],
			'telephone1' => $postdata['telephone1'],
			'mobilephone' => $postdata['mobilephone'],
			'emailaddress1' => $postdata['emailaddress1'],
			'description' => $postdata['relationship'],
		);
		
		return json_encode($object);
	}
	
	/**
	 * helper to check string exists from checked box
	 *
	 * @since    1.0.0
	 * @return   boolen
	 */	
	public function naturecomplaint_string_check($string, $nature) {
		if (in_array($string, $nature)) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * prepare contact object
	 *
	 * @since    1.0.0
	 * @return   array
	 */	
	public function create_complaint_object($postdata) {
		
		$nature = $postdata['naturecomplaint'];
		
		$workcompletiondate = str_replace('+00:00', 'Z', gmdate('c', strtotime($_POST['van_workcompletiondate'])));

		$object = array(
		  'casetypecode' => '2',
		  'customerid_contact@odata.bind' => 'contacts('.$postdata['contactid'].')',
		  'van_BusinessId@odata.bind' => 'accounts('.$postdata['businessid'].')',
		  'van_SchemeId@odata.bind' => 'van_schemes('.$postdata['schemeid'].')',
		  'van_OperativeId@odata.bind' => 'van_operatives('.$postdata['operativeid'].')',
		  'van_NotificationId@odata.bind' => 'van_notifications('.$postdata['notifictionid'].')',
		  'subjectid@odata.bind'  => 'subjects(37a45192-57f5-e711-80d0-00155d050ffd)',
		  'van_complainttype' => '806070001',
		  'title' => 'HETAS Website Complaint from ' . $postdata['firstname'] .' '.$postdata['lastname'],
		  'van_completiondate' => $workcompletiondate,
		  'van_wasquotationestimateprovided' => $postdata['quotation_estimate'] ? true : false,
		  'van_wasinvoiceprovided' => $postdata['invoice_provided'] ? true : false,
		  'van_nocertificateofcompliance' => $this->naturecomplaint_string_check('no_certificate_of_compliance', $nature),
		  'van_incorrecthearth' => $this->naturecomplaint_string_check('incorrect_hearth', $nature),
		  'van_insufficientventilation' => $this->naturecomplaint_string_check('insufficient_ventilation', $nature),
		  'van_nodataplate' => $this->naturecomplaint_string_check('No_data_plate', $nature),
		  'van_flue' => $this->naturecomplaint_string_check('flue', $nature),
		  'van_fireprotection' => $this->naturecomplaint_string_check('fire_protection', $nature),
		  'van_installationworkmanship' => $this->naturecomplaint_string_check('installation_workmanship', $nature),
		  'van_mcs' => $this->naturecomplaint_string_check('mcs', $nature),
		  'van_carbonmonoxidedetectoralarm' => $this->naturecomplaint_string_check('carbon_monoxide_detectoralarm', $nature),
		  'van_hotwaterheatingsystemwetinstallation' => $this->naturecomplaint_string_check('hot_waterheating_system_wet_installation', $nature),
		  'van_smokenuisancetoneighbours' => $this->naturecomplaint_string_check('smokenuisance_to_neighbours', $nature),
		  'van_thirdpartywhohasalteredtheinstallation' => $postdata['altered_installation'] ? true : false,
		  'van_istheinstallationsubjecttolegalproceeding' => $postdata['installation_legal_proceedings'] ? true : false,
		  'van_haspaymentbeenmadeinfulltotheinstaller' => $postdata['full_payment_made'] ? true : false,
		  'van_details' => $postdata['full_payment_made_details'],
		  'description' => $postdata['relationship'],
// 		  'van_reasonsfornotproceedingwiththecomplaint' => '806070001',
// 		  'van_dateofemedialworkcompleted' => '2019-01-20T00 => 00 => 00Z',
// 		  'van_detailsofremedialworkcompleted' => 'Text Text',
// 		  'van_declarationdate' => '2019-01-20T00 => 00 => 00Z',
// 		  'van_acknowledgementlettersentconsumer' => true,
// 		  'van_inspectionlettersentconsumerandinstaller' => true,
// 		  'van_remediallettersentconsumerandinstaller' => true,
// 		  'van_closurelettersentconsumerandinstaller' => true,
// 		  'van_inspectioninvoiceraised' => true,
// 		  'van_displaycomplaintresolution' => true
  		);
  		
		return json_encode($object);
	}
	

}
