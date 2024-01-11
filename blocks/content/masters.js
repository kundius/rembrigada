( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'content/masters', {
		title: 'Наши мастера',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'masters' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Наши мастера'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/content/masters"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
