( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'content/repair-types', {
		title: 'ВИДЫ РЕМОНТА И СТОИМОСТЬ',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'repair-types' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'ВИДЫ РЕМОНТА И СТОИМОСТЬ'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/content/repair-types"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
