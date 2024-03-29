<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-between my-3">
            <h5 class="text-center my-3">Post List</h5>
            <form action="{{ route('posts.index') }}" method="get" class="form-inline d-flex justify-content-between">
                @csrf
                <input type="text" name="search" placeholder="Search Post..." class="form-control">
                <input type="submit" class="btn bg-primary ms-2" value="Search">
            </form>
        </div>
        @foreach($posts as $post)
            <div class="col-md-3">
                <div class="card px-4 py-4 shadow mb-3" style="min-height: 160px;">
                    <div class="card-boy">
                        <h6 class="card-title">{{ $post->title }}</h6>
                        <div class="text-primary small">{{ $post->category->title }}</div>
                        <div class="card-text">{{ \Illuminate\Support\Str::limit($post->description,50) }}...</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
