// mYm Functions v 1.5 - brent@mimoymima.com
// last edited: Nov 27, 2011


// DOCUMENT READY FUNCTION: uses noConflict to work with other libraries
jQuery(document).ready(function($) {	

//  // site preloader -- also uncomment the div in the header and the css style for #preloader
//  $(window).load(function(){
//  	$('#preloader').fadeOut('slow',function(){$(this).remove();});
//  });
	
// //-----Select Linker -- To use, add the class LinkSelect to your form -- by mimoYmima.com
// 	$('.link-select select').change(function(){ 
// 		var LinkTo = $('.link-select select').val();
// 		top.location.href = LinkTo;
// 	});

//-----Show and Hide Stuff
	$(".toggle")
		.addClass('make-link') // make headings look like links
		.addClass('header-hidden')
		.click(function(){
	        var $this = $(this);
	        if( $this.is('.header-shown') ) {
	                $this.next().slideToggle('normal');
	                $this.removeClass('header-shown');
	                $this.addClass('header-hidden');
	        }
	        else {
	                $this.next().slideToggle('normal');
	                $this.removeClass('header-hidden');
	                $this.addClass('header-shown');
	        }
	        return false;
	});


//-----Make a link with the class of popup open in a new window
	$('.popup').attr('target', '_blank');
	
	
});//<--- this is the end of the document ready function don't delete it

