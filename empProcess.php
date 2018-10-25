<?php 

	require_once 'EmpService.class.php';
//接受用户要删除的用户id

	//创建了empservice对象实例
	$empService=new EmpService();



	//先看看用户是要分页还是修改雇员
	
	if(!empty($_REQUEST['flag'])){
		//接受标志flag
		$flag=$_REQUEST['flag'];
		//说明用户要执行删除请求
		if($flag=='del'){
			$id=$_REQUEST['id'];
		//	echo "你要删除的id为$id";
			if($empService->delEmpById($id)==1){
				//成功
				header('Location:ok.php');
				exit();
			}else{
				//失败
				header('Location:error.php');
				exit();
			};
		}else if($flag=='addemp'){
			//说明用户希望执行添加雇员
			$name=$_POST['name'];
			$grade=$_POST['grade'];
			$email=$_POST['email'];
			$salary=$_POST['salary'];
			//添加到数据库
			$res=$empService->addemp($name,$grade,$email,$salary);
			if($res==1){
				header('Location:ok.php');
				exit();
			}else{
				header('Location:error.php');
				exit();				
			}
		}else if($flag=='updateemp'){
			$id=$_POST['id'];
			$name=$_POST['name'];
			$grade=$_POST['grade'];
			$email=$_POST['email'];
			$salary=$_POST['salary'];
			//完成修改到数据库
			$res=$empService->updateemp($id,$name,$grade,$email,$salary);
			if($res==1){
				header('Location:ok.php');
				exit();
			}else{
				header('Location:error.php');
				exit();				
			}
		}


	};









 ?>