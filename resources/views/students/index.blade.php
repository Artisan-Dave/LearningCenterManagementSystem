<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Student</h1>
    <a href="{{route('dashboard')}}">Go back to Dashboard</a>
    <div>
        <table border="1">
             <tr>
                <th>ID</th>
                <th>FIRST NAME</th>
                <th>MIDDLE NAME</th>
                <th>LAST NAME</th>
                <th>ACTION</th>
             </tr>
             @foreach ($students as $student)
                 <tr>
                    <td>{{$student->id}}</td>
                    <td>{{$student->firstname}}</td>
                    <td>{{$student->middlename}}</td>
                    <td>{{$student->lastname}}</td>
                    <td><a href="{{route('student.main')}}">Edit</a> <a href="">Delete</a></td>
                 </tr>
             @endforeach
        </table>
    </div>

</body>
</html>