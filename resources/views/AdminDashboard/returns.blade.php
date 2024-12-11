@extends ('AdminDashboard.master')

@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Returns</h2>
    </div>
    <div>
        <input type="text" placeholder="Search by name" class="form-control bg-white" />
    </div>
</div>


<div class="card mb-4">
    <header class="card-header">
        <ul class="nav nav-tabs" id="reviewTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="published-tab" data-bs-toggle="tab" data-bs-target="#published" type="button" role="tab" aria-controls="published" aria-selected="true">Approved</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="false">Pending</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab" aria-controls="rejected" aria-selected="false">Rejected</button>
            </li>
        </ul>
    </header>

    <div class="card-body">
        <div class="tab-content" id="reviewTabContent">
            <!-- Published Tab -->
            <div class="tab-pane fade show active" id="published" role="tabpanel" aria-labelledby="published-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order code</th>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($approvedReturns as $index=>$return)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><b>{{ $return->order_code ?? 'N/A' }}</b></td>
                                <td><b>{{ $return->product->product_name }}</b></td>
                                <td>{{ $return->customer->name }}</td>
                                <td>{{ $return->created_at->format('d.m.Y') }}</td>
                                <td><span class="badge bg-success">Approved</span></td>
                                <td class="text-end">
                                <a href="{{route('viewReturnDetails',$return->id)}}" class="btn btn-view btn-sm me-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.return.destroy', $return->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this return?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No approved returns found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $approvedReturns->links() }}
            </div>

            <!-- Pending Tab -->
            <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order code</th>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingReturns as $index=>$return)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td><b>{{ $return->order_code }}</b></td>
                                <td><b>{{ $return->product->product_name }}</b></td>
                                <td>{{ $return->customer->name }}</td>
                                <td>{{ $return->created_at->format('d.m.Y') }}</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td class="text-end">
                                    <a href="{{route('viewReturnDetails',$return->id)}}" class="btn btn-view btn-sm me-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.return.destroy', $return->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this return?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No pending returns found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $pendingReturns->links() }}
            </div>


            <!-- Pending Tab -->
            <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order code</th>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rejectedReturns as $index=>$return)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td><b>{{ $return->order_code }}</b></td>
                                <td><b>{{ $return->product->product_name }}</b></td>
                                <td>{{ $return->customer->name }}</td>
                                <td>{{ $return->created_at->format('d.m.Y') }}</td>
                                <td><span class="badge bg-danger">Rejected</span></td>
                                <td class="text-end">
                                    <a href="{{route('viewReturnDetails',$return->id)}}" class="btn btn-view btn-sm me-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.return.destroy', $return->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this return?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No rejected returns found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $pendingReturns->links() }}
            </div>


        </div>
    </div>
</div>








@endsection