<?php

  class Keke_witkey_industry_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_indus_id; //����
		 var $_indus_pid;
		 var $_indus_name;
		 var $_is_recommend;
		 var $_listorder;
		 var $_indus_type;
		 var $_on_time;


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //�飬�ģ�ɾ����

	     function  keke_witkey_industry_class(){ //���췽��
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_industry";
		 }


	    		function getIndus_id(){
			 return $this->_indus_id ;
		}
		function getIndus_pid(){
			 return $this->_indus_pid ;
		}
		function getIndus_name(){
			 return $this->_indus_name ;
		}
		function getIs_recommend(){
			 return $this->_is_recommend ;
		}
		function getListorder(){
			 return $this->_listorder ;
		}
		function getIndus_type(){
			 return $this->_indus_type ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setIndus_id($value){
			 $this->_indus_id = $value;
		}
		function setIndus_pid($value){
			 $this->_indus_pid = $value;
		}
		function setIndus_name($value){
			 $this->_indus_name = $value;
		}
		function setIs_recommend($value){
			 $this->_is_recommend = $value;
		}
		function setListorder($value){
			 $this->_listorder = $value;
		}
		function setIndus_type($value){
			 $this->_indus_type = $value;
		}
		function setOn_time($value){
			 $this->_on_time = $value;
		}
		function setWhere($value){
			 $this->_where = $value;
		}



    	   public  function __set($property_name, $value) {


		 		$this->$property_name = $value;


			}


			public function __get($property_name) {


				if (isset ( $this->$property_name )) {


					return $this->$property_name;


				} else {


					return null;


				}


			}



	    /**
		 * ��keke_witkey_industry����������һ����¼
		 * @return ��������ID
		 */
		function create_keke_witkey_industry(){
		 		 $data =  array();

					if(!is_null($this->_indus_id)){
				 $data['indus_id']=$this->_indus_id;
			}
			if(!is_null($this->_indus_pid)){
				 $data['indus_pid']=$this->_indus_pid;
			}
			if(!is_null($this->_indus_name)){
				 $data['indus_name']=$this->_indus_name;
			}
			if(!is_null($this->_is_recommend)){
				 $data['is_recommend']=$this->_is_recommend;
			}
			if(!is_null($this->_listorder)){
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_indus_type)){
				 $data['indus_type']=$this->_indus_type;
			}
			if(!is_null($this->_on_time)){
				 $data['on_time']=$this->_on_time;
			}

			 return $this->_indus_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace);
		 }


	    /**
		 * �༭��keke_witkey_industry��һ������¼
		 * @return ����Ӱ�������
		 */
		function edit_keke_witkey_industry(){
		 		 $data =  array();

					if(!is_null($this->_indus_id)){
				 $data['indus_id']=$this->_indus_id;
			}
			if(!is_null($this->_indus_pid)){
				 $data['indus_pid']=$this->_indus_pid;
			}
			if(!is_null($this->_indus_name)){
				 $data['indus_name']=$this->_indus_name;
			}
			if(!is_null($this->_is_recommend)){
				 $data['is_recommend']=$this->_is_recommend;
			}
			if(!is_null($this->_listorder)){
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_indus_type)){
				 $data['indus_type']=$this->_indus_type;
			}
			if(!is_null($this->_on_time)){
				 $data['on_time']=$this->_on_time;
			}

			if($this->_where){
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere());
			 }
			 else{
				 $where = array('indus_id' => $this->_indus_id);
				 return $this->_db->updatetable($this->_tablename,$data,$where);
			}
		 }


	    /**
		 * ��ѯ��keke_witkey_industry,��������ʱ������������ROW���������м�¼
		 * @return ����һ��(array)��������
		 */
		function query_keke_witkey_industry(){
			 if($this->_where){
				 $sql = "select * from $this->_tablename where ".$this->_where;
			 }
			 else{
				 $sql = "select * from $this->_tablename";
			 }
			 $this->_where = "";
			 return $this->_dbop->query($sql);
		 }


		function count_keke_witkey_industry(){
			 if($this->_where){
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where;
			 }
			 else{
				 $sql = "select count(*) as count from $this->_tablename";
			 }
			 $this->_where = "";
			 return $this->_dbop->getCount($sql);
		 }


		function del_keke_witkey_industry(){
			 if($this->_where){
				 $sql = "delete from $this->_tablename where ".$this->_where;
			 }
			 else{
				 $sql = "delete from $this->_tablename where indus_id = $this->_indus_id ";
			 }
			 $this->_where = "";
			 return $this->_dbop->execute($sql);
		 }





   }

 ?>