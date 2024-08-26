<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
        }

        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .button-container a {
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
        }

        .button-container a:hover {
            background-color: #0056b3;
        }

        .post-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .post {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }

        .post h2 {
            margin-top: 0;
            color: #007bff;
        }

        .post p {
            color: #333;
            line-height: 1.6;
        }

        .post-actions {
            margin-top: 20px;
            text-align: right;
        }

        .post-actions a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
            font-weight: bold;
        }

        .post-actions button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .post-actions button:hover {
            background-color: #c82333;
        }

        .comment-section {
            margin-top: 20px;
        }

        .comment-form {
            margin-top: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
        }

        .comment-form textarea {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .comment-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .comment-form button:hover {
            background-color: #0056b3;
        }

        .comment {
            margin-top: 10px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .comment p {
            margin: 0;
        }

        .comment-time {
            font-size: 0.8em;
            color: #888;
        }
    </style>
</head>
<body>
    <h1>All Posts</h1>

    <div class="button-container">
        <a href="{{ route('posts.create') }}">Create New Post</a>
    </div>
    
    <div class="post-container">
        @foreach($posts as $post)
        <div class="post">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <div class="post-actions">
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this post?');" style="display: inline;">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </div>

            <!-- Section for comments -->
            <div class="comment-section">
                <div class="comment-form">
                    <form action="{{ route('comments.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <textarea name="content" rows="3" placeholder="Write a comment..." required></textarea> <br>
                        <button type="submit">Add Comment</button>
                    </form>
                </div>

                <!-- Display comments -->
                @foreach($post->comments as $comment)
                <div class="comment">
                    <p>{{ $comment->content }}</p>
                    <span class="comment-time">{{ $comment->created_at->format('Y-m-d H:i:s') }}</span>

                    <form action="{{ route('comments.destroy', $comment->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this comment?');" style="display: inline;">
                      @method('DELETE')
                      @csrf
                      <button type="submit">Delete</button>
                    </form>

                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>
