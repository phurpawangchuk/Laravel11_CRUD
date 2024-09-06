@if($data)
<ul>
    @foreach($data as $item)
    <li>{{ $item['country'] }}</li>
    @endforeach
</ul>
@else
<p>No data available.</p>
@endif