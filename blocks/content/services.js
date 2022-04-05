( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'content/services', {
		title: 'Услуги',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'services' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Услуги'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/content/services"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
