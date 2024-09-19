  <div class="mb-4">
      <div class="card">
          <div class="card-header">
              <h2 class="h5 fw-semibold">Posts</h2>
          </div>
          <div class="card-body">
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Image</th>
                          <th>Author</th>
                          <x-authenticated-content>
                              <th>Actions</th>
                          </x-authenticated-content>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse($posts as $post)
                      <tr>
                          <td>{{ $post->title }}</td>
                          <td>{{ $post->description }}</td>
                          <td>
                              @if ($post->image)
                              <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail" width="100" />
                             
                              @endif
                          </td>
                            <td>{{ $post->user->name }}</td>
                          <x-authenticated-content>
                              @can('update', $post)
                              <td>
                                  <button wire:click="edit({{ $post->id }})" class="btn btn-info">Edit</button>
                                  <button type="button" wire:click="delete({{ $post->id }})"
                                      class="btn btn-danger">Delete</button>
                              </td>
                              @endcan
                          </x-authenticated-content>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="5">No posts Found</td>
                      </tr>
                      @endforelse
                  </tbody>
              </table>
            @if($posts)
                {{ $posts->links() }}
            @endif
          </div>
      </div>
  </div>