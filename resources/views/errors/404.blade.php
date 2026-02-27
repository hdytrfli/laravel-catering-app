<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head />

<body class="relative font-sans antialiased">
  <div class="absolute top-0 right-0 w-full px-6 py-5">
    <x-ui.logo class="max-w-40" />
  </div>

  <div class="container grid h-screen max-w-7xl place-items-center">
    <div class="flex flex-col justify-center gap-6 text-center">
      <h1 class="text-6xl font-bold mx-auto max-w-2xl text-zinc-900">
        Page Not Found.
      </h1>

      <p class="text-zinc-600 text-wrap max-w-3xl">
        The page you are looking for could not be found. It may have been removed, had its name changed, or is
        temporarily unavailable. Please check the URL for errors or try navigating to a different page.
      </p>

      <div class="flex justify-center gap-4">
        <a href="{{ url()->previous() }}">
          <x-ui.button variant="secondary">
            <i data-lucide="arrow-left" class="size-4"></i>
            <span>Back</span>
          </x-ui.button>
        </a>

        <a href="{{ route('dashboard') }}">
          <x-ui.button>
            <i data-lucide="box" class="size-4"></i>
            <span>Dashboard</span>
          </x-ui.button>
        </a>
      </div>
    </div>
  </div>
</body>

</html>
