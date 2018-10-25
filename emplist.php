<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>雇员信息列表</title>
	<script type="text/javascript">
		function checkDel(val){
		return	confirm('是否要删除id='+val+'的用户')
		}
	</script>
</head>
<body>
<?php 
	require_once 'EmpService.class.php';
	require_once 'FenyePage.class.php';
	require_once 'common.php';
	checkuservalidate();


	//创建一个分页对象实例
	
	$fenyepage=new FenyePage();

	//给 fenyepage指定必须的数据
	$fenyepage->pagenow=1;
	$fenyepage->pagesize=10;
	$fenyepage->gotourl='emplist.php';

	//这里我们需要根据用户的点击来修改$pagenow这个值
	if(!empty($_GET['pagenow'])){
	$fenyepage->pagenow=$_GET['pagenow'];
	}


	//调用getPageCount()方法，该方法可以把分页fenyepage完成	
	$empService=new EmpService();
	$empService->getFenyePage($fenyepage);

	echo "<table width='750px' border='1'>";
	echo "<tr><th>id</th><th>name</th><th>grade</th><th>email</th><th>salary</th><th>删除用户</th><th>修改用户</th></tr>";

	for($i=0;$i<count($fenyepage->res_array);$i++){
		$row=$fenyepage->res_array[$i];
		echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td><td><a href='empProcess.php?flag=del&id={$row['id']}' onclick='return checkDel({$row['id']})'>删除用户</a></td><td><a href='updataemp.php?id={$row['id']}'>修改用户</a></td></tr>";
	}
	echo "<h1>雇员信息列表</h1>";
	echo "</table>";

	echo $fenyepage->navigate;


	//指定跳转到某页
	echo "</br></br>";

	?>

	<form action="emplist.php">
		跳转到: <input type="text" name="pagenow">
		<input type="submit" value="go">
	</form>
</body>
</html>


