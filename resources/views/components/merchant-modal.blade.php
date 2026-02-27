@once
  <div x-data="data" x-on:show-merchant.window="open($event.detail)">
    <x-modal name="merchant-detail">
      <x-ui.card>
        <x-slot:header>
          <img x-bind:src="merchant.avatar" class="size-8 rounded-full object-cover border border-base-200 shrink-0">
          <h5 x-text="merchant.company" class="truncate"></h5>
        </x-slot:header>

        <div class="grid-cols-2 form">
          <div class="field">
            <x-ui.label value="Company" />
            <x-ui.input readonly type="text" x-bind:value="merchant.company">
              <x-slot:left><i data-lucide="store" class="text-base-400 size-5"></i></x-slot:left>
            </x-ui.input>
          </div>
          <div class="field">
            <x-ui.label value="Category" />
            <x-ui.input readonly type="text" x-bind:value="merchant.category">
              <x-slot:left><i data-lucide="tag" class="text-base-400 size-5"></i></x-slot:left>
            </x-ui.input>
          </div>
          <div class="field">
            <x-ui.label value="Phone" />
            <x-ui.input readonly type="text" x-bind:value="merchant.phone">
              <x-slot:left><i data-lucide="phone" class="text-base-400 size-5"></i></x-slot:left>
            </x-ui.input>
          </div>
          <div class="field col-span-full">
            <x-ui.label value="Address" />
            <x-ui.input readonly type="text" x-bind:value="merchant.address">
              <x-slot:left><i data-lucide="map-pin" class="text-base-400 size-5"></i></x-slot:left>
            </x-ui.input>
          </div>
          <div class="field col-span-full">
            <x-ui.label value="Website" />
            <x-ui.input readonly type="text" x-bind:value="merchant.website">
              <x-slot:left><i data-lucide="globe" class="text-base-400 size-5"></i></x-slot:left>
            </x-ui.input>
          </div>
          <div class="field col-span-full">
            <x-ui.label value="Description" />
            <x-ui.textarea readonly rows="3" x-text="merchant.description"></x-ui.textarea>
          </div>
        </div>

        <x-slot:footer>
          <a x-bind:href="url">
            <x-ui.button>
              <i data-lucide="store" class="size-4"></i>
              <span>View Merchant</span>
            </x-ui.button>
          </a>
          <x-ui.button variant="outline" x-on:click="$dispatch('close-modal', 'merchant-detail')">
            Close
          </x-ui.button>
        </x-slot:footer>
      </x-ui.card>
    </x-modal>
  </div>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('data', () => ({
        merchant: {
          company: '',
          category: '',
          phone: '',
          distance: '',
          address: '',
          website: '',
          description: '',
          avatar: ''
        },
        url: '',

        open(merchant) {
          this.merchant = merchant;
          this.url = '{{ route('merchants.show', ':id') }}'.replace(':id', merchant.id);
          this.$dispatch('open-modal', 'merchant-detail');
        },
      }));
    });
  </script>
@endonce
