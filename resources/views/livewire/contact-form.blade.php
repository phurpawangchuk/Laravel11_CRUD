<div class="container">
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="mb-3">
            <x-label for="name" class="form-x-label">Name</x-label>
            <x-input type="text" id="name" class="form-control" wire:model="name" />
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <x-label for="email" class="form-x-label">Email</x-label>
            <x-input type="email" id="email" class="form-control" wire:model="email" />
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <x-label for="message" class="form-x-label">Message</x-label>
            <textarea id="message" class="form-control" wire:model="message"></textarea>
            @error('message') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</div>