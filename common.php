<?php 

	function getlasttime(){
		//首先看看cookie有没有上次登入的信息
		date_default_timezone_set("PRC");
		if(!empty($_COOKIE['lastvisit'])){
			echo "你上次登入的时间是".$_COOKIE['lastvisit'];
			setcookie('lastvisit',date('Y-m-d H:i:s'),time()+24*3600*30);
		}else{
			//说明用户是第一次登入
			echo "你是第一次登入";
			setcookie('lastvisit',date('Y-m-d H:i:s'),time()+24*3600*30);	
		}

	}

	function getcookieval($key){
		if(empty($_COOKIE[$key])){
			return '';
		}else{
			return $_COOKIE[$key];
		}
	}

	//把验证用户是否合法封装函数
	function checkuservalidate(){
		session_start();
			//先写在封
		if(empty($_SESSION['loginuser'])){
		header('location:login.php?error=1');
		}
	}









 ?>