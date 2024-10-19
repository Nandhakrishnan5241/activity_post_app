<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    button {
        height: 50px;

    }
</style>

<body>
    <div class="d-flex justify-content-end">
        <a href="#" class="navbar-brand"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="container">
        <h1>What I Did Interesting Today</h1>
        <form action="/posts" method="POST" class="row g-3">
            @csrf
            {{-- <div class="col-md-12 pb-2">
                <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
            </div> --}}


            <div class="col-md-12 pb-2">
                <textarea class="form-control" id="body" name="body" rows="5" placeholder="Write your post here" required></textarea>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Post</button>
            </div>
        </form>

        <hr>

        @foreach ($posts as $post)
            @php
                $nameParts = explode(' ', $post->user->name);
                $initials = strtoupper($nameParts[0][0] . (isset($nameParts[1]) ? $nameParts[1][0] : ''));
            @endphp
            <div class="card border-dark  mb-4" style="border-radius: 16px">
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-8 col-md-6 col-sm-3 d-flex"><span class="badge"
                                style="background-color: rgb(226, 24, 159); width : 60px; height : 60px; color : white; padding : 14px; font-size : 25px;  border-radius : 50%; text-transform: uppercase;">{{ $initials }}</span>
                            <h3 class="p-2">{{ $post->user->name }}</h3>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-9 d-flex justify-content-end">
                            <form action="/likes" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <button type="submit" class="btn btn-outline-primary mr-2">
                                    Like ({{ $post->likes->count() }})
                                </button>
                            </form>
                            <button id="commentButton-{{ $post->id }}" class="btn btn-outline-success"
                                onclick="toggleComments({{ $post->id }},{{ $post->comments->count() }})">Show
                                Comments({{ $post->comments->count() }})</button>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col py-3">
                            <h5>{{ $post->body }}</h5>
                        </div>
                    </div>
                </div>


                <div id="commentSection-{{ $post->id }}" class="card-footer" style="display: none;">
                    <h4>Comments ({{ $post->comments->count() }})</h4>
                    <ul class="list-group mb-3">
                        @foreach ($post->comments as $comment)
                            <li class="list-group-item">
                                {{ $comment->comment }}
                                <span class="text-muted">- by {{ $comment->user->name }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <form action="/comments" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="mb-3">
                            <textarea name="comment" class="form-control" rows="3" placeholder="Add a comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Comment</button>
                    </form>
                </div>
            </div>

            <hr>
        @endforeach

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleComments(postId, count) {
            var commentSection = $('#commentSection-' + postId);
            var commentButton = $('#commentButton-' + postId);

            commentSection.toggle();

            if (commentSection.is(':visible')) {
                commentButton.text('Hide Comments');
            } else {
                commentButton.text('Show Comments(' + count + ')');
            }
        }
    </script>




</body>

</html>
