@extends('_layouts.app')
<<<<<<< HEAD
@section('title', 'Tin tức Showbiz')
=======
@section('title', 'Quản lý tin tức')
>>>>>>> 4e034d20a3cb70a18d11f58e9d125cc93fd57d29

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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

    h1.headline {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 10px;
        line-height: 1.2;
    }

    h2.subheadline {
        font-size: 1.4rem;
        color: #555;
        font-weight: 400;
        margin-bottom: 20px;
    }

    .article-meta {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 30px;
    }

    .main-image {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .caption {
        font-size: 0.85rem;
        color: #6c757d;
        font-style: italic;
    }

    .trending-box {
        background: #f8f9fa;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        padding: 20px;
    }

    .trending-box h5 {
        font-weight: 700;
        margin-bottom: 15px;
    }

    .trending-box ul {
        list-style: none;
        padding: 0;
    }

    .trending-box li {
        margin-bottom: 12px;
        padding-left: 20px;
        position: relative;
    }

    .trending-box li:before {
        content: "▸";
        position: absolute;
        left: 0;
        color: #0d6efd;
    }

    .trending-box a {
        color: #000;
        text-decoration: none;
        font-weight: 500;
    }

    .trending-box a:hover {
        color: #0d6efd;
        text-decoration: underline;
    }

    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #212529;
    }

    .article-content p {
        margin-bottom: 1.5rem;
    }

    .related-card {
        transition: all 0.2s ease;
        cursor: pointer;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        padding: 15px;
        background: #fff;
    }

    .related-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .related-card img {
        border-radius: 6px;
        width: 100%;
        height: 150px;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .related-card h6 {
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 5px;
        color: #000;
    }

    .related-card p {
        font-size: 0.85rem;
        color: #6c757d;
        margin: 0;
    }

    .comments-section {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid #e5e5e5;
    }

    .comments-box {
        border: 1px solid #ddd;
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1.5rem;
    }

    .sidebar-sticky {
        position: sticky;
        top: 20px;
    }

    @media (max-width: 992px) {
        .news-container {
            padding: 20px;
        }
        
        h1.headline {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
<<<<<<< HEAD
<div class="news-container">
    <!-- Top: Headline -->
    <h1 class="headline">Hollywood Stars Shine at Golden Globe Awards 2025</h1>
    <h2 class="subheadline">A night of glamour and celebration as the biggest names in entertainment gather for the prestigious ceremony</h2>
    <div class="article-meta">
        By <strong>Sarah Johnson</strong> | Los Angeles, CA | January 15, 2025 | 5 min read
    </div>

    <div class="row">
        <!-- Left Column: Main Content -->
        <div class="col-lg-8">
            <!-- Area 1: Big Image + Trending -->
            <div class="row mb-4">
                <div class="col-md-7">
                    <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=700&h=500&fit=crop" class="main-image" alt="Golden Globe Awards">
                    <p class="caption">Stars walk the red carpet at the 82nd Annual Golden Globe Awards in Beverly Hills</p>
                </div>
                <div class="col-md-5">
                    <div class="trending-box">
                        <h5><i class="bi bi-fire"></i> Trending Now</h5>
                        <ul>
                            <li><a href="#">Taylor Swift announces surprise album release</a></li>
                            <li><a href="#">Brad Pitt and George Clooney reunite for new film</a></li>
                            <li><a href="#">Beyoncé breaks Grammy records</a></li>
                            <li><a href="#">Marvel reveals Phase 6 movie lineup</a></li>
                            <li><a href="#">Jennifer Lawrence expecting second child</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Area 2: News Details -->
            <div class="article-content">
                <p>The 82nd Annual Golden Globe Awards brought together Hollywood's elite for a spectacular evening of recognition and celebration. The ceremony, held at the Beverly Hilton Hotel, showcased outstanding achievements in film and television from the past year.</p>

                <p>Leading the pack with multiple wins was "Oppenheimer," which took home Best Motion Picture - Drama and Best Director for Christopher Nolan. Cillian Murphy delivered an emotional acceptance speech as he received the award for Best Actor in a Drama.</p>

                <p>"This is beyond my wildest dreams," Murphy said, visibly moved. "To work with Christopher Nolan and this incredible cast has been the highlight of my career."</p>

                <p>The television categories saw "Succession" dominating once again, with its final season earning critical acclaim and multiple awards. Sarah Snook's powerful performance earned her the award for Best Actress in a Television Drama.</p>

                <p>Fashion was another highlight of the evening, with celebrities showcasing stunning designer gowns and sharp tuxedos. Margot Robbie turned heads in a vintage-inspired Chanel piece, while Timothée Chalamet made a bold statement in custom Haider Ackermann.</p>

                <p>The night also featured memorable musical performances and heartfelt tributes to industry legends. Meryl Streep received the Cecil B. DeMille Award for her outstanding contributions to entertainment.</p>

                <h4 class="mt-4 mb-3">Key Winners:</h4>
                <ul>
                    <li><strong>Best Motion Picture - Drama:</strong> Oppenheimer</li>
                    <li><strong>Best Motion Picture - Musical or Comedy:</strong> Poor Things</li>
                    <li><strong>Best Director:</strong> Christopher Nolan (Oppenheimer)</li>
                    <li><strong>Best Actor - Drama:</strong> Cillian Murphy (Oppenheimer)</li>
                    <li><strong>Best Actress - Drama:</strong> Lily Gladstone (Killers of the Flower Moon)</li>
                    <li><strong>Best Television Series - Drama:</strong> Succession</li>
                </ul>
            </div>

            <!-- Bottom: Comments Section -->
            <div class="comments-section">
                <h4 class="fw-bold mb-3"><i class="bi bi-chat-dots"></i> Comments (24)</h4>
                <div class="comments-box">
                    <p class="mb-3"><strong>John Davis:</strong> What an incredible night! Cillian Murphy absolutely deserved that award.</p>
                    <p class="mb-3"><strong>Emma Wilson:</strong> The fashion was on point this year! Margot Robbie looked stunning.</p>
                    <p class="mb-0"><strong>Michael Brown:</strong> Succession's final season was a masterpiece. Well-deserved wins!</p>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary">Add Comment</button>
                </div>
            </div>

            <!-- More Related Stories -->
            <div class="mt-5">
                <h4 class="fw-bold mb-3">More Showbiz News</h4>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="related-card">
                            <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=300&h=150&fit=crop" alt="Story 1">
                            <h6>Met Gala 2025: The Most Daring Looks</h6>
                            <p>Fashion's biggest night returns with bold statements</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="related-card">
                            <img src="https://images.unsplash.com/photo-1598899134739-24c46f58b8c0?w=300&h=150&fit=crop" alt="Story 2">
                            <h6>Netflix Announces Star-Studded Series</h6>
                            <p>A-list cast confirmed for upcoming drama</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="related-card">
                            <img src="https://images.unsplash.com/photo-1574267432644-f74f8ec512ac?w=300&h=150&fit=crop" alt="Story 3">
                            <h6>Oscar Nominations Predictions 2025</h6>
                            <p>Who will compete for the coveted awards?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar: Related Stories -->
        <div class="col-lg-4">
            <div class="sidebar-sticky">
                <div class="trending-box mb-4">
                    <h5>Related Stories</h5>
                    <div class="related-card mb-3">
                        <img src="https://images.unsplash.com/photo-1485846234645-a62644f84728?w=300&h=150&fit=crop" alt="Related">
                        <h6>Behind the Scenes at the Golden Globes</h6>
                        <p>Exclusive photos from backstage</p>
                    </div>
                    <div class="related-card mb-3">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=300&h=150&fit=crop" alt="Related">
                        <h6>Red Carpet Fashion Breakdown</h6>
                        <p>Designer details and style analysis</p>
                    </div>
                    <div class="related-card">
                        <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=300&h=150&fit=crop" alt="Related">
                        <h6>Winners' Press Room Highlights</h6>
                        <p>What the stars said after their wins</p>
                    </div>
                </div>

                <div class="trending-box">
                    <h5>Most Popular</h5>
                    <ul>
                        <li><a href="#">Celebrity Breakups of 2025</a></li>
                        <li><a href="#">Upcoming Blockbuster Movies</a></li>
                        <li><a href="#">Inside Celebrity Mansions</a></li>
                        <li><a href="#">Hollywood Power Couples</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection