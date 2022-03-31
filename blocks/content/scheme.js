( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'content/scheme', {
		title: 'Схема работы',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'scheme' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Схема работы'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/content/scheme"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
