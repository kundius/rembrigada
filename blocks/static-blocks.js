( function( blocks, element ) {

	const el = element.createElement;
	const { registerBlockType } = blocks;

	// Статические блоки-обёртки над шорткодом [template_part].
	// Имена (name) менять нельзя — они хранятся в post_content.
	// reviews здесь нет: у него своя динамическая реализация (reviews.js).
	const STATIC_BLOCKS = [
		{ name: 'content/masters', title: 'Наши мастера', keywords: [ 'masters' ], path: 'partials/content/masters' },
		{ name: 'content/projects', title: 'Проекты', keywords: [ 'projects' ], path: 'partials/content/projects' },
		{ name: 'content/repair-types', title: 'Виды ремонта и стоимость', keywords: [ 'repair-types' ], path: 'partials/content/repair-types' },
		{ name: 'content/scheme', title: 'Схема работы', keywords: [ 'scheme' ], path: 'partials/content/scheme' },
		{ name: 'content/services', title: 'Услуги', keywords: [ 'services' ], path: 'partials/content/services' },
		{ name: 'content/works', title: 'Примеры работ', keywords: [ 'works' ], path: 'partials/content/works' },
		{ name: 'landing/about-team', title: 'О нашей команде', keywords: [ 'about-team' ], path: 'partials/landing/about-team' },
		{ name: 'landing/advantages', title: 'Преимущества', keywords: [ 'advantages' ], path: 'partials/landing/advantages' },
		{ name: 'landing/contacts', title: 'Контакты', keywords: [ 'contacts' ], path: 'partials/landing/contacts' },
		{ name: 'landing/decision', title: 'Вот вы и посмотрели наш сайт', keywords: [ 'decision' ], path: 'partials/landing/decision' },
		{ name: 'landing/easy-work', title: 'Работать с нами легко и понятно', keywords: [ 'easy-work' ], path: 'partials/landing/easy-work' },
		{ name: 'landing/faq', title: 'Ответы на часто задаваемые вопросы', keywords: [ 'faq' ], path: 'partials/landing/faq' },
		{ name: 'landing/get-estimate', title: 'Получите подробную смету', keywords: [ 'get-estimate' ], path: 'partials/landing/get-estimate' },
		{ name: 'landing/like-work', title: 'Почему Вам понравится работать с нами', keywords: [ 'like-work' ], path: 'partials/landing/like-work' },
		{ name: 'landing/measurement', title: 'Бесплатно приедем, замерим, рассчитаем', keywords: [ 'measurement' ], path: 'partials/landing/measurement' },
		{ name: 'landing/problems', title: 'Возьмем на себя все проблемы', keywords: [ 'problems' ], path: 'partials/landing/problems' },
		{ name: 'landing/readiness', title: 'Готовы приступить к ремонту', keywords: [ 'readiness' ], path: 'partials/landing/readiness' },
		{ name: 'landing/services', title: 'Наши услуги', keywords: [ 'services' ], path: 'partials/landing/services' },
	];

	STATIC_BLOCKS.forEach( function( config ) {
		registerBlockType( config.name, {
			title: config.title,
			icon: 'embed-generic',
			category: 'widgets',
			keywords: config.keywords,

			// The "edit" property must be a valid function.
			edit: function( props ) {
				return el(
					'div',
					{ className: props.className },
					config.title
				);
			},

			save: function( props ) {
				return el(
					'div',
					{ className: props.className },
					'[template_part path="' + config.path + '"]'
				);
			}
		} );
	} );
} )(
	window.wp.blocks,
	window.wp.element
);
