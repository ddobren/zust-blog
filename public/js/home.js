document.addEventListener("DOMContentLoaded", () => {
  // DOM Elements
  const hamburger = document.getElementById("hamburger")
  const nav = document.getElementById("mainNav")
  const backToTopBtn = document.getElementById("backToTop")
  const header = document.querySelector(".header")

  // Accessibility Elements 
  const accessibilityButton = document.getElementById("accessibilityButton")
  const mobileAccessibilityButton = document.getElementById("mobileAccessibilityButton")
  const accessibilityMenu = document.getElementById("accessibilityMenu")
  const increaseFontBtn = document.getElementById("increaseFontSize")
  const decreaseFontBtn = document.getElementById("decreaseFontSize")
  const resetFontBtn = document.getElementById("resetFontSize")
  const lightThemeBtn = document.getElementById("lightTheme")
  const darkThemeBtn = document.getElementById("darkTheme")
  const highContrastBtn = document.getElementById("highContrastTheme")
  const dyslexiaModeToggle = document.getElementById("dyslexiaMode")
  const readingGuideToggle = document.getElementById("readingGuide")
  const reduceAnimationsToggle = document.getElementById("reduceAnimations")
  const resetAccessibilityBtn = document.getElementById("resetAccessibility")
  const readingGuideElement = document.getElementById("readingGuideElement")

  // Categories Dropdown Elements
  const categoriesDropdownToggle = document.getElementById("categoriesDropdownToggle")
  const categoriesDropdownMenu = document.getElementById("categoriesDropdownMenu")
  const categoryPills = document.querySelectorAll(".category-pill")
  const dropdownCategoryItems = document.querySelectorAll(".dropdown-category-item")
  const categorySearch = document.getElementById("categorySearch")

  // Variables for scroll handling
  let lastScrollTop = 0
  const scrollThreshold = 50
  let fontSizeLevel = 0

  // Initialize accessibility settings from localStorage
  initializeAccessibilitySettings()

  // Mobile menu toggle
  hamburger.addEventListener("click", () => {
    nav.classList.toggle("active")
    hamburger.classList.toggle("active")

    // Animate hamburger to X
    const spans = hamburger.querySelectorAll("span")
    if (hamburger.classList.contains("active")) {
      spans[0].style.transform = "translateY(9px) rotate(45deg)"
      spans[1].style.opacity = "0"
      spans[2].style.transform = "translateY(-9px) rotate(-45deg)"
    } else {
      spans[0].style.transform = "none"
      spans[1].style.opacity = "1"
      spans[2].style.transform = "none"
    }
  })

  // Close mobile menu when clicking outside
  document.addEventListener("click", (event) => {
    const isClickInsideNav = nav.contains(event.target)
    const isClickOnHamburger = hamburger.contains(event.target)

    if (!isClickInsideNav && !isClickOnHamburger && nav.classList.contains("active")) {
      nav.classList.remove("active")
      hamburger.classList.remove("active")

      // Reset hamburger icon
      const spans = hamburger.querySelectorAll("span")
      spans[0].style.transform = "none"
      spans[1].style.opacity = "1"
      spans[2].style.transform = "none"
    }
  })

  // Accessibility button in header
  accessibilityButton.addEventListener("click", () => {
    accessibilityMenu.classList.toggle("active")
  })

  // Mobile accessibility button
  if (mobileAccessibilityButton) {
    mobileAccessibilityButton.addEventListener("click", () => {
      accessibilityMenu.classList.toggle("active")
    })
  }

  // Scroll event handling
  window.addEventListener("scroll", () => {
    // Back to top button visibility
    if (window.scrollY > 300) {
      backToTopBtn.classList.add("visible")
    } else {
      backToTopBtn.classList.remove("visible")
    }

    // Header show/hide on scroll
    const currentScrollTop = window.scrollY

    if (currentScrollTop > lastScrollTop && currentScrollTop > scrollThreshold) {
      // Scrolling down
      header.classList.add("hidden")
    } else {
      // Scrolling up
      header.classList.remove("hidden")
    }

    lastScrollTop = currentScrollTop

    // Update reading guide position if enabled
    if (readingGuideElement.style.display === "block") {
      updateReadingGuidePosition(event)
    }
  })

  // Back to top button click
  backToTopBtn.addEventListener("click", () => {
    window.scrollTo({
      top: 0,
      behavior: document.body.classList.contains("reduce-motion") ? "auto" : "smooth",
    })
  })

  // Add animation to elements when they come into view
  const animateOnScroll = () => {
    const elements = document.querySelectorAll(".post-card, .featured-card, .newsletter")

    elements.forEach((element) => {
      const elementPosition = element.getBoundingClientRect().top
      const windowHeight = window.innerHeight

      if (elementPosition < windowHeight - 100) {
        element.style.opacity = "1"
        element.style.transform = "translateY(0)"
      }
    })
  }

  // Set initial state for animated elements
  document.querySelectorAll(".post-card, .featured-card, .newsletter").forEach((element) => {
    element.style.opacity = "0"
    element.style.transform = "translateY(20px)"
    element.style.transition = "opacity 0.6s ease, transform 0.6s ease"
  })

  // Run animation on load and scroll
  window.addEventListener("load", animateOnScroll)
  window.addEventListener("scroll", animateOnScroll)

  // Simulate loading more posts
  const loadMoreBtn = document.querySelector(".btn-load-more")
  if (loadMoreBtn) {
    loadMoreBtn.addEventListener("click", function () {
      this.innerHTML = '<span class="loading-spinner"></span> Učitavanje...'
      this.disabled = true

      // Simulate loading delay
      setTimeout(() => {
        // Create new post cards
        const postsGrid = document.querySelector(".posts-grid")

        for (let i = 0; i < 3; i++) {
          const newPost = document.createElement("article")
          newPost.className = "post-card"
          newPost.style.opacity = "0"
          newPost.style.transform = "translateY(20px)"
          newPost.style.transition = "opacity 0.6s ease, transform 0.6s ease"

          newPost.innerHTML = `
            <div class="post-image">
              <img src="https://preview.colorlib.com/theme/miniblog/images/img_${i + 5}.jpg.webp" alt="Post thumbnail">
            </div>
            <div class="post-content">
              <div class="post-meta">
                <span class="post-category">Tehnologija</span>
                <span class="post-date">1. Siječnja 2023</span>
              </div>
              <h3 class="post-title">Novi članak ${i + 1}</h3>
              <p class="post-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              <a href="#" class="read-more">Pročitaj više <span>→</span></a>
            </div>
          `

          postsGrid.appendChild(newPost)
        }

        // Reset button
        this.innerHTML = "Učitaj više članaka"
        this.disabled = false

        // Animate new elements
        setTimeout(() => {
          animateOnScroll()
        }, 100)
      }, 1500)
    })
  }

  // Add active class to current page in navigation
  const currentLocation = window.location.href
  const navLinks = document.querySelectorAll(".nav-links a")

  navLinks.forEach((link) => {
    if (link.href === currentLocation) {
      link.classList.add("active")
    }
  })

  // Form submissions
  const searchForm = document.querySelector(".search-form")
  if (searchForm) {
    searchForm.addEventListener("submit", function (e) {
      e.preventDefault()
      const searchInput = this.querySelector("input")
      alert(`Pretraživanje za: ${searchInput.value}`)
      searchInput.value = ""
    })
  }

  const newsletterForm = document.querySelector(".newsletter-form")
  if (newsletterForm) {
    newsletterForm.addEventListener("submit", function (e) {
      e.preventDefault()
      const emailInput = this.querySelector('input[type="email"]')
      alert(`Pretplata uspješna za: ${emailInput.value}`)
      emailInput.value = ""
    })
  }

  // Close accessibility menu when clicking outside
  document.addEventListener("click", (event) => {
    const isClickInsideMenu = accessibilityMenu.contains(event.target)
    const isClickOnButton = accessibilityButton && accessibilityButton.contains(event.target)
    const isClickOnMobileButton = mobileAccessibilityButton && mobileAccessibilityButton.contains(event.target)

    if (!isClickInsideMenu && !isClickOnButton && !isClickOnMobileButton && accessibilityMenu.classList.contains("active")) {
      accessibilityMenu.classList.remove("active")
    }
  })

  // Font Size Controls
  increaseFontBtn.addEventListener("click", () => {
    changeFontSize(1)
  })

  decreaseFontBtn.addEventListener("click", () => {
    changeFontSize(-1)
  })

  resetFontBtn.addEventListener("click", () => {
    resetFontSize()
  })

  // Theme Controls
  lightThemeBtn.addEventListener("click", () => {
    toggleTheme("light")
  })

  darkThemeBtn.addEventListener("click", () => {
    toggleTheme("dark")
  })

  highContrastBtn.addEventListener("click", () => {
    toggleTheme("high-contrast")
  })

  // Dyslexia Mode Toggle
  dyslexiaModeToggle.addEventListener("change", function () {
    toggleDyslexiaMode(this.checked)
  })

  // Reading Guide Toggle
  readingGuideToggle.addEventListener("change", function () {
    toggleReadingGuide(this.checked)
  })

  // Reduce Animations Toggle
  reduceAnimationsToggle.addEventListener("change", function () {
    toggleReduceAnimations(this.checked)
  })

  // Reset All Accessibility Settings
  resetAccessibilityBtn.addEventListener("click", () => {
    resetAllAccessibilitySettings()
  })

  // Categories Dropdown Toggle
  categoriesDropdownToggle.addEventListener("click", function () {
    categoriesDropdownMenu.classList.toggle("active")
    this.setAttribute("aria-expanded", categoriesDropdownMenu.classList.contains("active"))
  })

  // Close categories dropdown when clicking outside
  document.addEventListener("click", (event) => {
    const isClickInsideDropdown = categoriesDropdownMenu.contains(event.target)
    const isClickOnToggle = categoriesDropdownToggle.contains(event.target)

    if (!isClickInsideDropdown && !isClickOnToggle && categoriesDropdownMenu.classList.contains("active")) {
      categoriesDropdownMenu.classList.remove("active")
      categoriesDropdownToggle.setAttribute("aria-expanded", "false")
    }
  })

  // Category Search Functionality
  if (categorySearch) {
    categorySearch.addEventListener("input", function () {
      const searchTerm = this.value.toLowerCase()
      const categoryItems = document.querySelectorAll(".dropdown-category-item")

      categoryItems.forEach((item) => {
        const text = item.textContent.toLowerCase()
        if (text.includes(searchTerm)) {
          item.style.display = "block"
        } else {
          item.style.display = "none"
        }
      })

      // Show/hide column headers based on whether any items in that column are visible
      const columns = document.querySelectorAll(".dropdown-menu-column")
      columns.forEach((column) => {
        const items = column.querySelectorAll(".dropdown-category-item")
        const header = column.querySelector("h4")

        let hasVisibleItems = false
        items.forEach((item) => {
          if (item.style.display !== "none") {
            hasVisibleItems = true
          }
        })

        if (hasVisibleItems) {
          column.style.display = "block"
          if (header) header.style.display = "block"
        } else {
          column.style.display = "none"
        }
      })
    })
  }

  // Category Pills Click Event
  categoryPills.forEach((pill) => {
    pill.addEventListener("click", function (e) {
      e.preventDefault()
      categoryPills.forEach((p) => p.classList.remove("active"))
      this.classList.add("active")

      // Get category data
      const category = this.getAttribute("data-category")
      console.log(`Selected category: ${category}`)

      // Here you would typically filter posts by category
      // For demo purposes, we'll just log the selected category
    })
  })

  // Dropdown Category Items Click Event
  dropdownCategoryItems.forEach((item) => {
    item.addEventListener("click", function (e) {
      e.preventDefault()

      // Remove active class from all category pills
      categoryPills.forEach((pill) => pill.classList.remove("active"))

      // Get category data
      const category = this.getAttribute("data-category")
      console.log(`Selected dropdown category: ${category}`)

      // Close the dropdown
      categoriesDropdownMenu.classList.remove("active")
      categoriesDropdownToggle.setAttribute("aria-expanded", "false")

      // Here you would typically filter posts by category
      // For demo purposes, we'll just log the selected category
    })
  })

  // Accessibility Functions
  function changeFontSize(direction) {
    fontSizeLevel += direction

    // Limit font size changes
    if (fontSizeLevel > 3) fontSizeLevel = 3
    if (fontSizeLevel < -2) fontSizeLevel = -2

    const newSize = 16 * (1 + fontSizeLevel * 0.125)
    document.documentElement.style.fontSize = `${newSize}px`

    localStorage.setItem("fontSizeLevel", fontSizeLevel)
  }

  function resetFontSize() {
    fontSizeLevel = 0
    document.documentElement.style.fontSize = "16px"
    localStorage.setItem("fontSizeLevel", fontSizeLevel)
  }

  function toggleTheme(theme) {
    // Remove all theme classes
    document.body.classList.remove("dark-mode", "high-contrast-mode")

    // Add the selected theme class
    if (theme === "dark") {
      document.body.classList.add("dark-mode")
    } else if (theme === "high-contrast") {
      document.body.classList.add("high-contrast-mode")
    }

    // Update theme buttons
    updateThemeButtons(theme)

    // Save to localStorage
    localStorage.setItem("theme", theme)
  }

  function updateThemeButtons(theme) {
    // Remove active class from all theme buttons
    lightThemeBtn.classList.remove("active")
    darkThemeBtn.classList.remove("active")
    highContrastBtn.classList.remove("active")

    // Add active class to the selected theme button
    if (theme === "light") {
      lightThemeBtn.classList.add("active")
    } else if (theme === "dark") {
      darkThemeBtn.classList.add("active")
    } else if (theme === "high-contrast") {
      highContrastBtn.classList.add("active")
    }
  }

  function toggleDyslexiaMode(enabled) {
    if (enabled) {
      document.body.classList.add("dyslexia-mode")
    } else {
      document.body.classList.remove("dyslexia-mode")
    }

    localStorage.setItem("dyslexiaMode", enabled)
  }

  function toggleReadingGuide(enabled) {
    if (enabled) {
      readingGuideElement.style.display = "block"
      document.addEventListener("mousemove", updateReadingGuidePosition)
    } else {
      readingGuideElement.style.display = "none"
      document.removeEventListener("mousemove", updateReadingGuidePosition)
    }

    localStorage.setItem("readingGuide", enabled)
  }

  function updateReadingGuidePosition(event) {
    const y = event ? event.clientY : window.innerHeight / 2
    readingGuideElement.style.top = `${y - 15}px`
  }

  function toggleReduceAnimations(enabled) {
    if (enabled) {
      document.body.classList.add("reduce-motion")
    } else {
      document.body.classList.remove("reduce-motion")
    }

    localStorage.setItem("reduceAnimations", enabled)
  }

  function resetAllAccessibilitySettings() {
    // Reset font size
    resetFontSize()

    // Reset theme
    toggleTheme("light")

    // Reset dyslexia mode
    dyslexiaModeToggle.checked = false
    toggleDyslexiaMode(false)

    // Reset reading guide
    readingGuideToggle.checked = false
    toggleReadingGuide(false)

    // Reset reduce animations
    reduceAnimationsToggle.checked = false
    toggleReduceAnimations(false)

    // Clear localStorage
    localStorage.removeItem("fontSizeLevel")
    localStorage.removeItem("theme")
    localStorage.removeItem("dyslexiaMode")
    localStorage.removeItem("readingGuide")
    localStorage.removeItem("reduceAnimations")
  }

  function initializeAccessibilitySettings() {
    // Initialize font size
    const savedFontSize = localStorage.getItem("fontSizeLevel")
    if (savedFontSize !== null) {
      fontSizeLevel = Number.parseInt(savedFontSize)
      const newSize = 16 * (1 + fontSizeLevel * 0.125)
      document.documentElement.style.fontSize = `${newSize}px`
    }

    // Initialize theme
    const savedTheme = localStorage.getItem("theme")
    if (savedTheme) {
      toggleTheme(savedTheme)
    } else {
      updateThemeButtons("light")
    }

    // Initialize dyslexia mode
    const savedDyslexiaMode = localStorage.getItem("dyslexiaMode") === "true"
    dyslexiaModeToggle.checked = savedDyslexiaMode
    toggleDyslexiaMode(savedDyslexiaMode)

    // Initialize reading guide
    const savedReadingGuide = localStorage.getItem("readingGuide") === "true"
    readingGuideToggle.checked = savedReadingGuide
    toggleReadingGuide(savedReadingGuide)

    // Initialize reduce animations
    const savedReduceAnimations = localStorage.getItem("reduceAnimations") === "true"
    reduceAnimationsToggle.checked = savedReduceAnimations
    toggleReduceAnimations(savedReduceAnimations)
  }
})
