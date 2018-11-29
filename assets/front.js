
jQuery(document).ready(function($) {

	// Preloading
	$('.preloader').delay(300).fadeOut('slow',function(){$(this).remove();});

	// Alert
	$('.alert-style').delay(10000).fadeOut('slow',function(){$(this).remove();});

	// Logout
	$(document).on('click', '.logout', function(event) {
		event.preventDefault();
		const url = $(this).attr('href');
		/* Act on the event */
		$.confirm({
		    title: 'Konfirmasi',
		    icon: 'icon icon-question',
		    theme: 'supervan',
		    content: 'Apakah anda yakin untuk keluar?',
		    buttons: {
		        ok: {
		        	keys: ['enter'],
		        	action: function(){
		            	window.location = url
		        	}
		        },
		        Batal: {
		        	keys: ['esc'],
		        	action: function(){
		            	
		        	}
		        },
		    }
		});
	});

});