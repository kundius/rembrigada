( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'form/timing-table', {
		title: 'Таблица сроков',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'timing-table' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Таблица сроков'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/content-timing-table"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
