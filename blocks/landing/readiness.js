( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/readiness', {
		title: 'Готовность',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'readiness' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Готовность'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/readiness"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
