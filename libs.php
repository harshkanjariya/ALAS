<?php
function post_libs($components = array()){
	echo '
	
		<script src="global.js"></script>
		<script src="assets/js/app.js"></script>
	
	';
	foreach ($components as $c){
		echo "<script src=\"components/ui/$c/$c.js\"></script>";
	}
}
function pre_libs($components = array()){
	echo '

    <link rel="stylesheet" href="assets/lib/css/bootstrap.min.css">
    <script src="assets/lib/js/jquery.min.js"></script>
    <script src="assets/lib/js/bootstrap.min.js"></script>
    <script src="assets/lib/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="assets/lib/css/owl.carousel.min.css">
    <script type="text/javascript" src="assets/lib/js/owl.carousel.min.js"></script>
    
    <link rel="stylesheet" href="assets/lib/fonts/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/lib/css/font-awesome.min.css">
    
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    
    <link href="assets/lib/css/dialog.css" rel="stylesheet">
    <link href="assets/lib/css/chips.css" rel="stylesheet">
    <link href="global.css" rel="stylesheet">
    <script src="security.js"></script>
	
';
	if ($components) {
		foreach ($components as $c) {
			echo "<link href=\"components/ui/$c/$c.css\" rel='stylesheet'>";
		}
	}
}
