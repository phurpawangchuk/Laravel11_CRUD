<div>
    @php
    $isAuthenticated = Auth::check();
    $user = Auth::user();
    @endphp

    @if ($isAuthenticated && $user)
    {{ $slot }}
    @else
    <script>
    window.location.href = "{{ route('login') }}";
    </script>
    @endif
</div>