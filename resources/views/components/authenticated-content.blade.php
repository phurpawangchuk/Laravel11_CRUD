<div>
    @php
    $isAuthenticated = Auth::check();
    $user = Auth::user();
    @endphp

    @if ($isAuthenticated && $user)
    {{ $slot }}
    @endif
</div>