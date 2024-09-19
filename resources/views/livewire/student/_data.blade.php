  <div class="mb-4">
      <div class="card">
          <div class="card-header">
              <h2 class="h5 fw-semibold">Student</h2>
          </div>
          <div class="card-body">
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Credit</th>
                          <th>Course</th>
                          <th>Grade</th>
                          <x-authenticated-content>
                              <th>Actions</th>
                          </x-authenticated-content>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse($students as $student)
                      <tr>
                          <td>{{ $student->name }}</td>
                          <td>{{ $student->email }}</td>
                          <td>{{ $student->credits }}</td>
                          <td>{{ $student->course->name}}</td>
                          <td>{{ $student->grade}}</td>
                          <x-authenticated-content>
                              @can('update', $student)
                              <td>
                                  <button wire:click="edit({{ $student->id }})" class="btn btn-info">Edit</button>
                                  <button type="button" wire:click="delete({{ $student->id }})"
                                      class="btn btn-danger">Delete</button>
                              </td>
                              @endcan
                          </x-authenticated-content>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="5">No Students Found</td>
                      </tr>
                      @endforelse
                  </tbody>
              </table>
              {{ $students->links() }}
          </div>
      </div>
  </div>