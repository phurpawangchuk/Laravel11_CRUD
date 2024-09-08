  <x-dialog-modal wire:model="showAddModal">
      <x-slot name="title">
          {{ $updateMode ? __('Edit Product') : __('Add Product') }}
      </x-slot>

      <x-slot name="content">
          <div class="mb-3">
              <x-label for="name" value="Name" />
              <x-input id="name" type="text" class="form-control" placeholder="Enter product name" wire:model="name" />
              @error('name') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          <div class="mb-3">
              <x-label for="price" value="Price" />
              <x-input id="price" type="text" class="form-control" placeholder="Enter price" wire:model="price" />
              @error('price') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          <div class="mb-3">
              <x-label for="description" value="Description" />
              <x-textarea id="description" class="form-control" placeholder="Enter description"
                  wire:model="description"></x-textarea>
              @error('description') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          <div class="mb-3">
              <x-label for="image" value="Image" />
              <x-file-input id="image" wire:model="image" />
              @error('image') <span class="text-danger">{{ $message }}</span> @enderror

              @if(!$updateMode)
              @if ($image)
              <div class="mt-2">
                  <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" width="150" />
              </div>
              @endif
              @endif

              @if ($image instanceof \Livewire\TemporaryUploadedFile)
              <div class="mt-2">
                  <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" width="150" />
              </div>
              @endif

          </div>

          <div class="mb-3">
              <x-label for="state" value="State" />
              <x-select id="state" name="state" wire:model.change="selectedState" :options="$states"
                  :selected="$selectedState" placeholder="Select a state" class="form-control" />
              @error('state') <span class="text-danger">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
              <x-label for="city" value="City" />
              <x-select id="city" name="city" wire:model="selectedCity" :options="$cities" :selected="$selectedCity"
                  placeholder="Select a City" class="form-control" />
              @error('city') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
      </x-slot>

      <x-slot name="footer">
          <x-secondary-button wire:click="cancel">
              Cancel
          </x-secondary-button>

          @if($updateMode)
          <x-button class="ml-2" wire:click="update">
              Update
          </x-button>
          @else
          <x-button class="ml-2" wire:click="store">
              Save
          </x-button>
          @endif
      </x-slot>
  </x-dialog-modal>