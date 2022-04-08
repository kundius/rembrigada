( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	registerBlockType( 'content/projects', {
		title: 'Проекты',
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'projects' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Проекты'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/content/projects"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);
