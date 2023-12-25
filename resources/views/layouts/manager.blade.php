<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	{{-- <link rel="shortcut icon" href="img/icons/icon-48x48.png" /> --}}

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>HESTI</title>

	<link href="/css/app.css" rel="stylesheet">
	{{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet"> --}}
  <link rel="stylesheet" href="/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    @include('partials.managerNav')
    @yield('container')

    <footer class="footer">
      <div class="container-fluid">
        <div class="row text-muted">
          <div class="col-6 text-start">
            <p class="mb-0">
              <p>2023 © HESTI</p>
            </p>
          </div>
        </div>
      </div>
    </footer>
  
	  <script src="/js/app.js"></script>

    </body>

</html>