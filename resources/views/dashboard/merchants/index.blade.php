<x-dashboard-layout>
  <x-dashboard.heading>
    <x-slot:title>Find Merchants</x-slot:title>
    <x-slot:description>Find merchants near you in {{ config('app.name', 'Laravel') }}</x-slot:description>
  </x-dashboard.heading>

  <x-ui.card>
    <x-slot:header>
      <i data-lucide="map-pin" class="size-5 text-primary-500"></i>
      <h5>Merchants Map</h5>
    </x-slot:header>

    <x-slot:action>
      <form action="{{ route('merchants.index') }}" method="GET" class="w-full max-w-sm">
        <x-ui.select name="distance" onchange="this.form.submit()" class="w-full">
          @foreach ([5, 10, 15, 20, 30, 50] as $distance)
            <option value="{{ $distance }}" @selected(request()->get('distance', 5) == $distance)>
              Search in radius {{ $distance }} km
            </option>
          @endforeach
        </x-ui.select>
      </form>
    </x-slot:action>

    <x-slot:content>
      <div id="map" class="w-full aspect-banner z-0"></div>
    </x-slot:content>
  </x-ui.card>

  <x-merchant-modal />

  @push('scripts')
    @vite(['resources/js/leaflet.js'])

    <script>
      function clusterIcon(n) {
        const size = 48;
        const div = document.createElement('div');

        div.style.cssText = 'width:' + size + 'px;height:' + size + 'px;' +
          'background:hsl(' + (n * 37 % 360) + ',70%,70%);' +
          'border-radius:9999px;display:flex;align-items:center;' +
          'justify-content:center;font-weight:600;color:#111;border:2px solid white;';
        div.textContent = n;

        return L.divIcon({
          html: div.outerHTML,
          className: '',
          iconSize: [size, size]
        });
      }

      function markerIcon(src) {
        const wrap = document.createElement('div');
        const img = document.createElement('img');

        wrap.style.cssText = 'width:48px;height:48px;border-radius:9999px;' +
          'border:2px solid white;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.2)';
        img.src = src;
        img.style.cssText = 'width:100%;height:100%;object-fit:cover';

        wrap.appendChild(img);

        return L.divIcon({
          html: wrap.outerHTML,
          className: '',
          iconSize: [48, 48]
        });
      }

      document.addEventListener('DOMContentLoaded', function() {
        const data = @json($merchants->values());
        const latitude = @json($latitude);
        const longitude = @json($longitude);
        const radius = @json(request()->get('distance', 5));

        const map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.circleMarker([latitude, longitude], {
          radius: 8,
          fillColor: '#3b82f6',
          color: '#fff',
          weight: 2,
          fillOpacity: 1,
        }).addTo(map).bindTooltip('You are here');

        L.circle([latitude, longitude], {
          radius: radius * 1000,
          color: '#3b82f6',
          fillColor: '#3b82f6',
          fillOpacity: 0.08,
          weight: 1.5,
          dashArray: '6 4',
        }).addTo(map);

        const cluster = L.markerClusterGroup({
          showCoverageOnHover: false,
          iconCreateFunction: c => clusterIcon(c.getChildCount()),
        });

        data.forEach(merchant => {
          const marker = L.marker([merchant.latitude, merchant.longitude], {
            icon: markerIcon(merchant.avatar)
          });

          marker.on('mouseover', () => marker.setZIndexOffset(1000));
          marker.on('mouseout', () => marker.setZIndexOffset(0));

          marker.on('click', e => {
            L.DomEvent.stopPropagation(e);
            map.flyTo([merchant.latitude, merchant.longitude], 15, {
              duration: 0.6
            });
            window.dispatchEvent(new CustomEvent('show-merchant', {
              detail: merchant
            }));
          });

          cluster.addLayer(marker);
        });

        map.addLayer(cluster);
      });
    </script>
  @endpush
</x-dashboard-layout>
