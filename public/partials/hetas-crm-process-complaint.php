<?php
$public = new Hetas_Crm_Complaints_Public('HETAS CRM complaints','1.0.0');
$call = new Dynamics_crm('crm','1.0.0');

if ( ! isset( $_POST['hetas_complaints_nonce'] ) || ! wp_verify_nonce( $_POST['hetas_complaints_nonce'], 'hetas_process_complaint' ) ) {

	print 'Sorry, your nonce did not verify.';
	exit;

} else {
	
	$contactid = $_POST['contactid'];

	// if no contact id
	if(empty($contactid) || $contactid == '') {
		
		error_log('No contact ID was submitted so checking cross checking contact by email address.');

		// check contact by email and assign contact id
		$contact_email_address = $_POST['emailaddress1'];
		
		$response = $call->search_contact_from_crm_by_email_address($contact_email_address);
		if (!empty($response->value)) {
			
			error_log('Contact ID: ' . $contactid . ' was found to using this to update as per this complaint.');

			$contactid = $response->value[0]->contactid;
			
			// Jaz (HETAS) agreed that this data should be updated for this contact if a complain it made at this point
			$update_contact = $public->create_contact_object($_POST);	 
			$update_contact = $call->update_contact_by_id($contactid, $update_contact);	 
			
			error_log('Contact ID: ' . $contactid . ' updated.');

		} else {
			// if contact does not exists create one and assign contact id
			error_log('No contact exists to creating a new one.');
			$new_contact = $public->create_contact_object($_POST);			
			$response = $call->post_new_contact_for_crm($new_contact);
			$contactid = $response->contactid;
			error_log('New contact ID: '. $contactid .' was created.');
		}
		
		$_POST['contactid'] = $contactid;

	}

	/*
		at this point we should have a $contactid so now post the complaint case
	*/
	
	// Jaz (HETAS) agreed that this data should be updated for this contact if a complain it made at this point
	$update_contact = $public->create_contact_object($_POST);	 
	$update_contact = $call->update_contact_by_id($contactid, $update_contact);	 
	
	error_log('Contact ID: ' . $contactid . ' updated.');
	
	// create an json object
	$object = $public->create_complaint_object($_POST);
	// post to the CRM
	$complaint_response = $call->post_complaint_to_crm($object);

	wp_safe_redirect( esc_url( '/hetas-complaint-submitted/' ).'?complaint-ref='.$complaint_response->ticketnumber);
	exit;

}