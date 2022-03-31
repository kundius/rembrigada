( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'landing/easy-work', {
		title: 'РАБОТАТЬ С НАМИ ЛЕГКО И ПОНЯТНО',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'easy-work' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'РАБОТАТЬ С НАМИ ЛЕГКО И ПОНЯТНО'
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
