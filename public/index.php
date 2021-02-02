<html lang="en">
<head>
    <title>ADAS</title>
	<?php require("$root/public/pre_libs.php"); ?>
    <link href="assets/css/abc.css" rel="stylesheet">
</head>
<body>
<img src="public/assets/bird.jpg" alt="bird">
<table>
    <tr>
        <td>Name</td>
        <td>Password</td>
    </tr>
	<?php
	$arr = array("abc"=>array("def"=>"qwer","ghi"=>"tyui"));
	$str = json_encode($arr);
	$cipher = encrypt($str);
	?>
</table>
<div>
    <input type="text" name="txt" value="{{{abc,def}}}">
</div>
<div>{{{{{{{y}}}}}}}</div>

<?php require("$root/public/post_libs.php"); ?>
<script type="text/javascript">
    var adas_data = '<?=$cipher?>';
    var x='abc,def';
    var y='x';
    applyScriptables();
    applyScriptables();
    updateData();
</script>
</body>
</html>