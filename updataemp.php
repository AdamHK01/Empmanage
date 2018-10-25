<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改雇员</title>
</head>
<body>

<?php 

	require_once 'EmpService.class.php';
	//该页面显示要准备修改的用户的信息

	$id=$_GET['id'];
	$empService=new EmpService();
	$arr=$empService->getEmpbById($id);
 ?>

	<h1>修改雇员</h1>
	<form action="empProcess.php" method="post">
		<table>
			<tr><td>id号</td><td><input type="text" name="id" readonly="readonly" value="<?php echo $arr[0]['id'] ?>"></td></tr>
			<tr><td>名字</td><td><input type="text" name="name" value="<?php echo $arr[0]['name'] ?>"></td></tr>
			<tr><td>级别</td><td><input type="text" name="grade" value="<?php echo $arr[0]['grade'] ?>"></td></tr>
			<tr><td>电邮</td><td><input type="text" name="email" value="<?php echo $arr[0]['email'] ?>"></td></tr>
			<tr><td>薪水</td><td><input type="text" name="salary" value="<?php echo $arr[0]['salary'] ?>"></td></tr>
			<tr><td><input type="hidden" name="flag" value="updateemp"></td></tr>			
			<tr><td><input type="submit" value="修改用户"></td></tr>
			<tr><td><input type="reset" value='重新填写'></td></tr>
		</table>
	</form>
</body>
</html>
