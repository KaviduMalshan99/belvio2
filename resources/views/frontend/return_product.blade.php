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
                    <h1 class="title">Returns</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('returns')}}">Product Returns</a></li>
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
                            <li class="active">Add Return</li>
                            <li>Return History</li>
                        </ul>
                        <div class="content-tab">


                            <!-- add -->
                            <div class="content-inner">
                                <div class="inner max-width-83 padding-top-33">

                                    <div class="comment-respond review-respond" id="respond">
                                        <div class="comment-reply-title margin-bottom-14">
                                            <h5>Return a product</h5>
                                        </div>
                                        <form novalidate="" class="comment-form review-form" id="commentform" method="post" action="{{route('returns.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <!-- Product Selection -->
                                            <div class="comment-form-comment mb-3">
                                                <label style="color:white;">Product* :</label>
                                                <select name="order_item_id" id="product_id" required>
                                                    <option value="" disabled selected>Select the product you ordered to return.</option>
                                                    @if ($orderedProducts->isEmpty())
                                                    <option value="" disabled>No products available for return.</option>
                                                    @else
                                                    @foreach($orderedProducts as $product)
                                                    <option value="{{ $product->id }}">{{ $product->order_code }} - {{ $product->product_name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>

                                            </div>


                                            <!-- Review Text -->
                                            <div class="comment-form-comment mb-3">
                                                <label style="color:white;">Reason* :</label>
                                                <textarea name="reason" rows="4" placeholder="Add reason for return this product" style="color:black;" required></textarea>
                                            </div>

                                            <!-- Image Upload -->
                                            <div class="comment-form-comment mb-3">
                                                <label style="color:white;">Upload Image(s) :</label>
                                                <input type="file" name="media[]" id="review_images" multiple accept="image/*">
                                                <small style="color:white;">You can upload up to 3 images.</small>
                                                <div id="image-preview-container" style="margin-top: 15px; display: flex; gap: 10px; flex-wrap: wrap;"></div>
                                            </div>




                                            <!-- Submit Button -->
                                            <p class="form-submit">
                                                <button type="submit" class="comment-submit">Submit</button>
                                            </p>
                                        </form>

                                    </div>




                                </div>
                            </div>

                            <!-- history -->
                            <div class="content-inner">
                                <div class="inner max-width-83 padding-top-33">

                                    <ol class="review-list">
                                        <hr style="color:white;" />
                                        <h5 style="color:white;">Returned Products</h5>
                                        @if($returns->isEmpty())
                                        <p style="color:white;">No returned products.</p>
                                        @else
                                        @foreach($returns as $return)
                                        <li class="review">
                                            <div class="text-wrap">
                                                <!-- Review Meta -->
                                                <div class="review-meta">
                                                    <label style="color:white;">Product: {{ $return->order_code }} - {{ $return->product_name }}</label>
                                                    <br /><span class="text-gray-800 text-xs">{{ $return->created_at->format('d.m.Y') }}</span>
                                                    <div class="flat-star style-1">
                                                        @if($return->status == 'Rejected')
                                                        <label style="color:red;">{{ $return->status }}</label>
                                                        @elseif($return->status == 'Approved')
                                                        <label style="color:green;">{{ $return->status }}</label>
                                                        @else
                                                        <label style="color:white;">{{ $return->status }}</label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Return Text -->
                                                <div class="review-text">
                                                    <p style="color:white;">Reason: {{ $return->reason ?? 'No reason' }}</p>
                                                </div>

                                                <!-- Uploaded Images -->
                                                @if($return->media && count($return->media) > 0)
                                                <div class="review-images">
                                                    @foreach($return->media as $mediaPath)
                                                    <div style="display: inline-block; position: relative; margin: 5px;">
                                                        <img src="{{ asset('storage/' . $mediaPath) }}" alt="Return Image"
                                                            style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ccc;">
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endif
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif


                                    </ol><!-- /list -->

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