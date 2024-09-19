<div class="container mt-0">
    @if (count($products) > 0)
    <table class="table table-light table-hover w-100">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>{{ $product->description }}</td>
                <td>
                    @if ($product->image)
                    <img src="https://posts3image.s3.amazonaws.com/uploads/{{$product->image}}" alt="Post Image"
                        width="100">
                    @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">No products found.</div>
    @endif
</div>