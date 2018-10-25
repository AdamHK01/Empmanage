<?php
	require_once 'common.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理员登入系统</title>
</head>
<body>
	<h1>管理员登入系统</h1>
	<form action="loginprocess.php" method="post">
		<table>
			<tr><td>用户id</td><td><input type="text" name="adminId" value="<?php echo getcookieval('id') ?>"></td></tr>
			<tr><td>密&nbsp码</td><td><input type="password" name="password"></td></tr>
			<tr><td colspan="2">是否保存用户id<input type="checkbox" value="yes" name='keep'></td></tr>
			<tr><td><input type="submit" value="用户登入"></td></tr>
			<tr><td><input type="reset" value="重新填写"></td></tr>
		</table>
	</form>
	<?php 
	//接受error
	if(!empty($_GET['error'])){
		//接收错误编号
		$error=$_GET['error'];
		if($error==1){
			echo "<br><font color='red' size='3'>你的用户名或者密码错误</font>";
		}
	}

	 ?>
</body>
</html>