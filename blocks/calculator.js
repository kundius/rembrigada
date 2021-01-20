( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'form/calculator', {
		title: 'Калькулятор',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'calculator' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Калькулятор'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/content-calculator"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
