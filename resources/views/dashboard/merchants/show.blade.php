<x-dashboard-layout>
  <x-dashboard.heading>
    <x-slot:title>{{ $merchant->company }}</x-slot:title>
    <x-slot:description>{{ $merchant->description }}</x-slot:description>
  </x-dashboard.heading>

  <x-ui.card>
    <x-slot:header>
      <i data-lucide="store" class="size-5 text-primary-500"></i>
      <h5>Merchant Details</h5>
    </x-slot:header>

    <div class="grid-cols-2 form">
      <div class="field">
        <x-ui.label value="Category" />
        <x-ui.input readonly type="text" value="{{ $merchant->category->label() }}">
          <x-slot:left><i data-lucide="tag" class="text-base-400 size-5"></i></x-slot:left>
        </x-ui.input>
      </div>

      <div class="field">
        <x-ui.label value="Distance" />
        <x-ui.input readonly type="text" value="{{ number_format($merchant->distance, 2) }} km away">
          <x-slot:left><i data-lucide="navigation" class="text-base-400 size-5"></i></x-slot:left>
        </x-ui.input>
      </div>

      <div class="field">
        <x-ui.label value="Phone" />
        <x-ui.input readonly type="text" value="{{ $merchant->phone }}">
          <x-slot:left><i data-lucide="phone" class="text-base-400 size-5"></i></x-slot:left>
        </x-ui.input>
      </div>

      <div class="field">
        <x-ui.label value="Website" />
        <x-ui.input readonly type="text" value="{{ $merchant->website }}">
          <x-slot:left><i data-lucide="globe" class="text-base-400 size-5"></i></x-slot:left>
        </x-ui.input>
      </div>

      <div class="field col-span-full">
        <x-ui.label value="Address" />
        <x-ui.textarea readonly rows="2">{{ $merchant->address }}</x-ui.textarea>
      </div>
    </div>

    <x-slot:footer class="justify-end flex items-center">
      <a href="{{ route('merchants.index') }}">
        <x-ui.button variant="outline" type="button">
          <span>Back</span>
        </x-ui.button>
      </a>

      <x-map-modal latitude="{{ $merchant->latitude }}" longitude="{{ $merchant->longitude }}">

        <i data-lucide="map" class="size-4"></i>
        <span>View Map</span>
      </x-map-modal>
    </x-slot:footer>
  </x-ui.card>

  <x-ui.card>
    <x-slot:header>
      <i data-lucide="utensils" class="size-5 text-primary-500"></i>
      <h5>Menus</h5>
    </x-slot:header>

    <div class="grid grid-cols-2 gap-6 md:grid-cols-3">
      @forelse ($merchant->menus as $menu)
        <div class="border border-base-200 rounded-xl overflow-hidden">
          <img src="{{ asset('images/placeholder.jpg') }}" class="aspect-thumbnail object-cover">

          <div class="p-3 flex flex-col gap-1">
            <h3 class="font-semibold truncate">{{ $menu->name }}</h3>
            <p class="text-sm text-base-500 line-clamp-2">{{ $menu->description }}</p>
            <span class="text-primary-500"><x-ui.currency amount="{{ $menu->price }}" /></span>
          </div>
        </div>
      @empty
        <div class="grid h-40 col-span-full place-items-center text-base-400">
          <div class="flex items-center gap-2">
            <i data-lucide="utensils" class="size-5"></i>
            <span>No menus available</span>
          </div>
        </div>
      @endforelse
    </div>
  </x-ui.card>
</x-dashboard-layout>
