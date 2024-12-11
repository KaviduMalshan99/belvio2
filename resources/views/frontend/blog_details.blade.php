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
</style>
<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Blog</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('blogs') }}">Blogs</a></li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.page-title -->

<!-- Blog posts -->
<section class="blog-posts blog-detail">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="post-wrap detail">
                    <article class="post clearfix">

                        <div class="title-post">
                            <h2 style="color:white">{{ $blog->title }}</h2>
                        </div><!-- /.title-post -->

                        <div class="content-post">
                            <ul class="meta-post">
                                <li class="author padding-left-2">
                                    <span>Posted By: Admin</span>
                                </li>

                                <li class="date">
                                    <span>Date: {{ $blog->created_at->format('d/m/Y') }}</span>
                                </li>
                            </ul><!-- /.meta-post -->

                            @if ($blog->media && (count($blog->media['images']) > 0 || count($blog->media['videos']) > 0))
                            <!-- Media exists (images or videos) -->

                            <!-- Blog Images and Videos Slider -->
                            <div id="carousel-{{ $blog->id }}" class="carousel slide" data-bs-ride="carousel" style="height:500px;">
                                <div class="carousel-inner">
                                    @foreach ($blog->media['images'] as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Blog Image" style="width: 100%; height: 500px; object-fit: cover;">
                                    </div>
                                    @endforeach
                                    @foreach ($blog->media['videos'] as $video)
                                    <div class="carousel-item">
                                        <video controls style="width: 100%; height: 500px;">
                                            <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
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

                            <div class="entry-post mt-2">
                                <p>{{ $blog->text ?? 'N/A' }}</p>
                            </div>
                        </div><!-- /.content-post -->

                        <div class="direction">
                            <ul class="next-pre clearfix">
                                <!-- Previous Blog -->
                                @if ($previous = App\Models\Blog::where('id', '<', $blog->id)->where('status', 'Active')->orderBy('id', 'desc')->first())
                                    <li>
                                        <div class="pre-content">
                                            <div class="btn-default btn-pre">
                                                <a href="{{ route('blog.show', $previous->id) }}"><i class="fa fa-chevron-left"></i></a>
                                            </div>
                                            <div class="text text-pre">
                                                <span>Previous Reading</span>
                                                <h4><a href="{{ route('blog.show', $previous->id) }}" style="color:lightgray;">{{ $previous->title }}</a></h4>
                                            </div>
                                        </div>
                                    </li>
                                    @else
                                    <li>
                                        <div class="pre-content">
                                            <br />
                                            <br />
                                        </div>
                                    </li>
                                    @endif

                                    <!-- Next Blog -->
                                    @if ($next = App\Models\Blog::where('id', '>', $blog->id)->where('status', 'Active')->orderBy('id', 'asc')->first())
                                    <li>
                                        <div class="next-content ">
                                            <div class="btn-default btn-next">
                                                <a href="{{ route('blog.show', $next->id) }}"><i class="fa fa-chevron-right"></i></a>
                                            </div>
                                            <div class="text text-next text-right">
                                                <span>Next Reading</span>
                                                <h4><a href="{{ route('blog.show', $next->id) }}" style="color:lightgray;">{{ $next->title }}</a></h4>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                            </ul>
                        </div><!-- /.direction -->
                    </article><!-- /.post -->
                </div><!-- /.post-wrap -->
            </div><!-- /.col-md-10 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog posts -->

@endsection