<?php
$user=new User();
$result = $user->select();
if ($result['status']!='success'){
	echo $result['error'];
	exit();
}
?>
<html>
<head>
	<title>ADAS</title>
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
	?>
</table>
</body>
</html>
