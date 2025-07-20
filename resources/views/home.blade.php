<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @auth
     <h3>Congrats you are logged in</h3>
     <form action="/logout" method="post">
        @csrf
        <button>Log out</button>
    </form>

    <div style="border: 2px solid black;padding: 20px;margin-bottom: 20px">
        <h2>Create a New Post</h2>
        <form action="/create-post" method="post">
            @csrf
            <input type="text" name="title" placeholder="post title">
            <textarea name="body" placeholder="body content..."></textarea>
            <button>Create Post</button>
        </form>
    </div>

    <div style="border: 2px solid black;padding: 20px;margin-bottom: 20px">
        <h2>All Posts</h2>
        @foreach ($posts as $post)
        <div style="background: rgb(206, 201, 201);margin: 10px;padding:10px">
            <h4>{{ $post['title'] }} by {{$post->user->email}}</h4>
            {{ $post['body'] }}

            <p><a href="/edit-post/{{ $post->id }}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="post">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
            
        @endforeach
    </div>

    @else

    <h1>My Testing View is here</h1>
    <div style="border: 2px solid black;padding: 20px;margin-bottom: 20px">
        <h2>Register User</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="Username">
            <input name="email" type="text" placeholder="Email">
            <input name="password" type="password" placeholder="Password">
            <button>Register</button>
        </form>

    </div>

    <div style="border: 2px solid black;padding: 20px">
        <h2>Login User</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginemail" type="text" placeholder="Email">
            <input name="loginpassword" type="password" placeholder="Password">
            <button>Login</button>
        </form>

    </div>

    @endauth

</body>
</html>