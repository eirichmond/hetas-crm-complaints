<?php

$complaints_form_elements = array(
	'sections' => array(
			'section' => 'Consumer',
			'cols' => array(
				array( 'fields' => array(
						array(
							'id' => 'consumer_first_name',
							'type' => 'text',
							'label' => 'Your first name',
							'placeholder' => 'Your first name',
							'required' => true
						),
						array(
							'id' => 'consumer_last_name',
							'type' => 'text',
							'label' => 'Your last name',
							'placeholder' => 'Your last name',
							'required' => true
						),
						array(
							'id' => 'consumer_tel',
							'type' => 'text',
							'label' => 'Your telephone',
							'placeholder' => 'Your telephone number',
							'required' => true
						),
						array(
							'id' => 'consumer_mobile',
							'type' => 'text',
							'label' => 'Your mobile',
							'placeholder' => 'Your mobile number',
							'required' => true
						),
						array(
							'id' => 'consumer_email',
							'type' => 'email',
							'label' => 'Your email',
							'placeholder' => 'Your email address',
							'required' => true
						),
					)
				),
				array(
					'fields' => array(
						array(
							'id' => 'consumer_address_line1',
							'type' => 'text',
							'label' => 'Address Line 1',
							'placeholder' => 'Address Line 1',
							'required' => true
						),
						array(
							'id' => 'consumer_address_line2',
							'type' => 'text',
							'label' => 'Address Line 2',
							'placeholder' => 'Address Line 2',
							'required' => true
						),
						array(
							'id' => 'consumer_address_line3',
							'type' => 'text',
							'label' => 'Address Line 3',
							'placeholder' => 'Address Line 3',
							'required' => true
						),
						array(
							'id' => 'consumer_address_city',
							'type' => 'text',
							'label' => 'City/Town',
							'placeholder' => 'City/Town',
							'required' => true
						),
						array(
							'id' => 'consumer_address_county',
							'type' => 'text',
							'label' => 'County',
							'placeholder' => 'County',
							'required' => true
						),
						array(
							'id' => 'consumer_address_postcode',
							'type' => 'text',
							'label' => 'Postcode',
							'placeholder' => 'Postcode',
							'required' => true
						),
					)
				),
			)
		),

		array(
			'section' => 'Certificate of Compliance',
			'description' => 'Details from the Certificate of Compliance* please provide a copy of the certificate when you return this form',
			'cols' => array(
				array( 'fields' => array(
						array(
							'id' => 'work_completion_date',
							'type' => 'text',
							'label' => 'Work Completion Date',
							'placeholder' => 'Work Completion Date',
							'required' => true
						),
						array(
							'id' => 'installing_company_name',
							'type' => 'text',
							'label' => 'Installing Company Name',
							'placeholder' => 'Installing Company Name',
							'required' => true
						),
						array(
							'id' => 'installing_engineers_name',
							'type' => 'text',
							'label' => 'Installing Engineer\'s Name',
							'placeholder' => 'Installing Engineer\'s Name',
							'required' => true
						)
					)
				),
				array(
					'fields' => array(
						array(
							'id' => 'appliance_make_model',
							'type' => 'text',
							'label' => 'Please state the appliance make and model',
							'placeholder' => 'Make and Model',
							'required' => true
						),
						array(
							'id' => 'hetas_registration_number',
							'type' => 'text',
							'label' => 'Company\'s HETAS Reg. No.',
							'placeholder' => 'Company\'s HETAS Reg. No.',
							'required' => true
						),
						array(
							'id' => 'engineers_registration_number',
							'type' => 'text',
							'label' => 'Engineers\'s Reg. No.',
							'placeholder' => 'Engineers\'s Reg. No.',
							'required' => true
						)
					)
				),
			),
			'notes' => array(
				array('*If you have not been issued with a certificate please provide details of the installer’s name and business information;
without this information HETAS cannot pursue a complaint on your behalf.'),
				array('**Please note we can only receive complaints of an installation less than 24 months old.'),
			)
		),
);

//var_dump($complaints_form_elements);

?>

<?php get_header();?>

<h2><?php echo the_title(); ?></h2>

<!-- search CRM by Notification Reference show results -->

<div class="blockpanel bg-success p-15 br-5">

	<div class="row">

		<div class="col-md-7">

			<p>If you know the Notification Reference Number enter it and click the <span class="label label-primary">Search</span> <br>If don't know the Notification Reference Number then click <span class="label label-danger">Skip</span></p>

		</div>
		<div class="col-md-5">

			<form id="notification-reference-search" class="form-inline">
				<div class="form-group">
					<label for="van_name" class="sr-only">Notification Reference</label>
					<input type="text" class="form-control" id="van_name" placeholder="Notification Reference">
				</div>
				<button type="submit" class="btn btn-primary">Search</button>
				<a href="#installation" class="btn btn-danger skip-notification-search" aria-controls="installation" role="tab" data-toggle="tab" data-tabber="pres-2">Skip</a>
			</form>
		</div>

	</div>

</div>

<div class="row" id="crm-sync-calling">

	<div class="col-md-12">

		<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) ?>images/throbber_12.gif" alt="Loading_icon" />

	</div>

</div>

<div id="notification-results">

	<form action="<?php echo home_url('/');?>hetas-process-complaint" method="post">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist" id="nr-tabs">
		<li id="pres-1" role="presentation" class="active"><a href="#results" aria-controls="results" role="tab" data-toggle="tab">Results</a></li>
		<li id="pres-2" role="presentation"><a href="#installation" aria-controls="installation" role="tab" data-toggle="tab">Installation</a></li>
		<li id="pres-3" role="presentation"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Details</a></li>
		<li id="pres-4" role="presentation"><a href="#submit" aria-controls="submit" role="tab" data-toggle="tab">Submit</a></li>
	</ul>


	<!-- Tab panes -->
	<div class="tab-content">

			<div role="tabpanel" class="tab-pane fade in active" id="results">

				<h3>Results</h3>

				<div class="row">
					<div class="col-md-6">

						<div class="result">

							<div class="panel panel-default">
								<div class="panel-heading"><h3 class="panel-title">Contact Information</h3></div>
								<div class="panel-body">
									<dl>
<!--
										<dt>Consumer</dt>
										<dd class="nr-consumer"></dd>
-->
										<dt>Installation Address</dt>
										<dd class="nr-installation-addressline1"></dd>
										<dd class="nr-installation-postcode"></dd>
										<dd class="nr-installation-towncity"></dd>
<!--
										<dt>Tel</dt>
										<dd class="nr-telephone"></dd>
										<dt>Mobile</dt>
										<dd class="nr-mobile"></dd>
										<dt>Email</dt>
										<dd class="nr-email"></dd>
-->
									</dl>

								</div>
							</div>

						</div>

					</div>

					<div class="col-md-6">


						<select id="nitems" class="form-control">

						</select>





						<div class="panel panel-default"  id="nr-details">
							<div class="panel-body">
								<dl>
									<dt>Work Completion Date</dt>
									<dd class="nr-wcompletion"></dd>
									<dt>Appliance Make & Model</dt>
									<dd class="nr-amakemodel"></dd>
									<dt>Installing Company Name</dt>
									<dd class="nr-business-name"></dd>
									<dt>Company's HETAS Reg. No.</dt>
									<dd class="nr-hetas-reg-no"></dd>
									<dt>Installing Engineer</dt>
									<dd class="nr-hetas-reg-installer"></dd>
									<dt>Engineer’s HETAS Reg. No.</dt>
									<dd class="nr-hetas-reg-no"></dd>
									<dt>Date of notification</dt>
									<dd class="nr-notification-date"></dd>
								</dl>

							</div>
						</div>

					</div>
				</div>

				<div class="row">
					<div class="col-md-12 navitabs-right">
						<a href="#installation" class="btn btn-primary btn active buttontab" aria-controls="installation" role="tab" data-toggle="tab" data-tabber="pres-2">Next</a>
					</div>
				</div>

			</div>
			<div role="tabpanel" class="tab-pane fade" id="installation">

				<h3>Are you the Original Consumer?</h3>

				<div class="row">

					<div class="col-md-4">

						<div class="form-group">

							<select id="original-consumer" class="form-control">
								<option></option>
								<option value="yes">Yes</option>
								<option value="no">No</option>
							</select>

						</div>

					</div>

				</div>


				<div id="consumer-details">

					<h3>Installation</h3>

					<div class="row">
						<div class="col-md-4">

							<div class="form-group">

								<label for="firstname" class="control-label">First Name</label>

								<input name="firstname" type="text" class="form-control nr-consumer" id="firstname" placeholder="First Name">

							</div>

						</div>

						<div class="col-md-4">

							<div class="form-group">

								<label for="lastname" class="control-label">Last Name</label>

								<input name="lastname" type="text" class="form-control nr-consumer" id="lastname" placeholder="Last Name">

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-md-8">

							<div class="form-group">

								<label for="relationship" class="control-label">Relationship to consumer</label>

								<textarea name="relationship" class="form-control nr-relationship" rows="3" id="relationship" placeholder="If you are not the consumer, please provide details of your relationship with the consumer. All further correspondence will be directed to the consumer’s address (unless we receive written authority from said consumer)."></textarea>

							</div>

						</div>


					</div>

					<div class="row">
						<div class="col-md-4">

							<div class="form-group">

								<label for="address1_line1" class="control-label">Address Line 1</label>

								<input name="address1_line1" type="text" class="form-control nr-address1_line1" id="address1_line1" placeholder="Address Line 1">

							</div>

						</div>

						<div class="col-md-4">

							<div class="form-group">

								<label for="address1_line2" class="control-label">Address Line 2</label>

								<input name="address1_line2" type="text" class="form-control nr-address1_line2" id="address1_line2" placeholder="Address Line 2">

							</div>

						</div>

						<div class="col-md-4">

							<div class="form-group">

								<label for="address1_line3" class="control-label">Address Line 3</label>

								<input name="address1_line3" type="text" class="form-control nr-address1_line3" id="address1_line3" placeholder="Address Line 3">

							</div>

						</div>

					</div>

					<div class="row">
						<div class="col-md-4">

							<div class="form-group">

								<label for="address1_city" class="control-label">Town/City</label>

								<input name="address1_city" type="text" class="form-control nr-address1_city" id="address1_city" placeholder="Town/City">

							</div>

						</div>

						<div class="col-md-4">

							<div class="form-group">

								<label for="address1_county" class="control-label">County</label>

								<input name="address1_county" type="text" class="form-control nr-address1_county" id="address1_county" placeholder="County">

							</div>

						</div>

						<div class="col-md-4">

							<div class="form-group">

								<label for="address1_postalcode" class="control-label">Postcode</label>

								<input name="address1_postalcode" type="text" class="form-control nr-address1_postalcode" id="address1_postalcode" placeholder="Postcode">

							</div>

						</div>
					</div>

					<div class="row">
						<div class="col-md-4">

							<div class="form-group">

								<label for="telephone1" class="control-label">Telephone</label>

								<input name="telephone1" type="text" class="form-control nr-telephone1" id="telephone1" placeholder="Main Telephone">

							</div>

						</div>

						<div class="col-md-4">

							<div class="form-group">

								<label for="mobilephone" class="control-label">Mobile</label>

								<input name="mobilephone" type="text" class="form-control nr-mobilephone" id="mobilephone" placeholder="Mobile">

							</div>

						</div>
						<div class="col-md-4">
							<div class="form-group">

								<label for="emailaddress1" class="control-label">Email</label>

								<input name="emailaddress1" type="text" class="form-control nr-emailaddress1" id="emailaddress1" placeholder="Email">

							</div>

						</div>
					</div>

				</div>

				<hr>

				<div id="installer-details">

					<h3>Installer details</h3>

					<div class="row">
						<div class="col-md-4">

							<div class="form-group">

								<label for="installername" class="control-label">Installer Name</label>

								<input name="installername" type="text" class="form-control nr-installername" id="installername" placeholder="Installer Name">

							</div>

						</div>

						<div class="col-md-4">

							<div class="form-group">

								<label for="installerregistrationnumber" class="control-label">Installer Registration Number</label>

								<input name="installerregistrationnumber" type="text" class="form-control nr-installerregistrationnumber" id="installerregistrationnumber" placeholder="Installer Registration Number">

							</div>

						</div>

					</div>

				</div>

				<div class="row">
					<div class="col-md-4">

						<div class="form-group">

							<label for="van_workcompletiondate" class="control-label">Work Completion Date</label>

							<input name="van_workcompletiondate" type="text" class="form-control nr-van_workcompletiondate datepicker" id="van_workcompletiondate" placeholder="Work Completion Date" value="">

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label for="makemodel" class="control-label">makemodel</label>

							<input name="makemodel" type="text" class="form-control nr-makemodel" id="makemodel" placeholder="Mobile">

						</div>

					</div>
					<div class="col-md-4">
						<div class="form-group">

							<label for="installing_company_name" class="control-label">Installing Company Name</label>

							<input name="installing_company_name" type="text" class="form-control nr-name" id="name" placeholder="Installing Company Name">

						</div>

					</div>
				</div>

				<div class="row">
					<div class="col-md-4">

						<div class="form-group">

							<label for="van_hetasid" class="control-label">Company HETAS Registration No.</label>

							<input name="van_hetasid" type="text" class="form-control nr-van_hetasid" id="van_hetasid" placeholder="Company HETAS Registration No.">

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label for="van_installersuppliedreference" class="control-label">Installer Reference</label>

							<input name="van_installersuppliedreference" type="text" class="form-control nr-van_installersuppliedreference" id="van_installersuppliedreference" placeholder="Installer Reference">

						</div>

					</div>
					<div class="col-md-4">
						<div class="form-group">

							<label for="van_hetasid" class="control-label">Company HETAS Registration No.</label>

							<input name="van_hetasid" type="text" class="form-control nr-van_hetasid" id="van_hetasid" placeholder="Company HETAS Registration No.">

						</div>

					</div>
				</div>


				<p>*If you have not been issued with a certificate please provide details of the installer’s name and business information; without this information HETAS cannot pursue a complaint on your behalf.</p>
				<p>**Please note we can only receive complaints of an installation less than 24 months old.</p>


				<div class="row">
					<div class="col-md-12 navitabs-right">
						<a href="#details" class="btn btn-primary btn active buttontab" aria-controls="details" role="tab" data-toggle="tab" data-tabber="pres-3">Next</a>
					</div>
				</div>



			</div>
			<div role="tabpanel" class="tab-pane fade" id="details">

				<h3>Were you provided with:</h3>
				<div class="row">
					<div class="col-md-6">

						<div class="form-group">

							<p>A quotation/estimate?</p>
							<small>(If YES, please provide a copy)</small>

							<div class="upload">

								<form action="" method="post" enctype="multipart/form-data">
									Select images to upload: disabled until ER has access to the WT api credentials
									<input type="file" name="quotationUpload" class="btn btn-default" id="quotationUpload" multiple="multiple">
									<!-- ensure wp nounce is inserted for security -->
									<button type="submit" class="btn btn-default" name="submit">Upload</button>
								</form>

							</div>

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<p>An invoice?</p>
							<small>(If YES, please provide a copy)</small>

							<div class="upload">

								<form action="" method="post" enctype="multipart/form-data">
									Select images to upload: disabled until ER has access to the WT api credentials
									<input type="file" name="invoiceUpload" class="btn btn-default" id="invoiceUpload" multiple="multiple">
									<!-- ensure wp nounce is inserted for security -->
									<button type="submit" class="btn btn-default" name="submit">Upload</button>
								</form>

							</div>

						</div>

					</div>
				</div>

				<hr>

				<h3>Nature of complaint – Please tick all that apply:</h3>
				<div class="row">
					<div class="col-md-6">

						<div class="form-group">

							<div class="checkbox">
								<label>
									<input type="checkbox" name="naturecomplaint[]" value="no_certificate_of_compliance">
									No certificate of compliance
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" name="naturecomplaint[]" value="incorrect_hearth">
									Incorrect hearth
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" name="naturecomplaint[]" value="insufficient_ventilation">
									Insufficient ventilation
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" name="naturecomplaint[]" value="No_data_plate">
									No data plate
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" name="naturecomplaint[]" value="flue">
									Flue
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" name="naturecomplaint[]" value="fire_protection">
									Fire Protection
								</label>
							</div>

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<div class="checkbox">
								<label>
									<input type="checkbox" name="naturecomplaint[]" value="installation_workmanship">
									Installation workmanship
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" name="naturecomplaint[]" value="mcs">
									MCS
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" name="naturecomplaint[]" value="carbon_monoxide_detectoralarm">
									Carbon Monoxide Detector/Alarm
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" name="naturecomplaint[]" value="hot_waterheating_system_wet_installation">
									Hot water/heating system (Wet Installation)
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" name="naturecomplaint[]" value="smokenuisance_to_neighbours">
									Smoke / Nuisance to Neighbours
								</label>
							</div>

						</div>

					</div>
				</div>

				<hr>

				<h3>More information</h3>
				<div class="row">
					<div class="col-md-4">

						<div class="form-group">

							<p>Has anyone other than the HETAS Registered Installer altered the installation? If so, who?</p>

							<div class="textbox">

								<textarea name="altered_installation" type="text" class="form-control nr-altered_installation" id="altered_installation"></textarea>

							</div>

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<p>Is the installation subject to legal proceedings?</p>

							<div class="radio">

								<label class="radio-inline">
									<input type="radio" name="installation_legal_proceedings" id="installation_legal_proceedingsY" value="yes"> Yes
								</label>
								<label class="radio-inline">
									<input type="radio" name="installation_legal_proceedings" id="installation_legal_proceedingsN" value="no"> No
								</label>

							</div>

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<p>Has payment in full been made to the installer? If not please give details. ie. date</p>

							<div class="radio">

								<label class="radio-inline">
									<input type="radio" name="full_payment_made" id="full_payment_madeY" value="yes"> Yes
								</label>
								<label class="radio-inline">
									<input type="radio" name="full_payment_made" id="full_payment_madeN" value="no"> No
								</label>

							</div>

						</div>

						<div class="form-group">

							<label for="full_payment_made_details" class="control-label">Details</label>

							<input name="full_payment_made_details" type="text" class="form-control nr-full_payment_made_details" id="full_payment_made_details" placeholder="Details">

						</div>

					</div>

				</div>

				<hr>

				<div class="row">
					<div class="col-md-4">

						<div class="form-group">

							<p>Have you informed the HETAS registered business/installer?</p>

							<div class="radio">

								<label class="radio-inline">
									<input type="radio" name="informed_hetas_registerant" id="informed_hetas_registerantY" value="yes"> Yes
								</label>
								<label class="radio-inline">
									<input type="radio" name="informed_hetas_registerant" id="informed_hetas_registerantN" value="no"> No
								</label>

							</div>

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<p>If yes, when did you inform them?</p>

							<label for="informed_hetas_registerant_date" class="control-label">Date</label>

							<input name="informed_hetas_registerant_date" type="text" class="form-control nr-informed_hetas_registerant_date" id="informed_hetas_registerant_date" placeholder="Date">

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<p>If yes, have they returned and carried out any remedial work?</p>

							<div class="radio">

								<label class="radio-inline">
									<input type="radio" name="carried_out_any_remedial" id="carried_out_any_remedialY" value="yes"> Yes
								</label>
								<label class="radio-inline">
									<input type="radio" name="carried_out_any_remedial" id="carried_out_any_remedialN" value="no"> No
								</label>

							</div>

						</div>

					</div>

				</div>

				<hr>

				<div class="row">
					<div class="col-md-4">

						<div class="form-group">

							<p>What date was this done and please record the action taken</p>

							<label for="action_taken" class="control-label">Action Taken</label>

							<input name="action_taken" type="text" class="form-control nr-action_taken" id="action_taken" placeholder="Action Taken">

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<p>Please provide photographs of the installation and problems</p>

							<div class="upload">

								<form action="" method="post" enctype="multipart/form-data">
									Select images to upload: disabled until ER has access to the WT api credentials
									<input type="file" name="fileToUpload" class="btn btn-default" id="fileToUpload" multiple="multiple">
									<!-- ensure wp nounce is inserted for security -->
									<button type="submit" class="btn btn-default" name="submit">Upload Files</button>
								</form>

							</div>

						</div>


					</div>

					<div class="col-md-4">

						<div class="form-group">

							<p>Please provide any other relevant correspondence with the installer, if available</p>

							<div class="upload">

								<form action="" method="post" enctype="multipart/form-data">
									Select images to upload: disabled until ER has access to the WT api credentials
									<input type="file" name="fileToUpload" class="btn btn-default" id="fileToUpload" multiple="multiple">
									<!-- ensure wp nounce is inserted for security -->
									<button type="submit" class="btn btn-default" name="submit">Upload Files</button>
								</form>

							</div>

						</div>

					</div>

				</div>

				<hr>

				<div class="row">
					<div class="col-md-12">

						<div class="form-group">

							<p>Please explain the nature of the complaint. Please try to keep your reply concise and relevant to points raised in the prior checkboxes.</p>

							<textarea name="nature_of_the_complaint" type="text" class="form-control nr-nature_of_the_complaint" id="nature_of_the_complaint"></textarea>

						</div>

					</div>


				</div>

				<p>Please note: Upon receipt, we will review the information and will provide an update on the next course of action. Where the complaint is agreed, the registered installer will be instructed to deal with you directly.</p>

				<p><strong>Please note that our policy for HETAS registered businesses is for the contracted registered installer to return and correct any agreed faults. If you do not wish the installer to return and correct any agreed faults, then this will restrict our options and we may not be able to assist in your complaint.</strong></p>

				<div class="row">
					<div class="col-md-12 navitabs-right">
						<a href="#submit" class="btn btn-primary btn active buttontab" aria-controls="submit" role="tab" data-toggle="tab" data-tabber="pres-4">Next</a>
					</div>
				</div>


			</div>
			<div role="tabpanel" class="tab-pane fade" id="submit">

				<h3>Submit Complaint</h3>

				<p>Where possible, HETAS will utilise Email and Telephone as the preferred method of contact. If no email address is provided, correspondence will be sent by post.</p>

				<p><strong>By signing this questionnaire, I/We declare that I/we have read and understood the terms of the HETAS complaints policy and agree to abide by them. A copy of the full complaints policy is available online or by request.</strong></p>

				<p>Send any accompanying information to complaints@hetas.co.uk</p>

				<p>Please note HETAS will record and file your details in line with our Complaints Policy and GDPR.</p>

				<input class="nr-notifictionid" type="text" name="notifictionid">
				<input class="nr-contactid" type="text" name="contactid">
				<input class="nr-businessid" type="text" name="businessid">
				<input class="nr-schemeid" type="text" name="schemeid">
				<input class="nr-operativeid" type="text" name="operativeid">
				<input class="nr-casetypecode" type="hidden" name="casetypecode" value="2">
				<input class="nr-subject-sector" type="hidden" name="subjectsector" value="37a45192-57f5-e711-80d0-00155d050ffd">

				<?php wp_nonce_field( 'hetas_process_complaint', 'hetas_complaints_nonce' ); ?>
				<button type="submit" class="btn btn-default">Submit</button>

			</div>

	</div>

	</form>



<!-- search CRM by Notification Reference -->


<!--
<form>




	<?php foreach ($complaints_form_elements as $form_tab_section) {  ?>

		<div class="tab">

			<div class="row">

				<?php foreach($form_tab_section['cols'] as $cols) { ?>

					<div class="col-md-6">

						<?php foreach ($cols['fields'] as $field) { ?>

							<?php if ($field['type'] == 'text') { ?>

								<div class="form-group">

									<label for="<?php echo esc_attr( $field['id'] ) ; ?>"><?php echo esc_attr( $field['label'] ) ; ?></label>
									<input name="<?php echo esc_attr( $field['id'] ) ; ?>" type="<?php echo esc_attr( $field['type'] ) ; ?>" class="form-control" id="<?php echo esc_attr( $field['id'] ) ; ?>" placeholder="<?php echo esc_attr( $field['placeholder'] ) ; ?>">

								</div>

							<?php } ?>

						<?php } ?>

					</div>

				<?php } ?>

			</div>

		</div>


	<?php } ?>

<div style="overflow:auto;">
  <div style="float:right;">
    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
  </div>
</div>

<div style="text-align:center;margin-top:40px;">
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
</div>

	<button type="submit" class="btn btn-default">Submit</button>


</form>
-->


</div>


<?php get_footer(); ?>