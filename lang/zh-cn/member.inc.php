<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$L['bad_data'] = '数据发送自未被信任的域名，如有疑问，请联系管理员';
$L['info_add'] = '发布信息';
$L['info_manage'] = '管理信息';
$L['error_password'] = '您的密码不正确';
$L['error_payword'] = '您的支付密码不正确';
$L['money_not_enough'] = '帐户余额不足，请充值';
$L['credit_not_enough'] = '您的'.$DT['credit_name'].'不足，请购买';
$L['pay_in_site'] = '站内支付';
$L['in_site'] = '站内';
$L['month'] = '月';
$L['forever'] = '永久';
$L['buy'] = '购买';
$L['guest'] = '游客';
$L['status'] = '状态';
$L['feature_close'] = '此功能暂未开启';
$L['limit_add'] = '最多可添加{V0}条记录,当前已添加{V1}条记录';
$L['default_type'] = '默认';
$L['all_type'] = '所有分类';
$L['choose_type'] = '请选择分类';
$L['check_auth'] = '您的请求未通过系统验证';//global.func
$L['auth_time'] = '您的请求已经过期';
$L['check_sign'] = '数据校验失败';
$L['goto'] = '转到';
$L['job_name'] = '招聘';
$L['resume_name'] = '简历';
$L['module_name'] = '模块';
$L['individual_sign'] = '(个人)';

$L['search_by'] = '按条件';
$L['search_by_title'] = '标题';
$L['search_by_note'] = '备注';
$L['order_by'] = '结果排序方式';

$L['op_add_success'] = '添加成功';
$L['op_checking'] = '请等待审核';
$L['op_del_success'] = '删除成功';
$L['op_edit_success'] = '修改成功';
$L['op_set_success'] = '设置成功';
$L['op_update_success'] = '更新成功';

$L['pass_title'] = '请填写标题';
$L['pass_content'] = '请填写内容';
$L['pass_typeid'] = '请选择分类';
$L['pass_url'] = '请填写网址';

$L['alert_pass'] = '您至少选择"关键字"或"所在行业"其中的一项';
$L['alert_title'] = '贸易提醒';
$L['alert_add_title'] = '添加提醒';

$L['ask_status'] = array('待受理', '<span style="color:blue;">受理中</span>', '<span style="color:green;">已解决</span>', '<span style="color:red;">未解决</span>');
$L['ask_title'] = '问题及解答';
$L['ask_title_show'] = '问题查看';
$L['ask_title_edit'] = '修改问题';
$L['ask_title_add'] = '提交新问题';
$L['ask_msg_edit'] = '此问题不可再修改';
$L['ask_msg_star'] = '请选择您的满意程度';
$L['ask_star_type'] = array('', '<span style="color:red;">不满意</span>', '基本满意', '<span style="color:green;">非常满意</span>');
$L['ask_star_success'] = '评分成功';
$L['ask_add_success'] = '提交成功';

$L['cash_status'] = array('<span style="color:blue;">等待受理</span>', '<span style="color:#666666;">拒绝申请</span>', '<span style="color:red;">支付失败</span>', '<span style="color:green;">付款成功</span>');
$L['cash_title_record'] = '提现记录';
$L['cash_title_setting'] = '帐号设置';
$L['cash_title_confirm'] = '提现确认';
$L['cash_title'] = '申请提现';
$L['cash_pass_bank'] = '请选择收款方式';
$L['cash_pass_account'] = '请填写收款帐号';
$L['cash_pass_amount'] = '请填写提现金额';
$L['cash_pass_amount_min'] = '单次提现最小金额为:';
$L['cash_pass_amount_max'] = '单次提现最大金额为:';
$L['cash_pass_amount_day'] = '24小时内最多可提现{v0}次，请稍候再操作';
$L['cash_pass_amount_large'] = '提现金额大于可用余额';
$L['cash_msg_success'] = '您的提现申请已经提交，请等待工作人员的处理<br/>在此期间，该笔'.$DT['money_name'].'将被冻结';
$L['cash_msg_account'] = '请先设置收款帐号';

$L['charge'] = '充值';
$L['charge_online'] = '在线充值';
$L['charge_card'] = '充值卡充值';
$L['charge_reward'] = '充值奖励';
$L['charge_card_name'] = '充值卡';
$L['charge_card_number'] = '卡号';
$L['charge_status'] = array('<span style="color:blue;">未知</span>', '<span style="color:red;">失败</span>', '<span style="color:#FF00FF;">作废</span>', '<span style="color:green;">成功</span>', '<span style="color:green;">人工</span>');
$L['charge_title_record'] = '充值记录';
$L['charge_title_confirm'] = '充值确认';
$L['charge_title_pay'] = '帐户充值';
$L['charge_title'] = '完成充值';
$L['charge_pass_card_number'] = '请填写正确的充值卡卡号';
$L['charge_pass_card_password'] = '请填写正确的充值卡密码';
$L['charge_pass_card_used'] = '充值卡无效';
$L['charge_pass_card_expired'] = '充值卡已过有效期';
$L['charge_pass_card_error_password'] = '充值卡密码错误';
$L['charge_pass_card_error_number'] = '无效的充值卡卡号';
$L['charge_pass_type_amount'] = '请填写支付金额';
$L['charge_pass_choose_amount'] = '请选择充值金额';
$L['charge_pass_amount_min'] = '充值金额最少:';
$L['charge_pass_bank'] = '请选择支付平台';
$L['charge_pass_bank_close'] = '此支付平台尚未启用';
$L['charge_msg_card_success'] = '充值卡充值成功';
$L['charge_msg_order_fail'] = '订单状态为失败，ID:';
$L['charge_msg_order_cancel'] = '订单状态为作废，ID:';
$L['charge_msg_not_order'] = '未找到充值纪录';

$L['credit_title_add'] = '添加证书';
$L['credit_title_edit'] = '修改证书';
$L['credit_title'] = '荣誉资质';
$L['credit_pass_title'] = '请填写证书名称';
$L['credit_pass_authority'] = '请填写发证机构';
$L['credit_pass_thumb'] = '请上传证书图片';
$L['credit_pass_fromdate'] = '请选择证书发证时间';
$L['credit_pass_fromdate_error'] = '证书发证时间必须在当前时间之前';
$L['credit_pass_todate'] = '请选择证书到期时间';
$L['credit_pass_todate_error'] = '证书到期时间必须在当前时间之后';
$L['credit_reward_reason'] = '证书上传';
$L['credit_punish_reason'] = '证书删除';

$L['credits_exchange_title'] = $DT['credit_name'].'兑换';
$L['credits_buy_title'] = $DT['credit_name'].'购买';
$L['credits_title'] = $DT['credit_name'].'记录';
$L['credits_pass_ex_min'] = '兑换额度不足';
$L['credits_pass_ex_max'] = '最多可兑换:';
$L['credits_msg_amount'] = '兑换成功';
$L['credits_msg_active'] = '您的帐号未在论坛激活';
$L['credits_msg_buy_amount'] = '请选择购买额度';
$L['credits_msg_buy_success'] = '购买成功';
$L['credits_fields'] = array($L['search_by'], '金额', '事由', $L['search_by_note']);

$L['edit_title'] = '修改资料';
$L['edit_invite'] = '会员推广';
$L['edit_profile'] = '完善资料';
$L['edit_msg_success'] = '资料修改成功';

$L['favorite_title_add'] = '添加收藏';
$L['favorite_title_edit'] = '修改收藏';
$L['favorite_title'] = '我的收藏';
$L['favorite_msg_choose'] = '请选择收藏';
$L['favorite_sfields'] = array($L['search_by'], $L['search_by_title'], '网址', $L['search_by_note']);

$L['friend_title_add'] = '添加商友';
$L['friend_title_edit'] = '修改商友';
$L['friend_title'] = '我的商友';
$L['friend_pass_truename'] = '请填写真实姓名';
$L['friend_msg_add_again'] = '该会员已经是您的商友了';
$L['friend_msg_choose'] = '请选择商友';
$L['friend_sfields'] = array($L['search_by'], '姓名', '公司', '职位', '电话', '手机', '主页', 'Email', 'QQ', '阿里旺旺', 'MSN', 'Skype', '会员', $L['search_by_note']);

$L['grade_title'] = '会员升级';
$L['grade_fail'] = '您的会员组升级({V0})失败';
$L['grade_success'] = '您的会员组升级({V0})成功';
$L['grade_return'] = '升级失败返款';
$L['grade_upto'] = '升级为:';
$L['grade_pass_balance'] = '会员余额不足';
$L['grade_pass_company'] = '请填写公司名';
$L['grade_pass_truename'] = '请填写联系人';
$L['grade_pass_telephone'] = '请填写电话号码';
$L['grade_msg_bad_promo'] = '无效的优惠码';
$L['grade_msg_time_promo'] = '可获有效期:{V0}天';
$L['grade_msg_money_promo'] = '可充抵金额:{V0}'.$DT['money_unit'];
$L['grade_msg_success'] = '您的申请已经成功提交，请等待工作人员处理';

$L['home_title'] = '商铺设置';
$L['home_msg_reset'] = '恢复成功';
$L['home_msg_save'] = '保存成功';

$L['index_msg_logout'] = '注销成功';
$L['index_msg_note_limit'] = '便笺限1000字';

$L['invite_title'] = $DT['credit_name'].'推广';

$L['link_title'] = '友情链接';
$L['link_title_add'] = '添加链接';
$L['link_title_edit'] = '修改链接';
$L['link_pass_username'] = '会员名不能为空';
$L['link_pass_title'] = '请填写网站名称';
$L['link_pass_linkurl'] = '请填写网站地址';
$L['link_msg_choose'] = '请选择链接';

$L['login_title'] = '会员登录';
$L['login_title_reg'] = '注册成功，请登录';
$L['login_msg_username'] = '请输入登录名称';
$L['login_msg_password'] = '请输入密码';
$L['login_msg_not_member'] = '登录名称不存在';
$L['login_msg_success'] = '登录成功';

$L['logout_msg_success'] = '退出成功';

$L['mail_title'] = '我的订阅';
$L['mail_title_list'] = '邮件列表';
$L['mail_msg_not_add'] = '您尚未订阅任何商机';
$L['mail_msg_cancel'] = '退订成功';
$L['mail_msg_update'] = '订阅更新成功';
$L['mail_msg_choose'] = '请选择商机分类，如果要取消订阅，请直接点击退订按钮';
$L['mail_msg_not_item'] = '邮件列表不存在';

$L['member_username_match'] = '会员名应为小写字母(a-z)、数字(0-9)、下划线(_)';
$L['member_username_len'] = '会员登录名长度应在{V0}-{V1}之间';
$L['member_username_ban'] = '此登录名已经被禁止注册';
$L['member_username_reg'] = '会员登录名已经被注册';
$L['member_passport_len'] = '通行证长度应在{V0}-{V1}之间';
$L['member_passport_char'] = '通行证名不能含有特殊符号';
$L['member_passport_ban'] = '此通行证名已经被禁止注册';
$L['member_passport_reg'] = '通行证名已经被注册';
$L['member_password_null'] = '会员登录密码不能为空';
$L['member_password_match'] = '两次输入的密码不一致';
$L['member_password_len'] = '登录密码长度应在{V0}-{V1}之间';
$L['member_payword_null'] = '支付密码不能为空';
$L['member_payword_match'] = '两次输入的密码不一致';
$L['member_payword_len'] = '支付密码长度应在{V0}-{V1}之间';
$L['member_groupid_null'] = '请选择会员组';
$L['member_truename_null'] = '请填写真实姓名';
$L['member_email_null'] = 'Email格式不正确';
$L['member_email_reg'] = '邮件地址已经存在';
$L['member_areaid_null'] = '请选择所在地区';
$L['member_company_null'] = '请填写公司名称';
$L['member_company_bad'] = '无效的公司名称';
$L['member_company_reg'] = '公司名称已经存在';
$L['member_type_null'] = '请选择公司类型';
$L['member_telephone_null'] = '请填写公司电话';
$L['member_regyear_null'] = '请填写公司注册年份';
$L['member_address_null'] = '请填写公司主要经营地点';
$L['member_introduce_null'] = '公司介绍不能少于5字';
$L['member_business_null'] = '请填写公司主要经营范围';
$L['member_catid_null'] = '请选择公司主营行业';
$L['member_login_username_bad'] = '用户名格式错误';
$L['member_login_password_bad'] = '密码错误,请重试';
$L['member_login_not_member'] = '会员不存在';
$L['member_login_ban'] = '累计{V0}次错误尝试 您在{V1}小时内不能登录系统';
$L['member_login_member_ban'] = '该帐号已被禁止访问';
$L['member_login_ok'] = '成功';
$L['member_founder_del'] = '创始人不可删除';
$L['member_founder_move'] = '创始人不可移动';
$L['member_rename_not_member'] = '当前会员名不存在';
$L['member_record_reg'] = '注册奖励';
$L['member_record_login'] = '登录奖励';

$L['message_title'] = '站内信';
$L['message_title_black'] = '黑名单';
$L['message_title_inbox'] = '收件箱';
$L['message_title_outbox'] = '已发送';
$L['message_title_draft'] = '草稿箱';
$L['message_title_recycle'] = '回收站';
$L['message_limit'] = '今日可发送{V0}次 当前已发送{V1}次';
$L['message_send_max'] = '最多同时给{V0}个人发送信件';
$L['message_list_date'] = 'Y年m月d日 H:i';
$L['message_from_system'] = '系统信使';
$L['message_from_notice'] = '系统广播';
$L['message_names'] = array(1=>'草稿箱', 2=>'已发送', 3=>'收件箱', 4=>'回收站');
$L['message_feedback_title'] = '您的来信 [{V0}] 已经阅读';
$L['message_feedback_content'] = '{V0} 于 <small style="color:blue;">{V1}</small> 阅读了您发送的信件<br/><div style="padding:10px;margin:10px 10px 0 0;border-left:#E5EBFA 3px solid;line-height:180%;background:#FFFFFF;"><strong>标题:</strong>{V2}<br/><strong>时间:</strong>{V3}<br/><strong>原文:</strong><br/>{V4}</div>';
$L['message_msg_edit'] = '信件不存在或无权修改';
$L['message_msg_null'] = '指定范围暂无信件';
$L['message_msg_save_draft'] = '草稿保存成功';
$L['message_msg_edit_draft'] = '草稿修改成功';
$L['message_msg_send'] = '信件发送成功';
$L['message_msg_choose'] = '请选择信件';
$L['message_msg_deny'] = '信件不存在或无权限';
$L['message_msg_clear'] = '成功清空';
$L['message_msg_mark'] = '已标记为已读';
$L['message_msg_restore'] = '成功还原';
$L['message_msg_empty'] = '清理成功';
$L['message_msg_inbox_limit'] = '收件箱已满，请清理信件';
$L['message_black_username'] = '请指定要加入黑名单的会员';
$L['message_black_not_member'] = '会员不存在，请检查';
$L['message_black_exist'] = '会员已经位于黑名单';
$L['message_black_update'] = '黑名单更新成功';
$L['message_pass_groupid'] = '请选择会员组';
$L['message_pass_touser'] = '收件人不能为空';
$L['message_pass_title'] = '标题或内容不能为空';

$L['news_title'] = '公司新闻';
$L['news_title_add'] = '添加新闻';
$L['news_title_edit'] = '修改新闻';
$L['news_record_add'] = '新闻发布';
$L['news_record_del'] = '新闻删除';
$L['news_msg_choose'] = '请选择新闻';

$L['pay_title'] = '站内支付';
$L['pay_record_view'] = '信息查看';
$L['pay_msg_fee'] = '支付金额错误';

$L['record_title'] = $DT['money_name'].'流水';
$L['record_title_login'] = '登录记录';
$L['record_title_pay'] = '信息查看记录';
$L['record_sfields'] = array($L['search_by'], '金额', '银行', '事由', $L['search_by_note']);

$L['register_title'] = '会员注册';
$L['register_msg_close'] = '管理员关闭了用户注册';
$L['register_msg_agent'] = '您的客户端信息已经被网站屏蔽<br/>如有疑问，请与我们联系';
$L['register_msg_ip'] = '同一IP{V0}小时内只能注册一次';
$L['register_msg_passport'] = '通行证名已经存在\n\n如果此通行证名是您注册的，请填写正确的密码\n\n如果不是您注册的，请更换通行证名';
$L['register_msg_activate'] = $DT['sitename'].'用户注册激活信';
$L['register_msg_welcome'] = '欢迎加入'.$DT['sitename'];
$L['register_pass_groupid'] = '请选择会员组';

/*2010-10-25<<*/
$L['register_msg_emailcode'] = $DT['sitename'].'用户注册邮件验证码';
$L['register_pass_emailcode'] = '邮件验证码错误';
/*2010-10-25>>*/

$L['renew_title'] = VIP.'服务续费';
$L['renew_msg_fee'] = '支付金额错误';
$L['renew_msg_success'] = '续费成功';
$L['renew_record'] = '{V0}年,{V1}到期';

$L['send_mail_close'] = '系统未开启邮件发送';
$L['send_sms_close'] = '系统未开启短信发送';

$L['send_check_success'] = '您的帐号激活成功';
$L['send_check_email_bad'] = '请填写正确的邮件地址';
$L['send_check_email_repeat'] = '您填写的邮件地址已经被使用，请更换';
$L['send_check_username_bad'] = '您的会员名输入错误';
$L['send_check_password_bad'] = '您的会员名和密码不匹配';
$L['send_check_deny'] = '您的帐号无需发送验证信';
$L['send_check_mail'] = $DT['sitename'].'用户注册激活信';
$L['send_check_username_null'] = '您输入会员名不存在';
$L['send_check_title'] = '重发验证信';
$L['send_payword_success'] = '支付密码重设成功';
$L['send_payword_mail'] = $DT['sitename'].'用户修改支付密码';
$L['send_payword_title'] = '支付密码';
$L['send_email_exist'] = 'Email地址已经被使用，请更换';
$L['send_email_success'] = 'Email重设成功';
$L['send_email_mail'] = $DT['sitename'].'用户修改Email';
$L['send_email_title'] = '修改Email';
$L['send_mobile_exist'] = '手机号码已经被占用，请更换';
$L['send_mobile_success'] = '手机修改成功';
$L['send_mobile_code_error'] = '认证码错误';
$L['send_mobile_bad'] = '手机号码格式不正确';
$L['send_mobile_record'] = '修改手机';
$L['send_mobile_title'] = '修改手机';
$L['send_password_success'] = '登录密码重设成功';
$L['send_password_checking'] = '您的帐号尚未通过审核';
$L['send_password_error'] = '提供的信息不匹配';
$L['send_password_mail'] = $DT['sitename'].'用户找回密码';
$L['send_password_title'] = '找回密码';

$L['sendmail_title'] = '发送电子邮件';
$L['sendmail_content'] = '您的好友 <strong><a href="{V0}" target="_blank">{V1}</a></strong> 向您推荐如下信息:<br/><br/>{V2}<br/><a href="{V3}" target="_blank">{V3}</a><br/><br/>附言：';
$L['sendmail_title_new'] = '推荐《{V0}》';
$L['sendmail_pass_mailto'] = '请填写正确的收件人地址';
$L['sendmail_success'] = '邮件已发送至{V0}';
$L['sendmail_fail'] = '邮件发送失败，请重试';

$L['sms_msg_validate'] = '请先认证您的手机号码';
$L['sms_msg_buy'] = '请先购买短信';
$L['sms_msg_mobile'] = '请填写正确的手机号码';
$L['sms_msg_content'] = '请填写短信内容';
$L['sms_add_record'] = '手动';
$L['sms_add_success'] = '短信已发送';
$L['sms_add_title'] = '发送短信';
$L['sms_not_enough'] = '短信余额不足';
$L['sms_msg_no_price'] = '系统未设置单价，无法购买';
$L['sms_msg_buy_num'] = '请填写购买数量';
$L['sms_buy_note'] = '购买短信';
$L['sms_buy_record'] = '在线购买';
$L['sms_buy_success'] = '购买成功';
$L['sms_buy_title'] = '短信购买';
$L['sms_record_title'] = '接收记录';
$L['sms_send_title'] = '发送记录';
$L['sms_title'] = '短信记录';
$L['sms_sfields'] = array($L['search_by'], '金额', '事由', $L['search_by_note']);

$L['type_title'] = '{V0}分类管理';
$L['type_names'] = array('friend'=>'商友', 'favorite'=>'收藏', 'product'=>'供应', 'news'=>'新闻');
$L['type_msg_limit'] = '最多可添加{V0}个分类';

$L['style_title'] = '模板设置';
$L['style_title_buy'] = '模板购买';
$L['style_sfields'] = array($L['search_by'], '名称', '作者');
$L['style_sorder'] = array($L['order_by'], '添加时间降序', '添加时间升序', '人气指数降序', '人气指数升序');
$L['style_record_buy'] = '{V0}模板购买{V1}月';
$L['style_msg_not_exist'] = '模板不存在';
$L['style_msg_group'] = '抱歉！此模板未对您所在的会员组开放';
$L['style_msg_month'] = '请选择购买时长';
$L['style_msg_buy_success'] = '模板购买成功';
$L['style_msg_use_success'] = '模板启用成功';
$L['style_pass_title'] = '请填写模板名称';
$L['style_pass_skin'] = '请填写风格目录';
$L['style_pass_skin_match'] = '只能使用字母(A-Z,a-z)、数字(0-9)、中划线(-)、下划线(_)作为风格目录名称';
$L['style_pass_css'] = 'CSS文件不存在';
$L['style_pass_template'] = '请填写模板目录';
$L['style_pass_template_match'] = '只能使用字母(A-Z,a-z)、数字(0-9)、中划线(-)、下划线(_)作为模板目录名称';
$L['style_pass_dir'] = '模板目录不存在';
$L['style_pass_groupid'] = '请选择会员组';

$L['trade_status'] = array(
	'<span style="color:#0000FF;">买家发起订单<br/>等待卖家确认</span>',
	'<span style="color:#FF6600;">卖家已确认订单<br/>等待买家付款</span>',
	'<span style="color:#008080;">买家已付款<br/>等待卖家发货</span>',
	'<span style="color:#FF0000;">卖家已发货<br/>等待买家确认</span>',
	'<span style="color:#008000;">交易成功</span>',
	'<span style="color:#FF0000;text-decoration:underline;">买家申请退款</span>',
	'<span style="color:#0000FF;text-decoration:underline;">已退款给买家</span>',
	'<span style="color:#FF6600;text-decoration:underline;">已付款给卖家</span>',
	'<span style="color:#888888;text-decoration:line-through;">买家关闭交易</span>',
	'<span style="color:#888888;text-decoration:line-through;">卖家关闭交易</span>',
);
$L['trade_dstatus'] = array(
	'买家发起订单,等待卖家确认',
	'卖家已确认订单,等待买家付款',
	'买家已付款,等待卖家发货',
	'卖家已发货,等待买家确认',
	'交易成功',
	'买家申请退款',
	'已退款给买家',
	'已付款给卖家',
	'买家关闭交易',
	'卖家关闭交易',
);
$L['trade_msg_deny'] = '您无权进行此操作';
$L['trade_msg_null'] = '订单不存在';
$L['trade_price_fee_null'] = '请填写附加金额';
$L['trade_price_fee_name'] = '请填写附加金额名称';
$L['trade_price_edit_success'] = '订单修改成功';
$L['trade_price_title'] = '修改价格';
$L['trade_detail_title'] = '订单详情';
$L['trade_confirm_success'] = '订单已确认，请等待买家付款';
$L['trade_pay_order_success'] = '支付成功，金额暂时被锁定，请等待卖家发货';
$L['trade_pay_order_title'] = '订单支付';
$L['trade_refund_reason'] = '请填写理由及证据';
$L['trade_refund_success'] = '您的退款申请已经提交，请等待网站处理';
$L['trade_refund_title'] = '申请退款';
$L['trade_send_success'] = '已经确认发货，请等待买家确认收货';
$L['trade_send_title'] = '确认发货';
$L['trade_addtime_null'] = '请填写延长的时间';
$L['trade_addtime_success'] = '买家确认时间延长成功';
$L['trade_addtime_title'] = '延长买家确认时间';
$L['trade_success'] = '恭喜！此订单交易成功';
$L['trade_close_success'] = '交易已关闭';
$L['trade_delete_success'] = '订单删除成功';
$L['trade_pay_seller'] = '请填写收款会员名';
$L['trade_pay_self'] = '收款人不能是自己';
$L['trade_pay_seller_bad'] = '收款会员名不存在，请确认';
$L['trade_pay_amount'] = '请填写付款金额';
$L['trade_pay_note'] = '请填写付款说明';
$L['trade_pay_goods'] = '请填写商品或服务名称';
$L['trade_pay_title'] = '我要付款';
$L['trade_pay1_success'] = '直接付款成功，会员[{V0}]将直接收到您的付款';
$L['trade_pay0_success'] = '订单已经发出，请等待卖家确认';
$L['trade_order_sfields'] = array('按条件', '商品或服务', '金额', '附加金额', '附加名称', '卖家', '发货方式', '物流号码', '备注');
$L['trade_order_title'] = '发出的订单';
$L['trade_sfields'] = array('按条件', '商品或服务', '金额', '附加金额', '附加名称', '买家', '买家姓名', '买家地址', '买家邮编', '买家电话', '发货方式', '物流号码', '备注');
$L['trade_title'] = '发出的订单';
$L['trade_record_pay'] = '订单货到付款';
$L['trade_record_payfor'] = '站内付款';
$L['trade_record_receive'] = '站内收款';
$L['trade_record_new'] = '通知卖家确认订单';
$L['trade_order_id'] = '订单号:';
$L['trade_buyer_timeout'] = '订单号{V0}[买家超时]';
$L['trade_sms_confirm'] = '通知买家付款';
$L['trade_sms_pay'] = '通知卖家发货';
$L['trade_sms_send'] = '通知买家已发货';
$L['trade_sms_income'] = '站内付款通知';
$L['trade_message_t1'] = '站内交易提醒，您有一笔交易需要付款(T{V0})';
$L['trade_message_c1'] = '卖家 <a href="{V0}" class="t">{V1}</a> 于 <span class="f_gray">{V2}</span> 确认了您的订单<br/><a href="{V3}" class="t" target="_blank">&raquo; 请点这里立即处理或查看详情</a>';
$L['trade_message_t2'] = '站内交易提醒，您有一笔交易需要发货(T{V0})';
$L['trade_message_c2'] = '买家 <a href="{V0}" class="t">{V1}</a> 于 <span class="f_gray">{V2}</span> 支付了您的订单<br/><a href="{V3}" class="t" target="_blank">&raquo; 请点这里立即处理或查看详情</a>';
$L['trade_message_t3'] = '站内交易提醒，您有一笔交易需要收货(T{V0})';
$L['trade_message_c3'] = '卖家 <a href="{V0}" class="t">{V1}</a> 于 <span class="f_gray">{V2}</span> 已经发货<br/><a href="{V3}" class="t" target="_blank">&raquo; 请点这里立即处理或查看详情</a>';
$L['trade_message_t4'] = '站内交易提醒，您有一笔交易已经成功(T{V0})';
$L['trade_message_c4'] = '买家 <a href="{V0}" class="t">{V1}</a> 于 <span class="f_gray">{V2}</span> 确认收货，交易完成<br/><a href="{V3}" class="t" target="_blank">&raquo; 请点这里立即处理或查看详情</a>';
$L['trade_message_t5'] = '站内收入提醒，您收到一笔付款';
$L['trade_message_c5'] = '<a href="{V0}" class="t">{V1}</a> 于 <span class="f_gray">{V2}</span> 向您支付了 <span class="f_blue">{V3}'.$DT['money_unit'].'</span> 的站内付款<br/>备注：<span class="f_gray">{V4}</span>';
$L['trade_message_t6'] = '站内交易提醒，您有一笔交易需要确认(T{V0})';
$L['trade_message_c6'] = '<a href="{V0}" class="t">{V1}</a> 于 <span class="f_gray">{V2}</span> 向您订购了：<br/>{V3}<br/>订单编号：<span class="f_red">T{V4}</span> &nbsp;订单金额为：<span class="f_blue f_b">{V5}'.$DT['money_unit'].'</span><br/><a href="{V6}" class="t" target="_blank">&raquo; 请点这里立即处理或查看详情</a>';

$L['validate_email_exist'] = 'Email地址已经被使用，请更换';
$L['validate_email_success'] = '您的邮件认证成功';
$L['validate_email_bad'] = 'Email格式不正确';
$L['validate_email_mail'] = $DT['sitename'].'用户邮件认证';
$L['validate_email_title'] = '邮件认证';
$L['validate_mobile_exist'] = '手机号码已经被占用，请更换';
$L['validate_mobile_title'] = '手机认证';
$L['validate_mobile_success'] = '您的手机认证成功';
$L['validate_mobile_code_error'] = '认证码错误';
$L['validate_mobile_bad'] = '手机号码格式不正确';
$L['validate_mobile_record'] = '手机认证';
$L['validate_truename_title'] = '实名认证';
$L['validate_truename_name'] = '请填写真实姓名';
$L['validate_truename_image'] = '请上传证件图片';
$L['validate_truename_success'] = '提交成功';
$L['validate_company_title'] = '公司认证';
$L['validate_company_name'] = '请填写公司名';
$L['validate_company_image'] = '请上传证件图片';
$L['validate_company_success'] = '提交成功';
$L['validate_bank_title'] = '银行帐号认证';
?>