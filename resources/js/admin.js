
document.addEventListener('DOMContentLoaded', () => {
    // Mobile sidebar
    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.getElementById('admin-overlay');
    const toggle = () => {
        sidebar.classList.toggle('hidden');
        sidebar.classList.toggle('flex');
        overlay.classList.toggle('hidden');
    };
    document.getElementById('admin-menu')?.addEventListener('click', toggle);
    overlay?.addEventListener('click', toggle);

    // Confirm destructive actions
    document.querySelectorAll('form[data-confirm]').forEach((form) => {
        form.addEventListener('submit', (e) => {
            if (!confirm(form.dataset.confirm)) e.preventDefault();
        });
    });

    // Image previews for file inputs
    document.querySelectorAll('input[type="file"][data-preview]').forEach((input) => {
        const target = document.getElementById(input.dataset.preview);
        input.addEventListener('change', () => {
            if (!target) return;
            target.innerHTML = '';
            [...input.files].forEach((file) => {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = 'size-20 rounded-lg object-cover border border-slate-200';
                target.appendChild(img);
            });
        });
    });
});
