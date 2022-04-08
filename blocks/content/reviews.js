( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'content/reviews', {
		title: 'Отзывы',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'reviews' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Отзывы'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/content/reviews"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
