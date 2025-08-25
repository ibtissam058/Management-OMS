<!DOCTYPE html>
<html lang="en" class="h-full antialiased dark" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Management OSM')</title>

    {{-- Figtree (Laravel default) --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="h-full text-gray-100" style="background-color: rgb(15, 15, 15);">
<div class="min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="hidden lg:flex lg:w-64 lg:flex-col lg:gap-4 lg:py-6 lg:px-4 border-r border-gray-800" style="background-color: rgb(25, 25, 25);">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-2">
            <span class="inline-flex size-9 items-center justify-center rounded-xl bg-indigo-600 text-white font-semibold">OSM</span>
            <div class="text-sm">
                <div class="font-semibold">OCP Maintenance Solutions</div>
                <div class="text-gray-500 dark:text-gray-400 text-xs">Management Console</div>
            </div>
        </a>

        <nav class="mt-6 space-y-1 text-sm">
            <a href="{{ route('dashboard') }}" class="nav-link">@svg('heroicon-o-home','size-5') <span>Dashboard</span></a>
            <a href="{{ route('equipment.index') }}" class="nav-link">@svg('heroicon-o-cpu-chip','size-5') <span>Equipment</span></a>
            <a href="{{ route('workorders.index') }}" class="nav-link">@svg('heroicon-o-clipboard-document-list','size-5') <span>Work Orders</span></a>
            <a href="{{ route('technicians.index') }}" class="nav-link">@svg('heroicon-o-users','size-5') <span>Technicians</span></a>
            <a href="{{ route('inventory.index') }}" class="nav-link">@svg('heroicon-o-archive-box','size-5') <span>Spare Parts</span></a>
            <a href="{{ route('reports') }}" class="nav-link">@svg('heroicon-o-chart-bar','size-5') <span>Reports</span></a>
        </nav>
    </aside>

    {{-- Mobile sidebar overlay --}}
    <div x-show="sidebarOpen" class="fixed inset-0 z-40 bg-black/40 lg:hidden" x-on:click="sidebarOpen=false"></div>

    {{-- Mobile sidebar drawer --}}
    <aside x-show="sidebarOpen" x-transition
           class="fixed z-50 inset-y-0 left-0 w-72 border-r border-gray-800 p-4 lg:hidden" style="background-color: rgb(25, 25, 25);">
        <div class="flex items-center justify-between">
            <span class="font-semibold">Menu</span>
            <button class="icon-btn" x-on:click="sidebarOpen=false" aria-label="Close menu">✕</button>
        </div>
        <nav class="mt-4 space-y-1 text-sm">
            <a href="{{ route('dashboard') }}" class="nav-link"><span>Dashboard</span></a>
            <a href="{{ route('equipment.index') }}" class="nav-link"><span>Equipment</span></a>
            <a href="{{ route('workorders.index') }}" class="nav-link"><span>Work Orders</span></a>
            <a href="{{ route('technicians.index') }}" class="nav-link"><span>Technicians</span></a>
            <a href="{{ route('inventory.index') }}" class="nav-link"><span>Spare Parts</span></a>
            <a href="{{ route('reports') }}" class="nav-link"><span>Reports</span></a>
        </nav>
    </aside>

    {{-- Main --}}
    <div class="flex-1 flex flex-col">

        {{-- Topbar --}}
        <header class="sticky top-0 z-30 backdrop-blur border-b border-gray-800" style="background-color: rgba(15, 15, 15, 0.8);">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button class="icon-btn lg:hidden" x-on:click="sidebarOpen=true" aria-label="Open menu">☰</button>
                    <h1 class="text-sm sm:text-base font-semibold leading-none">@yield('title','')</h1>
                </div>

                <div class="flex items-center gap-3">
                    {{-- User Dropdown --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-800 transition-colors group">
                            <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="hidden sm:block text-left">
                                <div class="text-sm font-medium text-gray-100">{{ Auth::user()->name ?? 'Guest' }}</div>
                                <div class="text-xs text-gray-400">{{ Auth::user()->email ?? '' }}</div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform group-hover:text-gray-300" 
                                 :class="{ 'rotate-180': open }" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             @click.away="open = false"
                             class="absolute right-0 mt-2 w-64 rounded-xl shadow-lg border border-gray-700 py-2 z-50" style="background-color: rgb(25, 25, 25);">
                            
                            {{-- User Info Header --}}
                            <div class="px-4 py-3 border-b border-gray-700">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-100">{{ Auth::user()->name ?? 'Guest' }}</div>
                                        <div class="text-sm text-gray-400">{{ Auth::user()->email ?? '' }}</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Menu Items --}}
                            <div class="py-2">
                                <a href="{{ route('profile.edit') }}" 
                                   class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 transition-colors">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>Profil</span>
                                </a>
                                
                                <a href="{{ route('dashboard') }}" 
                                   class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 transition-colors">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v3H8V5z"></path>
                                    </svg>
                                    <span>Tableau de Bord</span>
                                </a>

                                <a href="{{ route('workorders.index') }}" 
                                   class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 transition-colors">
                                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    <span>Mes Ordres</span>
                                </a>

                                <div class="border-t border-gray-700 my-2"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center gap-3 w-full px-4 py-2 text-sm text-red-400 hover:bg-red-900/20 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span>Déconnexion</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- Page container --}}
        <main class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
            {{-- Flash messages --}}
            @if (session('success'))
                <x-alert type="success" class="mb-4">{{ session('success') }}</x-alert>
            @endif
            @if (session('error'))
                <x-alert type="error" class="mb-4">{{ session('error') }}</x-alert>
            @endif

            @yield('content')
        </main>

        <footer class="mt-auto border-t border-gray-800 py-3 text-xs text-gray-400 text-center">
            © {{ date('Y') }} OCP Maintenance System
        </footer>
    </div>
</div>

@stack('scripts')
</body>
</html>
