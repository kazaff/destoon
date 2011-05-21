<?php

final class Reward_time_class extends Time_base_class {
	
	var $_xs_task_config;
	
	function __construct(){
		global $xs_task_config;
		$this->_xs_task_config = $xs_task_config?$xs_task_config:Cache_ext_Class::getConfig('xs_task');
		parent::__construct();
	}
	
	public function validmarkstatus($task_id=0,$task_info=array()){
		$basic_config = $this->_basic_config;
		$xs_task_config = $this->_xs_task_config;
		
		
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
		 
		$valid_task_status = $basic_config['mark_auto_status']==3?"7":"3,7";
		
		$valid_task_endtime =$basic_config['mark_auto_status']==3?" and sp_end_time<".(time()-$basic_config['auto_mark_time']*24*3600):" and sp_end_time<".(time()+($xs_task_config['show_limit_time']*24*3600)-($basic_config['auto_mark_time']*24*3600));
		
		$task_arr = Cache_ext_Class::getTabledata('witkey_task',"model_id=1 $valid_task_endtime and task_status in ($valid_task_status) $task_id_sql and (select count(*) from ".TABLEPRE."witkey_mark_log where ".TABLEPRE."witkey_mark_log.obj_id = ".TABLEPRE."witkey_task.task_id  and obj_cash>0)=0","",0,'task_id');
		
		
		if (!$task_arr)return ;
		
		$tids = '';
		foreach ($task_arr as $t){
			$tids.= $tids?",{$t['task_id']}":"{$t['task_id']}";
		}
		
		$task_prize_arr = Cache_ext_Class::getTabledata("witkey_task_prize","task_id in ($tids)","",0);
		
		$temp_a = array();
		foreach ($task_prize_arr as $tp){
			$temp_a[$tp['task_id']][$tp['prize']] =$tp; 
		}
		$task_prize_arr = $temp_a;
		
		$work_arr = Cache_ext_Class::getTabledata("witkey_work","work_status in (1,2,3,4,6) and task_id in ($tids)","",0,'work_id');
		
		$mark_log_arr = Cache_ext_Class::getTabledata("witkey_mark_log","obj_id in ($tids) and mark_type = 1","mark_status",0,'mark_id');
		
		
		$temp_a = array();
		foreach ($mark_log_arr as $m){
			$m['work_id'] = $m['work_id']?$m['work_id']:0;
			$temp_a[$m['obj_id']][$m['by_uid']][$m['uid']][$m['work_id']] = $m;
		}
		$mark_log_arr = $temp_a;
		
		
		$mark_add_arr = array();
		$mark_edit_arr = array();
		$mark_edit_user = array();
		
		foreach ($work_arr as $w){
			
			if ($task_arr[$w['task_id']]['task_mode']==1){
				$work_cash = $task_arr[$w['task_id']]['task_cash'];
			}
			elseif ($task_arr[$w['task_id']]['task_mode']==2){
				$work_cash = $task_prize_arr[$w['task_id']][$w['work_status']]['prize_cash']/$task_prize_arr[$w['task_id']][$task_arr[$w['task_id']]['task_mode']]['prize_count'];
			}
			elseif ($task_arr[$w['task_id']]['task_mode']==3){
				$work_cash = $task_arr[$w['task_id']]['single_cash'];
			}
			
			
			
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
					'work_id'=>$w['work_id'],
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
		$xs_task_config = $this->_xs_task_config;
		
		
		if ($taskid) {
			if (($taskinfo['model_id']==1&&in_array($taskinfo['task_status'],array(3,4))&&$taskinfo['sp_end_time']<time()) || ($taskinfo['model_id']==1&&$taskinfo['task_status']==2&&($taskinfo['end_time']+$xs_task_config['is_auto_adjourn']*24*3600)<time())){
			$task_arr = array($taskinfo);
			}
			else {
				return false;
			}
		}
		else {
			$task_obj->setWhere("(model_id=1 and task_status in (3,4) and sp_end_time<".time().") or (model_id=1 and task_status =2 and end_time+".($xs_task_config['is_auto_adjourn']*24*3600)."<".time().")");
			$task_arr = $task_obj->query_keke_witkey_task();
			if (!$task_arr)return false;
		}
		
		
		$uids = array();
		$tids = array();
		foreach ($task_arr as $ta){
			$uids[$ta['uid']]=$ta['uid'];
			$tids[$ta['task_id']]=$ta['task_id'];
		}
		
		$work_obj = new Keke_witkey_work_class();
		$work_obj->setWhere("task_id in (".implode(',',$tids).") and work_status in (1,2,3,4,5,6) order by vote_num desc");
		$temp_arr = $work_obj->query_keke_witkey_work();
		$work_arr = array();
		foreach ($temp_arr as $t){
			$work_arr[$t['task_id']][$t['work_status']][$t['work_id']]=$t;
			$uids[$t['uid']]=$t['uid'];
		}
		$this->_a_winfo = $work_arr;
		
		$user_obj = new Keke_witkey_space_class();
		$user_obj->setWhere("uid in (".implode(',',$uids).")");
		$temp_arr = $user_obj->query_keke_witkey_space();
		$user_arr = array();
		foreach ($temp_arr as $t){
			$user_arr[$t['uid']] = $t;
		}
		$this->_a_uinfo = $user_arr;
		
		$prize_obj = new Keke_witkey_task_prize_class();
		$prize_obj->setWhere("task_id in (".implode(',',$tids).")");
		$temp_arr = $prize_obj->query_keke_witkey_task_prize();
		$prize_arr = array();
		foreach ($temp_arr as $t)
		{
			$prize_arr[$t['task_id']][$t['prize']] = $t;
		}
		$this->_a_pinfo = $prize_arr;
		
		$prom_obj = new Keke_witkey_promotion_class();
		
		$prom_obj->setWhere("task_id in (".implode(',',$tids).") and join_uid in (".implode(',',$uids).") and prom_status<1");
		$temp_arr = $prom_obj->query_keke_witkey_promotion();
		$prom_arr = array();
		foreach ($temp_arr as $t)
		{
			$prom_arr[$t['task_id']][$t['join_uid']] = $t;
		}
		$this->_a_prinfo = $prom_arr;
		
		
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
		
		$xs_task_config = $this->_xs_task_config;
		$basic_config = $this->_basic_config;
		
		if ($taskinfo['task_status']==2&&$taskinfo['end_time']<=(time()+$xs_task_config['is_auto_adjourn']*24*3600)){
			
			
			
			$returnstatus = 5;
			$returncredit = 0;
			$returncash = 0;
			$returnpromcredit = 0;
			$returnpromcash = 0;
			
			if ($taskinfo['task_mode']==1)
			{
				
				
				$workcount = count($this->_a_winfo[$taskinfo['task_id']][5]);
				
				if ($workcount==1)
				{
					
					foreach ($this->_a_winfo[$taskinfo['task_id']][5] as $w)
					{
						$work_info = $w;
						break;
					}
					$returnstatus = 3;
					$this->timeaddnotify("任务过期",'您的任务<a href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>已到期,系统默认入围者中标',$taskinfo['uid'],$taskinfo['username']);
					
					$message_obj = new Message_Class();
					if ($message_obj->validate('tender_isnotice')){
						$message_obj->setUid($work_info['uid']);
						$message_obj->setUsername($work_info['username']);
						$message_obj->setValue('任务编号',$taskinfo['task_id']);
						$message_obj->setValue('任务标题',$taskinfo['task_title']);
						$url= "<a href =\'index.php?do=task&task_id={$taskinfo['task_id']} \' target=\'_blank\' >".$taskinfo[task_title]."</a>";
						$message_obj->setValue ( '任务链接', $url );
						$message_obj->setTitle('任务中标');
						$message_obj->send();
					}
					
					
					$this->timeaddfeed('<a target="_blank" href="index.php?do=space&member_id='.$work_info['uid'].'">'.$work_info['username'].'</a>成功中标了任务<a href="index.php?do=task&task_id='.$work_info['task_id'].'">'.$taskinfo['task_title'].'</a>',$work_info['uid'],$work_info['username'],'work_accept');
				}
				elseif ($workcount>=2&&$xs_task_config['vote_limit_time']){
					$this->timeaddnotify("任务过期",'您的任务<a href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>已到期,系统默认将其转为投票状态',$taskinfo['uid'],$taskinfo['username']);
					$returnstatus = 4;
				}
				else {
					$returnstatus = 5;
					$this->timeaddnotify("任务过期",'您的任务<a href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>已到期,该任务失败',$taskinfo['uid'],$taskinfo['username']);
					$returncash =$xs_task_config['defeated_money']==2?$taskinfo['cash_cost']:0;
					$returncredit = $xs_task_config['defeated_money']==2?$taskinfo['credit_cost']:$taskinfo['task_cash'];
					if ($taskinfo['is_prom'])
					{
						$returnpromcash =$xs_task_config['defeated_money']==2?$taskinfo['prom_cash']:0;
						$returnpromcredit = $xs_task_config['defeated_money']==2?$taskinfo['prom_credit']:$taskinfo['prom_count'];
					}
				}
			}
			
			elseif ($taskinfo['task_mode']==2)
			{
				$returnstatus = 3;
				
				
				$prize_arr = $this->_a_pinfo[$taskinfo['task_id']];
				$work_arr1 = $this->_a_winfo[$taskinfo['task_id']][1];
				$work_arr2 = $this->_a_winfo[$taskinfo['task_id']][2];
				$work_arr3 = $this->_a_winfo[$taskinfo['task_id']][3];
				
				if (!$work_arr1&&!$work_arr2&&!$work_arr3)
				{
					$returnstatus = 5;
					
					$returncash =$xs_task_config['defeated_money']==2?$taskinfo['cash_cost']:0;
					$returncredit = $xs_task_config['defeated_money']==2?$taskinfo['credit_cost']:$taskinfo['task_cash'];
					if ($taskinfo['is_prom'])
					{	
						$returnpromcash =$xs_task_config['defeated_money']==2?$taskinfo['prom_cash']:0;
						$returnpromcredit = $xs_task_config['defeated_money']==2?$taskinfo['prom_credit']:$taskinfo['prom_count'];
					}
					$this->timeaddnotify("任务过期",'您的任务<a href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>已到期,任务失败',$taskinfo['uid'],$taskinfo['username']);
				}
				else {
					
					$this->timeaddnotify("任务进入公示",'您的任务<a href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>已到期,任务进入公示期',$taskinfo['uid'],$taskinfo['username']);
				}
			}
			
			elseif ($taskinfo['task_mode']==3)
			{
				$work_arr = $this->_a_winfo[$taskinfo['task_id']][6];
				$returnstatus = 3;
				if (!$work_arr)
				{
					$returnstatus = 5;
					$returncash =$xs_task_config['defeated_money']==2?$taskinfo['cash_cost']:0;
					$returncredit = $xs_task_config['defeated_money']==2?$taskinfo['credit_cost']:$taskinfo['task_cash'];
					if ($taskinfo['is_prom'])
					{	
						$returnpromcash =$xs_task_config['defeated_money']==2?$taskinfo['prom_cash']:0;
						$returnpromcredit = $xs_task_config['defeated_money']==2?$taskinfo['prom_credit']:$taskinfo['prom_count'];
					}
					$this->timeaddnotify("任务过期",'您的任务<a href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>已到期,任务失败',$taskinfo['uid'],$taskinfo['username']);
				}
				else {
					
					$this->timeaddnotify("任务进入公示",'您的任务<a href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>已到期,任务进入公示',$taskinfo['uid'],$taskinfo['username']);
				}
			}
			
			
			if ($returncash>0||$returncredit>0)
			{
				$returncash = $returncash*(100-$xs_task_config['deduct_scale'])/100;
				$returncredit = $returncredit*(100-$xs_task_config['deduct_scale'])/100;
				$this->_a_uedit_arr[$taskinfo['uid']]['balance'] += $returncash;
				$this->_a_uedit_arr[$taskinfo['uid']]['credit'] += $returncredit;
				
				$temp = array();
				$temp['fina_time']=time();
				$temp['task_id']=$taskinfo['task_id'];
				$temp['fina_type']=2;
				$temp['fina_narrate']=8;
				$temp['uid']=$taskinfo['uid'];
				$temp['username']=$taskinfo['username'];
				$temp['fina_cash']=$returncash;
				$temp['fina_credit']=$returncredit;
				$temp['user_balance']=$this->getusercash($taskinfo['uid']);
				$temp['user_credit']=$this->getusercredit($taskinfo['uid']);
				
				$this->_a_fina_arr[] = $temp;
			}
			
			if ($returnpromcash>0||$returnpromcredit>0)
			{
				$returnpromcash = $returnpromcash;
				$returnpromcredit = $returnpromcredit;
				$this->_a_uedit_arr[$taskinfo['uid']]['balance'] += $returnpromcash;
				$this->_a_uedit_arr[$taskinfo['uid']]['credit'] += $returnpromcredit;
				
				$temp = array();
				$temp['fina_time']=time();
				$temp['task_id']=$taskinfo['task_id'];
				$temp['fina_type']=2;
				$temp['fina_narrate']=9;
				$temp['uid']=$taskinfo['uid'];
				$temp['username']=$taskinfo['username'];
				$temp['fina_cash']=$returnpromcash;
				$temp['fina_credit']=$returnpromcredit;
				$temp['user_balance']=$this->getusercash($taskinfo['uid']);
				$temp['user_credit']=$this->getusercredit($taskinfo['uid']);
				
				$this->_a_fina_arr[] = $temp;
			}
			
			$this->_a_tedit_arr[$taskinfo['task_id']]['task_status']=$returnstatus;
			$this->_a_tedit_arr[$taskinfo['task_id']]['sp_end_time']=time()+$xs_task_config['show_limit_time']*24*3600;
			
		}
		
		elseif ($taskinfo['task_status']==3&&$taskinfo['sp_end_time']<=time()){
			
			if ($taskinfo['task_mode']==1){
				
				$work_arr = $this->_a_winfo[$taskinfo['task_id']][4];
				if (!$work_arr)return ;
				$work_info = null;
				foreach ($work_arr as $w)
				{
					$work_info = $w;
					break;
				}
				
				
				
				
				$user_info = $this->getuserinfo($work_info['uid']);
				
				$returnstatus = 7;
				$returncredit = 0;
				$returncash = 0;
				$returnpromcredit = 0;
				$returnpromcash = 0;
				
				$returncash = $xs_task_config['defeated_money']==2?$taskinfo['cash_cost']:0;
				$returncredit = $xs_task_config['defeated_money']==2?$taskinfo['credit_cost']:$taskinfo['task_cash'];
				$returncash = $returncash*(100-$xs_task_config['deduct_scale'])/100;
				$returncredit = $returncredit*(100-$xs_task_config['deduct_scale'])/100;
				$this->_a_uedit_arr[$work_info['uid']]['balance'] += $returncredit+$returncash;
				
				$temp = array();
				$temp['fina_time']=time();
				$temp['task_id']=$taskinfo['task_id'];
				$temp['fina_type']=2;
				$temp['fina_narrate']=2;
				$temp['uid']=$work_info['uid'];
				$temp['username']=$work_info['username'];
				$temp['fina_cash']=$returncredit+$returncash;
				$temp['user_balance']=$this->getusercash($work_info['uid']);
				
				$temp['user_credit']=$this->getusercredit($work_info['uid']);
				$this->_a_fina_arr[] = $temp;
				$this->timeaddfeed('<a target="_blank" href="index.php?do=space&memberid='.$work_info['uid'].'">'.$work_info['username'].'</a>参与任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>获得了'.($returncredit+$returncash).'元',$work_info['uid'],$work_info['username'],'task_pay');
				$this->timeaddnotify("任务佣金结算",'您在任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>中的佣金'.($returncredit+$returncash).'元已结算',$work_info['uid'],$work_info['username']);
				
				if ($taskinfo['is_prom']==1)
				{
					$returnpromcash =$xs_task_config['defeated_money']==2?$taskinfo['prom_cash']:0;
					$returnpromcredit = $xs_task_config['defeated_money']==2?$taskinfo['prom_credit']:$taskinfo['prom_count'];
					$returnpromcash = $returnpromcash;
					$returnpromcredit = $returnpromcredit;
					
					$temp = array();
					$temp['task_id']=$taskinfo['task_id'];
					$temp['fina_time']=time();
					$temp['fina_type']=2;
					$prom_info = $this->_a_prinfo[$taskinfo['task_id']][$work_info['uid']];
					
					if ($prom_info)
					{
						$this->_a_predit_arr[$prom_info['prom_id']]['prom_status']=1;
						$this->_a_predit_arr[$prom_info['prom_id']]['prom_money']=$returnpromcredit+$returnpromcash;
						$this->_a_uedit_arr[$prom_info['prom_uid']]['balance'] += $returnpromcredit+$returnpromcash;
						$returnuserinfo = $this->getuserinfo($prom_info['prom_uid']);
						$temp['fina_narrate']=3;
						$temp['username']=$returnuserinfo['username'];
						$temp['fina_cash']=$returnpromcash+$returnpromcredit;
						$temp['uid']=$returnuserinfo['uid'];
						$temp['user_balance']=$this->getusercash($prom_info['prom_uid']);
						$temp['user_credit']=$this->getusercredit($prom_info['prom_uid']);
						$this->timeaddfeed('<a target="_blank" href="index.php?do=space&memberid='.$prom_info['prom_uid'].'">'.$returnuserinfo['username'].'</a>通过推广任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>获得了'.($returnpromcash+$returnpromcredit).'元',$returnuserinfo['uid'],$returnuserinfo['username'],'task_prom');
						$this->timeaddnotify("推广佣金结算",'您通过推广任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>获得了'.($returnpromcash+$returnpromcredit).'元推广费',$returnuserinfo['uid'],$returnuserinfo['username']);
					}
					else {
						$this->_a_uedit_arr[$taskinfo['uid']]['balance'] += $returnpromcash;
						$this->_a_uedit_arr[$taskinfo['uid']]['credit'] += $returnpromcredit;
						$temp['fina_narrate']=9;
						$temp['uid']=$taskinfo['uid'];
						$temp['username']=$taskinfo['username'];
						$temp['fina_cash']=$returnpromcash;
						$temp['fina_credit']=$returnpromcredit;
						$temp['user_balance']=$this->getusercash($taskinfo['uid']);
						$temp['user_credit']=$this->getusercredit($taskinfo['uid']);
						$this->timeaddnotify("推广金返还",'您的任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>推广失败，推广金已返到您的帐户',$taskinfo['uid'],$taskinfo['username']);
					}
					$this->_a_fina_arr[] = $temp;
					
				}
			
			}
			
			elseif ($taskinfo['task_mode']==2){
				
				$prize_info = $this->_a_pinfo[$taskinfo['task_id']];
				
				$work_arr[1] = $this->_a_winfo[$taskinfo['task_id']][1];
				$work_arr[2] = $this->_a_winfo[$taskinfo['task_id']][2];
				$work_arr[3] = $this->_a_winfo[$taskinfo['task_id']][3];
				
				$leftcaost = 0;
				$ep_get = array();
				foreach ($prize_info as $pk=>$prize)
				{
					$tt = $this->_a_winfo[$taskinfo['task_id']][$pk];
					$each_cost = $prize['prize_cash']/$prize['prize_count'];
					$c=0; 
					foreach ($tt as $w){
						if ($c+1>$prize['prize_count'])
						{
							break;
						}
						
						
						$paycash = $each_cost*(100-$xs_task_config['deduct_scale'])/100; 
						
						$this->_a_uedit_arr[$w['uid']]['balance'] += $paycash;
						$temp = array();
						$temp['fina_time'] = time();
						$temp['task_id']=$taskinfo['task_id'];
						$temp['fina_narrate']=2;
						$temp['fina_type']=2;
						$temp['uid']=$w['uid'];
						$temp['username']=$w['username'];
						$temp['fina_cash']=$paycash;
						$temp['user_balance']=$this->getusercash($w['uid']);
						$temp['user_credit']=$this->getusercredit($w['uid']);
						$this->_a_fina_arr[] = $temp;
						$c++;
						$this->timeaddfeed('<a target="_blank" href="index.php?do=space&memberid='.$w['uid'].'">'.$w['username'].'</a>参与任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>获得了'.($paycash).'元',$w['uid'],$w['username'],'task_pay');
						$this->timeaddnotify("任务佣金结算",'您在任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>中的佣金'.$paycash.'元已结算',$w['uid'],$w['username']);
				
						
						
						$ep_get[$w['uid']] += $each_cost; 
					}
					$leftcaost += $prize['prize_count']>$c?($prize['prize_count']-$c)*$each_cost:0;
				}
				
				if ($leftcaost)
				{
					
					$returncash = 0;
					$returncredit = 0;
					if ($xs_task_config['defeated_money']==2){
						$returncredit = $taskinfo['credit_cost']>$leftcaost?$leftcaost:$taskinfo['credit_cost'];
						$returncash = $taskinfo['credit_cost']>$leftcaost?0:$leftcaost-$taskinfo['credit_cost'];
					}
					else {
						$returncredit = $leftcaost;
					}
					
					
					$returncash = $returncash*(100-$xs_task_config['deduct_scale'])/100;
					$returncredit = $returncredit*(100-$xs_task_config['deduct_scale'])/100;
					
					$returncash = sprintf("%10.2f",$returncash);
					$returncredit = sprintf("%10.2f",$returncredit);
					
					$this->_a_uedit_arr[$taskinfo['uid']]['balance'] += $returncash;
					$this->_a_uedit_arr[$taskinfo['uid']]['credit'] += $returncredit;
					
					
					$temp = array();
					$temp['fina_time']=time();
					$temp['task_id']=$taskinfo['task_id'];
					$temp['fina_type']=2;
					$temp['fina_narrate']=8;
					$temp['uid']=$taskinfo['uid'];
					$temp['username']=$taskinfo['username'];
					$temp['fina_cash']=$returncash;
					$temp['fina_credit']=$returncredit;
					$temp['user_balance']=$this->getusercash($taskinfo['uid']);
					$temp['user_credit']=$this->getusercredit($taskinfo['uid']);
					$this->_a_fina_arr[] = $temp;
				}
				
				
				if ($taskinfo['is_prom']==1){
					
					$totalcostc = 0;
					foreach ($ep_get as $k=>$ep)
					{
						$pp_value = $taskinfo['prom_count']*$ep/$taskinfo['task_cash'];
						if ($this->_a_prinfo[$taskinfo['task_id']][$k])
						{
							$totalcostc +=$ep;
							$tg_uid = $this->_a_prinfo[$taskinfo['task_id']][$k]['prom_uid'];
							$this->_a_predit_arr[$this->_a_prinfo[$taskinfo['task_id']][$k]['prom_id']]['prom_status']=1;
							$this->_a_predit_arr[$this->_a_prinfo[$taskinfo['task_id']][$k]['prom_id']]['prom_money']=$pp_value;
							
							$pp_value = $pp_value;
							$this->_a_uedit_arr[$tg_uid]['balance']+=$pp_value;
							$pp_value = sprintf("%10.2f",$pp_value);
							$temp = array();
							$temp['fina_time']=time();
							$temp['task_id']=$taskinfo['task_id'];
							$temp['fina_type']=2;
							$temp['fina_narrate']=3;
							$temp['uid']=$tg_uid;
							$sdfdsdf = $this->getuserinfo($tg_uid);
							$temp['username']= $sdfdsdf['username'];
							$temp['fina_cash']=$pp_value;
							$temp['user_balance']=$this->getusercash($tg_uid);
							$temp['user_credit']=$this->getusercredit($tg_uid);
							$this->_a_fina_arr[] = $temp;
							
							$this->timeaddfeed('<a target="_blank" href="index.php?do=space&memberid='.$tg_uid.'">'.$sdfdsdf['username'].'</a>通过推广任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>获得了'.$pp_value.'元',$tg_uid,$sdfdsdf['username'],'task_prom');
							$this->timeaddnotify("推广佣金结算",'您通过推广任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>获得了'.$pp_value.'元推广费',$tg_uid,$sdfdsdf['username']);
						}
					}
					
					if ($totalcostc<$taskinfo['task_cash'])
					{
						$leftprom_caost = $taskinfo['prom_count']*($taskinfo['task_cash']-$totalcostc)/$taskinfo['task_cash'];
						
						
						$returncash = 0;
						$returncredit = 0;
						if ($xs_task_config['defeated_money']==2){
							$returncredit = $taskinfo['prom_credit']>$leftprom_caost?$leftprom_caost:$taskinfo['prom_credit'];
							$returncash =$taskinfo['prom_credit']>$leftprom_caost?0:$leftprom_caost-$taskinfo['prom_credit'];
						}
						else {
							$returncredit = $leftprom_caost;
						}
						
						$returncash = sprintf("%10.2f",$returncash);
						$returncredit = sprintf("%10.2f",$returncredit);
						$this->_a_uedit_arr[$taskinfo['uid']]['balance'] += $returncash;
						$this->_a_uedit_arr[$taskinfo['uid']]['credit'] += $returncredit;
						
						$temp = array();
						$temp['fina_time']=time();
						$temp['task_id']=$taskinfo['task_id'];
						$temp['fina_type']=2;
						$temp['fina_narrate']=9;
						$temp['uid']=$taskinfo['uid'];
						$temp['username']=$taskinfo['username'];
						$temp['fina_cash']=$returncash;
						$temp['fina_credit']=$returncredit;
						$temp['user_balance']=$this->getusercash($taskinfo['uid']);
						$temp['user_credit']=$this->getusercredit($taskinfo['uid']);
						$this->_a_fina_arr[] = $temp;
						$this->timeaddnotify("推广佣金返还",'您的任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>未全额生效，部分推广金已返到您的帐户',$taskinfo['uid'],$taskinfo['username']);
						
					}
				}
				
			}
			
			elseif ($taskinfo['task_mode']==3){
			
				$work_arr = $this->_a_winfo[$taskinfo['task_id']][6];
				
				$ep_get = array(); 
				$c = 0;
				$each_cost = $taskinfo['single_cash'];
				foreach ($work_arr as $w)
				{
					if ($c+1>$taskinfo['work_count'])
					{
						break;
					}
					
					
					$paycash = $each_cost*(100-$xs_task_config['deduct_scale'])/100; 

					$paycash = sprintf("%10.2f",$paycash);
					$this->_a_uedit_arr[$w['uid']]['balance'] += $paycash;
					$temp['fina_time']=time();
					$temp['task_id']=$taskinfo['task_id'];
					$temp['fina_type']=2;
					$temp['fina_narrate']=2;
					$temp['uid']=$w['uid'];
					$temp['username']=$w['username'];
					$temp['fina_cash']=$paycash;
					$temp['user_balance']=$this->getusercash($w['uid']);
					$temp['user_credit']=$this->getusercredit($w['uid']);
					$this->_a_fina_arr[] = $temp;
					$c++;
					$this->timeaddfeed('<a target="_blank" href="index.php?do=space&memberid='.$w['uid'].'">'.$w['username'].'</a>参与任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>获得了'.($paycash).'元',$w['uid'],$w['username'],'task_pay');
					$this->timeaddnotify("推广佣金结算",'您在任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>中的佣金'.$paycash.'元已结算',$w['uid'],$w['username']);
								
					$ep_get[$w['uid']] += $each_cost; //
					
				}
				$leftcaost = 0;
				$leftcaost = $c<$taskinfo['work_count']?($taskinfo['work_count']-$c)*$each_cost:0;

				
				if ($leftcaost)
				{
					$returncash = 0;
					$returncredit = 0;
					if ($xs_task_config['defeated_money']==2){
						$returncredit = $taskinfo['credit_cost']>$leftcaost?$leftcaost:$taskinfo['credit_cost'];
						$returncash = $taskinfo['credit_cost']>$leftcaost?0:$leftcaost-$taskinfo['credit_cost'];
					}
					else {
						$returncredit = $leftcaost;
					}
					$returncash = $returncash*(100-$xs_task_config['deduct_scale'])/100;
					$returncredit = $returncredit*(100-$xs_task_config['deduct_scale'])/100;
					$returncash = sprintf("%10.2f",$returncash);
					$returncredit = sprintf("%10.2f",$returncredit);
					$this->_a_uedit_arr[$taskinfo['uid']]['balance'] += $returncash;
					$this->_a_uedit_arr[$taskinfo['uid']]['credit'] += $returncredit;
					
					$temp = array();
					$temp['fina_time']=time();
					$temp['task_id']=$taskinfo['task_id'];
					$temp['fina_type']=2;
					$temp['fina_narrate']=8;
					$temp['uid']=$taskinfo['uid'];
					$temp['username']=$taskinfo['username'];
					$temp['fina_cash']=$returncash;
					$temp['fina_credit']=$returncredit;
					$temp['user_balance']=$this->getusercash($taskinfo['uid']);
					$temp['user_credit']=$this->getusercredit($taskinfo['uid']);
					$this->_a_fina_arr[] = $temp;
				}
				
				if ($taskinfo['is_prom']==1){
					
					$totalcostc = 0;
					foreach ($ep_get as $k=>$ep)
					{
						
						$pp_value = $taskinfo['prom_count']*$ep/$taskinfo['task_cash'];
						if ($this->_a_prinfo[$taskinfo['task_id']][$k])
						{
							$totalcostc +=$ep;
							$tg_uid = $this->_a_prinfo[$taskinfo['task_id']][$k]['prom_uid'];
							$this->_a_predit_arr[$this->_a_prinfo[$taskinfo['task_id']][$k]['prom_id']]['prom_status']=1;
							$this->_a_predit_arr[$this->_a_prinfo[$taskinfo['task_id']][$k]['prom_id']]['prom_money']=$pp_value;
							
							$pp_value = $pp_value;
							$pp_value = sprintf("%10.2f",$pp_value);
							$this->_a_uedit_arr[$tg_uid]['balance']+=$pp_value;
							
							$temp = array();
							$temp['fina_time']=time();
							$temp['task_id']=$taskinfo['task_id'];
							$temp['fina_type']=2;
							$temp['fina_narrate']=3;
							$temp['uid']=$tg_uid;
							$sdfdsdf = $this->getuserinfo($tg_uid);
							$temp['username']= $sdfdsdf['username'];
							$temp['fina_cash']=$pp_value;
							$temp['user_balance']=$this->getusercash($tg_uid);
							$temp['user_credit']=$this->getusercredit($tg_uid);
							$this->_a_fina_arr[] = $temp;
							$this->timeaddfeed('<a target="_blank" href="index.php?do=space&memberid='.$tg_uid.'">'.$sdfdsdf['username'].'</a>通过推广任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>获得了'.$pp_value.'元',$tg_uid,$sdfdsdf['username'],'task_prom');
							$this->timeaddnotify("推广佣金结算",'您通过推广任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>获得了'.$pp_value.'元推广费',$tg_uid,$sdfdsdf['username']);
						}
						else {
							
							$leftprom_caost += $pp_value;
						}
					}
					if ($totalcostc<$taskinfo['task_cash'])
					{
						$leftprom_caost = $taskinfo['prom_count']*($taskinfo['task_cash']-$totalcostc)/$taskinfo['task_cash'];
						$returncash = 0;
						$returncredit = 0;
						if ($xs_task_config['defeated_money']==2){
							$returncredit = $taskinfo['prom_credit']>$leftprom_caost?$leftprom_caost:$taskinfo['prom_credit'];
							$returncash =$taskinfo['prom_credit']>$leftprom_caost?0:$leftprom_caost-$taskinfo['prom_credit'];
						}
						else {
							$returncredit = $leftprom_caost;
						}
						$returncash = sprintf("%10.2f",$returncash);
						$returncredit = sprintf("%10.2f",$returncredit);
						$this->_a_uedit_arr[$taskinfo['uid']]['balance'] += $returncash;
						$this->_a_uedit_arr[$taskinfo['uid']]['credit'] += $returncredit;
						
						$temp = array();
						$temp['fina_time']=time();
						$temp['task_id']=$taskinfo['task_id'];
						$temp['fina_type']=2;
						$temp['fina_narrate']=9;
						$temp['uid']=$taskinfo['uid'];
						$temp['username']=$taskinfo['username'];
						$temp['fina_cash']=$returncash;
						$temp['fina_credit']=$returncredit;
						$temp['user_balance']=$this->getusercash($taskinfo['uid']);
						$temp['user_credit']=$this->getusercredit($taskinfo['uid']);
						$this->_a_fina_arr[] = $temp;
						$this->timeaddnotify("任务佣金退还",'您的任务<a target="_blank" href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>未全额生效，部分推广金已返到您的帐户',$taskinfo['uid'],$taskinfo['username']);
					}
					
					
				}
				
				
				
				
			}
			
			$this->timeaddnotify("任务公示结束",'您的任务<a href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>公示期已结束',$taskinfo['uid'],$taskinfo['username']);
			
			$this->_a_tedit_arr[$taskinfo['task_id']]['task_status']=7;
		}
		
		elseif ($taskinfo['task_status']==4&&$taskinfo['sp_end_time']<=time()){
			$work_arr = $this->_a_winfo[$taskinfo['task_id']][5];
			$work_info = NULL;
			
			if (!$work_arr)return ;
			
			foreach ($work_arr as $w)
			{
				$work_info = $w;
				break;
			}
			
			if ($work_info)
			{
				$this->_a_tedit_arr[$taskinfo['task_id']]['task_status']=3;
				$this->_a_tedit_arr[$taskinfo['task_id']]['sp_end_time']=time()+$xs_task_config['show_limit_time']*24*3600;
				
				$this->_a_wedit_arr[$work_info['work_id']]['work_status']=4;
				$this->timeaddfeed('<a target="_blank" href="index.php?do=space&member_id='.$work_info['uid'].'">'.$work_info['username'].'</a>成功中标了任务<a href="index.php?do=task&task_id='.$work_info['task_id'].'">'.$taskinfo['task_title'].'<a>',$work_info['uid'],$work_info['username'],'work_accept');
				
					$message_obj = new Message_Class();
					if ($message_obj->validate('tender_isnotice')){
						$message_obj->setUid($work_info['uid']);
						$message_obj->setUsername($work_info['username']);
						$message_obj->setValue('任务编号',$taskinfo['task_id']);
						$message_obj->setValue('任务标题',$taskinfo['task_title']);
						$url= "<a href =\'index.php?do=task&task_id={$taskinfo['task_id']}\' target=\'_blank\' >{$taskinfo['task_title']}</a>";
						$message_obj->setValue ( '任务链接', $url );
						$message_obj->setTitle('任务中标');
						$message_obj->send();
					}
				
			}
			$this->_a_tedit_arr[$taskinfo['task_id']]['task_status']=3;
			$this->_a_tedit_arr[$taskinfo['task_id']]['sp_end_time']=time()+$xs_task_config['show_limit_time']*24*3600;
			$this->timeaddnotify("任务投票结束",'您的任务<a href="index.php?do=task&task_id='.$taskinfo['task_id'].'">'.$taskinfo['task_title'].'</a>投票期结束，进入公示期',$taskinfo['uid'],$taskinfo['username']);
		}
	}
	
	protected function excuteupdate(){
		
		if ($this->_a_wedit_arr){
			$work_sql = "update ".TABLEPRE."witkey_work set work_status = case work_id";
			$t_work_wids = array();
			foreach ($this->_a_wedit_arr as $k=>$v){
				$work_sql.=" when $k then '".($v['work_status']+0)."'";
				$t_work_wids[] = $k;
			}
			$work_sql .= " end";
			$work_sql .= " where work_id in (".implode(',',$t_work_wids).")";
			db_factory::execute($work_sql);
		}
		
		
		if ($this->_a_tedit_arr){
			$task_sql = "update ".TABLEPRE."witkey_task set task_status = case task_id";
			$t_temp_sql = "";
			$t_task_tids = array();
			foreach ($this->_a_tedit_arr as $k=>$v){
				$task_sql.=" when $k then '".($v['task_status']+0)."'";
				if($v['sp_end_time']){
					$s = "'".$v['sp_end_time']."'";
				}
				else{
					$s = "sp_end_time";
				}
				$t_temp_sql.=" when $k then $s";
				$t_task_tids[] = $k;
			}
			$task_sql .= " end,";
			$task_sql .= " sp_end_time = case task_id ".$t_temp_sql." end";
			$task_sql .= " where task_id in (".implode(',',$t_task_tids).")";
			db_factory::execute($task_sql);
		}
		
		if ($this->_a_predit_arr) {
			$prom_sql = "update ".TABLEPRE."witkey_promotion set prom_status = case prom_id";
			$t_temp_sql = "";
			$t_prom_pids = array();
			foreach ($this->_a_predit_arr as $k=>$v){
				$prom_sql.=" when $k then '".($v['prom_status']+0)."'";
				$t_temp_sql.=" when $k then '".($v['prom_money']+0)."'";
				$t_prom_pids[] = $k;
			}
			$prom_sql .= " end,";
			$prom_sql .= " prom_money = case prom_id ".$t_temp_sql." end";
			$prom_sql .= " where prom_id in (".implode(',',$t_prom_pids).")";
			db_factory::execute($prom_sql);
		}
		
	}
	
	
}

?>