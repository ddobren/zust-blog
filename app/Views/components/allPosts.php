<div class="page-header mb-3">
  <div>
    <h1 class="page-title">Objave</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="/cms/dashboard#dashboard">Početna</a></li>
        <li class="breadcrumb-item active" aria-current="page">Objave</li>
      </ol>
    </nav>
  </div>
</div>

<div class="grid">
  <div class="card">
    <div class="card-header">
      <h2 class="card-title m-0">Sve objave</h2>
    </div>

    <div class="card-body">
      <form class="row g-2 align-items-end" id="filtersForm">
        <div class="col-12 col-md-4">
          <label class="form-label" for="searchInput">Pretraži</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input id="searchInput" type="search" class="form-control" placeholder="Naslov, opis…">
          </div>
        </div>

        <div class="col-6 col-md-3">
          <label class="form-label" for="categoryFilter">Kategorija</label>
          <select id="categoryFilter" class="form-select">
            <option value="">Sve kategorije</option>
            <?php
              $cats = (new PostsController)->getCategories();
              foreach ($cats as $c) {
                echo '<option value="'.(int)$c['id'].'">'.htmlspecialchars($c['name']).'</option>';
              }
            ?>
          </select>
        </div>

        <div class="col-6 col-md-3">
          <label class="form-label" for="statusFilter">Status</label>
          <select id="statusFilter" class="form-select">
            <option value="">Svi statusi</option>
            <option value="published">Objavljeno</option>
            <!-- <option value="draft">Skica</option> -->
          </select>
        </div>

        <div class="col-12 col-md-2">
          <label class="form-label" for="sortSelect">Sortiraj</label>
          <select id="sortSelect" class="form-select">
            <option value="published_at_desc">Najnovije</option>
            <option value="published_at_asc">Najstarije</option>
            <option value="title_asc">Naslov A–Z</option>
            <option value="title_desc">Naslov Z–A</option>
          </select>
        </div>
      </form>

      <div class="table-responsive mt-3">
        <table class="table align-middle">
          <thead class="table-light">
            <tr>
              <th style="width:48px;"></th>
              <th>Naslov</th>
              <th class="d-none d-md-table-cell">Kategorija</th>
              <th class="d-none d-lg-table-cell">Autor</th>
              <th>Status</th>
              <th class="text-end">Objavljeno</th>
              <th class="text-end" style="width:140px;">Akcije</th>
            </tr>
          </thead>
          <tbody id="postsTbody">
            <tr>
              <td colspan="7" class="text-center py-4 text-muted">Učitavanje…</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 mt-3">
        <div class="text-muted small" id="resultsInfo">—</div>
        <nav>
          <ul class="pagination mb-0" id="pagination"></ul>
        </nav>
      </div>

      <div id="listResponseBox" class="mt-3"></div>
    </div>
  </div>
</div>

<script>
  const fmtDate = (ts) => {
    if (!ts) return '—';
    if (ts > 9999999999) ts = Math.floor(ts / 1000);
    const d = new Date(ts * 1000);
    return d.toLocaleDateString('hr-HR', { year:'numeric', month:'2-digit', day:'2-digit' }) + ' ' +
           d.toLocaleTimeString('hr-HR', { hour:'2-digit', minute:'2-digit' });
  };

  const badge = (status) => {
    if (status === 'published') return '<span class="badge text-bg-success">Objavljeno</span>';
    if (status === 'draft')     return '<span class="badge text-bg-secondary">Skica</span>';
    return '<span class="badge text-bg-light">' + (status || '—') + '</span>';
  };

  const escapeHtml = (s) => String(s ?? '').replace(/[&<>"']/g, m => ({
    '&':'&amp;', '<':'&lt;', '>':'&gt;', '"':'&quot;', "'":'&#039;'
  }[m]));

  const mapPost = (p) => ({
    id:            p.id,
    title:         p.title,
    description:   p.description,
    categoryId:    p.category_id,
    categoryName:  p.category_name,
    authorId:      p.author_id,
    authorName:    p.author_username,
    status:        p.status,
    thumb:         p.thumbnail_path || '',
    publishedAt:   p.published_at || null,
    slug:          p.slug
  });

  const state = {
    page: 1,
    per_page: 10,
    q: '',
    category_id: '',
    status: '',
    sort: 'published_at_desc'
  };

  let allPosts = []; 
  let filtered = [];  

  const tbody  = document.getElementById('postsTbody');
  const pagEl  = document.getElementById('pagination');
  const infoEl = document.getElementById('resultsInfo');
  const respBox= document.getElementById('listResponseBox');

  function renderAlert(type, html){
    respBox.innerHTML = `
      <div class="alert alert-${type} alert-dismissible fade show" role="alert">
        ${html}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zatvori"></button>
      </div>`;
  }

  async function initLoad(){
    tbody.innerHTML = `<tr><td colspan="7" class="text-center py-4 text-muted">Učitavanje…</td></tr>`;
    try{
      const res = await fetch('/cms/api/posts', { headers:{ 'Accept':'application/json' }});
      if(!res.ok) throw new Error('Greška pri dohvatu ('+res.status+')');
      const json = await res.json();
      allPosts = (json.data || []).map(mapPost);
      applyFiltersAndRender();
    }catch(err){
      console.error(err);
      tbody.innerHTML = `<tr><td colspan="7" class="text-center py-5 text-danger">Nešto je pošlo po zlu.</td></tr>`;
      renderAlert('danger', escapeHtml(err.message));
    }
  }

  function applyFiltersAndRender(){
    const q = state.q.toLowerCase();
    filtered = allPosts.filter(p => {
      const matchQ = !q || (
        (p.title || '').toLowerCase().includes(q) ||
        (p.description || '').toLowerCase().includes(q) ||
        (p.categoryName || '').toLowerCase().includes(q) ||
        (p.authorName || '').toLowerCase().includes(q)
      );
      const matchCat = !state.category_id || String(p.categoryId) === String(state.category_id);
      const matchStatus = !state.status || p.status === state.status;
      return matchQ && matchCat && matchStatus;
    });

    const sort = state.sort;
    filtered.sort((a,b) => {
      switch (sort) {
        case 'published_at_asc':  return (a.publishedAt||0) - (b.publishedAt||0);
        case 'published_at_desc': return (b.publishedAt||0) - (a.publishedAt||0);
        case 'title_asc':         return (a.title||'').localeCompare(b.title||'', 'hr', { sensitivity:'base' });
        case 'title_desc':        return (b.title||'').localeCompare(a.title||'', 'hr', { sensitivity:'base' });
        default:                  return (b.publishedAt||0) - (a.publishedAt||0);
      }
    });

    const total = filtered.length;
    const last_page = Math.max(1, Math.ceil(total / state.per_page));
    if (state.page > last_page) state.page = last_page;

    const startIdx = (state.page - 1) * state.per_page;
    const pageItems = filtered.slice(startIdx, startIdx + state.per_page);

    if (pageItems.length === 0){
      tbody.innerHTML = `<tr><td colspan="7" class="text-center py-5">
        <div class="text-muted">Nema rezultata.</div>
        <div class="mt-2">
          <a href="/cms/posts/create#create" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nova objava
          </a>
        </div>
      </td></tr>`;
    } else {
      tbody.innerHTML = pageItems.map(rowTpl).join('');
    }

    const from = total ? startIdx + 1 : 0;
    const to   = total ? Math.min(startIdx + state.per_page, total) : 0;
    infoEl.textContent = `Prikaz ${from}–${to} od ${total}`;

    renderPagination({ page: state.page, last_page });
  }

  function rowTpl(p){
    const img = p.thumb
      ? `<img src="${escapeHtml(p.thumb)}" alt="Thumbnail" style="width:48px;height:48px;object-fit:cover;border-radius:8px;border:1px solid rgba(0,0,0,.06)">`
      : `<div class="bg-light d-flex align-items-center justify-content-center" style="width:48px;height:48px;border-radius:8px;border:1px solid rgba(0,0,0,.06)"><i class="bi bi-image text-muted"></i></div>`;

    return `
      <tr>
        <td>${img}</td>
        <td>
          <div class="fw-semibold">${escapeHtml(p.title)}</div>
          <div class="text-muted small text-truncate" style="max-width:480px;">${escapeHtml(p.description || '')}</div>
        </td>
        <td class="d-none d-md-table-cell">${escapeHtml(p.categoryName || `#${p.categoryId ?? '—'}`)}</td>
        <td class="d-none d-lg-table-cell">${escapeHtml(p.authorName || `#${p.authorId ?? '—'}`)}</td>
        <td>${badge(p.status)}</td>
        <td class="text-end">${fmtDate(p.publishedAt)}</td>
        <td class="text-end">
          <div class="btn-group btn-group-sm">
            <a href="/cms/posts/edit?id=${encodeURIComponent(p.id)}#edit" class="btn btn-outline-secondary" title="Uredi">
              <i class="bi bi-pencil"></i>
            </a>
            <a href="/posts/${encodeURIComponent(p.slug || p.id)}" target="_blank" class="btn btn-outline-secondary" title="Pregled">
              <i class="bi bi-box-arrow-up-right"></i>
            </a>
            <button class="btn btn-outline-danger" onclick="onDeletePost(${p.id})" title="Obriši">
              <i class="bi bi-trash"></i>
            </button>
          </div>
        </td>
      </tr>`;
  }

  function renderPagination(meta){
    const cur = Number(meta.page || 1);
    const last = Number(meta.last_page || 1);
    const prevDis = cur <= 1 ? ' disabled' : '';
    const nextDis = cur >= last ? ' disabled' : '';
    const pages = [];
    const win = 2;
    const from = Math.max(1, cur - win);
    const to   = Math.min(last, cur + win);

    pages.push(`<li class="page-item${prevDis}"><a class="page-link" href="#" data-page="${cur-1}">«</a></li>`);
    if (from > 1) pages.push(`<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`);
    if (from > 2) pages.push(`<li class="page-item disabled"><span class="page-link">…</span></li>`);
    for (let p=from; p<=to; p++){
      pages.push(`<li class="page-item ${p===cur?'active':''}"><a class="page-link" href="#" data-page="${p}">${p}</a></li>`);
    }
    if (to < last-1) pages.push(`<li class="page-item disabled"><span class="page-link">…</span></li>`);
    if (to < last) pages.push(`<li class="page-item"><a class="page-link" href="#" data-page="${last}">${last}</a></li>`);
    pages.push(`<li class="page-item${nextDis}"><a class="page-link" href="#" data-page="${cur+1}">»</a></li>`);

    pagEl.innerHTML = pages.join('');
    pagEl.querySelectorAll('a[data-page]').forEach(a=>{
      a.addEventListener('click', (e)=>{
        e.preventDefault();
        const p = parseInt(a.getAttribute('data-page'), 10);
        if(!isNaN(p) && p !== state.page){
          state.page = p;
          applyFiltersAndRender();
        }
      });
    });
  }

  let searchTimer;
  document.getElementById('searchInput').addEventListener('input', (e)=>{
    clearTimeout(searchTimer);
    searchTimer = setTimeout(()=>{
      state.q = e.target.value.trim();
      state.page = 1;
      applyFiltersAndRender();
    }, 300);
  });

  document.getElementById('categoryFilter').addEventListener('change', (e)=>{
    state.category_id = e.target.value;
    state.page = 1;
    applyFiltersAndRender();
  });

  document.getElementById('statusFilter').addEventListener('change', (e)=>{
    state.status = e.target.value;
    state.page = 1;
    applyFiltersAndRender();
  });

  document.getElementById('sortSelect').addEventListener('change', (e)=>{
    state.sort = e.target.value;
    state.page = 1;
    applyFiltersAndRender();
  });

  // Ostavi svoje postojeće backend akcije — ovdje samo handler
  window.onDeletePost = async function(id){
    if(!confirm('Obrisati objavu #'+id+'?')) return;
    try{
      const res = await fetch('/cms/posts/delete', {
        method:'POST',
        headers: { 'Accept':'application/json' },
        body: new URLSearchParams({ id })
      });
      const out = await res.json();
      if (out.status === 'success'){
        renderAlert('success', 'Objava obrisana.');
        allPosts = allPosts.filter(p => p.id !== id);
        if (filtered.length === 1 && state.page > 1) state.page -= 1;
        applyFiltersAndRender();
      } else {
        renderAlert('danger', out.message || 'Brisanje nije uspjelo.');
      }
    }catch(err){
      console.error(err);
      renderAlert('danger','Greška pri brisanju.');
    }
  };

  // Init
  initLoad();
</script>
