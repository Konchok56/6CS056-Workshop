<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students</title>
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
    <h1>Students</h1>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <a href="/student/create">Create Student</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>
                        <a href="/students/{{ $student->id }}">View</a>
                        <a href="/students/{{ $student->id }}/edit">Edit</a>
                        <form action="/students/{{ $student->id }}" method="POST" class="inline"
                              onsubmit="return confirm('Are you sure you want to delete this record?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No students found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
