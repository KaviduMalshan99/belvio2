@extends ('frontend.master')

@section('content')

<style>
    /* Custom styles for carousel buttons */
    .carousel-control-prev,
    .carousel-control-next {
        background-color: rgba(0, 0, 0, 0.2);
        /* Dark background */
        padding: 10px;
        /* Space around the icon */
        transition: background-color 0.3s ease;
        /* Smooth transition for background */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        font-size: 30px;
        /* Larger icons */
        color: white;
        /* White icon color */
    }

    /* Change button color on hover */
    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background-color: rgba(0, 0, 0, 0.5);
        /* Darker background on hover */
    }

    /* Optional: Add a box shadow for a more modern look */
    .carousel-control-prev,
    .carousel-control-next {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .product-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 30px;
    }

    .product-pagination .page-link {
        color: black;     
        border: 1px solid #63ff66; 
        margin: 0 3px; 
        transition: background-color 0.3s, color 0.3s; 
    }

    .product-pagination .page-link:hover {
        background-color: #63ff66; 
        color: #fff; 
    }

    .product-pagination .page-item.active .page-link {
        background-color: #63ff66; 
        color: black; 
        border-color: #63ff66; 
    }

    .product-content .product-item {
    position: relative;
}
</style>

<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Blogs</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('blogs')}}">Blogs</a></li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.page-title -->

<!-- Blog posts -->
<section class="blog-posts grid-posts">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="post-wrap margin-bottom-26">
                    <div class="grid three">
                        @if ($blogs->isEmpty())
                            <div class="col-12 text-center">
                                <p>No blogs available at the moment. Please check back later.</p>
                            </div>
                        @else
                        @foreach ($blogs as $blog)
                        <article class="post clearfix">
                            <div class="featured-post">
                                @if ($blog->media && (count($blog->media['images']) > 0 || count($blog->media['videos']) > 0))
                                <!-- Media exists (images or videos) -->
                                <!-- Display blog media as a slideshow -->
                                <div id="carousel-{{ $blog->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($blog->media['images'] as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Blog Image" style="width: 100%; height: 300px; object-fit: cover;">
                                        </div>
                                        @endforeach
                                        @foreach ($blog->media['videos'] as $video)
                                        <div class="carousel-item">
                                            <video controls style="width: 100%; height: 300px;">
                                                <source src="{{ asset('storage/' . $video) }}" type="video/mp4" style="width: 100%; height: 300px; object-fit: cover;">
                                            </video>
                                        </div>
                                        @endforeach
                                    </div>
                                    @if (count($blog->media['images']) + count($blog->media['videos']) > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $blog->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true" style="font-size: 30px; color: white;"></span>
                                        <span class="visually-hidden"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $blog->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true" style="font-size: 30px; color: white;"></span>
                                        <span class="visually-hidden"></span>
                                    </button>

                                    @endif
                                </div>
                                @else
                                <!-- No media -->
                                <img src="{{ asset('images/blogdemo.png') }}" alt="Blog Image" style="width: 100%; height: 300px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="content-post">
                                <div class="title-post">
                                    <h2><a href="{{ route('blog.show', $blog->id) }}" style="color:white;">{{ $blog->title }}</a></h2>
                                </div><!-- /.title-post -->
                                <div class="entry-post">
                                   <p>{{ Str::limit($blog->text, 40, '....') }}</p>
                                    <div class="more-link">
                                        <a href="{{ route('blog.show', $blog->id) }}">Read More</a>
                                    </div>
                                </div>
                            </div><!-- /.content-post -->
                        </article><!-- /.post -->
                        @endforeach
                        @endif


                    </div><!-- /.grid -->
                </div><!-- /.post-wrap -->
                <!-- Pagination -->
            <div class="product-pagination text-center clearfix">
                {{ $blogs->links('pagination::bootstrap-4') }}
            </div>
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog posts -->


@endsection