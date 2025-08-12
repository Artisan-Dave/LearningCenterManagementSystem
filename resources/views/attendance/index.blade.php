<h2>Mark Attendance</h2>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<form action="{{ route('attendance.store') }}" method="POST">
    @csrf

    <label for="date">Select Date:</label>
    <input type="date" name="date" required value="{{ date('Y-m-d') }}">

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Late</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td><input type="radio" name="attendances[{{ $user->id }}]" value="present" required></td>
                    <td><input type="radio" name="attendances[{{ $user->id }}]" value="absent"></td>
                    <td><input type="radio" name="attendances[{{ $user->id }}]" value="late"></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit">Save Attendance</button>
</form>
