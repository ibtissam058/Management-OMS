<section class="space-y-6">
    <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-lg mb-4">
        <div class="flex items-center gap-2 mb-2">
            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
            <h4 class="text-sm font-medium text-red-300">Attention</h4>
        </div>
        <p class="text-xs text-red-400/70">
            Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. 
            Avant de supprimer votre compte, veuillez télécharger toutes les données que vous souhaitez conserver.
        </p>
    </div>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="w-full px-4 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-900 flex items-center justify-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
        Supprimer le Compte
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-6 bg-gray-900">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-red-500/20 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-100">Êtes-vous sûr de vouloir supprimer votre compte?</h2>
                        <p class="text-sm text-gray-400">Cette action est irréversible</p>
                    </div>
                </div>

                <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-lg mb-6">
                    <p class="text-sm text-red-300">
                        Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. 
                        Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.
                    </p>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Mot de Passe</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-colors"
                        placeholder="Entrez votre mot de passe pour confirmer"
                        required
                    />
                    @error('password', 'userDeletion')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" 
                            x-on:click="$dispatch('close')"
                            class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-gray-300 font-medium rounded-lg transition-colors">
                        Annuler
                    </button>

                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                        Supprimer Définitivement
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
