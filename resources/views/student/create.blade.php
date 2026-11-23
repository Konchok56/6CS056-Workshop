<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Student</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 960px; margin: 24px auto; padding: 0 16px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .success { background: #e6f4ea; color: #137333; padding: 10px; }
        .errors { background: #fce8e6; color: #c5221f; padding: 10px; }
        label { display: block; margin-top: 12px; }
        input, textarea, select { width: 100%; max-width: 400px; padding: 6px; }
        input[type="checkbox"] { width: auto; }
        form.inline { display: inline; }
    </style>
</head>
<body>
    <h1>Create Student</h1>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/students" method="POST">
        @csrf

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">

        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}">

        <label for="address">Address</label>
        <textarea id="address" name="address">{{ old('address') }}</textarea>

        <label for="date_of_birth">Date of Birth</label>
        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">

        <p>
            <button type="submit">Create Student</button>
            <a href="/students">Cancel</a>
        </p>
    </form>
</body>
</html>
