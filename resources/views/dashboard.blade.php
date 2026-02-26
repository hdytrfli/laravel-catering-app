<x-dashboard-layout>
  <x-dashboard.heading>
    <x-slot:title>Dashboard</x-slot:title>
    <x-slot:description>Welcome to the dashboard</x-slot:description>
  </x-dashboard.heading>

  <x-ui.card>
    <x-slot:header>
      <i data-lucide="activity" class="size-5 text-primary-500"></i>
      <h5>Recent Activities</h5>
    </x-slot:header>

    <div class="grid w-full aspect-banner place-content-center">
      <div class="flex items-center gap-2 text-sm">
        <i data-lucide="activity" class="text-primary-500 size-5"></i>
        <span class="text-base-500">No recent activities</span>
      </div>
    </div>
  </x-ui.card>
</x-dashboard-layout>
