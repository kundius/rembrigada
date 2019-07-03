const forEach = (list, cb) => {
  if (!list) return;

  for (let i = 0; i < list.length; ++i) {
    cb(list[i])
  }
}

const isVisible = el => !!el && !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length)

forEach(document.querySelectorAll('.wp-block-table'), function(el) {
  const wrapper = document.createElement('div')
  const container = document.createElement('div')
  el.parentNode.insertBefore(wrapper, el)
  container.appendChild(el)
  wrapper.appendChild(container)
  wrapper.classList.add('wp-block-table-wrapper')
  container.classList.add('wp-block-table-container')
})

;(function () {
  const wrapper = document.querySelector('.js-slideshow')
  if (!wrapper) return

  const container = wrapper.querySelector('.js_slides')
  const prevButton = wrapper.querySelector('.js_prev')
  const nextButton = wrapper.querySelector('.js_next')
  const navContainer = wrapper.querySelector('.js_dots')
  const el_index = wrapper.querySelector('.js_index')
  const slider = tns({
    container,
    prevButton,
    nextButton,
    navPosition: 'bottom'
  })
  slider.events.on('transitionStart', (e) => {
    if (e.displayIndex < 10) {
      el_index.innerHTML = '0' + e.displayIndex
    } else {
      el_index.innerHTML = e.displayIndex
    }
  })
}());

;(function () {
  const wrapper = document.querySelector('.js-project-details')
  if (!wrapper) return

  const container = wrapper.querySelector('.js_slides')
  const navContainer = wrapper.querySelector('.js_nav')
  const prevButton = wrapper.querySelector('.js_prev')
  const nextButton = wrapper.querySelector('.js_next')
  const navPrevButton = wrapper.querySelector('.js_nav_prev')
  const navNextButton = wrapper.querySelector('.js_nav_next')
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
    axis: 'vertical',
    gutter: 4,
    items: 4,
    loop: false
  })
  slider.events.on('transitionStart', (e) => {
    sliderNav.goTo(e.displayIndex - 1)
  })
}());

;(function () {
  const wrapper = document.querySelector('.js-objects-slider')
  if (!wrapper) return

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
}());


// MicroModal.init({
//   disableScroll: false,
//   awaitCloseAnimation: true
// })

// const menuContainer = document.querySelector('.js-menu-container')
// if (menuContainer) {
//   document.querySelectorAll('.js-menu-toggle').forEach(function(el) {
//     el.addEventListener('click', function(e) {
//       if (menuContainer.classList.contains('mainmenu_visible')) {
//         menuContainer.classList.remove('mainmenu_visible')
//       } else {
//         menuContainer.classList.add('mainmenu_visible')
//       }
//     })
//   })
// }

// svg4everybody()

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
    const diff = section.offsetTop - inner.offsetTop
    if (diff > 0) {
      let bottom = parseInt(window.getComputedStyle(section.previousElementSibling).getPropertyValue('padding-bottom'))
      section.previousElementSibling.style.paddingBottom = bottom + diff + 'px'
    }
  }
})
