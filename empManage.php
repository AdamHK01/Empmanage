<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php 

	require_once 'common.php';
	checkuservalidate();
	echo "欢迎".$_GET['name']."登入成功";
	echo "<br><a href='login.php'>返回重新登入</a>";
	//显示上次登入事件
	getlasttime();


 ?>	


 <h1>主界面</h1>
 <a href="emplist.php">管理用户</a><br>
 <a href="addEmp.php">添加用户</a><br>
 <a href="#">查询用户</a><br>
 <a href="#">退出系统</a>
</body>
</html>


