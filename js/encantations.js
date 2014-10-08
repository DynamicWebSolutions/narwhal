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


yogg['telegraph-service'] = (function(w,d,$) {
	var triggers;

	triggers = $('#telegraph-message input');

	triggers.on('focus', function() {
		var activeEl, inactive;

	  activeEl = $(this);
		inactive = triggers.not(activeEl);

		activeEl.parent().addClass('active');
		
		triggers.not(activeEl).each(function(i, el) { 
			$(el).parent().addClass('inactive');
		});
	});

	triggers.on('blur', function() {
		triggers.each(function(i, el) {
			$(el).parent().removeClass('active');
			$(el).parent().removeClass('inactive');			
		});		
	});

}(window, document, jQuery));