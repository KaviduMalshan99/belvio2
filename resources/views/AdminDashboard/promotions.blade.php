@extends ('AdminDashboard.master')

@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Promotions</h2>
    </div>
    <div>
        <a href="{{ route('add_promotions') }}" class="btn btn-primary btn-sm rounded">Create</a>
    </div>
</div>

<div class="card mb-4">
    <header class="card-header">
        <div class="row align-items-center">
            
        </div>
    </header>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover" id="productsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product ID</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Discount Price</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($promotions->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">No promotions found.</td>
                                </tr>
                            @else
                                @foreach($promotions as $promotion)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $promotion->product_id }}</td>
                                        <td>{{ $promotion->product->product_name }}</td>
                                        <td>Rs {{ $promotion->product->normal_price }}</td>
                                        <td>{{ $promotion->discount }} %</td>
                                        <td>Rs {{ $promotion->discount_price }}</td>
                                        <td>{{ $promotion->start_date }}</td>
                                        <td>{{ $promotion->end_date }}</td>
                                        <td>{{ $promotion->status }}</td>
                                        <td class="text-end">
                                            <div>
                                                <!-- Edit promotion Button -->
                                                <a href="{{ route('promotion.edit', $promotion->id) }}" class="btn btn-warning btn-sm me-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Delete promotion Button -->
                                                <form id="delete-form-{{ $promotion->id }}" action="{{ route('promotion.destroy', $promotion->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-{{ $promotion->id }}', 'Are you sure you want to delete this promotion?');">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pagination-area mt-30 mb-50">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            
        </ul>
    </nav>
</div>


@endsection
