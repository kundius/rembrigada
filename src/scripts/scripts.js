import './sliders'

import rangeSlider  from 'rangeslider-pure'
import svg4everybody from 'svg4everybody'
// import LazyLoad from 'vanilla-lazyload'
import forEach from 'lodash/forEach'
import throttle from 'lodash/throttle'
import { tns } from 'tiny-slider/src/tiny-slider.module.js'
import AWN from 'awesome-notifications/dist/index.js'
import * as basicLightbox from 'basiclightbox'
import fslightbox from 'fslightbox'

const formatMoney = (num, thousand = ' ') => {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1' + thousand)
}

const wrap = (toWrap, wrapper) => {
  wrapper = wrapper || document.createElement('div')
  toWrap.parentNode.appendChild(wrapper)
  return wrapper.appendChild(toWrap)
}

const isVisible = el => !!el && !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length)

let notifier = new AWN({
  icons: {
    enabled: false
  }
})

const modals = []

const showModal = target => {
  if (!target) return false

  if (!target.basicLightbox) {
    const close = target.querySelector('[data-basiclightbox-close]')
    target.basicLightbox = basicLightbox.create(target)
    if (close) {
      close.addEventListener('click', target.basicLightbox.close)
    }
    modals.push(target.basicLightbox)
  }

  forEach(modals, modal => {
    if (modal.visible()) {
      modal.close()
    }
  })

  target.basicLightbox.show()
}

forEach(document.querySelectorAll('a[href="#callback"]'), el => {
  el.addEventListener('click', (e) => {
    e.preventDefault()
    showModal(document.querySelector('#callback'))
  })
})

forEach(document.querySelectorAll('[data-basiclightbox]'), el => {
  el.addEventListener('click', (e) => {
    e.preventDefault()
    showModal(document.querySelector(el.dataset.basiclightbox))
  })
})

forEach(document.querySelectorAll('[data-order]'), el => {
  const modalEl = document.querySelector('#order')
  const titleEl = modalEl.querySelector('.order-form__title')
  const descriptionEl = modalEl.querySelector('.order-form__desc')
  const successTitleEl = modalEl.querySelector('.order-form__success .order-form__title')
  const successDescriptionEl = modalEl.querySelector('.order-form__success .order-form__desc')
  const messageEL = modalEl.querySelector('.order-form__message')
  const subjectEl = modalEl.querySelector('[name="subject"]')
  const submitEl = modalEl.querySelector('[type="submit"]')
  const orderSubject = el.dataset.orderSubject || 'Заявка на расчет'
  const orderTitle = el.dataset.orderTitle || 'Заявка на расчет'
  const orderSubmit = el.dataset.orderSubmit || 'Отправить'
  const orderDescription = el.dataset.orderDescription || ''
  const orderSuccessTitle = el.dataset.orderSuccessTitle || 'Ваша заявка успешно отправлена'
  const orderSuccessDescription = el.dataset.orderSuccessDescription || ''
  const orderWithMessage = !!el.dataset.orderWithMessage || false
  el.addEventListener('click', (e) => {
    e.preventDefault()
    titleEl.innerHTML = orderTitle
    submitEl.innerHTML = orderSubmit
    descriptionEl.innerHTML = orderDescription
    successTitleEl.innerHTML = orderSuccessTitle
    successDescriptionEl.innerHTML = orderSuccessDescription
    subjectEl.value = orderSubject
    messageEL.style.display = orderWithMessage ? 'block' : 'none'
    showModal(modalEl)
  })
})

if (!(/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent))) {
  forEach(document.querySelectorAll('.js-header-callback'), el => {
    el.addEventListener('click', (e) => {
      e.preventDefault()
      showModal(document.querySelector('#callback'))
    })
  })
}

// var lazyLoadInstance = new LazyLoad({
//   elements_selector: '.lazyload'
// })

// var lazylazyLoadInstance = new LazyLoad({
//   elements_selector: '.lazylazyload',
//   threshold: 50
// })

svg4everybody()

document.addEventListener('DOMContentLoaded', () => {
  const preloader = document.querySelector('.preloader')
  if (preloader) {
    document.querySelector('.preloader').classList.add('preloader_hide')
  }
})

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
    navPosition: 'bottom'
  })
  if (el_index) {
    slider.events.on('transitionStart', (e) => {
      if (e.displayIndex < 10) {
        el_index.innerHTML = '0' + e.displayIndex
      } else {
        el_index.innerHTML = e.displayIndex
      }
    })
  }
})

forEach(document.querySelectorAll('.js-project-details'), function(wrapper) {
  const container = wrapper.querySelector('.js_slides')
  const navContainer = wrapper.querySelector('.js_nav')
  const prevButton = wrapper.querySelector('.js_prev')
  const nextButton = wrapper.querySelector('.js_next')
  const navPrevButton = wrapper.querySelector('.js_nav_prev')
  const navNextButton = wrapper.querySelector('.js_nav_next')
  const el_index = wrapper.querySelector('.js_index')
  const slider = tns({
    container,
    prevButton,
    nextButton,
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
      e.stopPropagation()
      toggle()
    })

    link.addEventListener('click', (e) => {
      if (!item.classList.contains('menu-item-opened') && !window.matchMedia("(min-width: 1200px)").matches) {
        e.preventDefault()
        open()
      }
    })

    if (window.matchMedia("(min-width: 1200px)").matches) {
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
  const navigationClose = document.querySelector('.navigation-close')
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
  navigationClose.addEventListener('click', (e) => {
    e.preventDefault()
    close()
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

    grecaptcha.execute(wpcf7_recaptcha.sitekey, {action: 'submit'}).then(function(token) {
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

        form.dispatchEvent(new Event("wpcf7submit"))

        const response = JSON.parse(request.response)

        if (response.status == 'mail_sent') {
          form.dispatchEvent(new Event("wpcf7mailsent"))

          form.reset()
          form.classList.add('_validation-mail_sent')
          notifier.success(response.message)
          if (typeof ym !== 'undefined') {
            ym(31338108, 'reachGoal', 'ordercallon')
          }
          setTimeout(() => {
            form.classList.remove('_validation-mail_sent')
          }, 5000)
        }

        if (response.status == 'acceptance_missing') {
          form.dispatchEvent(new Event("wpcf7invalid"))

          notifier.warning(response.message)
        }

        if (response.status == 'mail_failed') {
          form.dispatchEvent(new Event("wpcf7mailfailed"))

          notifier.alert(response.message)
        }

        if (response.status == 'spam') {
          form.dispatchEvent(new Event("wpcf7spam"))

          notifier.alert(response.message)
        }

        if (response.status == 'validation_failed') {
          form.dispatchEvent(new Event("wpcf7invalid"))
          
          forEach(response.invalid_fields, field => {
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

      const formData = new FormData(form)
      formData.append('_wpcf7_recaptcha_response', token)
      formData.append('_wpcf7_unit_tag', 'wpcf7')
      request.send(formData)
    })
  })
})

forEach(document.querySelectorAll('.content-price'), function(wrapper) {
  const header = document.querySelector('.header')
  const tabs = wrapper.querySelectorAll('.content-price__tab')
  const contents = wrapper.querySelectorAll('.content-price__content')
  forEach(tabs, function(tab, index) {
    tab.addEventListener('click', () => {
      forEach(contents, el => el.classList.remove('_active'))
      forEach(tabs, el => el.classList.remove('_active'))
      contents[index].classList.add('_active')
      tab.classList.add('_active')
      if (window.matchMedia('(max-width: 639px)').matches) {
        window.scroll({
          top: contents[index].offsetTop - header.offsetHeight,
          left: 0,
          behavior: 'smooth'
        })
      }
    })
  })
  contents[0].classList.add('_active')
  tabs[0].classList.add('_active')
})

forEach(document.querySelectorAll('.js-selectys'), function(select) {
  const options = select.querySelectorAll('option')

  // create wrapper
  const wrapper = document.createElement('div')
  wrapper.classList.add('selectys')
  wrap(select, wrapper)
  document.addEventListener('click', e => {
    if (!wrapper.contains(e.target) && isVisible(wrapper)) {
      wrapper.classList.remove('_opened')
    }
  })

  // create label
  const label = document.createElement('div')
  label.classList.add('selectys__label')
  label.innerHTML = options[0].innerHTML
  wrapper.appendChild(label)
  label.addEventListener('click', () => {
    if (wrapper.classList.contains('_opened')) {
      wrapper.classList.remove('_opened')
    } else {
      wrapper.classList.add('_opened')
    }
  })

  // create list
  const list = document.createElement('ul')
  list.classList.add('selectys__list')
  wrapper.appendChild(list)
  forEach(options, (option, i) => {
    const li = document.createElement('li')
    li.innerHTML = option.innerHTML
    if (i === 0) li.classList.add('_active')
    li.addEventListener('click', e => {
      forEach(list.children, child => child.classList.remove('_active'))
      li.classList.add('_active')
      select.value = option.value
      select.dispatchEvent(new Event('change'))
      label.innerHTML = option.innerHTML
      wrapper.classList.remove('_opened')
    })
    list.appendChild(li)
  })
})

forEach(document.querySelectorAll('.js-rangeys'), function(range) {
  let handleValue = null
  rangeSlider.create(range, {
    polyfill: true,
    root: document,
    rangeClass: 'rangeSlider',
    disabledClass: 'rangeSlider--disabled',
    fillClass: 'rangeSlider__fill',
    bufferClass: 'rangeSlider__buffer',
    handleClass: 'rangeSlider__handle',
    startEvent: ['mousedown', 'touchstart', 'pointerdown'],
    moveEvent: ['mousemove', 'touchmove', 'pointermove'],
    endEvent: ['mouseup', 'touchend', 'pointerup'],
    onInit () {
      const slider = range.parentNode.querySelector('.rangeSlider')

      // create handle value
      if (!handleValue) {
        const handle = range.parentNode.querySelector('.rangeSlider__handle')
        handleValue = document.createElement('span')
        handleValue.innerHTML = range.value
        handleValue.classList.add('rangeSlider__handle__value')
        handle.appendChild(handleValue)
      }

      // create points
      const points = document.createElement('ul')
      points.classList.add('rangeSlider__points')
      for (let i = 0; i < 5; i++) {
        const point = document.createElement('li')
        const span = document.createElement('span')
        span.innerHTML = Math.round((parseInt(range.max) - parseInt(range.min)) * 0.25 * i)
        point.appendChild(span)
        points.appendChild(point)
      }
      slider.appendChild(points)
    },
    onSlide (position, value) {
      if (handleValue) {
        handleValue.innerHTML = range.value
      }
    }
  })
})

forEach(document.querySelectorAll('.js-intro-calc'), function(form) {
  const prices = {
    apartment: {
      cosmetic: 2500,
      capital: 4500,
      european: 6000
    },
    cottage: {
      cosmetic: 2500,
      capital: 4500,
      european: 6000
    },
    office: {
      cosmetic: 1900,
      capital: 3500,
      european: 5000
    },
    bathroom: 19000,
    kitchen: {
      cosmetic: 3000,
      capital: 5000,
      european: 6500
    }
  }

  const priceEl = form.querySelector('.js-intro-calc-price')
  const rowType = form.querySelector('.intro-calc__row-type')
  const controls = form.querySelectorAll('input, select')
  const getObject = () => form.querySelector('[name="object"]').value
  const getArea = () => form.querySelector('[name="area"]').value
  const getPhone = () => form.querySelector('[name="your-phone"]').value
  const getType = () => form.querySelector('[name="type"]:checked').value

  const calc = () => {
    if (getObject() === 'bathroom') {
      rowType.style.display = 'none'
      const price = formatMoney(prices[getObject()] * getArea())
      priceEl.innerHTML = price
      form.querySelector('[name="price"]').value = price
    } else {
      rowType.style.display = 'block'
      const price = formatMoney(prices[getObject()][getType()] * getArea())
      priceEl.innerHTML = price
      form.querySelector('[name="price"]').value = price
    }
  }

  calc()
  forEach(controls, control => {
    control.addEventListener('input', calc)
    control.addEventListener('change', calc)
  })
})

forEach(document.querySelectorAll('.content-repair-type__collapse'), collapse => {
  const toggle = collapse.querySelector('.content-repair-type__collapse-toggle button')
  const wrapper = collapse.querySelector('.content-repair-type__collapse-wrap')
  const content = collapse.querySelector('.content-repair-type__collapse-content')

  if (!(content.offsetHeight > wrapper.offsetHeight)) {
    collapse.classList.add('content-repair-type__collapse_disabled')
  }

  toggle.addEventListener('click', () => {
    if (!collapse.classList.contains('content-repair-type__collapse_opened')) {
      wrapper.style.maxHeight = content.offsetHeight + 'px'
      collapse.classList.add('content-repair-type__collapse_opened')
    } else {
      wrapper.style.maxHeight = null
      collapse.classList.remove('content-repair-type__collapse_opened')
    }
  })
})


forEach(document.querySelectorAll(".faq-items"), (container) => {
  const items = container.querySelectorAll(".faq-item")
  const closeAll = () => {
    forEach(items, (item) => {
      item.classList.remove("faq-item_active");
      body.style.maxHeight = null;
    })
  }
  forEach(items, (item) => {
    const head = item.querySelector(".faq-item__question");
    const body = item.querySelector(".faq-item__answer");
    head.addEventListener("click", function () {
      forEach(items, (sibling) => {
        if (item !== sibling) {
          sibling.classList.remove("faq-item_active");
          sibling.querySelector(".faq-item__answer").style.maxHeight = null;
        }
      })
      item.classList.toggle("faq-item_active");
      if (body.style.maxHeight) {
        body.style.maxHeight = null;
      } else {
        body.style.maxHeight = body.scrollHeight + "px";
      }
    });
  });
});


forEach(document.querySelectorAll("[data-quiz]"), (container) => {
  const formItem = container.querySelector('[data-quiz-form]')
  const stepItems = container.querySelectorAll('[data-quiz-step]')
  const lineItems = container.querySelectorAll('[data-quiz-line]')
  const screenItems = container.querySelectorAll('[data-quiz-screen]')
  const previousItems = container.querySelectorAll('[data-quiz-previous]')
  const nextItems = container.querySelectorAll('[data-quiz-next]')
  const forwardOnChangeItems = container.querySelectorAll('[data-quiz-forward-on-change]')

  let active = 1

  const to = (n) => {
    active = n
    
    forEach(stepItems, (item, i) => {
      if (i + 1 <= n) {
        item.classList.add('_active')
      } else {
        item.classList.remove('_active')
      }
    })
    
    forEach(lineItems, (item, i) => {
      if (i + 1 < n) {
        item.classList.add('_active')
      } else {
        item.classList.remove('_active')
      }
    })
    
    forEach(screenItems, (item, i) => {
      if (i + 1 === n) {
        item.classList.add('_active')
      } else {
        item.classList.remove('_active')
      }
    })
  }

  const previous = () => {
    if (active === 1) return
    to(active - 1)
  }

  const next = () => {
    if (active === screenItems.length) return
    to(active + 1)
  }

  forEach(previousItems, (item) => {
    item.addEventListener('click', (e) => {
      e.preventDefault()
      previous()
    })
  })

  forEach(nextItems, (item) => {
    item.addEventListener('click', (e) => {
      e.preventDefault()
      next()
    })
  })

  forEach(forwardOnChangeItems, (item) => {
    item.addEventListener('change', (e) => {
      e.preventDefault()
      next()
    })
  })

  formItem.addEventListener('wpcf7mailsent', (e) => {
    next()
  }, false )
})


forEach(document.querySelectorAll('.content-collapsible'), (item) => {
  const button = item.querySelector(".content-collapsible__button");
  const body = item.querySelector(".content-collapsible__body");
  button.addEventListener("click", function () {
    item.classList.toggle("content-collapsible_active");
    if (body.style.maxHeight) {
      body.style.maxHeight = null;
    } else {
      body.style.maxHeight = body.scrollHeight + "px";
    }
  });
});
