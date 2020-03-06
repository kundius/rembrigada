( function( blocks, element ) {

	const el = element.createElement;

	//const { RichText } = editor;
	const { registerBlockType } = blocks;



	const icon = el('svg', { width: 20, height: 20 },
  el( 'path',
    {
      d: "M 8.140625 12.472656 L 7.40625 12.226562 C 7.164062 12.148438 7 11.921875 7 11.667969 C 7 11.296875 7.296875 11 7.667969 11 C 8.035156 11 8.332031 11.296875 8.332031 11.667969 L 9 11.667969 C 8.996094 11.058594 8.585938 10.53125 8 10.378906 L 8 9.667969 L 7.332031 9.667969 L 7.332031 10.378906 C 6.746094 10.53125 6.335938 11.058594 6.332031 11.667969 C 6.332031 12.207031 6.679688 12.691406 7.195312 12.859375 L 7.929688 13.105469 C 8.171875 13.183594 8.332031 13.410156 8.332031 13.667969 C 8.332031 14.035156 8.035156 14.332031 7.667969 14.332031 C 7.296875 14.332031 7 14.035156 7 13.667969 L 6.332031 13.667969 C 6.335938 14.273438 6.746094 14.800781 7.332031 14.953125 L 7.332031 15.667969 L 8 15.667969 L 8 14.953125 C 8.585938 14.800781 8.996094 14.273438 9 13.667969 C 9 13.125 8.652344 12.644531 8.140625 12.472656 Z M 8.140625 12.472656"
    }
  ),
  el( 'path',
    {
      d: "M 19.667969 7.332031 L 12.929688 7.332031 C 12.222656 6.464844 11.339844 5.761719 10.332031 5.269531 L 10.332031 3.832031 L 11.535156 2.933594 C 11.617188 2.871094 11.667969 2.773438 11.667969 2.667969 L 11.667969 0.332031 C 11.667969 0.148438 11.515625 0 11.332031 0 L 10 0 C 9.910156 0 9.828125 0.0351562 9.765625 0.0976562 L 9.332031 0.527344 L 8.902344 0.0976562 C 8.839844 0.0351562 8.753906 0 8.667969 0 L 6.667969 0 C 6.578125 0 6.492188 0.0351562 6.429688 0.0976562 L 6 0.527344 L 5.570312 0.0976562 C 5.507812 0.0351562 5.421875 0 5.332031 0 L 4 0 C 3.816406 0 3.667969 0.148438 3.667969 0.332031 L 3.667969 2.667969 C 3.667969 2.773438 3.714844 2.871094 3.800781 2.933594 L 5 3.832031 L 5 5.273438 C 2.476562 6.496094 0 9.773438 0 13.980469 C 0 17.804688 2.792969 20 7.667969 20 C 8.457031 20.003906 9.246094 19.933594 10.023438 19.789062 C 10.074219 19.917969 10.199219 20 10.332031 20 L 19.667969 20 C 19.851562 20 20 19.851562 20 19.667969 L 20 7.667969 C 20 7.484375 19.851562 7.332031 19.667969 7.332031 Z M 4.332031 2.5 L 4.332031 0.667969 L 5.195312 0.667969 L 5.765625 1.234375 C 5.894531 1.367188 6.105469 1.367188 6.234375 1.234375 L 6.804688 0.667969 L 8.527344 0.667969 L 9.097656 1.234375 C 9.226562 1.367188 9.4375 1.367188 9.570312 1.234375 L 10.136719 0.667969 L 11 0.667969 L 11 2.5 L 9.890625 3.332031 L 5.445312 3.332031 Z M 9.667969 4 L 9.667969 5 L 5.667969 5 L 5.667969 4 Z M 10 15.492188 C 8.441406 16.78125 6.128906 16.566406 4.835938 15.003906 C 3.546875 13.445312 3.761719 11.132812 5.324219 9.84375 C 6.679688 8.71875 8.644531 8.71875 10 9.84375 Z M 10 7.667969 L 10 9.019531 C 7.984375 7.726562 5.304688 8.3125 4.011719 10.328125 C 2.722656 12.339844 3.304688 15.023438 5.320312 16.3125 C 6.746094 17.226562 8.574219 17.226562 10 16.3125 L 10 19.117188 C 9.230469 19.265625 8.449219 19.335938 7.667969 19.332031 C 5.5625 19.332031 0.667969 18.8125 0.667969 13.980469 C 0.667969 10.792969 2.578125 6.824219 5.777344 5.667969 L 9.558594 5.667969 C 10.5 6.023438 11.347656 6.59375 12.035156 7.332031 L 10.332031 7.332031 C 10.148438 7.332031 10 7.484375 10 7.667969 Z M 19.332031 19.332031 L 10.667969 19.332031 L 10.667969 10.667969 L 19.332031 10.667969 Z M 19.332031 10 L 10.667969 10 L 10.667969 8 L 19.332031 8 Z M 19.332031 10"
    }
  ),
  el( 'path',
    {
      d: "M 13 11.332031 L 11.667969 11.332031 C 11.484375 11.332031 11.332031 11.484375 11.332031 11.667969 L 11.332031 13 C 11.332031 13.183594 11.484375 13.332031 11.667969 13.332031 L 13 13.332031 C 13.183594 13.332031 13.332031 13.183594 13.332031 13 L 13.332031 11.667969 C 13.332031 11.484375 13.183594 11.332031 13 11.332031 Z M 12.667969 12.667969 L 12 12.667969 L 12 12 L 12.667969 12 Z M 12.667969 12.667969"
    }
  ),
  el( 'path',
    {
      d: "M 15.667969 11.332031 L 14.332031 11.332031 C 14.148438 11.332031 14 11.484375 14 11.667969 L 14 13 C 14 13.183594 14.148438 13.332031 14.332031 13.332031 L 15.667969 13.332031 C 15.851562 13.332031 16 13.183594 16 13 L 16 11.667969 C 16 11.484375 15.851562 11.332031 15.667969 11.332031 Z M 15.332031 12.667969 L 14.667969 12.667969 L 14.667969 12 L 15.332031 12 Z M 15.332031 12.667969"
    }
  ),
  el( 'path',
    {
      d: "M 18.332031 11.332031 L 17 11.332031 C 16.816406 11.332031 16.667969 11.484375 16.667969 11.667969 L 16.667969 13 C 16.667969 13.183594 16.816406 13.332031 17 13.332031 L 18.332031 13.332031 C 18.515625 13.332031 18.667969 13.183594 18.667969 13 L 18.667969 11.667969 C 18.667969 11.484375 18.515625 11.332031 18.332031 11.332031 Z M 18 12.667969 L 17.332031 12.667969 L 17.332031 12 L 18 12 Z M 18 12.667969"
    }
  ),
  el( 'path',
    {
      d: "M 13 14 L 11.667969 14 C 11.484375 14 11.332031 14.148438 11.332031 14.332031 L 11.332031 15.667969 C 11.332031 15.851562 11.484375 16 11.667969 16 L 13 16 C 13.183594 16 13.332031 15.851562 13.332031 15.667969 L 13.332031 14.332031 C 13.332031 14.148438 13.183594 14 13 14 Z M 12.667969 15.332031 L 12 15.332031 L 12 14.667969 L 12.667969 14.667969 Z M 12.667969 15.332031"
    }
  ),
  el( 'path',
    {
      d: "M 15.667969 14 L 14.332031 14 C 14.148438 14 14 14.148438 14 14.332031 L 14 15.667969 C 14 15.851562 14.148438 16 14.332031 16 L 15.667969 16 C 15.851562 16 16 15.851562 16 15.667969 L 16 14.332031 C 16 14.148438 15.851562 14 15.667969 14 Z M 15.332031 15.332031 L 14.667969 15.332031 L 14.667969 14.667969 L 15.332031 14.667969 Z M 15.332031 15.332031"
    }
  ),
  el( 'path',
    {
      d: "M 13 16.667969 L 11.667969 16.667969 C 11.484375 16.667969 11.332031 16.816406 11.332031 17 L 11.332031 18.332031 C 11.332031 18.515625 11.484375 18.667969 11.667969 18.667969 L 13 18.667969 C 13.183594 18.667969 13.332031 18.515625 13.332031 18.332031 L 13.332031 17 C 13.332031 16.816406 13.183594 16.667969 13 16.667969 Z M 12.667969 18 L 12 18 L 12 17.332031 L 12.667969 17.332031 Z M 12.667969 18"
    }
  ),
  el( 'path',
    {
      d: "M 15.667969 16.667969 L 14.332031 16.667969 C 14.148438 16.667969 14 16.816406 14 17 L 14 18.332031 C 14 18.515625 14.148438 18.667969 14.332031 18.667969 L 15.667969 18.667969 C 15.851562 18.667969 16 18.515625 16 18.332031 L 16 17 C 16 16.816406 15.851562 16.667969 15.667969 16.667969 Z M 15.332031 18 L 14.667969 18 L 14.667969 17.332031 L 15.332031 17.332031 Z M 15.332031 18"
    }
  ),
  el( 'path',
    {
      d: "M 18.332031 14 L 17 14 C 16.816406 14 16.667969 14.148438 16.667969 14.332031 L 16.667969 18.332031 C 16.667969 18.515625 16.816406 18.667969 17 18.667969 L 18.332031 18.667969 C 18.515625 18.667969 18.667969 18.515625 18.667969 18.332031 L 18.667969 14.332031 C 18.667969 14.148438 18.515625 14 18.332031 14 Z M 18 18 L 17.332031 18 L 17.332031 14.667969 L 18 14.667969 Z M 18 18"
    }
  ),
  el( 'path',
    {
      d: "M 18 8.667969 L 18.667969 8.667969 L 18.667969 9.332031 L 18 9.332031 Z M 18 8.667969"
    }
  ),
  el( 'path',
    {
      d: "M 16.667969 8.667969 L 17.332031 8.667969 L 17.332031 9.332031 L 16.667969 9.332031 Z M 16.667969 8.667969"
    }
  ),
  el( 'path',
    {
      d: "M 15.332031 8.667969 L 16 8.667969 L 16 9.332031 L 15.332031 9.332031 Z M 15.332031 8.667969"
    }
  )
	);


	registerBlockType( 'form/calculation', {
		title: 'Рассчитать предварительную стоимость',
		icon: icon,
		category: 'widgets',
		keywords: [ 'calculation' ],

		// The "edit" property must be a valid function.
		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				'Рассчитать предварительную стоимость'
			);
		},

		save: function(props) {
			return el(
				'div',
				{ className: props.className },
				'[template_part path="partials/content-calculation"]'
			);
		}
	});
})(
	window.wp.blocks,
	window.wp.element
);