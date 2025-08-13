<style>
    .ck-editor__editable {
        min-height: 400px;
    }

    .ck-content .image {
        max-width: 100%;
        margin: 20px 0;
    }

    .ck-content .image>img {
        max-width: 100%;
        height: auto;
    }

    .ck-content .media iframe {
        width: 100%;
        height: 400px;
    }
</style>

<div class="page-header">
    <h1 class="page-title">Nova objava</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/cms/dashboard#dashboard">Početna</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nova objava</li>
        </ol>
    </nav>
</div>

<form method="POST" action="/cms/posts/create#create" enctype="multipart/form-data" id="postForm">
    <div class="mb-3">
        <label for="title" class="form-label">Naslov</label>
        <input type="text" name="title" class="form-control" id="title" required>
    </div>

    <div class="mb-3">
        <label for="desc" class="form-label">Opis</label>
        <input type="text" name="desc" class="form-control" id="desc" required>
    </div>

    <div class="mb-3">
        <label for="featured_image" class="form-label">Istaknuta slika (thumbnail)</label>
        <input type="file" name="featured_image" id="featured_image" class="form-control" accept="image/*">
        <div class="mt-2">
            <img id="featured_preview" alt="Preview" style="max-width:240px; display:none; border-radius:8px;">
        </div>
    </div>

    <div class="mb-3">
        <label for="editor" class="form-label">Sadržaj</label>
        <textarea name="content" id="editor" class="form-control" rows="10"></textarea>
    </div>

    <button type="submit" class="btn btn-primary" name="submitPostBtn">Objavi</button>
</form>

<!-- CKEditor 5 Classic build -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    class Base64PreviewAdapter {
        constructor(loader) {
            this.loader = loader;
        }
        upload() {
            return this.loader.file.then(file => new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = () => resolve({
                    default: reader.result
                }); // data:image/...
                reader.onerror = reject;
                reader.readAsDataURL(file);
            }));
        }
        abort() {}
    }

    function Base64PreviewPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => new Base64PreviewAdapter(loader);
    }

    let editor; // global ref
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
    }).then(ed => editor = ed).catch(console.error);

    const input = document.getElementById('featured_image');
    const preview = document.getElementById('featured_preview');
    input.addEventListener('change', () => {
        const file = input.files?.[0];
        if (!file) {
            preview.style.display = 'none';
            preview.src = '';
            return;
        }
        const r = new FileReader();
        r.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        r.readAsDataURL(file);
    });

    document.getElementById('postForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const title = document.getElementById('title').value.trim();
        const desc = document.getElementById('desc').value.trim();
        const html = editor.getData();

        const doc = new DOMParser().parseFromString(html, 'text/html');
        const imgs = Array.from(doc.querySelectorAll('img'));
        const form = new FormData();

        form.append('title', title);
        form.append('desc', desc);

        if (input.files && input.files[0]) {
            form.append('featured_image', input.files[0]);
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

        const processedHTML = doc.body.innerHTML;
        form.append('content', processedHTML);

        try {
            const res = await fetch('/cms/posts/create', {
                method: 'POST',
                body: form
            });
            const ct = res.headers.get('content-type') || '';
            const payload = ct.includes('application/json') ? await res.json() : {
                raw: await res.text()
            };
            console.log('API response:', payload);
            alert('Server response:\n' + (ct.includes('json') ? JSON.stringify(payload, null, 2) : payload.raw));
        } catch (err) {
            console.error(err);
            alert('Greška pri slanju: ' + err.message);
        }
    });
</script>
