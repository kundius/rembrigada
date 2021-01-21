( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'form/repair_types', {
		title: 'Виды ремонта',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'repair_types' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Виды ремонта'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/content-repair_types"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
