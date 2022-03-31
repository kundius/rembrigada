( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/easy-work', {
		title: 'Работать с нами легко и понятно',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'easy-work' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Работать с нами легко и понятно'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/easy-work"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
