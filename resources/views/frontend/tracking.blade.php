@extends('frontend.master')



@section('content')
<div class="tracking-container mt-4">
    <h4 style="margin-left:5%; font-size:20px; font-weight:bold; color:white; margin-top:10px;">Tracking Details</h4>
    <br><br>

    
    <div class="progress-container mb-5">
    <h5>Order Progress</h5>
    <div class="progress-wrapper">
        @php
            $statuses = [
                'Pending' => 'Order Placed',
                'Accepted' => 'Order Accepted',
                'Packed' => 'Order Packed',
                'Pickup Done' => 'Order Picked Up',
                'Ready to Ship' => 'Ready to Ship',
                'Shipped' => 'Shipped',
                'In Transit' => 'In Transit',
                'Delivered' => 'Delivered',
                'Cancelled' => 'Cancelled',
                'Returned' => 'Returned',
            ];

            $currentStatusIndex = array_search($order->status, array_keys($statuses));
        @endphp

        <ul class="progress-timeline">
            @foreach ($statuses as $key => $label)
                <li class="{{ $currentStatusIndex >= array_search($key, array_keys($statuses)) ? 'completed' : '' }}">
                    <div class="step-circle">{{ $loop->index + 1 }}</div>
                    <span class="step-label">{{ $label }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    
    <br><br>
    <h5>Activity Logs</h5>
    <div class="activity-log-container">
        <ul class="activity-log-timeline">
            @php
                $activityLogs = collect($order->activity_logs ?? []);
            @endphp

            @if ($activityLogs->isEmpty())
                <li class="activity-log-entry">
                    <p class="log-message">No activity logs available for this order.</p>
                </li>
            @else
                @foreach ($activityLogs as $log)
                    <li class="activity-log-step">
                        <div class="log-content">
                            <div class="log-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="log-details">
                                <p class="log-message">{{ $log['message'] }}</p>
                                <span class="log-date">{{ \Carbon\Carbon::parse($log['timestamp'])->format('d M Y h:i A') }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>

<style>

/* Main Container */
.activity-log-container {
    margin-top: 20px;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    border: 1px solid #ddd;
}

/* Vertical Timeline */
.activity-log-timeline {
    display: flex;
    flex-direction: column;
    list-style: none;
    padding: 0;
    margin: 0;
    position: relative;
    border-left: 2px solid #ddd;
    left:30px;
}

.activity-log-step {
    position: relative;
    padding-left: 30px;
    margin-bottom: 20px;
}

.activity-log-step:last-child {
    margin-bottom: 0;
}

.log-content {
    display: flex;
    align-items: center;
}

.log-icon {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #4caf50;
    color: white;
    text-align: center;
    line-height: 30px;
    font-size: 14px;
    position: absolute;
    left: -17px;
}

.log-details {
    margin-left: 10px;
}

.log-message {
    font-size: 14px;
    color: #333;
}

.log-date {
    font-size: 12px;
    color: #666;
    margin-top: 5px;
}

/* Vertical Line Indicator */
.activity-log-timeline::before {
    content: '';
    position: absolute;
    top: 0;
    left: 12px;
    height: 100%;
    width: 2px;
    background: #ddd;
    z-index: -1;
}
</style>

</div>


<style>

    .progress-container {
        margin-top: 5px;
        margin-left:10%;
        margin-right:10%;
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
    }

    .progress-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        padding-top: 20px;
    }

    .progress-timeline {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        width: 100%;
        justify-content: space-between;
        position: relative;
    }

    .progress-timeline::before {
        content: '';
        position: absolute;
        top: 20%;
        left: 5%;
        width: 92%;
        height: 4px;
        background: #ddd;
        z-index: 0;
    }

    .progress-timeline li {
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .step-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #ddd;
        color: white;
        line-height: 30px;
        font-size: 14px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .step-circle.completed {
        background: #4caf50;
    }

    .step-label {
        margin-top: 10px;
        font-size: 14px;
    }

    li.completed .step-circle {
        background-color: #4caf50;
        color: white;
    }
</style>




@endsection
