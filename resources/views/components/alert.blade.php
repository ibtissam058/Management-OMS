@props(['type' => 'success'])
@php
  $map = [
    'success' => 'bg-emerald-50 text-emerald-800 ring-emerald-200 dark:bg-emerald-900/30 dark:text-emerald-200 dark:ring-emerald-800',
    'error'   => 'bg-rose-50 text-rose-800 ring-rose-200 dark:bg-rose-900/30 dark:text-rose-200 dark:ring-rose-800',
    'warning' => 'bg-amber-50 text-amber-800 ring-amber-200 dark:bg-amber-900/30 dark:text-amber-200 dark:ring-amber-800',
    'info'    => 'bg-sky-50 text-sky-800 ring-sky-200 dark:bg-sky-900/30 dark:text-sky-200 dark:ring-sky-800',
  ];
@endphp
<div {{ $attributes->merge(['class' => 'rounded-2xl ring-1 p-3 '.$map[$type]]) }}>
  <div class="text-sm">{{ $slot }}</div>
</div>
