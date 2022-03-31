( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/measurement', {
		title: 'БЕСПЛАТНО ПРИЕДЕМ, ЗАМЕРИМ, РАССЧИТАЕМ',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'measurement' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'БЕСПЛАТНО ПРИЕДЕМ, ЗАМЕРИМ, РАССЧИТАЕМ'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/measurement"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
