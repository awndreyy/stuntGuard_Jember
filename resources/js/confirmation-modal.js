const dialog = document.getElementById('confirmationModal');

if (dialog) {
    const title = dialog.querySelector('#confirmationTitle');
    const message = dialog.querySelector('#confirmationMessage');
    const accept = dialog.querySelector('[data-confirm-accept]');
    const cancel = dialog.querySelector('[data-confirm-cancel]');
    const approved = new WeakSet();
    const submitted = new WeakSet();
    let pending = null;
    let trigger = null;

    document.addEventListener('submit', (event) => {
        const form = event.target;
        if (!(form instanceof HTMLFormElement) || !form.matches('[data-confirm]')) return;

        if (submitted.has(form)) {
            event.preventDefault();
            return;
        }

        if (approved.delete(form)) {
            submitted.add(form);
            form.querySelectorAll('button[type="submit"]').forEach(button => {
                button.disabled = true;
            });
            return;
        }

        event.preventDefault();
        if (dialog.open) return;

        const logout = form.dataset.confirm === 'logout';
        const kind = form.dataset.confirmKind || 'data';
        const name = form.dataset.confirmName;
        title.textContent = logout ? 'Keluar dari akun?' : 'Hapus data?';
        message.textContent = logout
            ? 'Anda akan keluar dari akun StunGuard. Silakan masuk kembali untuk mengakses halaman admin.'
            : `Yakin ingin menghapus ${kind}${name ? ` “${name}”` : ''}? Data yang dihapus tidak dapat dikembalikan.`;
        accept.textContent = logout ? 'Ya, Keluar' : 'Ya, Hapus';
        accept.disabled = false;
        dialog.querySelectorAll('[data-confirm-icon]').forEach(icon => {
            icon.classList.toggle('hidden', icon.dataset.confirmIcon !== (logout ? 'logout' : 'delete'));
        });

        pending = { form, submitter: event.submitter };
        trigger = event.submitter || document.activeElement;
        dialog.showModal();
        cancel.focus();
    });

    cancel.addEventListener('click', () => dialog.close());

    dialog.addEventListener('click', (event) => {
        if (event.target !== dialog) return;
        const bounds = dialog.getBoundingClientRect();
        if (event.clientX < bounds.left || event.clientX > bounds.right
            || event.clientY < bounds.top || event.clientY > bounds.bottom) {
            dialog.close();
        }
    });

    dialog.addEventListener('close', () => {
        pending = null;
        trigger?.focus();
        trigger = null;
    });

    accept.addEventListener('click', () => {
        if (!pending || accept.disabled) return;
        const { form, submitter } = pending;
        pending = null;
        accept.disabled = true;
        approved.add(form);
        dialog.close();
        if (submitter?.form === form) {
            form.requestSubmit(submitter);
        } else {
            form.requestSubmit();
        }
        approved.delete(form);
    });
}
