<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home | Žene u svijetu tehnologije</title>
    <link rel="stylesheet" href="../../public/css/globals.css" />
    <link rel="stylesheet" href="../../public/css/home.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@400;600&family=Lexend:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <script src="../../public/js/home.js" defer></script>
</head>

<body>
    <!-- Accessibility Panel -->
    <div class="accessibility-panel" id="accessibilityPanel">
        <div class="accessibility-menu" id="accessibilityMenu">
            <h3>Pristupačnost</h3>

            <!-- Font Size Controls -->
            <div class="accessibility-option">
                <span>Veličina fonta</span>
                <div class="font-size-controls">
                    <button id="decreaseFontSize" aria-label="Smanji font">A-</button>
                    <button id="resetFontSize" aria-label="Resetiraj font">A</button>
                    <button id="increaseFontSize" aria-label="Povećaj font">A+</button>
                </div>
            </div>

            <!-- Theme Options -->
            <div class="accessibility-option">
                <span>Tema</span>
                <div class="theme-options">
                    <button
                        id="lightTheme"
                        class="theme-btn light-theme"
                        aria-label="Svijetla tema"></button>
                    <button
                        id="darkTheme"
                        class="theme-btn dark-theme"
                        aria-label="Tamna tema"></button>
                    <button
                        id="highContrastTheme"
                        class="theme-btn high-contrast-theme"
                        aria-label="Visoki kontrast"></button>
                </div>
            </div>

            <!-- Dyslexia Mode -->
            <div class="accessibility-option">
                <span>Mod za disleksiju</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="dyslexiaMode" />
                    <span class="toggle-slider"></span>
                </label>
            </div>

            <!-- Reading Guide -->
            <div class="accessibility-option">
                <span>Vodič za čitanje</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="readingGuide" />
                    <span class="toggle-slider"></span>
                </label>
            </div>

            <!-- Animation Reduction -->
            <div class="accessibility-option">
                <span>Smanji animacije</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="reduceAnimations" />
                    <span class="toggle-slider"></span>
                </label>
            </div>

            <!-- Reset All -->
            <button id="resetAccessibility" class="reset-btn">Resetiraj sve</button>
        </div>
    </div>

    <!-- Reading Guide Element -->
    <div id="readingGuideElement" class="reading-guide-element"></div>

    <div class="container">
        <!-- HEADER -->
        <header class="header">
            <div class="header-inner">
                <div class="logo">
                    <img src="../../public/media/logo.png" alt="Logo" width="80" height="80" />
                </div>

                <nav class="nav" id="mainNav">
                    <ul class="nav-links">
                        <li><a href="/" class="active">Početna</a></li>
                        <li><a href="/about">O nama</a></li>
                    </ul>

                    <!-- DODANO: Dropdown za kategorije -->
                    <div class="categories-dropdown">
                        <button class="categories-dropdown-toggle" id="categoriesDropdownToggle" aria-label="Više kategorija" aria-expanded="false" aria-haspopup="true">
                            <span>Više kategorija</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dropdown-icon">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div class="categories-dropdown-menu" id="categoriesDropdownMenu" aria-labelledby="categoriesDropdownToggle">
                            <div class="dropdown-search">
                                <input type="search" placeholder="Pretraži kategorije..." class="dropdown-search-input" id="categorySearch">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dropdown-search-icon">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </div>
                            <div class="dropdown-menu-container">
                                <div class="dropdown-menu-column">
                                    <h4>Tehnologija</h4>
                                    <a href="#" class="dropdown-category-item" data-category="programming">Kat01</a>
                                </div>
                                <div class="dropdown-menu-column">
                                    <h4>Industrija</h4>
                                    <a href="#" class="dropdown-category-item" data-category="startups">Kat02</a>
                                </div>
                                <div class="dropdown-menu-column">
                                    <h4>Trendovi</h4>
                                    <a href="#" class="dropdown-category-item" data-category="blockchain">Kat03</a>
                                </div>
                            </div>
                            <div class="dropdown-menu-footer">
                                <a href="#" class="view-all-categories">Pogledaj sve kategorije</a>
                            </div>
                        </div>
                    </div>

                    <div class="mobile-actions">
                        <button class="accessibility-button" id="mobileAccessibilityButton" aria-label="Postavke pristupačnosti">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="22"
                                height="22"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path
                                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                        </button>
                    </div>
                </nav>


                <div class="header-actions">
                    <button
                        class="accessibility-button"
                        id="accessibilityButton"
                        aria-label="Postavke pristupačnosti">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="22"
                            height="22"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                    </button>
                </div>

                <button
                    class="hamburger"
                    id="hamburger"
                    aria-label="Izbornik"
                    aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </header>

        <!-- HERO SECTION -->
        <section class="hero">
            <div class="hero-content">
                <h1 class="hero-title">Žene u svijetu tehnologije</h1>
                <p class="hero-subtitle">
                    Inspirativne priče, savjeti i novosti iz svijeta tehnologije
                </p>
            </div>
            <div class="hero-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
            </div>
        </section>

        <!-- CATEGORIES -->

        <!--<section class="categories">
      <div class="categories-container">
        <div class="categories-dropdown">
          <button class="categories-dropdown-toggle" id="categoriesDropdownToggle" aria-label="Više kategorija" aria-expanded="false" aria-haspopup="true">
            <span>Više kategorija</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dropdown-icon">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </button>
          <div class="categories-dropdown-menu" id="categoriesDropdownMenu" aria-labelledby="categoriesDropdownToggle">
            <div class="dropdown-search">
              <input type="search" placeholder="Pretraži kategorije..." class="dropdown-search-input" id="categorySearch">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dropdown-search-icon">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
            </div>
            <div class="dropdown-menu-container">
              <div class="dropdown-menu-column">
                <h4>Tehnologija</h4>
                <a href="#" class="dropdown-category-item" data-category="programming">Kat01</a>
              </div>
              <div class="dropdown-menu-column">
                <h4>Industrija</h4>
                <a href="#" class="dropdown-category-item" data-category="startups">Kat01</a>
              </div>
              <div class="dropdown-menu-column">
                <h4>Trendovi</h4>
                <a href="#" class="dropdown-category-item" data-category="blockchain">Kat01</a>
              </div>
            </div>
            <div class="dropdown-menu-footer">
              <a href="#" class="view-all-categories">Pogledaj sve kategorije</a>
            </div>
          </div>
        </div>
      </div>
    </section>-->

        <!-- MAIN CONTENT -->
        <main class="main">
            <!-- Featured Post -->
            <section class="featured-post">
                <h2 class="section-title">Izdvojeni članak</h2>
                <div class="featured-card">
                    <div class="featured-image">
                        <img
                            src="https://preview.colorlib.com/theme/miniblog/images/img_1.jpg"
                            alt="Featured post thumbnail" />
                        <div class="featured-tag">Novo</div>
                    </div>
                    <div class="featured-content">
                        <div class="post-meta">
                            <span class="post-category">Post01</span>
                            <span class="post-date">19. Srpnja 2023</span>
                        </div>
                        <h3 class="featured-title">Lorem ipsum dolor sit amet.</h3>
                        <p class="featured-excerpt">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse
                            eligendi ab molestiae voluptatum voluptatem quam, voluptas eum
                            odio veniam aut.
                        </p>
                        <a href="#" class="read-more">Pročitaj više <span>→</span></a>
                    </div>
                </div>
            </section>

            <!-- Latest Posts -->
            <section class="latest-posts">
                <h2 class="section-title">Najnoviji članci</h2>
                <div class="posts-grid">
                    <article class="post-card">
                        <div class="post-image">
                            <img
                                src="https://preview.colorlib.com/theme/miniblog/images/img_2.jpg.webp"
                                alt="Post thumbnail" />
                        </div>
                        <div class="post-content">
                            <div class="post-meta">
                                <span class="post-category">kat1</span>
                                <span class="post-date">30. Travnja 2023</span>
                            </div>
                            <h3 class="post-title">Lorem ipsum dolor sit amet.</h3>
                            <p class="post-excerpt">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptates vitae dolorem rerum, fugit enim hic corporis
                                repellendus est recusandae praesentium!
                            </p>
                            <a href="#" class="read-more">Pročitaj više <span>→</span></a>
                        </div>
                    </article>

                    <article class="post-card">
                        <div class="post-image">
                            <img
                                src="https://preview.colorlib.com/theme/miniblog/images/img_3.jpg.webp"
                                alt="Post thumbnail" />
                        </div>
                        <div class="post-content">
                            <div class="post-meta">
                                <span class="post-category">kat03</span>
                                <span class="post-date">15. Ožujka 2023</span>
                            </div>
                            <h3 class="post-title">Lorem ipsum dolor sit amet.</h3>
                            <p class="post-excerpt">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                Sunt, maiores in cumque accusamus officia id optio vero
                                perferendis vitae quis.
                            </p>
                            <a href="#" class="read-more">Pročitaj više <span>→</span></a>
                        </div>
                    </article>

                    <article class="post-card">
                        <div class="post-image">
                            <img
                                src="https://preview.colorlib.com/theme/miniblog/images/img_4.jpg.webp"
                                alt="Post thumbnail" />
                        </div>
                        <div class="post-content">
                            <div class="post-meta">
                                <span class="post-category">Programiranje</span>
                                <span class="post-date">2. Veljače 2023</span>
                            </div>
                            <h3 class="post-title">Lorem ipsum dolor sit amet.</h3>
                            <p class="post-excerpt">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                Doloribus similique eum totam laboriosam nisi impedit,
                                officiis harum. Labore, voluptatum cum!
                            </p>
                            <a href="#" class="read-more">Pročitaj više <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="load-more">
                    <button class="btn-load-more">Učitaj više članaka</button>
                </div>
            </section>

            <!-- Newsletter -->
            <!--<section class="newsletter">
        <div class="newsletter-content">
          <h2>Pretplatite se na naš newsletter</h2>
          <p>Primajte najnovije članke i vijesti direktno u svoj inbox</p>
          <form class="newsletter-form">
            <input type="email" placeholder="Vaša email adresa" required>
            <button type="submit">Pretplati se</button>
          </form>
        </div>
        <div class="newsletter-decoration">
          <div class="decoration-circle"></div>
        </div>
      </section>-->
        </main>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-section about">
                    <h3 class="footer-title">O nama</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero,
                        maxime?
                    </p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#" aria-label="Instagram">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path
                                    d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="footer-section links">
                    <h3 class="footer-title">Brzi linkovi</h3>
                    <ul>
                        <li><a href="/">Početna</a></li>
                        <li><a href="/about">O nama</a></li>
                    </ul>
                </div>
                <div class="footer-section contact">
                    <h3 class="footer-title">Kontakt</h3>
                    <p>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        mejl
                    </p>
                    <p>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        +999
                    </p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Ekonomska i trgovačka škola Dubrovnik. Sva prava pridržana.</p>
            </div>
        </footer>

        <!-- Back to top button -->
        <button id="backToTop" class="back-to-top" aria-label="Povratak na vrh">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <polyline points="18 15 12 9 6 15"></polyline>
            </svg>
        </button>
    </div>
</body>

</html>
