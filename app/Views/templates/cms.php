<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CMS Dashboard</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" defer></script>

    <link rel="stylesheet" href="../../../public/css/globals.css">
    <link rel="stylesheet" href="../../../public/css/CMS/cms.css">

    <script src="../../../public/js/CMS/cms.js" defer></script>
</head>

<body>
    <!-- Mobile Header -->
    <div class="mobile-header">
        <a href="#dashboard" class="mobile-brand">
            <i class="bi bi-layout-text-sidebar-reverse"></i>
            <span>CMS Blog</span>
        </a>
        <button type="button" class="mobile-toggle" id="mobileToggle">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <div class="overlay" id="overlay"></div>

    <div class="wrapper">
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="#dashboard" class="sidebar-brand">
                    <i class="bi bi-layout-text-sidebar-reverse"></i>
                    <span class="sidebar-brand-text">CMS Blog</span>
                </a>
                <button type="button" class="sidebar-toggle" id="sidebarToggle">
                    <i class="bi bi-chevron-left"></i>
                </button>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Glavni izbornik</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="/cms/dashboard#dashboard" class="nav-link" data-hash="dashboard">
                            <i class="bi bi-speedometer2"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/cms/posts#posts" class="nav-link" data-hash="posts">
                            <i class="bi bi-file-earmark-text"></i>
                            <span class="nav-link-text">Objave</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/cms/posts/create#create" class="nav-link" data-hash="create">
                            <i class="bi bi-plus-circle"></i>
                            <span class="nav-link-text">Nova objava</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/cms/categories#categories" class="nav-link" data-hash="categories">
                            <i class="bi bi-tag"></i>
                            <span class="nav-link-text">Kategorije</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Administracija</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#users" class="nav-link" data-hash="users">
                            <i class="bi bi-people"></i>
                            <span class="nav-link-text">Korisnici</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="settings#settings" class="nav-link" data-hash="settings">
                            <i class="bi bi-gear"></i>
                            <span class="nav-link-text">Postavke</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr(Auth::getUsername(), 0, 1)); ?>
                    </div>
                    <div class="user-details">
                        <p class="user-name"><?= htmlspecialchars(Auth::getUsername()); ?></p>
                        <p class="user-role"><?= htmlspecialchars(Auth::getRole()); ?></p>
                    </div>
                </div>
                <a href="/cms/logout" class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    <span class="nav-link-text">Odjava</span>
                </a>
            </div>
        </nav>

        <main class="main-content" id="mainContent">
            {{content}}
        </main>

    </div>
</body>

</html>
