<!DOCTYPE html>
<html>
<body>
    <h1>New Comment Received</h1>
    <p>A new comment has been added to your blog:</p>
    <p>Name: {{ $comment->name }}</p>
    <p>Comment: {{ $comment->content }}</p>
    <p>Posted At: {{ $comment->created_at->format('F j, Y \a\t g:i a') }}</p>
    <p>Give it some attention and approve it ^^</p>
    <p>Thanks, {{ config('app.name') }}</p>
</body>
</html>
