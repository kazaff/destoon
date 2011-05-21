<?php

class Tender_time_class extends Time_base_class {
	
	var $_zb_task_config;
	
	function __construct(){
		parent::__construct();
		global $zb_task_config;
		$this->_zb_task_config=$zb_task_config?$zb_task_config:Cache_ext_Class::getConfig('zb_task');
	}
	
	public function validmarkstatus($task_id=0,$task_info=array()){
		
		$basic_config = $this->_basic_config;
		$zb_task_config = $this->_zb_task_config;
		
		if (!$basic_config['auto_mark_time']){
			return FALSE;
		}
		
		if ($taskinfo)
		{
			$taskid = $taskinfo['task_id'];
		}
		if ($taskid&&!$taskinfo) {
			$task_obj = new Keke_witkey_task_class();
			$task_obj->setWhere("task_id = '{$taskid}'");
			$taskinfo = $task_obj->query_keke_witkey_task();
			$taskinfo = $taskinfo[0];
			
		}
		
		$task_id_sql = $task_id?"and task_id = $task_id":"";
		$valid_task_endtime =" and end_time<".(time()-$basic_config['auto_mark_time']*24*3600);
		
		
		$task_arr = Cache_ext_Class::getTabledata('witkey_task',"model_id=2 $valid_task_endtime and task_status =7 $valid_task_endtime $task_id_sql and (
select count(*) from ".TABLEPRE."witkey_mark_log 
where ".TABLEPRE."witkey_mark_log.obj_id = ".TABLEPRE."witkey_task.task_id 
and uid = ".TABLEPRE."witkey_task.uid and obj_cash>0
)<1 and (select count(*) from ".TABLEPRE."witkey_bid where task_id = ".TABLEPRE."witkey_task.task_id and bid_status>0)>0","",0,"task_id");
		
		if (!$task_arr)return false;
		
		$tids = '';
		foreach ($task_arr as $t){
			$tids.= $tids?",{$t['task_id']}":"{$t['task_id']}";
		}
		
		$bid_arr = Cache_ext_Class::getTabledata("witkey_bid","bid_status >0 and task_id in ($tids)","",0,'bid_id');
		$mark_log_arr = Cache_ext_Class::getTabledata("witkey_mark_log","obj_id in ($tids) and mark_type = 1","mark_status",0,'mark_log');
		
		
		
		$temp_a = array();
		foreach ($mark_log_arr as $m){
			$m['work_id'] = $m['work_id']?$m['work_id']:0;
			$temp_a[$m['obj_id']][$m['by_uid']][$m['uid']][$m['work_id']] = $m;
		}
		$mark_log_arr = $temp_a;
		
		
		
		$mark_add_arr = array();
		$mark_edit_arr = array();
		$mark_edit_user = array();
		
		foreach ($bid_arr as $w){
			
			$work_cash = $zb_task_config['zb_fees'];
			
			$thelog = $mark_log_arr[$w['task_id']][$w['uid']][$task_arr[$w['task_id']]['uid']];
			if ($thelog){
				
				foreach ($thelog as $loginfo){
					break;
				}
				$mark_edit_arr[$loginfo['mark_id']] = $work_cash;
				if (!$mark_edit_user[$task_arr[$w['task_id']]['uid']][$w['task_id']]['mark_status']||$mark_edit_user[$task_arr[$w['task_id']]['uid']][$w['task_id']]['mark_status']>$loginfo['mark_status'])
				$mark_edit_user[$task_arr[$w['task_id']]['uid']][$w['task_id']]['mark_status']=$loginfo['mark_status'];
			}
			else {
				$mark_add_arr[] = array(
					'mark_type'=>'1',
					'obj_id'=>$w['task_id'],
					'mark_status'=>1,
					'mark_content'=>'',
					'mark_time'=>time(),
					'uid'=>$task_arr[$w['task_id']]['uid'],
					'username'=>$task_arr[$w['task_id']]['username'],
					'by_uid'=>$w['uid'],
					'by_username'=>$w['username'],
					'user_type'=>1,
					'work_cash'=>$work_cash,
				);
				if (!$mark_edit_user[$task_arr[$w['task_id']]['uid']][$w['task_id']]['mark_status']||$mark_edit_user[$task_arr[$w['task_id']]['uid']][$w['task_id']]['mark_status']>1)
				$mark_edit_user[$task_arr[$w['task_id']]['uid']][$w['task_id']]['mark_status']=1;
			}
			$mark_edit_user[$task_arr[$w['task_id']]['uid']][$w['task_id']]['g_m_credit_value'] += $work_cash;
			
			
			$thelog = $mark_log_arr[$w['task_id']][$task_arr[$w['task_id']]['uid']][$w['uid']];
			if ($thelog){
				foreach ($thelog as $loginfo){
					break;
				}
				$mark_edit_arr[$loginfo['mark_id']] = $work_cash;
				if (!$mark_edit_user[$w['uid']][$w['task_id']]['mark_status']||$mark_edit_user[$w['uid']][$w['task_id']]['mark_status']>$loginfo['mark_status'])
				$mark_edit_user[$w['uid']][$w['task_id']]['mark_status']=$loginfo['mark_status'];
			}
			else {
				$mark_add_arr[] = array(
					'mark_type'=>'1',
					'obj_id'=>$w['task_id'],
					'mark_status'=>1,
					'mark_content'=>'',
					'mark_time'=>time(),
					'uid'=>$w['uid'],
					'username'=>$w['username'],
					'by_uid'=>$task_arr[$w['task_id']]['uid'],
					'by_username'=>$task_arr[$w['task_id']]['username'],
					'user_type'=>2,
					'work_id'=>$w['bid_id'],
					'work_cash'=>$work_cash,
				);
				if (!$mark_edit_user[$w['uid']][$w['task_id']]['mark_status']||$mark_edit_user[$w['uid']][$w['task_id']]['mark_status']>1)
				$mark_edit_user[$w['uid']][$w['task_id']]['mark_status'] = 1;
			}
			$mark_edit_user[$w['uid']][$w['task_id']]['w_m_credit_value'] += $work_cash;
		}
		
	if ($mark_add_arr){
			$mark_sql = "insert into ".TABLEPRE."witkey_mark_log (mark_type,obj_id,mark_status,mark_content,mark_time,uid,username,by_uid,by_username,user_type,work_id,obj_cash) values";
			$i =0;
			foreach ($mark_add_arr as $mark){
				if ($i++){
					$mark_sql.=",";
				}

				$mark_sql .="('".$mark['mark_type']."','".($mark['obj_id']+0)."','".$mark['mark_status']."','{$mark['mark_content']}','".($mark['mark_time']+0)."','".($mark['uid']+0)."','".$mark['username']."','".($mark['by_uid']+0)."','".$mark['by_username']."','".($mark['user_type']+0)."','".($mark['work_id']+0)."','".($mark['work_cash']+0)."')";
			}
			
			db_factory::execute($mark_sql);
			
			
		}
		
		
		if ($mark_edit_arr){
			$mark_sql = "update ".TABLEPRE."witkey_mark_log set obj_cash = case mark_id";
			$t_mark_ids = array();
			
			foreach ($mark_edit_arr as $k=>$v){
				$mark_sql.=" when $k then '".($v+0)."'";
				$t_mark_ids[] = $k;
			}
			$mark_sql .= " end";
			$mark_sql .= " where mark_id in (".implode(',',$t_mark_ids).")";
			
			db_factory::execute($mark_sql);
		}
		
		if ($mark_edit_user)
		{
			$user_sql = "update ".TABLEPRE."witkey_space set g_m_credit_value = ifnull(g_m_credit_value,0)+case uid";
			$t_temp_sql = "";
			$t_user_uids = array();
			
			$re_m_arr = array();
			foreach ($mark_edit_user as $userid=>$t_arr){
				foreach ($t_arr as $t_id=>$v)
				{
					if ($v['g_m_credit_value'])$re_m_arr[$userid]['g_m_credit_value'] += Func_comm_class::get_comment_score($v['g_m_credit_value'],$v['mark_status']); 
					if ($v['w_m_credit_value'])$re_m_arr[$userid]['w_m_credit_value'] += Func_comm_class::get_comment_score($v['w_m_credit_value'],$v['mark_status']); 
				}
			}
			
			
			foreach ($re_m_arr as $k=>$v){
				$user_sql.=" when $k then '".($v['g_m_credit_value']+0)."'";
				$t_temp_sql .= " when $k then '".($v['w_m_credit_value']+0)."'";
				$t_user_uids[] = $k;
			}
			$user_sql .= " end, w_m_credit_value=ifnull(w_m_credit_value,0)+case uid $t_temp_sql end";
			$user_sql .= " where uid in (".implode(',',$t_user_uids).")";
			db_factory::execute($user_sql);
			
			
			db_factory::execute("update ".TABLEPRE."witkey_space a set seller_good_rate = (select count(*) from ".TABLEPRE."witkey_mark_log where uid=a.uid and mark_status=1 and user_type=1)*100/(select count(*) from ".TABLEPRE."witkey_mark_log where uid=a.uid and user_type=1) where uid in (".implode(',',$t_user_uids).")");
			db_factory::execute("update ".TABLEPRE."witkey_space a set buyer_good_rate = (select count(*) from ".TABLEPRE."witkey_mark_log where uid=a.uid and mark_status=1 and user_type=2)*100/(select count(*) from ".TABLEPRE."witkey_mark_log where uid=a.uid and user_type=2) where uid in (".implode(',',$t_user_uids).")");
		}
	}
	
	public function validtaskstatus($taskid=0,$taskinfo=array()){
		$task_obj = new Keke_witkey_task_class();
		if ($taskinfo)
		{
			$taskid = $taskinfo['task_id'];
		}
		if ($taskid&&!$taskinfo) {
			$task_obj->setWhere("task_id = '{$taskid}'");
			$taskinfo = $task_obj->query_keke_witkey_task();
			$taskinfo = $taskinfo[0];
		}
		
		if ($taskid) {
			if ($taskinfo['model_id']==2&&($taskinfo['task_status']==2||$taskinfo['task_status']==3)&&$taskinfo['end_time']<time()){
			$task_arr = array($taskinfo);
			}
			else {
				return false;
			}
		}
		else {
			$task_obj->setWhere("model_id=2 and task_status in (2,3) and end_time<".time()."");
			$task_arr = $task_obj->query_keke_witkey_task();
			if (!$task_arr)return false;
		}
		
		
		if ($taskid) {
			$this->valid_a_task($taskinfo);
		}
		else {
			
			foreach ($task_arr as $ta)
			{
				$this->valid_a_task($ta);
				
			}
			
		}
		
		$this->excuteupdate();
		$this->excutecommon();
		return true;
	}
	
	
	
	protected function valid_a_task($taskinfo){
		if ($taskinfo['task_status']==3&&$taskinfo['end_time']<=time()){
			$this->_a_tedit_arr[$taskinfo['task_id']]['task_status']=7;
			$this->timeaddnotify("任务过期",'您的任务<a href="index.php?do=task_info&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>任务已过期',$taskinfo['uid'],$taskinfo['username']);
		}
		
		elseif ($taskinfo['task_status']==2&&$taskinfo['end_time']<=time()){
			$this->_a_tedit_arr[$taskinfo['task_id']]['task_status']=7;
			$this->timeaddnotify("任务过期",'您的任务<a href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>任务已过期',$taskinfo['uid'],$taskinfo['username']);
		}
		
	}
	
	protected function excuteupdate(){
		
		if ($this->_a_tedit_arr){
			$task_sql = "update ".TABLEPRE."witkey_task set task_status = case task_id";
			$t_temp_sql = "";
			$t_task_tids = array();
			foreach ($this->_a_tedit_arr as $k=>$v){
				$task_sql.=" when $k then '".($v['task_status']+0)."'";
				$t_temp_sql.=" when $k then '".($v['sp_end_time']+0)."'";
				$t_task_tids[] = $k;
			}
			$task_sql .= " end,";
			$task_sql .= " sp_end_time = case task_id ".$t_temp_sql." end";
			$task_sql .= " where task_id in (".implode(',',$t_task_tids).")";
			db_factory::execute($task_sql);
		}
		
		
		
	}
	
	
}

?>