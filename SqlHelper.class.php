<?php 
	//这是一个工具类,作用是完成对数据库的操作
	class SqlHelper{
		public $conn;
		public $dbname='empmanage';
		public $username='root';
		public $password='123456';
		public $host='localhost';

		public function __construct(){
			$this->conn=mysql_connect($this->host,$this->username,$this->password);
			if(!$this->conn){
				die('连接失败'.mysql_error());
			}
			mysql_select_db($this->dbname,$this->conn);
		}

		//执行dql语句
		
		public function execute_dql($sql){
			$res=mysql_query($sql,$this->conn) or die(mysql_error());
			return $res;
		}


		//执行dql语句,但是返回的是一个数组
		public function execute_dql2($sql){
			$arr=array();
			$res=mysql_query($sql,$this->conn) or die(mysql_error());
			//$i=0; 方法1
			//把$res=>$arr
			while($row=mysql_fetch_assoc($res)){
			//	$arr[$i++]=$row; 方法1
				$arr[]=$row;  //方法2
			}

			//这里马上可以$res关闭
			mysql_free_result($res);
			return $arr;
		}


		//考虑分页的情况
		//$sql1='select * from 表名 limit 0,6';
		//$sql2='select count(id) from 表名'；
		public function execute_dql_fenye($sql,$sql2,$fenyePage){
			//查询要分页显示的数据
			$res=mysql_query($sql,$this->conn) or die(mysql_error());
			//$res=>array()
			$arr=array();
			//把$res转移到$arr;
			while ($row=mysql_fetch_assoc($res)) {
				$arr[]=$row;
			}
			mysql_free_result($res);

			$res2=mysql_query($sql2,$this->conn) or die(mysql_error());

			if($row=mysql_fetch_row($res2)){
				$fenyePage->pagecount=ceil($row[0]/$fenyePage->pagesize);
				$fenyePage->rowcount=$row[0];
			}
			mysql_free_result($res2);

			//把导航信息也封装到fenyepage对象中
			$navigate='';
			if($fenyePage->pagenow>1){
				$prepage=$fenyePage->pagenow-1;
				$navigate = "<a href='{$fenyePage->gotourl}?pagenow=$prepage'>上一页</a>&nbsp";
			}
			if($fenyePage->pagenow<$fenyePage->pagecount){
				$nextpage=$fenyePage->pagenow+1;
				$navigate.= "<a href='{$fenyePage->gotourl}?pagenow=$nextpage'>下一页</a>&nbsp";
			}


			//使用for循环打印超链接
			//数字列表
			$page_whole=10;
			$start=floor(($fenyePage->pagenow-1)/$page_whole)*$page_whole+1;
			$index=$start;


			// << -10页
			if($fenyePage->pagenow>$page_whole){
				$page_del_ten=$fenyePage->pagenow-$page_whole;
				$navigate.= "<a href='{$fenyePage->gotourl}?pagenow=$page_del_ten'><<</a>&nbsp&nbsp&nbsp";
			}

			//数字列表超链接
			for(;$start<$index+$page_whole;$start++){
				$navigate.="<a href='{$fenyePage->gotourl}?pagenow=$start'>$start</a>&nbsp";	
			}


			//>> +10页
			if($fenyePage->pagenow>$page_whole){
				$page_add_ten=$fenyePage->pagenow+$page_whole;
				$navigate.= "<a href='{$fenyePage->gotourl}?pagenow=$page_add_ten'>>></a>&nbsp&nbsp&nbsp";
			}


			//显示当前页共有多少页
			$navigate.="当前页$fenyePage->pagenow/共有{$fenyePage->pagecount}页";
			$fenyePage->navigate=$navigate;
			//把$arr赋给$fenyePage
			$fenyePage->res_array=$arr;
		}

		//执行dml语句
		public function execute_dml($sql){
			$b=mysql_query($sql,$this->conn) or die(mysql_error());
			if(!$b){
				return 0;
			}else{
				if(mysql_affected_rows($this->conn)>0){
					return 1;//表示执行成功
				}else{
					return 2;//表示没有行受到影响
				}
			}
		}

		//关闭连接
		public function close_connect(){
			if(!empty($this->conn)){
				mysql_close($this->conn);
			}
		}
	}
 ?>