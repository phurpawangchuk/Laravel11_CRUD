  <div class="mb-4">
      <div class="card">
          <div class="card-header">
              <h2 class="h5 fw-semibold">Products</h2>
          </div>
          <div class="card-body">
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Price</th>
                          <th>Description</th>
                          <th>Image</th>
                          <x-authenticated-content>
                              <th>Actions</th>
                          </x-authenticated-content>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse($products as $product)
                      <tr>
                          <td>{{ $product->name }}</td>
                          <td>${{ $product->price }}</td>
                          <td>{{ $product->description }}</td>
                          <td>
                              @if ($product->image)
                              <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail" width="100" />
                              @endif
                          </td>
                          <x-authenticated-content>
                              @can('update', $product)
                              <td>
                                  <button wire:click="edit({{ $product->id }})" class="btn btn-info">Edit</button>
                                  <button type="button" wire:click="delete({{ $product->id }})"
                                      class="btn btn-danger">Delete</button>
                              </td>
                              @endcan
                          </x-authenticated-content>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="5">No Products Found</td>
                      </tr>
                      @endforelse
                  </tbody>
              </table>
              {{ $products->links() }}
          </div>
      </div>
  </div>