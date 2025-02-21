<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Certificate</title>
</head>

<body>
    <h1>Certificate</h1>
    <p>User: {{ $user->fullname }}</p>
    <p>Member: {{ $member->fullname }}</p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registered as $registration)
                <tr>
                    <td>{{ $registration->id }}</td>
                    <td>{{ $registration->certification->title }}</td>
                    <td>{{ $registration->registration_date->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
