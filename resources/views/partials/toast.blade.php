<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const notyf = new Notyf({
        duration: 4000,
        position: { x: 'right', y: 'top' },
        dismissible: true,
    });

    window.showToast = function (type, message) {
        if (!message) return;
        if (type === 'success') {
            notyf.success(message);
        } else {
            notyf.error(message);
        }
    };

    @if (session('success'))
        notyf.success(@json(session('success')));
    @endif

    @if (session('error'))
        notyf.error(@json(session('error')));
    @endif
});
</script>
