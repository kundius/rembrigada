( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/problems', {
		title: 'Проблемы',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'problems' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Услуги'
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
