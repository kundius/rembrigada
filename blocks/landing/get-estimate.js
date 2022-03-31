( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/get-estimate', {
		title: 'Получите подробную смету',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'get-estimate' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Получите подробную смету'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/get-estimate"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
