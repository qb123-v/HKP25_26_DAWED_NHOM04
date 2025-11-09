@extends('_layouts.app')
@section('title', 'Chi tiết tin tức')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #fff;
            font-family: "Helvetica Neue", Arial, sans-serif;
        }

        .news-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 50px 40px;
        }

        h1 {
            font-size: 2.6rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        h5 {
            font-size: 1.25rem;
            color: #555;
        }

        .breadcrumb {
            font-size: 0.9rem;
        }

        .breadcrumb a {
            text-decoration: none;
            color: #007bff;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .article-meta {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .caption {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .social-icons a {
            font-size: 1.3rem;
            color: #333;
            margin-right: 15px;
        }

        .social-icons a:hover {
            color: #0d6efd;
        }

        .article-content {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #212529;
        }

        .sidebar {
            position: sticky;
            top: 20px;
        }

        .sidebar .border {
            border: 1px solid #e5e5e5 !important;
        }

        .trending li {
            margin-bottom: 8px;
        }

        .trending a {
            color: #000;
            text-decoration: none;
        }

        .trending a:hover {
            text-decoration: underline;
        }

        .related-card {
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .related-card:hover {
            transform: translateY(-3px);
        }

        .related-card img {
            border-radius: 8px;
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .related-card h6 {
            font-weight: 600;
            font-size: 0.95rem;
            margin-top: 8px;
            margin-bottom: 5px;
            color: #000;
        }

        .related-card p {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .comments-section {
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px solid #ddd;
        }

        .comments-box {
            border: 1px solid #ddd;
            background: #f8f9fa;
            border-radius: 6px;
            padding: 1.25rem;
        }

        /* Small comment box in sidebar */
        .sidebar .comments-box {
            padding: 0.75rem;
            font-size: 0.85rem;
        }

        @media (min-width: 1200px) {
            .col-article {
                flex: 0 0 72%;
                max-width: 72%;
            }

            .col-sidebar {
                flex: 0 0 28%;
                max-width: 28%;
                padding-left: 40px;
            }
        }

        @media (max-width: 992px) {
            .news-container {
                padding: 20px;
            }

            .col-sidebar {
                padding-left: 0 !important;
                margin-top: 40px;
            }
        }
    </style>
@endpush

@section('content')
<div class="news-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">World</a></li>
            <li class="breadcrumb-item"><a href="#">Category</a></li>
            <li class="breadcrumb-item active" aria-current="page">Subcategory</li>
        </ol>
    </nav>

    <!-- Headline -->
    <h1>Headline</h1>
    <h5>Subheadline / Dek</h5>
    <div class="article-meta mb-3">
        By <strong>Author</strong> | Location | Date | X min read
    </div>

    <!-- Main image -->
    <div class="mb-3">
        <img src="https://via.placeholder.com/1300x550" class="img-fluid rounded" alt="Main Image">
        <p class="caption mt-2">Caption text goes here</p>
    </div>

    <!-- Social icons -->
    <div class="social-icons mb-4">
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-twitter"></i></a>
        <a href="#"><i class="bi bi-envelope"></i></a>
        <a href="#"><i class="bi bi-printer"></i></a>
    </div>

    <div class="row">
        <!-- Main article -->
        <div class="col-12 col-lg-9 col-article">
            <div class="article-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat,
                    sapien ultrices fermentum congue, quam velit venenatis sem, id sodales eros lorem eget orci.</p>
                <p>Vivamus at erat in ligula suscipit imperdiet. Cras imperdiet ligula a magna fermentum, non vestibulum sem
                    faucibus.</p>
                <p>Suspendisse potenti. Curabitur faucibus turpis a nisl luctus, sed luctus erat bibendum. Quisque vehicula
                    dui in tellus tincidunt, at tempus elit eleifend.</p>

                <!-- Related stories (main content) -->
                <h5 class="mt-5 fw-bold">Related stories</h5>
                <div class="row row-cols-1 row-cols-md-3 g-3 mt-2">
                    <div class="col">
                        <div class="related-card">
                            <img src="https://via.placeholder.com/300x180" alt="Story 1">
                            <h6>Climate summit draws global attention</h6>
                            <p>Leaders from around the world gather to discuss urgent climate issues.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="related-card">
                            <img src="https://via.placeholder.com/300x180" alt="Story 2">
                            <h6>Economic growth slows in Q3</h6>
                            <p>New data shows a moderate slowdown, raising questions about next year's outlook.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="related-card">
                            <img src="https://via.placeholder.com/300x180" alt="Story 3">
                            <h6>Breakthrough in medical research</h6>
                            <p>Scientists report progress in developing a new treatment for chronic diseases.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-lg-3 col-sidebar sidebar">
            <!-- Trending -->
            <div class="border rounded p-3 mb-4 trending">
                <h6 class="fw-bold">Trending</h6>
                <ul class="list-unstyled mb-0">
                    <li><a href="#">Top story 1</a></li>
                    <li><a href="#">Top story 2</a></li>
                    <li><a href="#">Top story 3</a></li>
                    <li><a href="#">Top story 4</a></li>
                    <li><a href="#">Top story 5</a></li>
                </ul>
            </div>

            <!-- Related stories nhỏ -->
            <div class="border rounded p-3 mb-4">
                <h6 class="fw-bold">Related stories</h6>
                <p class="small fw-semibold mb-0">Another related article headline</p>
            </div>

            <!-- Comment box tách riêng -->
            <div class="border rounded p-3 comments-box">
                <h6 class="fw-bold">Comments</h6>
                <p class="text-muted mb-0 small">No comments yet. Be the first to comment!</p>
            </div>
        </div>
    </div>
</div>
@endsection
