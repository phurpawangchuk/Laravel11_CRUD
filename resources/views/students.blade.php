<div class="container mt-1">
    @if (count($students) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">Course Code</th>
                <th class="text-center">Course Name</th>
                <th class="text-center">Credits</th>
                <th class="text-center">Grade</th>
                <th class="text-center">Category</th>
                <th class="text-center">Repeat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td class="text-center">{{ $student->name }}</td>
                <td class="text-center">{{ $student->email }}</td>
                <td class="text-center">{{ $student->credits }}</td>
                <td class="text-center">{{ $student->grade }}</td>
                <td class="text-center">{{ $student->category }}</td>
                <td class="text-center">{{ $student->repeat ? 'Yes' : 'No' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">No students found.</div>
    @endif
</div>