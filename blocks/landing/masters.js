( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/masters', {
		title: 'Наши мастера',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'masters' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Наши мастера'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/masters"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
