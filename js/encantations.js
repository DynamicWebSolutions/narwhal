window.yogg = window.yogg || {};


yogg['menu'] = (function(w,d,$) {
	var trigger, menu;

	trigger = $('#hamburger');
	menu = $('nav.top-nav');

	trigger.on('click', function(e){
		if(menu.hasClass('closed') || menu.hasClass('close')) {
			menu.removeClass('close')
				.removeClass('closed')
				.addClass('open');
		} else {
			menu.removeClass('opened')
				.removeClass('open')
				.addClass('close');
		}
	});

	menu.on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
		if(menu.hasClass('open')) {
			menu.removeClass('open')
				.addClass('opened');
		} else {
			menu.removeClass('close')
				.addClass('closed');
		}
	});	

}(window, document, jQuery));