window.yogg = window.yogg || {};


yogg['menu'] = (function(w,d,$) {
	var trigger, menu;

	trigger = $('#hamburger');
	menu = $('nav.top-nav');

	trigger.on('click', function(e){
		if(menu.hasClass('opened')) {
			menu.removeClass('opened');
		} else {
			menu.addClass('open')
				.on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
					menu.addClass('opened');
					menu.removeClass('open');
				});
		}
	});
}(window, document, jQuery));