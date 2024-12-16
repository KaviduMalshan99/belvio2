@extends('AdminDashboard.master')

@section('content')
<form method="POST" action="{{ route('promotion.update', $promotion->id) }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="content-header">
                <h2 class="content-title">Edit Promotion</h2>
                <div>
                    <button type="submit" class="btn btn-md rounded font-sm hover-up">Publish</button>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Edit Promotion Details</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label" for="product_name">Select Product <i class="text-danger">*</i></label>
                                <select name="product_id" class="form-select" id="productselect">
                                    <option value="">Select a Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->product_id }}" 
                                            @if($promotion->product_id == $product->product_id) selected @endif
                                            data-price="{{ $product->normal_price }}">
                                            {{ $product->product_id }} : {{ $product->product_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Product Price</label>
                                <input name="price" id="price" type="number" placeholder="Rs" class="form-control" 
                                       value="{{ $promotion->product->normal_price }}" readonly />
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Discount % <i class="text-danger">*</i></label>
                                <input name="discount" id="discount" type="number" class="form-control" 
                                       value="{{ $promotion->discount }}" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="discount_price" class="form-label">Discount Price</label>
                                <input name="discount_price" id="discount_price" placeholder="Rs" type="number" 
                                       class="form-control" value="{{ $promotion->discount_price }}" readonly />
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" 
                                               value="{{ $promotion->start_date ?? now()->format('Y-m-d') }}" 
                                               min="{{ now()->format('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" 
                                               value="{{ $promotion->end_date }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="form-label me-2">Status:</label>
                                <input type="radio" name="status" value="active" 
                                       @if($promotion->status == 'Active') checked @endif> Active
                                <input type="radio" name="status" class="ms-2" value="inactive" 
                                       @if($promotion->status == 'Inactive') checked @endif> Inactive
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('productselect').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var price = selectedOption.getAttribute('data-price');
        
        document.getElementById('price').value = price;
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');

        startDate.addEventListener('change', function () {
            endDate.min = startDate.value;
        });
    });
</script>

<script>
    document.getElementById('discount').addEventListener('input', function () {
        var discount = parseFloat(this.value) || 0;  
        var price = parseFloat(document.getElementById('price').value) || 0; 
        
        var discountAmount = (discount / 100) * price;
        var discountPrice = price - discountAmount;
        document.getElementById('discount_price').value = discountPrice.toFixed(2);
    });
</script>
@endsection
