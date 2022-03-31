( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/like-work', {
		title: 'Нравится работать',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'like-work' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Нравится работать'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/like-work"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
