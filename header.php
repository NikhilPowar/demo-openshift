<section class="menu cid-rlenKoVAQt" once="menu" id="menu1-1a">
	<nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<div class="hamburger">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
		</button>
		<div class="menu-logo">
			<div class="navbar-brand">
				<span class="navbar-logo">
					<a <?php echo isset($_SESSION['username']) ? 'href="adminhome.php"' : 'href="index.php"' ?> >
						<img src="assets/images/thought-2123970-1920-122x85.jpg" alt="ThoughtBlog" title="" style="height: 3.8rem;">
					</a>
				</span>
				<span class="navbar-caption-wrap"><a class="navbar-caption text-white display-4"
					<?php echo isset($_SESSION['username']) ? 'href="adminhome.php"' : 'href="index.php"' ?> >
						THOUGHTBLOG</a></span>
			</div>
		</div>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
				<?php
					if (isset($_SESSION['username'])) {
						echo '<li class="nav-item">
							<a class="nav-link link text-white display-4" href="index.php" id="logout"><span class="mbri-logout mbr-iconfont mbr-iconfont-btn"></span>
								Admin Logout
							</a>
						</li>';
					}
				?>
				<li class="nav-item">
					<a class="nav-link link text-white display-4" href="contactus.php"><span class="mobi-mbri mobi-mbri-phone mbr-iconfont mbr-iconfont-btn"></span>
						Contact Us
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link link text-white display-4" href="aboutus.php"><span class="mbri-question mbr-iconfont mbr-iconfont-btn"></span>
						About Us
					</a>
				</li>
			</ul>
			<div class="navbar-buttons mbr-section-btn"><a class="btn btn-sm btn-primary display-4" href="subscribe.php"><span
						class="mbri-letter mbr-iconfont mbr-iconfont-btn"></span>
					Subscribe now!
				</a></div>
		</div>
	</nav>
</section>

<script type="text/javascript" language="javascript">
	var el = document.getElementById('logout');
	el.onclick = logout;

	function logout() {
		$.ajax({
			url: 'http://localhost/ThoughtBlog/adminlogin.php',
			type: 'POST',
			data: {
				logout: 'true'
			},
			success: function (msg){
				window.location = "http://localhost/ThoughtBlog/index.php";
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	}
</script>