( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/contacts', {
		title: 'Контакты',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'contacts' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Контакты'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/contacts"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
