( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/advantages', {
		title: 'Преимущества',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'advantages' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Преимущества'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/advantages"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
