@extends ('AdminDashboard.master')

@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Blog List</h2>
    </div>
    <div>
        <a href="{{ route('blog.create') }}" class="btn btn-primary btn-sm rounded">Create new</a>
    </div>
</div>

<div class="card mb-4">
   
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover" id="productsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Added Date</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $index=>$blog)
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $blog->title ?? 'N/A' }}</td>
                                    <td>{{ $blog->created_at }}</td>
                                    <td>{{ $blog->status }}</td>
                                    <td class="text-end">
                                        <div>
                                            <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="deleteForm{{ $blog->id }}" action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('deleteForm{{ $blog->id }}', 'Are you sure you want to delete this blog?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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
            {{ $blogs->links('pagination::bootstrap-4') }}
        </ul>
    </nav>
</div>




</script>
@endsection
