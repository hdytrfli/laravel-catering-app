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
      <form action="{{ route('merchants.index') }}" method="GET" class="flex items-center gap-2">
        <span class="text-sm text-base-500 whitespace-nowrap">Within</span>
        <x-ui.select name="distance" onchange="this.form.submit()" class="w-32">
          @foreach ([5, 10, 15, 20, 30, 50] as $km)
            <option value="{{ $km }}" @selected(request()->get('distance', 5) == $km)>{{ $km }} km</option>
          @endforeach
        </x-ui.select>
      </form>
    </x-slot:action>

    <x-slot:content>
      <div class="grid grid-cols-4 h-[60vh]">
        <div id="map" class="col-span-3 h-full z-0"></div>
        @if ($merchants->isNotEmpty())
          <div class="h-full overflow-y-auto flex flex-col gap-4 p-4 border-l border-base-200" id="merchant-cards">
            @foreach ($merchants as $merchant)
              <div id="card-{{ $merchant->id }}"
                class="merchant-card w-full border border-base-200 rounded-xl overflow-hidden cursor-pointer hover:border-primary-400 transition shrink-0">
                <img src="{{ asset('images/placeholder.jpg') }}" class="w-full h-28 object-cover">
                <div class="p-3 flex gap-2 items-start">
                  <x-ui.avatar name="{{ $merchant->company }}" alt="{{ $merchant->company }}" />
                  <div class="text-sm text-base-500 min-w-0">
                    <h3 class="font-medium truncate text-base-950">{{ $merchant->company }}</h3>
                    <div class="truncate">{{ $merchant->category }}</div>
                    <div>{{ number_format($merchant->distance, 2) }} km away</div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="h-full grid place-content-center border-l border-base-200">
            <div class="flex flex-col items-center gap-2 text-sm p-4 text-center">
              <i data-lucide="map-pin-off" class="text-primary-500 size-5"></i>
              <span class="text-base-500">No merchants found nearby</span>
            </div>
          </div>
        @endif

      </div>
    </x-slot:content>
  </x-ui.card>

  @push('scripts')
    @vite(['resources/js/leaflet.js'])

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const merchants = @json($merchants->values());
        const userLat = @json($userLat);
        const userLng = @json($userLng);
        const distanceKm = @json(request()->get('distance', 5));

        const map = L.map('map').setView([userLat, userLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.circleMarker([userLat, userLng], {
          radius: 8,
          fillColor: '#3b82f6',
          color: '#fff',
          weight: 2,
          fillOpacity: 1,
        }).addTo(map).bindTooltip('You are here');

        L.circle([userLat, userLng], {
          radius: distanceKm * 1000,
          color: '#3b82f6',
          fillColor: '#3b82f6',
          fillOpacity: 0.08,
          weight: 1.5,
          dashArray: '6 4',
        }).addTo(map);

        const group = L.markerClusterGroup({
          showCoverageOnHover: false,
          iconCreateFunction: cluster => {
            const count = cluster.getChildCount();
            const hue = (count * 37) % 360;
            const size = 48;
            return L.divIcon({
              html: `<div style="
                width:${size}px;height:${size}px;
                background:hsl(${hue},70%,70%);
                border-radius:9999px;
                display:flex;align-items:center;justify-content:center;
                font-weight:600;color:#111;border:2px solid white;
              ">${count}</div>`,
              className: '',
              iconSize: [size, size]
            });
          }
        });

        merchants.forEach(r => {
          const avatar = 'https://i.pravatar.cc/150?u=' + encodeURIComponent(r.company);
          const icon = L.divIcon({
            html: `<div style="width:48px;height:48px;border-radius:9999px;border:2px solid white;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.2)">
                     <img src="${avatar}" style="width:100%;height:100%;object-fit:cover">
                   </div>`,
            className: '',
            iconSize: [48, 48]
          });

          const marker = L.marker([r.latitude, r.longitude], {
            icon
          });

          marker.on('mouseover', () => marker.setZIndexOffset(1000));
          marker.on('mouseout', () => marker.setZIndexOffset(0));

          marker.on('click', () => {
            map.flyTo([r.latitude, r.longitude], 15, {
              duration: 0.6
            });
            highlightCard(r.id);
          });

          group.addLayer(marker);

          const card = document.getElementById(`card-${r.id}`);
          if (card) {
            card.addEventListener('click', () => {
              map.flyTo([r.latitude, r.longitude], 15, {
                duration: 0.6
              });
              highlightCard(r.id);
            });
          }
        });

        map.addLayer(group);

        function highlightCard(id) {
          document.querySelectorAll('.merchant-card').forEach(c => c.classList.remove('border-primary-500'));
          const target = document.getElementById(`card-${id}`);
          if (target) {
            target.classList.add('border-primary-500');
            target.scrollIntoView({
              behavior: 'smooth',
              block: 'nearest'
            });
          }
        }
      });
    </script>
  @endpush
</x-dashboard-layout>
