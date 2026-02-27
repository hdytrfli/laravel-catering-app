<x-dashboard-layout>
  <x-dashboard.heading>
    <x-slot:title>Menus List</x-slot:title>
    <x-slot:description>Manage list of menus in {{ config('app.name', 'Laravel') }}</x-slot:description>
  </x-dashboard.heading>

  <x-ui.table>
    <x-slot:title>
      <i data-lucide="book-open" class="size-5 text-primary-500"></i>
      <h4>Menus Table</h4>
    </x-slot:title>

    <x-slot:action class="justify-between">
      <form action="{{ route('menus.index') }}" method="GET" class="flex flex-col gap-2 xl:flex-row xl:items-center">
        <x-ui.input name="search" value="{{ request()->get('search') }}" placeholder="Search by name or description">
          <x-slot:left>
            <i data-lucide="search" class="text-base-500 size-5"></i>
          </x-slot:left>
        </x-ui.input>
      </form>

      <div class="flex items-center gap-2">
        @if (request()->has('search'))
          <a href="{{ route('menus.index') }}">
            <x-ui.button variant="outline">
              <i data-lucide="x" class="size-5"></i>
              <span>Reset</span>
            </x-ui.button>
          </a>
        @endif

        @can('create', App\Models\Menu::class)
          <a href="{{ route('menus.create') }}">
            <x-ui.button>
              <i data-lucide="plus" class="size-5"></i>
              <span>Menu</span>
            </x-ui.button>
          </a>
        @endcan
      </div>
    </x-slot:action>

    <x-slot:head>
      <th>No</th>
      <th>Menu</th>
      <th>Calories</th>
      <th>Carbs</th>
      <th>Protein</th>
      <th>Fat</th>
      <th>Price</th>
      <th>Actions</th>
    </x-slot:head>

    <x-slot:body>
      @forelse ($menus as $menu)
        <tr>
          <td class="w-10">{{ $menus->firstItem() + $loop->index }}</td>
          <td>{{ $menu->name }}</td>
          <td>{{ $menu->calories }}</td>
          <td>{{ $menu->carbs }}</td>
          <td>{{ $menu->protein }}</td>
          <td>{{ $menu->fat }}</td>
          <td><x-ui.currency amount="{{ $menu->price }}" /></td>
          <td>
            <div class="flex items-center gap-4">
              @can('update', $menu)
                <a href="{{ route('menus.edit', $menu) }}" class="text-primary-500">
                  Edit
                </a>
              @endcan
              @can('delete', $menu)
                <x-delete id="{{ $menu->id }}" title="{{ $menu->name }}"
                  route="{{ route('menus.destroy', $menu) }}" />
              @endcan
            </div>
          </td>
        </tr>
      @empty
        <x-ui.empty colspan="4" />
      @endforelse
    </x-slot:body>
  </x-ui.table>

  {{ $menus->links() }}
</x-dashboard-layout>
