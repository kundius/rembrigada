( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/decision', {
		title: 'Решение',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'decision' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Решение'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/decision"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
