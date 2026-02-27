<x-dashboard-layout>
  <x-dashboard.heading>
    <x-slot:title>Edit Menu</x-slot:title>
    <x-slot:description>Update menu information in {{ config('app.name', 'Laravel') }}</x-slot:description>
  </x-dashboard.heading>

  <x-ui.card as="form" method="post" action="{{ route('menus.update', $menu) }}">
    <x-slot:header>
      <i data-lucide="book-open" class="size-5 text-primary-500"></i>
      <h5>Menu Information</h5>
    </x-slot:header>

    @csrf
    @method('PUT')
    @include('dashboard.menus.form', [
        'menu' => $menu,
    ])

    <x-slot:footer class="justify-end">
      <a href="{{ route('menus.index') }}">
        <x-ui.button variant="outline" type="button">
          <span>Cancel</span>
        </x-ui.button>
      </a>

      <x-ui.button>
        <span>Update</span>
        <i data-lucide="arrow-up-right" class="size-5"></i>
      </x-ui.button>
    </x-slot:footer>
  </x-ui.card>
</x-dashboard-layout>
