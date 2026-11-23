<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Course</title>
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
    <h1>Create Course</h1>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/courses" method="POST">
        @csrf

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">

        <label for="description">Description</label>
        <textarea id="description" name="description">{{ old('description') }}</textarea>

        <label for="duration">Duration (weeks)</label>
        <input type="number" id="duration" name="duration" min="1" value="{{ old('duration') }}">

        <label for="fee">Fee</label>
        <input type="number" id="fee" name="fee" step="0.01" min="0" value="{{ old('fee') }}">

        <label for="difficulty">Difficulty</label>
        <select id="difficulty" name="difficulty">
            @foreach (['Easy', 'Medium', 'Hard'] as $level)
                <option value="{{ $level }}" @selected(old('difficulty') === $level)>{{ $level }}</option>
            @endforeach
        </select>

        <label>
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true))>
            Active
        </label>

        <p>
            <button type="submit">Create Course</button>
            <a href="/courses">Cancel</a>
        </p>
    </form>
</body>
</html>
