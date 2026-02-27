@php
  use App\Enums\RoleType;

  $user = Auth::user();
  $role = $user->role;
  $profile = match ($role) {
      RoleType::MERCHANT => $user->merchant,
      RoleType::CUSTOMER => $user->customer,
  };
@endphp

<x-dashboard-layout>
  <x-dashboard.heading>
    <x-slot:title>Profile</x-slot:title>
    <x-slot:description>Account's profile information and email address.</x-slot:description>
  </x-dashboard.heading>

  <div class="grid items-start gap-6">
    <x-ui.card>
      <x-slot:header>
        <h5>Profile Information</h5>
      </x-slot:header>

      <div class="grid-cols-2 form">
        <div class="field">
          <x-ui.label for="name" value="Name" />
          <x-ui.input readonly name="name" type="text" value="{{ $user->name }}">
            <x-slot:left>
              <i data-lucide="user" class="text-base-400 size-5"></i>
            </x-slot:left>
          </x-ui.input>
        </div>

        <div class="field">
          <x-ui.label for="role" value="Role" />
          <x-ui.input readonly name="role" type="text" value="{{ $user->role->label() }}">
            <x-slot:left>
              <i data-lucide="key" class="text-base-400 size-5"></i>
            </x-slot:left>
          </x-ui.input>
        </div>

        <div class="field col-span-full">
          <x-ui.label for="email" value="Email" />
          <x-ui.input readonly name="email" type="email" value="{{ $user->email }}">
            <x-slot:left>
              <i data-lucide="mail" class="text-base-400 size-5"></i>
            </x-slot:left>
          </x-ui.input>
        </div>

        <div class="field">
          <x-ui.label for="created_at" value="Created At" />
          <x-ui.input readonly name="created_at" type="date" value="{{ $user->created_at->format('Y-m-d') }}">
            <x-slot:left>
              <i data-lucide="calendar" class="text-base-400 size-5"></i>
            </x-slot:left>
          </x-ui.input>
        </div>

        <div class="field">
          <x-ui.label for="updated_at" value="Updated At" />
          <x-ui.input readonly name="updated_at" type="date" value="{{ $user->updated_at->format('Y-m-d') }}">
            <x-slot:left>
              <i data-lucide="calendar" class="text-base-400 size-5"></i>
            </x-slot:left>
          </x-ui.input>
        </div>
      </div>

      <x-slot:footer class="justify-end">
        <a href="{{ route('profile.edit') }}">
          <x-ui.button>
            <span>Edit Profile</span>
            <i data-lucide="arrow-up-right" class="size-5"></i>
          </x-ui.button>
        </a>
      </x-slot:footer>
    </x-ui.card>

    <x-ui.card>
      <x-slot:header>
        <h5>{{ $role->label() }} Information</h5>
      </x-slot:header>

      <div class="grid grid-cols-1 gap-4 md:grid-cols-2 form">
        @if ($role === RoleType::MERCHANT)
          <div class="field">
            <x-ui.label for="company" value="Company" />
            <x-ui.input readonly type="text" value="{{ $profile->company }}">
              <x-slot:left>
                <i data-lucide="briefcase" class="text-base-400 size-5"></i>
              </x-slot:left>
            </x-ui.input>
          </div>

          <div class="field">
            <x-ui.label for="website" value="Website" />
            <x-ui.input readonly type="text" value="{{ $profile->website }}">
              <x-slot:left>
                <i data-lucide="globe" class="text-base-400 size-5"></i>
              </x-slot:left>
            </x-ui.input>
          </div>

          <div class="field col-span-full">
            <x-ui.label for="description" value="Description" />
            <x-ui.textarea readonly rows="3">{{ $profile->description }}</x-ui.textarea>
          </div>

          <div class="field">
            <x-ui.label for="category" value="Category" />
            <x-ui.input readonly type="text" value="{{ $profile->category->label() }}">
              <x-slot:left>
                <i data-lucide="tag" class="text-base-400 size-5"></i>
              </x-slot:left>
            </x-ui.input>
          </div>
        @endif

        <div class="field">
          <x-ui.label for="phone" value="Phone" />
          <x-ui.input readonly type="text" value="{{ $profile->phone }}">
            <x-slot:left>
              <i data-lucide="phone" class="text-base-400 size-5"></i>
            </x-slot:left>
          </x-ui.input>
        </div>

        <div class="field col-span-full">
          <x-ui.label for="address" value="Address" />
          <x-ui.textarea readonly rows="3">{{ $profile->address }}</x-ui.textarea>
        </div>

        <div class="field col-span-full">
          <x-ui.label for="location" value="Location" />
          <x-ui.map class="aspect-banner" latitude="{{ $profile->latitude }}" longitude="{{ $profile->longitude }}" />
        </div>
      </div>

      <x-slot:footer class="justify-end">
        <a href="{{ route('role.edit') }}">
          <x-ui.button>
            <span>Edit Details</span>
            <i data-lucide="arrow-up-right" class="size-5"></i>
          </x-ui.button>
        </a>
      </x-slot:footer>
    </x-ui.card>
  </div>

</x-dashboard-layout>
