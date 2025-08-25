@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="mb-6">
  <h1 class="text-2xl font-bold mb-2 text-gray-100">Tableau de Bord</h1>
  <p class="text-gray-400">Surveillance des opérations de maintenance en temps réel</p>
</div>

{{-- Enhanced KPI cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
  <div class="card p-6 hover:scale-105 transition-transform duration-200">
    <div class="flex items-center justify-between">
      <div>
        <div class="text-xs text-gray-400 uppercase tracking-wider">Backlog WO</div>
        <div class="mt-2 text-3xl font-bold text-gray-100">{{ $openWorkOrders ?? '1' }}</div>
      </div>
    </div>
  </div>

  <div class="card p-6 hover:scale-105 transition-transform duration-200">
    <div class="flex items-center justify-between">
      <div>
        <div class="text-xs text-gray-400 uppercase tracking-wider">MTTR moyen (min)</div>
        <div class="mt-2 text-3xl font-bold text-gray-100">{{ $avgMTTR ?? '42' }}</div>
      </div>
    </div>
  </div>

  <div class="card p-6 hover:scale-105 transition-transform duration-200">
    <div class="flex items-center justify-between">
      <div>
        <div class="text-xs text-gray-400 uppercase tracking-wider">SLA respecté</div>
        <div class="mt-2 text-3xl font-bold text-gray-100">{{ $slaCompliance ?? '92' }}<span class="text-lg">%</span></div>
      </div>
    </div>
  </div>

  <div class="card p-6 hover:scale-105 transition-transform duration-200">
    <div class="flex items-center justify-between">
      <div>
        <div class="text-xs text-gray-400 uppercase tracking-wider">Alertes stock</div>
        <div class="mt-2 text-3xl font-bold text-red-400">{{ $stockAlerts ?? '2' }}</div>
      </div>
    </div>
  </div>
</div>

{{-- Charts Section --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
  {{-- Work Order Status Distribution --}}
  <div class="card p-6">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-semibold text-gray-100">Répartition des WO par statut</h3>
      <span class="text-xs text-gray-400 bg-gray-700 px-2 py-1 rounded">Démo</span>
    </div>
    <div class="h-48 flex items-end justify-center">
      <div class="w-full max-w-xs">
        <div class="flex items-end justify-center h-32 gap-4">
          <div class="bg-emerald-500 rounded-t-lg" style="width: 60px; height: 80px;"></div>
        </div>
        <div class="text-center mt-4 text-sm text-gray-400">planned</div>
      </div>
    </div>
  </div>

  {{-- MTTR Trend --}}
  <div class="card p-6">
    <h3 class="text-lg font-semibold mb-4 text-gray-100">MTTR (tendance)</h3>
    <div class="h-48 relative">
      <svg class="w-full h-full" viewBox="0 0 300 150">
        <defs>
          <linearGradient id="mttrGradient" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" style="stop-color:#10b981;stop-opacity:0.3" />
            <stop offset="100%" style="stop-color:#10b981;stop-opacity:0" />
          </linearGradient>
        </defs>
        <!-- Grid lines -->
        <g stroke="#374151" stroke-width="0.5" opacity="0.3">
          <line x1="0" y1="30" x2="300" y2="30"/>
          <line x1="0" y1="60" x2="300" y2="60"/>
          <line x1="0" y1="90" x2="300" y2="90"/>
          <line x1="0" y1="120" x2="300" y2="120"/>
        </g>
        <!-- MTTR Line -->
        <path d="M20,100 Q80,80 120,70 T200,60 T280,50" 
              stroke="#10b981" 
              stroke-width="3" 
              fill="none"/>
        <!-- Fill area -->
        <path d="M20,100 Q80,80 120,70 T200,60 T280,50 L280,150 L20,150 Z" 
              fill="url(#mttrGradient)"/>
        <!-- Data points -->
        <circle cx="120" cy="70" r="3" fill="#10b981"/>
        <circle cx="200" cy="60" r="3" fill="#10b981"/>
        <circle cx="280" cy="50" r="3" fill="#10b981"/>
      </svg>
      <div class="absolute bottom-0 left-0 text-xs text-gray-500">8/25/2025</div>
    </div>
  </div>

  {{-- Stock Distribution --}}
  <div class="card p-6">
    <h3 class="text-lg font-semibold mb-4 text-gray-100">Stock par pièce</h3>
    <div class="h-48 flex items-center justify-center">
      <div class="relative w-32 h-32">
        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
          <!-- Background circle -->
          <circle cx="50" cy="50" r="40" stroke="#374151" stroke-width="8" fill="none" opacity="0.3"/>
          <!-- Green section (60%) -->
          <circle cx="50" cy="50" r="40" stroke="#22c55e" stroke-width="8" fill="none"
                  stroke-dasharray="150.8 251.2" stroke-dashoffset="0"/>
          <!-- Red section (30%) -->
          <circle cx="50" cy="50" r="40" stroke="#ef4444" stroke-width="8" fill="none"
                  stroke-dasharray="75.4 326.6" stroke-dashoffset="-150.8"/>
          <!-- Yellow section (10%) -->
          <circle cx="50" cy="50" r="40" stroke="#eab308" stroke-width="8" fill="none"
                  stroke-dasharray="25.1 376.9" stroke-dashoffset="-226.2"/>
        </svg>
      </div>
    </div>
  </div>
</div>

{{-- Enhanced Work Orders Section --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
  {{-- Recent Work Orders Table --}}
  <div class="xl:col-span-2 card p-6">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h3 class="text-lg font-semibold text-gray-100">Ordres de Travail Récents</h3>
        <p class="text-sm text-gray-400 mt-1">Dernières activités de maintenance</p>
      </div>
      <div class="flex gap-3">
        <button class="px-3 py-1.5 text-xs bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors">
          <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
          </svg>
          Filtrer
        </button>
        <a href="{{ route('workorders.index') }}" class="btn-primary">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
          </svg>
          Voir Tout
        </a>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="border-b border-gray-700">
            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">ID</th>
            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Équipement</th>
            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Description</th>
            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Priorité</th>
            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Statut</th>
            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Créé</th>
            <th class="text-left py-3 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-800">
          @forelse(($recentWorkOrders ?? []) as $wo)
            <tr class="hover:bg-gray-800/30 transition-colors group">
              <td class="py-4 px-4">
                <div class="flex items-center">
                  <div class="w-2 h-2 bg-emerald-500 rounded-full mr-3"></div>
                  <span class="font-mono text-sm text-gray-300">#{{ str_pad($wo->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
              </td>
              <td class="py-4 px-4">
                <div class="flex items-center">
                  <div class="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                    </svg>
                  </div>
                  <div>
                    <div class="font-medium text-gray-100">{{ $wo->equipment->name ?? 'Non assigné' }}</div>
                    <div class="text-xs text-gray-500">{{ $wo->equipment->type ?? 'Type inconnu' }}</div>
                  </div>
                </div>
              </td>
              <td class="py-4 px-4">
                <div class="max-w-xs">
                  <p class="text-sm text-gray-300 truncate">{{ $wo->description ?? 'Aucune description' }}</p>
                  <p class="text-xs text-gray-500 mt-1">Technicien: {{ $wo->technician->name ?? 'Non assigné' }}</p>
                </div>
              </td>
              <td class="py-4 px-4">
                @php
                  $priorityColors = [
                    'High' => 'bg-red-500/20 text-red-300 border-red-500/30',
                    'Medium' => 'bg-amber-500/20 text-amber-300 border-amber-500/30',
                    'Low' => 'bg-green-500/20 text-green-300 border-green-500/30'
                  ];
                  $priority = $wo->priority ?? 'Low';
                @endphp
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $priorityColors[$priority] ?? $priorityColors['Low'] }}">
                  <div class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $priority === 'High' ? 'bg-red-400' : ($priority === 'Medium' ? 'bg-amber-400' : 'bg-green-400') }}"></div>
                  {{ $priority }}
                </span>
              </td>
              <td class="py-4 px-4">
                @php
                  $statusColors = [
                    'Open' => 'bg-blue-500/20 text-blue-300 border-blue-500/30',
                    'In Progress' => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30',
                    'Completed' => 'bg-green-500/20 text-green-300 border-green-500/30',
                    'Cancelled' => 'bg-gray-500/20 text-gray-300 border-gray-500/30'
                  ];
                  $status = $wo->status ?? 'Open';
                @endphp
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $statusColors[$status] ?? $statusColors['Open'] }}">
                  {{ $status }}
                </span>
              </td>
              <td class="py-4 px-4 text-sm text-gray-400">
                <div>{{ optional($wo->created_at)->format('d/m/Y') ?: '—' }}</div>
                <div class="text-xs text-gray-500">{{ optional($wo->created_at)->format('H:i') ?: '' }}</div>
              </td>
              <td class="py-4 px-4">
                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                  <button class="p-1.5 text-gray-400 hover:text-emerald-400 hover:bg-emerald-500/10 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                  </button>
                  <button class="p-1.5 text-gray-400 hover:text-blue-400 hover:bg-blue-500/10 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td class="py-12 px-4" colspan="7">
                <div class="text-center">
                  <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                  </div>
                  <h4 class="text-lg font-medium text-gray-300 mb-2">Aucun ordre de travail</h4>
                  <p class="text-gray-500 mb-4">Créez votre premier ordre de travail pour commencer</p>
                  <a href="{{ route('workorders.create') }}" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Créer un Ordre
                  </a>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Quick Actions Sidebar --}}
  <div class="space-y-6">
    {{-- Quick Stats --}}
    <div class="card p-6">
      <h4 class="text-lg font-semibold text-gray-100 mb-4">Statistiques Rapides</h4>
      <div class="space-y-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
            <span class="text-sm text-gray-300">Haute priorité</span>
          </div>
          <span class="text-sm font-semibold text-gray-100">{{ $highPriorityCount ?? '3' }}</span>
        </div>
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
            <span class="text-sm text-gray-300">En cours</span>
          </div>
          <span class="text-sm font-semibold text-gray-100">{{ $inProgressCount ?? '5' }}</span>
        </div>
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="w-2 h-2 bg-amber-500 rounded-full"></div>
            <span class="text-sm text-gray-300">En attente</span>
          </div>
          <span class="text-sm font-semibold text-gray-100">{{ $pendingCount ?? '2' }}</span>
        </div>
      </div>
    </div>

    {{-- Quick Actions --}}
    <div class="card p-6">
      <h4 class="text-lg font-semibold text-gray-100 mb-4">Actions Rapides</h4>
      <div class="space-y-3">
        <a href="{{ route('workorders.create') }}" class="flex items-center gap-3 p-3 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20 rounded-lg transition-colors group">
          <div class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
          </div>
          <div>
            <div class="text-sm font-medium text-emerald-300">Nouvel Ordre</div>
            <div class="text-xs text-emerald-400/70">Créer un ordre de travail</div>
          </div>
        </a>

        <a href="{{ route('equipment.index') }}" class="flex items-center gap-3 p-3 bg-blue-500/10 hover:bg-blue-500/20 border border-blue-500/20 rounded-lg transition-colors group">
          <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
            </svg>
          </div>
          <div>
            <div class="text-sm font-medium text-blue-300">Équipements</div>
            <div class="text-xs text-blue-400/70">Gérer les équipements</div>
          </div>
        </a>

        <a href="{{ route('reports') }}" class="flex items-center gap-3 p-3 bg-purple-500/10 hover:bg-purple-500/20 border border-purple-500/20 rounded-lg transition-colors group">
          <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
          </div>
          <div>
            <div class="text-sm font-medium text-purple-300">Rapports</div>
            <div class="text-xs text-purple-400/70">Voir les analyses</div>
          </div>
        </a>
      </div>
    </div>

    {{-- Recent Activity --}}
    <div class="card p-6">
      <h4 class="text-lg font-semibold text-gray-100 mb-4">Activité Récente</h4>
      <div class="space-y-3">
        <div class="flex items-start gap-3">
          <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2"></div>
          <div>
            <p class="text-sm text-gray-300">Ordre #0123 complété</p>
            <p class="text-xs text-gray-500">Il y a 2 heures</p>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
          <div>
            <p class="text-sm text-gray-300">Nouvel équipement ajouté</p>
            <p class="text-xs text-gray-500">Il y a 4 heures</p>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <div class="w-2 h-2 bg-amber-500 rounded-full mt-2"></div>
          <div>
            <p class="text-sm text-gray-300">Stock faible détecté</p>
            <p class="text-xs text-gray-500">Il y a 6 heures</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

