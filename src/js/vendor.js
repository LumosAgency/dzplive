import 'lazyload';
import 'owl.carousel';
import SmoothScroll from 'smooth-scroll';
if (!window.IntersectionObserver) {
	var ga = document.createElement('script');
	ga.type = 'text/javascript';
	ga.async = true;
	ga.src = '//polyfill.io/v2/polyfill.min.js?features=IntersectionObserver';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(ga, s)
};
if (typeof jQuery == 'function') {
	var $ = jQuery;
}
var ppp = 3; // Post per page
var pageNumber = 1;
function load_posts() {
	pageNumber++;
	const $wrapper = $('#events-list');
	const postNumber = $wrapper.find('.post').length;
	var str = '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&offset=' + postNumber + '&action=more_post_ajax';
	$.ajax({
		type: "POST",
		dataType: "html",
		url: ajax_posts.ajaxurl,
		data: str,
		success: function (data) {
			var $data = $(data);
			if ($data.length) {
				$("#events-list").append($data);
				$(".misha_loadmore").attr("disabled", false);
			} else {
				$(".misha_loadmore").attr("disabled", true);
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			$loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
		}
	});
	return false;
}
$(document).ready(function() {
	$(".misha_loadmore").on("click", function() { // When btn is pressed.
		$(".misha_loadmore").attr("disabled", true); // Disable the button, temp.
		load_posts();
		$(this).insertAfter('.list'); // Move the 'Load More' button to the end of the the newly added posts.
	});
});
$('.lazy').lazyload();
new SmoothScroll('a[href*="#"]');