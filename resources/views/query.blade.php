<!-- resources/views/query.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Customer Query</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <form id="queryForm">
        <label for="prompt">Enter your query:</label>
        <input type="text" id="prompt" name="prompt" required>
        <button type="submit">Submit</button>
    </form>

    @if (!empty($posts) && is_array($posts))
    @foreach ($posts as $post)
    <p>Title: {{ $post['title'] ?? 'No Title' }}</p>
    @endforeach
    @else
    <p>No posts found.</p>
    @endif

    <div id="results"></div>

    <script>
    document.getElementById('queryForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const prompt = document.getElementById('prompt').value;

        const response = await fetch('/query', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            },
            body: JSON.stringify({
                prompt
            })
        });

        const data = await response.json();
        document.getElementById('results').textContent = JSON.stringify(data, null, 2);
    });
    </script>
</body>

</html>