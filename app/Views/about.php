<!DOCTYPE html>
<html lang="hr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>O nama | Žene u svijetu tehnologije</title>
    <link rel="stylesheet" href="../../public/css/home.css" />
    <link rel="stylesheet" href="../../public/css/about.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@400;600&family=Lexend:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />
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
              aria-label="Svijetla tema"
            ></button>
            <button
              id="darkTheme"
              class="theme-btn dark-theme"
              aria-label="Tamna tema"
            ></button>
            <button
              id="highContrastTheme"
              class="theme-btn high-contrast-theme"
              aria-label="Visoki kontrast"
            ></button>
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
              <li><a href="index.html">Početna</a></li>
              <li><a href="o-nama.html" class="active">O nama</a></li>
              <li><a href="pitanja.html">Pitanja</a></li>
            </ul>

            <div class="mobile-actions">
              <button
                class="accessibility-button"
                id="mobileAccessibilityButton"
                aria-label="Postavke pristupačnosti"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="22"
                  height="22"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <circle cx="12" cy="12" r="3"></circle>
                  <path
                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"
                  ></path>
                </svg>
              </button>
            </div>
          </nav>

          <div class="header-actions">
            <button
              class="accessibility-button"
              id="accessibilityButton"
              aria-label="Postavke pristupačnosti"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="22"
                height="22"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <circle cx="12" cy="12" r="3"></circle>
                <path
                  d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"
                ></path>
              </svg>
            </button>
          </div>

          <button
            class="hamburger"
            id="hamburger"
            aria-label="Izbornik"
            aria-expanded="false"
          >
            <span></span>
            <span></span>
            <span></span>
          </button>
        </div>
      </header>

      <!-- MAIN CONTENT -->
      <main class="main">
        <!-- O nama sadržaj -->
        <section class="about-hero">
          <div class="about-hero-content">
            <h1 class="about-title">O nama</h1>
            <p class="about-subtitle">Žene u svijetu tehnologije</p>
          </div>
        </section>

        <section class="about-content">
          <div class="about-container">
            <div class="about-text">
              <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa,
                eaque inventore corporis itaque veniam et quasi provident earum
                magnam repellat veritatis iusto eius fuga, iure neque
                reprehenderit, alias libero consequuntur.
              </p>

              <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Animi
                magni vitae temporibus, accusantium soluta recusandae totam
                aperiam voluptatem quos minus in provident deleniti cupiditate,
                libero numquam quis dolorem deserunt doloribus, ab culpa quia
                qui ipsam maxime. Illum velit possimus pariatur!
              </p>

              <h2>Naša misija</h2>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut
                itaque aspernatur sunt cum necessitatibus natus doloribus
                nostrum commodi aliquam, quo, cupiditate ipsam quae earum
                corrupti eos perspiciatis dolorum totam inventore.
              </p>

              <h2>Naš tim</h2>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Error,
                cumque odio, maxime modi, molestias architecto provident dicta
                autem quidem pariatur incidunt doloremque quos? Hic aut
                perspiciatis nulla eligendi numquam quam.
              </p>

              <ul class="team-list">
                <li><strong>Osoba1</strong> - role1</li>
                <li><strong>Osoba2</strong> - role2</li>
                <li><strong>Osoba3</strong> - role3</li>
              </ul>

              <h2>Kontaktirajte nas</h2>
              <p>
                Za sve upite, prijedloge ili suradnje, slobodno nas
                kontaktirajte:
              </p>
              <p><strong>Email:</strong> mejl</p>
              <p><strong>Telefon:</strong> +999</p>
            </div>
          </div>
        </section>
      </main>

      <!-- FOOTER -->
      <footer class="footer">
        <div class="footer-content">
          <div class="footer-section about">
            <h3 class="footer-title">O nama</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit,
              itaque!
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
                  stroke-linejoin="round"
                >
                  <path
                    d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"
                  ></path>
                </svg>
              </a>
              <a href="#" aria-label="Twitter">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path
                    d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"
                  ></path>
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
                  stroke-linejoin="round"
                >
                  <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                  <path
                    d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"
                  ></path>
                  <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>
              </a>
              <a href="#" aria-label="LinkedIn">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path
                    d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"
                  ></path>
                  <rect x="2" y="9" width="4" height="12"></rect>
                  <circle cx="4" cy="4" r="2"></circle>
                </svg>
              </a>
            </div>
          </div>
          <div class="footer-section links">
            <h3 class="footer-title">Brzi linkovi</h3>
            <ul>
              <li><a href="index.html">Početna</a></li>
              <li><a href="o-nama.html">O nama</a></li>
              <li><a href="pitanja.html">Pitanja</a></li>
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
                stroke-linejoin="round"
              >
                <path
                  d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                ></path>
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
                stroke-linejoin="round"
              >
                <path
                  d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
                ></path>
              </svg>
              +999
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
          stroke-linejoin="round"
        >
          <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
      </button>
    </div>
  </body>
</html>
