( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/readiness', {
		title: 'ГОТОВЫ ПРИСТУПИТЬ К РЕМОНТУ?',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'readiness' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'ГОТОВЫ ПРИСТУПИТЬ К РЕМОНТУ?'
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
