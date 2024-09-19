<x-guest-layout>

    <div class="container my-5">
        <div>
            This is implemented using AWS services. The following services are used:
            RDS, CE2 and S3
        </div>
        <!-- Students Section -->
        <div class="mb-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="h5 fw-semibold">Posts</h2>
                </div>
                <div class="card-body">
                    @livewire('post-list')
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>