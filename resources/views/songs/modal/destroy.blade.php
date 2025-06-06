<div id="delete-modal-{{ $song->id }}" tabindex="-1" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4 overflow-y-auto">
    <div class="relative bg-white rounded-lg shadow dark:bg-zinc-800 w-full max-w-md">
        <div class="p-6">
            <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Tem certeza que deseja excluir?</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Essa ação é irreversível e removerá permanentemente a letra.</p>
        </div>
        <div class="flex justify-end p-4 border-t border-gray-200 dark:border-gray-700 gap-2">
            <button data-modal-hide="delete-modal-{{ $song->id }}" type="button"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600">
                Cancelar
            </button>
            <form method="POST" action="{{ route('songs.destroy', $song) }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600">
                    Confirmar
                </button>
            </form>
        </div>
    </div>
</div>
