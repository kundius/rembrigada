// import svg4everybody from 'svg4everybody'
// import MicroModal  from 'micromodal'

// document.querySelectorAll('.js-form').forEach(function(form) {
//   form.addEventListener('submit', function(e) {
//     e.preventDefault()

//     const request = new XMLHttpRequest()
//     request.open('POST', form.action, true)
//     request.addEventListener('readystatechange', function() {
//       if (this.readyState != 4) return

//       const response = JSON.parse(request.response)
//       let message = form.querySelector('.form__error')
//       if (!message) {
//         message = document.createElement('div')
//         message.classList.add('form__error')
//         message.style.display = 'none'
//         form.appendChild(message)
//       }

//       if (response.status == 'validation_failed' || response.status == 'mail_failed') {
//         message.innerHTML = response.message
//         message.style.display = 'block'
//       }
//     })
//     request.send(new FormData(form))
//   })
// })

// document.querySelectorAll('.js-split-words').forEach(function(el) {
//   const words = el.innerHTML.split(' ')
//   el.innerHTML = '<span>' + words.join('</span><span>') + '</span>'
// })

const slideshow = document.querySelector('.js-slideshow')

if (slideshow) {
  const dot_count = slideshow.querySelectorAll('.js_slide').length
  const el_index = slideshow.querySelector('.js_index')
  const dot_container = slideshow.querySelector('.js_dots')
  const dot_list_item = document.createElement('li')

  function handleDotEvent (e) {
    if (e.type === 'before.lory.init') {
      for (let i = 0, len = dot_count; i < len; i++) {
        dot_container.appendChild(dot_list_item.cloneNode())
      }
      dot_container.childNodes[0].classList.add('active')
    }
    if (e.type === 'after.lory.init') {
      for (let i = 0, len = dot_count; i < len; i++) {
        dot_container.childNodes[i].addEventListener('click', function(e) {
          dot_navigation_slider.slideTo(Array.prototype.indexOf.call(dot_container.childNodes, e.target))
        })
      }
    }
    if (e.type === 'after.lory.slide') {
      for (let i = 0, len = dot_container.childNodes.length; i < len; i++) {
        dot_container.childNodes[i].classList.remove('active')
      }
      dot_container.childNodes[e.detail.currentSlide - 1].classList.add('active')

      if (e.detail.currentSlide < 10) {
        el_index.innerHTML = '0' + e.detail.currentSlide
      } else {
        el_index.innerHTML = e.detail.currentSlide
      }
    }
    if (e.type === 'on.lory.resize') {
        for (let i = 0, len = dot_container.childNodes.length; i < len; i++) {
            dot_container.childNodes[i].classList.remove('active')
        }
        dot_container.childNodes[0].classList.add('active')
    }
  }
  slideshow.addEventListener('before.lory.init', handleDotEvent)
  slideshow.addEventListener('after.lory.init', handleDotEvent)
  slideshow.addEventListener('after.lory.slide', handleDotEvent)

  const dot_navigation_slider = lory(slideshow, {
    enableMouseEvents: true,
    infinite: 1
  })
}

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

document.querySelectorAll('.navigation-list').forEach(function(menu) {
  document.querySelectorAll('.menu-item-has-children').forEach(function(item) {
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

document.querySelectorAll('.header-toggle').forEach(function(handler) {
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
