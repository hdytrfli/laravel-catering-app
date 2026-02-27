@php
  $user = Auth::user();
  $profile = $user->merchant;
@endphp

<x-dashboard-layout>
  <x-dashboard.heading>
    <x-slot:title>Merchant Information</x-slot:title>
    <x-slot:description>Update merchant details</x-slot:description>
  </x-dashboard.heading>

  <x-ui.card as="form" method="post" action="{{ route('role.update') }}">
    <x-slot:header>
      <h5>Role Information</h5>
    </x-slot:header>

    @csrf
    @method('PATCH')

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 form">
      <div class="field">
        <x-ui.label for="company" value="Company" />
        <x-ui.input type="text" name="company" value="{{ old('company', $profile->company) }}" required autofocus>
          <x-slot:left>
            <i data-lucide="briefcase" class="text-base-400 size-5"></i>
          </x-slot:left>
        </x-ui.input>
        <x-ui.errors :messages="$errors->get('company')" />
      </div>

      <div class="field">
        <x-ui.label for="website" value="Website" />
        <x-ui.input type="text" name="website" value="{{ old('website', $profile->website) }}" required>
          <x-slot:left>
            <i data-lucide="globe" class="text-base-400 size-5"></i>
          </x-slot:left>
        </x-ui.input>
        <x-ui.errors :messages="$errors->get('website')" />
      </div>

      <div class="field col-span-full">
        <x-ui.label for="description" value="Description" />
        <x-ui.textarea name="description" rows="3"
          required>{{ old('description', $profile->description) }}</x-ui.textarea>
        <x-ui.errors :messages="$errors->get('description')" />
      </div>

      <div class="field">
        <x-ui.label for="category" value="Category" />
        <x-ui.select id="category" name="category" required>
          <option value="">Select category</option>
          @foreach ($categories as $category)
            <option value="{{ $category->value }}" @selected(old('category', $profile->category?->value) == $category->value)>
              {{ $category->label() }}
            </option>
          @endforeach
        </x-ui.select>
        <x-ui.errors :messages="$errors->get('category')" />
      </div>
      
      <div class="field">
        <x-ui.label for="phone" value="Phone" />
        <x-ui.input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" required>
          <x-slot:left>
            <i data-lucide="phone" class="text-base-400 size-5"></i>
          </x-slot:left>
        </x-ui.input>
        <x-ui.errors :messages="$errors->get('phone')" />
      </div>

      <div class="field col-span-full">
        <x-ui.label for="address" value="Address" />
        <x-ui.textarea name="address" rows="3" required>{{ old('address', $profile->address) }}</x-ui.textarea>
        <x-ui.errors :messages="$errors->get('address')" />
      </div>

      <div class="field col-span-full">
        <x-ui.label for="location" value="Location" />
        <x-ui.map class="aspect-banner" latitude="{{ old('latitude', $profile->latitude) }}"
          longitude="{{ old('longitude', $profile->longitude) }}" />
        <x-ui.errors :messages="$errors->get('latitude')" />
        <x-ui.errors :messages="$errors->get('longitude')" />
      </div>
    </div>

    <x-slot:footer class="justify-end">
      <a href="{{ route('profile.show') }}">
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
