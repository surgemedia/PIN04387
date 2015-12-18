$(document).ready( function(jQuery) {

	$("a[rel^='prettyPhoto']").prettyPhoto({social_tools : false});
	
	$('#test_connection').on('click',function(e) {
		e.preventDefault();
		var formData = $(this).closest('form').serialize();
		$.ajax({
			method: "POST",
			url : 'ajax.php',
			data: {formData : formData , action: "test_connection"},
			dataType : 'json'
		})
		.done(function( response ) {
			$('.row.response .form-group').html(response.message);
		});
		
	});
	
	$('#import_listings').on('click',function(e) {
		e.preventDefault();
		$('.alert.alert-success').html('processing started ... <br> <strong>Currently processing your files, do not navigate away from this page </strong> ').addClass('ajax-loading');
		//$('body').append('<div class="feedsync-overlay"></div>');
		import_listings();
	});
	
	function import_listings() {
		$.ajax({
			method: "POST",
			url : 'ajax.php',
			data: {action: "import_listings"},
			dataType : 'json'
		})
		.done(function( response ) { 
			if(response.status == 'success') {
				$('.alert.alert-success').html(response.message);
				
				if(response.buffer == 'processing') {
					try {
						import_listings();
					}
					catch(err) {
						$('.alert.alert-success').html('Please reload page & click on <strong>process</strong> to continue processing');
					}
					
				} else {
					$('.alert.alert-success').removeClass('ajax-loading');
					//$('body').find('.feedsync-overlay').remove();
				}
			}
		});
	}
	
	$('#process_missing_coordinates').on('click',function(e) {
		e.preventDefault();
		$('.alert.alert-success').html('Geocode processing started ... ');
		process_missing_coordinates();	
		
	});
	
	function process_missing_coordinates() {
		$.ajax({
			method: "POST",
			url : 'ajax.php',
			data: {action: "process_missing_coordinates"},
			dataType : 'json'
		})
		.done(function( response ) { 
			$('.alert.alert-success').html(response.message);
			if(response.buffer == 'processing') {
				try {
					process_missing_coordinates();
				}
				catch(err) {
					$('.alert.alert-success').html('Please reload page & click on <strong>process missing coordinates</strong> to continue processing');
				}
			}
		});
	}
	
	$('#upgrade_table_data').on('click',function(e) {
		e.preventDefault();
		$('.alert.alert-success').html('upgrade started ... ');
		upgrade_table_data();	
		
	});
	
	function upgrade_table_data() {
		$.ajax({
			method: "POST",
			url : 'ajax.php',
			data: {action: "upgrade_table_data"},
			dataType : 'json'
		})
		.done(function( response ) { 
			$('.alert.alert-success').html(response.message);
			if(response.buffer == 'processing') {
				try {
					upgrade_table_data();
				}
				catch(err) {
					$('.alert.alert-success').html('Please reload page & click on <strong>Process Table Upgrade</strong> to continue processing');
				}
			}
		});
	}
	
	$('#process_missing_listing_agents').on('click',function(e) {
		e.preventDefault();
		$('.alert.alert-success').html('Listing agents processing started ... ');
		process_missing_listing_agents();	
		
	});
	
	function process_missing_listing_agents() {
		$.ajax({
			method: "POST",
			url : 'ajax.php',
			data: {action: "process_missing_listing_agents"},
			dataType : 'json'
		})
		.done(function( response ) { 
			$('.alert.alert-success').html(response.message);
			
		});
	}
});
