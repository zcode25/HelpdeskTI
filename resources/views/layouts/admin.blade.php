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

	<title>hesti</title>

	<link href="/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    @include('partials.adminNav')
    @yield('container')

    <footer class="footer">
      <div class="container-fluid">
        <div class="row text-muted">
          <div class="col-6 text-start">
            <p class="mb-0">
              <p>2023 © PT Citra Daya Purnama</p>
              {{-- <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a>								&copy; --}}
            </p>
          </div>
          <div class="col-6 text-end">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a class="text-muted" href="#" target="_blank">Support</a>
              </li>
              <li class="list-inline-item">
                <a class="text-muted" href="#" target="_blank">Help Center</a>
              </li>
              <li class="list-inline-item">
                <a class="text-muted" href="#" target="_blank">Privacy</a>
              </li>
              <li class="list-inline-item">
                <a class="text-muted" href="#" target="_blank">Terms</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>
</div>
	  <script src="/js/app.js"></script>

    </body>

</html>