@extends ('AdminDashboard.master')

@section('content')
<form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Add New Blog</h2>
            <div>
                <button type="submit" class="btn btn-md rounded font-sm hover-up">Publish</button>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Basic</h4>
            </div>
            <div class="card-body">
                <!-- The same form continues here -->
                <div class="mb-4">
                    <label for="product_name" class="form-label">Blog Title<i class="text-danger">*</i></label>
                    <input type="text" name="blog_title" placeholder="Type here" class="form-control"  />
                </div>
                <div class="mb-4">
                    <label class="form-label">Blog Text<i class="text-danger">*</i></label>
                    <textarea name="blog_text" placeholder="Type here" class="form-control" rows="8"></textarea>
                </div>
                
            </div>
        </div>
 

    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Media</h4>
            </div>
            <div class="card-body">
                <!-- Image Upload -->
                <div class="input-upload">
                    <h5>Images  <i class="text-danger">*</i></h5>
                    <img src="{{ asset('backend/assets/imgs/theme/upload.svg') }}" alt="" />
                    <input name="images[]" id="media_upload" class="form-control" type="file" multiple accept="image/*" />
                </div>
                <div class="image-preview mt-4" id="image_preview_container" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <!-- Image previews will appear here -->
                </div>

                <!-- Video Upload -->
                <div class="input-upload mt-4">
                    <h5>Videos</h5>
                    <img src="{{ asset('backend/assets/imgs/theme/upload.svg') }}" alt="" />
                    <input name="videos[]" id="video_upload" class="form-control" type="file" accept="video/*" />
                </div>
                <div class="video-preview mt-4" id="video_preview_container" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <!-- Video previews will appear here -->
                </div>
            </div>
        </div>


        
        
    </div>
</div>
</form>
 





<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mediaUploadInput = document.getElementById('media_upload');
        const videoUploadInput = document.getElementById('video_upload');
        const imagePreviewContainer = document.getElementById('image_preview_container');
        const videoPreviewContainer = document.getElementById('video_preview_container');
        let currentImageFiles = [];
        let currentVideoFile = null;

        // Image upload logic
        mediaUploadInput.addEventListener('change', function () {
            const files = Array.from(mediaUploadInput.files);
            files.forEach((file, index) => {
                currentImageFiles.push(file);
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imageUrl = e.target.result;
                    const imageContainer = document.createElement('div');
                    imageContainer.classList.add('position-relative');
                    imageContainer.style.width = '200px';
                    imageContainer.style.height = '200px';

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

                    deleteIcon.addEventListener('click', function () {
                        imageContainer.remove();
                        removeImageFromFileList(currentImageFiles.indexOf(file));
                    });

                    imageContainer.appendChild(imgElement);
                    imageContainer.appendChild(deleteIcon);
                    imagePreviewContainer.appendChild(imageContainer);
                };

                reader.readAsDataURL(file);
            });

            updateImageInput();
        });

        function removeImageFromFileList(index) {
            currentImageFiles.splice(index, 1);
            updateImageInput();
        }

        function updateImageInput() {
            const dt = new DataTransfer();
            currentImageFiles.forEach(file => {
                dt.items.add(file);
            });
            mediaUploadInput.files = dt.files;
        }

        // Video upload logic
        videoUploadInput.addEventListener('change', function () {
            const file = videoUploadInput.files[0];
            if (file) {
                if (currentVideoFile) {
                    videoPreviewContainer.innerHTML = ''; // Clear previous video preview
                }
                currentVideoFile = file;
                const videoContainer = document.createElement('div');
                videoContainer.classList.add('position-relative');
                videoContainer.style.width = '300px';
                videoContainer.style.height = '250px';  

                const videoElement = document.createElement('video');
                videoElement.src = URL.createObjectURL(file);
                videoElement.controls = true;
                videoElement.style.width = '100%';
                videoElement.style.height = '100%';

                const deleteIcon = document.createElement('span');
                deleteIcon.classList.add('position-absolute', 'top-0', 'end-0', 'bg-danger', 'text-white', 'rounded-circle', 'p-1', 'cursor-pointer');
                deleteIcon.innerHTML = '&times;';
                deleteIcon.style.cursor = 'pointer';

                deleteIcon.addEventListener('click', function () {
                    videoContainer.remove();
                    currentVideoFile = null;
                    videoUploadInput.value = '';
                });

                videoContainer.appendChild(videoElement);
                videoContainer.appendChild(deleteIcon);
                videoPreviewContainer.appendChild(videoContainer);
            }
        });
    });
</script>
@endsection
