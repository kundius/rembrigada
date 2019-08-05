import MicroModal  from 'micromodal'
import svg4everybody from 'svg4everybody'
import LazyLoad from 'vanilla-lazyload'
import forEach from 'lodash/forEach'
import throttle from 'lodash/throttle'
import { tns } from 'tiny-slider/src/tiny-slider.module.js'
import AWN from 'awesome-notifications/dist/index.js'
import 'awesome-notifications/dist/style.css'

const isVisible = el => !!el && !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length)

let notifier = new AWN({
  icons: {
    enabled: false
  }
})

MicroModal.init({
  disableScroll: false,
  awaitCloseAnimation: true
})

forEach(document.querySelectorAll('a[href="#callback"]'), el => {
  el.addEventListener('click', (e) => {
    e.preventDefault()
    MicroModal.show('callback')
  })
})

forEach(document.querySelectorAll('.js-header-callback'), el => {
  el.addEventListener('click', (e) => {
    if (!(/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent))) {
      e.preventDefault()
      MicroModal.show('callback')
    }
  })
})

var lazyLoadInstance = new LazyLoad({
  elements_selector: '.lazyload'
})

var lazylazyLoadInstance = new LazyLoad({
  elements_selector: '.lazylazyload',
  threshold: 50
})

svg4everybody()

forEach(document.querySelectorAll('.wp-block-table'), function(el) {
  const wrapper = document.createElement('div')
  const container = document.createElement('div')
  el.parentNode.insertBefore(wrapper, el)
  container.appendChild(el)
  wrapper.appendChild(container)
  wrapper.classList.add('wp-block-table-wrapper')
  container.classList.add('wp-block-table-container')
})

forEach(document.querySelectorAll('.js-slideshow'), function(wrapper) {
  const container = wrapper.querySelector('.js_slides')
  const prevButton = wrapper.querySelector('.js_prev')
  const nextButton = wrapper.querySelector('.js_next')
  const navContainer = wrapper.querySelector('.js_dots')
  const el_index = wrapper.querySelector('.js_index')
  const slider = tns({
    lazyload: true,
    container,
    prevButton,
    nextButton,
    navPosition: 'bottom',
    onInit: () => {
      document.querySelector('.preloader').classList.add('preloader_hide')
    }
  })
  slider.events.on('transitionStart', (e) => {
    if (e.displayIndex < 10) {
      el_index.innerHTML = '0' + e.displayIndex
    } else {
      el_index.innerHTML = e.displayIndex
    }
  })
})

forEach(document.querySelectorAll('.js-project-details'), function(wrapper) {
  const container = wrapper.querySelector('.js_slides')
  const navContainer = wrapper.querySelector('.js_nav')
  const prevButton = wrapper.querySelector('.js_prev')
  const nextButton = wrapper.querySelector('.js_next')
  const prevMButton = wrapper.querySelector('.js_m_prev')
  const nextMButton = wrapper.querySelector('.js_m_next')
  const navPrevButton = wrapper.querySelector('.js_nav_prev')
  const navNextButton = wrapper.querySelector('.js_nav_next')
  const el_index = wrapper.querySelector('.js_index')
  const slider = tns({
    container,
    prevButton: window.matchMedia('(max-width: 639px)').matches ? prevMButton : prevButton,
    nextButton: window.matchMedia('(max-width: 639px)').matches ? nextMButton : nextButton,
    navContainer,
    items: 1
  })
  const sliderNav = tns({
    container: navContainer,
    prevButton: navPrevButton,
    nextButton: navNextButton,
    nav: false,
    axis: window.matchMedia('(max-width: 959px)').matches ? 'horizontal' : 'vertical',
    gutter: window.matchMedia('(max-width: 959px)').matches ? 10 : 10,
    items: 4,
    loop: false
  })
  slider.events.on('transitionStart', (e) => {
    sliderNav.goTo(e.displayIndex - 1)

    if (e.displayIndex < 10) {
      el_index.innerHTML = '0' + e.displayIndex
    } else {
      el_index.innerHTML = e.displayIndex
    }
  })
})

forEach(document.querySelectorAll('.js-objects-slider'), function(wrapper) {
  const container = wrapper.querySelector('.js_slides')
  const prevButton = wrapper.querySelector('.js_prev')
  const nextButton = wrapper.querySelector('.js_next')
  const slider = tns({
    items: 1,
    slideBy: 'page',
    gutter: 10,
    responsive: {
      640: {
        gutter: 20,
        items: 2
      },
      960: {
        gutter: 40,
        items: 3
      }
    },
    container,
    prevButton,
    nextButton,
    nav: false
  })
})

forEach(document.querySelectorAll('.js-repair-slider'), function(wrapper) {
  const container = wrapper.querySelector('.js_slides')
  const prevButton = wrapper.querySelector('.js_prev')
  const nextButton = wrapper.querySelector('.js_next')
  const slider = tns({
    items: 1,
    slideBy: 'page',
    container,
    prevButton,
    nextButton,
    nav: false
  })
})

forEach(document.querySelectorAll('.navigation-list'), function(menu) {
  forEach(document.querySelectorAll('.menu-item-has-children'), function(item) {
    let timer = null
    const close = () => {
      item.classList.remove('menu-item-opened')
    }
    const open = () => {
      item.classList.add('menu-item-opened')
    }
    const toggle = () => {
      if (item.classList.contains('menu-item-opened')) {
        close()
      } else {
        open()
      }
    }

    const link = item.querySelector('a')
    const handler = document.createElement('span')
    handler.classList.add('menu-toggle')
    link.appendChild(handler)

    handler.addEventListener('click', (e) => {
      e.preventDefault()
      toggle()
    })

    if (window.matchMedia("(min-width: 1200px)").matches && item.parentElement.classList.contains('navigation-list')) {
      item.addEventListener('mouseenter', () => {
        clearTimeout(timer)
        timer = setTimeout(open, 200)
      })
      item.addEventListener('mouseleave', () => {
        clearTimeout(timer)
        timer = setTimeout(close, 200)
      })
    }
  })
})

forEach(document.querySelectorAll('.header-toggle'), function(handler) {
  const header = document.querySelector('.header')
  const navigation = document.querySelector('.navigation')
  const close = () => {
    header.classList.remove('header_menu-opened')
    handler.classList.remove('header-toggle_opened')
    navigation.classList.remove('navigation_opened')
  }
  const open = () => {
    header.classList.add('header_menu-opened')
    handler.classList.add('header-toggle_opened')
    navigation.classList.add('navigation_opened')
  }
  const toggle = () => {
    if (navigation.classList.contains('navigation_opened')) {
      close()
    } else {
      open()
    }
  }
  handler.addEventListener('click', (e) => {
    e.preventDefault()
    toggle()
  })
})

forEach(document.querySelectorAll('.js-img-to-svg'), function(img) {
  const xhttp = new XMLHttpRequest()
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      const div = document.createElement('div')
      div.innerHTML = this.responseText
      const svg = div.querySelector('svg')
      img.parentNode.insertBefore(svg, img.nextSibling)
      img.parentNode.removeChild(img)
    }
  }
  xhttp.open('GET', img.src, true)
  xhttp.send()
})

;(function () {
  const repairDetails = []
  forEach(document.querySelectorAll('.js-repair-item'), function(item) {
    let maxWidth = 1150
    let opened = false
    const $title = item.querySelector('.js-repair-title')
    const $toggles = item.querySelectorAll('.js-repair-toggle')
    const $more = item.querySelector('.js-repair-more')
    const $details = document.querySelector(item.dataset.details)
    const $close = $details.querySelector('.js-repair-close')
    const $arrow = $details.querySelector('.js-repair-arrow')

    const close = () => {
      opened = false
      $details.style.display = 'none'
    }

    const open = () => {
      forEach(repairDetails, row => row.close())
      updatePosition()
      opened = true
      $details.style.display = 'block'
    }

    const toggle = () => {
      if (opened) {
        close()
      } else {
        open()
      }
    }

    const updatePosition = () => {
      const itemBounds = item.getBoundingClientRect()
      let left = 10
      let right = 10
      let top = itemBounds.bottom + 30
      if (window.innerWidth > maxWidth) {
        left = (window.innerWidth - maxWidth) / 2 - 20
        right = left
      }
      $details.style.left = left + 'px'
      $details.style.right = right + 'px'
      $details.style.top = top + 'px'

      setTimeout(() => {
        const titleBounds = $title.getBoundingClientRect()
        const detailsBounds = $details.getBoundingClientRect()
        $arrow.style.left = ((titleBounds.left + titleBounds.width / 2) - detailsBounds.left) + 'px'
      }, 100)
    }

    repairDetails.push({
      close,
      open,
      toggle,
      updatePosition
    })
    
    $close.addEventListener('click', close)
    forEach($toggles, el => el.addEventListener('click', toggle))
  })

  window.addEventListener('scroll', () => {
    forEach(repairDetails, row => row.updatePosition())
  })
}());

forEach(document.querySelectorAll('.js-section-offset'), function(section) {
  const inner = section.querySelector('.js-section-offset-inner')
  if (inner) {
    const innerRect = inner.getBoundingClientRect()
    const sectionRect = section.getBoundingClientRect()
    const diff = sectionRect.top - innerRect.top
    if (diff > 0) {
      let bottom = parseInt(window.getComputedStyle(section.previousElementSibling).getPropertyValue('padding-bottom'))
      section.previousElementSibling.style.paddingBottom = bottom + diff + 'px'
    }
  }
})

forEach(document.querySelectorAll('.js-scroll'), function(el) {
  const header = document.querySelector('.header')
  let top = 0
  let left = 0
  if (el.dataset.target) {
    let target = document.querySelector(el.dataset.target)
    if (target) {
      top = target.offsetTop - header.offsetHeight
    }
  }
  el.addEventListener('click', () => {
    window.scroll({
      top, 
      left, 
      behavior: 'smooth'
    })
  })
})

forEach(document.querySelectorAll('.scrollup'), function(el) {
  const scrollHandler = e => {
    if (window.scrollY > 200) {
      el.style.opacity = 1
    } else {
      el.style.opacity = 0
    }
  }
  window.addEventListener('scroll', throttle(scrollHandler, 100))
})

document.querySelectorAll('.js-form').forEach(function(form) {
  let controls = form.querySelectorAll('span.wpcf7-form-control-wrap')
  let messages = []
  form.addEventListener('submit', function(e) {
    e.preventDefault()

    forEach(controls, el => el.classList.remove('_validation-error'))

    forEach(messages, message => {
      if (message.parentNode) {
        message.parentNode.removeChild(message)
      }
    })
    messages = []

    const request = new XMLHttpRequest()
    request.open('POST', form.action, true)
    request.addEventListener('readystatechange', function() {
      if (this.readyState != 4) return

      const response = JSON.parse(request.response)

      if (response.status == 'mail_sent') {
        form.reset()
        form.classList.add('_validation-mail_sent')
        notifier.success(response.message)
        setTimeout(() => {
          form.classList.remove('_validation-mail_sent')
        }, 5000)
      }

      if (response.status == 'acceptance_missing') {
        notifier.warning(response.message)
      }

      if (response.status == 'mail_failed') {
        notifier.alert(response.message)
      }

      if (response.status == 'validation_failed') {
        forEach(response.invalidFields, field => {
          const el = form.querySelector(field.into)
          el.classList.add('_validation-error')
          const message = document.createElement('span')
          message.classList.add('form-error')
          message.innerHTML = field.message
          el.appendChild(message)
          messages.push(message)
          const close = document.createElement('span')
          close.classList.add('form-error__close')
          message.appendChild(close)
          close.addEventListener('click', () => {
            message.parentNode.removeChild(message)
          })
        })
      }
    })
    request.send(new FormData(form))
  })
})
