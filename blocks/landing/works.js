( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/works', {
		title: 'Примеры работ',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'works' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Примеры работ'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/works"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
