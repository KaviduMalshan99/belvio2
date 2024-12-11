@extends ('AdminDashboard.master')

@section('content')

<style>
    .position-absolute {
    position: absolute;
}
.top-0 {
    top: 0;
}
.end-0 {
    right: 0;
}
.bg-danger {
    background-color: #dc3545;
}
.text-white {
    color: #fff;
}
.rounded-circle {
    border-radius: 50%;
}
.p-1 {
    padding: 0.25rem;
}

</style>


<div class="container">
    <form method="POST" action="{{ route('blog.update', $blog->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-12">
                <div class="content-header">
                    <h2 class="content-title">Edit Blog</h2>
                    <div>
                        <button type="submit" class="btn btn-md rounded font-sm hover-up">Update</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Basic</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="blog_title" class="form-label">Blog Title<i class="text-danger">*</i></label>
                            <input type="text" name="blog_title" value="{{ $blog->title }}" class="form-control" required />
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Blog Text<i class="text-danger">*</i></label>
                            <textarea name="blog_text" class="form-control" rows="8" required>{{ $blog->text }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Status<i class="text-danger">*</i></label>
                            <select name="status" class="form-control">
                                <option value="Active" {{ $blog->status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ $blog->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
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
                        <!-- Existing Images -->
                        <div class="mb-4">
                            <h5>Existing Images</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($blog->media['images'] as $image)
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $image) }}" alt="" class="img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                        <input type="checkbox" name="delete_images[]" value="{{ $image }}" class="" style="cursor: pointer;"> Remove
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Upload New Images -->
                        <div class="mb-4">
                            <h5>Upload New Images</h5>
                            <input type="file" name="images[]" id="new_images_input" class="form-control" multiple accept="image/*">
                            <div id="new_image_previews" class="mt-3 d-flex gap-2 flex-wrap">
                                <!-- Previews for new images will be displayed here -->
                            </div>
                        </div>

                        <!-- Existing Videos -->
                        <div class="mb-4">
                            <h5>Existing Videos</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($blog->media['videos'] as $video)
                                    <div class="position-relative">
                                        <video src="{{ asset('storage/' . $video) }}" controls class="img-thumbnail" style="width: 300px; height: 250px;"></video>
                                        <input type="checkbox" name="delete_videos[]" value="{{ $video }}" class="" style="cursor: pointer;"> Remove
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Upload New Videos -->
                        <div class="mb-4">
                            <h5>Upload New Videos</h5>
                            <input type="file" name="videos[]" id="new_videos_input" class="form-control" accept="video/*">
                            <div id="new_video_previews" class="mt-3 d-flex gap-2 flex-wrap">
                                <!-- Previews for new videos will be displayed here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Preview for new images
        const newImagesInput = document.getElementById('new_images_input');
        const newImagePreviews = document.getElementById('new_image_previews');

        newImagesInput.addEventListener('change', function () {
            newImagePreviews.innerHTML = ''; // Clear existing previews
            const files = Array.from(newImagesInput.files);

            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.style.width = '200px';
                    imgElement.style.height = '200px';
                    imgElement.style.objectFit = 'cover';
                    imgElement.classList.add('img-thumbnail');
                    newImagePreviews.appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            });
        });

        // Preview for new videos
        const newVideosInput = document.getElementById('new_videos_input');
        const newVideoPreviews = document.getElementById('new_video_previews');

        newVideosInput.addEventListener('change', function () {
            newVideoPreviews.innerHTML = ''; // Clear existing previews
            const files = Array.from(newVideosInput.files);

            files.forEach(file => {
                const videoElement = document.createElement('video');
                videoElement.src = URL.createObjectURL(file);
                videoElement.controls = true;
                videoElement.style.width = '300px';
                videoElement.style.height = '250px';
                newVideoPreviews.appendChild(videoElement);
            });
        });
    });
</script>
@endsection
