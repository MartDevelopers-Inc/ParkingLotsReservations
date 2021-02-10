<?php require_once('partials/landing_head.php'); ?>

<body>
	<nav class="navbar navbar-lg navbar-expand-lg navbar-transparant navbar-dark navbar-absolute w-100">
		<div class="container">
			<a class="navbar-brand" href="index.php">CPRS</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="client/">Client Portal</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="admin/">Staff Portal</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="intro py-5 py-lg-9 position-relative text-white">
		<div class="bg-overlay-dark">
			<img src="public/uploads/sys_logo/background.jpg" class="img-fluid img-cover" alt="iRegistration" />
		</div>
		<div class="intro-content py-6 text-center">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-12 col-sm-10 col-md-8 col-lg-6 mx-auto text-center">
						<h1 class="my-3 display-4 d-none d-lg-inline-block">Car Parking Reservations System</h1>
						<p>Instilling Innovation In Car Parking Reservations</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="public/dist/js/landing.js"></script>
</body>

</html>