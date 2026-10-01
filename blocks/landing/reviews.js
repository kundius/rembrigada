( function( blocks, element, blockEditor, components, apiFetch ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;
	const useState = element.useState;
	const useEffect = element.useEffect;
	const hasHooks = typeof useState === 'function' && typeof useEffect === 'function';
	const InspectorControls = blockEditor && ( blockEditor.InspectorControls || ( window.wp.editor && window.wp.editor.InspectorControls ) );
	const PanelBody = components && components.PanelBody;
	const RadioControl = components && components.RadioControl;
	const CheckboxControl = components && components.CheckboxControl;
	const TextControl = components && components.TextControl;
	const Spinner = components && components.Spinner;

	const BLOCK_TITLE = 'Отзывы наших клиентов';
	const BLOCK_BADGE = 'Лендинг';
	const MAX_VISIBLE_TITLES = 5;

	function buildShortcode( attributes ) {
		const what = attributes.what || 'all';
		const ids = attributes.ids || [];
		const showButton = !! attributes.showButton;
		const showMoreButton = attributes.showMoreButton !== false;
		let code = '[template_part path="partials/landing/reviews"';
		if ( what === 'selected' && ids.length ) {
			code += ' what="selected" ids="' + ids.map( function( id ) { return parseInt( id, 10 ); } ).join( ',' ) + '"';
		}
		if ( showButton ) {
			code += ' show_button="1"';
		}
		if ( ! showMoreButton ) {
			code += ' show_more="0"';
		}
		code += ']';
		return code;
	}

	function ReviewsEdit( props ) {
		const attributes = props.attributes || {};
		const setAttributes = props.setAttributes;
		const what = attributes.what || 'all';
		const ids = attributes.ids || [];
		const showButton = !! attributes.showButton;
		const showMoreButton = attributes.showMoreButton !== false;
		const hasInspector = InspectorControls && PanelBody && RadioControl && CheckboxControl && TextControl;

		let listState = null;
		if ( hasHooks ) {
			const stateHook = useState( { posts: null, failed: false } );
			listState = stateHook[0];
			const setListState = stateHook[1];
			useEffect( function() {
				let cancelled = false;
				if ( apiFetch ) {
					apiFetch( { path: '/wp/v2/review?per_page=100&_fields=id,title&orderby=title&order=asc' } ).then(
						function( posts ) {
							if ( ! cancelled ) {
								setListState( { posts: posts || [], failed: false } );
							}
						},
						function() {
							if ( ! cancelled ) {
								setListState( { posts: null, failed: true } );
							}
						}
					);
				} else if ( ! cancelled ) {
					setListState( { posts: null, failed: true } );
				}
				return function() { cancelled = true; };
			}, [] );
		}

		const inspector = hasInspector ? el(
			InspectorControls,
			{ key: 'inspector' },
			el(
				PanelBody,
				{ title: 'Настройки отзывов', initialOpen: true },
				el( RadioControl, {
					label: 'Что показывать',
					selected: what,
					options: [
						{ label: 'Все', value: 'all' },
						{ label: 'Только выбранные', value: 'selected' }
					],
					onChange: function( value ) {
						setAttributes( { what: value } );
					}
				} ),
				what === 'selected' && hasHooks && listState && listState.posts && el(
					'div',
					{ className: 'reviews-block-selector' },
					listState.posts.length ? listState.posts.map( function( post ) {
						const id = post.id;
						const title = ( post.title && post.title.rendered ? post.title.rendered : 'Без названия' ) + ' (#' + id + ')';
						return el( CheckboxControl, {
							key: id,
							label: title,
							checked: ids.indexOf( id ) !== -1,
							onChange: function( checked ) {
								if ( checked ) {
									setAttributes( { ids: ids.concat( [ id ] ) } );
								} else {
									setAttributes( { ids: ids.filter( function( item ) { return item !== id; } ) } );
								}
							}
						} );
					} ) : el( 'p', {}, 'Отзывов пока нет.' )
				),
				what === 'selected' && ( ! hasHooks || ( listState && listState.failed ) ) && el( TextControl, {
					label: 'ID отзывов через запятую',
					value: ids.join( ', ' ),
					help: 'Не удалось загрузить список (нужен доступ к REST API). Укажите ID вручную.',
					onChange: function( value ) {
						const parsed = ( value || '' ).split( /[\s,;]+/ ).map( function( item ) {
							return parseInt( item, 10 );
						} ).filter( function( item ) { return ! isNaN( item ); } );
						setAttributes( { ids: parsed } );
					}
				} ),
				what === 'selected' && hasHooks && listState && ! listState.posts && ! listState.failed && Spinner && el( Spinner, {} ),
				el( CheckboxControl, {
					label: 'Кнопка «Ещё отзывы»',
					help: 'Ссылка на страницу всех отзывов.',
					checked: showMoreButton,
					onChange: function( checked ) {
						setAttributes( { showMoreButton: !! checked } );
					}
				} ),
				el( CheckboxControl, {
					label: 'Кнопка «Добавить отзыв»',
					help: 'Модалка одна общая, подключается в подвале.',
					checked: showButton,
					onChange: function( checked ) {
						setAttributes( { showButton: !! checked } );
					}
				} )
			)
		) : null;

		const whatValue = what === 'selected' ? 'Выбрано: ' + ids.length : 'Все';

		let selectedList = null;
		if ( what === 'selected' ) {
			if ( hasHooks && listState && listState.posts ) {
				const byId = {};
				listState.posts.forEach( function( post ) { byId[ post.id ] = post; } );
				const visible = ids.slice( 0, MAX_VISIBLE_TITLES ).map( function( id ) {
					const post = byId[ id ];
					const label = post
						? ( ( post.title && post.title.rendered ? post.title.rendered : 'Без названия' ) + ' (#' + id + ')' )
						: 'ID ' + id + ' (не найден)';
					return el(
						'li',
						{ key: id, className: 'block-card__list-item' },
						post
							? el( 'span', { dangerouslySetInnerHTML: { __html: ( post.title && post.title.rendered ? post.title.rendered : 'Без названия' ) + ' (#' + id + ')' } } )
							: label
					);
				} );
				if ( ids.length > MAX_VISIBLE_TITLES ) {
					visible.push( el( 'li', { key: 'more', className: 'block-card__list-more' }, '…и ещё ' + ( ids.length - MAX_VISIBLE_TITLES ) ) );
				}
				selectedList = ids.length
					? el( 'ul', { className: 'block-card__list' }, visible )
					: el( 'div', { className: 'block-card__empty' }, 'Ничего не выбрано — будут показаны все' );
			} else {
				selectedList = ids.length
					? el( 'div', { className: 'block-card__ids' }, 'ID: ' + ids.join( ', ' ) )
					: el( 'div', { className: 'block-card__empty' }, 'Ничего не выбрано — будут показаны все' );
			}
		}

		return el(
			'div',
			{ className: props.className },
			inspector,
			el(
				'div',
				{ className: 'block-card__title' },
				BLOCK_TITLE,
				el( 'span', { className: 'block-card__badge' }, BLOCK_BADGE )
			),
			el(
				'div',
				{ className: 'block-card__row' },
				el(
					'div',
					{ className: 'block-card__group' },
					el( 'span', { className: 'block-card__label' }, 'Что показывать' ),
					el( 'span', { className: 'block-card__value' }, whatValue )
				),
				selectedList
			),
			el(
				'div',
				{ className: 'block-card__row' },
				el(
					'div',
					{ className: 'block-card__group' },
					el( 'span', { className: 'block-card__label' }, 'Кнопка «Ещё отзывы»' ),
					el(
						'span',
						{ className: 'block-card__value' },
						el( 'span', { className: 'block-card__dot' + ( showMoreButton ? ' block-card__dot--on' : '' ) } ),
						showMoreButton ? 'Включена' : 'Выключена'
					)
				)
			),
			el(
				'div',
				{ className: 'block-card__row' },
				el(
					'div',
					{ className: 'block-card__group' },
					el( 'span', { className: 'block-card__label' }, 'Кнопка «Добавить отзыв»' ),
					el(
						'span',
						{ className: 'block-card__value' },
						el( 'span', { className: 'block-card__dot' + ( showButton ? ' block-card__dot--on' : '' ) } ),
						showButton ? 'Включена' : 'Выключена'
					)
				)
			),
			el( 'div', { className: 'block-card__hint' }, 'Настройки — в боковой панели' )
		);
	}

	function ReviewsSave( props ) {
		return el(
			'div',
			{ className: props.className },
			buildShortcode( props.attributes || {} )
		);
	}

	registerBlockType( 'landing/reviews', {
		title: BLOCK_TITLE,
		icon: 'embed-generic',
		category: 'widgets',
		keywords: [ 'reviews' ],
		attributes: {
			what: { type: 'string', default: 'all' },
			ids: { type: 'array', default: [], items: { type: 'number' } },
			showButton: { type: 'boolean', default: false },
			showMoreButton: { type: 'boolean', default: true }
		},
		edit: ReviewsEdit,
		save: ReviewsSave
	});
} )(
	window.wp.blocks,
	window.wp.element,
	window.wp.blockEditor || window.wp.editor,
	window.wp.components,
	window.wp.apiFetch
);
