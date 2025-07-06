    <link rel="stylesheet" href="../../../public/css/CMS/dashboard.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" defer></script>

    <script src="../../../public/js/CMS/dashboard.js" defer></script>

    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Početna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <!-- Quick actions -->
    <div class="quick-actions row g-3 mb-4">
        <div class="col-md-4">
            <a href="/cms/posts/create" class="quick-action">
                <div class="quick-action-icon">
                    <i class="bi bi-file-earmark-plus"></i>
                </div>
                <div class="quick-action-content">
                    <h6 class="quick-action-title">Nova objava</h6>
                    <p class="quick-action-desc">Kreiraj novu objavu na blogu</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/cms/users/create" class="quick-action">
                <div class="quick-action-icon">
                    <i class="bi bi-person-plus"></i>
                </div>
                <div class="quick-action-content">
                    <h6 class="quick-action-title">Novi korisnik</h6>
                    <p class="quick-action-desc">Dodaj novog korisnika</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/cms/analytics" class="quick-action">
                <div class="quick-action-icon">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div class="quick-action-content">
                    <h6 class="quick-action-title">Analitika</h6>
                    <p class="quick-action-desc">Pregled detaljne analitike</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Metrics -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card stat-card fade-in">
                <div class="card-body">
                    <div class="stat-icon primary">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-title">Ukupno objava</div>
                        <div class="stat-value">12</div>
                        <div class="stat-change positive">
                            <i class="bi bi-arrow-up"></i> 25% u odnosu na prošli mjesec
                        </div>
                    </div>
                    <div class="stat-decoration">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card fade-in" style="animation-delay: 0.1s;">
                <div class="card-body">
                    <div class="stat-icon info">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-title">Korisnici</div>
                        <div class="stat-value">3</div>
                        <div class="stat-change positive">
                            <i class="bi bi-arrow-up"></i> 10% u odnosu na prošli mjesec
                        </div>
                    </div>
                    <div class="stat-decoration">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card fade-in" style="animation-delay: 0.2s;">
                <div class="card-body">
                    <div class="stat-icon success">
                        <i class="bi bi-bar-chart"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-title">Pregledi</div>
                        <div class="stat-value">1,487</div>
                        <div class="stat-change positive">
                            <i class="bi bi-arrow-up"></i> 32% u odnosu na prošli mjesec
                        </div>
                    </div>
                    <div class="stat-decoration">
                        <i class="bi bi-bar-chart"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Chart.js Graph -->
        <div class="col-lg-8">
            <div class="card fade-in" style="animation-delay: 0.3s;">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Analitika posjeta</h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary active" data-period="week">Tjedan</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-period="month">Mjesec</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="visitsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity -->
        <div class="col-lg-4">
            <div class="card fade-in" style="animation-delay: 0.4s;">
                <div class="card-header">
                    <h5 class="mb-0">Nedavne aktivnosti</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-4 py-3 d-flex align-items-center">
                            <div class="me-3">
                                <div class="avatar bg-primary text-white">A</div>
                            </div>
                            <div>
                                <p class="mb-0"><strong>Admin</strong> je objavio novi članak</p>
                                <small class="text-muted">Prije 2 sata</small>
                            </div>
                        </div>
                        <div class="list-group-item px-4 py-3 d-flex align-items-center">
                            <div class="me-3">
                                <div class="avatar bg-info text-white">M</div>
                            </div>
                            <div>
                                <p class="mb-0"><strong>Marko</strong> je komentirao objavu</p>
                                <small class="text-muted">Prije 5 sati</small>
                            </div>
                        </div>
                        <div class="list-group-item px-4 py-3 d-flex align-items-center">
                            <div class="me-3">
                                <div class="avatar bg-success text-white">I</div>
                            </div>
                            <div>
                                <p class="mb-0"><strong>Ivan</strong> je ažurirao postavke</p>
                                <small class="text-muted">Jučer</small>
                            </div>
                        </div>
                        <div class="list-group-item px-4 py-3 d-flex align-items-center">
                            <div class="me-3">
                                <div class="avatar bg-warning text-white">A</div>
                            </div>
                            <div>
                                <p class="mb-0"><strong>Ana</strong> je dodala novu kategoriju</p>
                                <small class="text-muted">Prije 2 dana</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent posts -->
    <div class="card fade-in" style="animation-delay: 0.5s;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Zadnje objave</h5>
            <a href="/cms/posts" class="btn btn-sm btn-primary">Sve objave</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Naslov</th>
                            <th>Kategorija</th>
                            <th>Autor</th>
                            <th>Datum</th>
                            <th>Status</th>
                            <th>Akcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="post-title">title01</div>
                                <div class="post-category">Programiranje</div>
                            </td>
                            <td>Razvoj</td>
                            <td>
                                <div class="author-info">
                                    <div class="avatar">A</div>
                                    <span class="author-name">Admin</span>
                                </div>
                            </td>
                            <td>18.05.2025.</td>
                            <td><span class="badge badge-published">Objavljeno</span></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-icon btn-action" title="Uredi">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-action" title="Pregled">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-action" title="Obriši">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="post-title">title02</div>
                                <div class="post-category">Programiranje</div>
                            </td>
                            <td>Razvoj</td>
                            <td>
                                <div class="author-info">
                                    <div class="avatar">M</div>
                                    <span class="author-name">Marko</span>
                                </div>
                            </td>
                            <td>15.05.2025.</td>
                            <td><span class="badge badge-published">Objavljeno</span></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-icon btn-action" title="Uredi">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-action" title="Pregled">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-action" title="Obriši">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="post-title">title03</div>
                                <div class="post-category">Marketing</div>
                            </td>
                            <td>Marketing</td>
                            <td>
                                <div class="author-info">
                                    <div class="avatar">I</div>
                                    <span class="author-name">Ivan</span>
                                </div>
                            </td>
                            <td>10.05.2025.</td>
                            <td><span class="badge badge-draft">Nacrt</span></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-icon btn-action" title="Uredi">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-action" title="Pregled">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-action" title="Obriši">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="post-title">title04</div>
                                <div class="post-category">Web dizajn</div>
                            </td>
                            <td>Razvoj</td>
                            <td>
                                <div class="author-info">
                                    <div class="avatar">A</div>
                                    <span class="author-name">Ana</span>
                                </div>
                            </td>
                            <td>05.05.2025.</td>
                            <td><span class="badge badge-review">Na pregledu</span></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-icon btn-action" title="Uredi">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-action" title="Pregled">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-action" title="Obriši">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
