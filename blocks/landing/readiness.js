( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/readiness', {
		title: 'Готовы приступить к ремонту',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'readiness' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Готовы приступить к ремонту'
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
