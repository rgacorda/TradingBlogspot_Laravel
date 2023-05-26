@extends('master_layout.master_layout')
@section('content')
    <h1>Search Results for "{{ $query }}"</h1>

    <div class="container">
        <div class="container">
            <div class="row">
                <hr>
                <h2 class="col-10">All Posts</h2>
                <div class="col-2">
                    <a class="blog-header-logo text-dark" href="/">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Go Back</button>
                    </a>
                </div>
                <hr>
            </div>
            @if ($user_posts->count())
                <h2>Search results by user name:</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Author</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_posts as $post)
                                <tr>
                                    <td class="col-8">{{ $post->title }}</td>
                                    <td class="col-3">{{ $post->content }}</td>
                                    <td class="col-3">{{ $post->first_name }} {{ $post->middle_name }}
                                        {{ $post->last_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $user_posts->appends(request()->query())->links('pagination::bootstrap-5') !!}
                @else
                    <p>No search results by Username found.</p>
            @endif
            @if ($title_posts->count())
                <h2>Search results by post title:</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($title_posts as $post)
                                <tr>
                                    <td class="col-8"><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $title_posts->appends(request()->query())->links('pagination::bootstrap-5') !!}
                @else
                    <p>No search results by Title found.</p>
            @endif
            @if ($content_posts->count())
                <h2>Search results by post content:</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($content_posts as $post)
                                <tr>
                                    <td class="col-8"><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                                    </td>
                                    <td class="col3">{{ $post->content }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $content_posts->appends(request()->query())->links('pagination::bootstrap-5') !!}
                @else
                    <p>No search results by Content found.</p>
            @endif
            @if ($category_posts->count())
                <h2>Search results by category description:</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category_posts as $post)
                                <tr>
                                    <td class="col-8"><a
                                            href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                                    </td>
                                    <td class="col-4">{{ $post->content }}</td>
                                    <td class="col-2">{{ $post->cat_desc }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $category_posts->appends(request()->query())->links('pagination::bootstrap-5') !!}
                @else
                    <p>No search results by Category found.</p>
            @endif

        </div>
    </div>

@endsection
