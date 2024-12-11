@extends ('AdminDashboard.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h3 class="text-center text-primary mb-4">Product Details</h3>
                
                <!-- Product Info & Affiliate Details in Compact Grid -->
                <div class="row mb-3">
                    <div class="col-6 mb-2">
                        <p><strong>Product ID:</strong> {{ $product->product_id }}</p>
                        <p><strong>Name:</strong> {{ $product->product_name }}</p>
                        <p><strong>Category:</strong> <span class="badge bg-info text-white">{{ $product->category->name ?? 'N/A' }}</span></p>
                        <p><strong>Total Quantity:</strong> {{ $product->quantity }}</p>
                        <p><strong>Price: Rs. {{ $product->normal_price }}</strong></p>
                        <div class="mb-4">
                            <h5 class="text-secondary">Description</h5>
                            <p class="text-muted">{{ $product->product_description ?? 'No description available.' }}</p>
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        
                       <!-- Images Section -->
                        <h5 class="text-secondary">Product Images and Videos</h5>
                        <div class="d-flex flex-wrap mt-2">
                            @if($product->images->isNotEmpty())
                            <div class="d-flex flex-wrap mt-2">
                                @foreach($product->images as $media)
                                    @if($media->image_path)
                                        <!-- Image Container -->
                                        <div class="media-container me-2 mb-2" style="width: 150px;  overflow: hidden;">
                                            <img src="{{ asset('storage/' . $media->image_path) }}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;" alt="Product Image" />
                                        </div>
                                    @elseif($media->video_path)
                                        <!-- Video Container -->
                                        <div class="media-container me-2 mb-2" style="width: 150px; height: 150px; overflow: hidden;">
                                            <video style="width: 100%; height: 100%;" controls>
                                                <source src="{{ asset('storage/' . $media->video_path) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @else
                                <p class="text-muted">No images or videos available.</p>
                            @endif
                        </div>
                        <div class="row">
                            <!-- Sizes and Quantities Section -->
                            @if ($product->variations->where('type', 'size')->isNotEmpty())
                                <div class="col-md-6 mb-4">
                                    <div class="d-flex align-items-start flex-column">
                                        <span class="text-gray-900 mb-2">Sizes:</span>
                                        @foreach ($product->variations->where('type', 'size')->groupBy('value') as $size => $groupedVariations)
                                            <div class="d-flex align-items-center">
                                                <span class="me-2">{{ $size }}</span>
                                                <span class="text-gray-600">- {{ $groupedVariations->sum('quantity') }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Colors and Quantities Section -->
                            @if ($product->variations->where('type', 'color')->isNotEmpty())
                                <div class="col-md-6 mb-4">
                                    <div class="d-flex align-items-start flex-column">
                                        <span class="text-gray-900 mb-2">Colors:</span>
                                        @foreach ($product->variations->where('type', 'color')->groupBy('hex_value') as $color => $groupedVariations)
                                            <div class="d-flex align-items-center">
                                                <span 
                                                    class="color-list__button border border-2 border-gray-50 rounded-circle me-2" 
                                                    style="background-color: {{ $color }}; width: 20px; height: 20px;" 
                                                    data-color="{{ $color }}">
                                                </span>
                                                <span class="text-gray-600">- {{ $groupedVariations->sum('quantity') }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
