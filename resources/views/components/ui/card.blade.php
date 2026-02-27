@props([
    'as' => 'div',
    'header' => null,
    'action' => null,
    'footer' => null,
    'content' => null,
])

@php
  $props = $attributes->class(['bg-white border rounded-xl border-base-200'])->merge([
      'class' => 'w-full overflow-scroll',
  ]);

  $props->header = $header?->attributes->class(['px-8 py-5 border-b bg-base-100 border-base-200 font-medium'])->merge([
      'class' => 'flex items-center gap-2 justify-start',
  ]);

  $props->action = $action?->attributes->class(['px-8 py-5 border-b border-base-200'])->merge([
      'class' => 'flex flex-col xl:flex-row xl:items-center gap-4 bg-base-100',
  ]);

  $props->footer = $footer?->attributes->class(['px-8 py-4 border-t border-base-200'])->merge([
      'class' => 'flex items-center gap-2 justify-start',
  ]);

  $props->content = $content?->attributes->merge();
@endphp

<{{ $as }} {{ $props }}>
  @isset($header)
    <div {{ $props->header }}>
      {{ $header }}
    </div>
  @endisset

  @isset($action)
    <div {{ $props->action }}>
      {{ $action }}
    </div>
  @endisset

  @isset($content)
    <div {{ $props->content }}>
      {{ $content }}
    </div>
  @else
    <div class="p-8">
      {{ $slot }}
    </div>
  @endisset

  @isset($footer)
    <div {{ $props->footer }}>
      {{ $footer }}
    </div>
  @endisset
  </{{ $as }}>
