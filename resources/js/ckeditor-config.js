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
