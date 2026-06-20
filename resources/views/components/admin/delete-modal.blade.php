@props([
    'title' => 'Xác nhận xóa',
    'message' => 'Bạn có chắc chắn muốn xóa mục này không? Hành động này không thể hoàn tác.',
])

<div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/60 px-4">
    <div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl ring-1 ring-slate-100">
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-rose-50 text-rose-600">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86l-8.12 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.83-3.14l-8.12-14a2 2 0 0 0-3.42 0Z" />
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-slate-900">{{ $title }}</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">{{ $message }}</p>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-3">
            <button type="button" id="delete-cancel" class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Hủy</button>
            <button type="button" id="delete-confirm" class="rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-rose-700">Xóa</button>
        </div>
    </div>
</div>

<script>
    (() => {
        const modal = document.getElementById('delete-modal');
        const confirmButton = document.getElementById('delete-confirm');
        const cancelButton = document.getElementById('delete-cancel');
        const deleteForms = document.querySelectorAll('[data-delete-form]');
        let pendingForm = null;

        if (!modal || !confirmButton || !cancelButton || deleteForms.length === 0) {
            return;
        }

        const openModal = (form) => {
            pendingForm = form;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            confirmButton.focus();
        };

        const closeModal = () => {
            pendingForm = null;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        };

        deleteForms.forEach((form) => {
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                openModal(form);
            });
        });

        confirmButton.addEventListener('click', () => {
            if (pendingForm) {
                pendingForm.submit();
            }
        });

        cancelButton.addEventListener('click', closeModal);

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    })();
</script>