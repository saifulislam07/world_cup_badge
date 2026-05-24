<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <style>
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; display: grid; place-items: center; font-family: Inter, ui-sans-serif, system-ui, sans-serif; background: linear-gradient(135deg, #063d2a, #005eb8); color: #101828; }
        form { width: min(400px, 92vw); background: #fff; border: 1px solid #d0d5dd; border-radius: 8px; padding: 26px; box-shadow: 0 24px 56px rgba(0,0,0,.22); }
        .mark { width: 46px; height: 46px; display: grid; place-items: center; border-radius: 50%; color: #fff; font-weight: 950; background: linear-gradient(135deg, #007a3d, #005eb8); }
        h1 { margin: 14px 0 18px; font-size: 28px; }
        input { width: 100%; border: 1px solid #d0d5dd; border-radius: 6px; padding: 12px; margin: 8px 0 16px; outline: none; }
        input:focus { border-color: #007a3d; box-shadow: 0 0 0 4px rgba(0, 122, 61, .12); }
        button { width: 100%; border: 0; border-radius: 6px; background: linear-gradient(135deg, #007a3d, #005eb8); color: #fff; padding: 12px 14px; font-weight: 900; cursor: pointer; }
        .error { color: #d62839; font-weight: 800; }
    </style>
</head>
<body>
    <form method="post" action="{{ route('admin.authenticate') }}">
        @csrf
        <div class="mark">26</div>
        <h1>Admin Login</h1>
        @error('password')<p class="error">{{ $message }}</p>@enderror
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
