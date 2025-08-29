<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Žene u svijetu tehnologije | Blog</title>
    <link rel="stylesheet" href="../../public/css/index.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@400;600&family=Lexend:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <script src="../../public/js/index.js" defer></script>
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
                        <li><a href="#" class="active">Početna</a></li>
                        <li><a href="o-nama.html">O nama</a></li>

                        <li class="nav-dropdown">
                            <button
                                class="nav-dropdown-toggle"
                                id="navCategoriesDropdown"
                                aria-label="Kategorije"
                                aria-expanded="false"
                                aria-haspopup="true">
                                <span>Kategorije</span>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="dropdown-icon">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <div
                                class="nav-dropdown-menu"
                                id="navCategoriesDropdownMenu"
                                aria-labelledby="navCategoriesDropdown">
                                <div class="dropdown-search">
                                    <input
                                        type="search"
                                        placeholder="Pretraži kategorije..."
                                        class="dropdown-search-input"
                                        id="navCategorySearch"
                                        autocomplete="off" />
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="dropdown-search-icon">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </div>

                                <div class="dropdown-menu-container">
                                    <div class="dropdown-menu-column">
                                        <h4>Inspiracija</h4>
                                        <a
                                            href="#"
                                            class="dropdown-category-item"
                                            data-category="women-tech">Žene u tehnologiji</a>
                                        <a
                                            href="#"
                                            class="dropdown-category-item"
                                            data-category="biographies">Biografije</a>
                                        <a
                                            href="#"
                                            class="dropdown-category-item"
                                            data-category="society-roles">Uloge u društvu</a>
                                        <a
                                            href="#"
                                            class="dropdown-category-item"
                                            data-category="famous-scientists">Poznate znanstvenice</a>
                                    </div>
                                    <div class="dropdown-menu-column">
                                        <h4>Edukacija</h4>
                                        <a
                                            href="#"
                                            class="dropdown-category-item"
                                            data-category="stem">STEM područja</a>
                                        <a
                                            href="#"
                                            class="dropdown-category-item"
                                            data-category="tech-history">Tehnološki razvoj</a>
                                        <a
                                            href="#"
                                            class="dropdown-category-item"
                                            data-category="innovation">Inovacije</a>
                                        <a
                                            href="#"
                                            class="dropdown-category-item"
                                            data-category="interactive-learning">Interaktivno učenje</a>
                                    </div>
                                    <div class="dropdown-menu-column">
                                        <h4>Digitalni svijet</h4>
                                        <a
                                            href="#"
                                            class="dropdown-category-item"
                                            data-category="web-media">Web i mediji</a>
                                        <a
                                            href="#"
                                            class="dropdown-category-item"
                                            data-category="multimedia">Multimedija</a>
                                        <a
                                            href="#"
                                            class="dropdown-category-item"
                                            data-category="graphics">Računalna grafika</a>
                                        <a
                                            href="#"
                                            class="dropdown-category-item"
                                            data-category="coding">Programiranje</a>
                                    </div>
                                </div>

                                <div class="dropdown-menu-footer">
                                    <a href="#" class="view-all-categories">Pogledaj sve kategorije</a>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="mobile-actions">
                        <button
                            class="accessibility-button"
                            id="mobileAccessibilityButton"
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
                    Inspirativne priče poput Hedy Lamarr - glumice i izumiteljice koja
                    je postavila temelje moderne bežične komunikacije
                </p>
            </div>
        </section>

        <!-- MAIN CONTENT -->
        <main class="main">
            <!-- Featured Post -->
            <?php
            $featured = GetAllPostsModel::getSeparatedPost();
            ?>

            <?php if ($featured): ?>
                <section class="featured-post">
                    <h2 class="section-title">Izdvojeni članak</h2>
                    <div class="featured-card">
                        <div class="featured-image">
                            <img
                                src="<?= htmlspecialchars($featured['thumbnail_path'] ?: '/uploads/default.jpg') ?>"
                                alt="<?= htmlspecialchars($featured['title']) ?>" />
                            <div class="featured-tag">Novo</div>
                        </div>
                        <div class="featured-content">
                            <div class="post-meta">
                                <span class="post-category"><?= htmlspecialchars($featured['category_name']) ?></span>
                                <span class="post-date"><?= htmlspecialchars($featured['published_at_hr']) ?></span>
                            </div>
                            <h3 class="featured-title">
                                <?= htmlspecialchars($featured['title']) ?>
                            </h3>
                            <p class="featured-excerpt">
                                <?= htmlspecialchars($featured['description']) ?>
                            </p>
                            <a href="/post/<?= urlencode($featured['slug']) ?>" class="read-more">
                                Pročitaj više <span>→</span>
                            </a>
                        </div>
                    </div>
                </section>
            <?php else: ?>
                <p class="text-muted">Nema izdvojenog članka.</p>
            <?php endif; ?>


            <!-- Latest Posts -->
            <section class="latest-posts">
                <h2 class="section-title">Najnoviji članci</h2>
                <div class="posts-grid">
                    <!-- Post 1 -->
                    <div class="post-card">
                        <div class="post-image">
                            <img
                                src="https://hips.hearstapps.com/hmg-prod/images/gettyimages-3066352.jpg?crop=1xw:1.0xh;center,top&resize=640:*"
                                alt="Ada Lovelace" />
                        </div>
                        <div class="post-content">
                            <div class="post-meta">
                                <span class="post-category">Inspiracija</span>
                                <span class="post-date">20. Svibnja 2025</span>
                            </div>
                            <h3 class="post-title">
                                Ada Lovelace – Prva programerka na svijetu
                            </h3>
                            <p class="post-excerpt">
                                Još u 19. stoljeću, Ada Lovelace predvidjela mogućnosti
                                digitalnih računala. Njezin rad na analitičkom stroju smatra
                                se prvim kodiranjem u povijesti.
                            </p>
                            <a href="#" class="read-more">Pročitaj više →</a>
                        </div>
                    </div>

                    <!-- Post 2 -->
                    <div class="post-card">
                        <div class="post-image">
                            <img
                                src="https://news.yale.edu/sites/default/files/d6_files/YaleNews_hopper-grace.UNIVAC.102635875-CC_0.jpg"
                                alt="Grace Hopper" />
                        </div>
                        <div class="post-content">
                            <div class="post-meta">
                                <span class="post-category">Edukacija</span>
                                <span class="post-date">12. Travnja 2025</span>
                            </div>
                            <h3 class="post-title">
                                Grace Hopper – Majka programskih jezika
                            </h3>
                            <p class="post-excerpt">
                                Razvila je prvi kompajler i doprinijela razvoju COBOL-a. Bila
                                je pionirka u računalnom obrazovanju i zagovornica dostupne
                                tehnologije.
                            </p>
                            <a href="#" class="read-more">Pročitaj više →</a>
                        </div>
                    </div>

                    <!-- Post 3 -->
                    <div class="post-card">
                        <div class="post-image">
                            <img
                                src="https://news.mit.edu/sites/default/files/styles/news_article__image_gallery/public/images/200903/20091222102310-0_0.jpg?itok=SqUZdhKC"
                                alt="Barbara Liskov" />
                        </div>
                        <div class="post-content">
                            <div class="post-meta">
                                <span class="post-category">Digitalni svijet</span>
                                <span class="post-date">28. Ožujka 2025</span>
                            </div>
                            <h3 class="post-title">
                                Barbara Liskov – Objektno programiranje i Liskov princip
                            </h3>
                            <p class="post-excerpt">
                                Njezina istraživanja temelj su suvremenog softverskog
                                inženjerstva. Liskov princip jedno je od osnovnih pravila
                                dizajna objektno orijentiranih sustava.
                            </p>
                            <a href="#" class="read-more">Pročitaj više →</a>
                        </div>
                    </div>
                </div>
            </section>
            <div class="load-more">
                <button class="btn-load-more">Učitaj više članaka</button>
            </div>
        </main>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-section about">
                    <h3 class="footer-title">O nama</h3>
                    <p>
                        Ovaj blog je dio edukativnog projekta “Znamenite žene u svijetu
                        tehnologije” koji promiče žene u svijetu tehnologije i njihov
                        utjecaj. Cilj je inspirirati mlade kroz priče o pionirkama
                        koje su oblikovale digitalni svijet.
                    </p>
                    <div class="social-links">
                        <a
                            href="https://www.facebook.com/p/Ekonomska-i-trgova%C4%8Dka-%C5%A1kola-Dubrovnik-100058136516086/"
                            aria-label="Facebook">
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
                        <a
                            href="https://www.instagram.com/ekonomskaitrgovackaskola/"
                            aria-label="Instagram">
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
                        <li><a href="o-nama.html">O nama</a></li>
                        <li><a href="privacy.html">Privatnost</a></li>
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
                        ured@ss-ekonomskaitrgovacka-du.skole.hr
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
                        020 331 620
                    </p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>
                    &copy; 2025 Ekonomska i trgovačka škola Dubrovnik. Sva prava
                    pridržana.
                </p>
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
