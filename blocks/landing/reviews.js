( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/reviews', {
		title: 'Отзывы наших клиентов',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'reviews' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Отзывы наших клиентов'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/reviews"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
