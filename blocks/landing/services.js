( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/services', {
		title: 'Наши услуги',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'services' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Наши услуги'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/services"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
