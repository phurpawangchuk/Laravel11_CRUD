<x-dialog-modal wire:model="showAddModal">
    <x-slot name="title">
        {{ $updateMode ? __('Edit Student') : __('Add Student') }}
    </x-slot>

    <x-slot name="content">
        <div class="mb-3">
            <x-label for="name" value="Name" />
            <x-input id="name" type="text" class="form-control" placeholder="Enter student name" wire:model="name" />
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <x-label for="email" value="Email" />
            <x-input id="email" type="email" class="form-control" placeholder="Enter student email"
                wire:model="email" />
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <x-label for="course_id" value="Course" />
            <x-select id="course_id" name="course_id" wire:model="course_id" :options="$courses" :selected="$course_id"
                placeholder="Select a Course" class="form-control" />
            @error('course_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <x-label for="gender" value="Gender" />
            <div>
                <x-input type="radio" id="male" name="gender" value="M" wire:model.lazy="gender" />
                <label for="male">Male</label>

                <input type="radio" id="female" name="gender" value="F" wire:model.lazy="gender" />
                <label for="female">Female</label>
            </div>
            @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <x-label for="grade" class="form-label">Grade (Optional)</x-label>
            <x-input type="text" name="grade" class="form-control" wire:model.lazy="grade" id="grade" />
        </div>

        <div class="mb-3">
            <x-label for="category" class="form-label">Category</x-label>
            <x-input type="text" name="category" class="form-control" wire:model.lazy="category" id="category"
                required />
        </div>

        <div class="mb-3">
            <x-label for="credits" class="form-label">Credits</x-label>
            <x-input type="text" name="credits" class="form-control" wire:model.lazy="credits" id="credits" required />
        </div>

        <div class="mb-3">
            <x-label for="repeat" value="Repeat" />
            <x-select id="repeat" name="repeat" wire:model="repeat" :options="$repeatOptions" :selected="$repeat"
                placeholder="Select an option" class="form-control" />
            @error('repeat') <span class="text-danger">{{ $message }}</span> @enderror
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