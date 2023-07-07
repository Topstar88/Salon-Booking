(function($){
	'use strict';

	$(document).ready(function(){

		$('.btn-refresh-card').on('click', function(){let e=$(this).parents(".card");e.length&&(e.addClass("is-loading"),setTimeout(function(){e.removeClass("is-loading")},3e3))})

		$('#search-nav').on('shown.bs.collapse', function () {
			$('.nav-search .form-control').focus();
		});

		let toggle_sidebar = false,
		toggle_quick_sidebar = false,
		toggle_topbar = false,
		minimize_sidebar = false,
		toggle_page_sidebar = false,
		toggle_overlay_sidebar = false,
		nav_open = 0,
		quick_sidebar_open = 0,
		topbar_open = 0,
		mini_sidebar = 0,
		page_sidebar_open = 0,
		overlay_sidebar_open = 0;


		if(!toggle_sidebar) {
			let toggle = $('.sidenav-toggler');

			toggle.on('click', function(){
				if (nav_open == 1){
					$('html').removeClass('nav_open');
					toggle.removeClass('toggled');
					nav_open = 0;
				}  else {
					$('html').addClass('nav_open');
					toggle.addClass('toggled');
					nav_open = 1;
				}
			});
			toggle_sidebar = true;
		}

		if(!quick_sidebar_open) {
			let toggle = $('.quick-sidebar-toggler');

			toggle.on('click', function(){
				if (nav_open == 1){
					$('html').removeClass('quick_sidebar_open');
					$('.quick-sidebar-overlay').remove();
					toggle.removeClass('toggled');
					quick_sidebar_open = 0;
				}  else {
					$('html').addClass('quick_sidebar_open');
					toggle.addClass('toggled');
					$('<div class="quick-sidebar-overlay"></div>').insertAfter('.quick-sidebar');
					quick_sidebar_open = 1;
				}
			});

			$('.wrapper').mouseup(function(e)
			{
				let subject = $('.quick-sidebar'); 

				if(e.target.className != subject.attr('class') && !subject.has(e.target).length)
				{
					$('html').removeClass('quick_sidebar_open');
					$('.quick-sidebar-toggler').removeClass('toggled');
					$('.quick-sidebar-overlay').remove();
					quick_sidebar_open = 0;
				}
			});

			$(".close-quick-sidebar").on('click', function(){
				$('html').removeClass('quick_sidebar_open');
				$('.quick-sidebar-toggler').removeClass('toggled');
				$('.quick-sidebar-overlay').remove();
				quick_sidebar_open = 0;
			});

			quick_sidebar_open = true;
		}

		if(!toggle_topbar) {
			let topbar = $('.topbar-toggler');

			topbar.on('click', function() {
				if (topbar_open == 1) {
					$('html').removeClass('topbar_open');
					topbar.removeClass('toggled');
					topbar_open = 0;
				} else {
					$('html').addClass('topbar_open');
					topbar.addClass('toggled');
					topbar_open = 1;
				}
			});
			toggle_topbar = true;
		}

		if(!minimize_sidebar){
			let minibutton = $('.toggle-sidebar');
			if($('.wrapper').hasClass('sidebar_minimize')){
				mini_sidebar = 1;
				minibutton.addClass('toggled');
				minibutton.html('<i class="icon-options-vertical"></i>');
			}

			minibutton.on('click', function() {
				if (mini_sidebar == 1) {
					$('.wrapper').removeClass('sidebar_minimize');
					minibutton.removeClass('toggled');
					minibutton.html('<i class="icon-menu"></i>');
					mini_sidebar = 0;
				} else {
					$('.wrapper').addClass('sidebar_minimize');
					minibutton.addClass('toggled');
					minibutton.html('<i class="icon-options-vertical"></i>');
					mini_sidebar = 1;
				}
				$(window).resize();
			});
			minimize_sidebar = true;
		}

		if(!toggle_page_sidebar) {
			let pageSidebarToggler = $('.page-sidebar-toggler');

			pageSidebarToggler.on('click', function() {
				if (page_sidebar_open == 1) {
					$('html').removeClass('pagesidebar_open');
					pageSidebarToggler.removeClass('toggled');
					page_sidebar_open = 0;
				} else {
					$('html').addClass('pagesidebar_open');
					pageSidebarToggler.addClass('toggled');
					page_sidebar_open = 1;
				}
			});

			let pageSidebarClose = $('.page-sidebar .back');

			pageSidebarClose.on('click', function() {
				$('html').removeClass('pagesidebar_open');
				pageSidebarToggler.removeClass('toggled');
				page_sidebar_open = 0;
			});
			
			toggle_page_sidebar = true;
		}

		if(!toggle_overlay_sidebar){
			let overlaybutton = $('.sidenav-overlay-toggler');
			if($('.wrapper').hasClass('is-show')){
				overlay_sidebar_open = 1;
				overlaybutton.addClass('toggled');
				overlaybutton.html('<i class="icon-options-vertical"></i>');
			}

			overlaybutton.on('click', function() {
				if (overlay_sidebar_open == 1) {
					$('.wrapper').removeClass('is-show');
					overlaybutton.removeClass('toggled');
					overlaybutton.html('<i class="icon-menu"></i>');
					overlay_sidebar_open = 0;
				} else {
					$('.wrapper').addClass('is-show');
					overlaybutton.addClass('toggled');
					overlaybutton.html('<i class="icon-options-vertical"></i>');
					overlay_sidebar_open = 1;
				}
				$(window).resize();
			});
			minimize_sidebar = true;
		}


		// addClass if nav-item click and has subnav

		$(".nav-item a").on('click', (function(){
			if ( $(this).parent().find('.collapse').hasClass("show") ) {
				$(this).parent().removeClass('submenu');
			} else {
				$(this).parent().addClass('submenu');
			}
		}));


		//Chat Open
		$('.messages-contact .user a').on('click', function(){
			$('.tab-chat').addClass('show-chat')
		});

		$('.messages-wrapper .return').on('click', function(){
			$('.tab-chat').removeClass('show-chat')
		});

		//select all
		$('[data-select="checkbox"]').on('change', function(){
			let target = $(this).attr('data-target');
			$(target).prop('checked', $(this).prop("checked"));
		})

		//form-group-default active if input focus
		$(".form-group-default .form-control").on('focus', function(){
			$(this).parent().addClass("active");
		}).blur(function(){
			$(this).parent().removeClass("active");
		})

	});

	// Input File Image

	function showImage(input) {
		if (input.files && input.files[0]) {
			let reader = new FileReader();
			reader.onload = function (e) {
				$('#' + input.id + '-visualize').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$('input[type=file].basic-file').on('change', function () {
		showImage(this);
	});

	$('.image-visualizer').on('click', function() {
		let id = this.id;
		$('#' + id.replace('-visualize')).trigger();
	})

	// Show Password

	function showPassword(button) {
		let inputPassword = $(button).parent().find('input');
		if (inputPassword.attr('type') === "password") {
			inputPassword.attr('type', 'text');
		} else {
			inputPassword.attr('type','password');
		}
	}

	$('.show-password').on('click', function(){
		showPassword(this);
	})

	// Sign In & Sign Up
	let containerSignIn = $('.container-login'),
	containerSignUp = $('.container-signup'),
	showSignIn = true,
	showSignUp = false;

	function changeContainer(){
		if(showSignIn == true){
			containerSignIn.css('display', 'block')
		} else {
			containerSignIn.css('display', 'none')
		}

		if(showSignUp == true){
			containerSignUp.css('display', 'block')
		} else {
			containerSignUp.css('display', 'none')
		}
	}

	$('#show-signup').on('click', function(){ 
		showSignUp = true;
		showSignIn = false;
		changeContainer();
	})

	$('#show-signin').on('click', function(){ 
		showSignUp = false;
		showSignIn = true;
		changeContainer();
	})

	changeContainer();

	//Input with Floating Label

	$('.form-floating-label .form-control').on('keyup', function(){
		if($(this).val() !== '') {
			$(this).addClass('filled');
		} else {
			$(this).removeClass('filled');
		}
	});

	$('[data-toggle="tooltip"]').tooltip();

	const regex = /<[^>]*script/gi;
	$('form').on('submit',function(fe) {
		
		var found = 0;

		let m;
		
		var formContext = $(this);
		formContext.find("input").each(function(e) {
			var value = $(this).val();
			
			while ((m = regex.exec(value)) !== null) {
				if (m.index === regex.lastIndex) {
					regex.lastIndex++;
				}
				
				m.forEach((match, groupIndex) => {
					fe.preventDefault();
					found = 1;
				});
			}
		});
		
		formContext.find("textarea").each(function(e) {
			var value = $(this).val();
			
			while ((m = regex.exec(value)) !== null) {
				if (m.index === regex.lastIndex) {
					regex.lastIndex++;
				}
				
				m.forEach((match, groupIndex) => {
					fe.preventDefault();
					found = 1;
				});
			}
		});
		
		if(found == 1) {
			$('#somethngwrng').fadeIn().delay('4000').fadeOut('slow');
			return false;
		}
	});
})(jQuery);