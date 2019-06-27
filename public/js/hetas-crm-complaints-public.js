
(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

$(function() {

	function formatDate(date) {
	  var monthNames = [
	    "January", "February", "March",
	    "April", "May", "June", "July",
	    "August", "September", "October",
	    "November", "December"
	  ];

	  var day = date.getDate();
	  var monthIndex = date.getMonth();
	  var year = date.getFullYear();

	  return day + ' ' + monthNames[monthIndex] + ' ' + year;
	}

	// on change get the operative id
	$('#nitems').on('change', function(e) {
		e.preventDefault();
		var operative_id = $(this).val();
		var item_make_model = $(this).find(":selected").text();

		jQuery.post(
			ajax_object.ajax_url,
			{
				// wp ajax action
				action : 'get_operative_by_operative_id',
				nextNonce : ajax_object.nextNonce,
				operative_id : operative_id,
			},

			function( response ) {

				$('.nr-hetas-reg-installer').text(response.van_name);
				$('.nr-amakemodel').text(item_make_model);
				$('.nr-makemodel').val(item_make_model);


				$('.nr-operativeid').val(response.van_operativeid);
				$('#nr-details').show();
			}
		);
	});

	// get the notification
	$('#notification-reference-search').on('submit',function(e){
		e.preventDefault();
		var van_name = $('#van_name').val();

		$('#crm-sync-calling').show();

		jQuery.post(
			ajax_object.ajax_url,
			{
				// wp ajax action
				action : 'crm_search_notification_reference',
				nextNonce : ajax_object.nextNonce,
				van_name : van_name,
			},

			function( response ) {

				console.log(response);

				if(response[0] != null) {
					var d =  formatDate(new Date(response[0].van_workcompletiondate));
					var nd =  formatDate(new Date(response[0].van_submissiondate));

					var html = '<option value="">Select installation item</option>';
					response[4].forEach(function(item, index) {
						html += '<option value="'+item._van_operativeid_value+'">'+item.van_name+'</option>';
					});
					$('#nitems').html(html);

					$('#crm-sync-calling').hide();

					populate_consumer_inputs(response);

					$('.nr-wcompletion').text(d);
					$('.nr-van_workcompletiondate').val(d);

					$('.nr-business-name').text(response[2].name);
					$('.nr-name').val(response[2].name);

					$('.nr-hetas-reg-no').text(response[2].van_hetasid);
					$('.nr-van_hetasid').val(response[2].van_hetasid);

					$('.nr-amakemodel').text(nd);

					$('.nr-notification-date').text(nd);

					$('.nr-hetas-reg-installer').text(response[0].van_installersuppliedreference);
					$('.nr-van_installersuppliedreference').val(response[0].van_installersuppliedreference);

					$('.nr-notifictionid').val(response[0].van_notificationid);
					$('.nr-contactid').val(response[1].contactid);
					$('.nr-businessid').val(response[2].accountid);
					$('.nr-schemeid').val(response[3].van_schemeid);
					$('#notification-results').show();

					are_you_the_consumer(response);

					//console.log( response );
				} else {
					$('#crm-sync-calling').hide();
					$('#notification-results').show();
					$('#results .result').html('<h3>Sorry, we are unable to find that notification reference number.</h3> <p>You can still submit a complaint, click next to input the information in the form elements and submit at the end of the process.</p>');
					are_you_the_consumer(response);
				}


			}


		);

	});

	function populate_consumer_inputs(response) {

		if (response[1] === null) {
			return;
		}


		$('.nr-consumer').text(response[1].fullname);
		$('.nr-consumer').val(response[1].fullname);

		$('.nr-relationship').val(response[1].description);


		$('.nr-installation-addressline1').text(response[0].van_addressline1);
		$('.nr-installation-postcode').text(response[0].van_postcode);
		$('.nr-installation-towncity').text(response[0].van_towncity);
		$('.nr-composite-address').text(response[1].address1_composite);
		$('.nr-address1_line1').val(response[0].van_addressline1);
		$('.nr-address1_line2').val(response[0].van_addressline2);
		$('.nr-address1_line3').val(response[0].van_addressline3);
		$('.nr-address1_city').val(response[0].van_towncity);
		$('.nr-address1_county').val(response[0].van_stateorprovince);
		$('.nr-address1_postalcode').val(response[0].van_postcode);
		$('.nr-telephone1').val(response[1].telephone1);
		$('.nr-mobilephone').val(response[1].mobilephone);
		$('.nr-emailaddress1').val(response[1].emailaddress1);

		$('.nr-telephone').text(response[1].telephone1);
		$('.nr-mobile').text(response[1].mobilephone);
		$('.nr-email').text(response[1].emailaddress1);
	}

	function empty_consumer_inputs() {
		$('.nr-consumer').val('');
		$('.nr-address1_line1').val('');
		$('.nr-address1_line2').val('');
		$('.nr-address1_line3').val('');
		$('.nr-address1_city').val('');
		$('.nr-address1_county').val('');
		$('.nr-address1_postalcode').val('');
		$('.nr-telephone1').val('');
		$('.nr-mobilephone').val('');
		$('.nr-emailaddress1').val('');
		$('.nr-emailaddress1').val('');
		$('.nr-relationship').val('');

	}

	function are_you_the_consumer(response) {

		console.log(response);

		$('#original-consumer').on('change',function() {

			if($(this).val() === 'yes') {
				$('#consumer-details').show();
				populate_consumer_inputs(response);
			} else {
				$('#consumer-details').show();
				empty_consumer_inputs();
			}
		});
	}

	function show_active_tab(litab) {
		//var litab = $(this).data('tabber');
		var nav_tabs = $('.nav-tabs li');
 		$('.nav-tabs li').removeClass('active');
		$('#'+litab).addClass('active');

	}

	// skip notification search
	$('.skip-notification-search').on('click',function(e){
		e.preventDefault();
		show_active_tab($(this).data('tabber'));
		$('#notification-results').show();
	});

	$('#nr-tabs a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	});

	$('.buttontab').on('click',function (e) {
		e.preventDefault()

		show_active_tab($(this).data('tabber'));

	});


});


})( jQuery );
