<div class="xl:grid-cols-2 form">

  <div class="field">
    <x-ui.label for="name" value="Menu Name" />
    <x-ui.input id="name" name="name" type="text" value="{{ old('name', $menu->name) }}" required autofocus
      placeholder="Enter menu name" />
    <x-ui.errors :messages="$errors->get('name')" />
  </div>

  <div class="field">
    <x-ui.label for="price" value="Price" />
    <x-ui.input id="price" name="price" type="number" value="{{ old('price', $menu->price) }}" required
      placeholder="Enter price">
      <x-slot:left>
        <span class="text-sm text-base-500">Rp</span>
      </x-slot:left>
    </x-ui.input>
    <x-ui.errors :messages="$errors->get('price')" />
  </div>

  <div class="field col-span-full">
    <x-ui.label for="description" value="Description" />
    <x-ui.textarea id="description" name="description" rows="3"
      placeholder="Enter description">{{ old('description', $menu->description) }}</x-ui.textarea>
    <x-ui.errors :messages="$errors->get('description')" />
  </div>

  <div class="form grid-cols-1 md:grid-cols-2 xl:grid-cols-4 col-span-full">
    <div class="field">
      <x-ui.label for="calories" value="Calories" />
      <x-ui.input id="calories" name="calories" type="number" value="{{ old('calories', $menu->calories) }}" required
        placeholder="Enter calories">
        <x-slot:left>
          <i data-lucide="zap" class="text-base-500 size-5"></i>
        </x-slot:left>
      </x-ui.input>
      <x-ui.errors :messages="$errors->get('calories')" />
    </div>

    <div class="field">
      <x-ui.label for="carbs" value="Carbs (g)" />
      <x-ui.input id="carbs" name="carbs" type="number" value="{{ old('carbs', $menu->carbs) }}" required
        placeholder="Enter carbs">
        <x-slot:left>
          <i data-lucide="wheat" class="text-base-500 size-5"></i>
        </x-slot:left>
      </x-ui.input>
      <x-ui.errors :messages="$errors->get('carbs')" />
    </div>

    <div class="field">
      <x-ui.label for="protein" value="Protein (g)" />
      <x-ui.input id="protein" name="protein" type="number" value="{{ old('protein', $menu->protein) }}" required
        placeholder="Enter protein">
        <x-slot:left>
          <i data-lucide="beef" class="text-base-500 size-5"></i>
        </x-slot:left>
      </x-ui.input>
      <x-ui.errors :messages="$errors->get('protein')" />
    </div>

    <div class="field">
      <x-ui.label for="fat" value="Fat (g)" />
      <x-ui.input id="fat" name="fat" type="number" value="{{ old('fat', $menu->fat) }}" required
        placeholder="Enter fat">
        <x-slot:left>
          <i data-lucide="droplet" class="text-base-500 size-5"></i>
        </x-slot:left>
      </x-ui.input>
      <x-ui.errors :messages="$errors->get('fat')" />
    </div>
  </div>
</div>
