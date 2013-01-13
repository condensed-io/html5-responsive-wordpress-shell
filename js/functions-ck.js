// mYm Functions v 1.5 - brent@mimoymima.com
// last edited: Nov 27, 2011
// DOCUMENT READY FUNCTION: uses noConflict to work with other libraries
jQuery(document).ready(function(e){e(".toggle").addClass("make-link").addClass("header-hidden").click(function(){var t=e(this);if(t.is(".header-shown")){t.next().slideToggle("normal");t.removeClass("header-shown");t.addClass("header-hidden")}else{t.next().slideToggle("normal");t.removeClass("header-hidden");t.addClass("header-shown")}return!1});e(".popup").attr("target","_blank")});