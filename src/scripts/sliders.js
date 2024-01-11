import Swiper, { Autoplay, EffectCoverflow, EffectCreative, Pagination, Navigation } from "swiper";
// import { Navigation, Pagination } from 'swiper/modules';
// import Swiper and modules styles
// import 'swiper/swiper-bundle.css';
// import 'swiper/css';
// import 'swiper/css/navigation';
// import 'swiper/css/pagination';

// // const contentMastersSwipers = document.querySelectorAll('.content-masters-swiper') || []
// // contentMastersSwipers.forEach((el) => {
//     // const container = el.querySelector('.swiper')
//     // const nextEl = el.querySelector('.swiper-button-next')
//     // const prevEl = el.querySelector('.swiper-button-prev')
//     // console.log(container, nextEl, prevEl)
//     new Swiper('.content-masters-swiper .swiper', {
//         modules: [Navigation],
//         slidesPerView: 3,
//         spaceBetween: 40,
//         // pagination: {
//         //     el: ".swiper-pagination",
//         //     clickable: true,
//         // },
//         navigation: {
//             nextEl: '.content-masters-swiper .swiper-button-next',
//             prevEl: '.content-masters-swiper .swiper-button-prev',
//         },
//     });
// // })

console.log(Navigation)
const contentMastersSwipers = document.querySelectorAll('.content-masters-swiper') || []
contentMastersSwipers.forEach((el) => {
    const container = el.querySelector('.swiper')
    const nextEl = el.querySelector('.swiper-button-next')
    const prevEl = el.querySelector('.swiper-button-prev')
    new Swiper(container, {
        // modules: [Navigation],
        slidesPerView: 3,
        spaceBetween: 40,
        // // pagination: {
        // //     el: ".swiper-pagination",
        // //     clickable: true,
        // // },
        navigation: {
            nextEl,
            prevEl,
        },
    });
})
