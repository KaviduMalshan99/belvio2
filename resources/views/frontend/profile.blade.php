@extends('frontend.master')



@section('content')

<style>
    .transparent-input {
        background: transparent;
        color: white;
        border: 1px solid white;
        padding: 5px;
        border-radius: 3px;

    }

    .order-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        margin: 20px 0;
        font-size: 16px;
        text-align: left;
    }

    .order-table th,
    .order-table td {
        border: 1px solid #ddd;
        padding: 10px;
        word-wrap: break-word;
    }

    .order-table th {
        text-align: center;
    }

    .order-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .order-table tbody tr:hover {
        background-color: green;
    }

    .table-responsive {
        overflow-x: auto;
        max-width: 100%;
        margin-bottom: 1rem;
    }

    .table {
        min-width: 850px;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        white-space: nowrap;
        /* Prevent text wrapping */
    }

    .star-rating i {
        font-size: 24px;
        color: gray;
        cursor: pointer;
        margin-right: 5px;
    }

    .star-rating i.selected,
    .star-rating i:hover {
        color: gold;
    }

    #image-preview-container {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .image-preview {
        position: relative;
        width: 100px;
        height: 100px;
        border: 2px solid white;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .image-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .image-preview .remove-image {
        position: absolute;
        top: 3px;
        right: 3px;
        background: transparent;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 14px;
        line-height: 18px;
        text-align: center;
        cursor: pointer;
        z-index: 10;
    }
</style>

<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">My Profile</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('viewProfile')}}">My Profile</a></li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.page-title -->


<section class="flat-row shop-detail-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="flat-tabs style-1 has-border">
                    <div class="inner">
                        <ul class="menu-tab">
                            <li class="active">Dashboard</li>
                            <li>My Orders</li>
                            <li>Reviews</li>
                            <li>Edit Profile</li>
                            <li>Change Password</li>
                            <li>Log Out</li>
                        </ul>
                        <div class="content-tab">


                            <!-- dashboard -->
                            <div class="content-inner">
                                <div class="inner max-width-40">
                                    <table>
                                        <tr>
                                            <td>Name:</td>
                                            <td>{{$customer->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td>{{$customer->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Number:</td>
                                            <td>{{$customer->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Address:</td>
                                            <td>{{$customer->address}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>


                            <!-- orders -->


                            <div id="all-orders" class="content-inner">
                                @foreach ($orders as $order)
                                <div class="order-card" style="border: 1px solid #ccc; border-radius: 10px; padding: 15px; margin:10px; background-color:#fff;">
                                    <div class="order-card-header d-flex justify-content-between align-items-center" style="margin-bottom: 20px; border-bottom: 2px solid black">
                                        <span class="status {{ strtolower(str_replace(' ', '-', $order->status)) }}" style="color:red; font-weight:bold;">{{ $order->status }}</span>

                                    </div>

                                    <div class="order-card-body d-flex align-items-center" style="color:black; font-weight:bold;">

                                        <div class="order-info" style="font-size: 13px; color: black;">
                                            <p><a href="#" class="order-link">Order ID:</a> <a href="#" class="order-link">{{ $order->order_code }}</a></p>
                                            <p class="order-date">Order date: {{ $order->date }}</p>
                                            <p class="order-price">Total: Rs {{ number_format($order->total_cost, 2) }}</p>
                                        </div>
                                        <div style="text-align: right; margin-left: auto;">
                                            <a href="{{ route('user.track-order', $order->order_code) }}" class="track-button">Track Order</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>


                            <!-- review -->
                            <div class="content-inner">
                                <div class="inner max-width-83 padding-top-33">

                                    <div class="comment-respond review-respond" id="respond">
                                        <div class="comment-reply-title margin-bottom-14">
                                            <h5>Write a review</h5>
                                        </div>
                                        <form novalidate="" class="comment-form review-form" id="commentform" method="post" action="{{route('reviews.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <!-- Product Selection -->
                                            <div class="comment-form-comment mb-3">
                                                <label style="color:white;">Product* :</label>
                                                <select name="order_item_id" id="product_id" required>
                                                    <option value="" disabled selected>Select the product you ordered to review.</option>
                                                    @if ($orderedProducts->isEmpty())
                                                    <option value="" disabled>No products available for review.</option>
                                                    @else
                                                    @foreach($orderedProducts as $product)
                                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>

                                            </div>

                                            <!-- Star Rating -->
                                            <div class="flat-star style-2 mb-3">
                                                <label style="color:white;">Rating* :</label><br />
                                                <div class="star-rating" id="star-rating">
                                                    <i class="fa fa-star" data-value="1"></i>
                                                    <i class="fa fa-star" data-value="2"></i>
                                                    <i class="fa fa-star" data-value="3"></i>
                                                    <i class="fa fa-star" data-value="4"></i>
                                                    <i class="fa fa-star" data-value="5"></i>
                                                </div>
                                                <input type="hidden" name="rating" id="rating" required>
                                            </div>

                                            <!-- Review Text -->
                                            <div class="comment-form-comment mb-3">
                                                <label style="color:white;">Review* :</label>
                                                <textarea name="review" rows="4" required></textarea>
                                            </div>

                                            <!-- Image Upload -->
                                            <div class="comment-form-comment mb-3">
                                                <label style="color:white;">Upload Image(s) :</label>
                                                <input type="file" name="media[]" id="review_images" multiple accept="image/*">
                                                <small style="color:white;">You can upload up to 3 images.</small>
                                                <div id="image-preview-container" style="margin-top: 15px; display: flex; gap: 10px; flex-wrap: wrap;"></div>
                                            </div>


                                            <!-- Anonymous Submission -->
                                            <div class="comment-form-notify clearfix">
                                                <input type="hidden" name="is_anonymous" value="0">
                                                <input type="checkbox" name="is_anonymous" id="check-notify" value="1">
                                                <label for="check-notify">Anonymous submit</label>
                                            </div>

                                            <!-- Submit Button -->
                                            <p class="form-submit">
                                                <button type="submit" class="comment-submit">Submit</button>
                                            </p>
                                        </form>

                                    </div>


                                    <ol class="review-list">
                                        <hr style="color:white;" />
                                        <h5 style="color:white;">Review History</h5>
                                        @if($userReviews->isEmpty())
                                        <p style="color:white;">No reviewed products.</p>
                                        @else
                                        @foreach($userReviews as $review)
                                        <li class="review">
                                            <div class="text-wrap">
                                                <!-- Review Meta -->
                                                <div class="review-meta">
                                                    <label style="color:white;">{{ $review->product_name }}</label>
                                                    <br /><span class="text-gray-800 text-xs">{{ $review->created_at->format('d.m.Y') }}</span>
                                                    <div class="flat-star style-1">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <=floor($review->rating))
                                                            <i class="fa fa-star"></i>
                                                            @elseif($i == ceil($review->rating))
                                                            <i class="fa fa-star-half-o"></i>
                                                            @else
                                                            <i class="fa fa-star-o"></i>
                                                            @endif
                                                            @endfor
                                                    </div>
                                                </div>

                                                <!-- Review Text -->
                                                <div class="review-text">
                                                    <p style="color:white;">{{ $review->review ?? 'No Review'}}</p>
                                                </div>

                                                <!-- Uploaded Images -->
                                                @if($review->media && count($review->media) > 0)
                                                <div class="review-images">
                                                    @foreach($review->media as $mediaPath)
                                                    <div style="display: inline-block; position: relative; margin: 5px;">
                                                        <img src="{{ asset('storage/' . $mediaPath) }}" alt="Review Image"
                                                            style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ccc;">
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endif

                                                <!-- Delete Link -->
                                                <div class="review-actions mt-2">
                                                    <form action="{{ route('customer.reviews.destroy', $review->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm mt-3" style="cursor:pointer;" onclick="return confirm('Are you sure you want to delete this review?');">Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ol><!-- /.review-list -->

                                </div>
                            </div>


                            <!-- edit profile -->
                            <div class="content-inner">
                                <div class="inner max-width-83 padding-top-33">

                                    <div class="comment-respond review-respond" id="respond">
                                        <div class="comment-reply-title margin-bottom-14">
                                            <h5>Edit Profile</h5>
                                            <p>You can update your details here</p>
                                        </div>
                                        <form novalidate="" class="comment-form review-form" id="commentform" method="post" action="{{ route('updateProfile',$customer->id) }}">
                                            @csrf
                                            <div class="comment-name mb-3">
                                                <label style="color:white;">Name*</label>
                                                <input type="text" size="30" value="{{ old('name', $customer->name) }}" name="name" id="name" required style="background: transparent; color: white;">
                                                @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="comment-email mb-3">
                                                <label style="color:white;">Email*</label>
                                                <input type="email" size="30" value="{{ old('email', $customer->email) }}" name="email" id="email" required style="background: transparent; color: white;">
                                                @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="comment-name mb-3">
                                                <label style="color:white;">Mobile Number*</label>
                                                <input type="text" size="30" value="{{ old('phone', $customer->phone) }}" name="phone" id="phone" required style="background: transparent; color: white;">
                                                @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="comment-email mb-3">
                                                <label style="color:white;">Address*</label>
                                                <input type="text" size="30" value="{{ old('address', $customer->address) }}" name="address" id="address" required style="background: transparent; color: white;">
                                                @error('address')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-submit">
                                                <button type="submit" class="comment-submit">Submit</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>


                            <!-- password -->
                            <div class="content-inner">
                                <div class="inner max-width-40 padding-top-33">

                                    <div class="comment-respond review-respond" id="respond">
                                        <div class="comment-reply-title margin-bottom-14">
                                            <h5>Change Password</h5>
                                            <p>You can update your password here</p>
                                        </div>
                                        <form novalidate="" class="comment-form review-form" id="commentform" method="post" action="{{ route('updatePassword', $customer->id) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="comment-name mb-3 col-md-12">
                                                    <label style="color:white;">Current Password*</label>
                                                    <input type="password" size="30" placeholder="Type Current Password" name="password" id="password" required style="background: transparent; color: white;">
                                                    @error('password')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="comment-email mb-3 col-md-12">
                                                    <label style="color:white;">New Password*</label>
                                                    <input type="password" size="30" placeholder="Type New Password" name="new_password" id="new_password" required style="background: transparent; color: white;">
                                                    @error('new_password')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="comment-name mb-3 col-md-12">
                                                    <label style="color:white;">Confirm Password*</label>
                                                    <input type="password" size="30" placeholder="Retype New Password" name="new_password_confirmation" id="new_password_confirmation" required style="background: transparent; color: white;">
                                                    @error('new_password_confirmation')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-submit mb-3 col-md-12">
                                                    <button type="submit" class="comment-submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!-- /.comment-respond -->
                                </div>
                            </div><!-- /.content-inner -->



                            <!-- logout -->
                            <div class="content-inner">
                                <div class="inner max-width-40 padding-top-33">
                                    <div class="comment-respond review-respond" id="respond">
                                        <div class="comment-reply-title margin-bottom-14">
                                            <h5>Log Out</h5>
                                            <p>Are you sure you want to log out now?</p>
                                        </div>
                                        <div class="logout-actions">
                                            <a href="{{ route('customer.logout') }}" class="btn btn-success" style="margin-right: 10px;">Yes</a>
                                            <a href="{{ url()->previous() }}" class="btn btn-danger">No</a>
                                        </div>
                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.shop-detail-content -->


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stars = document.querySelectorAll(".star-rating i");
        const ratingInput = document.getElementById("rating");

        stars.forEach(star => {
            star.addEventListener("click", function() {
                const ratingValue = this.getAttribute("data-value");
                ratingInput.value = ratingValue;

                stars.forEach(s => s.classList.remove("selected"));
                this.classList.add("selected");

                // Highlight stars up to the selected one
                let prev = this.previousElementSibling;
                while (prev) {
                    prev.classList.add("selected");
                    prev = prev.previousElementSibling;
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const imageInput = document.getElementById("review_images");
        const previewContainer = document.getElementById("image-preview-container");

        imageInput.addEventListener("change", function() {
            // Clear the container if images are reselected
            previewContainer.innerHTML = "";

            // Limit the number of images to 3
            const files = Array.from(this.files).slice(0, 3);

            files.forEach((file, index) => {
                if (file.type.startsWith("image/")) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imageWrapper = document.createElement("div");
                        imageWrapper.classList.add("image-preview");

                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.alt = `Image Preview ${index + 1}`;

                        const removeButton = document.createElement("button");
                        removeButton.classList.add("remove-image");
                        removeButton.textContent = "x";
                        removeButton.addEventListener("click", () => {
                            imageWrapper.remove();
                            // Remove the file from the input
                            const dataTransfer = new DataTransfer();
                            files.forEach((fileToKeep, i) => {
                                if (i !== index) dataTransfer.items.add(fileToKeep);
                            });
                            imageInput.files = dataTransfer.files;
                        });

                        imageWrapper.appendChild(img);
                        imageWrapper.appendChild(removeButton);
                        previewContainer.appendChild(imageWrapper);
                    };

                    reader.readAsDataURL(file);
                }
            });
        });
    });
</script>


@endsection