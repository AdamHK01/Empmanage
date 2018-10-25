<?php 
 	require_once 'SqlHelper.class.php';
 	require_once 'Emp.class.php';
	Class EmpService{
	
		//一个函数可以获取多少页
		function getPageCount($pagesize){
			//需要查询$rowcount;
			$sql='select count(id) from emp';
			$sqlHelper=new SqlHelper();
			$res=$sqlHelper->execute_dql($sql);
			if($row=mysql_fetch_row($res)){
				$pagecount=ceil($row[0]/$pagesize);
			}
			//释放资源关闭连接
			mysql_free_result($res);
			$sqlHelper->close_connect();
			return $pagecount;
			}

		//一个函数可以获取应当显示的雇员信息
		function getEmpListByPage($pagenow,$pagesize){
		$sql="select * from emp limit ".($pagenow-1)*$pagesize.", $pagesize;";
		$sqlHelper=new SqlHelper();
		//这里的$res是一个数组
		$res=$sqlHelper->execute_dql2($sql);

		//释放资源和关闭连接
		//关闭连接
		$sqlHelper->close_connect();	
		return $res;
		}


		//第二种使用封装的方式完成分页(业务逻辑到这里)
		function getFenyePage($fenyePage){
			//创建一个sqlhelper对象实例
			$sqlHelper=new SqlHelper();
			$sql1="select * from emp limit ".($fenyePage->pagenow-1)*$fenyePage->pagesize.", ".$fenyePage->pagesize;

			// echo "$sql1";
			// exit();
			$sql2='select count(id) from emp';
			$sqlHelper->execute_dql_fenye($sql1,$sql2,$fenyePage);

			$sqlHelper->close_connect();
		}	

		//根据输入id删除某个用户
		function delEmpById($id){
			$sql="delete from emp where id = $id";
			$sqlHelper=new SqlHelper();		
			return $sqlHelper->execute_dml($sql);
		}

		//添加一个雇员
		function addemp($name,$grade,$email,$salary){
			//做一个sql语句
			$sql="insert into emp(name,grade,email,salary) values('$name',$grade,'$email',$salary)";
			//使用sqlhelper完成添加
			$sqlHelper=new SqlHelper();
			$res=$sqlHelper->execute_dml($sql);	
			$sqlHelper->close_connect();
			return $res;		
		}

		//根据id号获取用户信息
		function getEmpbById($id){
			$sql="select * from emp where id = $id";
			$sqlHelper=new SqlHelper();		
			$arr=$sqlHelper->execute_dql2($sql);
			$sqlHelper->close_connect();
			return $arr;
			//二次封装 $arr->emp对象实例
			//创建emp对象实例
			$emp=new Emp();
			$emp->setId($arr[0]['id']);	
			$emp->setName($arr[0]['name']);
			$emp->setGrade($arr[0]['grade']);	
			$emp->setEmail($arr[0]['email']);	
			$emp->setSalary($arr[0]['salary']);
			return	$emp;

		}

		//根据id号修改用户信息
		function updateemp($id,$name,$grade,$email,$salary){
			$sql="update emp set name='$name',grade='$grade',email='$email',salary='$salary' where id = $id";
			$sqlHelper=new SqlHelper();	
			$res=$sqlHelper->execute_dml($sql);
			$sqlHelper->close_connect();
			return $res;
		}

	}

 ?>