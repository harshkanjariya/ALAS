<?php
if (isset($_POST['txt'])){
    echo $_POST['txt'];
    exit(0);
}
?>
<html lang="en">
<head>
    <title>ALAS</title>
	<?php require("$root/public/pre_libs.php"); ?>
    <link href="assets/css/abc.css" rel="stylesheet">
</head>
<body>
<img src="assets/bird.jpg" alt="bird">
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
	$cipher = encrypt($str);
	?>
</table>
<div>
    <form action="index.php" method="post">
        <label for="txt"></label>
        <input type="text" id="txt" name="txt" value="{{{abc,def}}}"/>
        <input type="submit">
    </form>
    <div class="hello">hii</div>
</div>
<div id="mydiv">{{{{{{{y}}}}}}}</div>

<?php require("$root/public/post_libs.php"); ?>
<script type="text/javascript">
    var alas_data = '<?=$cipher?>';
    var x='abc,def';
    var y='x';
    Dialog.alert({
        message:'hello'
    });
    applyScriptables();
    applyScriptables();
</script>
</body>
</html>