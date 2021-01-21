( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'form/cost-table', {
		title: 'Таблица стоимости',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'cost-table' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Таблица стоимости'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/content-cost-table"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
