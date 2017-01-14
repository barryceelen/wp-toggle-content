/*global tinymce */
tinymce.PluginManager.add( 'togglecontent', function( editor ) {

	editor.on( 'init', function() {
		editor.formatter.register(
			'toggle_content_format', {
				block: 'div',
				classes: ['toggle-content'],
				wrapper: true
			}
		);
	});

	editor.addButton( 'togglecontent', {
		tooltip: window.toggleContentVars.tooltip,
		onclick: function() {
			if ( ! editor.formatter.match( 'toggle_content_format' ) ) {
				editor.formatter.apply( 'toggle_content_format' );
			} else {
				editor.formatter.remove( 'toggle_content_format' );
			}
			editor.nodeChanged();
		},
		onPostRender: function() {
			var ctrl = this;
			editor.on( 'NodeChange', function() {
				ctrl.active( editor.formatter.match( 'toggle_content_format' ) );
			});
		}
	});
});
