	<a class="active" href="/">Home</a>
	<a href="/aboutjudo.php">About Judo</a>
	<a href="/instructors.php">Instructors</a>
	<a href="/calendar.php">Calendar</a>
	<!--a href="/news.html">News</a-->
	<!--a href="/documents">Documents</a-->
	<!--a href="/events.html">Events</a-->
	<a href="/photos.php">Photos</a>
	<a href="/morephotos.php">More Photos</a>
	<a href="/contact.php">Contact Us</a>
	<!--a href="/subscribe.php">Subscribe</a-->
	<?php 
		include("extendednavbar.php");
	?>
	<?php 
		session_start();

		if (!isset($_COOKIE["hasvisited"]) || $_COOKIE["hasvisited"] == false) {
			setcookie("hasvisited", false, time()+3600*24*30, "/");
			include("visitor.php");
		}
	?>
	<a href="" onclick="ToggleDarkMode()">Toggle Dark Mode</a>
	<a href="#" onclick="toggleTopNav()" class="icon">☰</a>
	<script>
		$(document).ready(function() {
			if (getCookie("darkmode") == "false") {
				$("html, body, div, p, #includedcontent, hr").toggleClass("lightmode")
				$("figure, figure p").css({
					"background-color":"var(--main-bg-color)", 
					"color":"var(--primary-color-variant)"
				})
				$("a").css({
					"background-color":"var(--main-bg-color)"
				})
				$("a").mouseenter(function(){
					if (!$(this).hasClass("active")) {
						$(this).css("background-color", "grey")
					}
				})
				$("a").mouseleave(function(){
					if (!$(this).hasClass("active")) {
						$(this).css("background-color", "var(--main-bg-color)")
					}
				})
				$(".active").css({
					"background-color":"#04AA6D"
				})
			}
		})

		function deleteCookie(cname) {
			document.cookie = `${cname}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`
		}

		function ToggleDarkMode() {
			let cookie = getCookie("darkmode")
			if (cookie == "") {
				setCookie("darkmode", "false", 500)
			}

			if (cookie == "true") {
				setCookie("darkmode", "false", 500)
			}
			else {
				setCookie("darkmode", "true", 500)
			}
		}

		function setCookie(cname, cvalue, exdays) {
			const d = new Date();
			d.setTime(d.getTime() + (exdays*24*60*60*1000));
			let expires = "expires="+ d.toUTCString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}

		function getCookie(cname) {
			let name = cname += "="
			let decodeCookie = decodeURIComponent(document.cookie)
			let ca = decodeCookie.split(';')
			for (let i = 0; i < ca.length; i++) {
				let c = ca[i]
				while (c.charAt(0) == ' ') {
					c = c.substring(1)
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length)
				}
			}
			return ""
		}

		function toggleTopNav() {
			$(".topnav").toggleClass('showtopnav')
		}
	</script>