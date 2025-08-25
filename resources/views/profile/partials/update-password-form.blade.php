<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-6">
            <div>
                <label for="update_password_current_password" class="block text-sm font-medium text-gray-300 mb-2">Mot de Passe Actuel</label>
                <input id="update_password_current_password" name="current_password" type="password" 
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors" 
                       autocomplete="current-password" 
                       placeholder="Entrez votre mot de passe actuel">
                @error('current_password', 'updatePassword')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="update_password_password" class="block text-sm font-medium text-gray-300 mb-2">Nouveau Mot de Passe</label>
                    <input id="update_password_password" name="password" type="password" 
                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors" 
                           autocomplete="new-password" 
                           placeholder="Nouveau mot de passe">
                    @error('password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirmer le Mot de Passe</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors" 
                           autocomplete="new-password" 
                           placeholder="Confirmez le mot de passe">
                    @error('password_confirmation', 'updatePassword')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Password Requirements --}}
        <div class="p-4 bg-blue-500/10 border border-blue-500/20 rounded-lg">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h4 class="text-sm font-medium text-blue-300">Exigences du Mot de Passe</h4>
            </div>
            <ul class="text-xs text-blue-400/70 space-y-1">
                <li>• Au moins 8 caractères</li>
                <li>• Mélange de lettres majuscules et minuscules</li>
                <li>• Au moins un chiffre</li>
                <li>• Au moins un caractère spécial</li>
            </ul>
        </div>

        <div class="flex items-center justify-between pt-4">
            <div class="flex items-center gap-4">
                <button type="submit" 
                        class="px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Mettre à Jour
                </button>

                @if (session('status') === 'password-updated')
                    <div x-data="{ show: true }" 
                         x-show="show" 
                         x-transition 
                         x-init="setTimeout(() => show = false, 3000)"
                         class="flex items-center gap-2 text-emerald-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-sm font-medium">Mot de passe mis à jour avec succès!</span>
                    </div>
                @endif
            </div>
        </div>
    </form>
</section>
