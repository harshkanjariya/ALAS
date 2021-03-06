<html lang="en">
<head>
    <title>ALAS</title>
	<?php pre(); ?>
    <link href="assets/css/abc.css" rel="stylesheet">
</head>
<body>
<img src="assets/images/bird.jpg" alt="bird" style="width:100px;height:100px;">
<table>
    <tr>
        <td>Name</td>
        <td>Password</td>
    </tr>
	<?php
	$arr = array(
	        "abc"=>array(
	            "def"=>"qwer",
                "ghi"=>"tyui"
            )
    );
	$str = json_encode($arr);
	$cipher = encrypt($str,'hello');
	echo encrypt2('asdfghjkl','abc');
	?>
</table>
<div>
    <input type="text" id="txt" name="txt" value="{{{abc,def}}}"/>
    <div class="hello">hii</div>
</div>
<div id="mydiv">{{{{{{{y}}}}}}}</div>
<a href="pwa">click</a>
<?php post(); ?>
<script type="text/javascript">
    var alas_data = '<?=$cipher?>';
    var x='abc,def';
    var y='x';
</script>
</body>
</html>