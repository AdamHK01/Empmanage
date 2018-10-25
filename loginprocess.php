<?php 

require_once 'AdminService.class.php';
//接受用户的数据
//1.id
$id=$_POST['adminId'];
//2.密码
$password=$_POST['password'];

//3.获取用户是否保存id
if(empty($_POST['keep'])){
	if(!empty($_COOKIE['id'])){
	setcookie('id',$id,time()-100);		
	}
}else{
	setcookie('id',$id,time()+7*2*24*3600);
}

//实例化一个adminservice的方法；
$adminService=new AdminService();
if($name=$adminService->checkAdmin($id,$password)){

	//说明合法
	session_start();
	$_SESSION['loginuser']=$name;
	header("Location:empManage.php?name=$name");
}else{
	//说明非法
	header('Location:login.php?error=1');
	exit();
}


 ?>