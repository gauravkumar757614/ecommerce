@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} || Blog
@endsection

@section('content')
    {{-- BREADCRUMB START --}}
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>blog</h4>
                        <ul>
                            <li><a href="#">blog</a></li>
                            <li><a href="javascript:;">blog details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- BREADCRUMB END --}}

    {{-- @dd($blog); --}}

    {{-- BLOGS DETAILS START --}}
    <section id="wsus__blog_details">
        <div class="container">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-8">
                    <div class="wsus__main_blog">
                        <div class="wsus__main_blog_img">
                            <img src="{{ asset($blog->image) }}" alt="blog" class="img-fluid w-100">
                        </div>
                        <p class="wsus__main_blog_header">
                            <span><i class="fas fa-user-tie"></i> {{ $blog->user->name }} </span>
                            <span><i class="fal fa-calendar-alt"></i> {{ date('d M Y', strtotime($blog->created_at)) }}
                            </span>
                            {{-- <span><i class="fal fa-comment-alt-smile"></i> 0 Comment</span>
                            <span><i class="far fa-eye"></i> 11 Views</span> --}}
                        </p>
                        <div class="wsus__description_area">
                            <h1> {!! $blog->title !!} </h1>

                            {!! $blog->description !!}


                        </div>
                        <div class="wsus__share_blog">
                            <p>share:</p>
                            <ul>
                                <li>
                                    <a
                                        class="facebook"href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="twitter"
                                        href="https://twitter.com/share?url={{ url()->current() }}&text={{ $blog->title }}">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="linkedin"
                                        href="https://www.linkedin.com/shareArticle?url={{ url()->current() }}&title={{ $blog->title }}&summary={{ limitText($blog->description, 50) }}">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                                {{-- <li>
                                    <a class="pinterest" href="#">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                        {{-- If there is not related blogs post to current one --}}
                        @if (count($recentBlogs) != 0)
                            <div class="wsus__related_post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <h5>recent post</h5>
                                    </div>
                                </div>

                                {{-- Recently added posts slider --}}
                                <div class="row blog_det_slider">
                                    @foreach ($recentBlogs as $recentBlog)
                                        <div class="col-xl-3">
                                            <div class="wsus__single_blog wsus__single_blog_2">
                                                <a class="wsus__blog_img"
                                                    href="{{ route('blog-details', $recentBlog->slug) }}">
                                                    <img src="{{ asset($recentBlog->image) }}" alt="blog"
                                                        class="img-fluid w-100">
                                                </a>
                                                <div class="wsus__blog_text">
                                                    <a class="blog_top red"
                                                        href="#">{{ $recentBlog->category->name }}</a>
                                                    <div class="wsus__blog_text_center">
                                                        <a href="{{ route('blog-details', $recentBlog->slug) }}">
                                                            {!! limitText(@$recentBlog->title, 20) !!}
                                                        </a>
                                                        <p class="date">
                                                            {{ date('M D Y', strtotime($recentBlog->created_at)) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        {{-- Recently added posts slider end --}}



                        <div class="wsus__comment_area">
                            <h4>comment <span> {{ count($comments) }} </span></h4>

                            @foreach ($comments as $comment)
                                <div class="wsus__main_comment">
                                    <div class="wsus__comment_img">
                                        <img src="{{ $comment->user->image }}" alt="user" class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__comment_text replay">
                                        <h6> {{ $comment->user->name }}
                                            <span>{{ date('d M Y', strtotime($comment->created_at)) }}</span>
                                        </h6>

                                        <p>
                                            {!! $comment->comment !!}
                                        </p>

                                    </div>
                                </div>
                            @endforeach


                            @if (count($comments) === 0)
                                <i>Be the first one to comment</i>
                            @endif

                            <div id="pagination">
                                @if ($comments->hasPages())
                                    {{ $comments->withQueryString()->links() }}
                                @endif
                            </div>
                        </div>

                        <div class="wsus__post_comment">
                            <h4>post a comment</h4>
                            {{-- Comment form --}}
                            @if (auth()->check())
                                <form action="{{ route('user.blog-comment') }}" method="POST">
                                    @csrf
                                    <div class="row">

                                        <div class="col-xl-12">
                                            <div class="wsus__single_com">
                                                <textarea rows="5" placeholder="Your Comment" name="comment"></textarea>
                                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                            </div>
                                        </div>

                                    </div>
                                    <button class="common_btn" type="submit">post comment</button>
                                </form>
                            @else
                                <h6>Login to comment on post!</h6>
                                <a href="{{ route('login') }}" class="common_btn mt-3">Login</a>
                            @endif
                            {{-- Comment form end --}}

                        </div>
                    </div>
                </div>

                {{-- Blogs search  --}}
                <div class="col-xxl-3 col-xl-4 col-lg-4">
                    <div class="wsus__blog_sidebar" id="sticky_sidebar">
                        <div class="wsus__blog_search">
                            <h4>search</h4>
                            <form action="{{ route('blog') }}" method="GET">
                                <input type="text" placeholder="Search" name="search">
                                <button type="submit" class="common_btn"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                        <div class="wsus__blog_category">
                            <h4>Categories</h4>
                            <ul>
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('blog', ['category' => $category->slug]) }}">
                                            {{ $category->name }} </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="wsus__blog_post">
                            <h4>More Posts</h4>
                            @foreach ($moreBlogs as $moreBlog)
                                <div class="wsus__blog_post_single">
                                    <a href="{{ route('blog-details', $moreBlog->slug) }}" class="wsus__blog_post_img">
                                        <img src="{{ asset($moreBlog->image) }}" alt="blog" class="imgofluid w-100">
                                    </a>
                                    <div class="wsus__blog_post_text">
                                        <a href="{{ route('blog-details', $moreBlog->slug) }}">
                                            {{ limitText($moreBlog->title, 20) }}
                                        </a>
                                        <p> <span>{{ date('d M Y', strtotime($moreBlog->created_at)) }} </span>
                                            {{ count($moreBlog->comments) }} comments
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- Blogs search end --}}
            </div>
        </div>
    </section>
    {{-- BLOGS DETAILS END --}}
@endsection
