( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/quiz', {
		title: 'Квиз',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'quiz' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Квиз'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/quiz"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
