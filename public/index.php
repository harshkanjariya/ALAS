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
    <style>
        .adas-error-dialog{
            position: fixed;
            top: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0,0,0,.4);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .adas-error-dialog div{
            font-family: Poppins-Regular, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            border-radius: 5px;
            padding: 24px;
            width: 28em;
        }
        .ok-button{
            font-family: Poppins-Medium, sans-serif;
            color: #6993ff;
            background-color: #e1e9ff;
            border-color: transparent;
            margin: 15px 5px 0;
            cursor: pointer;
            display: inline-block;
            font-weight: 500;
            padding: 8.45px 13px;
            font-size: 13px;
            border-radius: 5px;

        }
        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #1bc5bd4d;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #1bc5bd;
            stroke-miterlimit: 10;
            margin: 10% auto;
            box-shadow: inset 0 0 0 #1bc5bd;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }
        @keyframes scale {
            0%, 100% {
                transform: none;
            }
            50% {
                transform: scale3d(1.1, 1.1, 1);
            }
        }
        @keyframes fill {
            100% {
                box-shadow: inset 0 0 0 30px #fff;
            }
        }
    </style>
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
    var adas_data = '<?=$cipher?>';
    var x='abc,def';
    var y='x';
    Dialog.alert('hello');
    applyScriptables();
    applyScriptables();
</script>
</body>
</html>