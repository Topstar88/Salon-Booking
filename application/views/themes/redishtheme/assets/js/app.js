(function ($) {
  "use strict"
  /*---------------====================
  03.Sticky Menu
  ================-------------------*/
$(window).on('scroll', function () {
	var scroll = $(window).scrollTop();

	if (scroll < 200) {
	  $(".headerMainInner").removeClass("headerMainSticky fadeInDown animated");
	} else {
	  $(".headerMainInner").addClass("headerMainSticky fadeInDown animated");
	}
});

//07.Image Filter Acitve
  
  $('.filterList').on('click', 'li', function () {
    $('.filterList li').removeClass('active');
    $(this).addClass('active');
    var filterValue = $(this).attr('data-filter');
    $('.grid').isotope({
      filter: filterValue
    });
    $(window).trigger('resize');
  });


  $(".menu-click").on("click", function () {
    $(".mainMenu > ul").toggleClass('show');
    return false;
  });
  
	const url = window.location.href;

	// Share Event Handlers
	function fbShare() { window.open('https://www.facebook.com/sharer/sharer.php?u='        + url, 'window', 'toolbar=no, menubar=no, resizable=yes, width=680, height=535'); }
	function twShare() { window.open('https://twitter.com/intent/tweet?url='                + url, 'window', 'toolbar=no, menubar=no, resizable=yes, width=680, height=535'); }
	function ldShare() { window.open('https://www.linkedin.com/sharing/share-offsite/?url=' + url, 'window', 'toolbar=no, menubar=no, resizable=yes, width=680, height=535'); }
	function vkShare() { window.open('http://vk.com/share.php?url='                         + url, 'window', 'toolbar=no, menubar=no, resizable=yes, width=680, height=535'); }
	function rdShare() { window.open('https://reddit.com/submit?url='                       + url, 'window', 'toolbar=no, menubar=no, resizable=yes, width=680, height=535'); }
	function wpShare() { window.open('https://wa.me/?text=' + encodeURI('Check out this image: ' + url), 'window', 'toolbar=no, menubar=no, resizable=yes, width=680, height=535'); }

	// Share Events
	$('#fb-share').on('click', fbShare);
	$('#tw-share').on('click', twShare);
	$('#ld-share').on('click', ldShare);
	$('#vk-share').on('click', vkShare);
	$('#rd-share').on('click', rdShare);
	$('#wp-share').on('click', wpShare);
}(jQuery))