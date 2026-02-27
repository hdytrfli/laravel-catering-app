@props([
    'latitude' => null,
    'longitude' => null,
])

<div x-data>
  <x-ui.button x-on:click="$dispatch('open-modal', 'map-preview')" type="button">
    {{ $slot }}
  </x-ui.button>
</div>

@once
  <x-modal name="map-preview">
    <x-ui.card>
      <x-slot:header>
        <i data-lucide="map-pin" class="size-5 text-primary-500"></i>
        <h5>Location</h5>
      </x-slot:header>

      <x-ui.map id="modal-map" class="aspect-square" latitude="{{ $latitude }}" longitude="{{ $longitude }}" />
    </x-ui.card>
  </x-modal>

  <script>
    window.addEventListener('open-modal', e => {
      if (e.detail !== 'map-preview') return;
      setTimeout(() => {
        const container = document.querySelector('#modal-map > div');
        if (container?._leaflet_map) container._leaflet_map.invalidateSize();
      }, 50);
    });
  </script>
@endonce
