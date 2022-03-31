( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/problems', {
		title: 'Возьмем на себя все проблемы',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'problems' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Возьмем на себя все проблемы'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/problems"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
