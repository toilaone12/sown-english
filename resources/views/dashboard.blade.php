<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sown English</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('be/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('be/css/styles.min.css')}}" />
  <link rel="stylesheet" href="{{asset('be/css/style.css')}}" />
  <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('admin.sidebar')
    <!--  Sidebar End -->
    @include('admin.content')
    <!--  Main wrapper -->
  </div>
  @include('admin.script')
</body>

</html>

