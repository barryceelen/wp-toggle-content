;(function($) {
	'use strict';
	$(function () {

		var options = window.toggleContentVars;

		$( '.' + options.className ).each( function( index, el ) {

			var $el = $( el );

			$('<a />')
				.addClass( options.classNameToggle )
				.attr( 'role', 'button' )
				.html( options.labelExpand )
				.insertAfter( $el )
				.on( 'click', function() {
					$el.toggle();
					$( this ).remove();
				});

			$el.hide();
		});
	});
})(jQuery);
