<!-- Header
		============================================= -->
<header id="header" class="transparent-header floating-header header-size-md">
	<div id="header-wrap">
		<div class="container">
			<div class="header-row">

				<!-- Logo
						============================================= -->
				<div id="logo">
					<a href="index.php">
						<b style="font-size: 30px !important; font-weight: 500;">REPARATEC</b>
					</a>
				</div><!-- #logo end -->

				<div class="header-misc">

					<!-- Top Search
							============================================= -->
					<div id="top-search" class="header-misc-icon">
						<a href="#" id="top-search-trigger"><i class="uil uil-search"></i><i class="bi-x-lg"></i></a>
					</div><!-- #top-search end -->

					<a href="cadastrar.php" class="button button-rounded ms-3 d-none d-sm-block">Comece agora</a>

				</div>

				<div class="primary-menu-trigger">
					<button class="cnvs-hamburger" type="button" title="Open Mobile Menu">
						<span class="cnvs-hamburger-box"><span class="cnvs-hamburger-inner"></span></span>
					</button>
				</div>

				<!-- Primary Navigation
						============================================= -->
				<nav class="primary-menu with-arrows">

					<ul class="menu-container">
						<li class="menu-item <?php if ($menu == "home") { ?> current <?php } ?>"><a class="menu-link"
								href="index.php">
								<div>A Plataforma</div>
							</a></li>
						<li class="menu-item"><a class="menu-link" href="login.php">
								<div>Acessar</div>
							</a></li>
					</ul>
				</nav><!-- #primary-menu end -->

				<form class="top-search-form" action="search.html" method="get">
					<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.."
						autocomplete="off">
				</form>

			</div>
		</div>
	</div>
	<div class="header-wrap-clone"></div>
</header>