<style>
    :root {
        --card-bg: #fff;
        --card-border: rgba(0, 0, 0, .08);
    }

    /* Page */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.25rem
    }

    .page-title {
        margin: 0
    }

    /* Card */
    .card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
        overflow: hidden
    }

    .card-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--card-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem
    }

    .card-title {
        font-size: 1.1rem;
        margin: 0;
        font-weight: 600
    }

    .card-body {
        padding: 1.25rem
    }

    .card-aside {
        border-left: 1px solid var(--card-border);
        background: linear-gradient(180deg, #fafafa, transparent)
    }

    /* Grid */
    .grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    @media (min-width: 992px) {
        .grid {
            grid-template-columns: minmax(0, 1fr) 320px;
        }
    }

    /* Inputs */
    .form-label {
        font-weight: 600
    }

    .form-text {
        color: #6c757d
    }

    .input-counter {
        font-size: .825rem;
        color: #6c757d
    }

    /* Thumbnail dropzone */
    .thumb-drop {
        position: relative;
        border: 1px dashed #ced4da;
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        transition: .2s ease border-color, .2s ease background;
        background: #fafafa;
    }

    .thumb-drop.dragover {
        border-color: #0d6efd;
        background: #f0f6ff;
    }

    .thumb-drop .hint {
        font-size: .9rem;
        color: #6c757d
    }

    #featured_preview {
        width: 100%;
        max-width: 420px;
        aspect-ratio: 16/9;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid var(--card-border)
    }

    /* Editor */
    .ck-editor__editable {
        min-height: 420px;
    }

    @media (min-height: 900px) {
        .ck-editor__editable {
            min-height: 520px;
        }
    }

    .ck-content .image {
        max-width: 100%;
        margin: 20px 0
    }

    .ck-content .image>img {
        max-width: 100%;
        height: auto
    }

    .ck-content .media iframe {
        width: 100%;
        height: 400px
    }

    /* Sticky actions (desktop) */
    .sticky-actions {
        position: sticky;
        top: 1rem;
        z-index: 10;
        padding: 1rem
    }

    /* Subtle code-like box for response */
    #responseBox .alert {
        border-radius: 12px
    }
</style>

<div class="page-header">
    <div>
        <h1 class="page-title">Nova objava</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/cms/dashboard#dashboard">Početna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nova objava</li>
            </ol>
        </nav>
    </div>
</div>

<div class="grid">
    <!-- MAIN -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Detalji objave</h2>
            <div class="d-flex d-md-none gap-2">
                <button type="button" class="btn btn-outline-secondary btn-sm" id="btnPreviewSm">Pregled</button>
                <button type="button" class="btn btn-outline-secondary btn-sm" id="btnSaveDraftSm">Skica</button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="/cms/posts/create#create" enctype="multipart/form-data" id="postForm" class="needs-validation" novalidate>
                <!-- Title + desc -->
                <div class="row g-3">
                    <div class="col-12">
                        <label for="title" class="form-label">Naslov</label>
                        <input type="text" name="title" class="form-control" id="title" maxlength="140" required>
                        <div class="d-flex justify-content-between">
                            <small class="form-text">Kratak i jasan naslov.</small>
                            <small class="input-counter"><span id="titleCount">0</span>/140</small>
                        </div>
                        <div class="invalid-feedback">Unesi naslov.</div>
                    </div>

                    <div class="col-12">
                        <label for="desc" class="form-label">Opis</label>
                        <input type="text" name="desc" class="form-control" id="desc" maxlength="240" required>
                        <div class="d-flex justify-content-between">
                            <small class="form-text">Kratak opis za prikaz u listi i SEO.</small>
                            <small class="input-counter"><span id="descCount">0</span>/240</small>
                        </div>
                        <div class="invalid-feedback">Unesi opis.</div>
                    </div>
                </div>

                <!-- Thumbnail -->
                <div class="mt-4">
                    <label class="form-label d-flex align-items-center gap-2">
                        Istaknuta slika (thumbnail)
                        <span class="badge text-bg-light">Preporuka 1280×720</span>
                    </label>
                    <div class="thumb-drop" id="thumbDrop">
                        <input type="file" name="featured_image" id="featured_image" class="form-control" accept="image/*" hidden>
                        <div class="d-flex flex-column align-items-center gap-3">
                            <img id="featured_preview" alt="Preview" style="display:none;">
                            <div>
                                <button type="button" class="btn btn-outline-primary" id="pickThumbBtn">Odaberi sliku</button>
                            </div>
                            <div class="hint">Prevuci i pusti sliku ovdje ili klikni „Odaberi sliku”.</div>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="mt-4">
                    <label for="editor" class="form-label">Sadržaj</label>
                    <textarea name="content" id="editor" class="form-control" rows="10"></textarea>
                    <div class="d-flex justify-content-between mt-2">
                        <small class="form-text">Možeš dodavati slike, tablice i ugradnje.</small>
                        <small class="input-counter">Riječi: <span id="wordCount">0</span></small>
                    </div>
                </div>

                <!-- Actions (mobile-first) -->
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <button type="submit" class="btn btn-primary" id="submitBtn" name="submitPostBtn">
                        <span class="spinner-border spinner-border-sm me-2 d-none" id="submitSpinner"></span>
                        Objavi
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="btnReset">
                        Poništi
                    </button>
                </div>
            </form>

            <!-- response box -->
            <div id="responseBox" class="mt-3"></div>
        </div>
    </div>

    <!-- ASIDE -->
    <aside class="card card-aside d-none d-lg-block">
        <div class="sticky-actions">
            <h6 class="text-uppercase text-muted fw-bold mb-3">Savjeti</h6>
            <ul class="small ps-3">
                <li>Naslov do 60–70 znakova radi boljeg SEO-a.</li>
                <li>Opis: 120–160 znakova kao meta opis.</li>
                <li>Thumbnail u omjeru 16:9, minimalno 1280×720.</li>
                <li>U sadržaju koristi podnaslove (H2/H3) za čitljivost.</li>
            </ul>
        </div>
    </aside>
</div>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    class Base64PreviewAdapter {
        constructor(loader) {
            this.loader = loader;
        }
        upload() {
            return this.loader.file.then(file => new Promise((resolve, reject) => {
                const r = new FileReader();
                r.onload = () => resolve({
                    default: r.result
                });
                r.onerror = reject;
                r.readAsDataURL(file);
            }));
        }
        abort() {}
    }

    function Base64PreviewPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = loader => new Base64PreviewAdapter(loader);
    }
    let editor;

    ClassicEditor.create(document.querySelector('#editor'), {
        toolbar: {
            items: ['heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList', 'numberedList', 'blockQuote', '|', 'insertTable', 'uploadImage', 'mediaEmbed', '|', 'undo', 'redo']
        },
        table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
        },
        image: {
            toolbar: ['imageStyle:inline', 'imageStyle:block', 'imageStyle:side', '|', 'toggleImageCaption', 'imageTextAlternative']
        },
        extraPlugins: [Base64PreviewPlugin]
    }).then(ed => {
        editor = ed;
        const updateWC = () => {
            const txt = editor.getData().replace(/<[^>]+>/g, ' ').replace(/\s+/g, ' ').trim();
            document.getElementById('wordCount').textContent = txt ? txt.split(' ').length : 0;
        };
        ed.model.document.on('change:data', updateWC);
        updateWC();
    });

    /* Title/desc counters */
    const titleEl = document.getElementById('title');
    const descEl = document.getElementById('desc');
    const titleCount = document.getElementById('titleCount');
    const descCount = document.getElementById('descCount');
    const updCounts = () => {
        titleCount.textContent = titleEl.value.length;
        descCount.textContent = descEl.value.length;
    };
    titleEl.addEventListener('input', updCounts);
    descEl.addEventListener('input', updCounts);
    updCounts();

    const thumbInput = document.getElementById('featured_image');
    const thumbPrev = document.getElementById('featured_preview');
    const thumbDrop = document.getElementById('thumbDrop');
    document.getElementById('pickThumbBtn').addEventListener('click', () => thumbInput.click());

    thumbInput.addEventListener('change', () => {
        const f = thumbInput.files?.[0];
        if (!f) {
            thumbPrev.style.display = 'none';
            thumbPrev.src = '';
            return;
        }
        const r = new FileReader();
        r.onload = e => {
            thumbPrev.src = e.target.result;
            thumbPrev.style.display = 'block';
        };
        r.readAsDataURL(f);
    });

    ;
    ['dragenter', 'dragover'].forEach(ev => {
        thumbDrop.addEventListener(ev, (e) => {
            e.preventDefault();
            e.stopPropagation();
            thumbDrop.classList.add('dragover');
        });
    });;
    ['dragleave', 'drop'].forEach(ev => {
        thumbDrop.addEventListener(ev, (e) => {
            e.preventDefault();
            e.stopPropagation();
            thumbDrop.classList.remove('dragover');
        });
    });
    thumbDrop.addEventListener('drop', (e) => {
        const file = e.dataTransfer.files?.[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            thumbInput.files = dt.files;
            const r = new FileReader();
            r.onload = ev => {
                thumbPrev.src = ev.target.result;
                thumbPrev.style.display = 'block';
            };
            r.readAsDataURL(file);
        }
    });

    /* Alerts */
    function renderAlert(type, html) {
        const box = document.getElementById('responseBox');
        box.innerHTML = `
      <div class="alert alert-${type} alert-dismissible fade show" role="alert">
        ${html}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zatvori"></button>
      </div>`;
        box.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    /* Submit */
    document.getElementById('postForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        if (!e.target.checkValidity()) {
            e.target.classList.add('was-validated');
            renderAlert('danger', 'Provjeri obavezna polja.');
            return;
        }

        const submitBtn = document.getElementById('submitBtn');
        const submitSpinner = document.getElementById('submitSpinner');
        submitBtn.disabled = true;
        submitSpinner.classList.remove('d-none');

        try {
            const html = editor.getData();
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const imgs = Array.from(doc.querySelectorAll('img'));
            const form = new FormData();

            form.append('title', titleEl.value.trim());
            form.append('desc', descEl.value.trim());

            if (thumbInput.files && thumbInput.files[0]) {
                form.append('featured_image', thumbInput.files[0]);
            }

            let index = 0;
            for (const img of imgs) {
                const src = img.getAttribute('src') || '';
                if (src.startsWith('data:image/')) {
                    const placeholder = `__IMG${index}__`;
                    img.setAttribute('src', placeholder);

                    const blob = await fetch(src).then(r => r.blob());
                    const ext = (blob.type.split('/')[1] || 'png').replace('jpeg', 'jpg');
                    form.append('content_images[]', new File([blob], `content-${index}.${ext}`, {
                        type: blob.type
                    }));
                    index++;
                }
            }

            form.append('content', doc.body.innerHTML);

            const res = await fetch('/cms/posts/create', {
                method: 'POST',
                body: form
            });
            const ct = res.headers.get('content-type') || '';
            const payload = ct.includes('application/json') ? await res.json() : {
                raw: await res.text()
            };

            document.getElementById('responseBox').innerHTML = '';

            if (payload.status === 'success') {
                renderAlert('success', `${payload.message}`);
                // reset
                e.target.reset();
                titleEl.value = '';
                descEl.value = '';
                updCounts();
                editor.setData('');
                thumbPrev.style.display = 'none';
                thumbPrev.src = '';
            } else {
                let msg = payload.message || payload.error || 'Došlo je do greške.';
                if (payload.errors && Array.isArray(payload.errors) && payload.errors.length) {
                    msg += '<ul class="mb-0">' + payload.errors.map(e => `<li>${e}</li>`).join('') + '</ul>';
                }
                renderAlert('danger', msg);
            }
        } catch (err) {
            console.error(err);
            renderAlert('danger', `Greška pri slanju: ${err.message}`);
        } finally {
            submitBtn.disabled = false;
            submitSpinner.classList.add('d-none');
        }
    });

    document.getElementById('btnReset').addEventListener('click', () => {
        document.getElementById('postForm').reset();
        titleEl.value = '';
        descEl.value = '';
        updCounts();
        editor.setData('');
        thumbPrev.style.display = 'none';
        thumbPrev.src = '';
        document.getElementById('responseBox').innerHTML = '';
    });
</script>
