( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/repair', {
		title: 'Стоимость ремонта',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'repair' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Стоимость ремонта'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/repair"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
