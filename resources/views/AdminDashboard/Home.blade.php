@extends ('AdminDashboard.master')

@section('content')
<div class="content-header">
                    <div>
                        <h2 class="content-title card-title">Dashboard</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card card-body mb-4">
                            <article class="icontext">
                                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                                <div class="text">
                                    <h6 class="mb-1 card-title">Today Revenue</h6>
                                    <span>Rs {{ $totalCostToday }}</span>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-body mb-4">
                            <article class="icontext">
                                <span class="icon icon-sm rounded-circle bg-red-light"><i class="text-red material-icons md-local_shipping"></i></span>
                                <div class="text">
                                    <h6 class="mb-1 card-title">Orders</h6>
                                    <span>{{ $orderCount }}</span>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-body mb-4">
                            <article class="icontext">
                                <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
                                <div class="text">
                                    <h6 class="mb-1 card-title">Products</h6>
                                    <span>{{ $productCount }}</span>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-body mb-4">
                            <article class="icontext">
                                <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-groups"></i></span>
                                <div class="text">
                                    <h6 class="mb-1 card-title">Customers</h6>
                                    <span>{{ $customerCount }}</span>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8 col-lg-12">
                        <div class="card mb-4">
                            <article class="card-body">
                                <h5 class="card-title">Sale statistics</h5>
                                <canvas id="myChartSale" height="120"></canvas>
                            </article>
                        </div>
                     
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card mb-4">
                        <article class="card-body">
                                        <h5 class="card-title">Recent activities</h5>
                                        <ul class="verti-timeline list-unstyled font-sm">
                                            @foreach ($recentActivities as $activity)
                                                <li class="event-list active">
                                                    <div class="event-timeline-dot">
                                                        <i class="material-icons md-play_circle_outline font-xxl animation-fade-right"></i>
                                                    </div>
                                                    <div class="media">
                                                        <div class="me-3">
                                                            <h6>
                                                                <span>{{ $activity['date'] }}</span>
                                                                <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i>
                                                            </h6>
                                                        </div>
                                                        <div class="media-body">
                                                            <div>{{ $activity['message'] }}</div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </article>
                        </div>
                       
                    </div>
                </div>
                <div class="card mb-4">
                    <header class="card-header">
                        <h4 class="card-title">Latest orders</h4>
                    </header>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="text-center">
                                                <div class="form-check align-middle">
                                                    <input class="form-check-input" type="checkbox" id="transactionCheck01" />
                                                    <label class="form-check-label" for="transactionCheck01"></label>
                                                </div>
                                            </th>
                                            <th class="align-middle" scope="col">Order ID</th>
                                            <th class="align-middle" scope="col">Customer Name</th>
                                            <th class="align-middle" scope="col">Date</th>
                                            <th class="align-middle" scope="col">Total</th>
                                            <th class="align-middle" scope="col">Payment Status</th>
                                            <th class="align-middle" scope="col">View Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($latestOrders as $order)
                                        <tr>
                                            <td class="text-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="transactionCheck{{ $order->id }}" />
                                                    <label class="form-check-label" for="transactionCheck{{ $order->id }}"></label>
                                                </div>
                                            </td>
                                            <td><a href="#" class="fw-bold">#{{ $order->order_code }}</a></td>
                                            <td>{{ $order->customer_name }}</td> 
                                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $order->total_cost }}</td>
                                            <td>
                                                <span class="badge badge-pill badge-soft-{{ $order->payment_status == 'Paid' ? 'success' : 'danger' }}">
                                                    {{ $order->payment_status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('order-details', $order->order_code) }}" class="btn btn-xs">View details</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- table-responsive end// -->
                    </div>
                </div>

              

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChartSale').getContext('2d');
    const salesData = @json($salesChartData);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Monthly Sales',
                data: salesData,
                fill: true,
                backgroundColor: 'rgba(44, 120, 220, 0.2)',
                borderColor: 'rgba(44, 120, 220)',
                borderWidth: 2,
                tension: 0.4,
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        generateLabels: (chart) => {
                            const dataset = chart.data.datasets;
                            return dataset.map((item, index) => ({
                                text: item.label,
                                fillStyle: 'rgba(44, 120, 220, 0.2)', 
                                strokeStyle: 'rgba(44, 120, 220)',      
                                pointStyle: 'circle',
                                hidden: !chart.isDatasetVisible(index),
                                lineWidth: 2, 
                                datasetIndex: index,
                            }));
                        },
                        usePointStyle: true, 
                    },
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>


@endsection