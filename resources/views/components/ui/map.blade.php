@props([
    'latitude' => 0,
    'longitude' => 0,
    'readonly' => true,
])

@php
  $id = uniqid();
  $props = $attributes
      ->class([
          'relative z-0 overflow-hidden',
          'placeholder:text-base-400',
          'border border-base-200 focus:ring-primary-500 focus:border-primary-500',
      ])
      ->merge([
          'class' => 'w-full rounded-lg',
      ]);
@endphp

<div {{ $props }}>
  <i data-lucide="map-pin" class="absolute top-2 left-2 text-base-400 size-5 z-50"></i>
  <div id="{{ $id }}" class="w-full h-full border-none"></div>
</div>

@push('scripts')
  @vite(['resources/js/leaflet.js'])
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const id = @js($id);
      const container = document.getElementById(id);

      const lat = @js($latitude);
      const lng = @js($longitude);
      const readonly = @js($readonly);

      const map = L.map(container, {
        zoom: 13,
        center: [lat, lng],
        zoomControl: false,
      });

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
      }).addTo(map);

      L.marker([lat, lng]).addTo(map);
    });
  </script>
@endpush
