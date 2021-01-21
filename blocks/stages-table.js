( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'form/stages-table', {
		title: 'Таблица этапов',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'stages-table' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Таблица этапов'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/content-stages-table"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
