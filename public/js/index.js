// Navigation dropdown functionality
document.addEventListener("DOMContentLoaded", () => {
    const navDropdownToggle = document.getElementById("navCategoriesDropdown")
    const navDropdownMenu = document.getElementById("navCategoriesDropdownMenu")
    const navCategorySearch = document.getElementById("navCategorySearch")

    // Toggle navigation dropdown
    if (navDropdownToggle && navDropdownMenu) {
        navDropdownToggle.addEventListener("click", (e) => {
            e.preventDefault()
            e.stopPropagation()

            const isExpanded = navDropdownToggle.getAttribute("aria-expanded") === "true"

            // Close other dropdowns first
            closeAllDropdowns()

            if (!isExpanded) {
                navDropdownToggle.setAttribute("aria-expanded", "true")
                navDropdownMenu.classList.add("active")

                // Focus search input when dropdown opens
                setTimeout(() => {
                    if (navCategorySearch) {
                        navCategorySearch.focus()
                    }
                }, 100)
            }
        })
    }

    // Search functionality in navigation dropdown
    if (navCategorySearch) {
        navCategorySearch.addEventListener("input", function () {
            const searchTerm = this.value.toLowerCase()
            const categoryItems = navDropdownMenu.querySelectorAll(".dropdown-category-item")

            categoryItems.forEach((item) => {
                const text = item.textContent.toLowerCase()
                const column = item.closest(".dropdown-menu-column")

                if (text.includes(searchTerm)) {
                    item.style.display = "block"
                } else {
                    item.style.display = "none"
                }
            })

            // Hide columns that have no visible items
            const columns = navDropdownMenu.querySelectorAll(".dropdown-menu-column")
            columns.forEach((column) => {
                const visibleItems = column.querySelectorAll(
                    '.dropdown-category-item[style="display: block"], .dropdown-category-item:not([style*="display: none"])',
                )
                if (visibleItems.length === 0 && searchTerm !== "") {
                    column.style.display = "none"
                } else {
                    column.style.display = "block"
                }
            })
        })
    }

    // Close dropdown when clicking outside
    document.addEventListener("click", (e) => {
        if (!e.target.closest(".nav-dropdown")) {
            closeAllDropdowns()
        }
    })

    // Close dropdown on escape key
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            closeAllDropdowns()
        }
    })

    function closeAllDropdowns() {
        // Close navigation dropdown
        if (navDropdownToggle && navDropdownMenu) {
            navDropdownToggle.setAttribute("aria-expanded", "false")
            navDropdownMenu.classList.remove("active")
        }

        // Reset search
        if (navCategorySearch) {
            navCategorySearch.value = ""
            const categoryItems = navDropdownMenu.querySelectorAll(".dropdown-category-item")
            const columns = navDropdownMenu.querySelectorAll(".dropdown-menu-column")

            categoryItems.forEach((item) => {
                item.style.display = "block"
            })

            columns.forEach((column) => {
                column.style.display = "block"
            })
        }
    }

    // Mobile menu functionality
    const hamburger = document.getElementById("hamburger")
    const nav = document.getElementById("mainNav")

    if (hamburger && nav) {
        hamburger.addEventListener("click", () => {
            const isExpanded = hamburger.getAttribute("aria-expanded") === "true"

            hamburger.setAttribute("aria-expanded", !isExpanded)
            nav.classList.toggle("active")

            // Close navigation dropdown when mobile menu closes
            if (isExpanded) {
                closeAllDropdowns()
            }
        })
    }

    // Accessibility panel functionality (existing code)
    const accessibilityButton = document.getElementById("accessibilityButton")
    const mobileAccessibilityButton = document.getElementById("mobileAccessibilityButton")
    const accessibilityMenu = document.getElementById("accessibilityMenu")

    function toggleAccessibilityMenu() {
        accessibilityMenu.classList.toggle("active")
    }

    if (accessibilityButton) {
        accessibilityButton.addEventListener("click", toggleAccessibilityMenu)
    }

    if (mobileAccessibilityButton) {
        mobileAccessibilityButton.addEventListener("click", toggleAccessibilityMenu)
    }

    // Close accessibility menu when clicking outside
    document.addEventListener("click", (e) => {
        if (!e.target.closest(".accessibility-panel") && !e.target.closest(".accessibility-button")) {
            accessibilityMenu.classList.remove("active")
        }
    })

    // Font size controls
    const decreaseFontSize = document.getElementById("decreaseFontSize")
    const increaseFontSize = document.getElementById("increaseFontSize")
    const resetFontSize = document.getElementById("resetFontSize")

    let currentFontSize = 16

    if (decreaseFontSize) {
        decreaseFontSize.addEventListener("click", () => {
            if (currentFontSize > 12) {
                currentFontSize -= 2
                document.documentElement.style.fontSize = currentFontSize + "px"
            }
        })
    }

    if (increaseFontSize) {
        increaseFontSize.addEventListener("click", () => {
            if (currentFontSize < 24) {
                currentFontSize += 2
                document.documentElement.style.fontSize = currentFontSize + "px"
            }
        })
    }

    if (resetFontSize) {
        resetFontSize.addEventListener("click", () => {
            currentFontSize = 16
            document.documentElement.style.fontSize = currentFontSize + "px"
        })
    }

    // Theme controls
    const lightTheme = document.getElementById("lightTheme")
    const darkTheme = document.getElementById("darkTheme")
    const highContrastTheme = document.getElementById("highContrastTheme")

    function setTheme(theme) {
        document.body.classList.remove("dark-mode", "high-contrast-mode")

        if (theme === "dark") {
            document.body.classList.add("dark-mode")
        } else if (theme === "high-contrast") {
            document.body.classList.add("high-contrast-mode")
        }

        // Update active theme button
        document.querySelectorAll(".theme-btn").forEach((btn) => btn.classList.remove("active"))
        if (theme === "light") lightTheme.classList.add("active")
        else if (theme === "dark") darkTheme.classList.add("active")
        else if (theme === "high-contrast") highContrastTheme.classList.add("active")

        localStorage.setItem("theme", theme)
    }

    if (lightTheme) lightTheme.addEventListener("click", () => setTheme("light"))
    if (darkTheme) darkTheme.addEventListener("click", () => setTheme("dark"))
    if (highContrastTheme) highContrastTheme.addEventListener("click", () => setTheme("high-contrast"))

    // Load saved theme
    const savedTheme = localStorage.getItem("theme") || "light"
    setTheme(savedTheme)

    // Dyslexia mode
    const dyslexiaMode = document.getElementById("dyslexiaMode")

    if (dyslexiaMode) {
        dyslexiaMode.addEventListener("change", function () {
            if (this.checked) {
                document.body.classList.add("dyslexia-mode")
            } else {
                document.body.classList.remove("dyslexia-mode")
            }
            localStorage.setItem("dyslexiaMode", this.checked)
        })

        // Load saved dyslexia mode
        const savedDyslexiaMode = localStorage.getItem("dyslexiaMode") === "true"
        dyslexiaMode.checked = savedDyslexiaMode
        if (savedDyslexiaMode) {
            document.body.classList.add("dyslexia-mode")
        }
    }

    // Reading guide
    const readingGuide = document.getElementById("readingGuide")
    const readingGuideElement = document.getElementById("readingGuideElement")

    function updateReadingGuide(e) {
        readingGuideElement.style.top = e.clientY - 15 + "px"
    }

    if (readingGuide && readingGuideElement) {
        readingGuide.addEventListener("change", function () {
            if (this.checked) {
                readingGuideElement.style.display = "block"
                document.addEventListener("mousemove", updateReadingGuide)
            } else {
                readingGuideElement.style.display = "none"
                document.removeEventListener("mousemove", updateReadingGuide)
            }
            localStorage.setItem("readingGuide", this.checked)
        })

        // Load saved reading guide
        const savedReadingGuide = localStorage.getItem("readingGuide") === "true"
        readingGuide.checked = savedReadingGuide
        if (savedReadingGuide) {
            readingGuideElement.style.display = "block"
            document.addEventListener("mousemove", updateReadingGuide)
        }
    }

    // Reduce animations
    const reduceAnimations = document.getElementById("reduceAnimations")

    if (reduceAnimations) {
        reduceAnimations.addEventListener("change", function () {
            if (this.checked) {
                document.body.classList.add("reduce-motion")
            } else {
                document.body.classList.remove("reduce-motion")
            }
            localStorage.setItem("reduceAnimations", this.checked)
        })

        // Load saved animation preference
        const savedReduceAnimations = localStorage.getItem("reduceAnimations") === "true"
        reduceAnimations.checked = savedReduceAnimations
        if (savedReduceAnimations) {
            document.body.classList.add("reduce-motion")
        }
    }

    // Reset all accessibility settings
    const resetAccessibility = document.getElementById("resetAccessibility")

    if (resetAccessibility) {
        resetAccessibility.addEventListener("click", () => {
            // Reset font size
            currentFontSize = 16
            document.documentElement.style.fontSize = currentFontSize + "px"

            // Reset theme
            setTheme("light")

            // Reset dyslexia mode
            if (dyslexiaMode) {
                dyslexiaMode.checked = false
                document.body.classList.remove("dyslexia-mode")
            }

            // Reset reading guide
            if (readingGuide) {
                readingGuide.checked = false
                readingGuideElement.style.display = "none"
                document.removeEventListener("mousemove", updateReadingGuide)
            }

            // Reset animations
            if (reduceAnimations) {
                reduceAnimations.checked = false
                document.body.classList.remove("reduce-motion")
            }

            // Clear localStorage
            localStorage.removeItem("theme")
            localStorage.removeItem("dyslexiaMode")
            localStorage.removeItem("readingGuide")
            localStorage.removeItem("reduceAnimations")
        })
    }

    // Back to top button
    const backToTop = document.getElementById("backToTop")

    if (backToTop) {
        window.addEventListener("scroll", () => {
            if (window.pageYOffset > 300) {
                backToTop.classList.add("visible")
            } else {
                backToTop.classList.remove("visible")
            }
        })

        backToTop.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            })
        })
    }
})
