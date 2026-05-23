<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <style>
        body { min-height: 100vh; margin: 0; display: grid; place-items: center; font-family: Inter, ui-sans-serif, system-ui, sans-serif; background: #f5f8fb; color: #14213d; }
        form { width: min(380px, 92vw); background: #fff; border: 1px solid #d9e2ec; border-radius: 8px; padding: 22px; }
        input { width: 100%; border: 1px solid #d9e2ec; border-radius: 6px; padding: 11px; box-sizing: border-box; margin: 8px 0 14px; }
        button { border: 0; border-radius: 6px; background: #167c54; color: #fff; padding: 11px 14px; font-weight: 900; cursor: pointer; }
        .error { color: #d7263d; }
    </style>
</head>
<body>
    <form method="post" action="{{ route('admin.authenticate') }}">
        @csrf
        <h1>Admin Login</h1>
        @error('password')<p class="error">{{ $message }}</p>@enderror
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
