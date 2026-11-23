<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Details</title>
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
    <h1>Student Details</h1>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <p><strong>ID:</strong> {{ $student->id }}</p>
    <p><strong>Name:</strong> {{ $student->name }}</p>
    <p><strong>Email:</strong> {{ $student->email }}</p>
    <p><strong>Phone:</strong> {{ $student->phone }}</p>
    <p><strong>Address:</strong> {{ $student->address }}</p>
    <p><strong>Date of Birth:</strong> {{ $student->date_of_birth }}</p>

    <a href="/students/{{ $student->id }}/edit">Edit Student</a>
    <a href="/students">Back to Students</a>
</body>
</html>
