( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/faq', {
		title: 'Ответы на часто задаваемые вопросы',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'faq' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Ответы на часто задаваемые вопросы'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/faq"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
