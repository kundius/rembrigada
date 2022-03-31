( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/about-team', {
		title: 'О нашей команде',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'about-team' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'О нашей команде'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/landing/about-team"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
