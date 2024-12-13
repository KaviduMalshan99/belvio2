@extends ('AdminDashboard.master')

@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Promo Codes</h2>
    </div>
    <div>
        <button type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal" data-bs-target="#addUserModal">Add</button>
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Percentage</th>
                                <th style="width:10%">Start Date</th>
                                <th style="width:10%">End Date</th>
                                <th style="width:10%" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($promocodes->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">No promo codes found.</td>
                                </tr>
                            @else
                                @foreach($promocodes as $promocode)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $promocode->name }}</td>
                                        <td>{{ $promocode->description }}</td>
                                        <td>{{ $promocode->percentage }} %</td>
                                        <td>{{ $promocode->start_date }}</td>
                                        <td>{{ $promocode->end_date }}</td>
                                        <td class="text-end">
                                            <div>
                                                <!-- Edit Promo Button -->
                                                <button type="button" class="btn btn-warning btn-sm me-2 editPromoBtn" data-promo-id="{{ $promocode->id }}" data-promo-name="{{ $promocode->name }}" data-promo-description="{{ $promocode->description }}" data-promo-percentage="{{ $promocode->percentage }}" data-promo-start="{{ $promocode->start_date }}" data-promo-end="{{ $promocode->end_date }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <!-- Delete Promo Button -->
                                                <form id="delete-form-{{ $promocode->id }}" action="{{ route('promo_codes.destroy', $promocode->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-{{ $promocode->id }}', 'Are you sure you want to delete this promocode?');">
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
<!-- Add Promo Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New Promo Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('promo_codes.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="percentage" class="form-label">Percentage</label>
                                <input type="number" class="form-control" id="percentage" name="percentage" placeholder="Enter percentage" required min="0" max="100">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" min="{{ now()->format('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


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
    document.addEventListener("DOMContentLoaded", function() {
        // Get all edit buttons
        const editButtons = document.querySelectorAll('.editPromoBtn');
        
        // Add event listener for each edit button
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get promo code data from the button's data attributes
                const promoId = button.getAttribute('data-promo-id');
                const promoName = button.getAttribute('data-promo-name');
                const promoDescription = button.getAttribute('data-promo-description');
                const promoPercentage = button.getAttribute('data-promo-percentage');
                const promoStartDate = button.getAttribute('data-promo-start');
                const promoEndDate = button.getAttribute('data-promo-end');

                // Create modal content dynamically
                const modalHTML = `
                <div class="modal fade" id="editPromoModal-${promoId}" tabindex="-1" aria-labelledby="editPromoModalLabel-${promoId}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPromoModalLabel-${promoId}">Edit Promo Code</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/admin/promo_codes/${promoId}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name-${promoId}" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name-${promoId}" name="name" value="${promoName}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description-${promoId}" class="form-label">Description</label>
                                        <textarea class="form-control" id="description-${promoId}" name="description" rows="3">${promoDescription}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="percentage-${promoId}" class="form-label">Percentage</label>
                                        <input type="number" class="form-control" id="percentage-${promoId}" name="percentage" value="${promoPercentage}" min="0" max="100" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="start_date-${promoId}" class="form-label">Start Date</label>
                                                <input type="date" class="form-control" id="start_date-${promoId}" name="start_date" value="${promoStartDate}" min="{{ now()->format('Y-m-d') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="end_date-${promoId}" class="form-label">End Date</label>
                                                <input type="date" class="form-control" id="end_date-${promoId}" name="end_date" value="${promoEndDate}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            `;
                // Insert the modal into the body
                document.body.insertAdjacentHTML('beforeend', modalHTML);

                // Show the modal using Bootstrap
                const modal = new bootstrap.Modal(document.getElementById(`editPromoModal-${promoId}`));
                modal.show();

                // Clean up the modal after it's closed (optional)
                const modalElement = document.getElementById(`editPromoModal-${promoId}`);
                modalElement.addEventListener('hidden.bs.modal', function() {
                    modalElement.remove();
                });
            });
        });
    });
</script>

@endsection
