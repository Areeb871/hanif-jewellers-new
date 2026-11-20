<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<style>
    .ck-editor__editable_inline[dir="rtl"] {
        direction: rtl;
        text-align: right;
    }
</style>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#uae_description'))
        .then(editor => {
            editor.editing.view.change(writer => {
                writer.setAttribute('dir', 'rtl', editor.editing.view.document.getRoot());
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
