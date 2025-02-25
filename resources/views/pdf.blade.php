<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>{{ $title }}</title>
</head>

<body>
  <h1>Certificate</h1>
  <h3>{{ $data->member->fullname }}</h3>
  <p>Menerima Serifikat</p>
  <h3>{{ $data->certification->title }}</h3>
  <p>Dengan status</p>
  <h4>{{ $data->status === "approved" ? 'Kompeten' : 'Tidak Kompeten' }}</h4>
</body>

</html>
