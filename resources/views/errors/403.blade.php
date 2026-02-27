<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head />

<body class="relative font-sans antialiased">
  <div class="absolute top-0 right-0 w-full px-6 py-5">
    <x-ui.logo class="max-w-40" />
  </div>

  <div class="container grid h-screen max-w-7xl place-items-center">
    <div class="flex flex-col justify-center gap-6 text-center">
      <h1 class="text-6xl font-bold truncate text-zinc-900">
        {{ $exception->getMessage() }}
      </h1>

      <p class="text-zinc-600 text-wrap max-w-3xl">
        You don't have permission to access this page or perform this action. Please contact your administrator if you
        believe this is an error. You may return to the previous page or go to another section.
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
