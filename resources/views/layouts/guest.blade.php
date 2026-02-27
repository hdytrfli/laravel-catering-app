<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head />

@php
  $names = ['John Doe', 'Jane Doe', 'Jane Doe'];
@endphp

<body class="font-sans antialiased">
  <div class="grid lg:grid-cols-2 xl:grid-cols-3">
    <div class="relative items-center hidden xl:col-span-2 lg:grid">
      <img src="{{ asset('images/auth.jpg') }}" alt="Backdrop" class="absolute inset-0 w-full h-screen object-cover">
      <div class="absolute inset-0 bg-gradient-to-t from-base-800 to-transparent opacity-70"></div>

      <div class="container relative flex flex-col w-full max-w-4xl gap-2 mx-auto text-white">
        <h1 class="text-6xl font-bold">{{ config('app.name', 'Laravel') }}</h1>
        <span class="text-lg">{{ config('app.tagline', 'Application tagline') }}</span>
        <p class="text-base-200">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore, voluptatem nemo? Amet expedita a
          voluptatibus quod fugiat quas culpa vel.
        </p>
        <div class="flex items-center gap-2">
          <x-avatar-list :names="$names" class="size-12 mr-8" />
          <div class="flex items-center">
            <i data-lucide="star" class="fill-amber-500 text-amber-500 size-6"></i>
            <i data-lucide="star" class="fill-amber-500 text-amber-500 size-6"></i>
            <i data-lucide="star" class="fill-amber-500 text-amber-500 size-6"></i>
          </div>
          <span class="font-medium text-white">
            4.9k Reviews
          </span>
        </div>
      </div>
    </div>

    <div class="relative grid items-center h-screen overflow-y-auto">
      <div class="absolute top-0 right-0 p-10">
        <x-ui.logo class="max-w-40" />
      </div>

      <div class="container grid max-w-lg gap-6">
        <x-ui.alert variant="info" status="{{ session('info') }}" />
        <x-ui.alert variant="success" status="{{ session('success') }}" />
        <x-ui.alert variant="warning" status="{{ session('warning') }}" />
        <x-ui.alert variant="error" status="{{ session('error') }}" />

        {{ $slot }}
      </div>
    </div>
  </div>
</body>

</html>
