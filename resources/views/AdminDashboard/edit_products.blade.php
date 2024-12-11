@extends ('AdminDashboard.master')

@section('content')
<form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Edit Product</h2>

                <div>
                    <button type="submit" class="btn btn-md rounded font-sm hover-up">Update</button>
                </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Basic</h4>
            </div>
            <div class="card-body">
                <!-- Bind the form inputs to the existing product data -->
                <div class="mb-4">
                    <label for="product_name" class="form-label">Product title <i class="text-danger">*</i></label>
                    <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" placeholder="Type here" class="form-control" id="product_name" />
                </div>
                <div class="mb-4">
                    <label class="form-label">Product description<i class="text-danger">*</i></label>
                    <textarea name="product_description" placeholder="Type here" class="form-control" rows="4">{{ old('product_description', $product->product_description) }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label">Total Quantity <i class="text-danger">*</i></label>
                    <input name="quantity" id="quantity" type="number" value="{{ old('quantity', $product->quantity) }}" class="form-control"/>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <label class="form-label">Normal price <i class="text-danger">*</i></label>
                            <input name="normal_price" id="normal_price" value="{{ old('normal_price', $product->normal_price) }}" placeholder="Rs" type="number" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="card mb-4">
        <div class="card-header">
            <h4>Variations</h4>
        </div>
        <div class="card-body">
            <div id="variationsContainer">
                @foreach ($product->variations as $index => $variation)
                <div class="row mb-3 variation-row">
                    <div class="col-lg-4">
                        <label class="form-label">Select Type</label>
                        <select name="variations[{{ $index }}][type]" class="form-select" onchange="toggleColorInput(this)">
                            <option value="size" {{ $variation->type == 'size' ? 'selected' : '' }}>Size</option>
                            <option value="color" {{ $variation->type == 'color' ? 'selected' : '' }}>Color</option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label">Value</label>
                        <input type="text" name="variations[{{ $index }}][value]" class="form-control" value="{{ $variation->type == 'color' ? '' : $variation->value }}" />
                        <input type="color" name="variations[{{ $index }}][hex_value]" class="form-control color-input" style="display: {{ $variation->type == 'color' ? 'block' : 'none' }};" value="{{ $variation->hex_value }}" />
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="variations[{{ $index }}][quantity]" class="form-control" value="{{ $variation->quantity }}" />
                    </div>
                    <div class="col-lg-1 text-center">
                        <label class="form-label">Delete</label>
                        <button type="button" class="btn btn-danger delete-variation" onclick="removeVariation(this)">✖</button>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-success" onclick="addVariation()">Add Variation</button>
        </div>
    </div>



    </div>
    <div class="col-lg-5">
    <div class="card mb-4">
            <div class="card-header">
                <h4>Media</h4>
            </div>
            <div class="card-body">
            <!-- Existing Images and Videos Preview -->
                <div class="mt-4">
                    <h5>Existing media</h5>

                    <!-- Image Preview -->
                    <div class="image-preview" id="image_preview_container" style="display: flex; gap: 10px; flex-wrap: wrap;">
                        @foreach ($product->images as $image)
                            @if ($image->image_path) <!-- Check if it's an image -->
                                <div class="position-relative" data-media-id="{{ $image->id }}" data-media-type="image">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                    
                                    <!-- Delete Button for Image -->
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteMedia({{ $image->id }}, 'image')">&times;</button>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Video Preview -->
                    <div class="video-preview" id="video_preview_container" style="display: flex; gap: 10px; flex-wrap: wrap;">
                        @foreach ($product->images as $video)
                            @if ($video->video_path) <!-- Check if it's a video -->
                                <div class="position-relative" data-media-id="{{ $video->id }}" data-media-type="video">
                                    <video controls style="width: 100px; height: 100px; object-fit: cover;">
                                        <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    
                                    <!-- Delete Button for Video -->
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteMedia({{ $video->id }}, 'video')">&times;</button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="input-upload mt-4">
                    <h5>Upload images</h5>
                    <img src="{{ asset('backend/assets/imgs/theme/upload.svg') }}" alt="" />
                    <input name="images[]" id="media_upload" class="form-control" type="file" multiple accept="image/*" />
                    <div class="new-image-preview" id="new_image_preview_container" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>
                </div>

                <!-- Video Upload -->
                <div class="input-upload mt-4">
                    <h5>Upload videos</h5>
                    <img src="{{ asset('backend/assets/imgs/theme/upload.svg') }}" alt="" />
                    <input name="videos[]" id="video_upload" class="form-control" type="file" multiple accept="video/*" />
                    <div class="new-video-preview" id="new_video_preview_container" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>
                </div>

            </div>
        </div>



        <div class="card mb-4">
            <div class="card-header">
                <h4>Organization</h4>
            </div>
            <div class="card-body">
                <div class="row gx-2">
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Category <i class="text-danger">*</i></label>
                        <select name="category_id" class="form-select" id="categorySelect">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Subcategory</label>
                        <select name="subcategory_id" class="form-select" id="subcategorySelect">
                            <option value="">Select a subcategory</option>
                            @foreach ($product->category->subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Sub-Subcategory</label>
                        <select name="sub_subcategory_id" class="form-select" id="subsubcategorySelect">
                            <option value="">Select a sub-subcategory</option>
                            @foreach ($product->subcategory ? $product->subcategory->subSubcategories : [] as $subSubcategory)
                                <option value="{{ $subSubcategory->id }}" {{ $subSubcategory->id == $product->sub_subcategory_id ? 'selected' : '' }}>{{ $subSubcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="product_tags" class="form-label">Tags</label>
                        <input name="tags" type="text" class="form-control" value="{{ old('tags', $product->tags) }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>



<script>
function deleteMedia(mediaId, mediaType) {
    if (confirm('Are you sure you want to delete this media?')) {
        // Send AJAX request to delete the media
        $.ajax({
            url: '/delete-media',
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}', // Make sure the CSRF token is correctly passed
                mediaId: mediaId,
                mediaType: mediaType
            },
            success: function(response) {
                if (response.success) {
                    $('[data-media-id="' + mediaId + '"]').remove(); // Remove the media element from the DOM
                    alert(response.message); // Show success message
                    location.reload(); // Reload the page after successful deletion
                } else {
                    alert('Error: ' + response.message); // Show error message if deletion failed
                }
            },
            error: function(xhr, status, error) {
                location.reload();
            }
        });
    }
}


document.addEventListener('DOMContentLoaded', function () {
    const mediaUploadInput = document.getElementById('media_upload');
    const videoUploadInput = document.getElementById('video_upload');
    const newImagePreviewContainer = document.getElementById('new_image_preview_container');
    const newVideoPreviewContainer = document.getElementById('new_video_preview_container');

    let currentFiles = [];
    let deleteImages = [];
    let deleteVideos = [];

    // Handle new image uploads
    mediaUploadInput.addEventListener('change', function () {
        const files = Array.from(mediaUploadInput.files);
        files.forEach((file) => {
            currentFiles.push(file);
            const reader = new FileReader();
            reader.onload = function (e) {
                const imageUrl = e.target.result;
                const imageContainer = document.createElement('div');
                imageContainer.classList.add('position-relative');
                imageContainer.style.width = '100px';
                imageContainer.style.height = '100px';

                const imgElement = document.createElement('img');
                imgElement.src = imageUrl;
                imgElement.classList.add('img-thumbnail');
                imgElement.style.width = '100%';
                imgElement.style.height = '100%';
                imgElement.style.objectFit = 'cover';

                const deleteIcon = document.createElement('span');
                deleteIcon.classList.add('position-absolute', 'top-0', 'end-0', 'bg-danger', 'text-white', 'rounded-circle', 'p-1', 'cursor-pointer');
                deleteIcon.innerHTML = '&times;';
                deleteIcon.style.cursor = 'pointer';
                deleteIcon.setAttribute('data-action', 'delete-new-image'); // Custom data for new media

                imageContainer.appendChild(imgElement);
                imageContainer.appendChild(deleteIcon);
                newImagePreviewContainer.appendChild(imageContainer);
            };
            reader.readAsDataURL(file);
        });
        updateFileInput(mediaUploadInput, currentFiles);
    });

    // Handle new video uploads
    videoUploadInput.addEventListener('change', function () {
        const files = Array.from(videoUploadInput.files);
        files.forEach((file) => {
            const videoContainer = document.createElement('div');
            videoContainer.classList.add('position-relative');
            videoContainer.style.width = '100px';
            videoContainer.style.height = '100px';

            const videoElement = document.createElement('video');
            videoElement.controls = true;
            videoElement.style.width = '100%';
            videoElement.style.height = '100%';

            const reader = new FileReader();
            reader.onload = function (e) {
                videoElement.src = e.target.result;
            };

            const deleteIcon = document.createElement('span');
            deleteIcon.classList.add('position-absolute', 'top-0', 'end-0', 'bg-danger', 'text-white', 'rounded-circle', 'p-1', 'cursor-pointer');
            deleteIcon.innerHTML = '&times;';
            deleteIcon.style.cursor = 'pointer';
            deleteIcon.setAttribute('data-action', 'delete-new-video'); // Custom data for new media

            videoContainer.appendChild(videoElement);
            videoContainer.appendChild(deleteIcon);
            newVideoPreviewContainer.appendChild(videoContainer);

            reader.readAsDataURL(file);
        });
    });

    // Event listener to handle deletion of new media
    document.addEventListener('click', function (event) {
        const target = event.target;

        // Check if clicked element is a delete icon for new media
        if (target && (target.getAttribute('data-action') === 'delete-new-image' || target.getAttribute('data-action') === 'delete-new-video')) {
            const mediaContainer = target.closest('.position-relative');
            mediaContainer.remove();
        }
    });

    // Update the file input element after file changes
    function updateFileInput(input, files) {
        const dt = new DataTransfer();
        files.forEach(file => dt.items.add(file));
        input.files = dt.files;
    }
});
</script>

<script>
    //categories dropdown
    document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('categorySelect');
    const subcategorySelect = document.getElementById('subcategorySelect');
    const subsubcategorySelect = document.getElementById('subsubcategorySelect');

    categorySelect.addEventListener('change', function () {
        const categoryId = this.value;

        subcategorySelect.innerHTML = '<option value="">Select a subcategory</option>';
        subsubcategorySelect.innerHTML = '<option value="">Select a sub-subcategory</option>';
        subcategorySelect.disabled = true;
        subsubcategorySelect.disabled = true;

        if (categoryId) {
            fetch(`/api/subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subcategory => {
                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.name;
                        subcategorySelect.appendChild(option);
                    });
                    subcategorySelect.disabled = false;
                })
                .catch(error => console.error('Error fetching subcategories:', error));
        }
    });

    subcategorySelect.addEventListener('change', function () {
        const subcategoryId = this.value;

        subsubcategorySelect.innerHTML = '<option value="">Select a sub-subcategory</option>';
        subsubcategorySelect.disabled = true;

        if (subcategoryId) {
            fetch(`/api/sub-subcategories/${subcategoryId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subSubcategory => {
                        const option = document.createElement('option');
                        option.value = subSubcategory.id;
                        option.textContent = subSubcategory.name;
                        subsubcategorySelect.appendChild(option);
                    });
                    subsubcategorySelect.disabled = false;
                })
                .catch(error => console.error('Error fetching sub-subcategories:', error));
        }
    });
});


</script>

<script>
    let variationIndex = {{ count($product->variations) }};

    function addVariation() {
        const variationsContainer = document.getElementById('variationsContainer');
        
        const newVariationRow = document.createElement('div');
        newVariationRow.className = 'row mb-3 variation-row';
        newVariationRow.innerHTML = `
            <div class="col-lg-4">
                <label class="form-label">Select Type</label>
                <select name="variations[${variationIndex}][type]" class="form-select" onchange="toggleColorInput(this)">
                    <option value="">Select</option>
                    <option value="size">Size</option>
                    <option value="color">Color</option>
                </select>
            </div>
            <div class="col-lg-4">
                <label class="form-label">Value</label>
                <input type="text" name="variations[${variationIndex}][value]" class="form-control" placeholder="Enter value" />
                <input type="color" name="variations[${variationIndex}][hex_value]" class="form-control color-input" style="display: none;" />
            </div>
            <div class="col-lg-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="variations[${variationIndex}][quantity]" class="form-control" placeholder="Qty" />
            </div>
            <div class="col-lg-1 text-center">
                <label class="form-label">Delete</label>
                <button type="button" class="btn btn-danger delete-variation" onclick="removeVariation(this)">✖</button>
            </div>
        `;
        
        variationsContainer.appendChild(newVariationRow);
        variationIndex++;
    }

    function toggleColorInput(select) {
        const colorInput = select.closest('.variation-row').querySelector('.color-input');
        const valueInput = select.closest('.variation-row').querySelector('input[name*="[value]"]');
        
        if (select.value === 'color') {
            colorInput.style.display = 'block';
            valueInput.style.display = 'none';
            valueInput.value = '';
        } else {
            colorInput.style.display = 'none';
            valueInput.style.display = 'block';
            colorInput.value = '';
        }
    }

    function removeVariation(button) {
        const variationRow = button.closest('.variation-row');
        variationRow.remove();
    }
</script>
@endsection
