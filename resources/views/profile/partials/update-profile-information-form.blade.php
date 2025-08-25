<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nom Complet</label>
                <input id="name" name="name" type="text" 
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors" 
                       value="{{ old('name', $user->name) }}" 
                       required autofocus autocomplete="name" 
                       placeholder="Votre nom complet">
                @error('name')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Adresse Email</label>
                <input id="email" name="email" type="email" 
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors" 
                       value="{{ old('email', $user->email) }}" 
                       required autocomplete="username" 
                       placeholder="votre@email.com">
                @error('email')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-3 p-3 bg-amber-500/10 border border-amber-500/20 rounded-lg">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <p class="text-sm text-amber-300">Votre adresse email n'est pas vérifiée.</p>
                        </div>
                        <button form="send-verification" 
                                class="mt-2 text-sm text-amber-400 hover:text-amber-300 underline transition-colors">
                            Cliquez ici pour renvoyer l'email de vérification
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm text-emerald-400">
                                Un nouveau lien de vérification a été envoyé à votre adresse email.
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center justify-between pt-4">
            <div class="flex items-center gap-4">
                <button type="submit" 
                        class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Sauvegarder
                </button>

                @if (session('status') === 'profile-updated')
                    <div x-data="{ show: true }" 
                         x-show="show" 
                         x-transition 
                         x-init="setTimeout(() => show = false, 3000)"
                         class="flex items-center gap-2 text-emerald-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-sm font-medium">Profil mis à jour avec succès!</span>
                    </div>
                @endif
            </div>
        </div>
    </form>
</section>
