@extends ('AdminDashboard.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h3 class="text-center text-primary mb-4">Return Details</h3>

                <div class="mb-4">
                    <h5 class="text-secondary mb-1">Customer</h5>
                    <p class="text-muted">{{$return->customer->name }}</p>
                    <p class="text-muted">{{$return->customer->phone }}</p>
                    <p class="text-muted">{{$return->customer->email }}</p>

                </div>

                <div class="mb-4">
                    <h5 class="text-secondary mb-1">Product</h5>
                    <p class="text-muted">{{ $return->product->product_id}}</p>
                    <p class="text-muted">{{ $return->product->product_name}}</p>
                </div>

                <div class="mb-4">
                    <h5 class="text-secondary mb-1">Reason</h5>
                        <p class="text-muted">{{ $return->reason ?? 'No reason' }}</p>
                </div>

                <div class="mb-4">
                    <h5 class="text-secondary mb-1">Date</h5>
                    <p class="text-muted">{{ $return->created_at->format('d.m.Y') }}</p>
                </div>

                <div class="mb-4">
                    <h5 class="text-secondary mb-1">Return product Media</h5>
                    <div class="d-flex flex-wrap mt-2">
                        @php
                        $mediaFiles = is_string($return->media) ? json_decode($return->media, true) : $return->media;
                        @endphp

                        @if (!empty($mediaFiles))
                        @foreach ($mediaFiles as $media)
                        @if (in_array(pathinfo($media, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                        <!-- Display Image -->
                        <div class="me-2 mb-2">
                            <img src="{{ asset('storage/' . $media) }}" alt="Review Media" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        @elseif (in_array(pathinfo($media, PATHINFO_EXTENSION), ['mp4', 'avi', 'mov', 'webm']))
                        <!-- Display Video -->
                        <div class="me-2 mb-2">
                            <video controls class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                                <source src="{{ asset('storage/' . $media) }}" type="video/{{ pathinfo($media, PATHINFO_EXTENSION) }}">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        @else
                        <!-- Unsupported Media -->
                        <div class="me-2 mb-2">
                            <span class="badge bg-warning">Unsupported Media Type</span>
                        </div>
                        @endif
                        @endforeach
                        @else
                        <p>No media available for this return.</p>
                        @endif
                    </div>
                </div>


                <div class="mb-4">
                    <h5 class="text-secondary mb-1">Status</h5>
                    <span class="badge 
                        @if($return->status == 'Pending')
                            bg-warning
                        @elseif($return->status == 'Rejected')
                            bg-danger
                        @else
                            bg-success
                        @endif
                    ">
                        {{$return->status}}
                    </span>
                </div>

                <div class="mb-4 col-md-6">
                    <h5 class="text-secondary mb-1">Change Status</h5>
                    <form action="{{ route('returns.updateStatus', $return->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="Pending" {{ $return->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Approved" {{ $return->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                <option value="Rejected" {{ $return->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection