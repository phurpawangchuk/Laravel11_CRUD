    <div class="mb-4">
        <x-input class="flex-d col-6" type="text" id="prompt" placeholder="Find all posts" name="prompt"
            wire:model="prompt" required />
        <x-button class="ml-2 mb-4" wire:click="submit">
            Find
        </x-button>

        <!-- Flash Message -->
        @if (session()->has('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h2 class="h5 fw-semibold">Customer</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Titile</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post['title'] ?? 'No Title' }}</td>
                            <td>{{ $post['description'] ?? 'No description' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>