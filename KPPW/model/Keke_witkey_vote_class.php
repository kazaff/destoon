<?php
  class Keke_witkey_vote_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_vote_id; //���� 
		 var $_task_id;
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	    function  keke_witkey_vote_class(){ //���췽��
	    		function getVote_id(){
  	function getTask_id(){
			 return $this->_task_id ;
		}
	    		function setVote_id($value){ 
		
  		function setTask_id($value){ 
			 $this->_task_id = $value;
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
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
	    /**
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
	    /**
	    
	    
	   
	    
	    
   }
 ?>