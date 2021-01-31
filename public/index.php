<?php
$user=new User();
$result = $user->select();
if ($result['status']!='success'){
	echo $result['error'];
	exit();
}
?>
<html lang="en">
<head>
    <title>ADAS</title>
	<?php require("$root/public/pre_libs.php"); ?>
    <link href="css/abc.css" rel="stylesheet">
</head>
<body>
<table>
    <tr>
        <td>Name</td>
        <td>Password</td>
    </tr>
	<?php
	foreach ($result['result'] as $row){
		echo "<tr>";
		echo "<td>".$row['name']."</td>";
		echo "<td>".$row['password']."</td>";
		echo "</tr>";
	}

	$arr = array("abc"=>array("def"=>"qwer","ghi"=>"tyui"));
	$str = json_encode($arr);
	$cipher = encrypt($str);
	?>
</table>
<div>
    <input type="text" name="txt" value="{{{abc,def}}}">
</div>
<div class="script">
    <div>
        {{x+x}}
    </div>
    <div>
        {{x}}
        <div>
            {{ x[0]}}
        </div>
    </div>
</div>
<?php require("$root/public/post_libs.php"); ?>
<script type="text/javascript">
    var data = '<?=$cipher?>';
    var x='{{{abc,ghi}}}';
</script>
</body>
</html>