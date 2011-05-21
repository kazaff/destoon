
SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `keke_witkey_ad`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_ad`;
CREATE TABLE `keke_witkey_ad` (
  `ad_id` int(11) NOT NULL auto_increment,
  `ad_type` int(11) default NULL,
  `ad_name` varchar(300) default NULL,
  `ad_file` varchar(300) default NULL,
  `ad_content` text,
  `ad_url` varchar(100) default NULL,
  `ad_cash` float default NULL,
  `start_time` int(11) default NULL,
  `end_time` int(11) default NULL,
  `uid` int(11) default NULL,
  `username` varchar(100) default NULL,
  `listorder` int(11) default NULL,
  `width` varchar(15) default NULL,
  `height` varchar(15) default NULL,
  PRIMARY KEY  (`ad_id`),
  KEY `index_1` (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_ad
-- ----------------------------
INSERT INTO keke_witkey_ad VALUES ('1', '2', '首页幻灯', 'data/uploads/2010/10/13/13374cb588543457c.gif', '客客出品的专业威客系统', 'http://www.phpclub.cn', '100', '1286965332', '1286965332', '1', 'admin', '4', '', '');
INSERT INTO keke_witkey_ad VALUES ('2', '2', '首页幻灯', 'data/uploads/2010/06/25/02.gif', '客客威客发布了', 'http://www.phpclub.cn', '100', '1278561626', '1278561626', '1', 'admin', '1', '', '');
INSERT INTO keke_witkey_ad VALUES ('3', '2', '首页幻灯', 'data/uploads/2010/06/25/03.gif', '新理念，新架构', 'http://www.phpclub.cn', '100', '1278561630', '1278561630', '1', 'admin', '1', '', '');
INSERT INTO keke_witkey_ad VALUES ('4', '2', '首页幻灯', 'data/uploads/2010/06/25/04.gif', '全新的开发模式', 'http://www.phpclub.cn', '100', '1278561640', '1278561640', '1', 'admin', '1', '', '');
INSERT INTO keke_witkey_ad VALUES ('5', '2', '首页幻灯', 'data/uploads/2010/06/25/05.gif', '最优秀的威客系统', 'http://www.phpclub.cn', '100', '1278561635', '1278561635', '1', 'admin', '1', '', '');
INSERT INTO keke_witkey_ad VALUES ('6', '2', '服务产品页内容广告', 'data/uploads/2010/10/01/314814ca55477b62d5.jpg', '', '', null, '1285903479', '1285903479', null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('7', '2', '人才广告', 'data/uploads/2010/11/17/52974ce3964fb78ef.jpg', '群英招聘会', '', null, '1289983567', '1289983567', null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('8', '2', '人才广告', 'data/uploads/2010/10/30/226834ccbf82fa5afe.jpg', '托管', '', null, '1288435759', '1288435759', null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('9', '2', '人才广告', 'data/uploads/2010/10/30/257704ccbf81853b19.jpg', '华山论剑', '', null, '1288435736', '1288435736', null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('10', '2', '商城幻灯', 'data/uploads/2010/11/17/81924ce394dd51a1f.jpg', '模板设计大赛', '#', null, '1289983197', '1289983197', null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('11', '2', '商城幻灯', 'data/uploads/2010/11/17/148834ce394ccb6ef8.gif', '中秋节形象创作大赛', '#', null, '1289983180', '1289983180', null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('12', '2', '商城幻灯', 'data/uploads/2010/11/17/82124ce3950fec3de.jpg', '团购网，如何让人恋上你', '#', null, '1289983247', '1289983247', null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('13', '2', '商城幻灯', 'data/uploads/2010/11/17/141624ce394bb0f83e.jpg', '秀出你的创意婚礼', '#', null, '1289983163', '1289983163', null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('104', '2', '推荐店铺1', 'data/uploads/2010/10/09/77084cafd0dc0d792.png', '', 'shop.php?do=service_info&sid=51', null, '1289993007', '1289993007', null, null, '0', '240', '80');
INSERT INTO keke_witkey_ad VALUES ('105', '2', '推荐店铺2', 'data/uploads/2010/10/09/325854cafd2056af8b.png', '', 'shop.php?do=service_info&sid=45', null, '1289993018', '1289993018', null, null, '0', '240', '80');
INSERT INTO keke_witkey_ad VALUES ('106', '2', '推荐店铺3', 'data/uploads/2010/10/09/25974cafd21ae8da8.png', '', 'shop.php?do=service_info&sid=54', null, '1289993025', '1289993025', null, null, '0', '240', '80');

-- ----------------------------
-- Table structure for `keke_witkey_admin_notice`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_admin_notice`;
CREATE TABLE `keke_witkey_admin_notice` (
  `notice_id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `content` text,
  PRIMARY KEY  (`notice_id`),
  KEY `index_1` (`notice_id`),
  KEY `index_2` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_admin_notice
-- ----------------------------
INSERT INTO keke_witkey_admin_notice VALUES ('1', '1', '');

-- ----------------------------
-- Table structure for `keke_witkey_article`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_article`;
CREATE TABLE `keke_witkey_article` (
  `art_id` int(11) NOT NULL auto_increment,
  `art_cat_id` int(11) default '0',
  `uid` int(11) default '0',
  `username` varchar(50) default NULL,
  `art_title` varchar(200) default NULL,
  `art_source` varchar(200) default NULL,
  `art_pic` varchar(100) default NULL,
  `content` longtext,
  `is_recommend` int(11) default '0',
  `seo_title` varchar(500) default NULL,
  `seo_keyword` varchar(500) default NULL,
  `seo_desc` varchar(500) default NULL,
  `listorder` int(11) default '0',
  `is_show` int(11) default '1',
  `is_delineas` int(11) default '0',
  `pub_time` int(11) default '0',
  `views` int(11) NOT NULL default '0',
  PRIMARY KEY  (`art_id`),
  KEY `index_1` (`art_id`),
  KEY `index_2` (`art_cat_id`),
  KEY `index_3` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=1143 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_article
-- ----------------------------
INSERT INTO keke_witkey_article VALUES ('1019', '119', '1', '0', '如何保障自己帐户的安全', '0', '0', '如果您通过了实名认证，当您忘记密码或帐号被盗时，只要提供相关的有效证件到KPPW进行申诉，您就可以重新拿回您的帐号密码：<br />　申请实名认证的方法：<br />　１,登录KPPW。<br />　２,进入认证中心<br />　３,点击实名认证下面的“申请实名认证”<br />　４,填写您的身份信息<br />&nbsp;&nbsp;&nbsp; ５,填写好正确的信息后，提交认证，我们的工作人员将在一个工作日内给您回复', '1', '0', '0', '0', '0', '1', '0', '1277086710', '5');
INSERT INTO keke_witkey_article VALUES ('1020', '119', '1', '0', '帐号被盗或者忘记用户名密码怎么办', '0', '0', '如果你注册时填写了邮箱或您通过了邮箱认证，您可以通过找回密码功能来重新得到您的帐号。<br />使用方法：<br />１,进入登录页面<br />２,点击“ 忘记密码了？”链接，进入找回密码程序。<br />３,填写您的用户名，点击下一步<br />４,填写您的邮箱地，点击“取回密码”按钮<br />５,您会看到如下消息：<br />取回密码的方法已经通过 Email 发送到您的信箱中，<br />请在 3 天之内修改您的密码。<br />６,请按系统提示操作即可取回您的密码。<br />', '0', '0', '0', '0', '0', '1', '0', '1277087114', '1');
INSERT INTO keke_witkey_article VALUES ('1021', '119', '1', '0', '我们有哪些支付方式？', '0', '0', '<span style=\"font-size:x-small;\">支付宝账户余额支付、易宝账户余额支付、快钱账户余额支付、各个银行网营支付、信用卡支付。<br /></span>', '1', '0', '0', '0', '0', '1', '0', '1279953222', '3');
INSERT INTO keke_witkey_article VALUES ('1056', '114', '1', 'admin', '什么是威客？', '客客出品', '', '<p>&nbsp;&nbsp;&nbsp; 威客是英文Witkey（wit智慧、key钥匙）的音译。威客是指在网络时代凭借自己的能力（智慧和创意），在互联网上出售自己的富裕工作时间和劳动成果而获得报酬的人。通俗地讲，威客就是在网络平台上出售自己无形资产成果价值的工作者群体。&nbsp;<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;在新经济（商业）环境中做威客的人，种类各式各样，除了各个行业、各个领域之外，还包括掌握各类创新理论（经济和管理）的人。在这些掌握各类创新理论（经济和管理）的人中，有经济威客、管理威客和网络威客等各个领域的威客。甚至可以夸张地说，在互联网威客这平台上，没有所谓的经济学家、管理学家等各式各样的专家学者，只有威客。而威客类网站的出现，为有知识生产加工能力的个人创造了一个销售知识产品的商业平台和机会。<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;总而言之，威客模式的出现，为个人的知识（资源）买卖带来商机。随着威客时代的来临，每一个威客都可以将自己的知识、经验和学术研究成果作为一种无形的“知识商品”和服务在网络上来销售。威客通过威客网站这个平台买卖“知识产品”，让自己的知识、经验和学术研究成果逐步转化成个人财富。在威客模式下，个人的知识（资源）不但是力量，而且又是个人的财富。在以知识资源应用开发的新经济（商业）时代，无论是个人或组织拥有知识就拥有财富。<strong></strong></p>', '0', '什么是威客？', '什么是威客？', '什么是威客？', '0', '1', '0', '1279941537', '4');
INSERT INTO keke_witkey_article VALUES ('1057', '114', '1', 'admin', '本系统能做什么？', '客客出品', '', '<p>KPPW是一款基于PHP+MYSQL技术构架的威客系统 ，积客客团队多年实践和对威客模式商业化运作的大量调查分析而精心策划研发。KPPW针对威客 任务模型进行了细致的分析，提供完善威客任务流程控制解决方案。</p><p>在本系统里：需求方（客户）自由确定成果要求标准，自由确定劳动报酬，以报酬全额预付托管方式发布征集（招标）工作项目获得成果；威客会员（工作者）根据客户的成果要求，在项目下自由报名参与、集中提交作品供客户选择。客户最终选中的中标成果创作者获得该项目的报酬。</p>', '0', '本系统能做什么？', '本系统能做什么？', '本系统能做什么？', '0', '1', '0', '1279941519', '2');
INSERT INTO keke_witkey_article VALUES ('1058', '114', '1', 'admin', '怎么注册成为威客会员？', '客客出品', '', '<p>1、点击首页的注册按钮，进入注册页面。</p><p><img src=\"data/uploads/2010/07/24/178154c4a5db520624.jpg\" alt=\"\" /></p><p>&nbsp;</p><p>2、按要求填写相关注册信息。比如：用户名、邮箱、密码等<br />3、点击“注册”按钮提交，提示注册成功。</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', '0', '怎么注册成为威客会员？', '怎么注册成为威客会员？', '怎么注册成为威客会员？', '0', '1', '0', '1279943335', '20');
INSERT INTO keke_witkey_article VALUES ('1043', '113', '1', '0', '会员抄袭处理规则\'', '0', '0', 'a、剽窃（抄袭）者使用他人作品是否超出了“适当引用”的范围。<br />b、关于“适当引用”的数量界限，我国《图书期刊保护试行条例实施细则》第十五条明确规定：“引用非诗词类作品不得超过2500字或被引用作品的十分之一”；“凡引用一人或多人的作品，所引用的总量不得超过本人创作作品总量的十分之一”。', '1', '0', '0', '0', '0', '1', '0', '1277092727', '2');
INSERT INTO keke_witkey_article VALUES ('1069', '120', '1', 'admin', '选稿评标有期限吗？', '客客出品', '', '<p>任务选稿的期限是根据悬赏金额来计算判断的。</p><p>雇主的项目都有选稿评标期限，尽可能最大限度的保障威客会员的劳动成果权益。 </p><p>因项目无满意作品的情况，很大程度上是悬赏酬金价格不合理原因所致，建议发布者将任务进行加价延期，已确保任务能够顺利完成。</p>', '0', '选稿评标有期限吗？', '选稿评标有期限吗？', '选稿评标有期限吗？', '0', '1', '0', '1279951935', '2');
INSERT INTO keke_witkey_article VALUES ('1070', '120', '1', 'admin', '有了满意的结果怎么样选定中标？', '客客出品', '', '<p>登录您的任务详细页面，点击“查看交稿”，在每个作品下面点击相对应的［选稿中标］按键即可。（图）</p><p><img src=\"data/uploads/2010/07/24/262954c4a848b1f09b.jpg\" alt=\"\" /></p>', '0', '有了满意的结果怎么样选定中标？', '有了满意的结果怎么样选定中标？', '有了满意的结果怎么样选定中标？', '0', '1', '0', '1279952014', '4');
INSERT INTO keke_witkey_article VALUES ('1071', '120', '1', 'admin', '怎样参与项目？', '客客出品', '', '<p>1、注册成为会员。</p><p>2、浏览项目，点击参与。(已经结束的或处于评标状态的项目不能再参与)。<br />3、方案完成后，进入管理中心，找到我参与的项目，上传即可（分为文字及附件形式的方案，文字方案可直接写在方案说明里）。<br />4、在未评标之前可以修改方案。<br />5、等待客户评标。<br />6、客户选定中标作品后，系统将发出中标通知，并公布中标者及其作品。<strong></strong></p>', '0', '怎样参与项目？', '怎样参与项目？', '怎样参与项目？', '0', '1', '0', '1279952173', '1');
INSERT INTO keke_witkey_article VALUES ('1072', '120', '1', 'admin', '如何知道自己的作品中标？', '客客出品', '', '<p>1、&nbsp; 网站上会发出中标通知的。</p><p>2、&nbsp; 在管理中心，我参与的项目处会显示“中标”字样。</p><p>3、在个人消息中心，可以收到中标的系统消息。<strong></strong></p>', '0', '如何知道自己的作品中标？', '如何知道自己的作品中标？', '如何知道自己的作品中标？', '0', '1', '0', '1279952242', '2');
INSERT INTO keke_witkey_article VALUES ('1073', '120', '1', 'admin', '怎样查看我参与的项目？', '客客出品', '', '<p>1、登录状态下进管理中心<br />2、点击我参与的项目，就会显示您所参与的所有项目，如有中标项目，会显示“中标”字样，未提交方案的项目有“上传字样”。<strong></strong></p>', '0', '怎样查看我参与的项目？', '怎样查看我参与的项目？', '怎样查看我参与的项目？', '0', '1', '0', '1279952411', '4');
INSERT INTO keke_witkey_article VALUES ('1074', '120', '1', 'admin', '项目发布与管理核心规则', '客客出品', '', '<p>本站一直本着公开、公平、公正、诚实、守信的原则，致力于打造中国最具诚信的创意服务电子商务交易平台。请在您发布任务前仔细阅读任务发布规则： </p><p>1、任务发布者自由定价，自由确定悬赏时间，自由发布任务要求，自主确定中标会员和中标方案。 </p><p>2、任务发布者100%预付任务赏金，让竞标者坚信您的诚意和诚信。 </p><p>3、任务赏金分配原则：任务一经发布，网站收取一定的发布费，中标会员获得其他费用作为任务赏金。</p><p>4、每个任务最终都会选定至少一个作品中标,至少一个竞标者获得赏金。 </p><p>5、任务发布者若未征集到满意作品，可以加价延期征集，也可让会员修改。 </p><p>6、任务发布者自己所在组织的任何人均不能以任何形式参加自己所发布的任务，一经发现则视为任务发布者委托管理员按照网站规则选稿。 </p><p>7、任务悬赏总金额低于100元(含100元)的任务，悬赏时间最多为7天。所有任务最长时间不超过30天（特殊任务除外）,任务总金额不得低于50元。 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p><p>8、延期任务只有3次加价机会，第1次加价不得低于任务金额的10%，第2次加价不得低于任务总金额的20%，第3次不得低于任务总金额的50%。每次延期不能超过10天，加价金额不低于50元</p><p>9、任务结束后，任务发布者有7天的选稿时间，如无特殊原因，应在7天内公布中标作品或加价延期。如果超过选稿时间，网站在3日内电话通知客户后仍不选稿或不加价，将视为任务发布者委托网站选稿，系统选稿无源文件。 </p><p>10、任务选稿后，网站将公示3天，以便查看该任务是否有抄袭作弊的情况。公示期内，中标会员应将源文件传送给任务发布者，发布者在公示期3天之内不来确认，将视为全权委托网站工作人员处理。 </p><p>11、发布者与投标会员，应严格按照每个任务的“任务要求”所描述的内容执行。如果发布者提出超出“任务要求”范围的要求，会员有权拒绝，发布者也不得以此为理由拒绝选出中标方案或退款。 </p><p>12、如果您的任务在征集时间结束后，没有任何交稿，网站将免费延期一次。 </p><p>13、会员在中标后被举报涉嫌抄袭的作品，经过调查核实，管理员将取消中标资格。<strong></strong></p>', '0', '项目发布与管理核心规则', '项目发布与管理核心规则', '项目发布与管理核心规则', '0', '1', '0', '1279952460', '1');
INSERT INTO keke_witkey_article VALUES ('1068', '120', '1', 'admin', '正在进行中的项目可以提前结束吗？', '客客出品', '', '<p>所有进行中任务都可以提前结束。当任务发布者在任务交稿截止之前已经有了满意的结果，可随时选定中标结果。中标结果经管理员审核认定后，任务即可提前结束。</p>', '0', '正在进行中的项目可以提前结束吗？', '正在进行中的项目可以提前结束吗？', '正在进行中的项目可以提前结束吗？', '0', '1', '0', '1279951884', '2');
INSERT INTO keke_witkey_article VALUES ('1066', '120', '1', 'admin', '什么是计件任务？', '客客出品', '', '<p>计件任务是多人中标模式的一种延伸，由于计件任务要求合格稿件达到一定的量，因此只要威客所提稿件符合雇主要求，即可中标。雇主在发布任务时先确定任务的总赏金及要求稿件的数目，系统会据此算出每个稿件的赏金。威客参与计件任务，每达标一个即可获得单个稿件金额。</p>', '0', '什么是计件任务？', '什么是计件任务？', '什么是计件任务？', '0', '1', '0', '1279951800', '1');
INSERT INTO keke_witkey_article VALUES ('1067', '120', '1', 'admin', '什么是推广任务？', '客客出品', '', '<p>推广任务是雇主为了让更多用户发现和参与此任务，针对此任务而增加的推广模式。雇主在选择推广任务时，需要支付一定的费用。这样在此任务的显示页会有一个专属的任务推广按钮，所有会员都可以复制和宣传此链接，最终推广任务佣金会根据此任务完成的实际情况核算。即以效果为主的推广方式，推广给中标会员者获得此佣金。</p>', '0', '什么是推广任务？', '什么是推广任务？', '什么是推广任务？', '0', '1', '0', '1279951849', '2');
INSERT INTO keke_witkey_article VALUES ('1064', '120', '1', 'admin', '悬赏任务高级选项有什么作用？', '客客出品', '', '<span style=\"font-family:Arial;\"></span><p>悬赏任务的高级选项，是为了帮助任务发布者找到最合适的任务承接着提供的功能。其中包含了任务的分配方式和任务推广的高级可选功能。</p>', '0', '悬赏任务高级选项有什么作用？', '悬赏任务高级选项有什么作用？', '悬赏任务高级选项有什么作用？', '0', '1', '0', '1279951692', '3');
INSERT INTO keke_witkey_article VALUES ('1065', '120', '1', 'admin', '什么是多人中标任务？', '客客出品', '', '<p>雇主选择多人中标模式，说明此次任务需要多人来完成。即雇主可选择两个以上的作品中标。</p><p>多人中标模式，雇主可以自行设计奖项个数（最多可设三个奖项），每个奖项相应的人数和赏金。如雇主悬赏1000元，设置以下三个奖项：</p><p>一等奖&nbsp;&nbsp; 若1人&nbsp;&nbsp; 平均分配&nbsp; 若干300钱</p><p>二等奖&nbsp;&nbsp; 若2人&nbsp;&nbsp; 平均分配&nbsp; 若干400钱</p><p>三等奖&nbsp;&nbsp; 若3人&nbsp;&nbsp; 平均分配&nbsp; 若干300元钱</p>', '0', '什么是多人中标任务？', '什么是多人中标任务？', '什么是多人中标任务？', '0', '1', '0', '1279951749', '2');
INSERT INTO keke_witkey_article VALUES ('1063', '120', '1', 'admin', '悬赏任务发布有周期限制？', '客客出品', '', '<p>悬赏任务发布周期限制为了保证本系统内悬赏任务有效性，做出的适当控制。目前对悬赏任务的周期限制与任务金额形成一定的比例，如:</p><p>100元以上任务，可以持续5天</p><p>500元以上任务，可以持续10天</p><p>1500元以上任务，可以持续15天</p>', '0', '悬赏任务发布有周期限制？', '悬赏任务发布有周期限制？', '悬赏任务发布有周期限制？', '0', '1', '0', '1279944235', '3');
INSERT INTO keke_witkey_article VALUES ('1062', '120', '1', 'admin', '怎样发布悬赏项目？', '客客出品', '', '<p>1、&nbsp; 登录状态下，点击发布任务按钮；</p><p>2、&nbsp; 选择发布任务类型：悬赏任务</p><p><img src=\"data/uploads/2010/07/24/242064c4a65461e0e6.jpg\" alt=\"\" /></p><p></p><p>3、&nbsp; 按要求填写相关任务信息，如：任务金额、任务周期、任务分类、任务标题、任务内容、任务附件；</p><p><img src=\"data/uploads/2010/07/24/139994c4a656695862.jpg\" alt=\"\" /></p><p></p><p>4、&nbsp; 根据任务情况可填写高级选项，任务高级模式可选择多人中标和计件中标；任务宣传可选择用户推广此任务；</p><div><img src=\"file:///C:/Users/Administrator/AppData/Roaming/Tencent/Users/64064216/QQ/WinTemp/RichOle/P%60M_62NW5]V]_MVCKZ%6047WU.jpg\" alt=\"\" /> </div><p></p><p>5、&nbsp; 任务确认，并付款。如账户有余额（包含代金券）点击确认付款后会自动扣款，如账户无余额会跳转到支付页面。</p><p>&nbsp;<img src=\"data/uploads/2010/07/24/191324c4a6593a15cb.jpg\" alt=\"\" /></p>', '0', '怎样发布悬赏项目？', '怎样发布悬赏项目？', '怎样发布悬赏项目？', '0', '1', '0', '1279944108', '5');
INSERT INTO keke_witkey_article VALUES ('1061', '114', '1', 'admin', '用户注册时应注意哪些问题？', '客客出品', '', '<p>&nbsp;</p><p>1、考虑好用户名。因为注册后将不可更改。<br />2、填写真实信息。以便管理员在确认评标与中标通知时联系。<br />3、密码设置。为保证用户名安全，请设置一个复杂的密码。<br />4、注册时请仔细阅读《注册条款》，详细了解威客中国的相关规则，使您更准确的了解您所拥有的权利。</p>', '0', '用户注册时应注意哪些问题？', '用户注册时应注意哪些问题？', '用户注册时应注意哪些问题？', '0', '1', '0', '1279943746', '3');
INSERT INTO keke_witkey_article VALUES ('1060', '114', '1', 'admin', '忘记了用户登录密码怎么办？', '客客出品', '', '<p>忘记密码后，可以通过用户名和注册邮箱获取新的密码。</p><p><img src=\"data/uploads/2010/07/24/12344c4a638b057c0.jpg\" alt=\"\" /></p><p>&nbsp;</p><p><img src=\"data/uploads/2010/07/24/147554c4a63ad04c91.jpg\" alt=\"\" /></p><p>&nbsp;</p><p>注：新密码需登录注册邮箱获取，原密码将不可使用。</p>', '0', '忘记了用户登录密码怎么办？', '忘记了用户登录密码怎么办？', '忘记了用户登录密码怎么办？', '0', '1', '0', '1279943662', '2');
INSERT INTO keke_witkey_article VALUES ('1059', '114', '1', 'admin', '个人资料或密码修改操作步骤！', '客客出品', '', '<p>1、登录状态下，点击用户中心。&nbsp;<strong></strong></p><p>2、进管理中心，点击左侧的修改资料，其中用户名、真实姓名、联系方式、银行账号不能更改。</p><p><img src=\"http://localhost/kppw_utf8/data/uploads/2010/07/24/199814c4a6326b0f0b.jpg\" jquery1279943365150=\"112\" alt=\"\" /></p><p>&nbsp;</p><p>3、按要求进行完善和修改。</p>', '0', '个人资料或密码修改操作步骤！', '个人资料或密码修改操作步骤！', '个人资料或密码修改操作步骤！', '0', '1', '0', '1279943470', '4');
INSERT INTO keke_witkey_article VALUES ('1075', '120', '1', 'admin', '延期或加价流程', '客客出品', '', '<p>1、&nbsp; 客户发布项目后应及时查看项目成果，项目截止后发布方有7天评标期。在7天时间内确定中标结果或作出加价、延期决定。 </p><p>2、&nbsp; 项目首次悬赏无人参与的项目，可享有一次免费延期，延期时间不超过7天。</p><p>3、&nbsp; 延期任务只有3次加价机会，第1次加价不得低于任务金额的10%，第2次加价不得低于任务总金额的20%，第3次不得低于任务总金额的50%。每次延期不能超过10天，加价金额不低于50元</p>', '0', '延期或加价流程', '延期或加价流程', '延期或加价流程', '0', '1', '0', '1279952513', '1');
INSERT INTO keke_witkey_article VALUES ('1076', '120', '1', 'admin', '项目评标规则', '客客出品', '', '<p>1、发布者在项目发布后应及时查看项目成果，项目截止后发布方有7天评标期。在7天时间内确定中标结果或作出加价、延期决定。如在项目结束前就产生了满意作品也可提前评标。 <br />&nbsp;&nbsp;&nbsp;&nbsp;2、如果有特殊原因不能按时评标，请提前向管理员申请备案，可适当延长评标时间。 <br />&nbsp;&nbsp;&nbsp;&nbsp;3、若项目到期不按时评标，15日内客户仍未做出任何选择或合理处理办法，将视为客户自动放弃评标权利，系统将自动将此任务转为投票中，并从稿件区产生中标结果，并支付中标报酬。<br />&nbsp;&nbsp;&nbsp;&nbsp;4、项目发布方应本着诚信、公平的态度，尊重威客工作者的劳动成果权益，不得以任何方式选择产生出不公平、不公正、不诚信的中标结果。<br />&nbsp;&nbsp;&nbsp;&nbsp;5、项目发布方若有评标不诚信行为（指与项目发布者有直接关连的人员参与了该项目且获得中标的行为），本站有权取消其项目评标资格，该项目将作为废标项目进行相应处理。<br />&nbsp;&nbsp;&nbsp;&nbsp;6、本站始终坚持不懈地保护知识产权，坚定中立公信原则维护项目发布方利益和威客工作者劳动成果权益，坚决反对作品抄袭侵权行为，坚决反对套取中标金及剽窃作品成果行为，坚决反对发布者以任何作弊方式影响中标结果的公平产生。</p>', '0', '项目评标规则', '项目评标规则', '项目评标规则', '0', '1', '0', '1279952567', '1');
INSERT INTO keke_witkey_article VALUES ('1077', '120', '1', 'admin', '支付及项目成果交接', '客客出品', '', '1、 每个项目产生中标结果后，有7天的项目公示期，以接受公众的监督和举报。公示期满无侵权、抄袭、作弊等证据投诉，并得到客户最终付款确认后才支付到中标会员的威客通账户。<br />2、 系统公示期如无人举报，系统将示为正常结束，并在时间截止后自动将款项划入承接者账户。', '0', '支付及项目成果交接', '支付及项目成果交接', '支付及项目成果交接', '0', '1', '0', '1279952618', '1');
INSERT INTO keke_witkey_article VALUES ('1078', '120', '1', 'admin', '项目失败退款', '客客出品', '', '<p>1、项目如无人承接或进行失败后，系统会扣除任务发布费用后，将剩余款项以代金券方式返还到用户账户。用户代金券可以作为用户站内余额，用于下次任务发布使用。</p><p>2、推广任务失败，系统不收取佣金。</p>', '0', '项目失败退款', '项目失败退款', '项目失败退款', '0', '1', '0', '1279952696', '1');
INSERT INTO keke_witkey_article VALUES ('1079', '121', '1', 'admin', '怎样发布招标任务？', '客客出品', '', '<p>1、&nbsp; 登录状态下，点击发布任务按钮；</p><p>2、&nbsp; 选择发布任务类型：招标任务</p><p><img src=\"data/uploads/2010/07/24/265554c4a879be9216.jpg\" alt=\"\" /></p><p></p><p>3、&nbsp; 按要求填写相关任务信息，如：任务金额、任务周期、任务分类、任务标题、任务内容、任务附件；</p><p><img src=\"data/uploads/2010/07/24/217204c4a87c18d278.jpg\" alt=\"\" /></p><p>4、&nbsp; 任务确认，并付款。如账户有余额（包含代金券）点击确认付款后会自动扣款，如账户无余额会跳转到支付页面。招标任务仅扣除固定的任务发布费用。</p>', '0', '怎样发布招标任务？', '怎样发布招标任务？', '怎样发布招标任务？', '0', '1', '0', '1279952839', '1');
INSERT INTO keke_witkey_article VALUES ('1080', '121', '1', 'admin', '招标任务发布与管理核心规则', '客客出品', '', '<p>1、招标任务赏金托管0提成，本站只收取固定的任务发布费用。<br />2、任务发布者必须保证任务真实有效且不违反国家相关法律规定，如不满足上诉条件猪八戒网有权拒绝通过审核，不予发布任务。<br />3、雇主和投标者自由交流沟通合作，建议与该威客签订相关协议，详细确定需要工作的具体内容，本站不会（无权）帮助处理纠纷</p>', '0', '招标任务发布与管理核心规则', '招标任务发布与管理核心规则', '招标任务发布与管理核心规则', '0', '1', '0', '1279952890', '1');
INSERT INTO keke_witkey_article VALUES ('1086', '143', '1', 'admin', '全款悬赏任务流程', 'kekezu.com', '', '全款悬赏任务流程', '0', '全款悬赏任务流程', '全款悬赏任务流程', '全款悬赏任务流程', '0', '1', '0', '1283824554', '23');
INSERT INTO keke_witkey_article VALUES ('1087', '143', '1', 'admin', '指定承接任务流程', 'kekezu.com', '', '指定承接任务流程', '0', '指定承接任务流程', '指定承接任务流程', '指定承接任务流程', '0', '1', '0', '1283824658', '23');
INSERT INTO keke_witkey_article VALUES ('1088', '143', '1', 'admin', '招标任务流程', 'kekezu.com', '', '招标任务流程', '0', '招标任务流程', '招标任务流程', '招标任务流程', '0', '1', '0', '1283824695', '12');
INSERT INTO keke_witkey_article VALUES ('1089', '143', '1', 'admin', '发帖任务流程', 'kekezu.com', '', '发帖任务流程', '0', '发帖任务流程', '发帖任务流程', '发帖任务流程', '0', '1', '0', '1283824726', '5');
INSERT INTO keke_witkey_article VALUES ('1090', '143', '1', 'admin', '认证流程', 'kekezu.com', '', '认证流程', '0', '认证流程', '认证流程', '认证流程', '0', '1', '0', '1283824760', '4');
INSERT INTO keke_witkey_article VALUES ('1091', '143', '1', 'admin', '充值流程', 'kekezu.com', '', '充值流程', '0', '充值流程', '充值流程', '充值流程', '0', '1', '0', '1283824851', '4');
INSERT INTO keke_witkey_article VALUES ('1092', '143', '1', 'admin', '提现流程', 'kekezu.com', '', '提现流程', '0', '提现流程', '提现流程', '提现流程', '0', '1', '0', '1283824946', '4');
INSERT INTO keke_witkey_article VALUES ('1093', '143', '1', 'admin', '注册流程', 'kekezu.com', '', '注册流程', '0', '注册流程', '注册流程', '注册流程', '0', '1', '0', '1283824958', '3');
INSERT INTO keke_witkey_article VALUES ('1120', '145', '1', '', '什么是个人服务店铺？', '', '', '个人店铺是威客商城专为个人服务商开发的店铺产品，该产品可以充分体现个人服务商的服务价值，以吸引客户光顾。您注册开通后就相当于自己的免费个人网站，可以自己编辑、管理、发布、报价。个人服务店铺为免费产品，您可以完全免费使用该产品。', '0', null, null, null, '0', '1', '0', '1287452911', '0');
INSERT INTO keke_witkey_article VALUES ('1123', '123', '1', '', '注册时需要注意哪些问题？', '', '', '<p>1、会员名：5-15个字符，英文、数字、下划线，注册成功将不能修改。不能使用中文用户名。 <div class=\"Wvo883\"></div></p><p></p><p></p><p>2、密码：6-16位组成，建议使用英文字母加数字或符号的组合提高密码安全度。详见“如何设置安全密码”。 </p><p>3、邮箱：邮箱认证是可以用来取回密码的，完成注册后请点击进行邮箱认证。 </p><p>4、验证码：请参照右边的验证码，将数字填入左侧输入框中，不分大小写。如填写错误需重新填写正确才能顺利注册。 </p><p>&nbsp;</p>', '0', null, null, null, '0', '1', '0', '1287456114', '2');
INSERT INTO keke_witkey_article VALUES ('1124', '123', '1', '', '什么是验证码？', '', '', '1、注册时填写的验证码均是阿拉伯数字。 <br />2、看不到验证码，有可能是您的IE没有启用“活动脚本”、安全级别设置的过高。 <br />您可以如下处理： <br />点击“工具”—“Internet选项”—“安全”—“默认级别”—“确定” <br />同时还请您删除一下您电脑上的临时文件，方法如下： <br />IE6.0版本的处理方法： <br />1、打开浏览器，点击“工具”菜单，打开“INTERNET选项”的对话框 。<br />2、点击“常规”选项卡，选择“删除COOKIES”，在弹出的对话框内按确定；然后点击“删除文件”，在删除所有脱机内容前打上钩，再按确定。 <br />3、点击“安全”选项卡，点击右下角的“默认级别”，如果是灰色的不可按的按钮，则跳过此步骤即可。 <br />4、点击“隐私”选项卡，选择右下角的“默认”，如果是灰色的不可按的按钮，则跳过此步骤即可。点击“高级”，在弹出的页面上把“覆盖自动cookie处理”选中。下面的第一方cookie 和第三方cookie选择“接受”，再点击“确定”。 <div class=\"Pry932\"></div><br />5、点击“高级”选项卡，然后选择右下角的“还原默认设置”按钮，然后点击最下面的“确定”按钮 。<br />6、关闭所有的浏览器，然后打开，重新进入本站，看一下问题是否已经解决。', '0', null, null, null, '0', '1', '0', '1287456169', '0');
INSERT INTO keke_witkey_article VALUES ('1101', '145', '1', '', '如何发布自己的服务需求？', '', '', '在人中心，中击发布服务<br />', '0', null, null, null, '0', '1', '0', '1287373435', '2');
INSERT INTO keke_witkey_article VALUES ('1102', '146', '1', '', '在线下单交易有什么好处？', '', '', '<p>1、如果您是在线下单，并选择在线托管款项交易，一旦服务发生纠纷，您可以发起退款申请。</p><p>2、如果您是在线下单，选择的服务商是诚信会员或已加入交易保障服务，一旦服务发生纠纷并给您造成损失，您可以申请先行赔付。</p><p>3、如果您是在线下单，您还可以对服务商提供的服务进行全面评价，掌握服务商信用的主动权，促使服务商提供满意服务。</p>', '0', null, null, null, '0', '1', '0', '1287455771', '0');
INSERT INTO keke_witkey_article VALUES ('1103', '146', '1', '', '如何付款/付款方式', '', '', '<p>在线下单，在线托管交易付款方式</p><p class=\"text02\">1、用交易通余额支付</p><p class=\"text02\">2、用网上银行充值到交易通支付</p><p class=\"text02\">3、用支付宝充值到交易通支付</p><p class=\"text02\">&nbsp;</p>', '0', null, null, null, '0', '1', '0', '1287455748', '0');
INSERT INTO keke_witkey_article VALUES ('1105', '147', '1', '', '申请退款条件', '', '', '<p>1、您是在线下单，并通过威客商城在线付款托管交易</p><p>2、您与服务商发生纠纷，并协商不成，经网站管理员仲裁后。</p>', '0', null, null, null, '0', '1', '0', '1287455633', '1');
INSERT INTO keke_witkey_article VALUES ('1107', '147', '1', '', '退款注意事项', '', '', '<p>1、客户提出申请退款时，请详细告知相关内容（包括交易内容、沟通记录、聊天记录等）证明服务不符合要求的证据。</p><p>2、 威客商城收到客户退款申请，会在24小时内联系服务提供商，以第三方名义了解核实情况，协商调解并作出合理的仲裁，请双方给予配合！</p><p>3、最高退款金额不高于客户在威客商城托管的交易金额。</p>', '0', null, null, null, '0', '1', '0', '1287455553', '0');
INSERT INTO keke_witkey_article VALUES ('1121', '145', '1', '', '如何开通个人店铺?', '', '', '<p>开通店铺仅需三步：注册 &raquo; 填写必填资料 &raquo; 发布服务</p>', '0', null, null, null, '0', '1', '0', '1287452943', '0');
INSERT INTO keke_witkey_article VALUES ('1122', '145', '1', '', '什么是团队服务店铺？', '', '', '<p class=\"text02\">团队店铺是威客商城专为服务型企业与团队型工作室用户开发的店铺产品，该产品可以充分体现团队服务商的服务价值，其主要有以下几点优点：</p><p class=\"text03\">(1)企业级站点，树立团队品牌形象；<br />(2)全方位展示，精确体现服务价值；<br />(3)置身大商圈，免费获更多得客户；<br />(4)适合企业、多人工作室等团队用户。</p>', '0', null, null, null, '0', '1', '0', '1287452983', '0');
INSERT INTO keke_witkey_article VALUES ('1125', '123', '1', '', '用户名可以更改吗？', '', '', '用户名是您在威客系统中的身份标识，是唯一并永久的，一旦注册成功，就无法再更改了。因此，在注册时请选择您喜欢并能牢记的用户名。', '0', null, null, null, '0', '1', '0', '1287456206', '0');
INSERT INTO keke_witkey_article VALUES ('1126', '135', '1', '', '忘记登录密码怎么办？', '', '', '忘记密码可在“登录”页面，（图1）<p><img height=\"290\" src=\"data/uploads/2010/10/19/177364cbd06f876cc4.jpg\" width=\"491\" alt=\"\" /></p><p>点击“忘记密码？” 即可以看到输入您的用户名和您已经绑定邮箱地址，然后点击“请立即发送密码重置邮件”按钮，系统会发一个密码重置邮件到您的认证邮箱。<br />&nbsp;收到邮件后，请立即点击邮件内的链接至专属页面并重新设置您的新登录密码。<br /></p>', '0', null, null, null, '0', '1', '0', '1287456545', '2');
INSERT INTO keke_witkey_article VALUES ('1127', '135', '1', '', '忘记用户名怎么办？', '', '', '<span style=\"font-family:Times New Roman;font-size:small;\">请联系客服，并尽可能的提供您当时注册时留下的信息，包括注册邮箱、真实姓名、身份证号、银行卡号。如果有以上信息有注册记录，客服会帮您找回用户名。</span>', '0', null, null, null, '0', '1', '0', '1287456625', '1');
INSERT INTO keke_witkey_article VALUES ('1128', '200', '1', '', '关于我们', '', '', 'XXXX网是XXXXXX独家运营的网站平台，是中国最诚信、最专业的威客工作者在线工作平台，知识成果、创意产业成果征集（招标）交易平台。XXXXX本着让知识和财富快速流通、让时间和报酬等比交换的原则，致力于打造最具规范运营保障的知识成果、创意成果、劳务技能在线交易市场。凡是一切可数字化转换的劳动成果或服务都可在XXXXX网平台上完成交易。<br /><br /><div align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;XXXXX从XXXX年X月成立以来，汇聚了来XXXXX等多个行业领域的上百万专业工作者会员，他们凭借自己的专业知识、成果创作、服务技能活跃在XXXX，为满足企业、单位或个人的各种成果需求提供更多更好的解决方案。<br /><br />&nbsp;&nbsp;&nbsp;XXXXX没有任何门槛，只要您有能力、知识和创意智慧，都能在XXXXXXX的平台上充分体现价值；把您的富裕时间和劳动成果进行交易，拓展您的工作方式和报酬获得渠道，是让您充分发挥潜力、展示才华、让您成功的地方！<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 信誉至上、诚信为本、服务用户、保障权益是我们的运营宗旨，真正为您营造一个公平、公正、公开的威客服务平台，全力缔造互联网社会工作方式的革命。<br /><br /></div><p>&nbsp;&nbsp;&nbsp;&nbsp; xxxx方指定网址：</p>', '0', null, null, null, '0', '1', '0', '1289616474', '0');
INSERT INTO keke_witkey_article VALUES ('1129', '200', '1', '', '免责声明', '', '', '1、本网站发布悬赏任务、技术项目转让，其版权均归原作者所有，内容必须真实合法，本网站不负任何责任。<br /><br />2、其他任何媒体、网站或个人从本网下载使用，须自负版权等法律责任，本网站不负任何责任。<br /><br />3、本网站刊发、转载文章，版权归原作者所有，仅代表本人的观点和看法，文责自负，本网站不负任何责任。<br /><br />4、当本网站以链接形式推荐其他网站内容时，本网站不保证这些网站或资源的可用性负责、真实性、合法性。<br /><br />5、对于任何因使用链接的其他网站所造成之个人资料泄露及由此而导致的任何法律争议和后果，本网站不负任何责任。<br /><br />6、由于与本网站链接的其它网站所造成之个人资料泄露及由此而导致的任何法律争议和后果，本网站不负任何责任。<br /><br />7、任何单位或个人认为通过本站的内容可能涉嫌侵犯其合法权益，应该及时向本站管理员书面反馈，并提供身份证明、权属证明及详细侵权情况证明，我们在收到上述法律文件后，将会尽快安排处理。<br />', '0', null, null, null, '0', '1', '0', '1289616432', '0');
INSERT INTO keke_witkey_article VALUES ('1130', '200', '1', '', '支付方式', '', '', '<p><strong><span style=\"font-size:medium;color:#ff0000;\">支付方式一：银行汇款</span></strong></p><p><strong>开 户 行：XXXXXXX银行　　帐 号：000-000-000-000</strong></p><p>注：开户行所在城市为：xxxxx&nbsp; .....</p><p>在线QQ：xxxxxxxx、xxxxxxx</p><p>联系电话：027-0000000、00000000、000000、000000</p><p>付款后请及时通知我们，请注明所汇银行、金额、您在威客的用户名或者所发项目名称。</p><p>企业如需开据发票，请把公司名称、地址、邮编等相关信息发至邮箱（<a href=\"mailto:xxxx@xxx.com\">xxxx@xxx.com</a>）,费用另计。 <br /><br /><strong><span style=\"font-size:medium;color:#ff0000;\"></span></strong></p><p><strong><span style=\"font-size:medium;color:#ff0000;\">支付方式二：通过财付通付款</span></strong></p><p><span style=\"font-family:Verdana;\"><strong>如何通过财付通预付赏金？</strong></span></p><p>&nbsp;</p>', '0', null, null, null, '0', '1', '0', '1289616448', '0');
INSERT INTO keke_witkey_article VALUES ('1131', '200', '1', '', '联系方式', '', '', '<strong>热线电话：</strong><br />联系电话：00000000<br />传真：000-00000000<br /><br /><strong>商务合作：</strong><br />Tel：000-0000000&nbsp; <br />Email：<a href=\"mailto:00@00000.com\">00@00000.com</a><br /><br /><strong>新闻咨询</strong><br />00000000000<br />新闻联络人:000<br />QQ：00000000<br />MSN： <a href=\"mailto:0000000000@000.com\">0000000000@000.com</a><br />Email：<a href=\"mailto:000000@0000.com\">000000@0000.com</a><br /><br /><strong>人才招聘</strong><br />电话：0000000<br />Email：<a href=\"mailto:000@000000.com\">000@000000.com</a><br />QQ:0000000000<br /><br /><strong>公司地址：</strong><br />00市00区00000000大厦00楼<br />邮政编码：000000<br />', '0', null, null, null, '0', '1', '0', '1289616497', '0');
INSERT INTO keke_witkey_article VALUES ('1133', '17', '1', '', '关于因私下交易行为产生纠纷的问题说明', '', '', '一直以来，我们都是建议各位用户按照网站的交易规则和流程来进行交易的，不鼓励任何私下的交易行为。如果雇主和威客之间不通过网站发布任务、参加任务的形式交易，而是双方私下进行交易的，一旦出现任何纠纷，或者有损双方利益的事情，网站一律不予理会和处理。为了大家的利益能够得到切实有效地保障，我们再次提醒各位用户，最好是通过网站来进行交易，不要私下交易，以免产生不必要的麻烦，得不偿失！<br /><br /><br />常见骗术手段：<br />骗术手段一：冒充发布任务的雇主，让参与的威客和他合作，谁和他合作他就选谁中标，前提是要求被选中的这个威客给他银行卡里直接打一部分钱。<br />骗术手段二：冒充承接任务的威客，以更低价格来诱惑雇主，让雇主直接给他卡里打钱。', '1', null, null, null, '0', '1', '0', '1289983242', '1');
INSERT INTO keke_witkey_article VALUES ('1134', '17', '1', '', '关于威客多次提交作品流程修改的公告', '', '', '根据我们对流程的重新审查，以及考虑用户提出的建议和意见。为了尽可能的满足用户需求和减少作弊情况，现做修改如下：<br /><br />&nbsp; &nbsp;&nbsp;&nbsp;1、威客提交作品：<span style=\"color:blue;\">由单个任务只能提交一个作品</span> 更改为 <span style=\"color:red;\">单个任务可以多次<strong>提交作品</strong></span> ，方便威客整理思路，在任务期不断提交新的作品；<br /><br />&nbsp; &nbsp;&nbsp;&nbsp;2、威客修改作品：由<span style=\"color:blue;\">提交之后可以修改作品</span> 更改为 <span style=\"color:red;\">提交之后<strong>不再允许修改作品，</strong></span>但允许您多次提交作品，减少不必要的修改工作；<br /><br />&nbsp; &nbsp;&nbsp;&nbsp;3、威客多次提交的作品，可在自己的后台通过下拉菜单来查看:<br />&nbsp; &nbsp;&nbsp;&nbsp;<br />&nbsp; &nbsp;&nbsp;&nbsp;雇主发任务不受影响。', '0', null, null, null, '0', '1', '0', '1289983275', '0');
INSERT INTO keke_witkey_article VALUES ('1135', '17', '1', '', '任务宝提现金额从100元降至50元啦！', '', '', '<h1>任务宝提现金额从100元降至50元啦！<h1>任务宝提现金额从100元降至50元啦！</h1></h1>', '0', null, null, null, '0', '1', '0', '1289983296', '1');
INSERT INTO keke_witkey_article VALUES ('1136', '17', '1', '', '威客必看：发帖任务参与须知', '', '', '<h1><strong>1、威客如何参加发帖任务赚钱？</strong><br />点击进入具体的发帖任务页面(<a href=\"http://jijian.taskcn.com/list/index/\" target=\"_blank\">所有发帖任务列表</a>)，<u>下载</u>任务页面附件中的txt文章，把文章内容全部<u>复制</u>后，<u>粘贴</u>到雇主指定的网站中(如果雇主没有指定，则表示可以发到其他任意的网站上面)，然后点击任务页面“参加任务”的按钮，把发好的URL<u>链接地址</u>在提交一下即可。如果推广的链接提交后，保持24小时有效(即可以正常访问，不被删除)，那么就可以直接获得相应的任务款奖励了。<br /><br /><strong>2、发帖任务一般周期多久呢？</strong><br />发帖类任务默认进行时间为30天，系统会自动延期征集有效作品，直到任务金额消耗完毕后，该任务将自动停止征集。<br /><br /><strong>3、如何判断我提交的链接是否有效？</strong><br />发帖任务采用先进的智能抓取技术来判别各个作品是否为有效的提交，默认情况下系统将会在某个作品提交后的24小时内完成自动抓取，并判断该作品链接是否存在及信息是否正确，正确无误的作品将自动获得任务赏金，已不存在的作品链接或信息有误将不会得到任务赏金。<br /><strong><span style=\"color:red;\">以下提交为无效提交：<br /></span></strong>a. 没有提交到雇主指定的网站（雇主未指定除外）；<br />b. 威客原创的内容(即与雇主附件中的推广文章无关的内容)；<br />c. 将雇主提供的文章进行二次创作（增删、修改）；<br />d. 登录会员后方可见的网站链接。<br />e. 无人气的新建博客；<br />f. 同一博客下重复发帖2篇以上（含2篇）。<br /><br /><br /><strong>4、我能无限参加某个发帖任务吗？</strong><br /><a href=\"http://my.taskcn.com/audite\" target=\"_blank\">实名认证</a>的威客参加每个任务提交推广链接的上限为10个网址，且每个域名不得提交3次以上，多出部分系统将自动丢弃不作处理；非实名认证威客不能参加发帖任务。</h1>', '0', null, null, null, '0', '1', '0', '1289983343', '1');
INSERT INTO keke_witkey_article VALUES ('1137', '17', '1', '', '关于个别威客刷提交作品的处理公告', '', '', '目前在任务提交页面存在个别威客“刷提交作品”的行为，此举严重影响了其他威客的正常提交，引起了广大会员的强烈不满。经任务中国慎重考虑，即日起，一经发现有类似行为的威客，任务中国将在不作通知的情况下，禁止其提交作品1个月，以儆效尤。<br /><br />望各位自觉维护和遵守任务中国的有关制度和规则，共同营造一个美好和谐的任务环境。<br /><br /><strong>另，附上任务中国各会员级别每日提交作品数量的上限暂行规定：</strong><br />普通会员&nbsp; &nbsp;&nbsp; &nbsp; 每天可参加3个任务，每个任务最多提交3次作品；<br />实名认证&nbsp; &nbsp;&nbsp; &nbsp; 每天参加任务次数不限，每个任务最多提交6次作品；<br />作品保障&nbsp; &nbsp;&nbsp; &nbsp; 每天参加任务次数不限，每个任务最多提交10次作品；', '0', null, null, null, '0', '1', '0', '1289983462', '0');
INSERT INTO keke_witkey_article VALUES ('1138', '1', '1', '', '关于客客威客1.2上线说明', '', '', '<span style=\"font-family:Arial;\">关于客客威客1.2上线说明<span style=\"font-family:Arial;\">关于客客威客1.2上线说明</span></span>', '0', null, null, null, '0', '1', '0', '1289983504', '0');
INSERT INTO keke_witkey_article VALUES ('1139', '17', '1', '', '拥有梦想的快乐威客', '', '', '本期我们采访的威客是netslave——黄之平，他是一名外贸公司的设计师，在任务中国一直在做兼职威客。他是一个热爱生活，随和乐观的人，喜欢看书、旅行。梦想就是可以利用威客赚的钱买个属于自己的车，可以带上老婆到各处走走，爬遍中国的三山五岳，名川大湖。闲暇时喜欢带上相机到公园、山上摄影，追逐一切美的事物。', '0', null, null, null, '0', '1', '0', '1289983625', '0');
INSERT INTO keke_witkey_article VALUES ('1140', '17', '1', '', '高成就 低姿态 方有好作品', '', '', '期我们采访的威客是陈晓，在任务中国也已有两年多了，并创建了自己的New-Eye工作室。', '1', null, null, null, '0', '1', '0', '1289983666', '0');
INSERT INTO keke_witkey_article VALUES ('1141', '17', '1', '', '一个做事认真谨慎的优秀设计师', '', '', '　本期我们采访的威客是seven0998——陈小娴，从事页面设计也有3年的时间了，从刚开始的菜鸟，一直到现在的成功，经历了很多，通过在任务中国的磨练，最终成为一名合格的设计师。', '0', null, null, null, '0', '1', '0', '1289983702', '0');
INSERT INTO keke_witkey_article VALUES ('1142', '17', '1', '', '有计划 才会有未来', '', '', '　本期我们采访的威客是nkd981690——黄先生，他所学的专业原本是广告专业，但因为热爱设计，所以在大学的时候就开始在任务中国上做业余设计，毕业之后还创建了属于自己的设计网站', '0', null, null, null, '0', '1', '0', '1289983732', '0');

-- ----------------------------
-- Table structure for `keke_witkey_article_category`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_article_category`;
CREATE TABLE `keke_witkey_article_category` (
  `art_cat_id` int(11) NOT NULL auto_increment,
  `art_cat_pid` int(11) default '0',
  `cat_name` varchar(100) default NULL,
  `listorder` int(11) default '0',
  `is_show` int(11) default '0',
  `on_time` int(11) default '0',
  `service_type` int(11) default '0',
  `art_index` varchar(100) default NULL,
  PRIMARY KEY  (`art_cat_id`),
  KEY `index_1` (`art_cat_id`),
  KEY `index_2` (`art_cat_pid`)
) ENGINE=MyISAM AUTO_INCREMENT=201 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_article_category
-- ----------------------------
INSERT INTO keke_witkey_article_category VALUES ('1', '0', '客客资讯', '1', '1', '1289549099', null, '{1}');
INSERT INTO keke_witkey_article_category VALUES ('2', '1', '联系我们', '2', '1', '1289552719', null, '{2}');
INSERT INTO keke_witkey_article_category VALUES ('100', '0', '帮助中心', '3', '1', '1278556511', null, '{100}');
INSERT INTO keke_witkey_article_category VALUES ('4', '1', '政策法规', '1', '1', '1274089497', null, '{1}{4}');
INSERT INTO keke_witkey_article_category VALUES ('5', '1', '行业动态', '1', '1', '1274101606', null, '{1}{5}');
INSERT INTO keke_witkey_article_category VALUES ('6', '1', '数据报告', '1', '1', '1274101632', null, '{1}{6}');
INSERT INTO keke_witkey_article_category VALUES ('7', '1', '媒体报导', '1', '1', '1274101647', null, '{1}{7}');
INSERT INTO keke_witkey_article_category VALUES ('122', '100', '注册|登陆', '0', '0', '1283759795', null, '{100}{122}');
INSERT INTO keke_witkey_article_category VALUES ('123', '122', '注册', '0', '0', '1283937073', null, '{100}{122}{123}');
INSERT INTO keke_witkey_article_category VALUES ('136', '128', '身份证认证', '0', '0', '1283766143', null, '{100}{128}{136}');
INSERT INTO keke_witkey_article_category VALUES ('113', '100', '常见问题', '5', '1', '1279940000', null, '{100}{113}');
INSERT INTO keke_witkey_article_category VALUES ('114', '100', '新手入门', '1', '1', '1274199927', null, '{100}{114}');
INSERT INTO keke_witkey_article_category VALUES ('17', '1', '网站公告', '0', '1', '1278323605', null, '{1}{17}');
INSERT INTO keke_witkey_article_category VALUES ('119', '100', '交易安全', '4', '1', '1279939985', null, '{100}{119}');
INSERT INTO keke_witkey_article_category VALUES ('120', '100', '悬赏任务指南', '2', '1', '1279940030', null, '{100}{120}');
INSERT INTO keke_witkey_article_category VALUES ('121', '100', '招标任务指南', '3', '1', '1279940046', null, '{100}{121}');
INSERT INTO keke_witkey_article_category VALUES ('128', '100', '认证中心', '0', '0', '1283759962', null, '{100}{128}');
INSERT INTO keke_witkey_article_category VALUES ('129', '100', '雇主帮助', '0', '0', '1283759980', null, '{100}{129}');
INSERT INTO keke_witkey_article_category VALUES ('130', '100', '威客帮助', '0', '0', '1283759992', null, '{100}{130}');
INSERT INTO keke_witkey_article_category VALUES ('131', '100', '会员管理', '0', '0', '1283760005', null, '{100}{131}');
INSERT INTO keke_witkey_article_category VALUES ('132', '100', '工作室', '0', '0', '1283760021', null, '{100}{132}');
INSERT INTO keke_witkey_article_category VALUES ('133', '100', '名词||标示', '0', '0', '1283760053', null, '{100}{133}');
INSERT INTO keke_witkey_article_category VALUES ('134', '100', '条款||规则', '0', '0', '1283760072', null, '{100}{134}');
INSERT INTO keke_witkey_article_category VALUES ('135', '122', '登录', '0', '0', '1283937089', null, '{100}{122}{135}');
INSERT INTO keke_witkey_article_category VALUES ('137', '128', '邮箱认证', '0', '0', '1283766160', null, '{100}{128}{137}');
INSERT INTO keke_witkey_article_category VALUES ('138', '128', '企业认证', '0', '0', '1283766180', null, '{100}{128}{138}');
INSERT INTO keke_witkey_article_category VALUES ('139', '128', '银行卡认证', '0', '0', '1283766225', null, '{100}{128}{139}');
INSERT INTO keke_witkey_article_category VALUES ('140', '128', 'VIP会员认证', '0', '0', '1283766241', null, '{100}{128}{140}');
INSERT INTO keke_witkey_article_category VALUES ('141', '129', '综合区', '0', '0', '1283766282', null, '{100}{129}{141}');
INSERT INTO keke_witkey_article_category VALUES ('142', '129', '招标任务区', '0', '0', '1283766298', null, '{100}{129}{142}');
INSERT INTO keke_witkey_article_category VALUES ('143', '100', '流程演示', '0', '0', '1283824516', '0', '{100}{143}');
INSERT INTO keke_witkey_article_category VALUES ('144', '100', '商城帮助', '0', '0', '1287394257', '0', '{100}{144}');
INSERT INTO keke_witkey_article_category VALUES ('145', '144', '卖家帮助', '0', '0', '1287372794', '0', '{100}{144}{145}');
INSERT INTO keke_witkey_article_category VALUES ('146', '144', '买家帮助', '0', '0', '1287372823', '0', '{100}{144}{146}');
INSERT INTO keke_witkey_article_category VALUES ('147', '144', '常见问题', '0', '0', '1287372838', '0', '{100}{144}{147}');
INSERT INTO keke_witkey_article_category VALUES ('200', '0', '单页', '0', '0', '0', '0', '{200}');

-- ----------------------------
-- Table structure for `keke_witkey_auth_item`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_auth_item`;
CREATE TABLE `keke_witkey_auth_item` (
  `auth_id` int(11) NOT NULL auto_increment,
  `auth_title` varchar(100) default NULL,
  `auth_day` varchar(100) default NULL,
  `auth_small_ico` varchar(100) default NULL,
  `auth_big_ico` varchar(100) default NULL,
  `auth_desc` text,
  `auth_cash` float default NULL,
  `auth_period` int(11) default NULL,
  `auth_open` int(11) default NULL,
  `auth_show` int(11) default NULL,
  `update_time` int(11) default NULL,
  PRIMARY KEY  (`auth_id`),
  KEY `index_1` (`auth_id`),
  KEY `index_2` (`update_time`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_auth_item
-- ----------------------------
INSERT INTO keke_witkey_auth_item VALUES ('1', '实名认证', '1-3', 'small_1.gif', 'big_1.gif', '身份证认证', '5', '0', '1', '0', '1282373918');
INSERT INTO keke_witkey_auth_item VALUES ('2', '银行认证', '1-3', 'small_2.gif', 'big_2.gif', '银行认证', '5', '0', '1', '1', '1281576768');
INSERT INTO keke_witkey_auth_item VALUES ('3', '企业认证', '1-3', 'small_3.gif', 'big_3.gif', '企业认证', '5', '0', '1', '1', '1281576782');
INSERT INTO keke_witkey_auth_item VALUES ('4', '邮箱认证', '1-3', 'small_4.gif', 'big_4.gif', '点击发送，系统将自动发送一封邮件到您的邮箱，请在24小时之内点击邮件里的链接进行邮箱验证（24之内有效）', '0', '0', '1', '0', '1288774053');

-- ----------------------------
-- Table structure for `keke_witkey_bank_auth`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_bank_auth`;
CREATE TABLE `keke_witkey_bank_auth` (
  `bank_a_id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `username` varchar(255) default NULL,
  `pay_type` int(11) default NULL,
  `online_pay_tool` int(11) default NULL,
  `online_pay_account` varchar(50) default NULL,
  `bank_account` varchar(50) default NULL,
  `bank_name` int(50) default NULL,
  `deposit_area` varchar(100) default NULL,
  `deposit_name` varchar(100) default NULL,
  `pay_to_user_cash` float default NULL,
  `user_get_cash` float default NULL,
  `pay_time` int(11) default NULL,
  `cash` float default NULL,
  `start_time` int(11) default NULL,
  `end_time` int(11) default NULL,
  `auth_status` int(11) default NULL,
  PRIMARY KEY  (`bank_a_id`),
  KEY `index_1` (`bank_a_id`),
  KEY `index_2` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_bank_auth
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_basic_config`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_basic_config`;
CREATE TABLE `keke_witkey_basic_config` (
  `basic_config_id` int(11) NOT NULL auto_increment,
  `website_name` varchar(100) default NULL,
  `website_title` varchar(100) default NULL,
  `website_url` varchar(100) default NULL,
  `install_path` varchar(100) default NULL,
  `web_logo` varchar(200) default NULL,
  `seo_title` varchar(500) default NULL,
  `seo_keyword` text,
  `seo_desc` text,
  `company` varchar(100) default NULL,
  `address` varchar(200) default NULL,
  `phone` varchar(100) default NULL,
  `kf_phone` varchar(500) default NULL,
  `postcode` varchar(100) default NULL,
  `filing` varchar(100) default NULL,
  `is_close` int(11) default '0',
  `close_reason` text,
  `stats_code` varchar(500) default NULL,
  `max_size` int(11) default '0',
  `file_type` varchar(500) default NULL,
  `ban_users` text,
  `ban_content` text,
  `reg_limit` int(11) default '0',
  `on_time` int(11) default '0',
  `mail_server_cat` varchar(10) default NULL,
  `mail_server_port` int(11) default '0',
  `mail_ssl` tinyint(4) default '0',
  `smtp_url` varchar(100) default NULL,
  `post_account` varchar(50) default NULL,
  `account_pwd` varchar(20) default NULL,
  `mail_replay` varchar(100) default NULL,
  `mail_charset` varchar(10) default NULL,
  `credit_is_allow` int(11) default NULL,
  `user_intergration` int(11) default NULL,
  `is_rewrite` int(11) default NULL,
  `mark_start_status` int(11) default '0',
  `auto_mark_time` int(11) default '0',
  `auto_mark_status` int(11) default '0',
  PRIMARY KEY  (`basic_config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_basic_config
-- ----------------------------
INSERT INTO `keke_witkey_basic_config` (`basic_config_id`, `website_name`, `website_title`, `website_url`, `install_path`, `web_logo`, `seo_title`, `seo_keyword`, `seo_desc`, `company`, `address`, `phone`, `kf_phone`, `postcode`, `filing`, `is_close`, `close_reason`, `stats_code`, `max_size`, `file_type`, `ban_users`, `ban_content`, `reg_limit`, `on_time`, `mail_server_cat`, `mail_server_port`, `mail_ssl`, `smtp_url`, `post_account`, `account_pwd`, `mail_replay`, `mail_charset`, `credit_is_allow`, `user_intergration`, `is_rewrite`, `mark_start_status`, `auto_mark_time`, `auto_mark_status`) VALUES
(83, '客客出品专业威客系统', 'KPPW', 'http://localhost/kppw', '0', 'resource/img/logo.gif', '客客出品专业威客系统', '客客出品专业威客系统', '客客出品专,业威客系统', '客客信息技术有限公司', '湖北省武汉市', '12345678', '66666666', '430000', '鄂B2-20080005', 2, '暂时关闭。。。。', '', 2, 'doc|docx|xls|ppt|wps|zip|rar|txt|jpg|jpeg|gif|bmp|swf|png', 'admin|胡哥', '草泥马|毛泽东|胡锦涛', 1, 1291630023, 'smtp', 25, 2, 'smtp.ym.163.com', '', '', '', 'utf-8', 1, 1, 0, 1, 3, 1);

-- ----------------------------
-- Table structure for `keke_witkey_bid`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_bid`;
CREATE TABLE `keke_witkey_bid` (
  `bid_id` int(11) NOT NULL auto_increment,
  `task_id` int(11) default '0',
  `uid` int(11) default '0',
  `username` varchar(50) default NULL,
  `quote` decimal(8,2) default NULL,
  `cycle` int(11) default NULL,
  `area` varchar(50) default NULL,
  `message` varchar(200) default NULL,
  `bid_status` int(11) default '0',
  `bid_time` int(11) default '0',
  PRIMARY KEY  (`bid_id`),
  KEY `index_1` (`bid_id`),
  KEY `index_2` (`task_id`),
  KEY `index_3` (`uid`),
  KEY `index_4` (`bid_status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_bid
-- ----------------------------
INSERT INTO keke_witkey_bid VALUES ('1', '65', '2', 'yuanyayue', '5.00', '34', '重庆 江北', 'fa', '1', '1288092142');

-- ----------------------------
-- Table structure for `keke_witkey_case`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_case`;
CREATE TABLE IF NOT EXISTS `keke_witkey_case` (
  `case_id` int(11) NOT NULL auto_increment,
  `obj_id` int(11) default NULL,
  `obj_type` varchar(20) default NULL,
  `case_img` varchar(50) default NULL,
  `case_title` varchar(50) default NULL,
  `case_desc` varchar(500) default NULL,
  `case_price` float(10,2) default NULL,
  `case_auther` varchar(20) default NULL,
  `on_time` int(11) default NULL,
  PRIMARY KEY  (`case_id`),
  KEY `case_id` (`case_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;



-- ----------------------------
-- Table structure for `keke_witkey_cash_rule`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_cash_rule`;
CREATE TABLE `keke_witkey_cash_rule` (
  `cash_rule_id` int(11) NOT NULL auto_increment,
  `start_cove` float default NULL,
  `end_cove` float default NULL,
  `cove_desc` varchar(1000) default NULL,
  `on_time` int(11) default NULL,
  PRIMARY KEY  (`cash_rule_id`),
  KEY `index_1` (`cash_rule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_cash_rule
-- ----------------------------
INSERT INTO keke_witkey_cash_rule VALUES ('1', '500', '1000', '500元——1000元', '1284041121');
INSERT INTO keke_witkey_cash_rule VALUES ('2', '1000', '2000', '1000元—2000元', '0');
INSERT INTO keke_witkey_cash_rule VALUES ('4', '5000', '10000', '5000元—10000元', '0');
INSERT INTO keke_witkey_cash_rule VALUES ('6', '10000', '20000', '10000元—20000元', '1274773139');
INSERT INTO keke_witkey_cash_rule VALUES ('8', '200', '50000', '200元——50000元', '1281670049');

-- ----------------------------
-- Table structure for `keke_witkey_comment`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_comment`;
CREATE TABLE `keke_witkey_comment` (
  `comment_id` int(11) NOT NULL auto_increment,
  `obj_id` int(11) default '0',
  `p_id` int(11) default NULL,
  `comment_type` int(11) default '0',
  `uid` int(11) default '0',
  `username` varchar(50) default NULL,
  `content` text,
  `on_time` int(11) default '0',
  `status` int(11) default '0',
  PRIMARY KEY  (`comment_id`),
  KEY `index_1` (`comment_id`),
  KEY `index_2` (`obj_id`),
  KEY `index_3` (`p_id`),
  KEY `index_4` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_comment
-- ----------------------------
INSERT INTO keke_witkey_comment VALUES ('28', '95', '0', '1', '38', 'jesomo', '还行，可以考虑~', '1289983532', '0');
INSERT INTO keke_witkey_comment VALUES ('29', '117', '0', '1', '39', '王大毛', '怎么回事啊', '1289983669', '0');

-- ----------------------------
-- Table structure for `keke_witkey_day_rule`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_day_rule`;
CREATE TABLE `keke_witkey_day_rule` (
  `day_rule_id` int(11) NOT NULL auto_increment,
  `rule_cash` float(8,0) default '0',
  `rule_day` int(11) default '0',
  `model_id` int(11) default NULL,
  PRIMARY KEY  (`day_rule_id`),
  KEY `index_1` (`day_rule_id`),
  KEY `index_2` (`model_id`)
) ENGINE=MyISAM AUTO_INCREMENT=178 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_day_rule
-- ----------------------------
INSERT INTO keke_witkey_day_rule VALUES ('177', '6000', '60', '1');
INSERT INTO keke_witkey_day_rule VALUES ('176', '5000', '50', '1');
INSERT INTO keke_witkey_day_rule VALUES ('175', '3000', '30', '1');
INSERT INTO keke_witkey_day_rule VALUES ('174', '1500', '15', '1');
INSERT INTO keke_witkey_day_rule VALUES ('173', '500', '10', '1');
INSERT INTO keke_witkey_day_rule VALUES ('172', '100', '5', '1');
INSERT INTO keke_witkey_day_rule VALUES ('159', '600', '11', '3');
INSERT INTO keke_witkey_day_rule VALUES ('158', '500', '10', '3');
INSERT INTO keke_witkey_day_rule VALUES ('157', '100', '5', '3');
INSERT INTO keke_witkey_day_rule VALUES ('171', '1000', '10', '4');
INSERT INTO keke_witkey_day_rule VALUES ('170', '400', '5', '4');
INSERT INTO keke_witkey_day_rule VALUES ('123', '2000', '51', '5');
INSERT INTO keke_witkey_day_rule VALUES ('122', '1000', '50', '5');
INSERT INTO keke_witkey_day_rule VALUES ('121', '500', '10', '5');
INSERT INTO keke_witkey_day_rule VALUES ('153', '900', '20', '6');
INSERT INTO keke_witkey_day_rule VALUES ('152', '600', '10', '6');
INSERT INTO keke_witkey_day_rule VALUES ('151', '100', '5', '6');

-- ----------------------------
-- Table structure for `keke_witkey_defer_rule`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_defer_rule`;
CREATE TABLE `keke_witkey_defer_rule` (
  `defer_rule_id` int(11) NOT NULL auto_increment,
  `defer_times` int(11) default '0',
  `defer_cash_scale` float(11,2) default '0.00',
  `model_id` int(11) default NULL,
  PRIMARY KEY  (`defer_rule_id`),
  KEY `index_1` (`defer_rule_id`),
  KEY `index_2` (`model_id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_defer_rule
-- ----------------------------
INSERT INTO keke_witkey_defer_rule VALUES ('75', '4', '45.00', '1');
INSERT INTO keke_witkey_defer_rule VALUES ('74', '3', '40.00', '1');
INSERT INTO keke_witkey_defer_rule VALUES ('73', '2', '15.00', '1');
INSERT INTO keke_witkey_defer_rule VALUES ('71', '3', '41.00', '3');
INSERT INTO keke_witkey_defer_rule VALUES ('70', '2', '40.00', '3');
INSERT INTO keke_witkey_defer_rule VALUES ('69', '1', '25.00', '3');
INSERT INTO keke_witkey_defer_rule VALUES ('72', '1', '10.00', '1');

-- ----------------------------
-- Table structure for `keke_witkey_enterprise_auth`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_enterprise_auth`;
CREATE TABLE `keke_witkey_enterprise_auth` (
  `enterprise_auth_id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `username` varchar(50) default NULL,
  `licen_num` varchar(100) default NULL,
  `licen_pic` varchar(100) default NULL,
  `cash` float default NULL,
  `start_time` int(11) default NULL,
  `end_time` int(11) default NULL,
  `auth_status` int(11) default NULL,
  PRIMARY KEY  (`enterprise_auth_id`),
  KEY `index_1` (`enterprise_auth_id`),
  KEY `index_2` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_enterprise_auth
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_favorite`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_favorite`;
CREATE TABLE `keke_witkey_favorite` (
  `f_id` int(11) NOT NULL auto_increment,
  `obj_type` int(11) default NULL,
  `obj_id` int(11) default NULL,
  `obj_name` varchar(50) default NULL,
  `uid` int(11) default NULL,
  `username` varchar(50) default NULL,
  `on_date` int(11) default NULL,
  PRIMARY KEY  (`f_id`),
  KEY `f_id` (`f_id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_favorite
-- ----------------------------
INSERT INTO keke_witkey_favorite VALUES ('7', '1', '14', 'Macau', '38', 'jesomo', '1289985267');

-- ----------------------------
-- Table structure for `keke_witkey_feed`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_feed`;
CREATE TABLE `keke_witkey_feed` (
  `feed_id` int(11) NOT NULL auto_increment,
  `obj_id` int(11) default '0',
  `obj_link` varchar(100) default NULL,
  `feedtype` varchar(20) default NULL,
  `uid` int(11) default '0',
  `username` varchar(50) default '',
  `icon` char(10) default '0',
  `title` varchar(500) default '',
  `feed_desc` text,
  `feed_pic` varchar(100) default NULL,
  `feed_time` int(11) default '0',
  PRIMARY KEY  (`feed_id`),
  KEY `index_1` (`feed_id`),
  KEY `index_2` (`obj_id`),
  KEY `index_3` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=236 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_feed
-- ----------------------------
INSERT INTO keke_witkey_feed VALUES ('154', '91', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=91\">字体制作------------加急！</a>', null, null, '1289982082');
INSERT INTO keke_witkey_feed VALUES ('155', '92', '', 'pub_task', '35', 'bluesky', '', '<a href=\"index.php?do=space&member_id=35\" target=\"_blank\">bluesky</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=92\">制作shopex模板</a>', null, null, '1289982125');
INSERT INTO keke_witkey_feed VALUES ('156', '93', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=93\">葡萄酒标设计</a>', null, null, '1289982261');
INSERT INTO keke_witkey_feed VALUES ('157', '94', '', 'pub_task', '35', 'bluesky', '', '<a href=\"index.php?do=space&member_id=35\" target=\"_blank\">bluesky</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=94\">利用php168或者网人系统制作分类信息网站</a>', null, null, '1289982294');
INSERT INTO keke_witkey_feed VALUES ('158', '95', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=95\">“虫虫”两字用于商标注册图样设计</a>', null, null, '1289982371');
INSERT INTO keke_witkey_feed VALUES ('159', '96', '', 'pub_task', '35', 'bluesky', '', '<a href=\"index.php?do=space&member_id=35\" target=\"_blank\">bluesky</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=96\">用xhtml和css将一套图片转换成静态的网页</a>', null, null, '1289982444');
INSERT INTO keke_witkey_feed VALUES ('160', '97', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=97\">用易语言替换文本</a>', null, null, '1289982482');
INSERT INTO keke_witkey_feed VALUES ('161', '98', '', 'pub_task', '35', 'bluesky', '', '<a href=\"index.php?do=space&member_id=35\" target=\"_blank\">bluesky</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=98\">根据效果图做施工图纸</a>', null, null, '1289982546');
INSERT INTO keke_witkey_feed VALUES ('162', '99', '', 'pub_task', '35', 'bluesky', '', '<a href=\"index.php?do=space&member_id=35\" target=\"_blank\">bluesky</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=99\">将讲演.话音打成文字(中文)--可试合作</a>', null, null, '1289982640');
INSERT INTO keke_witkey_feed VALUES ('163', '100', '', 'pub_task', '35', 'bluesky', '', '<a href=\"index.php?do=space&member_id=35\" target=\"_blank\">bluesky</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=100\">网站改版，整站设计</a>', null, null, '1289982697');
INSERT INTO keke_witkey_feed VALUES ('164', '101', '', 'pub_task', '35', 'bluesky', '', '<a href=\"index.php?do=space&member_id=35\" target=\"_blank\">bluesky</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=101\">淘宝商品人气降权，求淘宝内部人员恢复</a>', null, null, '1289982807');
INSERT INTO keke_witkey_feed VALUES ('165', '102', '', 'pub_task', '35', 'bluesky', '', '<a href=\"index.php?do=space&member_id=35\" target=\"_blank\">bluesky</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=102\">30平方米按摩椅专卖厅装修效果图</a>', null, null, '1289982886');
INSERT INTO keke_witkey_feed VALUES ('166', '103', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=103\">娱乐场所隔声工程公司注册商标（品牌）起名</a>', null, null, '1289982886');
INSERT INTO keke_witkey_feed VALUES ('167', '104', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=104\">给虎妞起名</a>', null, null, '1289982981');
INSERT INTO keke_witkey_feed VALUES ('168', '105', '', 'pub_task', '35', 'bluesky', '', '<a href=\"index.php?do=space&member_id=35\" target=\"_blank\">bluesky</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=105\">石材展厅设计</a>', null, null, '1289982992');
INSERT INTO keke_witkey_feed VALUES ('169', '106', '', 'pub_task', '35', 'bluesky', '', '<a href=\"index.php?do=space&member_id=35\" target=\"_blank\">bluesky</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=106\">设计一个数据库模板（包括首页、列表页等）</a>', null, null, '1289983051');
INSERT INTO keke_witkey_feed VALUES ('170', '107', '', 'pub_task', '35', 'bluesky', '', '<a href=\"index.php?do=space&member_id=35\" target=\"_blank\">bluesky</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=107\">VB＋SQL2005开发工厂工作流程系统</a>', null, null, '1289983131');
INSERT INTO keke_witkey_feed VALUES ('171', '108', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=108\">网站平面设计+html制作</a>', null, null, '1289983174');
INSERT INTO keke_witkey_feed VALUES ('172', '109', '', 'pub_task', '35', 'bluesky', '', '<a href=\"index.php?do=space&member_id=35\" target=\"_blank\">bluesky</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=109\">一篇关于创新性经济的论文</a>', null, null, '1289983211');
INSERT INTO keke_witkey_feed VALUES ('173', '110', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=110\">制作一个网站版面附带2，提供3个版面做参考</a>', null, null, '1289983244');
INSERT INTO keke_witkey_feed VALUES ('174', '111', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=111\">“星座”摄影LOGO设计及VI形象设计</a>', null, null, '1289983304');
INSERT INTO keke_witkey_feed VALUES ('175', '112', '', 'pub_task', '37', 'jianghu', '', '<a href=\"index.php?do=space&member_id=37\" target=\"_blank\">jianghu</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=112\">寻高手--大酒店VI设计</a>', null, null, '1289983321');
INSERT INTO keke_witkey_feed VALUES ('176', '113', '', 'pub_task', '37', 'jianghu', '', '<a href=\"index.php?do=space&member_id=37\" target=\"_blank\">jianghu</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=113\">完善一个装在一个人体模型里的电路</a>', null, null, '1289983393');
INSERT INTO keke_witkey_feed VALUES ('177', '114', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=114\">请把我已有2个版本LOGO加深分辨率</a>', null, null, '1289983393');
INSERT INTO keke_witkey_feed VALUES ('178', '0', '', 'pub_work', '38', 'jesomo', '', '<a target=\"_blank\" href=\"index.php?do=space&member_id=38\">jesomo</a>给任务<a href=\"index.php?do=task&task_id=111&view=work\">“星座”摄影LOGO设计及VI形象设计</a>投递了新的稿件', null, null, '1289983463');
INSERT INTO keke_witkey_feed VALUES ('179', '116', '', 'pub_task', '37', 'jianghu', '', '<a href=\"index.php?do=space&member_id=37\" target=\"_blank\">jianghu</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=116\">手机视频转换与手机视频服务器架设</a>', null, null, '1289983483');
INSERT INTO keke_witkey_feed VALUES ('180', '117', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=117\">厦门外贸公司LOGO标志设计</a>', null, null, '1289983534');
INSERT INTO keke_witkey_feed VALUES ('181', '118', '', 'pub_task', '37', 'jianghu', '', '<a href=\"index.php?do=space&member_id=37\" target=\"_blank\">jianghu</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=118\">网站建设与推广（可兼职）</a>', null, null, '1289983559');
INSERT INTO keke_witkey_feed VALUES ('182', '119', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=119\">毕业设计 图书管理信息系统(java+sql 2000)</a>', null, null, '1289983584');
INSERT INTO keke_witkey_feed VALUES ('183', '0', '', 'pub_work', '38', 'jesomo', '', '<a target=\"_blank\" href=\"index.php?do=space&member_id=38\">jesomo</a>给任务<a href=\"index.php?do=task&task_id=95&view=work\">“虫虫”两字用于商标注册图样设计</a>投递了新的稿件', null, null, '1289983588');
INSERT INTO keke_witkey_feed VALUES ('184', '0', '', 'pub_work', '39', '王大毛', '', '<a target=\"_blank\" href=\"index.php?do=space&member_id=39\">王大毛</a>给任务<a href=\"index.php?do=task&task_id=117&view=work\">厦门外贸公司LOGO标志设计</a>投递了新的稿件', null, null, '1289983626');
INSERT INTO keke_witkey_feed VALUES ('185', '120', '', 'pub_task', '37', 'jianghu', '', '<a href=\"index.php?do=space&member_id=37\" target=\"_blank\">jianghu</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=120\">网络数据收集整理</a>', null, null, '1289983666');
INSERT INTO keke_witkey_feed VALUES ('186', '121', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=121\">【加急】学生测试水平报告设计</a>', null, null, '1289983690');
INSERT INTO keke_witkey_feed VALUES ('187', '0', '', 'pub_work', '38', 'jesomo', '', '<a target=\"_blank\" href=\"index.php?do=space&member_id=38\">jesomo</a>给任务<a href=\"index.php?do=task&task_id=95&view=work\">“虫虫”两字用于商标注册图样设计</a>投递了新的稿件', null, null, '1289983708');
INSERT INTO keke_witkey_feed VALUES ('188', '122', '', 'pub_task', '37', 'jianghu', '', '<a href=\"index.php?do=space&member_id=37\" target=\"_blank\">jianghu</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=122\">企鹅团Qetuan.com推广外包接受报价</a>', null, null, '1289983746');
INSERT INTO keke_witkey_feed VALUES ('189', '123', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=123\">“家佰福”食用油品牌LOGO设计</a>', null, null, '1289983788');
INSERT INTO keke_witkey_feed VALUES ('190', '124', '', 'pub_task', '37', 'jianghu', '', '<a href=\"index.php?do=space&member_id=37\" target=\"_blank\">jianghu</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=124\">求北京到苏州（或苏州到北京）旧汽车票一张</a>', null, null, '1289983821');
INSERT INTO keke_witkey_feed VALUES ('191', '0', '', 'pub_work', '38', 'jesomo', '', '<a target=\"_blank\" href=\"index.php?do=space&member_id=38\">jesomo</a>给任务<a href=\"index.php?do=task&task_id=104&view=work\">给虎妞起名</a>投递了新的稿件', null, null, '1289983831');
INSERT INTO keke_witkey_feed VALUES ('192', '0', '', 'pub_work', '40', '李大爷', '', '<a target=\"_blank\" href=\"index.php?do=space&member_id=40\">李大爷</a>给任务<a href=\"index.php?do=task&task_id=123&view=work\">“家佰福”食用油品牌LOGO设计</a>投递了新的稿件', null, null, '1289983885');
INSERT INTO keke_witkey_feed VALUES ('193', '0', '', 'pub_work', '38', 'jesomo', '', '<a target=\"_blank\" href=\"index.php?do=space&member_id=38\">jesomo</a>给任务<a href=\"index.php?do=task&task_id=104&view=work\">给虎妞起名</a>投递了新的稿件', null, null, '1289983902');
INSERT INTO keke_witkey_feed VALUES ('194', '125', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=125\">老爸过生日、帮忙发短信、1.7元一条</a>', null, null, '1289983905');
INSERT INTO keke_witkey_feed VALUES ('195', '126', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=126\">能熟练使用ECshop后台帮助我完成网站建设</a>', null, null, '1289983972');
INSERT INTO keke_witkey_feed VALUES ('196', '127', '', 'pub_task', '36', 'lelezhi', '', '<a href=\"index.php?do=space&member_id=36\" target=\"_blank\">lelezhi</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=127\">旅行公司VI设计及Logo改善</a>', null, null, '1289984077');
INSERT INTO keke_witkey_feed VALUES ('197', '128', '', 'pub_task', '37', 'jianghu', '', '<a href=\"index.php?do=space&member_id=37\" target=\"_blank\">jianghu</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=128\">企业门户网站设计（套）</a>', null, null, '1289984085');
INSERT INTO keke_witkey_feed VALUES ('198', '129', '', 'pub_task', '37', 'jianghu', '', '<a href=\"index.php?do=space&member_id=37\" target=\"_blank\">jianghu</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=129\">景观3D效果图2张</a>', null, null, '1289984179');
INSERT INTO keke_witkey_feed VALUES ('199', '130', '', 'pub_task', '37', 'jianghu', '', '<a href=\"index.php?do=space&member_id=37\" target=\"_blank\">jianghu</a>发布了任务 <a target=\"_blank\" href=\"index.php?do=task&task_id=130\">有谁会在地图上做地图找房的啊？重酬谢！</a>', null, null, '1289984260');
INSERT INTO keke_witkey_feed VALUES ('200', '40', '', 'add_service', '38', 'jesomo', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=38\">jesomo</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=40\">Macau</a> ', null, null, '1289984650');
INSERT INTO keke_witkey_feed VALUES ('201', '1', '', 'add_service', '38', 'jesomo', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=38\">jesomo</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">Macau</a> ', null, null, '1289984709');
INSERT INTO keke_witkey_feed VALUES ('202', '1', '', 'add_service', '38', 'jesomo', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=38\">jesomo</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">Macau</a> ', null, null, '1289984760');
INSERT INTO keke_witkey_feed VALUES ('203', '41', '', 'add_service', '41', 'justing', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=41\">justing</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=41\">企业网站建设及SEO</a> ', null, null, '1289985492');
INSERT INTO keke_witkey_feed VALUES ('204', '42', '', 'add_service', '41', 'justing', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=41\">justing</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=42\">专业承接SEO业务</a> ', null, null, '1289985548');
INSERT INTO keke_witkey_feed VALUES ('205', '1', '', 'add_service', '41', 'justing', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=41\">justing</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">专业承接SEO业务</a> ', null, null, '1289985581');
INSERT INTO keke_witkey_feed VALUES ('206', '1', '', 'add_service', '41', 'justing', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=41\">justing</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">企业网站建设及SEO</a> ', null, null, '1289985603');
INSERT INTO keke_witkey_feed VALUES ('207', '43', '', 'add_service', '41', 'justing', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=41\">justing</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=43\">数据库设计</a> ', null, null, '1289985698');
INSERT INTO keke_witkey_feed VALUES ('208', '44', '', 'add_service', '42', 'sky', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=42\">sky</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=44\">克罗瑞斯婚礼 深圳化妆师</a> ', null, null, '1289985725');
INSERT INTO keke_witkey_feed VALUES ('209', '45', '', 'add_service', '42', 'sky', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=42\">sky</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=45\">克罗瑞斯婚礼-留住你最美的一刻</a> ', null, null, '1289986052');
INSERT INTO keke_witkey_feed VALUES ('210', '46', '', 'add_service', '1', 'admin', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=1\">admin</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=46\">广告制作</a> ', null, null, '1289986085');
INSERT INTO keke_witkey_feed VALUES ('211', '1', '', 'add_service', '42', 'sky', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=42\">sky</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">克罗瑞斯婚礼 深圳化妆师</a> ', null, null, '1289986086');
INSERT INTO keke_witkey_feed VALUES ('212', '47', '', 'add_service', '1', 'admin', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=1\">admin</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=47\">111</a> ', null, null, '1289986163');
INSERT INTO keke_witkey_feed VALUES ('213', '48', '', 'add_service', '1', 'admin', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=1\">admin</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=48\">动画制作</a> ', null, null, '1289986303');
INSERT INTO keke_witkey_feed VALUES ('214', '49', '', 'add_service', '43', 'jank', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=43\">jank</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=49\">武汉三新书页有限公司logo征集</a> ', null, null, '1289986352');
INSERT INTO keke_witkey_feed VALUES ('215', '50', '', 'add_service', '1', 'admin', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=1\">admin</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=50\">动画制作</a> ', null, null, '1289986388');
INSERT INTO keke_witkey_feed VALUES ('216', '51', '', 'add_service', '42', 'sky', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=42\">sky</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=51\">克罗瑞斯婚礼-婚车出租</a> ', null, null, '1289986440');
INSERT INTO keke_witkey_feed VALUES ('217', '52', '', 'add_service', '1', 'admin', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=1\">admin</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=52\">电视广告片制作</a> ', null, null, '1289986555');
INSERT INTO keke_witkey_feed VALUES ('218', '53', '', 'add_service', '1', 'admin', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=1\">admin</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=53\">FLASH动画制作</a> ', null, null, '1289986851');
INSERT INTO keke_witkey_feed VALUES ('219', '54', '', 'add_service', '42', 'sky', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=42\">sky</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=54\">三亚户外婚纱摄影</a> ', null, null, '1289986885');
INSERT INTO keke_witkey_feed VALUES ('220', '55', '', 'add_service', '42', 'sky', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=42\">sky</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=55\">写真后期设计</a> ', null, null, '1289987155');
INSERT INTO keke_witkey_feed VALUES ('221', '56', '', 'add_service', '1', 'admin', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=1\">admin</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=56\">3D动画制作</a> ', null, null, '1289987210');
INSERT INTO keke_witkey_feed VALUES ('222', '57', '', 'add_service', '1', 'admin', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=1\">admin</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=57\">制作影视广告</a> ', null, null, '1289987324');
INSERT INTO keke_witkey_feed VALUES ('223', '1', '', 'add_service', '42', 'sky', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=42\">sky</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">克罗瑞斯婚礼 深圳化妆师</a> ', null, null, '1289988230');
INSERT INTO keke_witkey_feed VALUES ('224', '1', '', 'add_service', '42', 'sky', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=42\">sky</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">克罗瑞斯婚礼 深圳化妆师</a> ', null, null, '1289988986');
INSERT INTO keke_witkey_feed VALUES ('225', '1', '', 'add_service', '42', 'sky', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=42\">sky</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">克罗瑞斯婚礼-留住你最美的一刻</a> ', null, null, '1289989074');
INSERT INTO keke_witkey_feed VALUES ('226', '1', '', 'add_service', '42', 'sky', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=42\">sky</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">克罗瑞斯婚礼-婚车出租</a> ', null, null, '1289989091');
INSERT INTO keke_witkey_feed VALUES ('227', '1', '', 'add_service', '42', 'sky', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=42\">sky</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">三亚户外婚纱摄影</a> ', null, null, '1289989103');
INSERT INTO keke_witkey_feed VALUES ('228', '1', '', 'add_service', '42', 'sky', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=42\">sky</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">写真后期设计</a> ', null, null, '1289989120');
INSERT INTO keke_witkey_feed VALUES ('229', '1', '', 'add_service', '42', 'sky', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=42\">sky</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">留住你最美的一刻</a> ', null, null, '1289989214');
INSERT INTO keke_witkey_feed VALUES ('230', '1', '', 'add_service', '1', 'admin', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=1\">admin</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">制作影视广告</a> ', null, null, '1289989477');
INSERT INTO keke_witkey_feed VALUES ('231', '1', '', 'add_service', '1', 'admin', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=1\">admin</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">3D动画制作</a> ', null, null, '1289989560');
INSERT INTO keke_witkey_feed VALUES ('232', '1', '', 'add_service', '1', 'admin', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=1\">admin</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">电视广告片制作</a> ', null, null, '1289989614');
INSERT INTO keke_witkey_feed VALUES ('233', '1', '', 'add_service', '1', 'admin', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=1\">admin</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=1\">电视广告片制作</a> ', null, null, '1289989651');
INSERT INTO keke_witkey_feed VALUES ('234', '58', '', 'add_service', '46', '123456', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=46\">123456</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=58\">heihei</a> ', null, null, '1289989772');
INSERT INTO keke_witkey_feed VALUES ('235', '59', '', 'add_service', '45', '123123', '', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=45\">123123</a>发布了商品<a target=\"_blank\" href=\"shop.php?do=service_info&sid=59\">武汉网路集团</a> ', null, null, '1289989783');

-- ----------------------------
-- Table structure for `keke_witkey_file`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_file`;
CREATE TABLE `keke_witkey_file` (
  `file_id` int(11) NOT NULL auto_increment,
  `work_id` int(11) default '0',
  `task_id` int(11) default '0',
  `task_title` varchar(200) default NULL,
  `file_name` varchar(200) default NULL,
  `file_save_name` varchar(200) default NULL,
  `uid` int(11) default '0',
  `username` varchar(50) default NULL,
  `on_time` int(11) default '0',
  PRIMARY KEY  (`file_id`),
  KEY `index_1` (`file_id`),
  KEY `index_2` (`work_id`),
  KEY `index_3` (`task_id`),
  KEY `index_4` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=184 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_file
-- ----------------------------
INSERT INTO keke_witkey_file VALUES ('146', '0', '117', null, '10.8patch.rar', 'data/uploads/2010/11/17/319174ce39687a360b.rar', '39', '王大毛', '1289983623');
INSERT INTO keke_witkey_file VALUES ('147', '0', '95', null, '123.zip', 'data/uploads/2010/11/17/228874ce396da67c95.zip', '38', 'jesomo', '1289983706');
INSERT INTO keke_witkey_file VALUES ('148', '0', '0', null, 'qiye.jpg', 'data/uploads/2010/11/17/246544ce39bb3a988b.jpg', '1', 'admin', '1289984947');
INSERT INTO keke_witkey_file VALUES ('149', '0', '0', null, 'qiye.jpg', 'data/uploads/2010/11/17/193154ce39be3f1981.jpg', '1', 'admin', '1289984996');
INSERT INTO keke_witkey_file VALUES ('150', '0', '0', null, '232753_756636.jpg', 'data/uploads/2010/11/17/230884ce39d5c08c03.jpg', '41', 'justing', '1289985372');
INSERT INTO keke_witkey_file VALUES ('151', '0', '0', null, 'banner副本.jpg', 'data/uploads/2010/11/17/211524ce39d858e030.jpg', '1', 'admin', '1289985413');
INSERT INTO keke_witkey_file VALUES ('152', '0', '0', null, '162546_494508_medium.jpg', 'data/uploads/2010/11/17/237334ce3a00a94adf.jpg', '1', 'admin', '1289986058');
INSERT INTO keke_witkey_file VALUES ('153', '0', '0', null, '162546_494508_medium.jpg', 'data/uploads/2010/11/17/251524ce3a063141b3.jpg', '1', 'admin', '1289986147');
INSERT INTO keke_witkey_file VALUES ('154', '0', '0', null, '162917_2449_medium.jpg', 'data/uploads/2010/11/17/301814ce3a0e55b748.jpg', '1', 'admin', '1289986277');
INSERT INTO keke_witkey_file VALUES ('155', '0', '0', null, '162917_2449_medium.jpg', 'data/uploads/2010/11/17/103604ce3a141ae983.jpg', '1', 'admin', '1289986369');
INSERT INTO keke_witkey_file VALUES ('156', '0', '0', null, '163015_134155_medium.jpg', 'data/uploads/2010/11/17/124864ce3a1e732593.jpg', '1', 'admin', '1289986535');
INSERT INTO keke_witkey_file VALUES ('157', '0', '0', null, '163246_35961_medium.jpg', 'data/uploads/2010/11/17/156144ce3a30a772e3.jpg', '1', 'admin', '1289986826');
INSERT INTO keke_witkey_file VALUES ('158', '0', '0', null, '162258_790899_medium.jpg', 'data/uploads/2010/11/17/300634ce3a4733eb1d.jpg', '1', 'admin', '1289987187');
INSERT INTO keke_witkey_file VALUES ('159', '0', '0', null, '162134_562856_medium.jpg', 'data/uploads/2010/11/17/6364ce3a4efee00a.jpg', '1', 'admin', '1289987311');
INSERT INTO keke_witkey_file VALUES ('160', '0', '0', null, 'body_bg.jpg', 'data/uploads/2010/11/17/41804ce3a50ae9dc8.jpg', '38', 'jesomo', '1289987338');
INSERT INTO keke_witkey_file VALUES ('161', '0', '0', null, '5-100H1095J80-L.gif', 'data/uploads/2010/11/17/272654ce3aaa05ec0d.gif', '40', '李大爷', '1289988768');
INSERT INTO keke_witkey_file VALUES ('162', '0', '0', null, '5-100H1095J80-L.gif', 'data/uploads/2010/11/17/54804ce3ab0276ac9.gif', '40', '李大爷', '1289988866');
INSERT INTO keke_witkey_file VALUES ('163', '0', '0', null, '商品广告图1.jpg', 'data/uploads/2010/11/17/107104ce3ab3b5d16a.jpg', '42', 'sky', '1289988923');
INSERT INTO keke_witkey_file VALUES ('164', '0', '0', null, '商品广告图2.jpg', 'data/uploads/2010/11/17/66904ce3ab4cb70ff.jpg', '42', 'sky', '1289988940');
INSERT INTO keke_witkey_file VALUES ('165', '0', '0', null, '商品广告图1.jpg', 'data/uploads/2010/11/17/136654ce3ab7632db3.jpg', '42', 'sky', '1289988982');
INSERT INTO keke_witkey_file VALUES ('166', '0', '0', null, '商品广告图6.jpg', 'data/uploads/2010/11/17/308544ce3abb11f3a4.jpg', '1', 'admin', '1289989041');
INSERT INTO keke_witkey_file VALUES ('167', '0', '0', null, '商品广告图2.jpg', 'data/uploads/2010/11/17/218314ce3abd117625.jpg', '42', 'sky', '1289989073');
INSERT INTO keke_witkey_file VALUES ('168', '0', '0', null, '商品广告图3.gif', 'data/uploads/2010/11/17/85644ce3abdf3234a.gif', '42', 'sky', '1289989087');
INSERT INTO keke_witkey_file VALUES ('169', '0', '0', null, '商品广告图4.jpg', 'data/uploads/2010/11/17/180774ce3abece59b2.jpg', '42', 'sky', '1289989100');
INSERT INTO keke_witkey_file VALUES ('170', '0', '0', null, '商品广告图5.jpg', 'data/uploads/2010/11/17/59064ce3abfdbb883.jpg', '42', 'sky', '1289989117');
INSERT INTO keke_witkey_file VALUES ('171', '0', '0', null, 'keke.jpg', 'data/uploads/2010/11/17/133994ce3ac03f16bb.jpg', '1', 'admin', '1289989124');
INSERT INTO keke_witkey_file VALUES ('172', '0', '0', null, '商品广告图6.jpg', 'data/uploads/2010/11/17/215404ce3ad44abe6c.jpg', '1', 'admin', '1289989444');
INSERT INTO keke_witkey_file VALUES ('173', '0', '0', null, '商品广告图4.jpg', 'data/uploads/2010/11/17/114434ce3ad63ab94a.jpg', '1', 'admin', '1289989475');
INSERT INTO keke_witkey_file VALUES ('174', '0', '0', null, '商品广告图2.jpg', 'data/uploads/2010/11/17/324834ce3ada41bdb9.jpg', '1', 'admin', '1289989540');
INSERT INTO keke_witkey_file VALUES ('175', '0', '0', null, '商品广告图1.jpg', 'data/uploads/2010/11/17/248004ce3adaa3e2bd.jpg', '1', 'admin', '1289989546');
INSERT INTO keke_witkey_file VALUES ('176', '0', '0', null, '商品广告图3.gif', 'data/uploads/2010/11/17/121854ce3adb19d267.gif', '1', 'admin', '1289989553');
INSERT INTO keke_witkey_file VALUES ('177', '0', '0', null, '商品广告图4.jpg', 'data/uploads/2010/11/17/315564ce3add3d7293.jpg', '1', 'admin', '1289989587');
INSERT INTO keke_witkey_file VALUES ('178', '0', '0', null, '商品广告图5.jpg', 'data/uploads/2010/11/17/256454ce3add9686f9.jpg', '1', 'admin', '1289989593');
INSERT INTO keke_witkey_file VALUES ('179', '0', '0', null, '商品广告图6.jpg', 'data/uploads/2010/11/17/34264ce3ade0c75ab.jpg', '1', 'admin', '1289989600');
INSERT INTO keke_witkey_file VALUES ('180', '0', '0', null, '123.gif', 'data/uploads/2010/11/17/161154ce3af2051c22.gif', '45', '123123', '1289989920');
INSERT INTO keke_witkey_file VALUES ('181', '0', '0', null, '5-100H00954180-L.gif', 'data/uploads/2010/11/17/278504ce3af9232c9a.gif', '46', '123456', '1289990034');
INSERT INTO keke_witkey_file VALUES ('182', '0', '0', null, '5-100Q91026260-L.jpg', 'data/uploads/2010/11/17/246864ce3afdfca700.jpg', '46', '123456', '1289990111');
INSERT INTO keke_witkey_file VALUES ('183', '0', '0', null, '2.gif', 'data/uploads/2010/11/17/185674ce3b073bc95a.gif', '1', 'admin', '1289990259');

-- ----------------------------
-- Table structure for `keke_witkey_finance`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_finance`;
CREATE TABLE `keke_witkey_finance` (
  `fina_id` int(11) NOT NULL auto_increment,
  `fina_type` int(11) default '0',
  `fina_narrate` int(11) default NULL,
  `order_id` int(11) default '0',
  `uid` int(11) default '0',
  `username` varchar(50) default NULL,
  `task_id` int(11) default '0',
  `fina_cash` decimal(10,2) default '0.00',
  `user_balance` decimal(10,2) default '0.00',
  `fina_credit` decimal(10,2) default NULL,
  `user_credit` decimal(10,2) default NULL,
  `fina_approach` int(11) default NULL,
  `fina_time` int(11) default '0',
  `site_cash` decimal(10,2) default NULL,
  `site_profit` decimal(10,2) default NULL,
  PRIMARY KEY  (`fina_id`),
  KEY `index_1` (`fina_id`),
  KEY `index_2` (`order_id`),
  KEY `index_3` (`uid`),
  KEY `index_4` (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=364 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_finance
-- ----------------------------
INSERT INTO keke_witkey_finance VALUES ('320', '1', '4', '0', '36', 'lelezhi', '91', '0.00', '0.00', '1000.00', '99000.00', null, '1289982082', null, '200.00');
INSERT INTO keke_witkey_finance VALUES ('321', '1', '4', '0', '35', 'bluesky', '92', '0.00', '0.00', '50.00', '99950.00', null, '1289982125', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('322', '1', '4', '0', '36', 'lelezhi', '93', '0.00', '0.00', '2000.00', '97000.00', null, '1289982261', null, '400.00');
INSERT INTO keke_witkey_finance VALUES ('323', '1', '4', '0', '35', 'bluesky', '94', '0.00', '0.00', '50.00', '99900.00', null, '1289982294', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('324', '1', '4', '0', '36', 'lelezhi', '95', '0.00', '0.00', '300.00', '96700.00', null, '1289982340', null, null);
INSERT INTO keke_witkey_finance VALUES ('325', '1', '4', '0', '35', 'bluesky', '96', '0.00', '0.00', '50.00', '99850.00', null, '1289982444', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('326', '1', '4', '0', '36', 'lelezhi', '97', '0.00', '0.00', '500.00', '96200.00', null, '1289982482', null, '100.00');
INSERT INTO keke_witkey_finance VALUES ('327', '1', '4', '0', '35', 'bluesky', '98', '0.00', '0.00', '50.00', '99800.00', null, '1289982546', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('328', '1', '4', '0', '35', 'bluesky', '99', '0.00', '0.00', '50.00', '99750.00', null, '1289982640', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('329', '1', '4', '0', '35', 'bluesky', '100', '0.00', '0.00', '50.00', '99700.00', null, '1289982697', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('330', '1', '4', '0', '35', 'bluesky', '101', '0.00', '0.00', '50.00', '99650.00', null, '1289982807', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('331', '1', '4', '0', '35', 'bluesky', '102', '0.00', '0.00', '50.00', '99600.00', null, '1289982886', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('332', '1', '4', '0', '36', 'lelezhi', '103', '0.00', '0.00', '900.00', '95300.00', null, '1289982886', null, '180.00');
INSERT INTO keke_witkey_finance VALUES ('333', '1', '4', '0', '36', 'lelezhi', '104', '0.00', '0.00', '10000.00', '85300.00', null, '1289982981', null, '2000.00');
INSERT INTO keke_witkey_finance VALUES ('334', '1', '4', '0', '35', 'bluesky', '105', '0.00', '0.00', '50.00', '99550.00', null, '1289982992', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('335', '1', '4', '0', '35', 'bluesky', '106', '0.00', '0.00', '50.00', '99500.00', null, '1289983051', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('336', '1', '4', '0', '35', 'bluesky', '107', '0.00', '0.00', '50.00', '99450.00', null, '1289983131', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('337', '1', '4', '0', '36', 'lelezhi', '108', '0.00', '0.00', '1700.00', '83600.00', null, '1289983174', null, '340.00');
INSERT INTO keke_witkey_finance VALUES ('338', '1', '4', '0', '35', 'bluesky', '109', '0.00', '0.00', '50.00', '99400.00', null, '1289983211', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('339', '1', '4', '0', '36', 'lelezhi', '110', '0.00', '0.00', '550.00', '83050.00', null, '1289983244', null, '110.00');
INSERT INTO keke_witkey_finance VALUES ('340', '1', '4', '0', '36', 'lelezhi', '111', '0.00', '0.00', '850.00', '82200.00', null, '1289983304', null, '170.00');
INSERT INTO keke_witkey_finance VALUES ('341', '1', '4', '0', '37', 'jianghu', '112', '0.00', '0.00', '50.00', '99950.00', null, '1289983321', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('342', '1', '4', '0', '37', 'jianghu', '113', '0.00', '0.00', '50.00', '99900.00', null, '1289983393', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('343', '1', '4', '0', '36', 'lelezhi', '114', '0.00', '0.00', '450.00', '81750.00', null, '1289983393', null, '90.00');
INSERT INTO keke_witkey_finance VALUES ('344', '1', '4', '0', '36', 'lelezhi', '115', '0.00', '0.00', '101.00', '81649.00', null, '1289983451', null, null);
INSERT INTO keke_witkey_finance VALUES ('345', '1', '4', '0', '37', 'jianghu', '116', '0.00', '0.00', '50.00', '99850.00', null, '1289983483', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('346', '1', '4', '0', '36', 'lelezhi', '117', '0.00', '0.00', '6000.00', '75649.00', null, '1289983534', null, '1200.00');
INSERT INTO keke_witkey_finance VALUES ('347', '1', '4', '0', '37', 'jianghu', '118', '0.00', '0.00', '50.00', '99800.00', null, '1289983559', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('348', '1', '4', '0', '36', 'lelezhi', '119', '0.00', '0.00', '500.00', '75149.00', null, '1289983584', null, '100.00');
INSERT INTO keke_witkey_finance VALUES ('349', '1', '4', '0', '37', 'jianghu', '120', '0.00', '0.00', '50.00', '99750.00', null, '1289983666', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('350', '1', '4', '0', '36', 'lelezhi', '121', '0.00', '0.00', '5000.00', '70149.00', null, '1289983690', null, '1000.00');
INSERT INTO keke_witkey_finance VALUES ('351', '1', '4', '0', '37', 'jianghu', '122', '0.00', '0.00', '50.00', '99700.00', null, '1289983746', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('352', '1', '4', '0', '36', 'lelezhi', '123', '0.00', '0.00', '502.00', '69647.00', null, '1289983788', null, '100.40');
INSERT INTO keke_witkey_finance VALUES ('353', '1', '4', '0', '37', 'jianghu', '124', '0.00', '0.00', '50.00', '99650.00', null, '1289983821', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('354', '1', '4', '0', '36', 'lelezhi', '125', '0.00', '0.00', '3000.00', '66647.00', null, '1289983905', null, '600.00');
INSERT INTO keke_witkey_finance VALUES ('355', '1', '4', '0', '36', 'lelezhi', '126', '0.00', '0.00', '666.00', '65981.00', null, '1289983972', null, '133.20');
INSERT INTO keke_witkey_finance VALUES ('356', '1', '4', '0', '36', 'lelezhi', '127', '0.00', '0.00', '3000.00', '62981.00', null, '1289984077', null, '600.00');
INSERT INTO keke_witkey_finance VALUES ('357', '1', '4', '0', '37', 'jianghu', '128', '0.00', '0.00', '50.00', '99600.00', null, '1289984085', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('358', '1', '4', '0', '37', 'jianghu', '129', '0.00', '0.00', '50.00', '99550.00', null, '1289984179', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('359', '1', '4', '0', '37', 'jianghu', '130', '0.00', '0.00', '50.00', '99500.00', null, '1289984260', null, '50.00');
INSERT INTO keke_witkey_finance VALUES ('360', '1', '4', '0', '1', 'admin', '132', '200.00', '2352.50', '0.00', '0.00', null, '1289984394', null, null);
INSERT INTO keke_witkey_finance VALUES ('361', '1', '4', '0', '1', 'admin', '133', '233.00', '2119.50', '0.00', '0.00', null, '1289984441', null, null);
INSERT INTO keke_witkey_finance VALUES ('362', '1', '4', '0', '1', 'admin', '135', '222.00', '1897.50', '0.00', '0.00', null, '1289984514', null, null);
INSERT INTO keke_witkey_finance VALUES ('363', '1', '4', '0', '1', 'admin', '136', '222.00', '1675.50', '0.00', '0.00', null, '1289984673', null, null);

-- ----------------------------
-- Table structure for `keke_witkey_industry`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_industry`;
CREATE TABLE `keke_witkey_industry` (
  `indus_id` int(11) NOT NULL auto_increment,
  `indus_pid` int(11) default '0',
  `indus_name` varchar(100) default NULL,
  `is_recommend` int(11) default NULL,
  `indus_type` int(11) default NULL,
  `listorder` int(11) default '0',
  `on_time` int(11) default '0',
  `en_indus_name` varchar(100) default NULL,
  `tw_indus_name` varchar(100) default NULL,
  PRIMARY KEY  (`indus_id`),
  KEY `index_1` (`indus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_industry
-- ----------------------------
INSERT INTO keke_witkey_industry VALUES ('1', '0', '平面包装', '1', '1', '1', '1278556560', null, null);
INSERT INTO keke_witkey_industry VALUES ('2', '0', '网站/软件', '1', '1', '2', '1273825356', null, null);
INSERT INTO keke_witkey_industry VALUES ('3', '0', '策划/文案', '1', '1', '3', '1273825356', null, null);
INSERT INTO keke_witkey_industry VALUES ('4', '0', '劳务/营销', '1', '1', '4', '1273825356', null, null);
INSERT INTO keke_witkey_industry VALUES ('5', '0', '工造/产品', '1', '1', '5', '1274200131', null, null);
INSERT INTO keke_witkey_industry VALUES ('6', '0', '建筑/装饰', '1', '1', '6', '1274200188', null, null);
INSERT INTO keke_witkey_industry VALUES ('7', '0', '其它的', '0', '1', '7', '1278323764', null, null);
INSERT INTO keke_witkey_industry VALUES ('8', '1', 'LOGO设计', '1', '1', '0', '1278295418', null, null);
INSERT INTO keke_witkey_industry VALUES ('9', '1', '平面设计', '1', '1', '100', '1286938569', null, null);
INSERT INTO keke_witkey_industry VALUES ('10', '1', '效果图设计', '1', '1', '0', '1278295457', null, null);
INSERT INTO keke_witkey_industry VALUES ('11', '1', 'VI/CI/UI设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('12', '1', '产品包装', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('13', '1', '卡通吉祥物', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('14', '1', '工造模具', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('15', '1', 'Banner设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('16', '1', 'Flash设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('17', '1', '服装设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('18', '1', '装饰设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('19', '1', '宣传海报', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('20', '1', '封面/彩页', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('21', '1', '广告片制作', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('22', '1', '图形界面设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('23', '1', '个性设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('24', '1', 'PPT/幻灯片', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('25', '1', '其它', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('26', '2', '网站美工设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('27', '2', '网站功能编程', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('28', '2', '整站建设1', '0', '1', '0', '1283915948', null, null);
INSERT INTO keke_witkey_industry VALUES ('29', '2', '软件开发', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('30', '2', '程序修改', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('31', '2', '数据库', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('32', '2', '网站优化', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('33', '2', '软件汉化', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('34', '2', '疑难编程', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('35', '2', '游戏外挂', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('36', '2', '企业应用', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('37', '2', '工具开发', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('38', '2', '插件', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('39', '2', '破解', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('40', '2', '其它', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('41', '3', '起名', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('42', '3', '论文', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('43', '3', '广告语', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('44', '3', '软文', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('45', '3', '营销策划', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('46', '3', '网站策划', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('47', '3', '活动策划', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('48', '3', '产品书', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('49', '3', '新闻稿件', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('50', '3', '评论', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('51', '3', '创意策划', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('52', '3', '个人简历', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('53', '3', '市场调查', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('54', '3', '剧本写作', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('55', '3', '招投标书', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('56', '3', '营销计划书', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('57', '3', '其它', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('58', '4', '发帖推广', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('59', '4', '发帖比赛', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('60', '4', '全民营销', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('61', '4', '文字处理', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('62', '4', '翻译', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('63', '4', '网站推广', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('64', '4', '委托', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('65', '4', '注册网赚', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('66', '4', '技术支持', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('67', '4', '人才猎头', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('68', '4', '录音', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('69', '4', '演出', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('70', '4', '论坛版主', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('71', '4', '其它', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('72', '5', '服装鞋帽设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('73', '5', '工艺品设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('74', '5', '产品外观设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('75', '5', '部件构造设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('76', '5', '机械设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('77', '5', '电路板设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('78', '5', '生产加工工艺', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('79', '5', '设计专利求购', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('80', '5', '设计优化', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('81', '5', '专利技术求购', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('82', '5', '原料配方', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('83', '5', '其他', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('84', '6', '建筑工程设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('85', '6', '配电安装设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('86', '6', '给排水工程设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('87', '6', '供暖通风工程设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('88', '6', '布局规划设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('89', '6', '装饰装修设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('90', '6', '建筑外观设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('91', '6', '景观园林设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('92', '6', '雕塑设计', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('93', '6', '设计制图', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('94', '6', '施工方案', '1', '1', '0', '1278323927', null, null);
INSERT INTO keke_witkey_industry VALUES ('95', '6', '其他', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('96', '7', '情感烦恼', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('97', '7', '寻求帮助', '0', '1', '0', '0', null, null);
INSERT INTO keke_witkey_industry VALUES ('98', '7', '其它', '0', '1', '0', '1283996219', null, null);

-- ----------------------------
-- Table structure for `keke_witkey_link`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_link`;
CREATE TABLE `keke_witkey_link` (
  `link_id` int(11) NOT NULL auto_increment,
  `link_type` int(11) default NULL,
  `link_name` varchar(100) default NULL,
  `link_url` varchar(100) default NULL,
  `link_pic` varchar(100) default NULL,
  `listorder` int(11) default NULL,
  `link_status` int(11) default NULL,
  `on_time` int(11) default NULL,
  `shop_id` int(11) default NULL,
  PRIMARY KEY  (`link_id`),
  KEY `link_id` (`link_id`),
  KEY `on_time` (`on_time`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_link
-- ----------------------------
INSERT INTO keke_witkey_link VALUES ('31', '1', 'PHPCLUB', 'http://www.phpclub.cn', '0', '0', '1', '1277375572', null);
INSERT INTO keke_witkey_link VALUES ('32', '1', '客客族', 'http://www.kekezu.com', '', '0', '1', '1278558617', null);
INSERT INTO keke_witkey_link VALUES ('33', '4', 'phpclub', 'http://www.phpclub.com', null, null, null, null, '15');
INSERT INTO keke_witkey_link VALUES ('34', '4', '威客网', 'http://www.kekezu.com', null, null, null, null, '13');
INSERT INTO keke_witkey_link VALUES ('35', '4', '呵呵呵', 'http://www.fwbao.com/', null, null, null, null, '12');
INSERT INTO keke_witkey_link VALUES ('36', '4', '客客族', 'http://kekezu.com', null, null, null, null, '12');
INSERT INTO keke_witkey_link VALUES ('37', '4', '新浪', 'http://www.sina.com', null, null, null, null, '14');
INSERT INTO keke_witkey_link VALUES ('38', '4', '淘宝网', 'http://www,taobao.com', null, null, null, null, '16');
INSERT INTO keke_witkey_link VALUES ('39', '4', '服务宝', 'http://www.fwbao.com/95128/serviceDetail.aspx?sid=40541', null, null, null, null, '16');

-- ----------------------------
-- Table structure for `keke_witkey_mark_config`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_mark_config`;
CREATE TABLE `keke_witkey_mark_config` (
  `mark_config_id` int(11) NOT NULL auto_increment,
  `min_cash` int(11) default NULL,
  `max_cash` int(11) default NULL,
  `good` int(11) default NULL,
  `normal` int(11) default NULL,
  `bad` int(11) default NULL,
  PRIMARY KEY  (`mark_config_id`),
  KEY `index_1` (`mark_config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_mark_config
-- ----------------------------
INSERT INTO keke_witkey_mark_config VALUES ('1', null, '100', '2', '1', '-1');
INSERT INTO keke_witkey_mark_config VALUES ('5', null, '800', '6', '3', '-3');
INSERT INTO keke_witkey_mark_config VALUES ('4', null, '500', '4', '2', '-2');
INSERT INTO keke_witkey_mark_config VALUES ('6', null, '1000', '8', '4', '-4');
INSERT INTO keke_witkey_mark_config VALUES ('7', null, '3000', '10', '5', '-5');
INSERT INTO keke_witkey_mark_config VALUES ('8', null, '5000', '15', '6', '-6');

-- ----------------------------
-- Table structure for `keke_witkey_mark_log`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_mark_log`;
CREATE TABLE `keke_witkey_mark_log` (
  `mark_id` int(11) NOT NULL auto_increment,
  `mark_type` int(11) default '0' COMMENT '1Ϊ 2Ϊ̵',
  `obj_id` int(11) default '0',
  `mark_status` int(11) default '0' COMMENT '0Ϊδ 1 2 3',
  `mark_content` text,
  `mark_time` int(11) default '0',
  `uid` int(11) default '0' COMMENT '۷',
  `username` varchar(20) default NULL,
  `mark_max_time` int(11) default '0',
  `by_uid` int(11) default '0' COMMENT '۷',
  `by_username` varchar(20) default NULL,
  `user_type` int(11) default '0' COMMENT '۷ 1߷  2Ϊнӷ',
  `obj_cash` float(12,0) default '0',
  `work_id` int(11) default NULL,
  PRIMARY KEY  (`mark_id`),
  KEY `index_1` (`mark_id`),
  KEY `index_2` (`user_type`),
  KEY `index_3` (`uid`),
  KEY `index_4` (`obj_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_mark_log
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_mark_rule`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_mark_rule`;
CREATE TABLE `keke_witkey_mark_rule` (
  `mark_rule_id` int(11) NOT NULL auto_increment,
  `min_mark` int(11) default NULL,
  `max_mark` int(11) default NULL,
  `unit_count` int(11) default NULL,
  `unit_id` int(11) default NULL,
  `unit_title` varchar(50) default NULL,
  `g_ico` varchar(200) default NULL,
  `m_ico` varchar(200) default NULL,
  PRIMARY KEY  (`mark_rule_id`),
  KEY `index_1` (`mark_rule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_mark_rule
-- ----------------------------
INSERT INTO keke_witkey_mark_rule VALUES ('1', null, '2', '0', '35', '1哥', 'data/uploads/ico/323494c6f8b3a7e09b.gif', 'data/uploads/ico/237154c6f8b952bc0c.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('2', null, '5', '0', '35', '2哥', 'data/uploads/ico/249614c6f8c159d389.gif', 'data/uploads/ico/189474c6f8c286e4ab.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('3', null, '10', '0', '35', '3哥', 'data/uploads/ico/233264c6f8c8038fa8.gif', 'data/uploads/ico/291754c6f8c8b25916.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('4', null, '18', '0', '35', '4哥', 'data/uploads/ico/308204c6f8c951e3a2.gif', 'data/uploads/ico/273414c6f8c9fb302f.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('5', null, '30', '0', '35', '5哥', 'data/uploads/ico/193604c6f8c538e082.gif', 'data/uploads/ico/230304c6f8c661da39.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('6', null, '50', '0', '35', '6哥', 'data/uploads/ico/81914c6f8d179ad70.gif', 'data/uploads/ico/234954c6f9e483be60.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('26', null, '150', null, null, null, 'data/uploads/ico/33804c6f9eef10f95.gif', 'data/uploads/ico/100774c6f9eef115ce.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('25', null, '90', null, null, null, 'data/uploads/ico/36544c6f9eef0ff71.gif', 'data/uploads/ico/61514c6f9eef1064b.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('27', null, '220', null, null, null, 'data/uploads/ico/186424c6f9eef11e8f.gif', 'data/uploads/ico/116834c6f9eef124f1.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('28', null, '299', null, null, null, 'data/uploads/ico/185924c6f9eef12df0.gif', 'data/uploads/ico/236414c6f9eef133a0.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('29', null, '599', null, null, null, 'data/uploads/ico/82224c6f9eef13c1d.gif', 'data/uploads/ico/2554c6f9eef1a5c3.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('30', null, '1299', null, null, null, 'data/uploads/ico/201724c6f9eef1aede.gif', 'data/uploads/ico/258774c6f9eef1b553.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('31', null, '2599', null, null, null, 'data/uploads/ico/82344c6f9eef1be32.gif', 'data/uploads/ico/118034c6f9eef1c3e4.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('32', null, '4699', null, null, null, 'data/uploads/ico/30004c6f9eef1ccad.gif', 'data/uploads/ico/157614c6f9eef1d2d6.gif');
INSERT INTO keke_witkey_mark_rule VALUES ('33', null, '8000', null, null, null, 'data/uploads/ico/53664c6f9eef1dc2f.gif', 'data/uploads/ico/43434c6f9eef1e2fd.gif');

-- ----------------------------
-- Table structure for `keke_witkey_member`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_member`;
CREATE TABLE `keke_witkey_member` (
  `uid` int(11) NOT NULL auto_increment,
  `username` varchar(50) default NULL,
  `password` varchar(50) default NULL,
  `email` varchar(50) default NULL,
  PRIMARY KEY  (`uid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_member
-- ----------------------------
INSERT INTO keke_witkey_member VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com');
INSERT INTO keke_witkey_member VALUES ('37', 'jianghu', 'e10adc3949ba59abbe56e057f20f883e', '789458721@qq.com');
INSERT INTO keke_witkey_member VALUES ('38', 'jesomo', 'e10adc3949ba59abbe56e057f20f883e', '123@123.com');
INSERT INTO keke_witkey_member VALUES ('39', '王大毛', 'e10adc3949ba59abbe56e057f20f883e', 'wangdamao@dsaasdx.zcx');
INSERT INTO keke_witkey_member VALUES ('40', '李大爷', 'e10adc3949ba59abbe56e057f20f883e', 'adsfdsf@sads.asd');
INSERT INTO keke_witkey_member VALUES ('41', 'justing', 'e10adc3949ba59abbe56e057f20f883e', '1234@qq.com');
INSERT INTO keke_witkey_member VALUES ('42', 'sky', 'e10adc3949ba59abbe56e057f20f883e', 'hj6862@yeah.net');
INSERT INTO keke_witkey_member VALUES ('43', 'jank', 'e10adc3949ba59abbe56e057f20f883e', '123456@1qq.com');
INSERT INTO keke_witkey_member VALUES ('44', 'mark', 'e10adc3949ba59abbe56e057f20f883e', 'mark@11.com');
INSERT INTO keke_witkey_member VALUES ('45', '123123', 'e10adc3949ba59abbe56e057f20f883e', '1@1.com');
INSERT INTO keke_witkey_member VALUES ('46', '123456', 'e10adc3949ba59abbe56e057f20f883e', '123456@qq.com');
INSERT INTO keke_witkey_member VALUES ('35', 'bluesky', 'e10adc3949ba59abbe56e057f20f883e', '756450010@qq.com');
INSERT INTO keke_witkey_member VALUES ('36', 'lelezhi', '3882bfe63d81ccd41cc2f3a219101c5e', 'lelezhi@qq.com');

-- ----------------------------
-- Table structure for `keke_witkey_member_group`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_member_group`;
CREATE TABLE `keke_witkey_member_group` (
  `group_id` int(11) NOT NULL auto_increment,
  `groupname` varchar(20) default NULL,
  `group_roles` text,
  `on_time` int(10) default '0',
  PRIMARY KEY  (`group_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_member_group
-- ----------------------------
INSERT INTO keke_witkey_member_group VALUES ('2', '系统管理员', '1,2,3,4,5,41,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,42,22,23,24,25,28,29,39,30,31,32,33,34,35,36,37,38', '1274201189');
INSERT INTO keke_witkey_member_group VALUES ('6', '管理员', '2,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,42,22,23,24,25,39,30,31,32,33,35,36,37', '1274201991');
INSERT INTO keke_witkey_member_group VALUES ('7', '客服', '10,11,12,13,14,15,16,17,18,22,23,24,25,36', '1274202032');

-- ----------------------------
-- Table structure for `keke_witkey_message`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_message`;
CREATE TABLE `keke_witkey_message` (
  `msg_id` int(11) NOT NULL auto_increment,
  `msg_pid` int(11) default '0',
  `uid` int(11) default '0',
  `username` varchar(50) default NULL,
  `recive_uid` int(11) default NULL,
  `recive_username` varchar(50) default NULL,
  `msg_status` tinyint(4) default '0',
  `view_status` tinyint(4) default '0',
  `title` varchar(100) default NULL,
  `content` text,
  `on_time` int(11) default '0',
  PRIMARY KEY  (`msg_id`),
  KEY `msg_id` (`msg_id`),
  KEY `uid` (`uid`),
  KEY `msg_pid` (`msg_pid`),
  KEY `recive_uid` (`recive_uid`),
  KEY `on_time` (`on_time`)
) ENGINE=MyISAM AUTO_INCREMENT=322 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_message
-- ----------------------------
INSERT INTO keke_witkey_message VALUES ('253', '0', '0', null, '35', 'bluesky', '0', '0', '注册成功', '<p>尊敬的 bluesky：</p><p>&nbsp;感谢您对客客出品专业威客系统的信任，当您收到这封信的时候，您已经成功注册为客客出品专业威客系统会员。在这里，您可以感受到诚信、活泼、高效的网络交易文化。</p><p>如有任何疑问，欢迎随时与我们联系，我们将竭诚为您服务！<br />&nbsp;&nbsp;&nbsp;　 欢迎继续关注客客出品专业威客系统！ </p><p>&nbsp;&nbsp;&nbsp; 祝：</p><p>　&nbsp; 工作学习顺利，生活愉快！ </p><p>客客出品专业威客系统客服中心</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289981070');
INSERT INTO keke_witkey_message VALUES ('254', '0', '0', null, '36', 'lelezhi', '0', '0', '注册成功', '<p>尊敬的 lelezhi：</p><p>&nbsp;感谢您对客客出品专业威客系统的信任，当您收到这封信的时候，您已经成功注册为客客出品专业威客系统会员。在这里，您可以感受到诚信、活泼、高效的网络交易文化。</p><p>如有任何疑问，欢迎随时与我们联系，我们将竭诚为您服务！<br />&nbsp;&nbsp;&nbsp;　 欢迎继续关注客客出品专业威客系统！ </p><p>&nbsp;&nbsp;&nbsp; 祝：</p><p>　&nbsp; 工作学习顺利，生活愉快！ </p><p>客客出品专业威客系统客服中心</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289981077');
INSERT INTO keke_witkey_message VALUES ('255', '0', '0', null, '35', 'bluesky', '0', '0', '系统消息', '管理员 <b>admin</b> 设置了您的帐户信息，', '1289981816');
INSERT INTO keke_witkey_message VALUES ('256', '0', '0', null, '35', 'bluesky', '0', '0', '系统消息', '系统管理员admin给您的现金帐户追加了 100000.00元,系统管理员admin给您的代金券帐户追加了 100000.00元', '1289981816');
INSERT INTO keke_witkey_message VALUES ('257', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '管理员 <b>admin</b> 设置了您的帐户信息，', '1289981976');
INSERT INTO keke_witkey_message VALUES ('258', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '系统管理员admin给您的现金帐户追加了 100000.00元,系统管理员admin给您的代金券帐户追加了 100000.00元', '1289981976');
INSERT INTO keke_witkey_message VALUES ('259', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：91</p><p>任务标题：<a href =\'index.php?do=task&task_id=91\' target=\'_blank\' >字体制作------------加急！</a></p><p>开始时间：2010-11-17 16:21:22</p><p>结束时间：2010-11-27 16:21:22</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982082');
INSERT INTO keke_witkey_message VALUES ('260', '0', '0', null, '35', 'bluesky', '0', '0', '任务发布成功', '<p>尊敬的 bluesky：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：92</p><p>任务标题：<a href =\'index.php?do=task&task_id=92\' target=\'_blank\' >制作shopex模板</a></p><p>开始时间：2010-11-17 16:22:05</p><p>结束时间：2010-12-17 16:22:05</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982125');
INSERT INTO keke_witkey_message VALUES ('261', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：93</p><p>任务标题：<a href =\'index.php?do=task&task_id=93\' target=\'_blank\' >葡萄酒标设计</a></p><p>开始时间：2010-11-17 16:24:21</p><p>结束时间：2010-12-02 16:24:21</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982261');
INSERT INTO keke_witkey_message VALUES ('262', '0', '0', null, '35', 'bluesky', '0', '0', '任务发布成功', '<p>尊敬的 bluesky：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：94</p><p>任务标题：<a href =\'index.php?do=task&task_id=94\' target=\'_blank\' >利用php168或者网人系统制作分类信息网站</a></p><p>开始时间：2010-11-17 16:24:54</p><p>结束时间：2010-12-17 16:24:54</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982294');
INSERT INTO keke_witkey_message VALUES ('263', '0', '0', null, '36', 'lelezhi', '0', '0', '任务通过审核', '<p>尊敬的 lelezhi：</p><p>您的发布的任务已通过审核，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：95</p><p>任务链接：<a href =\'index.php?do=task&task_id=Array[task_id]\' target=\'_blank\' >“虫虫”两字用于商标注册图样设计</a></p><p>任务标题：“虫虫”两字用于商标注册图样设计</p><p>开始时间：2010-11-17 16:26:11</p><p>结束时间：2010-11-22 16:26:11</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982371');
INSERT INTO keke_witkey_message VALUES ('264', '0', '0', null, '35', 'bluesky', '0', '0', '任务发布成功', '<p>尊敬的 bluesky：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：96</p><p>任务标题：<a href =\'index.php?do=task&task_id=96\' target=\'_blank\' >用xhtml和css将一套图片转换成静态的网页</a></p><p>开始时间：2010-11-17 16:27:24</p><p>结束时间：2010-12-07 16:27:24</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982444');
INSERT INTO keke_witkey_message VALUES ('265', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：97</p><p>任务标题：<a href =\'index.php?do=task&task_id=97\' target=\'_blank\' >用易语言替换文本</a></p><p>开始时间：2010-11-17 16:28:02</p><p>结束时间：2010-11-27 16:28:02</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982482');
INSERT INTO keke_witkey_message VALUES ('266', '0', '0', null, '35', 'bluesky', '0', '0', '任务发布成功', '<p>尊敬的 bluesky：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：98</p><p>任务标题：<a href =\'index.php?do=task&task_id=98\' target=\'_blank\' >根据效果图做施工图纸</a></p><p>开始时间：2010-11-17 16:29:06</p><p>结束时间：2010-12-02 16:29:06</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982546');
INSERT INTO keke_witkey_message VALUES ('267', '0', '0', null, '35', 'bluesky', '0', '0', '任务发布成功', '<p>尊敬的 bluesky：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：99</p><p>任务标题：<a href =\'index.php?do=task&task_id=99\' target=\'_blank\' >将讲演.话音打成文字(中文)--可试合作</a></p><p>开始时间：2010-11-17 16:30:40</p><p>结束时间：2010-12-07 16:30:40</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982640');
INSERT INTO keke_witkey_message VALUES ('268', '0', '0', null, '35', 'bluesky', '0', '0', '任务发布成功', '<p>尊敬的 bluesky：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：100</p><p>任务标题：<a href =\'index.php?do=task&task_id=100\' target=\'_blank\' >网站改版，整站设计</a></p><p>开始时间：2010-11-17 16:31:37</p><p>结束时间：2010-12-17 16:31:37</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982697');
INSERT INTO keke_witkey_message VALUES ('269', '0', '0', null, '35', 'bluesky', '0', '0', '任务发布成功', '<p>尊敬的 bluesky：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：101</p><p>任务标题：<a href =\'index.php?do=task&task_id=101\' target=\'_blank\' >淘宝商品人气降权，求淘宝内部人员恢复</a></p><p>开始时间：2010-11-17 16:33:27</p><p>结束时间：2010-12-17 16:33:27</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982807');
INSERT INTO keke_witkey_message VALUES ('270', '0', '0', null, '35', 'bluesky', '0', '0', '任务发布成功', '<p>尊敬的 bluesky：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：102</p><p>任务标题：<a href =\'index.php?do=task&task_id=102\' target=\'_blank\' >30平方米按摩椅专卖厅装修效果图</a></p><p>开始时间：2010-11-17 16:34:46</p><p>结束时间：2010-12-17 16:34:46</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982886');
INSERT INTO keke_witkey_message VALUES ('271', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：103</p><p>任务标题：<a href =\'index.php?do=task&task_id=103\' target=\'_blank\' >娱乐场所隔声工程公司注册商标（品牌）起名</a></p><p>开始时间：2010-11-17 16:34:46</p><p>结束时间：2010-11-27 16:34:46</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982886');
INSERT INTO keke_witkey_message VALUES ('272', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：104</p><p>任务标题：<a href =\'index.php?do=task&task_id=104\' target=\'_blank\' >给虎妞起名</a></p><p>开始时间：2010-11-17 16:36:21</p><p>结束时间：2011-01-16 16:36:21</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982981');
INSERT INTO keke_witkey_message VALUES ('273', '0', '0', null, '35', 'bluesky', '0', '0', '任务发布成功', '<p>尊敬的 bluesky：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：105</p><p>任务标题：<a href =\'index.php?do=task&task_id=105\' target=\'_blank\' >石材展厅设计</a></p><p>开始时间：2010-11-17 16:36:32</p><p>结束时间：2010-12-17 16:36:32</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289982992');
INSERT INTO keke_witkey_message VALUES ('274', '0', '0', null, '35', 'bluesky', '0', '0', '任务发布成功', '<p>尊敬的 bluesky：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：106</p><p>任务标题：<a href =\'index.php?do=task&task_id=106\' target=\'_blank\' >设计一个数据库模板（包括首页、列表页等）</a></p><p>开始时间：2010-11-17 16:37:31</p><p>结束时间：2010-12-12 16:37:31</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983051');
INSERT INTO keke_witkey_message VALUES ('275', '0', '0', null, '35', 'bluesky', '0', '0', '任务发布成功', '<p>尊敬的 bluesky：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：107</p><p>任务标题：<a href =\'index.php?do=task&task_id=107\' target=\'_blank\' >VB＋SQL2005开发工厂工作流程系统</a></p><p>开始时间：2010-11-17 16:38:51</p><p>结束时间：2010-12-07 16:38:51</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983131');
INSERT INTO keke_witkey_message VALUES ('276', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：108</p><p>任务标题：<a href =\'index.php?do=task&task_id=108\' target=\'_blank\' >网站平面设计+html制作</a></p><p>开始时间：2010-11-17 16:39:34</p><p>结束时间：2010-12-02 16:39:34</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983174');
INSERT INTO keke_witkey_message VALUES ('277', '0', '0', null, '35', 'bluesky', '0', '0', '任务发布成功', '<p>尊敬的 bluesky：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：109</p><p>任务标题：<a href =\'index.php?do=task&task_id=109\' target=\'_blank\' >一篇关于创新性经济的论文</a></p><p>开始时间：2010-11-17 16:40:11</p><p>结束时间：2010-12-07 16:40:11</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983211');
INSERT INTO keke_witkey_message VALUES ('278', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：110</p><p>任务标题：<a href =\'index.php?do=task&task_id=110\' target=\'_blank\' >制作一个网站版面附带2，提供3个版面做参考</a></p><p>开始时间：2010-11-17 16:40:44</p><p>结束时间：2010-11-27 16:40:44</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983244');
INSERT INTO keke_witkey_message VALUES ('279', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：111</p><p>任务标题：<a href =\'index.php?do=task&task_id=111\' target=\'_blank\' >“星座”摄影LOGO设计及VI形象设计</a></p><p>开始时间：2010-11-17 16:41:44</p><p>结束时间：2010-11-27 16:41:44</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983304');
INSERT INTO keke_witkey_message VALUES ('280', '0', '0', null, '37', 'jianghu', '0', '0', '任务发布成功', '<p>尊敬的 jianghu：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：112</p><p>任务标题：<a href =\'index.php?do=task&task_id=112\' target=\'_blank\' >寻高手--大酒店VI设计</a></p><p>开始时间：2010-11-17 16:42:01</p><p>结束时间：2010-12-07 16:42:01</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983321');
INSERT INTO keke_witkey_message VALUES ('281', '0', '0', null, '38', 'jesomo', '0', '1', '注册成功', '<p>尊敬的 jesomo：</p><p>&nbsp;感谢您对客客出品专业威客系统的信任，当您收到这封信的时候，您已经成功注册为客客出品专业威客系统会员。在这里，您可以感受到诚信、活泼、高效的网络交易文化。</p><p>如有任何疑问，欢迎随时与我们联系，我们将竭诚为您服务！<br />&nbsp;&nbsp;&nbsp;　 欢迎继续关注客客出品专业威客系统！ </p><p>&nbsp;&nbsp;&nbsp; 祝：</p><p>　&nbsp; 工作学习顺利，生活愉快！ </p><p>客客出品专业威客系统客服中心</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983327');
INSERT INTO keke_witkey_message VALUES ('282', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '您的任务<a href=\"index.php?do=task&task_id=111&view=work\">“星座”摄影LOGO设计及VI形象设计</a>有新的报名', '1289983355');
INSERT INTO keke_witkey_message VALUES ('283', '0', '0', null, '37', 'jianghu', '0', '0', '任务发布成功', '<p>尊敬的 jianghu：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：113</p><p>任务标题：<a href =\'index.php?do=task&task_id=113\' target=\'_blank\' >完善一个装在一个人体模型里的电路</a></p><p>开始时间：2010-11-17 16:43:13</p><p>结束时间：2010-12-07 16:43:13</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983393');
INSERT INTO keke_witkey_message VALUES ('284', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：114</p><p>任务标题：<a href =\'index.php?do=task&task_id=114\' target=\'_blank\' >请把我已有2个版本LOGO加深分辨率</a></p><p>开始时间：2010-11-17 16:43:13</p><p>结束时间：2010-11-22 16:43:13</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983393');
INSERT INTO keke_witkey_message VALUES ('285', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '您的任务<a href=\"index.php?do=task&task_id=111&view=work\">“星座”摄影LOGO设计及VI形象设计</a>有新的投稿', '1289983463');
INSERT INTO keke_witkey_message VALUES ('286', '0', '0', null, '37', 'jianghu', '0', '0', '任务发布成功', '<p>尊敬的 jianghu：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：116</p><p>任务标题：<a href =\'index.php?do=task&task_id=116\' target=\'_blank\' >手机视频转换与手机视频服务器架设</a></p><p>开始时间：2010-11-17 16:44:43</p><p>结束时间：2010-12-17 16:44:43</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983483');
INSERT INTO keke_witkey_message VALUES ('287', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '您的任务<a href=\"index.php?do=task&task_id=103&view=work\">娱乐场所隔声工程公司注册商标（品牌）起名</a>有新的报名', '1289983495');
INSERT INTO keke_witkey_message VALUES ('288', '0', '0', null, '39', '王大毛', '0', '0', '注册成功', '<p>尊敬的 王大毛：</p><p>&nbsp;感谢您对客客出品专业威客系统的信任，当您收到这封信的时候，您已经成功注册为客客出品专业威客系统会员。在这里，您可以感受到诚信、活泼、高效的网络交易文化。</p><p>如有任何疑问，欢迎随时与我们联系，我们将竭诚为您服务！<br />&nbsp;&nbsp;&nbsp;　 欢迎继续关注客客出品专业威客系统！ </p><p>&nbsp;&nbsp;&nbsp; 祝：</p><p>　&nbsp; 工作学习顺利，生活愉快！ </p><p>客客出品专业威客系统客服中心</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983509');
INSERT INTO keke_witkey_message VALUES ('289', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '您的任务<a href=\"index.php?do=task&task_id=95&view=work\">“虫虫”两字用于商标注册图样设计</a>有新的报名', '1289983512');
INSERT INTO keke_witkey_message VALUES ('290', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：117</p><p>任务标题：<a href =\'index.php?do=task&task_id=117\' target=\'_blank\' >厦门外贸公司LOGO标志设计</a></p><p>开始时间：2010-11-17 16:45:34</p><p>结束时间：2011-01-16 16:45:34</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983534');
INSERT INTO keke_witkey_message VALUES ('291', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '您的任务<a href=\"index.php?do=task&task_id=117&view=work\">厦门外贸公司LOGO标志设计</a>有新的报名', '1289983555');
INSERT INTO keke_witkey_message VALUES ('292', '0', '0', null, '37', 'jianghu', '0', '0', '任务发布成功', '<p>尊敬的 jianghu：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：118</p><p>任务标题：<a href =\'index.php?do=task&task_id=118\' target=\'_blank\' >网站建设与推广（可兼职）</a></p><p>开始时间：2010-11-17 16:45:59</p><p>结束时间：2010-12-07 16:45:59</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983559');
INSERT INTO keke_witkey_message VALUES ('293', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：119</p><p>任务标题：<a href =\'index.php?do=task&task_id=119\' target=\'_blank\' >毕业设计 图书管理信息系统(java+sql 2000)</a></p><p>开始时间：2010-11-17 16:46:24</p><p>结束时间：2010-11-27 16:46:24</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983584');
INSERT INTO keke_witkey_message VALUES ('294', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '您的任务<a href=\"index.php?do=task&task_id=95&view=work\">“虫虫”两字用于商标注册图样设计</a>有新的投稿', '1289983588');
INSERT INTO keke_witkey_message VALUES ('295', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '您的任务<a href=\"index.php?do=task&task_id=117&view=work\">厦门外贸公司LOGO标志设计</a>有新的投稿', '1289983626');
INSERT INTO keke_witkey_message VALUES ('296', '0', '0', null, '37', 'jianghu', '0', '0', '任务发布成功', '<p>尊敬的 jianghu：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：120</p><p>任务标题：<a href =\'index.php?do=task&task_id=120\' target=\'_blank\' >网络数据收集整理</a></p><p>开始时间：2010-11-17 16:47:46</p><p>结束时间：2010-12-17 16:47:46</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983666');
INSERT INTO keke_witkey_message VALUES ('297', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：121</p><p>任务标题：<a href =\'index.php?do=task&task_id=121\' target=\'_blank\' >【加急】学生测试水平报告设计</a></p><p>开始时间：2010-11-17 16:48:10</p><p>结束时间：2010-11-27 16:48:10</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983690');
INSERT INTO keke_witkey_message VALUES ('298', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '您的任务<a href=\"index.php?do=task&task_id=95&view=work\">“虫虫”两字用于商标注册图样设计</a>有新的投稿', '1289983708');
INSERT INTO keke_witkey_message VALUES ('299', '0', '0', null, '40', '李大爷', '0', '0', '注册成功', '<p>尊敬的 李大爷：</p><p>&nbsp;感谢您对客客出品专业威客系统的信任，当您收到这封信的时候，您已经成功注册为客客出品专业威客系统会员。在这里，您可以感受到诚信、活泼、高效的网络交易文化。</p><p>如有任何疑问，欢迎随时与我们联系，我们将竭诚为您服务！<br />&nbsp;&nbsp;&nbsp;　 欢迎继续关注客客出品专业威客系统！ </p><p>&nbsp;&nbsp;&nbsp; 祝：</p><p>　&nbsp; 工作学习顺利，生活愉快！ </p><p>客客出品专业威客系统客服中心</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983738');
INSERT INTO keke_witkey_message VALUES ('300', '0', '0', null, '37', 'jianghu', '0', '0', '任务发布成功', '<p>尊敬的 jianghu：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：122</p><p>任务标题：<a href =\'index.php?do=task&task_id=122\' target=\'_blank\' >企鹅团Qetuan.com推广外包接受报价</a></p><p>开始时间：2010-11-17 16:49:06</p><p>结束时间：2010-12-17 16:49:06</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983746');
INSERT INTO keke_witkey_message VALUES ('301', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '您的任务<a href=\"index.php?do=task&task_id=104&view=work\">给虎妞起名</a>有新的报名', '1289983765');
INSERT INTO keke_witkey_message VALUES ('302', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：123</p><p>任务标题：<a href =\'index.php?do=task&task_id=123\' target=\'_blank\' >“家佰福”食用油品牌LOGO设计</a></p><p>开始时间：2010-11-17 16:49:48</p><p>结束时间：2010-11-27 16:49:48</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983788');
INSERT INTO keke_witkey_message VALUES ('303', '0', '0', null, '37', 'jianghu', '0', '0', '任务发布成功', '<p>尊敬的 jianghu：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：124</p><p>任务标题：<a href =\'index.php?do=task&task_id=124\' target=\'_blank\' >求北京到苏州（或苏州到北京）旧汽车票一张</a></p><p>开始时间：2010-11-17 16:50:21</p><p>结束时间：2010-11-27 16:50:21</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983821');
INSERT INTO keke_witkey_message VALUES ('304', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '您的任务<a href=\"index.php?do=task&task_id=104&view=work\">给虎妞起名</a>有新的投稿', '1289983831');
INSERT INTO keke_witkey_message VALUES ('305', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '您的任务<a href=\"index.php?do=task&task_id=123&view=work\">“家佰福”食用油品牌LOGO设计</a>有新的投稿', '1289983885');
INSERT INTO keke_witkey_message VALUES ('306', '0', '0', null, '36', 'lelezhi', '0', '0', '系统消息', '您的任务<a href=\"index.php?do=task&task_id=104&view=work\">给虎妞起名</a>有新的投稿', '1289983902');
INSERT INTO keke_witkey_message VALUES ('307', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：125</p><p>任务标题：<a href =\'index.php?do=task&task_id=125\' target=\'_blank\' >老爸过生日、帮忙发短信、1.7元一条</a></p><p>开始时间：2010-11-17 16:51:45</p><p>结束时间：2010-12-17 16:51:45</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983905');
INSERT INTO keke_witkey_message VALUES ('308', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：126</p><p>任务标题：<a href =\'index.php?do=task&task_id=126\' target=\'_blank\' >能熟练使用ECshop后台帮助我完成网站建设</a></p><p>开始时间：2010-11-17 16:52:52</p><p>结束时间：2010-11-27 16:52:52</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289983972');
INSERT INTO keke_witkey_message VALUES ('309', '0', '0', null, '41', 'justing', '0', '0', '注册成功', '<p>尊敬的 justing：</p><p>&nbsp;感谢您对客客出品专业威客系统的信任，当您收到这封信的时候，您已经成功注册为客客出品专业威客系统会员。在这里，您可以感受到诚信、活泼、高效的网络交易文化。</p><p>如有任何疑问，欢迎随时与我们联系，我们将竭诚为您服务！<br />&nbsp;&nbsp;&nbsp;　 欢迎继续关注客客出品专业威客系统！ </p><p>&nbsp;&nbsp;&nbsp; 祝：</p><p>　&nbsp; 工作学习顺利，生活愉快！ </p><p>客客出品专业威客系统客服中心</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289984064');
INSERT INTO keke_witkey_message VALUES ('310', '0', '0', null, '36', 'lelezhi', '0', '0', '任务发布成功', '<p>尊敬的 lelezhi：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：127</p><p>任务标题：<a href =\'index.php?do=task&task_id=127\' target=\'_blank\' >旅行公司VI设计及Logo改善</a></p><p>开始时间：2010-11-17 16:54:37</p><p>结束时间：2010-12-17 16:54:37</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289984077');
INSERT INTO keke_witkey_message VALUES ('311', '0', '0', null, '37', 'jianghu', '0', '0', '任务发布成功', '<p>尊敬的 jianghu：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：128</p><p>任务标题：<a href =\'index.php?do=task&task_id=128\' target=\'_blank\' >企业门户网站设计（套）</a></p><p>开始时间：2010-11-17 16:54:45</p><p>结束时间：2010-12-07 16:54:45</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289984085');
INSERT INTO keke_witkey_message VALUES ('312', '0', '0', null, '37', 'jianghu', '0', '0', '任务发布成功', '<p>尊敬的 jianghu：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：129</p><p>任务标题：<a href =\'index.php?do=task&task_id=129\' target=\'_blank\' >景观3D效果图2张</a></p><p>开始时间：2010-11-17 16:56:19</p><p>结束时间：2010-12-10 16:56:19</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289984179');
INSERT INTO keke_witkey_message VALUES ('313', '0', '0', null, '37', 'jianghu', '0', '0', '任务发布成功', '<p>尊敬的 jianghu：</p><p>您的任务已发布成功，感谢您对客客出品专业威客系统的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：130</p><p>任务标题：<a href =\'index.php?do=task&task_id=130\' target=\'_blank\' >有谁会在地图上做地图找房的啊？重酬谢！</a></p><p>开始时间：2010-11-17 16:57:40</p><p>结束时间：2010-12-07 16:57:40</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289984260');
INSERT INTO keke_witkey_message VALUES ('314', '0', '0', null, '42', 'sky', '0', '0', '注册成功', '<p>尊敬的 sky：</p><p>&nbsp;感谢您对客客出品专业威客系统的信任，当您收到这封信的时候，您已经成功注册为客客出品专业威客系统会员。在这里，您可以感受到诚信、活泼、高效的网络交易文化。</p><p>如有任何疑问，欢迎随时与我们联系，我们将竭诚为您服务！<br />&nbsp;&nbsp;&nbsp;　 欢迎继续关注客客出品专业威客系统！ </p><p>&nbsp;&nbsp;&nbsp; 祝：</p><p>　&nbsp; 工作学习顺利，生活愉快！ </p><p>客客出品专业威客系统客服中心</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289984459');
INSERT INTO keke_witkey_message VALUES ('315', '0', '0', null, '42', 'sky', '0', '0', '系统消息', '管理员 <b>admin</b> 设置了您的帐户信息，', '1289985024');
INSERT INTO keke_witkey_message VALUES ('316', '0', '0', null, '42', 'sky', '0', '0', '系统消息', '系统管理员admin给您的现金帐户追加了 100000.00元,系统管理员admin给您的代金券帐户追加了 200000.00元', '1289985024');
INSERT INTO keke_witkey_message VALUES ('317', '0', '0', null, '43', 'jank', '0', '0', '注册成功', '<p>尊敬的 jank：</p><p>&nbsp;感谢您对客客出品专业威客系统的信任，当您收到这封信的时候，您已经成功注册为客客出品专业威客系统会员。在这里，您可以感受到诚信、活泼、高效的网络交易文化。</p><p>如有任何疑问，欢迎随时与我们联系，我们将竭诚为您服务！<br />&nbsp;&nbsp;&nbsp;　 欢迎继续关注客客出品专业威客系统！ </p><p>&nbsp;&nbsp;&nbsp; 祝：</p><p>　&nbsp; 工作学习顺利，生活愉快！ </p><p>客客出品专业威客系统客服中心</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289985898');
INSERT INTO keke_witkey_message VALUES ('318', '0', '0', null, '44', 'mark', '0', '0', '注册成功', '<p>尊敬的 mark：</p><p>&nbsp;感谢您对客客出品专业威客系统的信任，当您收到这封信的时候，您已经成功注册为客客出品专业威客系统会员。在这里，您可以感受到诚信、活泼、高效的网络交易文化。</p><p>如有任何疑问，欢迎随时与我们联系，我们将竭诚为您服务！<br />&nbsp;&nbsp;&nbsp;　 欢迎继续关注客客出品专业威客系统！ </p><p>&nbsp;&nbsp;&nbsp; 祝：</p><p>　&nbsp; 工作学习顺利，生活愉快！ </p><p>客客出品专业威客系统客服中心</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289986116');
INSERT INTO keke_witkey_message VALUES ('319', '0', '0', null, '42', 'sky', '0', '0', '您有新的订单', '<a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/index.php?do=space&member_id=1\">admin</a>购买了您的服务<a target=\"_blank\" href=\"shop.php?do=service_info&sid=51\">克罗瑞斯婚礼-婚车出租</a>  <a target=\"_blank\" href=\"http://192.168.1.77/kppw1.2/shop.php?do=step&order_id=33\">查看订单</a>', '1289986629');
INSERT INTO keke_witkey_message VALUES ('320', '0', '0', null, '45', '123123', '0', '0', '注册成功', '<p>尊敬的 123123：</p><p>&nbsp;感谢您对客客出品专业威客系统的信任，当您收到这封信的时候，您已经成功注册为客客出品专业威客系统会员。在这里，您可以感受到诚信、活泼、高效的网络交易文化。</p><p>如有任何疑问，欢迎随时与我们联系，我们将竭诚为您服务！<br />&nbsp;&nbsp;&nbsp;　 欢迎继续关注客客出品专业威客系统！ </p><p>&nbsp;&nbsp;&nbsp; 祝：</p><p>　&nbsp; 工作学习顺利，生活愉快！ </p><p>客客出品专业威客系统客服中心</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289989603');
INSERT INTO keke_witkey_message VALUES ('321', '0', '0', null, '46', '123456', '0', '0', '注册成功', '<p>尊敬的 123456：</p><p>&nbsp;感谢您对客客出品专业威客系统的信任，当您收到这封信的时候，您已经成功注册为客客出品专业威客系统会员。在这里，您可以感受到诚信、活泼、高效的网络交易文化。</p><p>如有任何疑问，欢迎随时与我们联系，我们将竭诚为您服务！<br />&nbsp;&nbsp;&nbsp;　 欢迎继续关注客客出品专业威客系统！ </p><p>&nbsp;&nbsp;&nbsp; 祝：</p><p>　&nbsp; 工作学习顺利，生活愉快！ </p><p>客客出品专业威客系统客服中心</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '1289989674');

-- ----------------------------
-- Table structure for `keke_witkey_message_config`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_message_config`;
CREATE TABLE `keke_witkey_message_config` (
  `msg_cofig_id` int(11) NOT NULL auto_increment,
  `reg_isnotice` int(11) default '0',
  `task_pub_isnotice` int(11) default '0',
  `tender_isnotice` int(11) default '0',
  `task_auth_fail_isnotice` int(11) default '0',
  `task_auth_success_isnotice` int(11) default '0',
  `pay_fail_isnotice` int(11) default '0',
  `user_auth_success_isnotice` int(11) default '0',
  `user_auth_fail_isnotice` int(11) default '0',
  `pay_success_isnotice` int(11) default '0',
  `draw_success_isnotice` int(11) default '0',
  `freeze_isnotice` int(11) default '0',
  `task_freeze_isnotice` int(11) default '0',
  `update_password_isnotice` int(11) default '0',
  `msg_send_type` int(11) default '0',
  `on_time` int(11) default '0',
  PRIMARY KEY  (`msg_cofig_id`),
  KEY `msg_cofig_id` (`msg_cofig_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_message_config
-- ----------------------------
INSERT INTO keke_witkey_message_config VALUES ('1', '4', '2', '4', '4', '4', '2', '2', '2', '2', '4', '3', '2', '3', '3', '1277710440');

-- ----------------------------
-- Table structure for `keke_witkey_message_template`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_message_template`;
CREATE TABLE `keke_witkey_message_template` (
  `msg_temp_id` int(11) NOT NULL auto_increment,
  `msg_temp_type` varchar(30) default '0',
  `msg_temp_content` text,
  `listorder` int(11) default '0',
  PRIMARY KEY  (`msg_temp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_message_template
-- ----------------------------
INSERT INTO keke_witkey_message_template VALUES ('1', 'reg_isnotice', '<p>尊敬的 {用户名}：</p><p>&nbsp;感谢您对{网站名称}的信任，当您收到这封信的时候，您已经成功注册为{网站名称}会员。在这里，您可以感受到诚信、活泼、高效的网络交易文化。</p><p>如有任何疑问，欢迎随时与我们联系，我们将竭诚为您服务！<br />&nbsp;&nbsp;&nbsp;　 欢迎继续关注{网站名称}！ </p><p>&nbsp;&nbsp;&nbsp; 祝：</p><p>　&nbsp; 工作学习顺利，生活愉快！ </p><p>{网站名称}客服中心</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '0');
INSERT INTO keke_witkey_message_template VALUES ('2', 'task_pub_isnotice', '<p>尊敬的 {用户名}：</p><p>您的任务已发布成功，感谢您对{网站名称}的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：{任务编号}</p><p>任务标题：{任务链接}</p><p>开始时间：{开始时间}</p><p>结束时间：{结束时间}</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '0');
INSERT INTO keke_witkey_message_template VALUES ('3', 'tender_isnotice', '<p>尊敬的 {用户名}：</p><p>恭喜您成功中标，感谢您对{用户名}网的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：{任务编号}</p><p>任务标题：{任务标题}</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '0');
INSERT INTO keke_witkey_message_template VALUES ('4', 'pay_success_isnotice', '<p>尊敬的 {用户名}：</p><p>您成功充值{充值金额}元，感谢您对{网站名称}的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '0');
INSERT INTO keke_witkey_message_template VALUES ('5', 'draw_success_isnotice', '<p>您在{网站名称}的提现申请已被受理，您的提现金额为{提现金额}，请查收！</p>', '0');
INSERT INTO keke_witkey_message_template VALUES ('6', 'task_auth_success_isnotice', '<p>尊敬的 {用户名}：</p><p>您的发布的任务已通过审核，感谢您对{网站名称}的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：{任务编号}</p><p>任务链接：{任务链接}</p><p>任务标题：{任务标题}</p><p>开始时间：{开始时间}</p><p>结束时间：{结束时间}</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '0');
INSERT INTO keke_witkey_message_template VALUES ('7', 'task_auth_fail_isnotice', '<p>尊敬的 {用户名}：</p><p>您的发布的任务 {任务标题} 未通过审核，感谢您对{网站名称}的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '0');
INSERT INTO keke_witkey_message_template VALUES ('8', 'user_auth_success_isnotice', '<p>尊敬的 {用户名}：</p><p>您的认证信息已经通过，感谢您对{网站名称}的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '0');
INSERT INTO keke_witkey_message_template VALUES ('9', 'user_auth_fail_isnotice', '<p>尊敬的 {用户名}：</p><p>您的认证信息未通过，感谢您对{网站名称}的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '0');
INSERT INTO keke_witkey_message_template VALUES ('10', 'freeze_isnotice', '<p>尊敬的 {用户名}：</p><p>您的用户已被冻结，感谢您对{网站名称}的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '0');
INSERT INTO keke_witkey_message_template VALUES ('11', 'task_freeze_isnotice', '<p>尊敬的 {用户名}：</p><p>您的任务<u>（{任务标题}）</u>已被冻结，感谢您对{网站名称}的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '0');
INSERT INTO keke_witkey_message_template VALUES ('12', 'update_password_isnotice', '<p>尊敬的 {用户名}：</p><p>您的密码已经修改，新密码是：<u>（{新密码}）</u>，感谢您对{网站名称}的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '0');
INSERT INTO keke_witkey_message_template VALUES ('13', 'task_pub_isnotice', '<p>尊敬的 {用户名}：</p><p>您的任务已发布成功，感谢您对{网站名称}的信任。如有特殊情况，请致电客服，我们将协助您解决问题。</p><p>任务编号：{任务编号}</p><p>任务标题：{任务链接}</p><p>开始时间：{开始时间}</p><p>结束时间：{结束时间}</p><p>--------------------------------------------------------------------------------------------------------------------</p><p>此邮件为系统自动发出的邮件，请勿直接回复。</p>', '0');

-- ----------------------------
-- Table structure for `keke_witkey_model`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_model`;
CREATE TABLE `keke_witkey_model` (
  `model_id` int(11) NOT NULL auto_increment,
  `model_code` varchar(20) default NULL,
  `model_name` varchar(20) default NULL,
  `model_dir` varchar(20) default NULL,
  `model_dev` varchar(20) default NULL,
  `model_status` int(11) default NULL,
  `on_time` int(11) default NULL,
  `listorder` int(11) default '0',
  PRIMARY KEY  (`model_id`),
  KEY `model_id` (`model_id`),
  KEY `on_time` (`on_time`),
  KEY `model_status` (`model_status`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_model
-- ----------------------------
INSERT INTO keke_witkey_model VALUES ('1', 'reward', '悬赏任务', 'reward', 'kekezu', '1', '1282615304', null);
INSERT INTO keke_witkey_model VALUES ('2', 'tender', '招标任务', 'tender', 'kekezu', '1', '1282615331', null);
INSERT INTO keke_witkey_model VALUES ('6', 'employtask', '雇佣任务', 'employtask', 'kekezu', '1', '1287404346', null);

-- ----------------------------
-- Table structure for `keke_witkey_nav`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_nav`;
CREATE TABLE `keke_witkey_nav` (
  `nav_id` int(11) NOT NULL auto_increment,
  `nav_url` varchar(200) default NULL,
  `nav_title` varchar(20) default NULL,
  `nav_style` varchar(20) default NULL,
  `listorder` int(11) default '0',
  `newwindow` int(11) default '0',
  `ishide` int(11) default '0',
  PRIMARY KEY  (`nav_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_nav
-- ----------------------------
INSERT INTO keke_witkey_nav VALUES ('1', 'index.php', '首页', 'index', '1', '0', '0');
INSERT INTO keke_witkey_nav VALUES ('4', 'index.php?do=task_list&model_id=2', '招标任务', 'tender', '3', '0', '0');
INSERT INTO keke_witkey_nav VALUES ('5', 'index.php?do=case_list', '成功案例', 'case', '4', '0', '0');
INSERT INTO keke_witkey_nav VALUES ('6', 'index.php?do=news_list', '资讯中心', 'newslist', '5', '0', '0');
INSERT INTO keke_witkey_nav VALUES ('7', 'index.php?do=task_list&model_id=1', '悬赏任务', 'reward', '2', '0', '0');
INSERT INTO keke_witkey_nav VALUES ('8', 'shop.php', '威客商城', 'shop', '6', '0', '3');
INSERT INTO keke_witkey_nav VALUES ('9', 'index.php?do=talent', '人才库', 'talent', '7', '0', '0');

-- ----------------------------
-- Table structure for `keke_witkey_pay`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_pay`;
CREATE TABLE `keke_witkey_pay` (
  `order_id` int(11) unsigned NOT NULL auto_increment,
  `order_type` varchar(20) default NULL,
  `pay_type` varchar(20) default '0',
  `return_order_id` int(11) default '0',
  `obj_id` int(11) default '0',
  `uid` varchar(50) default NULL,
  `username` varchar(20) default '0',
  `pay_time` int(11) default '0',
  `pay_money` float(8,2) default NULL,
  `order_status` int(11) default NULL,
  PRIMARY KEY  (`order_id`),
  KEY `order_id` (`order_id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_pay
-- ----------------------------
INSERT INTO keke_witkey_pay VALUES ('60', 'task', 'alipayjs', '0', '90', '35', 'bluesky', '1289981949', '500.00', '2');
INSERT INTO keke_witkey_pay VALUES ('61', 'online', 'alipayjs', '0', '0', '38', 'jesomo', '1289987630', '5.00', '2');

-- ----------------------------
-- Table structure for `keke_witkey_payment`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_payment`;
CREATE TABLE `keke_witkey_payment` (
  `k` varchar(200) default NULL,
  `name` varchar(20) default NULL,
  `v` varchar(200) default NULL,
  `payment` varchar(50) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_payment
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_paypal_config`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_paypal_config`;
CREATE TABLE `keke_witkey_paypal_config` (
  `paypay_config_id` int(11) NOT NULL auto_increment,
  `currency` int(11) default NULL,
  `recharge_min` float default NULL,
  `withdraw_min` float default NULL,
  `withdraw_max` float default NULL,
  `alipay_num` varchar(100) default NULL,
  `alipay_partner` varchar(100) default NULL,
  `alipay_safety_code` varchar(100) default NULL,
  `tenpay_seller_id` varchar(100) default NULL,
  `tenpay_ckey` varchar(100) default NULL,
  `chinabank_seller_id` varchar(100) default NULL,
  `chinabank_ckey` varchar(100) default NULL,
  `on_time` int(11) default '0',
  PRIMARY KEY  (`paypay_config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_paypal_config
-- ----------------------------
INSERT INTO keke_witkey_paypal_config VALUES ('1', '1', '5', '5', '1000', '', '', '', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `keke_witkey_promotion`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_promotion`;
CREATE TABLE `keke_witkey_promotion` (
  `prom_id` int(11) NOT NULL auto_increment,
  `prom_uid` int(11) default '0',
  `pub_uid` int(11) default '0',
  `join_uid` int(11) default '0',
  `task_id` int(11) default '0',
  `prom_money` float default '0',
  `prom_status` int(11) default '0',
  `prom_time` int(11) default '0',
  PRIMARY KEY  (`prom_id`),
  KEY `prom_id` (`prom_id`),
  KEY `join_uid` (`join_uid`),
  KEY `task_id` (`task_id`),
  KEY `pub_uid` (`pub_uid`),
  KEY `prom_time` (`prom_time`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_promotion
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_realname_auth`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_realname_auth`;
CREATE TABLE `keke_witkey_realname_auth` (
  `realname_a_id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `username` varchar(50) default NULL,
  `realname` varchar(50) default NULL,
  `id_card` varchar(50) default NULL,
  `id_pic` varchar(100) default NULL,
  `cash` float default NULL,
  `start_time` int(11) default NULL,
  `end_time` int(11) default NULL,
  `auth_status` int(11) default NULL,
  PRIMARY KEY  (`realname_a_id`),
  KEY `realname_a_id` (`realname_a_id`),
  KEY `uid` (`uid`),
  KEY `auth_status` (`auth_status`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_realname_auth
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_resource`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_resource`;
CREATE TABLE `keke_witkey_resource` (
  `resource_id` int(11) NOT NULL auto_increment,
  `resource_name` varchar(20) default NULL,
  `resource_url` varchar(100) default NULL,
  `submenu_id` varchar(20) default NULL,
  `listorder` int(11) default '0',
  PRIMARY KEY  (`resource_id`),
  KEY `resource_id` (`resource_id`),
  KEY `submenu_id` (`submenu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_resource
-- ----------------------------
INSERT INTO `keke_witkey_resource` VALUES(1, '基本配置', 'index.php?do=config&view=basic&op=conf', '1', 1);
INSERT INTO `keke_witkey_resource` VALUES(2, '支付接口', 'index.php?do=config&view=pay', '1', 5);
INSERT INTO `keke_witkey_resource` VALUES(6, '财务统计', 'index.php?do=finance&view=in', '2', 1);
INSERT INTO `keke_witkey_resource` VALUES(8, '流水记录', 'index.php?do=finance&view=all', '2', 3);
INSERT INTO `keke_witkey_resource` VALUES(9, '提现审核', 'index.php?do=finance&view=withdraw', '2', 5);
INSERT INTO `keke_witkey_resource` VALUES(19, '添加行业', 'index.php?do=task&view=edit_industry', '5', 1);
INSERT INTO `keke_witkey_resource` VALUES(20, '行业管理', 'index.php?do=task&view=industry', '5', 2);
INSERT INTO `keke_witkey_resource` VALUES(21, '技能管理', 'index.php?do=task&view=skill', '5', 4);
INSERT INTO `keke_witkey_resource` VALUES(22, '任务留言', 'index.php?do=task&view=comment', '6', 0);
INSERT INTO `keke_witkey_resource` VALUES(23, '添加用户', 'index.php?do=user&type=front&op=add', '7', 1);
INSERT INTO `keke_witkey_resource` VALUES(24, '用户管理', 'index.php?do=user&type=front', '7', 2);
INSERT INTO `keke_witkey_resource` VALUES(28, '添加系统组', 'index.php?do=user&type=back&view=group&op=add', '8', 0);
INSERT INTO `keke_witkey_resource` VALUES(29, '系统组管理', 'index.php?do=user&type=back&view=group', '8', 0);
INSERT INTO `keke_witkey_resource` VALUES(30, '分类管理', 'index.php?do=art_cat&type=art', '9', 4);
INSERT INTO `keke_witkey_resource` VALUES(31, '添加文章', 'index.php?do=edit_article&type=art', '9', 1);
INSERT INTO `keke_witkey_resource` VALUES(32, '文章管理', 'index.php?do=article&type=art', '9', 2);
INSERT INTO `keke_witkey_resource` VALUES(33, '数据库备份', 'index.php?do=tool&view=backup', '10', 2);
INSERT INTO `keke_witkey_resource` VALUES(34, '数据库恢复', 'index.php?do=tool&view=restore', '10', 3);
INSERT INTO `keke_witkey_resource` VALUES(35, '系统日志', 'index.php?do=tool&view=log', '10', 4);
INSERT INTO `keke_witkey_resource` VALUES(36, '缓存更新', 'index.php?do=tool&view=cache', '10', 1);
INSERT INTO `keke_witkey_resource` VALUES(37, '附件清空', 'index.php?do=tool&view=file', '10', 5);
INSERT INTO `keke_witkey_resource` VALUES(39, '添加分类', 'index.php?do=edit_art_cat&type=art', '9', 3);
INSERT INTO `keke_witkey_resource` VALUES(41, '邮件配置', 'index.php?do=config&view=mail', '1', 4);
INSERT INTO `keke_witkey_resource` VALUES(42, '添加技能', 'index.php?do=task&view=edit_skill', '5', 3);
INSERT INTO `keke_witkey_resource` VALUES(44, '站内短信', 'index.php?do=config&view=msg', '1', 8);
INSERT INTO `keke_witkey_resource` VALUES(45, 'vip收费规则', 'index.php?do=config&view=vip', '14', 7);
INSERT INTO `keke_witkey_resource` VALUES(47, '图形报表', 'index.php?do=finance&view=report', '2', 4);
INSERT INTO `keke_witkey_resource` VALUES(51, '模板管理', 'index.php?do=config&view=tpl', '12', 1);
INSERT INTO `keke_witkey_resource` VALUES(52, '标签调用', 'index.php?do=tpl&view=taglist', '12', 2);
INSERT INTO `keke_witkey_resource` VALUES(53, '友情链接', 'index.php?do=tpl&view=link', '12', 3);
INSERT INTO `keke_witkey_resource` VALUES(54, '统计信息', 'index.php?do=finance&view=info', '2', 0);
INSERT INTO `keke_witkey_resource` VALUES(55, '广告管理', 'index.php?do=tpl&view=ad', '12', 4);
INSERT INTO `keke_witkey_resource` VALUES(75, '客服管理', 'index.php?do=user&type=service', '1', 20);
INSERT INTO `keke_witkey_resource` VALUES(74, '站点信息', 'index.php?do=config&view=basic&op=info', '1', 0);
INSERT INTO `keke_witkey_resource` VALUES(61, '会员整合', 'index.php?do=config&view=integration', '1', 20);
INSERT INTO `keke_witkey_resource` VALUES(62, '经验值配置', 'index.php?do=config&view=score', '14', 1);
INSERT INTO `keke_witkey_resource` VALUES(66, '信誉值配置', 'index.php?do=config&view=mark', '14', 3);
INSERT INTO `keke_witkey_resource` VALUES(69, '任务模型', 'index.php?do=config&view=model', '1', 10);
INSERT INTO `keke_witkey_resource` VALUES(70, '认证项目', 'index.php?do=auth&view=item_list', '14', 0);
INSERT INTO `keke_witkey_resource` VALUES(71, '身份证认证管理', 'index.php?do=auth&view=realname_list', '16', 0);
INSERT INTO `keke_witkey_resource` VALUES(72, '企业认证管理', 'index.php?do=auth&view=enterprise_list', '16', 0);
INSERT INTO `keke_witkey_resource` VALUES(73, '银行认证管理', 'index.php?do=auth&view=bank_list', '16', 0);
INSERT INTO `keke_witkey_resource` VALUES(76, '客服留言', 'index.php?do=task&view=custom', '6', 0);
INSERT INTO `keke_witkey_resource` VALUES(78, '工作室管理', 'index.php?do=studio&view=list', '1', 21);
INSERT INTO `keke_witkey_resource` VALUES(79, '自定义导航', 'index.php?do=config&view=nav', '1', 100);
INSERT INTO `keke_witkey_resource` VALUES(80, '帮助管理', 'index.php?do=article&type=help', '17', 0);
INSERT INTO `keke_witkey_resource` VALUES(81, '添加帮助', 'index.php?do=edit_article&type=help', '17', 0);
INSERT INTO `keke_witkey_resource` VALUES(82, '帮助分类', 'index.php?do=art_cat&type=help', '17', 0);
INSERT INTO `keke_witkey_resource` VALUES(83, '添加分类', 'index.php?do=edit_art_cat&type=help', '17', 0);
INSERT INTO `keke_witkey_resource` VALUES(88, '店铺主题', 'index.php?do=shop&view=banner', '20', 0);
INSERT INTO `keke_witkey_resource` VALUES(89, '添加主题', 'index.php?do=shop&view=edit_banner', '20', 0);
INSERT INTO `keke_witkey_resource` VALUES(92, '店铺管理', 'index.php?do=shop&view=shop', '19', 0);
INSERT INTO `keke_witkey_resource` VALUES(93, '用户组', 'index.php?do=group', '22', 0);
INSERT INTO `keke_witkey_resource` VALUES(94, '商城配置', 'index.php?do=shop&view=config', '19', 0);
INSERT INTO `keke_witkey_resource` VALUES(95, '用户权限管理', 'index.php?do=rule', '7', 10);
INSERT INTO `keke_witkey_resource` VALUES(96, '案例管理', 'index.php?do=case&view=list', '23', 0);
INSERT INTO `keke_witkey_resource` VALUES(97, '单页管理', 'index.php?do=article&type=single', '24', 0);
INSERT INTO `keke_witkey_resource` VALUES(98, '添加单页', 'index.php?do=edit_article&type=single', '24', 1);
INSERT INTO `keke_witkey_resource` VALUES(99, '商品管理', 'index.php?do=shop&view=service', '19', 4);
INSERT INTO `keke_witkey_resource` VALUES(100, '订单管理', 'index.php?do=shop&view=order', '19', 6);



-- ----------------------------
-- Table structure for `keke_witkey_resource_submenu`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_resource_submenu`;
CREATE TABLE `keke_witkey_resource_submenu` (
  `submenu_id` int(11) NOT NULL auto_increment,
  `submenu_name` varchar(20) default NULL,
  `menu_name` varchar(10) default NULL,
  `listorder` int(11) default '0',
  PRIMARY KEY  (`submenu_id`),
  KEY `submenu_id` (`submenu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_resource_submenu
-- ----------------------------
INSERT INTO `keke_witkey_resource_submenu` VALUES(1, '系统配置', 'config', 1);
INSERT INTO `keke_witkey_resource_submenu` VALUES(2, '财务模块', 'finance', 0);
INSERT INTO `keke_witkey_resource_submenu` VALUES(5, '任务行业分类', 'config', 4);
INSERT INTO `keke_witkey_resource_submenu` VALUES(6, '任务交流', 'task', 0);
INSERT INTO `keke_witkey_resource_submenu` VALUES(7, '会员管理', 'user', 0);
INSERT INTO `keke_witkey_resource_submenu` VALUES(8, '系统组管理', 'user', 0);
INSERT INTO `keke_witkey_resource_submenu` VALUES(9, '资讯模块', 'article', 1);
INSERT INTO `keke_witkey_resource_submenu` VALUES(10, '系统工具', 'tool', 0);
INSERT INTO `keke_witkey_resource_submenu` VALUES(12, '模板标签', 'tpl', 0);
INSERT INTO `keke_witkey_resource_submenu` VALUES(14, '用户体系', 'config', 3);
INSERT INTO `keke_witkey_resource_submenu` VALUES(16, '认证管理', 'user', 10);
INSERT INTO `keke_witkey_resource_submenu` VALUES(17, '帮助模块', 'article', 3);
INSERT INTO `keke_witkey_resource_submenu` VALUES(19, '店铺管理', 'shop', 1);
INSERT INTO `keke_witkey_resource_submenu` VALUES(23, '案例管理', 'task', 10);
INSERT INTO `keke_witkey_resource_submenu` VALUES(24, '单页面管理', 'article', 5);


-- ----------------------------
-- Table structure for `keke_witkey_rule`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_rule`;
CREATE TABLE `keke_witkey_rule` (
  `rule_id` int(11) NOT NULL auto_increment,
  `rule_key` varchar(50) default '',
  `rule_group` varchar(50) default '',
  `rule` varchar(20) default '0',
  PRIMARY KEY  (`rule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=366 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_rule
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_score_config`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_score_config`;
CREATE TABLE `keke_witkey_score_config` (
  `login` int(11) NOT NULL auto_increment,
  `register` int(11) default NULL,
  `update_pic` int(11) default NULL,
  `edit_userinfo` int(11) default NULL,
  `edit_withdrawinfo` int(11) default NULL,
  `buy_vip` int(11) default NULL,
  `online_pay` int(11) default NULL,
  `withdraw` int(11) default NULL,
  `pub_task` int(11) default NULL,
  `view_task` int(11) default NULL,
  `collect_task` int(11) default NULL,
  `task_comment` int(11) default NULL,
  `task_apply` int(11) default NULL,
  `task_pubwork` int(11) default NULL,
  `task_bid` int(11) default NULL,
  `work_accept` int(11) default NULL,
  `view_space` int(11) default NULL,
  `user_mark` int(11) default NULL,
  `access_shop` int(11) default NULL,
  `buy_service` int(11) default NULL,
  `create_service` int(11) default NULL,
  `service_comment` int(11) default NULL,
  `create_shop` int(11) default NULL,
  `update_date` int(11) default NULL,
  PRIMARY KEY  (`login`),
  KEY `index_1` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_score_config
-- ----------------------------
INSERT INTO keke_witkey_score_config VALUES ('2', '5', '2', '2', '2', '10', '5', '2', '10', '1', '1', '2', '2', '4', '4', '20', '1', '5', '19', '20', '21', '22', '23', null);

-- ----------------------------
-- Table structure for `keke_witkey_score_log`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_score_log`;
CREATE TABLE `keke_witkey_score_log` (
  `score_log_id` int(11) NOT NULL auto_increment,
  `score_log_type` varchar(50) default NULL,
  `uid` int(11) default NULL,
  `score_num` int(11) default NULL,
  `on_date` int(11) default NULL,
  PRIMARY KEY  (`score_log_id`),
  KEY `score_log_id` (`score_log_id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=639 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_score_log
-- ----------------------------
INSERT INTO keke_witkey_score_log VALUES ('549', 'login', '1', '2', '1289980706');
INSERT INTO keke_witkey_score_log VALUES ('550', 'register', '35', '5', '1289981075');
INSERT INTO keke_witkey_score_log VALUES ('551', 'register', '36', '5', '1289981078');
INSERT INTO keke_witkey_score_log VALUES ('552', 'pub_task', '35', '10', '1289981920');
INSERT INTO keke_witkey_score_log VALUES ('553', 'pub_task', '36', '10', '1289982082');
INSERT INTO keke_witkey_score_log VALUES ('554', 'view_task', '36', '1', '1289982090');
INSERT INTO keke_witkey_score_log VALUES ('555', 'pub_task', '35', '10', '1289982125');
INSERT INTO keke_witkey_score_log VALUES ('556', 'view_task', '1', '1', '1289982140');
INSERT INTO keke_witkey_score_log VALUES ('557', 'view_task', '35', '1', '1289982144');
INSERT INTO keke_witkey_score_log VALUES ('558', 'pub_task', '36', '10', '1289982261');
INSERT INTO keke_witkey_score_log VALUES ('559', 'pub_task', '35', '10', '1289982294');
INSERT INTO keke_witkey_score_log VALUES ('560', 'pub_task', '35', '10', '1289982444');
INSERT INTO keke_witkey_score_log VALUES ('561', 'pub_task', '36', '10', '1289982482');
INSERT INTO keke_witkey_score_log VALUES ('562', 'pub_task', '35', '10', '1289982546');
INSERT INTO keke_witkey_score_log VALUES ('563', 'pub_task', '35', '10', '1289982640');
INSERT INTO keke_witkey_score_log VALUES ('564', 'pub_task', '35', '10', '1289982697');
INSERT INTO keke_witkey_score_log VALUES ('565', 'login', '36', '2', '1289982762');
INSERT INTO keke_witkey_score_log VALUES ('566', 'pub_task', '35', '10', '1289982807');
INSERT INTO keke_witkey_score_log VALUES ('567', 'pub_task', '35', '10', '1289982886');
INSERT INTO keke_witkey_score_log VALUES ('568', 'pub_task', '36', '10', '1289982886');
INSERT INTO keke_witkey_score_log VALUES ('569', 'pub_task', '36', '10', '1289982981');
INSERT INTO keke_witkey_score_log VALUES ('570', 'pub_task', '35', '10', '1289982992');
INSERT INTO keke_witkey_score_log VALUES ('571', 'pub_task', '35', '10', '1289983051');
INSERT INTO keke_witkey_score_log VALUES ('572', 'pub_task', '35', '10', '1289983131');
INSERT INTO keke_witkey_score_log VALUES ('573', 'pub_task', '36', '10', '1289983174');
INSERT INTO keke_witkey_score_log VALUES ('574', 'pub_task', '35', '10', '1289983211');
INSERT INTO keke_witkey_score_log VALUES ('575', 'pub_task', '36', '10', '1289983244');
INSERT INTO keke_witkey_score_log VALUES ('576', 'login', '37', '2', '1289983247');
INSERT INTO keke_witkey_score_log VALUES ('577', 'pub_task', '36', '10', '1289983304');
INSERT INTO keke_witkey_score_log VALUES ('578', 'pub_task', '37', '10', '1289983321');
INSERT INTO keke_witkey_score_log VALUES ('579', 'register', '38', '5', '1289983329');
INSERT INTO keke_witkey_score_log VALUES ('580', 'view_task', '38', '1', '1289983349');
INSERT INTO keke_witkey_score_log VALUES ('581', 'pub_task', '37', '10', '1289983393');
INSERT INTO keke_witkey_score_log VALUES ('582', 'pub_task', '36', '10', '1289983393');
INSERT INTO keke_witkey_score_log VALUES ('583', 'task_pubwork', '38', '4', '1289983463');
INSERT INTO keke_witkey_score_log VALUES ('584', 'pub_task', '37', '10', '1289983482');
INSERT INTO keke_witkey_score_log VALUES ('585', 'register', '39', '5', '1289983509');
INSERT INTO keke_witkey_score_log VALUES ('586', 'task_comment', '38', '2', '1289983532');
INSERT INTO keke_witkey_score_log VALUES ('587', 'pub_task', '36', '10', '1289983534');
INSERT INTO keke_witkey_score_log VALUES ('588', 'view_task', '39', '1', '1289983553');
INSERT INTO keke_witkey_score_log VALUES ('589', 'pub_task', '37', '10', '1289983559');
INSERT INTO keke_witkey_score_log VALUES ('590', 'pub_task', '36', '10', '1289983584');
INSERT INTO keke_witkey_score_log VALUES ('591', 'task_pubwork', '38', '4', '1289983588');
INSERT INTO keke_witkey_score_log VALUES ('592', 'view_space', '39', '1', '1289983590');
INSERT INTO keke_witkey_score_log VALUES ('593', 'task_pubwork', '39', '4', '1289983626');
INSERT INTO keke_witkey_score_log VALUES ('594', 'pub_task', '37', '10', '1289983666');
INSERT INTO keke_witkey_score_log VALUES ('595', 'task_comment', '39', '2', '1289983669');
INSERT INTO keke_witkey_score_log VALUES ('596', 'pub_task', '36', '10', '1289983690');
INSERT INTO keke_witkey_score_log VALUES ('597', 'create_shop', '1', '23', '1289983696');
INSERT INTO keke_witkey_score_log VALUES ('598', 'task_pubwork', '38', '4', '1289983708');
INSERT INTO keke_witkey_score_log VALUES ('599', 'register', '40', '5', '1289983739');
INSERT INTO keke_witkey_score_log VALUES ('600', 'pub_task', '37', '10', '1289983746');
INSERT INTO keke_witkey_score_log VALUES ('601', 'pub_task', '36', '10', '1289983788');
INSERT INTO keke_witkey_score_log VALUES ('602', 'pub_task', '37', '10', '1289983821');
INSERT INTO keke_witkey_score_log VALUES ('603', 'task_pubwork', '38', '4', '1289983831');
INSERT INTO keke_witkey_score_log VALUES ('604', 'view_task', '40', '1', '1289983872');
INSERT INTO keke_witkey_score_log VALUES ('605', 'task_pubwork', '40', '4', '1289983885');
INSERT INTO keke_witkey_score_log VALUES ('606', 'task_pubwork', '38', '4', '1289983902');
INSERT INTO keke_witkey_score_log VALUES ('607', 'pub_task', '36', '10', '1289983905');
INSERT INTO keke_witkey_score_log VALUES ('608', 'pub_task', '36', '10', '1289983972');
INSERT INTO keke_witkey_score_log VALUES ('609', 'register', '41', '5', '1289984065');
INSERT INTO keke_witkey_score_log VALUES ('610', 'pub_task', '36', '10', '1289984077');
INSERT INTO keke_witkey_score_log VALUES ('611', 'pub_task', '37', '10', '1289984085');
INSERT INTO keke_witkey_score_log VALUES ('612', 'pub_task', '37', '10', '1289984179');
INSERT INTO keke_witkey_score_log VALUES ('613', 'pub_task', '37', '10', '1289984260');
INSERT INTO keke_witkey_score_log VALUES ('614', 'login', '38', '2', '1289984303');
INSERT INTO keke_witkey_score_log VALUES ('615', 'create_shop', '41', '23', '1289984377');
INSERT INTO keke_witkey_score_log VALUES ('616', 'create_shop', '38', '23', '1289984382');
INSERT INTO keke_witkey_score_log VALUES ('617', 'create_shop', '40', '23', '1289984399');
INSERT INTO keke_witkey_score_log VALUES ('618', 'register', '42', '5', '1289984460');
INSERT INTO keke_witkey_score_log VALUES ('619', 'create_shop', '42', '23', '1289984784');
INSERT INTO keke_witkey_score_log VALUES ('620', 'view_space', '1', '1', '1289985091');
INSERT INTO keke_witkey_score_log VALUES ('621', 'access_shop', '1', '19', '1289985288');
INSERT INTO keke_witkey_score_log VALUES ('622', 'edit_withdrawinfo', '42', '2', '1289985290');
INSERT INTO keke_witkey_score_log VALUES ('623', 'register', '43', '5', '1289985900');
INSERT INTO keke_witkey_score_log VALUES ('624', 'create_shop', '43', '23', '1289985943');
INSERT INTO keke_witkey_score_log VALUES ('625', 'access_shop', '43', '19', '1289986046');
INSERT INTO keke_witkey_score_log VALUES ('626', 'register', '44', '5', '1289986117');
INSERT INTO keke_witkey_score_log VALUES ('627', 'create_shop', '44', '23', '1289986255');
INSERT INTO keke_witkey_score_log VALUES ('628', 'access_shop', '44', '19', '1289986356');
INSERT INTO keke_witkey_score_log VALUES ('629', 'buy_service', '1', '20', '1289986633');
INSERT INTO keke_witkey_score_log VALUES ('630', 'view_space', '44', '1', '1289986714');
INSERT INTO keke_witkey_score_log VALUES ('631', 'access_shop', '40', '19', '1289989159');
INSERT INTO keke_witkey_score_log VALUES ('632', 'access_shop', '42', '19', '1289989361');
INSERT INTO keke_witkey_score_log VALUES ('633', 'register', '45', '5', '1289989604');
INSERT INTO keke_witkey_score_log VALUES ('634', 'create_shop', '45', '23', '1289989655');
INSERT INTO keke_witkey_score_log VALUES ('635', 'register', '46', '5', '1289989675');
INSERT INTO keke_witkey_score_log VALUES ('636', 'create_shop', '46', '23', '1289989719');
INSERT INTO keke_witkey_score_log VALUES ('637', 'login', '35', '2', '1289989830');
INSERT INTO keke_witkey_score_log VALUES ('638', 'login', '42', '2', '1289989921');

-- ----------------------------
-- Table structure for `keke_witkey_score_rule`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_score_rule`;
CREATE TABLE `keke_witkey_score_rule` (
  `score_rule_id` int(11) NOT NULL auto_increment,
  `min_score` int(11) default NULL,
  `max_score` int(11) default NULL,
  `unit_count` int(11) default NULL,
  `unit_id` int(11) default NULL,
  `unit_title` varchar(50) default NULL,
  `unit_ico` varchar(200) default NULL,
  PRIMARY KEY  (`score_rule_id`),
  KEY `index_1` (`score_rule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_score_rule
-- ----------------------------
INSERT INTO keke_witkey_score_rule VALUES ('1', null, '50', '0', '34', '书童', 'data/uploads/ico/208694c71e828e6fd3.gif');
INSERT INTO keke_witkey_score_rule VALUES ('6', null, '200', '0', '34', '书生', 'data/uploads/ico/273064c71e860b0e10.gif');
INSERT INTO keke_witkey_score_rule VALUES ('10', null, '400', '0', '34', '秀才', 'data/uploads/ico/49914c71e86f58875.gif');
INSERT INTO keke_witkey_score_rule VALUES ('11', null, '700', '0', '34', '举人', 'data/uploads/ico/121084c71e886289f9.gif');
INSERT INTO keke_witkey_score_rule VALUES ('9', null, '1000', '0', '34', '解元', 'data/uploads/ico/316374c71e8b358ca0.gif');
INSERT INTO keke_witkey_score_rule VALUES ('12', null, '1400', '0', '34', '贡士', 'data/uploads/ico/256844c71e8c6d2ec0.gif');
INSERT INTO keke_witkey_score_rule VALUES ('13', null, '1800', '0', '34', '会元', 'data/uploads/ico/262674c71e8d56c5ba.gif');
INSERT INTO keke_witkey_score_rule VALUES ('14', null, '2400', '0', '34', '进士', 'data/uploads/ico/271534c71e8f4a11fe.gif');
INSERT INTO keke_witkey_score_rule VALUES ('16', null, '3200', '0', '34', '探花', 'data/uploads/ico/327654c71e9183ad6c.gif');
INSERT INTO keke_witkey_score_rule VALUES ('17', null, '4500', '0', '34', '榜眼', 'data/uploads/ico/19104c71e92568fd8.gif');
INSERT INTO keke_witkey_score_rule VALUES ('29', null, '6000', '0', null, '大学士', 'data/uploads/ico/176504c71e935874b8.gif');
INSERT INTO keke_witkey_score_rule VALUES ('28', null, '10000', '0', null, '侍郎', 'data/uploads/ico/134824c71e955ccb9c.gif');
INSERT INTO keke_witkey_score_rule VALUES ('27', null, '15000', '0', null, '御史中丞', 'data/uploads/ico/182434c71e97aafdc1.gif');
INSERT INTO keke_witkey_score_rule VALUES ('20', null, '25000', '0', null, '状元', 'data/uploads/ico/291204c71e98978c5b.gif');
INSERT INTO keke_witkey_score_rule VALUES ('26', null, '40000', '0', null, '翰林学士', 'data/uploads/ico/79294c71e99688c81.gif');
INSERT INTO keke_witkey_score_rule VALUES ('24', null, '70000', '0', null, '编修', 'data/uploads/ico/159344c71e9a4ef981.gif');
INSERT INTO keke_witkey_score_rule VALUES ('25', null, '100000', '0', null, '府丞', 'data/uploads/ico/152274c71e9b4f2fac.gif');
INSERT INTO keke_witkey_score_rule VALUES ('30', null, '999999999', '0', null, '文曲星', 'data/uploads/ico/297524c71e9c488b60.gif');

-- ----------------------------
-- Table structure for `keke_witkey_service`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_service`;
CREATE TABLE `keke_witkey_service` (
  `service_id` int(11) NOT NULL auto_increment,
  `service_type` int(11) default NULL,
  `shop_id` int(11) default NULL,
  `uid` int(11) default NULL,
  `username` varchar(20) default NULL,
  `indus_id` int(11) default NULL,
  `indus_path` varchar(100) default NULL,
  `cus_cate_id` int(11) default NULL,
  `title` varchar(50) default NULL,
  `price` float(10,2) default NULL,
  `unite_price` varchar(50) default NULL,
  `service_time` int(255) default NULL,
  `unit_time` varchar(50) default NULL,
  `obj_name` varchar(100) default NULL,
  `pic` varchar(255) default NULL,
  `ad_pic` varchar(100) default NULL,
  `area_range` varchar(100) default NULL,
  `key_word` varchar(50) default NULL,
  `submit_method` int(11) default NULL,
  `file_path` varchar(255) default NULL,
  `content` text,
  `on_time` int(11) default NULL,
  `is_stop` int(11) default '0',
  `sale_num` int(11) default NULL,
  `views` int(11) default NULL,
  `refresh_time` int(11) default NULL,
  PRIMARY KEY  (`service_id`),
  KEY `service_id` (`service_id`),
  KEY `shop_id` (`shop_id`),
  KEY `uid` (`uid`),
  KEY `indus_id` (`indus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_service
-- ----------------------------
INSERT INTO keke_witkey_service VALUES ('41', '1', '13', '41', 'justing', '-1', '|||-1||-1|', '22', '企业网站建设及SEO', '1500.00', '次', '20', '小时', '', 'data/uploads/2010/11/17/77694ce39dd40a938.jpg', null, '', '', '1', '', '<div class=\"pic\"><a target=\"_blank\" href=\"http://www\"><img src=\"http://www.fwbao.com/data/images/2010/2010-08-14/120339_778632_small.jpg\" alt=\"\" /></a></div><h3><a target=\"_blank\" href=\"http:4\">企业网站建设及SEO</a></h3>', '1289985603', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('43', '2', '13', '41', 'justing', '110', '|0||99||110|', '22', '数据库设计', '1200.00', '个', '0', '小时', '', 'data/uploads/2010/11/17/303664ce39ea2954b2.jpg', null, '', '', '1', '', '111<br />', '1289985698', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('42', '1', '13', '41', 'justing', '-1', '|||-1||-1|', '22', '专业承接SEO业务', '200.00', '次', '1', '小时', '', 'data/uploads/2010/11/17/327404ce39e0c73081.jpg', null, '重庆,涪陵', '', '1', '', '<h3><a target=\"_blank\" href=\"http://\">专业承接SEO业务</a></h3>', '1289985581', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('44', '1', '16', '42', 'sky', '-1', '|||-1||-1|', '24', '克罗瑞斯婚礼 深圳化妆师', '1800.00', '个', '1', '天', '所有', 'data/uploads/2010/11/17/148784ce39ebd977e4.jpg', 'data/uploads/2010/11/17/136654ce3ab7632db3.jpg', '山西,运城', '罗瑞斯婚礼', '1', '', '克罗瑞斯婚礼 深圳化妆师、新娘化妆、新娘跟妆、主持人化妆、香港新娘化妆、澳门新娘化妆、年会晚会化妆、演出化妆、舞台演出化妆、模特走秀化妆、模特T台妆、平面广告妆、电影电视剧化妆、造型主持人化妆、party化妆、白领丽人日常妆、时尚生活化妆造型、面试化妆妆造型、礼仪展会化妆、彩绘、晚宴妆、新年晚会妆、等各类大、小型活动演出彩妆造型活动。<br /><br />我们的简介OUR profile<br />克罗瑞斯婚礼（www.luodijun.com）化妆项目团队，提供专业化并长期为新娘免费试妆服务，您满意再下定，并提供香港、澳门及广东其它地区新娘化妆服务。拥有6名资深高级化妆师，数十名专业级化妆师，强大的化妆队伍，为您的宴会，展会打造个性专属风格彩妆造型，为您提供全方位立方体的化妆服务。克罗瑞斯资深高级化妆师可上门化妆为深圳美丽新娘妆面，无论你需要古典、浪漫、戏剧、自然型、前卫、优雅等，在这里“克罗瑞斯”你总找得到你合适的。<br /><br />合作联盟Fecoagro<br />克罗瑞斯长期常年招聘乐队，舞蹈，模特团队，魔术，杂技，相声，小品，小丑，萨克斯，提琴,模仿秀等优秀演员及相关礼仪服务人员。', '1289988986', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('45', '1', '16', '42', 'sky', '-1', '|||-1||-1|', '24', '留住你最美的一刻', '2000.00', '个', '10', '小时', '所有人', 'data/uploads/2010/11/17/175084ce3a0049797a.jpg', 'data/uploads/2010/11/17/218314ce3abd117625.jpg', '四川,宜宾', '克罗瑞斯婚礼', '1', '', '克罗瑞斯婚礼 深圳婚礼摄像摄影 留住你最美的一刻<br /><br />深圳婚礼摄像摄影、婚礼电子相册、DVD婚前相识MV、展览会拍摄-克罗瑞斯婚礼克罗瑞斯婚礼（www.luodijun.com）提供专业化的婚礼拍摄、婚礼电子相册DVD（ＤＶＤ电子像册涵盖4首音乐，可任选）婚礼顾问、婚礼督导、展览会拍摄、婚前相识MV、会议拍摄、融合每对新人的个性与需求，克罗瑞斯的摄影师们为您定格最美丽的瞬见，扑捉最动人的细节，演绎最时尚的个性化主题婚礼。<br /><br />克罗瑞斯集平面创意设计及策划为一体策划机构，克罗瑞斯婚礼为客户提供更加专业，更加精准，更加高效，更加优质的全方位立体的策划服务，与克罗瑞斯一起，竭诚为您打造完美婚礼！圆您一个浪漫的梦，为您创造完美婚礼！<br /><br />欲了解详情请登陆深圳婚庆网http://www.luodijun.com。', '1289989214', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('46', '1', '12', '1', 'admin', '112', '|0||99||112|', '0', '广告制作', '80.00', '', '5', '天', '', null, 'data/uploads/2010/11/17/237334ce3a00a94adf.jpg', '四川,汶川', '', '1', '', '大连百纳传媒影视制作有限公司，专业企业宣传片制作、电视购物片制作、电视广告片制作、产品创意视频制作。联系qq:35813490 电话：0411-83729618', '1289986085', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('51', '1', '16', '42', 'sky', '-1', '|||-1||-1|', '24', '克罗瑞斯婚礼-婚车出租', '100.00', '个', '7', '天', '所有', 'data/uploads/2010/11/17/216064ce3a18874931.jpg', 'data/uploads/2010/11/17/85644ce3abdf3234a.gif', '陕西,咸阳', '婚车出租', '1', '', '克罗瑞斯婚礼 深圳花车租赁 婚车出租 布置 装饰 商务用车 <br /><br />我们的服务项目<br />克罗瑞斯婚礼（www.luodijun.com）婚车租赁项目部长期提供专业化婚车租赁服务，并提供广东省内其它地区婚车租赁服务。拥有强大的奔驰车队及相关车队豪华司机阵容。通过电话或邮箱等形式可以和我们进行预约看车或婚车租赁服务。<br /><br />克罗瑞斯轿车类：<br />加长林肯(2005年)9.6米、<br />加长劳斯莱斯幻影2000、<br />加长凯迪拉克（99年）7.6米、<br />敞蓬宝马C330（红色）、<br />奔驰S600(新款)2003~06年、<br />奔驰S600（特价）老款、<br />奔驰S500(特价)老款、<br />宝马740或730、宝马528、<br />奥迪A6(2.4)、<br />别克君威2.5、<br />广本雅阁、帕萨特2.0、帕萨特1.8T）；<br /><br />克罗瑞斯商务类用车：<br />别克GL8（7~9座）、<br />广本奥德赛、<br />现代瑞风（7~11座）、<br />丰田考斯特中巴22+7）。<br /><br />欲了解详情请登陆深圳婚庆网http://www.luodijun.com。<br /><br />克罗瑞斯婚礼策划工作室<br />Contact Info | 联系信息<br />Name | 联系人：david（戴维）<br />Mobilephone | 联系电话：1-5-9-2-0-0-5-1-8-8-1<br />QQ：7-8-6-2-1-1-1-6-1<br />MSN：cloris_2008@live.cn<br />Skype：cloris_2008@126.com<br />E-mail：cloris_2008@126.com<br />Address | 地址：Room 1815,18/F，Block B,Imperial palace ,No2017,Baoan S,Road,Luo Hu,Shenzhen,P.R.C Postcode：518001', '1289989091', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('48', '1', '12', '1', 'admin', '116', '|0||100||116|', '0', '动画制作', '500.00', '', '0', '天', '', 'data/uploads/2010/11/17/104264ce3a0ffd4dd6.jpg', 'data/uploads/2010/11/17/301814ce3a0e55b748.jpg', '上海,松江', '', '1', '', '大连百纳影视制作公司，专业影视后期制作。价格优惠，服务到位。QQ：35813490 电话：0411-83729618', '1289986303', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('49', '1', '17', '43', 'jank', '100', '|0||100|||', '0', '武汉三新书页有限公司logo征集', '43.00', '张', '1', '天', '', 'data/uploads/2010/11/17/53134ce3a1302bee0.jpg', null, '湖北,武汉', '', '1', '', '哈哈', '1289986352', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('50', '1', '12', '1', 'admin', '110', '|0||99||110|', '28', '动画制作', '1000.00', '', '1', '个月', '', 'data/uploads/2010/11/17/131634ce3a15493f18.jpg', 'data/uploads/2010/11/17/103604ce3a141ae983.jpg', '四川,自贡', '', '1', '', '大连百纳影视制作公司，专业影视后期制作。价格优惠，服务到位。QQ：35813490 电话：0411-83729618', '1289986388', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('40', '1', '14', '38', 'jesomo', '-1', '|||-1||-1|', '20', 'Macau', '200.00', '张', '2', '小时', '', 'data/uploads/2010/11/17/248124ce39a8aebf01.gif', null, '山东,蓬莱', '', '1', '', '<p>每位获奖者都有额外礼品相送~</p>', '1289984760', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('52', '1', '12', '1', 'admin', '-1', '|||-1||-1|', '29', '电视广告片制作', '10000.00', '', '15', '天', '', 'data/uploads/2010/11/17/251964ce3ae13ddce0.jpg', 'data/uploads/2010/11/17/34264ce3ade0c75ab.jpg', '山西,运城', '', '1', '', '大连百纳影视制作公司，专业影视后期制作。价格优惠，服务到位。QQ：35813490 电话：0411-83729618', '1289989651', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('53', '1', '12', '1', 'admin', '100', '|0||100|||', '32', 'FLASH动画制作', '111.00', '', '15', '天', '', 'data/uploads/2010/11/17/31674ce3a323e9702.jpg', 'data/uploads/2010/11/17/156144ce3a30a772e3.jpg', '四川,自贡', '', '1', '', '大连百纳传媒有限公司，创意精华，真诚服务。电话0411-83729618<br />QQ:35813490', '1289986851', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('54', '1', '16', '42', 'sky', '-1', '|||-1||-1|', '33', '三亚户外婚纱摄影', '100.00', '天', '10', '小时', '所有', 'data/uploads/2010/11/17/262844ce3a345dab85.jpg', 'data/uploads/2010/11/17/180774ce3abece59b2.jpg', '辽宁,铁岭', '婚纱摄影', '1', '', '三亚蓝天爱白云婚纱摄影工作室<br />5299元/套 创意主題拍摄<br />【外景拍摄】提供专业摄影师、化妆师VIP-1vs1服务一天<br />……………提供1500万象素（实际输出）专业设备拍摄 <br />【照片赠送】精心拍摄150张，全部精修处理。赠送本组DVD光盘1张<br />………………还可免费获得由摄影师精心后期处理的照片 <br />【拍摄地点】三亚湾椰梦长廊/环海礁石群/大东海/小东海任选3处<br />【化妆造型】提供新娘亮丽彩妆及整体造型一对一服务造型设计（全程跟妆）<br />【服 装】提供婚纱礼服4套，便装2套<br />.. ........热带风情特色服装或自带情侣装创意主题（共6套）<br />........男士服装随新娘搭配<br />【赠品】赠送18寸一体成型冰花琉璃册一本，入册25张<br />...........赠送15寸一体成型冰花琉璃册一本，入册22张<br />...........赠送40寸数码海报一张<br />...........赠送16寸拉米那版画一幅<br />...........赠送10寸亮丽水晶一幅<br />...........赠送DV花絮拍摄<br />【服务事项】当天拍摄免费赠送假睫毛一副和安瓶两支<br />………………拍摄当天车费、停车费、门票和午餐由本工作室提供不需自理<br />【 备注 】取件时间需30天左右，邮寄费用自理<br />预约流程：<br />&lt;1&gt;您可通过QQ,msn，电话的方式了解套餐内容，我们的客服将为您一一解答<br />&lt;2&gt;已订客户如因个人原因而无法按期拍摄，可转让订单名额或择日再拍（择日再拍需提前一星期告知），不返还预约金！敬请谅解！<br />&lt;3&gt;预定档期需提前15天，预约定金为拍摄款的20%，余款在拍摄当日付清！<br />&lt;4&gt;为方便客户，我们团队提供上门化妆拍摄服务。（亚龙湾酒店客人）<br />&lt;5&gt;拍照时请按预定时间准时到达，如因天气原因导致无法拍摄，本工作室都尽量安排客人在三亚的时间内拍摄。<br />&lt;6&gt;蓝天爱白云摄影机构郑重承诺：蓝天爱白云是以技术为主打的精英团队，如拍摄不满意，可全额退款！！！<br />三亚蓝天爱白云婚纱摄影工作室联系方式<br /><br />联系方式：<br />客服MSN：ltaby2009@yahoo.cn<br />客服QQ：30653047 871360437 <br />传真电话：0898-88271418 <br />24小时咨询电话：13976987600 13876777319<br />网站地址：http://www.syltaby.com', '1289989103', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('55', '2', '16', '42', 'sky', '-1', '|||-1||-1|', '35', '写真后期设计', '2.00', 'p', '1', '小时', '所有', 'data/uploads/2010/11/17/272014ce3a4535c51c.jpg', 'data/uploads/2010/11/17/59064ce3abfdbb883.jpg', '江苏,镇江', '个性写真', '1', '', '<p>专业的婚纱摄影处理，图片写真处理。</p>', '1289989120', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('56', '1', '12', '1', 'admin', '-1', '|||-1||-1|', '36', '3D动画制作', '3000.00', '', '10', '天', '', 'data/uploads/2010/11/17/315694ce3a48acee36.jpg', 'data/uploads/2010/11/17/121854ce3adb19d267.gif', '山东,枣庄', '', '1', '', '大连百纳传媒有限公司，专业影视制作，动画制作，游戏开发的综合影视公司。', '1289989560', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('57', '1', '12', '1', 'admin', '-1', '|||-1||-1|', '37', '制作影视广告', '120.00', '', '1', '个月', '', 'data/uploads/2010/11/17/245024ce3a4fc0493f.jpg', 'data/uploads/2010/11/17/114434ce3ad63ab94a.jpg', '', '', '1', '', '大连百纳传媒有限公司，专业影视制作，产品广告制作，动画制作，游戏开发的影视综合公司。', '1289989477', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('58', '1', '20', '46', '123456', '110', '|0||99||110|', '41', 'heihei', '100.00', '', '0', '小时', '', null, null, '', '', '1', '', '', '1289989772', '0', null, null, null);
INSERT INTO keke_witkey_service VALUES ('59', '1', '19', '45', '123123', '114', '|99||114|||', '0', '武汉网路集团', '12.00', '单位', '500', '小时', '', 'data/uploads/2010/11/17/199944ce3ae97a025b.jpg', null, '福建,莆田', '', '1', '', '武汉网路集团<br />', '1289989783', '0', null, null, null);

-- ----------------------------
-- Table structure for `keke_witkey_service_order`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_service_order`;
CREATE TABLE `keke_witkey_service_order` (
  `order_id` int(11) NOT NULL auto_increment,
  `shop_id` int(11) NOT NULL,
  `sale_uid` int(11) default NULL,
  `sale_username` varchar(20) default NULL,
  `service_id` int(11) default NULL,
  `service_type` int(11) default NULL,
  `on_time` int(11) default NULL,
  `count_cash` float default NULL,
  `pay_cash` float default NULL,
  `clr_cash` float default NULL,
  `title` varchar(50) default NULL,
  `sale_status` int(11) default NULL,
  `buyer_status` varchar(20) default NULL,
  `order_status` int(11) default NULL,
  `buy_username` varchar(20) default NULL,
  `buy_uid` int(11) default NULL,
  `cost_cash` float(10,2) default NULL,
  `cost_credit` float(10,2) default NULL,
  PRIMARY KEY  (`order_id`),
  KEY `order_id` (`order_id`),
  KEY `shop_id` (`shop_id`),
  KEY `sale_uid` (`sale_uid`),
  KEY `order_status` (`order_status`),
  KEY `buy_uid` (`buy_uid`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_service_order
-- ----------------------------
INSERT INTO keke_witkey_service_order VALUES ('33', '16', '42', 'sky', '51', '1', '1289986629', '100', null, null, '克罗瑞斯婚礼-婚车出租', '0', '1', '0', 'admin', '1', null, null);

-- ----------------------------
-- Table structure for `keke_witkey_service_order_detail`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_service_order_detail`;
CREATE TABLE `keke_witkey_service_order_detail` (
  `detail_id` int(11) NOT NULL auto_increment,
  `order_id` int(11) default NULL,
  `step_num` int(11) default NULL,
  `step_cash` float(10,2) default NULL,
  `step_detail` varchar(200) default NULL,
  `step_status` int(11) default NULL,
  PRIMARY KEY  (`detail_id`),
  KEY `detail_id` (`detail_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_service_order_detail
-- ----------------------------
INSERT INTO keke_witkey_service_order_detail VALUES ('41', '33', '1', '100.00', '买啦买啦', '0');

-- ----------------------------
-- Table structure for `keke_witkey_shop`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_shop`;
CREATE TABLE `keke_witkey_shop` (
  `shop_id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `username` varchar(20) default NULL,
  `indus_id` int(11) default NULL,
  `shop_name` varchar(100) default NULL,
  `city` varchar(50) default NULL,
  `service_range` varchar(50) default NULL,
  `aboutus` text,
  `linkman` varchar(20) default NULL,
  `job` varchar(50) default NULL,
  `tel` varchar(20) default NULL,
  `fax` varchar(20) default NULL,
  `moblie` varchar(20) default NULL,
  `email` varchar(50) default NULL,
  `work_year` int(11) default '0',
  `address` varchar(100) default NULL,
  `shop_type` int(2) default '1',
  `on_time` int(11) default NULL,
  `is_close` int(11) default '0',
  `views` int(11) default '0',
  PRIMARY KEY  (`shop_id`),
  KEY `index_1` (`shop_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop
-- ----------------------------
INSERT INTO keke_witkey_shop VALUES ('12', '1', 'admin', '99', '武汉客客技术', '湖北,武汉', '111', '客客信息技术有限公司...', null, null, null, null, null, null, '1', null, '2', '1289983696', '0', '5');
INSERT INTO keke_witkey_shop VALUES ('13', '41', 'justing', '99', '神马都是浮云', '重庆,渝中', null, '<ul><li class=\"intro\">实施了企业协同办公平台(OA)，解决并规范公司内部公文流转、信息的发布与共享、文档管理，极大地提高了工作效率；公出了构建企业集中文档管理系统，实现文档的统一存储、管理、授权、统计，并最终推进业务、管理系统的文档应用整合及个性化展现；同时平台具有良好的扩展性、开放性、灵活性，高起点地建设统一消息、企业门户、综合管理平台架构框架，为公司未来的业务开展提供基础保障。</li></ul>', null, '工程师', null, null, null, null, '1', null, '1', '1289984377', '0', '2');
INSERT INTO keke_witkey_shop VALUES ('14', '38', 'jesomo', '0', '夏季女装', '澳门,澳门', '112', '澳门时尚设计有限公司是一家提供时尚尊贵婚礼策划与庆典服务的婚庆公司。我们致力打造新疆婚庆一条龙服务最好的婚庆公司！主要从事主题婚礼策划、婚礼场地布置、婚礼摄影、婚礼跟拍（摄影摄像）结婚跟妆、婚庆司仪等综合婚庆服务！', null, '', null, null, null, null, '0', null, '1', '1289984382', '0', '5');
INSERT INTO keke_witkey_shop VALUES ('15', '40', '李大爷', '0', '测试', '广东,惠州', null, null, null, null, null, null, null, null, '0', null, '2', '1289984399', '0', '1');
INSERT INTO keke_witkey_shop VALUES ('16', '42', 'sky', '0', '威客网上商城', '浙江,绍兴', null, null, null, '婚纱摄影', null, null, null, null, '3', null, '1', '1289984784', '0', '4');
INSERT INTO keke_witkey_shop VALUES ('17', '43', 'jank', '0', '武汉三星书页有限公司', '台湾,宜兰', null, null, null, '', null, null, null, null, '0', null, '1', '1289985943', '0', '1');
INSERT INTO keke_witkey_shop VALUES ('18', '44', 'mark', '114', '武汉金华广告', '上海,卢湾', null, null, null, null, null, null, null, null, '2', null, '2', '1289986255', '0', '0');
INSERT INTO keke_witkey_shop VALUES ('19', '45', '123123', '112', '中国网路文化发展集团', '湖南,衡阳', null, null, null, null, null, null, null, null, '2', null, '2', '1289989655', '0', '1');
INSERT INTO keke_witkey_shop VALUES ('20', '46', '123456', '0', 'heihei', '北京,东城', null, null, null, null, null, null, null, null, '0', null, '2', '1289989719', '0', '1');

-- ----------------------------
-- Table structure for `keke_witkey_shop_banner`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_shop_banner`;
CREATE TABLE `keke_witkey_shop_banner` (
  `banner_id` int(11) NOT NULL auto_increment,
  `banner_type` int(11) default NULL,
  `img_file` varchar(150) default NULL,
  `img_name` varchar(50) default NULL,
  `indus_id` int(11) default NULL,
  `list_order` int(11) default NULL,
  PRIMARY KEY  (`banner_id`),
  KEY `banner_id` (`banner_id`),
  KEY `indus_id` (`indus_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop_banner
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_shop_case`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_shop_case`;
CREATE TABLE `keke_witkey_shop_case` (
  `case_id` int(11) NOT NULL auto_increment,
  `cus_cate_id` int(11) default NULL,
  `shop_id` int(11) default NULL,
  `case_type` int(11) default NULL,
  `case_name` varchar(100) default NULL,
  `express` int(11) default NULL,
  `indus_id` int(11) default NULL,
  `content` text,
  `uid` int(11) default NULL,
  `username` varchar(20) default NULL,
  `pic` varchar(100) default NULL,
  `on_date` int(11) default NULL,
  PRIMARY KEY  (`case_id`),
  KEY `index_1` (`case_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop_case
-- ----------------------------
INSERT INTO keke_witkey_shop_case VALUES ('11', '0', '13', '1', '应用软件开发', '1289260800', '-1', '利用多IP、多线程开发了一套邮件群发系统，充分利用了系统资源，以WEB页面对邮件进行管理，可以以服务器的方式接收邮件投递', '41', 'justing', null, '1289984665');
INSERT INTO keke_witkey_shop_case VALUES ('12', '21', '13', '1', '河北省三和时代律师事务所办公自动化', '1289347200', '112', 'as<br />', '41', 'justing', 'data/uploads/2010/11/17/247964ce39ee68e8ef.jpg', '1289985766');
INSERT INTO keke_witkey_shop_case VALUES ('13', '38', '16', '1', '三亚外景婚纱摄影', '1267488000', '0', '三亚蓝天爱白云婚纱摄影工作室联系方式<br /><br />联系方式：<br />客服MSN：ltaby2009@yahoo.cn<br />客服QQ：30653047 871360437 <br />传真电话：08', '42', 'sky', 'data/uploads/2010/11/17/17974ce3a51f6f6b5.jpg', '1289987359');
INSERT INTO keke_witkey_shop_case VALUES ('14', '25', '12', '2', '大连百纳影视客户表', '0', '0', '<li class=\"title\">大连百纳影视客户表</li><li class=\"info dashed\"><span class=\"time\">执行时间：2008年1月</span><span class=\"edit\">发布于(2010-05-14 16:30)</span></li><li class=\"intro\">大连信息产业局大连IT教育联盟宣传片基地<br />韩国造船STX（大连）集团宣传片<br />北京安博教育集团大连安博教育专题片<br />韩国奥泰克产品系列广告教学片<br />大连名成广隆建设集团总公司专题片<br />大连长兴岛管委会建筑行业规范专题片<br />大连长兴岛产业园区招商样片<br />阜新矿山公园博物馆历史资料片<br />北京301部队医院产品宣传片<br />大连美罗集团专题片<br />大连明日之星电视大赛资料片<br />深圳博盈企业产品系列广告片<br />黑龙江鹤岗哈星（制药）集团系列广告片<br />台湾（上海）训米服务公司健身操教学系列片<br />大世界吉尼斯海上婚礼素材片<br />浙江绍兴博乐夜视镜有限公司产品系列广告<br />辽宁丹东泰宏食品有限公司产品系列广告<br />上海加福道市场营销策划有限公<br />（美国拜客皇家宠物食品系列广告片）<br />大连市劳模功绩资料片（进行中）<br />。。。。。。</li>', '1', 'admin', null, '1289987441');
INSERT INTO keke_witkey_shop_case VALUES ('15', '38', '16', '1', '三亚小城故事婚纱摄', '1257206400', '0', '海景婚纱摄影套系<br />小城故事海景婚纱摄影机构是一支以技术为主打的精英团队，<br /><br />全程由有着十多年专业婚纱拍摄经验的摄影大师主拍;', '42', 'sky', 'data/uploads/2010/11/17/252784ce3a5e950801.jpg', '1289987561');
INSERT INTO keke_witkey_shop_case VALUES ('16', '0', '12', '2', '车模秀', '0', '0', '翎秀公司是国家劳动局、国家工商局批准的专业模特机构(证号30106027、注册号：3101062012724)。专业从事各类时尚发布会，平面、电视广告拍摄，各类时尚秀场活动 <br />翎秀公司每年都会主办及协办各类模特大赛，并从无任何经验的报名选手中挖掘培养力推全国大赛，几年来培养出多名青年男女、少儿全国得奖精英。在同行业中名列前茅，得到政府部门领导好评', '1', 'admin', 'data/uploads/2010/11/17/130584ce3a61c51766.jpg', '1289987612');

-- ----------------------------
-- Table structure for `keke_witkey_shop_config`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_shop_config`;
CREATE TABLE IF NOT EXISTS `keke_witkey_shop_config` (
  `config_id` int(11) NOT NULL auto_increment,
  `service_prorate` float(8,2) default NULL,
  `down_prorate` float(8,2) default NULL,
  `service_min_amount` float(8,2) default NULL,
  `step_min_amount` float(8,2) default NULL,
  `on_date` int(11) default NULL,
  `shop_is_close` int(11) default NULL,
  PRIMARY KEY  (`config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- data `keke_witkey_shop_config`
--

INSERT INTO `keke_witkey_shop_config` (`config_id`, `service_prorate`, `down_prorate`, `service_min_amount`, `step_min_amount`, `on_date`, `shop_is_close`) VALUES
(1, 10.00, 10.00, 23.00, 12.00, NULL, 0);

-- ----------------------------
-- Table structure for `keke_witkey_shop_cus_cate`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_shop_cus_cate`;
CREATE TABLE `keke_witkey_shop_cus_cate` (
  `cus_cate_id` int(11) NOT NULL auto_increment,
  `obj_type` int(11) default NULL,
  `obj_id` int(11) default NULL,
  `cate_name` varchar(100) default NULL,
  `shop_id` int(11) default NULL,
  PRIMARY KEY  (`cus_cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop_cus_cate
-- ----------------------------
INSERT INTO keke_witkey_shop_cus_cate VALUES ('20', '2', null, '店面设计', '14');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('21', '1', null, '开发', '13');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('22', '2', null, '开发', '13');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('23', '1', null, '店面设计', '14');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('24', '2', null, '婚礼方案策划', '16');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('25', '1', null, '鞋子', '12');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('26', '2', null, '222', '12');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('27', '1', null, '33', '12');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('28', '2', null, '动画制作', '12');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('29', '2', null, '电视广告片制作', '12');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('30', '1', null, '6516', '12');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('31', '1', null, '21', '12');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('32', '2', null, 'FLASH动画制作', '12');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('33', '2', null, '婚纱摄影', '16');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('34', '2', null, '房地产策划', '12');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('35', '2', null, '个性写真', '16');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('36', '2', null, '3D动画制作', '12');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('37', '2', null, '制作影视广告', '12');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('38', '1', null, '婚纱摄影', '16');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('39', '1', null, '车模秀', '12');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('40', '1', null, '车模秀', '12');
INSERT INTO keke_witkey_shop_cus_cate VALUES ('41', '2', null, 'php', '20');

-- ----------------------------
-- Table structure for `keke_witkey_shop_member`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_shop_member`;
CREATE TABLE `keke_witkey_shop_member` (
  `shop_member_id` int(11) NOT NULL auto_increment,
  `shop_id` int(11) default NULL,
  `real_name` varchar(50) default NULL,
  `licen_pic` varchar(50) default NULL,
  `job` varchar(50) default NULL,
  `express` int(11) default NULL,
  `top_xl` varchar(50) default NULL,
  `school` varchar(50) default NULL,
  `aboutus` text,
  PRIMARY KEY  (`shop_member_id`),
  KEY `index_1` (`shop_member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop_member
-- ----------------------------
INSERT INTO keke_witkey_shop_member VALUES ('6', '12', '笑脸', 'data/uploads/2010/11/17/29134ce3a7de6f9d1.jpg', 'web工程师', '5', '初中', '笑脸一中', '........................................................');
INSERT INTO keke_witkey_shop_member VALUES ('7', '12', 'lelezhi', 'data/uploads/2010/11/17/57664ce3a829367fa.jpg', 'php工程师', '1', '', '', '...................');

-- ----------------------------
-- Table structure for `keke_witkey_shop_menu`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_shop_menu`;
CREATE TABLE `keke_witkey_shop_menu` (
  `menu_id` int(11) NOT NULL auto_increment,
  `shop_id` int(11) default NULL,
  `menu_type` int(11) default NULL,
  `menu_1` varchar(50) default NULL,
  `menu_2` varchar(50) default NULL,
  `menu_3` varchar(50) default NULL,
  `menu_4` varchar(50) default NULL,
  `menu_5` varchar(50) default NULL,
  `list_order` int(11) default NULL,
  `uid` int(11) default NULL,
  `username` varchar(20) default NULL,
  PRIMARY KEY  (`menu_id`),
  KEY `index_1` (`menu_id`),
  KEY `shop_id` (`shop_id`),
  KEY `uid` (`uid`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop_menu
-- ----------------------------
INSERT INTO keke_witkey_shop_menu VALUES ('16', '12', null, '关于我们', '团队成员', '服务报价', '作品案例', '联系我们', null, '1', 'admin');
INSERT INTO keke_witkey_shop_menu VALUES ('17', '13', null, '服务报价', '客户案例', '联系方式', null, null, null, '41', 'justing');
INSERT INTO keke_witkey_shop_menu VALUES ('18', '14', null, '服务报价', '客户案例', '联系方式', null, null, null, '38', 'jesomo');
INSERT INTO keke_witkey_shop_menu VALUES ('19', '15', null, '关于我们', '团队成员', '服务报价', '作品案例', '联系我们', null, '40', '李大爷');
INSERT INTO keke_witkey_shop_menu VALUES ('20', '16', null, '服务报价', '客户案例', '联系方式', null, null, null, '42', 'sky');
INSERT INTO keke_witkey_shop_menu VALUES ('21', '17', null, '服务报价', '客户案例', '联系方式', null, null, null, '43', 'jank');
INSERT INTO keke_witkey_shop_menu VALUES ('22', '18', null, '关于我们', '团队成员', '服务报价', '作品案例', '联系我们', null, '44', 'mark');
INSERT INTO keke_witkey_shop_menu VALUES ('23', '19', null, '关于我们', '团队成员', '服务报价', '作品案例', '联系我们', null, '45', '123123');
INSERT INTO keke_witkey_shop_menu VALUES ('24', '20', null, '关于我们', '团队成员', '服务报价', '作品案例', '联系我们', null, '46', '123456');

-- ----------------------------
-- Table structure for `keke_witkey_shop_tpl_econfig`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_shop_tpl_econfig`;
CREATE TABLE `keke_witkey_shop_tpl_econfig` (
  `econfig_id` int(11) NOT NULL auto_increment,
  `tpl_direction` int(11) default NULL,
  `shop_logo` varchar(50) default NULL,
  `ad_text` varchar(50) default NULL,
  `banner_img` varchar(500) default NULL,
  `banner_id` int(11) default NULL,
  `skin_color` char(10) default NULL,
  `background` char(10) default NULL,
  `ac_menu_color` char(10) default NULL,
  `font_color` char(10) default NULL,
  `shop_id` int(11) default NULL,
  `uid` int(11) default NULL,
  `on_time` int(11) default NULL,
  PRIMARY KEY  (`econfig_id`),
  KEY `index_id` (`econfig_id`),
  KEY `banner_id` (`banner_id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop_tpl_econfig
-- ----------------------------
INSERT INTO keke_witkey_shop_tpl_econfig VALUES ('8', '1', 'data/uploads/2010/11/17/185674ce3b073bc95a.gif', '武汉客客信息技术企业店铺简介开源KPPW威客系统', 'data/uploads/2010/11/17/211524ce39d858e030.jpg', '0', '1', '#FFFFFF', '', '', '12', '1', null);
INSERT INTO keke_witkey_shop_tpl_econfig VALUES ('9', '2', 'data/uploads/2010/11/17/54804ce3ab0276ac9.gif', null, null, null, null, null, null, null, '15', '40', null);
INSERT INTO keke_witkey_shop_tpl_econfig VALUES ('10', '1', null, null, null, null, null, null, null, null, '18', '44', null);
INSERT INTO keke_witkey_shop_tpl_econfig VALUES ('11', '1', 'data/uploads/2010/11/17/161154ce3af2051c22.gif', null, null, null, null, null, null, null, '19', '45', null);
INSERT INTO keke_witkey_shop_tpl_econfig VALUES ('12', '1', 'data/uploads/2010/11/17/246864ce3afdfca700.jpg', null, null, null, null, null, null, null, '20', '46', null);

-- ----------------------------
-- Table structure for `keke_witkey_shop_tpl_pconfig`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_shop_tpl_pconfig`;
CREATE TABLE `keke_witkey_shop_tpl_pconfig` (
  `pconfig_id` int(11) NOT NULL auto_increment,
  `ad_text` varchar(50) default NULL,
  `banner_img` varchar(500) default NULL,
  `banner_id` int(11) default NULL,
  `background` char(10) default NULL,
  `font_color` char(10) default NULL,
  `uid` int(11) default NULL,
  `shop_id` int(11) default NULL,
  `on_time` int(11) default NULL,
  PRIMARY KEY  (`pconfig_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop_tpl_pconfig
-- ----------------------------
INSERT INTO keke_witkey_shop_tpl_pconfig VALUES ('9', '中华有神功', 'data/uploads/2010/11/17/230884ce39d5c08c03.jpg', '0', null, null, '41', '13', null);
INSERT INTO keke_witkey_shop_tpl_pconfig VALUES ('10', '我的地盘我做主', 'data/uploads/2010/11/17/41804ce3a50ae9dc8.jpg', '0', '#2181FF', '#75B6FF', '38', '14', null);
INSERT INTO keke_witkey_shop_tpl_pconfig VALUES ('11', null, null, null, null, null, '42', '16', null);
INSERT INTO keke_witkey_shop_tpl_pconfig VALUES ('12', null, null, null, null, null, '43', '17', null);

-- ----------------------------
-- Table structure for `keke_witkey_sign`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_sign`;
CREATE TABLE `keke_witkey_sign` (
  `sign_id` int(11) NOT NULL auto_increment,
  `task_id` int(11) default '0',
  `uid` int(11) default '0',
  `username` char(50) default NULL,
  `bid_status` int(50) default '0',
  `bid_time` int(11) default '0',
  PRIMARY KEY  (`sign_id`),
  KEY `sign_id` (`sign_id`),
  KEY `task_id` (`task_id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_sign
-- ----------------------------
INSERT INTO keke_witkey_sign VALUES ('14', '111', '38', 'jesomo', '0', '1289983355');
INSERT INTO keke_witkey_sign VALUES ('15', '103', '38', 'jesomo', '0', '1289983495');
INSERT INTO keke_witkey_sign VALUES ('16', '95', '38', 'jesomo', '0', '1289983512');
INSERT INTO keke_witkey_sign VALUES ('17', '117', '39', '王大毛', '0', '1289983555');
INSERT INTO keke_witkey_sign VALUES ('18', '104', '38', 'jesomo', '0', '1289983765');
INSERT INTO keke_witkey_sign VALUES ('19', '123', '40', '李大爷', '0', '1289983885');

-- ----------------------------
-- Table structure for `keke_witkey_skill`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_skill`;
CREATE TABLE `keke_witkey_skill` (
  `skill_id` int(11) NOT NULL auto_increment,
  `indus_id` int(11) default '0',
  `skill_name` varchar(50) default NULL,
  `listorder` int(11) default '0',
  `on_time` int(11) default '0',
  PRIMARY KEY  (`skill_id`),
  KEY `skill_id` (`skill_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_skill
-- ----------------------------
INSERT INTO keke_witkey_skill VALUES ('1', '2', 'PHP网站开发', '5', '1284493055');
INSERT INTO keke_witkey_skill VALUES ('2', '2', 'JSP网站开发', '8', '1284082299');
INSERT INTO keke_witkey_skill VALUES ('3', '2', 'ASP网站开发', '1', '1282039019');
INSERT INTO keke_witkey_skill VALUES ('4', '2', 'CSS+DIV', '1', '1282123784');
INSERT INTO keke_witkey_skill VALUES ('5', '2', '界面设计', '0', '1282123759');
INSERT INTO keke_witkey_skill VALUES ('6', '1', '食品包装', '0', '1282123806');
INSERT INTO keke_witkey_skill VALUES ('7', '1', '平面设计', '9', '1284082336');

-- ----------------------------
-- Table structure for `keke_witkey_space`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_space`;
CREATE TABLE `keke_witkey_space` (
  `uid` int(11) NOT NULL auto_increment,
  `username` varchar(50) default NULL,
  `password` varchar(50) default NULL,
  `email` varchar(50) default NULL,
  `user_pic` varchar(100) default NULL,
  `group_id` int(11) default '0',
  `isvip` int(11) default '0',
  `status` int(11) default '0',
  `user_type` varchar(50) default NULL,
  `sex` char(10) default NULL,
  `marry` char(10) default NULL,
  `hometown` char(10) default NULL,
  `residency` char(10) default NULL,
  `address` varchar(200) default NULL,
  `birthday` char(10) default NULL,
  `truename` char(20) default NULL,
  `idcard` varchar(20) default NULL,
  `idpic` varchar(100) default NULL,
  `qq` varchar(20) default NULL,
  `msn` varchar(50) default NULL,
  `fax` varchar(20) default NULL,
  `phone` varchar(20) default NULL,
  `mobile` varchar(20) default NULL,
  `indus_id` int(11) default '0',
  `skill_ids` varchar(100) default NULL,
  `summary` text,
  `experience` text,
  `reg_time` int(11) default '0',
  `reg_ip` varchar(20) default NULL,
  `domain` varchar(50) default NULL,
  `credit` float(11,2) default '0.00',
  `balance` float(11,2) default '0.00',
  `balance_status` int(11) default '0',
  `is_auth` char(10) default NULL,
  `auth_name` varchar(50) default NULL,
  `auth_time` int(11) default '0',
  `pub_num` int(11) default '0',
  `take_num` int(11) default '0',
  `nominate_num` int(11) default '0',
  `accepted_num` int(11) default '0',
  `vip_start_time` int(11) default '0',
  `vip_end_time` int(11) default '0',
  `pay_zfb` varchar(100) default NULL,
  `pay_cft` varchar(100) default NULL,
  `pay_bank` text,
  `experience_value` int(11) default '0',
  `g_m_credit_value` int(11) default '0',
  `w_m_credit_value` int(11) default '0',
  `seller_good_rate` float default NULL,
  `buyer_good_rate` float default NULL,
  `studio_id` int(11) default NULL,
  `realname_auth` int(11) default NULL,
  `mobile_auth` int(11) default NULL,
  `enterprise_auth` int(11) default NULL,
  `email_auth` int(11) default NULL,
  `bank_auth` int(11) default NULL,
  `last_login_time` int(11) default NULL,
  `kf_uid` int(11) default NULL,
  PRIMARY KEY  (`uid`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`),
  KEY `isvip` (`isvip`),
  KEY `indus_id` (`indus_id`),
  KEY `studio_id` (`studio_id`),
  KEY `last_login_time` (`last_login_time`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_space
-- ----------------------------
INSERT INTO keke_witkey_space VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', null, '2', '1', '1', null, '男', null, null, '山东,滨州', '中国武汉', '1285804800', '55555', null, null, '23423434', '666666@hotmail.com', '666666666', '666666', '13166666666', '11', '5,6,0', '很杀很杀', '很杀很杀', '1283755726', null, null, '0.00', '1675.50', '0', null, null, '0', '82', '0', '0', '0', '0', '1314321457', 'sdf@das.zxc', '', '所属银行:\r\n银行帐号:\r\n开户人姓名:', '813', '50', '0', '100', null, '5', '1', null, null, null, null, '1289991632', null);
INSERT INTO keke_witkey_space VALUES ('36', 'lelezhi', '3882bfe63d81ccd41cc2f3a219101c5e', '', null, '0', '0', '1', null, null, null, null, null, null, null, null, null, null, '', '', null, '', null, '9', null, null, null, '1289981076', '192.168.1.66', null, '62981.00', '100000.00', '0', null, null, '0', '19', '0', '0', '0', '0', '0', null, null, null, '168', '0', '0', null, null, null, null, null, null, null, null, '1289982762', null);
INSERT INTO keke_witkey_space VALUES ('37', 'jianghu', 'e10adc3949ba59abbe56e057f20f883e', '789458721@qq.com', null, '0', '0', '1', null, null, null, null, null, null, null, null, null, null, '', '', null, '', null, '0', null, null, null, '1289981906', null, null, '99500.00', '100000.00', '0', null, null, '0', '20', '0', '0', '0', '0', '0', null, null, null, '80102', '0', '0', null, null, null, null, null, null, null, null, '1289983247', null);
INSERT INTO keke_witkey_space VALUES ('38', 'jesomo', 'e10adc3949ba59abbe56e057f20f883e', '123@123.com', null, '0', '0', '0', null, null, null, null, null, '澳门无情街23号', null, null, null, null, null, '', '6895489', '012-8695456', '', '0', null, null, null, '1289983327', '192.168.1.13', null, '0.00', '0.00', '0', null, null, '0', '0', '5', '0', '0', '0', '0', null, null, null, '53', '0', '0', null, null, null, null, null, null, null, null, '1289988176', null);
INSERT INTO keke_witkey_space VALUES ('39', '王大毛', 'e10adc3949ba59abbe56e057f20f883e', 'wangdamao@dsaasdx.zcx', null, '0', '0', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '8', null, null, null, '1289983509', '192.168.1.77', null, '0.00', '0.00', '0', null, null, '0', '0', '1', '0', '0', '0', '0', null, null, null, '13', '0', '0', null, null, null, null, null, null, null, null, null, null);
INSERT INTO keke_witkey_space VALUES ('40', '李大爷', 'e10adc3949ba59abbe56e057f20f883e', 'adsfdsf@sads.asd', null, '0', '0', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '11', null, null, null, '1289983738', '192.168.1.77', null, '0.00', '0.00', '0', null, null, '0', '0', '1', '0', '0', '0', '0', null, null, null, '52', '0', '0', null, null, null, null, null, null, null, null, null, null);
INSERT INTO keke_witkey_space VALUES ('41', 'justing', 'e10adc3949ba59abbe56e057f20f883e', '1234@qq.com', null, '0', '0', '0', null, null, null, null, null, '', null, null, null, null, null, 'jaick@msn.com', '', '027-87733922', '13237113542', '28', null, null, null, '1289984064', '192.168.1.69', null, '0.00', '0.00', '0', null, null, '0', '0', '0', '0', '0', '0', '0', null, null, null, '28', '0', '0', null, null, null, null, null, null, null, null, null, null);
INSERT INTO keke_witkey_space VALUES ('42', 'sky', 'e10adc3949ba59abbe56e057f20f883e', 'hj6862@yeah.net', null, '0', '0', '1', null, '男', null, null, '湖北,仙桃', '浙江-绍兴-街道口22号', '557539200', '', null, null, '756450010', 'bluesky@live.com', '027-1234567', '027-1234567', '15527069211', '47', null, '用心，专业婚礼活动策划。', '专业从事婚礼活动策划，婚纱摄影!', '1289984459', '192.168.1.88', null, '200000.00', '100000.00', '0', null, null, '0', '0', '0', '0', '0', '0', '0', 'hj6862@yeah.net', 'hj6862@yeah.net', '所属银行:\r\n银行帐号:\r\n开户人姓名:', '18023', '0', '0', null, null, null, null, null, null, null, null, '1289989921', null);
INSERT INTO keke_witkey_space VALUES ('43', 'jank', 'e10adc3949ba59abbe56e057f20f883e', '123456@1qq.com', null, '0', '0', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', null, null, null, '1289985898', '192.168.1.13', null, '0.00', '0.00', '0', null, null, '0', '0', '0', '0', '0', '0', '0', null, null, null, '47', '0', '0', null, null, null, null, null, null, null, null, null, null);
INSERT INTO keke_witkey_space VALUES ('44', 'mark', 'e10adc3949ba59abbe56e057f20f883e', 'mark@11.com', null, '0', '0', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '8', null, null, null, '1289986116', '192.168.1.69', null, '0.00', '0.00', '0', null, null, '0', '0', '0', '0', '0', '0', '0', null, null, null, '48', '0', '0', null, null, null, null, null, null, null, null, null, null);
INSERT INTO keke_witkey_space VALUES ('45', '123123', 'e10adc3949ba59abbe56e057f20f883e', '1@1.com', null, '0', '0', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', null, null, null, '1289989603', '192.168.1.13', null, '0.00', '0.00', '0', null, null, '0', '0', '0', '0', '0', '0', '0', null, null, null, '28', '0', '0', null, null, null, null, null, null, null, null, null, null);
INSERT INTO keke_witkey_space VALUES ('46', '123456', 'e10adc3949ba59abbe56e057f20f883e', '123456@qq.com', null, '0', '0', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', null, null, null, '1289989674', '192.168.1.66', null, '0.00', '0.00', '0', null, null, '0', '0', '0', '0', '0', '0', '0', null, null, null, '28', '0', '0', null, null, null, null, null, null, null, null, null, null);
INSERT INTO keke_witkey_space VALUES ('35', 'bluesky', 'e10adc3949ba59abbe56e057f20f883e', '756450010@qq.com', null, '0', '0', '1', null, null, null, null, null, null, null, null, null, null, '', '', null, '', null, '0', null, null, null, '1289981070', '192.168.1.88', null, '99400.00', '100000.00', '0', null, null, '0', '25', '0', '0', '0', '0', '0', null, null, null, '138', '0', '0', null, null, null, null, null, null, null, null, '1289989830', null);

-- ----------------------------
-- Table structure for `keke_witkey_studio`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_studio`;
CREATE TABLE `keke_witkey_studio` (
  `studio_id` int(11) NOT NULL auto_increment,
  `title` varchar(100) default NULL,
  `aboutus` text,
  `logo` varchar(150) default NULL,
  `members` int(11) default NULL,
  `banner_pic` varchar(150) default NULL,
  `uid` int(11) default NULL,
  `address` varchar(255) default NULL,
  `postcode` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `phone` varchar(255) default NULL,
  `fax` varchar(255) default NULL,
  `area` varchar(255) default NULL,
  `username` varchar(20) default NULL,
  `studio_status` int(11) default NULL,
  `on_date` int(11) default NULL,
  PRIMARY KEY  (`studio_id`),
  KEY `index_1` (`studio_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_studio
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_studio_apply`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_studio_apply`;
CREATE TABLE `keke_witkey_studio_apply` (
  `apply_id` int(11) NOT NULL auto_increment,
  `studio_id` int(11) default NULL,
  `uid` int(11) default NULL,
  `username` varchar(20) default NULL,
  `content` text,
  `apply_type` int(11) default NULL,
  `on_date` int(11) default NULL,
  `apply_status` int(11) default NULL,
  PRIMARY KEY  (`apply_id`),
  KEY `index_1` (`apply_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_studio_apply
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_studio_member`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_studio_member`;
CREATE TABLE `keke_witkey_studio_member` (
  `w_uid` int(11) NOT NULL auto_increment,
  `studio_id` int(11) default NULL,
  `uid` int(11) default NULL,
  `username` varchar(20) default NULL,
  `on_date` int(11) default NULL,
  PRIMARY KEY  (`w_uid`),
  KEY `index_1` (`w_uid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_studio_member
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_system_log`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_system_log`;
CREATE TABLE `keke_witkey_system_log` (
  `log_id` int(11) NOT NULL auto_increment,
  `log_type` int(11) default '0',
  `uid` int(11) default '0',
  `username` varchar(50) default NULL,
  `user_type` int(11) default NULL,
  `log_content` varchar(500) default NULL,
  `log_ip` varchar(20) default NULL,
  `log_time` int(11) default '0',
  PRIMARY KEY  (`log_id`),
  KEY `log_id` (`log_id`),
  KEY `uid` (`uid`),
  KEY `log_time` (`log_time`)
) ENGINE=MyISAM AUTO_INCREMENT=191 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_system_log
-- ----------------------------
INSERT INTO keke_witkey_system_log VALUES ('144', '0', '1', 'admin', '2', 'admin2010-11-17 15:59:34登陆系统', '192.168.1.77', '1289980775');
INSERT INTO keke_witkey_system_log VALUES ('145', '0', '1', 'admin', '2', '修改系统基本配置', '192.168.1.77', '1289980872');
INSERT INTO keke_witkey_system_log VALUES ('146', '0', '1', 'admin', '2', '修改系统基本配置', '192.168.1.77', '1289980942');
INSERT INTO keke_witkey_system_log VALUES ('147', '0', '1', 'admin', '2', 'admin2010-11-17 16:02:35登陆系统', '192.168.1.69', '1289980955');
INSERT INTO keke_witkey_system_log VALUES ('148', '0', '1', 'admin', '2', '修改系统基本配置', '192.168.1.69', '1289980965');
INSERT INTO keke_witkey_system_log VALUES ('149', '0', '1', 'admin', '2', '清空缓存', '192.168.1.69', '1289980970');
INSERT INTO keke_witkey_system_log VALUES ('150', '0', '1', 'admin', null, 'admin2010-11-17 16:16:05登陆系统', '192.168.1.88', '1289981765');
INSERT INTO keke_witkey_system_log VALUES ('151', '0', '1', 'admin', '2', '编辑会员35', '192.168.1.88', '1289981816');
INSERT INTO keke_witkey_system_log VALUES ('152', '0', '1', 'admin', '2', '添加会员37', '192.168.1.88', '1289981906');
INSERT INTO keke_witkey_system_log VALUES ('153', '0', '1', 'admin', null, 'admin2010-11-17 16:18:33登陆系统', '192.168.1.66', '1289981913');
INSERT INTO keke_witkey_system_log VALUES ('154', '0', '1', 'admin', '2', '冻结会员36', '192.168.1.66', '1289981961');
INSERT INTO keke_witkey_system_log VALUES ('155', '0', '1', 'admin', '2', '解冻会员36', '192.168.1.66', '1289981964');
INSERT INTO keke_witkey_system_log VALUES ('156', '0', '1', 'admin', '2', '编辑会员36', '192.168.1.66', '1289981976');
INSERT INTO keke_witkey_system_log VALUES ('157', '0', '1', 'admin', '2', '审核任务95', '192.168.1.66', '1289982371');
INSERT INTO keke_witkey_system_log VALUES ('158', '0', '1', 'admin', '2', '清空缓存', '192.168.1.69', '1289982483');
INSERT INTO keke_witkey_system_log VALUES ('159', '0', '1', 'admin', '2', '清空缓存', '192.168.1.69', '1289982616');
INSERT INTO keke_witkey_system_log VALUES ('160', '0', '1', 'admin', null, 'admin2010-11-17 16:30:43登陆系统', '192.168.1.69', '1289982643');
INSERT INTO keke_witkey_system_log VALUES ('161', '0', '1', 'admin', null, 'admin2010-11-17 16:37:35登陆系统', '192.168.1.13', '1289983055');
INSERT INTO keke_witkey_system_log VALUES ('162', '0', '1', 'admin', '2', '编辑广告13', '192.168.1.100', '1289983163');
INSERT INTO keke_witkey_system_log VALUES ('163', '0', '1', 'admin', '2', '编辑广告11', '192.168.1.100', '1289983180');
INSERT INTO keke_witkey_system_log VALUES ('164', '0', '1', 'admin', '2', '编辑广告10', '192.168.1.100', '1289983197');
INSERT INTO keke_witkey_system_log VALUES ('165', '0', '1', 'admin', '2', '添加文章关于因私下交易行为产生纠纷的问题说明', '192.168.1.69', '1289983242');
INSERT INTO keke_witkey_system_log VALUES ('166', '0', '1', 'admin', '2', '编辑广告12', '192.168.1.100', '1289983247');
INSERT INTO keke_witkey_system_log VALUES ('167', '0', '1', 'admin', '2', '添加文章关于威客多次提交作品流程修改的公告', '192.168.1.69', '1289983275');
INSERT INTO keke_witkey_system_log VALUES ('168', '0', '1', 'admin', '2', '添加文章任务宝提现金额从100元降至50元啦！', '192.168.1.69', '1289983296');
INSERT INTO keke_witkey_system_log VALUES ('169', '0', '1', 'admin', '2', '添加文章威客必看：发帖任务参与须知', '192.168.1.69', '1289983343');
INSERT INTO keke_witkey_system_log VALUES ('170', '0', '1', 'admin', '2', '添加文章关于个别威客刷提交作品的处理公告', '192.168.1.69', '1289983462');
INSERT INTO keke_witkey_system_log VALUES ('171', '0', '1', 'admin', '2', '添加文章关于客客威客1.2上线说明', '192.168.1.69', '1289983504');
INSERT INTO keke_witkey_system_log VALUES ('172', '0', '1', 'admin', '2', '清空缓存', '192.168.1.69', '1289983531');
INSERT INTO keke_witkey_system_log VALUES ('173', '0', '1', 'admin', '2', '编辑广告7', '192.168.1.100', '1289983567');
INSERT INTO keke_witkey_system_log VALUES ('174', '0', '1', 'admin', '2', '添加文章拥有梦想的快乐威客', '192.168.1.69', '1289983625');
INSERT INTO keke_witkey_system_log VALUES ('175', '0', '1', 'admin', '2', '添加文章高成就 低姿态 方有好作品', '192.168.1.69', '1289983666');
INSERT INTO keke_witkey_system_log VALUES ('176', '0', '1', 'admin', '2', '添加文章一个做事认真谨慎的优秀设计师', '192.168.1.69', '1289983702');
INSERT INTO keke_witkey_system_log VALUES ('177', '0', '1', 'admin', '2', '添加文章有计划 才会有未来', '192.168.1.69', '1289983732');
INSERT INTO keke_witkey_system_log VALUES ('178', '0', '1', 'admin', null, 'admin2010-11-17 16:52:41登陆系统', '192.168.1.13', '1289983961');
INSERT INTO keke_witkey_system_log VALUES ('179', '0', '1', 'admin', '2', '添加行业116', '192.168.1.13', '1289984228');
INSERT INTO keke_witkey_system_log VALUES ('180', '0', '1', 'admin', '2', '编辑会员42', '192.168.1.88', '1289985024');
INSERT INTO keke_witkey_system_log VALUES ('181', '0', '43', 'jank', '0', 'admin2010-11-17 17:32:56登陆系统', '192.168.1.13', '1289986376');
INSERT INTO keke_witkey_system_log VALUES ('182', '0', '1', 'admin', '2', '删除行业116', '192.168.1.13', '1289986401');
INSERT INTO keke_witkey_system_log VALUES ('183', '0', '1', 'admin', '2', '修改系统基本配置', '192.168.1.100', '1289987936');
INSERT INTO keke_witkey_system_log VALUES ('184', '0', '1', 'admin', '2', '编辑广告106', '192.168.1.77', '1289989862');
INSERT INTO keke_witkey_system_log VALUES ('185', '0', '1', 'admin', '2', '编辑广告105', '192.168.1.77', '1289989897');
INSERT INTO keke_witkey_system_log VALUES ('186', '0', '1', 'admin', '2', '编辑广告104', '192.168.1.77', '1289989916');
INSERT INTO keke_witkey_system_log VALUES ('187', '0', '1', 'admin', '2', 'admin2010-11-17 19:00:39登陆系统', '192.168.1.77', '1289991639');
INSERT INTO keke_witkey_system_log VALUES ('188', '0', '1', 'admin', '2', '编辑广告104', '192.168.1.77', '1289993007');
INSERT INTO keke_witkey_system_log VALUES ('189', '0', '1', 'admin', '2', '编辑广告105', '192.168.1.77', '1289993018');
INSERT INTO keke_witkey_system_log VALUES ('190', '0', '1', 'admin', '2', '编辑广告106', '192.168.1.77', '1289993025');

-- ----------------------------
-- Table structure for `keke_witkey_tag`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_tag`;
CREATE TABLE IF NOT EXISTS `keke_witkey_tag` (
  `tag_id` int(11) unsigned NOT NULL auto_increment,
  `tagname` varchar(50) default NULL,
  `tag_type` int(11) default NULL,
  `task_type` int(11) default NULL,
  `task_indus_id` int(11) default NULL,
  `task_indus_ids` varchar(100) default NULL,
  `task_status` int(11) default NULL,
  `start_time1` int(11) default NULL,
  `start_time2` int(11) default NULL,
  `end_time1` int(11) default NULL,
  `end_time2` int(11) default NULL,
  `left_day` int(11) default NULL,
  `left_hour` int(11) default NULL,
  `task_cash1` int(11) default NULL,
  `task_cash2` int(11) default NULL,
  `prom_cash1` int(11) default NULL,
  `prom_cash2` int(11) default NULL,
  `username` varchar(20) default NULL,
  `task_ids` varchar(100) default NULL,
  `open_is_top` int(11) default NULL,
  `listorder` int(11) default NULL,
  `art_cat_id` int(11) default NULL,
  `art_cat_ids` varchar(100) default NULL,
  `art_iscommend` int(11) default NULL,
  `art_hasimg` int(11) default NULL,
  `art_time1` int(11) default NULL,
  `art_time2` int(11) default NULL,
  `art_ids` varchar(100) default NULL,
  `loadcount` int(11) default NULL,
  `perpage` int(11) default NULL,
  `tplname` varchar(20) default NULL,
  `cat_type` int(11) default NULL,
  `cat_cat_id` int(11) default NULL,
  `cat_cat_ids` varchar(100) default NULL,
  `cat_loadsub` int(11) default NULL,
  `cat_onlyrecommend` int(11) default NULL,
  `tag_sql` text,
  `code` text,
  `cache_time` int(11) default NULL,
  PRIMARY KEY  (`tag_id`),
  UNIQUE KEY `tagname` (`tagname`),
  KEY `tag_id` (`tag_id`),
  KEY `cat_cat_id` (`cat_cat_id`),
  KEY `cache_time` (`cache_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=45 ;

--
-- 导出表中的数据 `keke_witkey_tag`
--

INSERT INTO `keke_witkey_tag` (`tag_id`, `tagname`, `tag_type`, `task_type`, `task_indus_id`, `task_indus_ids`, `task_status`, `start_time1`, `start_time2`, `end_time1`, `end_time2`, `left_day`, `left_hour`, `task_cash1`, `task_cash2`, `prom_cash1`, `prom_cash2`, `username`, `task_ids`, `open_is_top`, `listorder`, `art_cat_id`, `art_cat_ids`, `art_iscommend`, `art_hasimg`, `art_time1`, `art_time2`, `art_ids`, `loadcount`, `perpage`, `tplname`, `cat_type`, `cat_cat_id`, `cat_cat_ids`, `cat_loadsub`, `cat_onlyrecommend`, `tag_sql`, `code`, `cache_time`) VALUES
(4, '首页_公告', 2, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 17, '', 0, 0, 0, 0, '', 9, 0, 'art_a', 1, 0, '', 0, 0, '', '<dd class="main_d_2_p0"><h3></h3><br />QQ：3838438<br />电话：027-8888 8888</dd>', 0),
(5, '首页最新悬赏任务', 1, 1, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 7, 0, '', 0, 0, 0, 0, '', 40, 0, 'task_index', 1, 0, '', 0, 0, '', '', 0),
(6, '首页联系方式', 5, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, '', 1, 0, '', 0, 0, '', '<h3></h3><br />QQ：3838438<br />电话：027-8888 8888', 0),
(7, '首页最新招标任务', 1, 2, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 7, 0, '', 0, 0, 0, 0, '', 40, 0, 'task_index', 1, 0, '', 0, 0, '', '', 0),
(8, '首页最新推荐任务', 1, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 1, 9, 0, '', 0, 0, 0, 0, '', 40, 0, 'task_index', 1, 0, '', 0, 0, '', '', 10000),
(9, '首页分类', 3, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 'cat_a', 1, 0, '', 1, 1, '', '', 0),
(10, '首页推广任务', 1, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 'task_li_fll', 1, 0, '', 0, 0, '', '', 0),
(11, '首页快到期任务', 1, 1, 0, '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 10, 0, '', 0, 0, 0, 0, '', 10, 0, 'task_li_fll_date', 1, 0, '', 0, 0, '', '', 0),
(12, '首页最新资讯', 2, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 1, '', 0, 0, 0, 0, '', 9, 0, 'art_a_dateflr', 1, 0, '', 0, 0, '', '', 0),
(13, '首页成功案例', 1, 0, 0, '', 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 9, 0, '', 0, 0, 0, 0, '', 9, 0, 'task_li_flr_date', 1, 0, '', 0, 0, '', '', 0),
(14, '首页客户帮助', 2, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 4, 0, 'art_indexhelp', 1, 0, '', 0, 0, '', '', 0),
(15, '首页服务商家帮助', 2, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 1, '', 0, 0, 0, 0, '', 4, 0, 'art_indexhelp', 1, 0, '', 0, 0, '', '', 0),
(16, '首页交易安全保障', 2, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 4, 0, 'art_indexhelp', 1, 0, '', 0, 0, '', '', 0),
(17, '导航喇叭消息', 5, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, '', 1, 0, '', 0, 0, '', '站长诚信为本 威客会员至上 周一至周五每天19：00后兑现威客提现款 周六周日不定期参照执行 敬请广大威客会员关注支持！', 0),
(18, '页头滚动小贴士', 2, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 14, '', 0, 0, 0, 0, '', 0, 0, 'art_headsroll', 1, 0, '', 0, 0, '', '', 0),
(19, '首页热门标签', 3, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 'cat_a', 1, 0, '8,2,4,6,5', 0, 0, '', '', 0),
(20, '个人中心中标秘籍', 2, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 18, '', 0, 0, 0, 0, '', 0, 9, 'art_li_a', 1, 0, '', 0, 0, '', '', 0),
(21, '个人中心交易安全', 2, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 19, '', 0, 0, 0, 0, '', 0, 9, 'art_li_a', 1, 0, '', 0, 0, '', '', 0),
(22, '任务发布协议', 5, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, '', 1, 0, '', 0, 0, '', '<span style="font-family:Arial;">本着公开、公平、公正、诚实、守信的原则，致力于打造中国最具诚信的创意服务电子商务交易平台。请在您发布任务前仔细阅读任务发布规则：<br />1、任务发布者自由定价，自由确定悬赏时间，自由发布任务要求，自主确定中标会员和中标方案。<br />2、任务发布者100%预付任务赏金，让竞标者坚信您的诚意和诚信。<br />3、悬赏任务赏金分配原则：任务一经发布，网站收取一定发布费。<br />4、招标任务赏金分配原则：任务一经发布，网站不收取发布费，中标会员获得赏金的100%。<br />5、任务发布者若未征集到满意作品，可以加价延期征集，也可让会员修改。<br />6、任务发布者自己所在组织的任何人均不能以任何形式参加自己所发布的任务，一经发现则视为任务发布者委托网站管理员按照网站规则选稿。<br />7、延期任务有次数限制，并且每次必须增加一定比例的佣金。<br />8、保证审稿的公平性，请雇主及时审核贴子是否合格。如雇主没及时审核贴子，系统默认雇主同意支付。<br />9、任务选稿后，网站将公示一段时间，以便查看该任务是否有抄袭作弊的情况。公示期结束，同时发布者和中标者完成源文件的交接事宜后，由发布者确认源文件无误，网站将任务赏金支付给中标者，但发布者如出现恶意拖款的情况，一旦查证属实，将视为全权委托网站工作人员处理。<br />10、发布者与投标会员，应严格按照每个任务的“任务要求”所描述的内容执行。如果发布者提出超出“任务要求”范围的要求，会员有权拒绝，发布者也不得以此为理由拒绝选出中标方案或退款。<br />11、会员在中标后被举报涉嫌抄袭的作品，经过调查核实，本站取消中标资格。<br />12、发布任务即视为同意本协议。<br /></span>', 0),
(43, '商城_公告', 2, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, NULL, 0, 0, 0, 0, '', 5, NULL, 'shop_a', NULL, NULL, '', 0, 0, '', NULL, NULL),
(27, '会员常见问题', 2, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 13, '', 0, 0, 0, 0, '', 8, 0, 'task_info_help', 1, 0, '', 0, 0, '', '', 30),
(33, '个人中心网站公告', 2, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 17, '', 0, 0, 0, 0, '', 10, 0, 'art_li_a', 0, 0, '', 0, 0, '', '', 3600),
(34, '个人中心帮助中心', 2, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 100, '', 0, 0, 0, 0, '', 10, 0, 'art_li_a', 0, 0, '', 0, 0, '', '', 3600),
(35, '帮助中心_客户服务', 5, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', '<ul class="fabutask1 cb">\r\n        <li>服务热线： 6666666</li>\r\n        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6666666666</li>\r\n        <li>汇款传真： 010-6666666</li>\r\n      </ul>\r\n      <div class="help_left_line"></div>\r\n      <ul class="fabutask cb">\r\n        <li>客户服务时间</li>\r\n        <li>周一至周日 全天</li>\r\n        <li>（节假日照常服务）</li>\r\n      </ul>\r\n      <div class="help_left_line"></div>\r\n      <ul class="fabutask cb">\r\n        <li>在线客服：&nbsp;<a href="tencent://message/?V=1&amp;Uin=123456789&amp;Site=Taskcn&amp;Menu=yes" target="blank"><img src="http://wpa.qq.com/pa?p=1:123456789:41"></a></li>\r\n      </ul>', 0),
(36, '注册服务条款', 5, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', '1、用户有权根据本协议的规定及本网站发布的相关规则，利用本网站发布任务信息、查询用户信息、参加任务、在本网站社区及空间发帖、参加本网站的有关活动及有权享受本网站提供的其他的有关资讯及信息服务。　　<br />2、用户有权根据需要更改登录和账户提现密码。用户应对以该用户名进行的所有活动和事件负全部责任。　　<br />3、用户有义务确保向本网站提供的任何资料、注册信息真实准确，包括但不限于真实姓名、身份证号、联系电话、地址、邮政编码等。保证本网站可以通过上述联系方式与自己进行联系。同时，用户也有义务在相关资料实际变更时及时更新有关注册资料。　　<br />4、用户不得以任何形式擅自转让或授权他人使用自己在本网站的用户帐号。　　 <br />5、用户有义务确保在本网站上发布的任务信息真实、准确，无误导性。　　<br />6、用户不得在本网站网上发布平台发布国家禁止信息、不得发布侵犯他人知识产权或其他合法权益的信息，也不得发布违背社会公共利益或公共道德的信息。　　<br />7、用户在本网站交易中应当遵守诚实信用原则，不得以干预或操纵发布任务等不正当竞争方式扰乱网上交易秩序，不得从事与网上交易无关的不当行为，不得在交易平台上发布任何违法信息。　　<br />8、用户不应采取不正当手段（包括但不限于虚假信息、互换好评等方式）提高自身或他人信用度，或采用不正当手段恶意评价其他用户，降低其他用户信用度。　　<br />9、用户承诺自己在使用本网站实施的所有行为遵守国家法律、法规和本网站的相关规定以及各种社会公共利益或公共道德。对于任何法律后果的发生，用户将以自己的名义独立承担所有相应的法律责任。　　 <br />10、用户在本网站网上交易过程中如与其他用户因交易产生纠纷，可以请求本网站从中予以协调。用户如发现其他用户有违法或违反本协议的行为，可以向本网站举报。如用户因网上交易与其他用户产生诉讼的，用户有权通过司法部门要求本网站提供相关资料。　　<br />11、用户应自行承担因交易产生的相关费用，并依法纳税。　　<br />12、未经本网站书面允许，用户不得将本网站资料以及在交易平台上所展示的任何信息以复制、修改、翻译等形式制作衍生作品、分发或公开展示。　　<br />13、用户不得使用以下方式登录网站或破坏网站所提供的服务：　　<br />13.1、以任何机器人软件、蜘蛛软件、爬虫软件、刷屏软件或其它自动方式访问或登录本网站；　　<br />13.2、通过任何方式对本公司内部结构造成或可能造成不合理或不合比例的重大负荷的行为； 　　 <br />13.3、通过任何方式干扰或试图干扰网站的正常工作或网站上进行的任何活动；　　<br />14、用户同意接收来自本网站的信息，包括但不限于活动信息、交易信息、促销信息等。 　', 0),
(37, '页脚免责声明', 5, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', '1、本网站发布悬赏任务、技术项目转让，其版权均归原作者所有，内容必须真实合法，本网站不负任何责任。<br /><br />2、其他任何媒体、网站或个人从本网下载使用，须自负版权等法律责任，本网站不负任何责任。<br /><br />3、本网站刊发、转载文章，版权归原作者所有，仅代表本人的观点和看法，文责自负，本网站不负任何责任。<br /><br />4、当本网站以链接形式推荐其他网站内容时，本网站不保证这些网站或资源的可用性负责、真实性、合法性。<br /><br />5、对于任何因使用链接的其他网站所造成之个人资料泄露及由此而导致的任何法律争议和后果，本网站不负任何责任。<br /><br />6、由于与本网站链接的其它网站所造成之个人资料泄露及由此而导致的任何法律争议和后果，本网站不负任何责任。<br /><br />7、任何单位或个人认为通过本站的内容可能涉嫌侵犯其合法权益，应该及时向本站管理员书面反馈，并提供身份证明、权属证明及详细侵权情况证明，我们在收到上述法律文件后，将会尽快安排处理。<br />', 0),
(38, '页脚支付方式', 5, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', '<p><strong><span style="font-size:medium;color:#ff0000;">支付方式一：银行汇款</span></strong></p><p><strong>开 户 行：XXXXXXX银行　　帐 号：000-000-000-000</strong></p><p>注：开户行所在城市为：xxxxx&nbsp; .....</p><p>在线QQ：xxxxxxxx、xxxxxxx</p><p>联系电话：027-0000000、00000000、000000、000000</p><p>付款后请及时通知我们，请注明所汇银行、金额、您在威客的用户名或者所发项目名称。</p><p>企业如需开据发票，请把公司名称、地址、邮编等相关信息发至邮箱（<a href="mailto:xxxx@xxx.com">xxxx@xxx.com</a>）,费用另计。 <br /><br /><strong><span style="font-size:medium;color:#ff0000;"></span></strong></p><p><strong><span style="font-size:medium;color:#ff0000;">支付方式二：通过财付通付款</span></strong></p><p><span style="font-family:Verdana;"><strong>如何通过财付通预付赏金？</strong></span></p><p>&nbsp;</p>', 0),
(39, '页脚关于我们', 5, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 'XXXX网是XXXXXX独家运营的网站平台，是中国最诚信、最专业的威客工作者在线工作平台，知识成果、创意产业成果征集（招标）交易平台。XXXXX本着让知识和财富快速流通、让时间和报酬等比交换的原则，致力于打造最具规范运营保障的知识成果、创意成果、劳务技能在线交易市场。凡是一切可数字化转换的劳动成果或服务都可在XXXXX网平台上完成交易。<br /><br /><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;XXXXX从XXXX年X月成立以来，汇聚了来XXXXX等多个行业领域的上百万专业工作者会员，他们凭借自己的专业知识、成果创作、服务技能活跃在XXXX，为满足企业、单位或个人的各种成果需求提供更多更好的解决方案。<br /><br />&nbsp;&nbsp;&nbsp;XXXXX没有任何门槛，只要您有能力、知识和创意智慧，都能在XXXXXXX的平台上充分体现价值；把您的富裕时间和劳动成果进行交易，拓展您的工作方式和报酬获得渠道，是让您充分发挥潜力、展示才华、让您成功的地方！<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 信誉至上、诚信为本、服务用户、保障权益是我们的运营宗旨，真正为您营造一个公平、公正、公开的威客服务平台，全力缔造互联网社会工作方式的革命。<br /><br /></div><p>&nbsp;&nbsp;&nbsp;&nbsp; xxxx方指定网址：</p>', 0),
(40, '页脚联系方式', 5, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', '<strong>热线电话：</strong><br />联系电话：00000000<br />传真：000-00000000<br /><br /><strong>商务合作：</strong><br />Tel：000-0000000&nbsp; <br />Email：<a href="mailto:00@00000.com">00@00000.com</a><br /><br /><strong>新闻咨询</strong><br />00000000000<br />新闻联络人:000<br />QQ：00000000<br />MSN： <a href="mailto:0000000000@000.com">0000000000@000.com</a><br />Email：<a href="mailto:000000@0000.com">000000@0000.com</a><br /><br /><strong>人才招聘</strong><br />电话：0000000<br />Email：<a href="mailto:000@000000.com">000@000000.com</a><br />QQ:0000000000<br /><br /><strong>公司地址：</strong><br />00市00区00000000大厦00楼<br />邮政编码：000000<br />', 0),
(41, '服务内容页交易提示', 5, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', '1.客户在交易通托管定金后，服务商没有及时提供服务或拒绝服务，客户可以随时申请退还托管资金。<br />2.服务商请在客户托管款项后再提供服务，若客户存在欺诈问题，可申请仲裁以要求获得全额或部分项目款。<br />3.网站会以客观事实为依据对存有纠纷的交易作出合理处理，服务商与客户可以放心使用平台进行交易。', 0),
(42, '搜索页热门搜索', 5, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', '<li><a href="javascript:;" onclick="hotsearch_f(this.innerHTML)">logo设计</a></li><li><a href="javascript:;" onclick="hotsearch_f(this.innerHTML)">装修</a></li><li><a href="javascript:;" onclick="hotsearch_f(this.innerHTML)">网站建设</a></li><li><a href="javascript:;" onclick="hotsearch_f(this.innerHTML)">发帖</a></li><li><a href="javascript:;" onclick="hotsearch_f(this.innerHTML)">推广</a></li><li><a href="javascript:;" onclick="hotsearch_f(this.innerHTML)">网页设计</a></li><li><a href="javascript:;" onclick="hotsearch_f(this.innerHTML)">网络评论员</a></li>', 0),
(44, '商城页_开店联系方式', 5, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '', '<ul><li>&nbsp;</li><li>QQ :0101001</li><li>电话:3838438</li></ul>', NULL);

-- ----------------------------
-- Table structure for `keke_witkey_task`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_task`;
CREATE TABLE `keke_witkey_task` (
  `task_id` int(11) NOT NULL auto_increment,
  `model_id` char(10) default NULL,
  `task_mode` int(11) default NULL,
  `work_count` int(11) default NULL,
  `single_cash` float(10,2) default NULL,
  `task_status` int(11) default '0',
  `task_title` varchar(100) default NULL,
  `task_desc` text,
  `task_file` varchar(100) default NULL,
  `task_pic` varchar(100) default NULL,
  `indus_id` int(11) default '0',
  `uid` int(11) default '0',
  `username` varchar(50) default NULL,
  `start_time` int(10) default '0',
  `end_time` int(10) default '0',
  `sp_end_time` int(10) default NULL,
  `city` varchar(20) default NULL,
  `task_cash` float(10,2) default NULL,
  `task_cash_coverage` varchar(100) default NULL,
  `cash_cost` float(10,2) default NULL,
  `credit_cost` float(10,2) default NULL,
  `view_num` int(11) default '0',
  `work_num` int(11) default '0',
  `sign_num` int(11) default '0',
  `is_prom` int(11) default NULL,
  `prom_count` float(8,2) default NULL,
  `prom_cash` float(8,2) default '0.00',
  `prom_credit` float(8,2) default NULL,
  `is_delineas` int(11) default '0',
  `isvip` int(11) default '0',
  `istop` int(11) default '0',
  `kf_uid` int(11) default '0',
  PRIMARY KEY  (`task_id`),
  KEY `task_id` (`task_id`),
  KEY `model_id` (`model_id`),
  KEY `uid` (`uid`),
  KEY `indus_id` (`indus_id`),
  KEY `task_status` (`task_status`)
) ENGINE=MyISAM AUTO_INCREMENT=137 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_task
-- ----------------------------
INSERT INTO keke_witkey_task VALUES ('89', '1', '1', null, null, '0', '培训广告网页设计（只是一个单页面）', '<h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">培训广告网页设计（只是一个单页面）</h1><p>这是一个培训课程网页单页设计，请先用PS设计出效果图，待雇主选中后再用DIV+CSS设计成网页。 <br /><br />1、总基调： <br />以暖色调为主，要有冲击力，要大气，厚重。因为文字较多，在设计时要注意，不要给人审美疲劳，让人有阅读的兴趣，最好加一些有创意的，有意义的图片。 <br />2、尺寸 <br />内容放在一个页面上，宽为960像素，长度根据需要来定。 <br />3、参考页面： <br />1）http://www.zhangzuijiulai.cn/koucai/yc/ <br />这是我们现在用的一个业务宣传页面。 <br />2）http://226.x.asktang.com/ <br />这个页面做的很大气，选图有冲击力。 <br />4、其他说明： <br />1）该页面是业务页面，目的是让想学口才的人看完后，就有报名的冲动和意愿。所以，在设计时一定要充分考虑页面诉求。 <br />2）请细心搜寻一些与页面文字诉求相关的有号召力的图片。 <br />3）请留出一些位置，放一些广告，广告的类型有横幅，或尺寸不一的广告。具体广告参见：http://www.zhangzuijiulai.cn/koucai/yc/ <br />5、文案和图片见附件 <br />6、有不明白的请咨询雇主。 </p>', null, null, '19', '36', 'lelezhi', '1289981817', '1290413817', null, '广西,南宁', '100.00', null, null, null, '0', '0', '0', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('90', '2', null, null, null, '0', 'shopex模板修改', '<span style=\"font-family:Arial;\">要求看起来简单、专业</span>', null, null, '26', '35', 'bluesky', '1289981920', '1292573920', null, '河北,保定', '50.00', '1', null, null, '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('91', '1', '1', null, null, '2', '字体制作------------加急！', '<h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">字体制作------------加急！</h1><p>1.按照附件里的字体样式进行设计字体。 <br />2.字体生成文件为ttf格式，安装在window下可以用。 <br />3.要求不仅在word下，在别的软件里也可以打出相应的字，出现相应的形状。 <br />我本人用的是coreldraw和font creator program做的，在Word里打字也可以出来，但是好像错位一样，不像在word里正常打字，但插入字符可以正常显示，在别人软件却不可以使用。</p>', null, null, '26', '36', 'lelezhi', '1289982082', '1290846082', null, '上海,杨浦', '1000.00', null, null, '1000.00', '3', '0', '0', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('92', '2', null, null, null, '2', '制作shopex模板', '<p>页面简洁美观，符合商城系统的风格</p>', null, null, '26', '35', 'bluesky', '1289982125', '1292574125', null, '四川,自贡', '50.00', '1', null, '50.00', '1', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('93', '1', '1', null, null, '2', '葡萄酒标设计', '<h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">葡萄酒标设计</h1><p>一、产品介绍：干红葡萄酒、干白葡萄酒，普通标准瓶型。 <br />二、设计内容：酒标（需要设计一个系列，3个标），包装盒，礼品袋（规格材质可由设计者斟酌） <br />三、设计要求： <br />1、设计两款包装：一种为1瓶装含1个开瓶器，另一种为2瓶装。手提袋的风格与酒标的设计风格保持一致。 <br />2、充分体现葡萄酒拥有天山天池得天独厚的自然资源蕴含的文化价值，本酒庄座落在天山天池以北45公里处。 <br />3、logo要包含“冰湖及英文barhome”或“222”字样 ， 正面酒标包含文字元素：品牌名：冰湖 barhome, 或“冰湖黛莎德”、“冰湖杰诺瑞”，年份：2008 ，葡萄品种：赤霞珠 ， 体积： 750ml ，酒精度：13% 酒庄名：新疆天山冰湖葡萄酒业有限公司。背面酒标预留一定的文字输入空间，文字待定。酒标别搞不规则形，因为印刷费用高。 <br />4、本款主要针对高端消费人群设计，设计要体现出“葡萄酒酒中极品”、“激情”、“纯洁”、 “高贵”、“浪漫”等风格。设计时要充分体现以上品牌特性。 <br />5、设计的作品要大气稳重，有内涵，设计作品应构思精巧，简洁明快，色彩协调，健康向上，有独特的创意，易懂、易记、易识别、易制作，有强烈的视觉冲击力和直观的整体美感，有较强的思想性、艺术性、感染力和时代感，设计的作品能给人以美的享受。 <br />6、色调、构图不受征集人局限，由设计人自由发挥，设计人可根据自己的理解和喜好进行创作，并应提供有多种配色的方案供选择。 <br />7、中标作品请提交完整的可用的图形源文件，及标志黑白稿以便进行修改和完善。 <br />四.知识产权声明：　　1.所有提交的作品必须为作者原创，未在其他任何地方发表或使用过，未侵犯他人著作权；如有侵犯他人著作权，由设计者承担所有法律责任。 <br />　　2.如中标，设计方必须提供作品的完整方案，包括各种矢量图形源文件和所用到的字体，以方便进行修改完善和印刷。 <br />　　3.中标的设计作品，我方支付设计制作费后，即拥有该作品知识产权，包括著作权、使用权和发布权等，有权对设计作品进行修改、组合和应用。 <br />　　4.设计作品一经采用，所有权、修改权和使用权均归我方所有，设计者不得在其他任何地方使用该设计作品，包括并不限于著作权、使用权、发布权以及对设计作品进行修改、组合、应用等权利；否则构成侵权，本公司保留依法追究设计方法律责任的权利。 <br />　　5.征集结果公布后，未采用的作品即可自行处理。 <br />　　6.参加此设计任务者被视为同意以上所有声明。 </p>', null, null, '73', '36', 'lelezhi', '1289982260', '1291278260', null, '', '2000.00', null, null, '2000.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('94', '2', null, null, null, '2', '利用php168或者网人系统制作分类信息网站', '页面简洁大气，用户体验好，程序运行正常没有bug.', null, null, '29', '35', 'bluesky', '1289982294', '1292574294', null, '山东,枣庄', '50.00', '2', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('95', '1', '1', null, null, '2', '“虫虫”两字用于商标注册图样设计', '<div class=\"taskdescription f12 bgreyline\"><h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">“虫虫”两字用于商标注册图样设计</h1><p>图样是用于商标申请的。未来也会打在软件包装盒子上的。 <br /><br />设计一个以“虫虫”两个汉字为主体的图案，要包括“虫虫”文字（可以是象形）但不能只有虫形没有字。创意可以考虑和“网络”，“软件”，“网络爬虫”结合；尺寸规格没有限制； <br /><br />我们公司网站http://www.chongsoft.com</p></div>', null, null, '43', '36', 'lelezhi', '1289982340', '1290414371', null, '', '300.00', null, null, '300.00', '2', '2', '1', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('96', '2', null, null, null, '2', '用xhtml和css将一套图片转换成静态的网页', '<span style=\"font-family:Arial;\">用xhtml和css将一套图片转换成静态的网页.</span>', null, null, '30', '35', 'bluesky', '1289982444', '1291710444', null, '湖北,黄冈', '50.00', '1', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('97', '1', '1', null, null, '2', '用易语言替换文本', '<div class=\"taskdescription f12 bgreyline\"><h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">用易语言替换文本</h1><p>用易语言，进行指定文本的替换。 <br /><br />详细的替换内容，在附件中。</p><div class=\"buchong\"><span style=\"color:red;\"><strong>任务补充说明:</strong></span><ul><li>有朋友对里面我的说明不是很了解，我追加一个自己写的程序，程序理论上是肯定能实现的，主要用的功能也是查找和替换。只是我对这个，不是很懂。而且，我平时没有时间。希望哪位能帮忙写出来。到时候感谢。 &nbsp;[<span class=\"red\">补充于:</span><span class=\"date\">2010-11-16 20:26:09</span>]</li><li>有朋友对里面我的说明不是很了解，我追加一个自己写的程序，程序理论上是肯定能实现的，主要用的功能也是查找和替换。只是我对这个，不是很懂。而且，我平时没有时间。希望哪位能帮忙写出来。到时候感谢。 &nbsp;[<span class=\"red\">补充于:</span><span class=\"date\">2010-11-16 20:26:16</span>]</li><li>有朋友对里面我的说明不是很了解，我追加一个自己写的程序，程序理论上是肯定能实现的，主要用的功能也是查找和替换。只是我对这个，不是很懂。而且，我平时没有时间。希望哪位能帮忙写出来。到时候感谢。 &nbsp;[<span class=\"red\">补充于:</span><span class=\"date\">2010-11-16 20:26:39</span>]</li></ul></div></div>', null, null, '42', '36', 'lelezhi', '1289982482', '1290846482', null, '', '500.00', null, null, '500.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('98', '2', null, null, null, '2', '根据效果图做施工图纸', '<h2 id=\"rtitle\">根据效果图做施工图纸</h2>', null, null, '72', '35', 'bluesky', '1289982546', '1291278546', null, '四川,内江', '50.00', '1', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('99', '2', null, null, null, '2', '将讲演.话音打成文字(中文)--可试合作', '<h2 id=\"rtitle\">将讲演.话音打成文字(中文)--可试合作</h2>', null, null, '47', '35', 'bluesky', '1289982640', '1291710640', null, '', '50.00', '1', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('100', '2', null, null, null, '2', '网站改版，整站设计', '<h2 id=\"rtitle\">网站改版，整站设计</h2>', null, null, '28', '35', 'bluesky', '1289982697', '1292574697', null, '贵州,安顺', '50.00', '2', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('101', '2', null, null, null, '2', '淘宝商品人气降权，求淘宝内部人员恢复', '<h2 id=\"rtitle\">淘宝商品人气降权，求淘宝内部人员恢复</h2>', null, null, '66', '35', 'bluesky', '1289982807', '1292574807', null, '黑龙江,双鸭山', '50.00', '2', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('102', '2', null, null, null, '2', '30平方米按摩椅专卖厅装修效果图', '<h2 id=\"rtitle\">30平方米按摩椅专卖厅装修效果图</h2>', null, null, '89', '35', 'bluesky', '1289982886', '1292574886', null, '湖南,郴州', '50.00', '2', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('103', '1', '1', null, null, '2', '娱乐场所隔声工程公司注册商标（品牌）起名', '<h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">娱乐场所隔声工程公司注册商标（品牌）起名</h1><p>广州涤音环保科技有限公司是一家集声学产品研究、生产和声学工程设计、施工于一体的国内知名企业。公司成立于2007年，致力于建筑声学技术研究应用及为客户提供量“声”定做的声学解决方案。 <br />公司成立至今，已为数百家酒吧、慢摇吧、KTV、夜总会等夜场娱乐场所提供隔声隔振技术服务，成为娱乐场所隔声隔振行业的老大。 <br />要由于业务发展需要，需要注册一个专注服务于“隔声隔振”的品牌。要求如下： <br />1、要测算过吉凶； <br />2、要在中国商标网查询过没有人注册； <br />3、要2个字以上，最好是3-4个字； <br />4、要符合行业特点，叫起来跟我们所做的业务要贴切，这个行业打交道的是酒吧的老板、音响公司的老板、装修公司的老板； <br />5、要有气势，大气； <br />6、要容易记住。 <br /><br />注释 <br />KTV包房一般建设在商业、居民住宅区建筑的中、低层，包房中大功率的音响系统所产生的声压高达100dB以上（最大的声能量主要集中在低频部分），经过建筑结构、管道等振动传向整栋建筑的其它部位，或通过地面、空气传向周边的建筑物。住在本栋楼层或周边的居民往往被噪声严重干挠（特别是中老年人和相关病史的人群），纷纷到政府环保部门或物业管理部门投诉，采取补救措施往往得不偿失，使投资方和相关人群受到不同程度的经济损失和精神损失。 <br />我们公司提供的系统解决方案能够做到让噪声与振动不扰民，达到国家噪声排放标准。 <br /><br />现在所起的名称就是要做为一个商标去注册，也是我们以后对外的品牌。希望集思广益，谢谢大家</p>', null, null, '98', '36', 'lelezhi', '1289982886', '1290846886', null, '', '900.00', null, null, '900.00', '1', '0', '1', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('104', '1', '1', null, null, '2', '给虎妞起名', '<h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">给虎妞起名</h1><p></p><p>父亲姓 岳，母亲姓 张 小孩姓岳，需要起名为 岳亮X&nbsp; 或 岳X亮，求第三个字，要求五行，笔画，还有这个字必须是第二声，孩子出生于 阳历2010年10月20日，农历九月十三，下午5点55分。谢谢！</p>', null, null, '41', '36', 'lelezhi', '1289982981', '1295166981', null, '', '10000.00', null, null, '10000.00', '2', '2', '1', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('105', '2', null, null, null, '2', '石材展厅设计', '<h2 id=\"rtitle\">石材展厅设计</h2>', null, null, '89', '35', 'bluesky', '1289982992', '1292574992', null, '福建,南平', '50.00', '8', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('106', '2', null, null, null, '2', '设计一个数据库模板（包括首页、列表页等）', '<h2 id=\"rtitle\">设计一个数据库模板（包括首页、列表页等）</h2>', null, null, '31', '35', 'bluesky', '1289983051', '1292143051', null, '江苏,张家港', '50.00', '2', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('107', '2', null, null, null, '2', 'VB＋SQL2005开发工厂工作流程系统', '<h2 id=\"rtitle\"><span class=\"orange1\"></span>VB＋SQL2005开发工厂工作流程系统</h2>', null, null, '36', '35', 'bluesky', '1289983131', '1291711131', null, '广东,中山', '50.00', '6', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('108', '1', '1', null, null, '2', '网站平面设计+html制作', '<div class=\"taskdescription f12 bgreyline\"><h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">网站平面设计+html制作</h1><p>公司原网站：www.zgoutes.com <br />具体要求见附件 <br />有任何问题可以发邮件lssinda@126.com或加QQ69570902</p></div>', null, null, '27', '36', 'lelezhi', '1289983174', '1291279174', null, '澳门,澳门', '1700.00', null, null, '1700.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('109', '2', null, null, null, '2', '一篇关于创新性经济的论文', '<h2 id=\"rtitle\">一篇关于创新性经济的论文</h2>', null, null, '42', '35', 'bluesky', '1289983211', '1291711211', null, '', '50.00', '1', null, '50.00', '1', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('110', '1', '1', null, null, '2', '制作一个网站版面附带2，提供3个版面做参考', '<h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">制作一个网站版面附带2，提供3个版面做参考</h1><p></p><p>我们想把这个网站重新设计一下。<br /><br />要求选择：形象：大气类或半卡通。颜色：浅蓝、吉黄、红 可以参考,如果你做出来颜色或是版面更好可以不理会我这些要求。<br /><br /><br /><br />提供附件里面有几个版面有画一下需要的按妞或是栏目；<br /><br />主页一个，[后面两个副版就清除一下(清空内容页一个，如果有时间就再做放大页)后面两个因为是非常小，到时候如果需要就帮忙做下不需要可以省列]<br /><br /><br /><br />主要功能可以参考我的附件中内容<br /><br />产品图片可以按照600x450比例缩小图</p>', null, null, '26', '36', 'lelezhi', '1289983244', '1290847244', null, '内蒙古,呼和浩特', '550.00', null, null, '550.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('111', '1', '1', null, null, '2', '“星座”摄影LOGO设计及VI形象设计', '<h1>“星座”摄影LOGO设计及VI形象设计</h1><p></p><p>一、项目概况<br />1、 项目名称： “星座”LOGO设计及VI形象设计&nbsp;<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;备注：“星座”字体形状已经注册了商标<br />2、公司名称：南通星座婚纱经典有限公司<br />3、公司网站域名：www.ntxz.cc&nbsp;&nbsp; www.starphoto.net.cn<br />4、公司业务：婚纱摄影、写真摄影、家庭摄影、外景摄影、婚纱礼服出租出售、<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 个人形象化妆造型设计<br />5、公司背景：</p><br /><p class=\"p0\">&nbsp;星座婚纱经典有限公司成立于1994年4月18日。“星座”是南通市著名摄影商标品牌。公司创立至今已成为国内业界品牌影楼之一。星座摄影旗下拥有：星座婚纱经典公司、星座摄影基地、苏菲亚礼服馆、爱莉娜公主嫁衣馆、星座宝贝儿童摄影等经营实体。作为南通的行业头牌，多年来引领着行业的发展和潮流。<br /><br />二、 设计项目要求 ：<br />1.对于星座品牌内涵的诠释，体现星座品牌给客户传递的价值和利益。<br />&nbsp;&nbsp;&nbsp;</p><br /><p><strong>服务宗旨：放心、满意、感动、惊喜</strong></p><br /><p><strong>经营理念：专业、亲切、诚信、创新</strong></p><br /><p><strong>星座企业使命：用爱心和创意成就美丽人生！</strong></p><br /><p><strong>星座企业愿景：有影响力的美好事业连锁品牌！</strong></p><br /><p class=\"p0\"><br />2.LOGO突出体现国际化品质的气质，唯美时尚。有强烈视觉冲击力。 <br />3.LOGO要求有独特的创意，易懂、易记、易识别，重要的是要体现时尚大气！4.LOGO/VI基础应用设计应注明标准字，标准色使用规范，并能提供多种配色方案参考选择。<br />5.中标设计师需提供AI，CDR，PSD等格式原文件，应为矢量图。<br />6.简单的VI设计（请基于公司LOGO的基本要素,完成企业的部分VI设计）<br />名片设计；信封信纸设计；宣传册；应用在公司网站上的LOGO；公司方案模板（电子文档模板，如：WORD模板页脚页眉设计、方案封面、PPT模板、EMAIL签名等）。车贴、厂内标识牌、工作服、工作牌等。<br />7.市场推广的其他应用部分（如：产品手册、招商手册、彩色单页、KT板、X展架、海报等等）<br />8.提供一下原来的LOGO，原来logo中的“星座 ”字体已经注册商标，能够保留更好。如与现在的时尚设计风格不兼容可以放弃，准备重新注册新商标。<br /><br /><br />三、 知识产权声明：<br />　　1.所设计的作品应为原创，LOGO未在国家商标局注册过，所设计的作品为原创，为第一次发布，未侵犯他人著作权；如有侵犯他人著作权，由设计者承担所有法律责任。 <br />　　2.如中标，设计方必须提供以上要求设计作品完整的方案，包括各种矢量图形源文件和所用到的字体，以方便进行修改完善和印刷。<br />　　3.中标的设计作品，我方支付设计制作费后，即拥有该作品知识产权，包括著作权、使用权和发布权等，有权对设计作品进行修改、组合和应用。<br />　　4.设计作品一经采用，所有权、修改权和使用权均归我方所有，设计者不得在其他任何地方使用该设计作品，包括并不限于著作权、使用权、发布权以及对设计作品进行修改、组合、应用等权利。设计作品一经采用，所有权、修改权和使用权均由本公司所有，设计者不得再在其他任何地方使用该作品，否则构成侵权，本公司保留依法追究设计方法律责任的权利。<br />　　5.征集结果公布后，未采用的作品即可自行处理。<br />　　6.参加此设计任务者被视为同意以上所有声明。</p>', null, null, '79', '36', 'lelezhi', '1289983304', '1290847304', null, '河北,石家庄', '850.00', null, null, '850.00', '1', '1', '1', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('112', '2', null, null, null, '2', '寻高手--大酒店VI设计', '<h2 id=\"rtitle\">寻高手--大酒店VI设计</h2>', null, null, '11', '37', 'jianghu', '1289983321', '1291711321', null, '吉林,白城', '50.00', '1', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('113', '2', null, null, null, '2', '完善一个装在一个人体模型里的电路', '<h2 id=\"rtitle\">完善一个装在一个人体模型里的电路</h2>', null, null, '77', '37', 'jianghu', '1289983393', '1291711393', null, '广东,广州', '50.00', '2', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('114', '1', '1', null, null, '2', '请把我已有2个版本LOGO加深分辨率', '<strong>请把我已有2个版本LOGO加深分辨率</strong>', null, null, '63', '36', 'lelezhi', '1289983393', '1290415393', null, '重庆,万州', '450.00', null, null, '450.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('115', '1', '1', null, null, '1', '公司首页横条FLASH制作', '<strong></strong><div class=\"taskdescription f12 bgreyline\"><h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">公司首页横条FLASH制作</h1><p></p><p>1.规格为910px*187px，整体静态图片见附件。<br /><br />2.要求蓝色圈有动态效果，也就是肽链连接效果。<br /><br />3.那天下之道，仁心为药需要有动态效果。<br /><br />4.右方十字，需要有动态效果<br /><br />5.发挥想象力，以自主创意，达到与网站风格一致。<br /><br />6.源图与字体可以跟我联系。</p></div>', null, null, '75', '36', 'lelezhi', '1289983451', '1290415451', null, '甘肃,兰州', '101.00', null, null, '101.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('116', '2', null, null, null, '2', '手机视频转换与手机视频服务器架设', '<h2 id=\"rtitle\">手机视频转换与手机视频服务器架设</h2>', null, null, '36', '37', 'jianghu', '1289983482', '1292575482', null, '澳门,澳门', '50.00', '8', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('117', '1', '1', null, null, '2', '厦门外贸公司LOGO标志设计', '<h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">厦门外贸公司LOGO标志设计</h1><p>一、 公司介绍 <br />中文名称：厦门福得工贸有限公司 <br />英文名称： Xiamen Fudea Industries Co.,Ltd. <br />今年刚成立。主要是做外贸机械配件、零件如挖土机、推土机零件配件等。网站是做全英文版，域名已经注册了www.fudea.cn <br />二、 LOGO设计要求 <br />1．FUDEA 是英文Full your ideal的缩写，意思是满足你的需要，要求 因为产品是配件， 可以理解成配件正好，适用 <br />2．标志可以用fd来创作可以设计成有3维立体的造型，会有抽象和空间感觉,由设计师自由发挥。讲究标志整体简洁大气、赋有创意。标志造型可以用物体或字母的一种组合进行设计。 <br />3．Xiamen Fudea Industries Co.,Ltd.英文字体也需要设计下 <br />4．色彩已经确定用，红色、黑色、黄色具体色值可以由设计师来定。合理搭配颜色色彩3种色彩太多，可以用于辅助配色。 <br /><br />5．作品上传格式：图片上方为标志下方是公司英文名称。最底下写上创意说明。大图尺寸为640*480像素，缩略图尺寸为120*90像素 <br /><br />三、设计提交内容要求 <br />1. 附带设计方案或配色方案，方便选择。 <br />2. LOGO创意设计和字体的设计必须提供创意文字说明，否则识为无效作品。 <br />3. 中标LOGO和字体的设计提交完整的、可用的源文件(CorelDRAW 9原搞)，以便进行修改、完善和印刷。 <br />四、知识产权说明 <br />1. 所设计的作品应为原创，未侵犯他人的著作权；如有侵犯他人著作权，由设计者承担所有法律责任。 <br />2. 选中的设计作品，我方支付悬赏金后，即拥有该作品知识产权，包括著作权、使用权和发布权等，我方有权对设计作品进行修改、组合。 </p>', null, null, '91', '36', 'lelezhi', '1289983534', '1295167534', null, '重庆', '6000.00', null, null, '6000.00', '1', '1', '1', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('118', '2', null, null, null, '2', '网站建设与推广（可兼职）', '<h2 id=\"rtitle\">网站建设与推广（可兼职）</h2>', null, null, '32', '37', 'jianghu', '1289983559', '1291711559', null, '河南,鹤壁', '50.00', '2', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('119', '1', '1', null, null, '2', '毕业设计 图书管理信息系统(java+sql 2000)', '<p><strong>毕业设计 图书管理信息系统(java+sql 2000)</strong></p><p><strong>毕业设计 图书管理信息系统(java+sql 2000)</strong></p><p><strong>毕业设计 图书管理信息系统(java+sql 2000)</strong></p>', null, null, '19', '36', 'lelezhi', '1289983584', '1290847584', null, '山东,济宁', '500.00', null, null, '500.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('120', '2', null, null, null, '2', '网络数据收集整理', '<h2 id=\"rtitle\">网络数据收集整理</h2>', null, null, '31', '37', 'jianghu', '1289983666', '1292575666', null, '江西,赣州', '50.00', '1', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('121', '1', '1', null, null, '2', '【加急】学生测试水平报告设计', '<h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">【加急】学生测试水平报告设计</h1><p>我们公司是一家做网络英语一对一培训的公司，给学生上完课以后需要给学生一份详细的英语水平测试报告，现在我们自己用excel做了一份，但是看起来不专业，需要再改善改善；（大家可以参考新东方、英孚等一些专业的英语培训机构的水平测试报告样式看看，但不要雷同），因为内容较多，估计需要2~3 张才能放得下，最好以JPG格式提交。 <br />需要进一步了解我们网站的可以去看一下：www.ekouyu.com <br />有什么问题及时沟通，或者发送邮件到manager@ekouyu.com <br />设计内容初稿见附件</p>', null, null, '38', '36', 'lelezhi', '1289983690', '1290847690', null, '山东,聊城', '5000.00', null, null, '5000.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('122', '2', null, null, null, '2', '企鹅团Qetuan.com推广外包接受报价', '<h2 id=\"rtitle\">企鹅团Qetuan.com推广外包接受报价</h2>', null, null, '32', '37', 'jianghu', '1289983746', '1292575746', null, '甘肃,兰州', '50.00', '2', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('123', '1', '1', null, null, '2', '“家佰福”食用油品牌LOGO设计', '<div class=\"taskdescription f12 bgreyline\"><h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">“家佰福”食用油品牌LOGO设计</h1><p></p><p>“家佰福”食用油品牌LOGO设计<br /><br /><br /><br />一、 项目概况 <br /><br />1、项目名称：“家佰福”食用油品牌LOGO设计<br /><br />2、公司名称：厦门西海油脂有限公司<br /><br />3、公司品牌：家佰福 WEST OIL<br /><br />4、公司业务：食用油的生产和销售。 <br /><br /><br /><br />二、 设计项目要求 ： <br /><br />1、设计内容： <br /><br />请根据我司的品牌“家佰福 WEST OIL<br />”进行文字美化设计。<br /><br />2、视觉要求：<br /><br />我们从事食品行业，希望中文字体饱满、端正（以黑体变化为好），英文要与中文字体协调；以亮丽的暖色调为好。<br /><br />3、设计作品应简单明了，体现中国文化，有创意和整体美感，易懂、易记。<br /><br />4、设计作品请提供创意说明。<br /><br />5、中标设计需提供AI，CDR等格式的矢量文件。<br /><br /><br /><br />特别提示：<br /><br />可借鉴“晚间新闻”“金龙鱼”“中绿”等文字标志，“佰”可以拆解为“亻”+“百”，其中“亻”可以进行有创意的设计。<br /><br />不可与家乐福商标类似。<br /><br /><br /><br />三、 知识产权声明： <br /><br />　　1. 所设计的作品应为原创，LOGO未在国家商标局注册过，所设计的作品为原创，为第一次发布，未侵犯他人著作权；如有侵犯他人著作权，由设计者承担所有法律责任。<br /><br />　　2. 如中标，设计方需提供以上要求设计作品完整的方案，包括各种矢量图形源文件和所用到的字体，以方便进行修改完善和印刷。<br /><br />　　3. 设计作品一经采用，所有权、修改权和使用权均归我方所有，设计者不得在其他任何地方使用该设计作品，包括并不限于著作权、使用权、发布权以及对设计作品进行修改、组合、应用等权利，否则构成侵权，本公司保留依法追究设计方法律责任的权利。<br /><br />　　4. 征集结果公布后，未采用的作品即可自行处理。<br /><br />　　5. 参加此设计任务者被视为同意以上所有声明。</p></div>', null, null, '36', '36', 'lelezhi', '1289983788', '1290847788', null, '青海,共和', '502.00', null, null, '502.00', '1', '1', '1', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('124', '2', null, null, null, '2', '求北京到苏州（或苏州到北京）旧汽车票一张', '<h2 id=\"rtitle\">求北京到苏州（或苏州到北京）旧汽车票一张</h2>', null, null, '97', '37', 'jianghu', '1289983821', '1290847821', null, '北京,石景山', '50.00', '8', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('125', '1', '1', null, null, '2', '老爸过生日、帮忙发短信、1.7元一条', '<div class=\"taskdescription f12 bgreyline\"><h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">老爸过生日、帮忙发短信、1.7元一条</h1><p>老爸过四十五岁生日、大家帮忙发短信 <br /><br />内容 叔叔您好、我在(给为威客所在的城市)祝您生日快乐、身体健康、万事如意。。之类的。。说一些祝福的话就好、 要在过生日那天发 <br /><br />电话 13455877631 生日阳历11月27 阴历10月22 <br />1.7元一条 提交电话号码前三位和后四位 <br /><br />谢谢</p></div>', null, null, '57', '36', 'lelezhi', '1289983905', '1292575905', null, '北京,西城', '3000.00', null, null, '3000.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('126', '1', '1', null, null, '2', '能熟练使用ECshop后台帮助我完成网站建设', '<div class=\"taskdescription f12 bgreyline\"><h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">能熟练使用ECshop后台帮助我完成网站建设</h1><p>能熟练使用ECshop后台帮助我完成网站建设！ <br />本人业余时间在使用ECshop后台做网站碰到几个问题，请求高手帮助，主要是 <br />1：前台销售排行怎么做进去 <br />2：网站底部放一点相关信息进去 <br />3：我用后台发布文章有点问题 <br />我只会看懂最简单的代码，若有高手愿意帮助我么可以联系一下 <br />QQ: 76717555 张衡添加请注明任务中国，谢谢！</p></div>', null, null, '36', '36', 'lelezhi', '1289983972', '1290847972', null, '山西,宁武', '666.00', null, null, '666.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('127', '1', '1', null, null, '2', '旅行公司VI设计及Logo改善', '<h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">旅行公司VI设计及Logo改善</h1><p>公司是旅游公司，主营是俄罗斯，印度，中国和其他亚洲国家 <br />名称Ganeshareisen GmbH <br />Add:Favoritenstrasse 35 1040, Wien <br />Tel: +43 1 505 67 94 <br />Fax: +43 1 505 62 63 <br />Website: http://www.ganeshareisen.at <br /><br />logo改善：在不改变太多的前提下，稍作修改，logo为印度像头神 <br />1. 信封设计：信封正面左小角有一个9cm x 4.5cm的透明膜，用以显示内部账单收件人地址的，请留空位置 <br />2.行李牌设计：用于悬挂在行李箱上的乘客信息牌 <br />3.信纸设计：Office Word 文档眉头和眉尾， 要包含的内容：公司logo和以下文字 <br />Ganesha Reisen GmbH <br />1040 Wien, Favoritenstrasse 35, <br />Tel: 01 505 38 12; Fax 01 505 38 13 <br />E-Mail: office@ganeshareisen.com <br />FB Nr.: 95718 m , Handelsgericht Wien, DVR: 0772356 <br />4.旅游行程文档设计： Office word 文档眉头和眉尾，4种风格（中国风， 俄罗斯风，印度风，其他亚洲国家风） <br />4.Email署名设计：可以链接到公司网站的. <br />5.PPT模板设计 <br />6.名片设计 <br /><br /><br />设计要求：计理念及风格要求与LOGO一致，大气且给人印象深刻。风格应为现代、清新雅致、稳重、字体大小考究，符合外国人的审美习惯， 以电子文稿形式提交，中标者需提供AI，CDR，PSD, JPG,WORD等格式原文件，应为矢量图 </p>', null, null, '55', '36', 'lelezhi', '1289984077', '1292576077', null, '四川,西昌', '3000.00', null, null, '3000.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('128', '2', null, null, null, '2', '企业门户网站设计（套）', '<h2 id=\"rtitle\">企业门户网站设计（套）</h2>', null, null, '28', '37', 'jianghu', '1289984085', '1291712085', null, '安徽,淮北', '50.00', '2', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('129', '2', null, null, null, '2', '景观3D效果图2张', '<h2 id=\"rtitle\"><span class=\"orange1\"></span>景观3D效果图2张</h2>', null, null, '10', '37', 'jianghu', '1289984179', '1291971379', null, '河南,鹤壁', '50.00', '2', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('130', '2', null, null, null, '2', '有谁会在地图上做地图找房的啊？重酬谢！', '<h2 id=\"rtitle\">有谁会在地图上做地图找房的啊？重酬谢！</h2>', null, null, '66', '37', 'jianghu', '1289984260', '1291712260', null, '青海,格尔木', '50.00', '2', null, '50.00', '0', '0', '0', null, null, '0.00', null, '0', '0', '0', '1');
INSERT INTO keke_witkey_task VALUES ('131', '1', '1', null, null, '0', '餐馆效果图制作', '<div class=\"taskdescription f12 bgreyline\"><h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">餐馆效果图制作</h1><p></p><p>新开张的餐馆（快餐为主），请设计简欧式装修风格。（效果图、施工图）。</p></div>', null, null, '28', '1', 'admin', '1289984355', '1294304355', null, '陕西,宝鸡', '5000.00', null, null, null, '0', '0', '0', '2', '0.00', '0.00', null, '0', '1', '0', '1');
INSERT INTO keke_witkey_task VALUES ('132', '1', '1', null, null, '1', '餐馆效果图制作', '<div class=\"taskdescription f12 bgreyline\"><h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">餐馆效果图制作</h1><p></p><p>新开张的餐馆（快餐为主），请设计简欧式装修风格。（效果图、施工图）。</p></div>', null, null, '30', '1', 'admin', '1289984394', '1290416394', null, '山东,枣庄', '200.00', null, '200.00', '0.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '1', '0', '1');
INSERT INTO keke_witkey_task VALUES ('133', '1', '1', null, null, '1', '广裕发陶瓷厂大门设计方案', '<h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">广裕发陶瓷厂大门设计方案</h1><p>因为大门主体建筑已经完成，需要装修方案，右边大门不能盖顶，两边门柱的形状与外观，包括具体建筑材料，有问题请与我联系：13527686355 黄先生。</p>', null, null, '31', '1', 'admin', '1289984441', '1290416441', null, '陕西,安康', '233.00', null, '233.00', '0.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '1', '0', '1');
INSERT INTO keke_witkey_task VALUES ('134', '1', '1', null, null, '0', '自建房二室一厅施工图和装修效果图', '<h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">自建房二室一厅施工图和装修效果图</h1><p></p><p>一、施工图纸<br /><br />1.本建筑为自建房，需整套设计施工图纸和装修效果图一至五层(2-5层同一布局),层高3.6m，混合结构；座向：座北朝南。<br /><br />2.一层布局：客厅、餐厅、厨房、洗手间、储物间（不设在楼梯下）；<br /><br />3.二层至五层：客厅、卧室两间、小书房、厨房、洗手间。南面飘出大阳台1.5m；<br />4.<span style=\"font-size:x-small;\"><span style=\"font-family:宋体;\">设计者必需充分的利用空间，首先考虑的是空间的实用性，和空间与空间衔接的合理性</span>。<br /></span><span style=\"font-family:宋体;\"><span style=\"font-size:small;\"><span style=\"font-size:x-small;\">5.注重采光的合理性</span>。<br /></span></span>6.楼梯位置已定位，如图，每跑宽1m。<br /><br />5.布局请考虑风水。<br /><br />&nbsp;二、室内设计要求：<br /><br />室计风格：现代 大方 简单&nbsp;&nbsp; &nbsp;所在地：江西赣州<br />居住人员：一对老年夫妇&nbsp; 一对年轻夫妇&nbsp; 两位小男孩<br /><br />1.厅里边要求装饰立面要求简单、稳重大方，有品味，进门不能直接看见客卫；<br /><br />2.卫生间尽量采用那种简洁、舒服的设计，<span style=\"font-family:宋体;FONT-SIZE: 10.5pt\">又方便老人、小孩使用；</span><br /><br />3.进户门需做玄关，一个鞋柜和多功能柜。<br /><br />4.所有家具现做。<br /><br />三、图纸要求：<br /><br />整套室内装修效果图以及整套详细设计施工图 ,水图、电图,施工说明,装修预算及家具选购等。<br /><br />四、版权说明：<br /><br />1、所设计的作品应为原创，未侵犯他人著作权；如有侵权他人著作权，由设计者承担所有法律责任。设计方必须提供设计作品完整的、可用的原文件,。<br /><br />2、选中的设计作品，设计方必须提供设计作品完整的、可用的原文件和所用到的字体及简单创意说明，可进行修改的文档； 我方支付悬赏金后，即拥有该作品知识产权，包括著作权、使用权和发布权等.<br /><br />3、设计作品一经采用，所有权、修改权和使用权均归我方所有，设计者不得再在其它任何地方作用该设计作品。 <br /><br />　　谢谢各位大师<br /><br />附：简单的外框图</p>', null, null, '17', '1', 'admin', '1289984485', '1291280485', null, '陕西,宝鸡', '2333.00', null, null, null, '0', '0', '0', '2', '0.00', '0.00', null, '0', '1', '0', '1');
INSERT INTO keke_witkey_task VALUES ('135', '1', '1', null, null, '1', '自建房二室一厅施工图和装修效果图', '<h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">自建房二室一厅施工图和装修效果图</h1><p></p><p>一、施工图纸<br /><br />1.本建筑为自建房，需整套设计施工图纸和装修效果图一至五层(2-5层同一布局),层高3.6m，混合结构；座向：座北朝南。<br /><br />2.一层布局：客厅、餐厅、厨房、洗手间、储物间（不设在楼梯下）；<br /><br />3.二层至五层：客厅、卧室两间、小书房、厨房、洗手间。南面飘出大阳台1.5m；<br />4.<span style=\"font-size:x-small;\"><span style=\"font-family:宋体;\">设计者必需充分的利用空间，首先考虑的是空间的实用性，和空间与空间衔接的合理性</span>。<br /></span><span style=\"font-family:宋体;\"><span style=\"font-size:small;\"><span style=\"font-size:x-small;\">5.注重采光的合理性</span>。<br /></span></span>6.楼梯位置已定位，如图，每跑宽1m。<br /><br />5.布局请考虑风水。<br /><br />&nbsp;二、室内设计要求：<br /><br />室计风格：现代 大方 简单&nbsp;&nbsp; &nbsp;所在地：江西赣州<br />居住人员：一对老年夫妇&nbsp; 一对年轻夫妇&nbsp; 两位小男孩<br /><br />1.厅里边要求装饰立面要求简单、稳重大方，有品味，进门不能直接看见客卫；<br /><br />2.卫生间尽量采用那种简洁、舒服的设计，<span style=\"font-family:宋体;FONT-SIZE: 10.5pt\">又方便老人、小孩使用；</span><br /><br />3.进户门需做玄关，一个鞋柜和多功能柜。<br /><br />4.所有家具现做。<br /><br />三、图纸要求：<br /><br />整套室内装修效果图以及整套详细设计施工图 ,水图、电图,施工说明,装修预算及家具选购等。<br /><br />四、版权说明：<br /><br />1、所设计的作品应为原创，未侵犯他人著作权；如有侵权他人著作权，由设计者承担所有法律责任。设计方必须提供设计作品完整的、可用的原文件,。<br /><br />2、选中的设计作品，设计方必须提供设计作品完整的、可用的原文件和所用到的字体及简单创意说明，可进行修改的文档； 我方支付悬赏金后，即拥有该作品知识产权，包括著作权、使用权和发布权等.<br /><br />3、设计作品一经采用，所有权、修改权和使用权均归我方所有，设计者不得再在其它任何地方作用该设计作品。 <br /><br />　　谢谢各位大师<br /><br />附：简单的外框图</p>', null, null, '27', '1', 'admin', '1289984514', '1290416514', null, '陕西,汉中', '222.00', null, '222.00', '0.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '1', '0', '1');
INSERT INTO keke_witkey_task VALUES ('136', '1', '1', null, null, '1', '“王记火勺炖肉”清真快餐店装修设计方案', '<div class=\"taskdescription f12 bgreyline\"><h1 style=\"FONT: 900 14px/1.6 Arial,Helvetica,sans-serif\">“王记火勺炖肉”清真快餐店装修设计方案</h1><p>设计风格:有主题色调(蓝色)，时尚简洁，不夸张 <br />说明： <br />1.外墙设计要落地玻璃设计。 <br />2.室内面积为150-200平方米左右: <br />- 有前台收银，付货吧台 10平米，菜单说明信息 <br />- 厨房20平米 - 卫生间，办公室，储仓间 <br />- 100-150平米餐厅 （20个4人台） <br />3.图纸要求:三维图纸 效果图 <br /><br />附件有我个人的市内布局(供参考); 我的店Logo. <br />我个人对\"吉野家\",\"李先生美国加州牛肉面\"这类快餐店的风格比较感兴趣.</p></div>', null, null, '33', '1', 'admin', '1289984673', '1290416673', null, '山西,大同', '222.00', null, '222.00', '0.00', '0', '0', '0', '2', '0.00', '0.00', null, '0', '1', '0', '1');

-- ----------------------------
-- Table structure for `keke_witkey_task_delay`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_task_delay`;
CREATE TABLE `keke_witkey_task_delay` (
  `delay_id` int(11) NOT NULL auto_increment,
  `task_id` int(11) default NULL,
  `delay_cash` float(10,2) default NULL,
  `delay_day` int(10) default NULL,
  `uid` int(11) default NULL,
  `on_time` int(11) default NULL,
  `delay_status` int(11) default '0',
  PRIMARY KEY  (`delay_id`),
  KEY `delay_id` (`delay_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_task_delay
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_task_favor`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_task_favor`;
CREATE TABLE `keke_witkey_task_favor` (
  `fav_id` int(11) NOT NULL auto_increment,
  `task_id` int(11) default NULL,
  `task_title` varchar(200) default NULL,
  `uid` int(11) default NULL,
  `username` varchar(20) default NULL,
  `fav_time` int(11) default NULL,
  PRIMARY KEY  (`fav_id`),
  UNIQUE KEY `fav_id` (`fav_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_task_favor
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_task_frost`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_task_frost`;
CREATE TABLE `keke_witkey_task_frost` (
  `frost_id` int(11) NOT NULL auto_increment,
  `frost_status` int(11) default '0',
  `task_id` int(11) default '0',
  `frost_time` int(11) default '0',
  `restore_time` int(11) default '0',
  `admin_uid` int(11) default '0',
  `admin_username` varchar(20) default NULL,
  PRIMARY KEY  (`frost_id`),
  KEY `frost_id` (`frost_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_task_frost
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_task_prize`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_task_prize`;
CREATE TABLE `keke_witkey_task_prize` (
  `task_id` int(11) default NULL,
  `prize` int(11) default NULL,
  `prize_count` int(11) default NULL,
  `prize_cash` float(10,2) default NULL,
  KEY `task_id` (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_task_prize
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_template`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_template`;
CREATE TABLE `keke_witkey_template` (
  `temp_id` int(11) NOT NULL auto_increment,
  `temp_title` varchar(200) default NULL,
  `temp_desc` text,
  `develop` varchar(50) default NULL,
  `temp_pic` varchar(200) default NULL,
  `temp_path` varchar(200) default NULL,
  `is_selected` int(2) default '0',
  `on_time` int(11) default '0',
  PRIMARY KEY  (`temp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_template
-- ----------------------------
INSERT INTO keke_witkey_template VALUES ('1', 'default', '最专业的威客模板', '彪哥', '1.jpg', 'default', '1', '1274131150');

-- ----------------------------
-- Table structure for `keke_witkey_unit_image`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_unit_image`;
CREATE TABLE `keke_witkey_unit_image` (
  `unit_id` int(11) NOT NULL auto_increment,
  `unit_name` varchar(50) default NULL,
  `unit_pic` varchar(50) default NULL,
  `unit_type` int(11) default '1' COMMENT '1经验 2信誉',
  PRIMARY KEY  (`unit_id`),
  KEY `index_1` (`unit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_unit_image
-- ----------------------------
INSERT INTO keke_witkey_unit_image VALUES ('30', '星星', 'ico/152244c569b6ba01b2.gif', '1');
INSERT INTO keke_witkey_unit_image VALUES ('31', '太阳', 'ico/46894c569bdcd1810.gif', '2');
INSERT INTO keke_witkey_unit_image VALUES ('32', '太阳', 'ico/109344c569cbf299bf.gif', '1');
INSERT INTO keke_witkey_unit_image VALUES ('34', '月亮', 'ico/25034c5cdbfea17d5.gif', '1');
INSERT INTO keke_witkey_unit_image VALUES ('35', '1哥', 'ico/294194c60c07e4337b.gif', '2');
INSERT INTO keke_witkey_unit_image VALUES ('36', '2哥', 'ico/259624c60c09956aea.gif', '2');

-- ----------------------------
-- Table structure for `keke_witkey_user_auth`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_user_auth`;
CREATE TABLE `keke_witkey_user_auth` (
  `u_auth_id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `username` varchar(20) default NULL,
  `id_num` varchar(50) default NULL,
  `real_name` varchar(50) default NULL,
  `origo` varchar(50) default NULL,
  `licen_pic` varchar(50) default NULL,
  `status` int(11) default NULL,
  PRIMARY KEY  (`u_auth_id`),
  KEY `index_1` (`u_auth_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_user_auth
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_vip_history`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_vip_history`;
CREATE TABLE `keke_witkey_vip_history` (
  `h_id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `username` varchar(20) default NULL,
  `start_time` int(11) default '0',
  `end_time` int(11) default NULL,
  `day` int(11) default NULL,
  `cash_cost` float(10,2) default NULL,
  `credit_cost` float(10,2) default NULL,
  `h_status` int(11) default '0',
  PRIMARY KEY  (`h_id`),
  KEY `h_id` (`h_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_vip_history
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_vip_rule`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_vip_rule`;
CREATE TABLE `keke_witkey_vip_rule` (
  `vip_rule_id` int(11) NOT NULL auto_increment,
  `vip_cash` float default '0',
  `vip_day` int(11) default '0',
  PRIMARY KEY  (`vip_rule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_vip_rule
-- ----------------------------
INSERT INTO keke_witkey_vip_rule VALUES ('1', '20', '30');
INSERT INTO keke_witkey_vip_rule VALUES ('2', '38', '60');
INSERT INTO keke_witkey_vip_rule VALUES ('3', '55', '90');
INSERT INTO keke_witkey_vip_rule VALUES ('4', '150', '180');

-- ----------------------------
-- Table structure for `keke_witkey_vote`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_vote`;
CREATE TABLE `keke_witkey_vote` (
  `vote_id` int(11) NOT NULL auto_increment,
  `task_id` int(11) default NULL,
  `work_id` int(11) default '0',
  `uid` int(11) default '0',
  `username` varchar(50) default NULL,
  `vote_ip` varchar(50) default '0',
  `vote_time` int(11) default '0',
  PRIMARY KEY  (`vote_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_vote
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_withdraw`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_withdraw`;
CREATE TABLE `keke_witkey_withdraw` (
  `withdraw_id` int(11) NOT NULL auto_increment,
  `withdraw_cash` float default '0',
  `uid` int(11) default '0',
  `username` varchar(50) default NULL,
  `withdraw_status` int(11) default '0',
  `applic_time` int(11) default '0',
  `process_uid` int(11) default '0',
  `process_username` varchar(50) default NULL,
  `process_time` int(11) default '0',
  `pay_zfb` varchar(100) default NULL,
  `pay_cft` varchar(100) default NULL,
  `pay_bank` text,
  `pay_type` tinyint(4) default '0',
  PRIMARY KEY  (`withdraw_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_withdraw
-- ----------------------------

-- ----------------------------
-- Table structure for `keke_witkey_work`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_work`;
CREATE TABLE `keke_witkey_work` (
  `work_id` int(11) NOT NULL auto_increment,
  `task_id` int(11) default '0',
  `uid` int(11) default '0',
  `username` char(50) default NULL,
  `work_title` varchar(100) default NULL,
  `work_desc` text,
  `work_file` varchar(100) default NULL,
  `work_pic` varchar(100) default NULL,
  `work_time` int(11) default '0',
  `hide_work` int(11) default NULL,
  `vote_num` int(11) unsigned default '0',
  `work_status` int(11) default '0',
  PRIMARY KEY  (`work_id`),
  KEY `work_id` (`work_id`),
  KEY `task_id` (`task_id`),
  KEY `uid` (`uid`),
  KEY `work_status` (`work_status`),
  KEY `work_time` (`work_time`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_work
-- ----------------------------
INSERT INTO keke_witkey_work VALUES ('48', '111', '38', 'jesomo', null, '<p>哈哈，来逛逛~</p>', null, null, '1289983463', '0', '0', '0');
INSERT INTO keke_witkey_work VALUES ('49', '95', '38', 'jesomo', null, '希望我能获奖~', null, null, '1289983588', '0', '0', '0');
INSERT INTO keke_witkey_work VALUES ('50', '117', '39', '王大毛', null, '<br /><a href=\"data/uploads/2010/11/17/319174ce39687a360b.rar\" target=\"_blank\">10.8patch.rar</a>', null, null, '1289983626', '0', '0', '0');
INSERT INTO keke_witkey_work VALUES ('51', '95', '38', 'jesomo', null, '<p>阿斯顿飞<a href=\"undefined\" target=\"_blank\"></a></p><a href=\"data/uploads/2010/11/17/228874ce396da67c95.zip\" target=\"_blank\">123.zip</a>', null, null, '1289983708', '0', '0', '0');
INSERT INTO keke_witkey_work VALUES ('52', '104', '38', 'jesomo', null, '<p>tilence~</p>', null, null, '1289983831', '0', '0', '0');
INSERT INTO keke_witkey_work VALUES ('53', '123', '40', '李大爷', null, '我是你大爷李大爷<br />', null, null, '1289983885', '0', '0', '0');
INSERT INTO keke_witkey_work VALUES ('54', '104', '38', 'jesomo', null, '<p>岳小倩</p>', null, null, '1289983902', '0', '0', '0');

-- ----------------------------
-- Table structure for `keke_witkey_xs_task_config`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_xs_task_config`;
CREATE TABLE `keke_witkey_xs_task_config` (
  `xs_task_config_id` int(11) NOT NULL auto_increment,
  `xs_is_close` int(11) default '0',
  `audit_cash` float default '0',
  `is_auto_adjourn` int(11) default '0',
  `adjourn_day` int(11) default '0',
  `is_open_prom` int(11) default '0',
  `vip_task_istop` int(11) default '0',
  `vip_work_istop` int(11) default '0',
  `vip_hidden_work` int(11) default '0',
  `vip_recommend` int(11) default '0',
  `deduct_scale` varchar(255) default NULL,
  `defeated_money` int(11) default '0',
  `is_comment` int(11) default '0',
  `task_min_cash` float default '0',
  `vote_limit_time` int(11) default '0',
  `show_limit_time` int(11) default '0',
  `reg_vote_limit_time` int(11) default '0',
  `on_time` int(11) default '0',
  PRIMARY KEY  (`xs_task_config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_xs_task_config
-- ----------------------------
INSERT INTO keke_witkey_xs_task_config VALUES ('1', '2', '400.5', '1', '5', '1', '2', '2', '2', '2', '20', '2', '1', '100', '1', '4', '1', '1289859512');

-- ----------------------------
-- Table structure for `keke_witkey_zb_task_config`
-- ----------------------------
DROP TABLE IF EXISTS `keke_witkey_zb_task_config`;
CREATE TABLE `keke_witkey_zb_task_config` (
  `zb_config_id` int(11) NOT NULL auto_increment,
  `is_open_zb` int(11) default '0',
  `zb_fees` float default '0',
  `zb_audit` int(11) default '0',
  `vip_task_istop` int(11) default '0',
  `vip_sign_istop` int(11) default '0',
  `zb_max_time` int(11) default '0',
  `on_time` int(11) default '0',
  PRIMARY KEY  (`zb_config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_zb_task_config
-- ----------------------------
INSERT INTO keke_witkey_zb_task_config VALUES ('1', '1', '50', '2', '1', '1', '30', '1289859776');

