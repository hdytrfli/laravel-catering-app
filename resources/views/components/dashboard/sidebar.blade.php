@php
  use App\Enums\RoleType;

  $props = $attributes
      ->class([
          'border-r border-base-200',
          'fixed top-0 left-0 z-40 h-screen',
          'transition-transform -translate-x-full bg-white md:translate-x-0',
      ])
      ->merge([
          'id' => 'sidebar',
          'class' => 'w-full',
          'aria-label' => 'Sidenav',
      ]);

  $merchant = array_to_object([
      [
          'id' => 'menus',
          'label' => 'Menu Management',
          'menus' => [
              [
                  'type' => 'link',
                  'href' => route('menus.index'),
                  'active' => request()->routeIs('menus.*') && !request()->routeIs('menus.create'),
                  'name' => 'Menu List',
                  'icon' => 'cooking-pot',
              ],
              [
                  'type' => 'link',
                  'href' => route('menus.create'),
                  'active' => request()->routeIs('menus.create'),
                  'name' => 'Create New Menu',
                  'icon' => 'plus',
              ],
          ],
      ],
      [
          'id' => 'orders',
          'label' => 'Order Management',
          'menus' => [
              [
                  'type' => 'link',
                  'href' => route('dashboard'),
                  'active' => request()->routeIs('orders.*'),
                  'name' => 'Order Listing',
                  'icon' => 'shopping-cart',
              ],
              [
                  'type' => 'link',
                  'href' => route('dashboard'),
                  'active' => request()->routeIs('invoices.*'),
                  'name' => 'Order Invoices',
                  'icon' => 'landmark',
              ],
              [
                  'type' => 'link',
                  'href' => route('dashboard'),
                  'active' => request()->routeIs('reports.*'),
                  'name' => 'Order Reports',
                  'icon' => 'archive',
              ],
          ],
      ],
  ]);

  $customer = array_to_object([
      [
          'id' => 'orders',
          'label' => 'Order Management',
          'menus' => [
              [
                  'type' => 'link',
                  'href' => route('merchants.index'),
                  'active' => request()->routeIs('merchants.*'),
                  'name' => 'Create Order',
                  'icon' => 'plus',
              ],
              [
                  'type' => 'link',
                  'href' => route('dashboard'),
                  'active' => request()->routeIs('invoices.*'),
                  'name' => 'Order Invoices',
                  'icon' => 'landmark',
              ],
              [
                  'type' => 'link',
                  'href' => route('dashboard'),
                  'active' => request()->routeIs('reports.*'),
                  'name' => 'Order Reports',
                  'icon' => 'archive',
              ],
          ],
      ],
  ]);

  $user = Auth::user();
  $navigations = match ($user->role) {
      RoleType::MERCHANT => $merchant,
      RoleType::CUSTOMER => $customer,
      default => $merchant,
  };
@endphp

<aside {{ $props }}>
  <div class="flex flex-col h-full gap-6 overflow-y-auto">
    <div class="sticky top-0 z-10 bg-white border-b border-base-200">
      <a href="{{ route('dashboard') }}" class="flex items-center h-20 px-6">
        <x-ui.logo class="max-w-40" />
      </a>
    </div>

    @foreach ($navigations as $navigation)
      <div class="grid gap-2">
        <h3 class="px-6 text-sm font-medium text-base-400">{{ $navigation->label }}</h3>
        <ul>
          @foreach ($navigation->menus as $menu)
            <li class="relative text-sm font-medium">
              @if ($menu->active)
                <div class="absolute top-0 right-0 w-1 h-full bg-primary-500"></div>
              @endif

              @isset($menu->show)
                @continue(!$menu->show)
              @endisset

              @isset($menu->count)
                <div class="absolute text-center transform -translate-y-1/2 right-6 top-1/2">
                  <div class="rounded-md text-primary-500 size-5 bg-primary-100">{{ $menu->count }}</div>
                </div>
              @endisset

              <a href="{{ $menu->href }}"
                class="flex items-center gap-3 p-3 px-6 hover:bg-primary-50 @if ($menu->active) bg-primary-50 @endif">
                <i data-lucide="{{ $menu->icon }}" class="size-5 text-primary-500"></i>
                <span>{{ $menu->name }}</span>
              </a>
            </li>
          @endforeach
        </ul>
      </div>
    @endforeach
  </div>

  <div class="absolute bottom-0 left-0 z-20 w-full bg-white border-t border-base-200">
    <div class="items-center hidden h-16 gap-2 px-6 item-center lg:flex">
      <a href="{{ route('config.settings') }}">
        <x-ui.button size="icon" variant="ghost" tooltip="Settings page" class="rounded-full size-8">
          <i data-lucide="settings" class="size-5"></i>
        </x-ui.button>
      </a>

      <a href="{{ route('config.help') }}">
        <x-ui.button size="icon" variant="ghost" tooltip="Help page" class="rounded-full size-8">
          <i data-lucide="help-circle" class="size-5"></i>
        </x-ui.button>
      </a>
    </div>
  </div>
</aside>
