export function initCKEditor(elementId, options = {}) {
    const defaultConfig = {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'mediaEmbed', '|', 'undo', 'redo'],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
            ]
        },
        mediaEmbed: {
            previewsInData: true,
            providers: [
                {
                    name: 'youtube',
                    url: /^(?:(?:https?:)?\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/.+$/,
                    html: match => {
                        const url = match[0];
                        const videoId = url.match(/[\?&]v=([^&]+)/)?.[1] || url.match(/youtu\.be\/([^?]+)/)?.[1];
                        return videoId ? 
                            '<div class="video-embed"><iframe width="560" height="315" src="https://www.youtube.com/embed/' + videoId + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>' : 
                            null;
                    }
                },
                {
                    name: 'vimeo',
                    url: /^(?:(?:https?:)?\/\/)?(?:www\.)?(?:vimeo\.com)\/.+$/,
                    html: match => {
                        const url = match[0];
                        const videoId = url.match(/vimeo\.com\/([^?&]+)/)?.[1];
                        return videoId ? 
                            '<div class="video-embed"><iframe src="https://player.vimeo.com/video/' + videoId + '" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div>' : 
                            null;
                    }
                }
            ]
        }
    };

    // Merge user options with default config
    const editorConfig = { ...defaultConfig, ...options };

    return ClassicEditor
        .create(document.querySelector(elementId), editorConfig)
        .then(editor => {
            // Set custom height if provided
            if (options.height) {
                editor.editing.view.change(writer => {
                    writer.setStyle(
                        'height',
                        options.height,
                        editor.editing.view.document.getRoot()
                    );
                });
            }
            return editor;
        })
        .catch(error => {
            console.error(error);
        });
}
