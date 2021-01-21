( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'form/timing_table', {
		title: 'Таблица сроков',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'timing_table' ],

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
				'[template_part path="partials/content-timing_table"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
