import Swiper from "swiper";
import { Navigation, Pagination } from 'swiper/modules';

const contentMastersSwipers = document.querySelectorAll('.content-masters-swiper') || []
contentMastersSwipers.forEach((el) => {
    const container = el.querySelector('.swiper')
    const nextEl = el.querySelector('.swiper-button-next')
    const prevEl = el.querySelector('.swiper-button-prev')
    new Swiper(container, {
        modules: [Navigation],
        slidesPerView: 1,
        spaceBetween: 40,
        navigation: {
            nextEl,
            prevEl,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
        },
    });
})


const contentWorksSwipers = document.querySelectorAll('.content-works-swiper') || []
contentWorksSwipers.forEach((el) => {
    const container = el.querySelector('.swiper')
    const pagination = el.querySelector('.swiper-pagination')
    new Swiper(container, {
        modules: [Pagination],
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: pagination,
            clickable: true,
        },
    });
})
