<div class="container mt-0">
    @if (count($users) == 0)
    <div class="alert alert-info">No users found.</div>
    @else
    <table class="table table-light table-hover w-100">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>@formatDate($user->created_at)</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>