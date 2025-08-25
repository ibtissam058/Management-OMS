@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Profile Header --}}
    <div class="mb-8">
      <div class="flex items-center gap-6">
        <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg">
          <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
        </div>
        <div>
          <h1 class="text-3xl font-bold text-gray-100">Profil Utilisateur</h1>
          <p class="text-gray-400 mt-1">Gérez vos informations personnelles et paramètres de sécurité</p>
        </div>
      </div>
    </div>

    {{-- Profile Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      {{-- Main Profile Section --}}
      <div class="lg:col-span-2 space-y-6">
        {{-- Profile Information --}}
        <div class="card p-6">
          <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <div>
              <h2 class="text-lg font-semibold text-gray-100">Informations Personnelles</h2>
              <p class="text-sm text-gray-400">Mettez à jour vos informations de profil</p>
            </div>
          </div>
          @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Password Section --}}
        <div class="card p-6">
          <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-amber-500/20 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
              </svg>
            </div>
            <div>
              <h2 class="text-lg font-semibold text-gray-100">Sécurité du Compte</h2>
              <p class="text-sm text-gray-400">Modifiez votre mot de passe</p>
            </div>
          </div>
          @include('profile.partials.update-password-form')
        </div>
      </div>

      {{-- Sidebar --}}
      <div class="space-y-6">
        {{-- Account Stats --}}
        <div class="card p-6">
          <h3 class="text-lg font-semibold text-gray-100 mb-4">Statistiques du Compte</h3>
          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                <span class="text-sm text-gray-300">Compte créé</span>
              </div>
              <span class="text-sm font-medium text-gray-100">{{ auth()->user()->created_at->format('M Y') }}</span>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                <span class="text-sm text-gray-300">Dernière connexion</span>
              </div>
              <span class="text-sm font-medium text-gray-100">Aujourd'hui</span>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <div class="w-2 h-2 bg-amber-500 rounded-full"></div>
                <span class="text-sm text-gray-300">Statut</span>
              </div>
              <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                <div class="w-1.5 h-1.5 bg-emerald-400 rounded-full mr-1.5"></div>
                Actif
              </span>
            </div>
          </div>
        </div>

        {{-- Quick Actions --}}
        <div class="card p-6">
          <h3 class="text-lg font-semibold text-gray-100 mb-4">Actions Rapides</h3>
          <div class="space-y-3">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 bg-blue-500/10 hover:bg-blue-500/20 border border-blue-500/20 rounded-lg transition-colors group">
              <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v3H8V5z"></path>
                </svg>
              </div>
              <div>
                <div class="text-sm font-medium text-blue-300">Tableau de Bord</div>
                <div class="text-xs text-blue-400/70">Retour à l'accueil</div>
              </div>
            </a>

            <a href="{{ route('workorders.index') }}" class="flex items-center gap-3 p-3 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20 rounded-lg transition-colors group">
              <div class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
              </div>
              <div>
                <div class="text-sm font-medium text-emerald-300">Mes Ordres</div>
                <div class="text-xs text-emerald-400/70">Voir mes tâches</div>
              </div>
            </a>
          </div>
        </div>

        {{-- Danger Zone --}}
        <div class="card p-6 border-red-500/20">
          <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
              </svg>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-red-300">Zone de Danger</h3>
              <p class="text-sm text-red-400/70">Actions irréversibles</p>
            </div>
          </div>
          @include('profile.partials.delete-user-form')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
