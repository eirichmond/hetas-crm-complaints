<?php get_header();?>

<h2><?php echo the_title(); ?></h2>

<!-- search CRM by Notification Reference show results -->

<div class="row">
	
	
	<div class="col-md-12 mt-15">
		
		<div class="alert alert-success" role="alert">
			<p>Complaint has been submitted, your case reference number is: <strong><?php echo esc_html( $_GET['complaint-ref'] );?></strong></p>
		</div>
		
	</div>
	
</div>



<?php get_footer(); ?>