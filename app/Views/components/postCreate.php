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
        <label for="title" class="form-label">Opis</label>
        <input type="text" name="desc" class="form-control" id="desc" required>
    </div>

    <div class="mb-3">
        <label for="featured_image" class="form-label">Istaknuta slika (thumbnail)</label>
        <input type="file" name="featured_image" id="featured_image" class="form-control" accept="image/*">
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Sadržaj</label>
        <textarea name="content" id="editor" class="form-control" rows="10"></textarea>
    </div>

    <button type="submit" class="btn btn-primary" name="submitPostBtn">Objavi</button>
</form>

<!-- Uključujemo CKEditor 5 Classic build -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    let editorInstance;

    // Funkcija za konvertiranje datoteke u Base64
    function fileToBase64(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = error => reject(error);
        });
    }

    // Dual upload adapter - Base64 za preview, server upload na submit
    class PreviewUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file.then(file => {
                return fileToBase64(file).then(base64 => {
                    // Čuvamo originalnu datoteku za kasnije slanje na server
                    return {
                        default: base64,
                        file: file // Čuvamo file za submit
                    };
                });
            });
        }

        abort() {
            // Cleanup if needed
        }
    }

    function PreviewUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new PreviewUploadAdapter(loader);
        };
    }

    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold', 'italic', 'link',
                    '|',
                    'bulletedList', 'numberedList', 'blockQuote',
                    '|',
                    'insertTable',
                    'uploadImage', // Jednostavniji upload dugme
                    'mediaEmbed',
                    '|',
                    'undo', 'redo'
                ]
            },
            extraPlugins: [PreviewUploadAdapterPlugin], // Preview adapter
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraf',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Naslov 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Naslov 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Naslov 3',
                        class: 'ck-heading_heading3'
                    }
                ]
            },
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
            },
            image: {
                toolbar: [
                    'imageStyle:inline',
                    'imageStyle:block',
                    'imageStyle:side',
                    '|',
                    'toggleImageCaption',
                    'imageTextAlternative'
                ],
                // Onemogući file manager opciju
                insert: {
                    type: 'auto'
                }
            },
            // Dodatno onemogući CKFinder
            ckfinder: {
                // Ne uključuj CKFinder
                uploadUrl: null
            }
        })
        .then(editor => {
            editorInstance = editor;
        })
        .catch(error => {
            console.error(error);
        });

    // Funkcija za upload slika na server
    async function uploadImageToServer(base64Data) {
        // Konvertuj Base64 u File objekt
        const response = await fetch(base64Data);
        const blob = await response.blob();

        const formData = new FormData();
        formData.append('image', blob, 'image.jpg');

        const uploadResponse = await fetch('/cms/upload-image', {
            method: 'POST',
            body: formData
        });

        if (!uploadResponse.ok) {
            throw new Error('Upload failed');
        }

        const result = await uploadResponse.json();
        return result.url;
    }

    // Prije submitanja, upload-aj slike i zamijeni Base64 sa URL-ovima
    document.querySelector('#postForm').addEventListener('submit', async function(e) {
        e.preventDefault(); // Prekini normalni submit

        let content = editorInstance.getData();

        // Pronađi sve Base64 slike u sadržaju
        const base64Images = content.match(/src="data:image\/[^"]+"/g);

        if (base64Images) {
            try {
                // Upload svaku sliku
                for (let base64Img of base64Images) {
                    const base64Data = base64Img.replace('src="', '').replace('"', '');
                    const serverUrl = await uploadImageToServer(base64Data);

                    // Zamijeni Base64 sa server URL-om
                    content = content.replace(base64Data, serverUrl);
                }

                // Postavi finalni sadržaj
                document.querySelector('#editor').value = content;

                // Sada submitaj formu
                this.submit();

            } catch (error) {
                console.error('Error uploading images:', error);
                alert('Greška pri upload-u slika. Pokušajte ponovo.');
            }
        } else {
            // Nema slika, normalno submitaj
            document.querySelector('#editor').value = content;
            this.submit();
        }
    });
</script>
