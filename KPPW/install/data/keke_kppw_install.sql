

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
INSERT INTO keke_witkey_ad VALUES ('7', '2', '人才广告', 'data/uploads/2010/10/30/92724ccbf84515aa5.gif', '7天', '', null, '1288435781', '1288435781', null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('8', '2', '人才广告', 'data/uploads/2010/10/30/226834ccbf82fa5afe.jpg', '托管', '', null, '1288435759', '1288435759', null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('9', '2', '人才广告', 'data/uploads/2010/10/30/257704ccbf81853b19.jpg', '华山论剑', '', null, '1288435736', '1288435736', null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('10', '2', '商城幻灯', 'data/uploads/2010/10/09/97304cafb6817afef.jpg', '模板设计大赛', '#', null, '1286583937', null, null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('11', '2', '商城幻灯', 'data/uploads/2010/10/09/315074cafb6a3356f1.jpg', '中秋节形象创作大赛', '#', null, '1286583981', '1286583981', null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('12', '2', '商城幻灯', 'data/uploads/2010/10/09/134354cafb6ca12c3e.gif', '团购网，如何让人恋上你', '#', null, '1286584010', null, null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('13', '2', '商城幻灯', 'data/uploads/2010/10/09/6644cafb6e612b08.jpg', '秀出你的创意婚礼', '#', null, '1286584038', null, null, null, '0', '', '');
INSERT INTO keke_witkey_ad VALUES ('104', '2', '商城导购1', 'data/uploads/2010/10/09/77084cafd0dc0d792.png', '', '#', null, '1286590684', null, null, null, '0', '240', '80');
INSERT INTO keke_witkey_ad VALUES ('105', '2', '商城导购2', 'data/uploads/2010/10/09/325854cafd2056af8b.png', '', '#', null, '1286590981', null, null, null, '0', '240', '80');
INSERT INTO keke_witkey_ad VALUES ('106', '2', '商城导购3', 'data/uploads/2010/10/09/25974cafd21ae8da8.png', '', '#', null, '1286591002', null, null, null, '0', '240', '80');

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
) ENGINE=MyISAM AUTO_INCREMENT=1133 DEFAULT CHARSET=utf8;

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
INSERT INTO keke_witkey_article VALUES ('1126', '135', '1', '', '忘记登录密码怎么办？', '', '', '忘记密码可在“登录”页面，（图1）<p><img height=\"290\" src=\"data/uploads/2010/10/19/177364cbd06f876cc4.jpg\" width=\"491\" alt=\"\" /></p><p>点击“忘记密码？” 即可以看到输入您的用户名和您已经绑定邮箱地址，然后点击“请立即发送密码重置邮件”按钮，系统会发一个密码重置邮件到您的认证邮箱。<br />&nbsp;收到邮件后，请立即点击邮件内的链接至专属页面并重新设置您的新登录密码。<br /></p>', '0', null, null, null, '0', '1', '0', '1287456545', '1');
INSERT INTO keke_witkey_article VALUES ('1127', '135', '1', '', '忘记用户名怎么办？', '', '', '<span style=\"font-family:Times New Roman;font-size:small;\">请联系客服，并尽可能的提供您当时注册时留下的信息，包括注册邮箱、真实姓名、身份证号、银行卡号。如果有以上信息有注册记录，客服会帮您找回用户名。</span>', '0', null, null, null, '0', '1', '0', '1287456625', '1');
INSERT INTO keke_witkey_article VALUES ('1128', '200', '1', '', '关于我们', '', '', 'XXXX网是XXXXXX独家运营的网站平台，是中国最诚信、最专业的威客工作者在线工作平台，知识成果、创意产业成果征集（招标）交易平台。XXXXX本着让知识和财富快速流通、让时间和报酬等比交换的原则，致力于打造最具规范运营保障的知识成果、创意成果、劳务技能在线交易市场。凡是一切可数字化转换的劳动成果或服务都可在XXXXX网平台上完成交易。<br /><br /><div align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;XXXXX从XXXX年X月成立以来，汇聚了来XXXXX等多个行业领域的上百万专业工作者会员，他们凭借自己的专业知识、成果创作、服务技能活跃在XXXX，为满足企业、单位或个人的各种成果需求提供更多更好的解决方案。<br /><br />&nbsp;&nbsp;&nbsp;XXXXX没有任何门槛，只要您有能力、知识和创意智慧，都能在XXXXXXX的平台上充分体现价值；把您的富裕时间和劳动成果进行交易，拓展您的工作方式和报酬获得渠道，是让您充分发挥潜力、展示才华、让您成功的地方！<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 信誉至上、诚信为本、服务用户、保障权益是我们的运营宗旨，真正为您营造一个公平、公正、公开的威客服务平台，全力缔造互联网社会工作方式的革命。<br /><br /></div><p>&nbsp;&nbsp;&nbsp;&nbsp; xxxx方指定网址：</p>', '0', null, null, null, '0', '1', '0', '1289616474', '0');
INSERT INTO keke_witkey_article VALUES ('1129', '200', '1', '', '免责声明', '', '', '1、本网站发布悬赏任务、技术项目转让，其版权均归原作者所有，内容必须真实合法，本网站不负任何责任。<br /><br />2、其他任何媒体、网站或个人从本网下载使用，须自负版权等法律责任，本网站不负任何责任。<br /><br />3、本网站刊发、转载文章，版权归原作者所有，仅代表本人的观点和看法，文责自负，本网站不负任何责任。<br /><br />4、当本网站以链接形式推荐其他网站内容时，本网站不保证这些网站或资源的可用性负责、真实性、合法性。<br /><br />5、对于任何因使用链接的其他网站所造成之个人资料泄露及由此而导致的任何法律争议和后果，本网站不负任何责任。<br /><br />6、由于与本网站链接的其它网站所造成之个人资料泄露及由此而导致的任何法律争议和后果，本网站不负任何责任。<br /><br />7、任何单位或个人认为通过本站的内容可能涉嫌侵犯其合法权益，应该及时向本站管理员书面反馈，并提供身份证明、权属证明及详细侵权情况证明，我们在收到上述法律文件后，将会尽快安排处理。<br />', '0', null, null, null, '0', '1', '0', '1289616432', '0');
INSERT INTO keke_witkey_article VALUES ('1130', '200', '1', '', '支付方式', '', '', '<p><strong><span style=\"font-size:medium;color:#ff0000;\">支付方式一：银行汇款</span></strong></p><p><strong>开 户 行：XXXXXXX银行　　帐 号：000-000-000-000</strong></p><p>注：开户行所在城市为：xxxxx&nbsp; .....</p><p>在线QQ：xxxxxxxx、xxxxxxx</p><p>联系电话：027-0000000、00000000、000000、000000</p><p>付款后请及时通知我们，请注明所汇银行、金额、您在威客的用户名或者所发项目名称。</p><p>企业如需开据发票，请把公司名称、地址、邮编等相关信息发至邮箱（<a href=\"mailto:xxxx@xxx.com\">xxxx@xxx.com</a>）,费用另计。 <br /><br /><strong><span style=\"font-size:medium;color:#ff0000;\"></span></strong></p><p><strong><span style=\"font-size:medium;color:#ff0000;\">支付方式二：通过财付通付款</span></strong></p><p><span style=\"font-family:Verdana;\"><strong>如何通过财付通预付赏金？</strong></span></p><p>&nbsp;</p>', '0', null, null, null, '0', '1', '0', '1289616448', '0');
INSERT INTO keke_witkey_article VALUES ('1131', '200', '1', '', '联系方式', '', '', '<strong>热线电话：</strong><br />联系电话：00000000<br />传真：000-00000000<br /><br /><strong>商务合作：</strong><br />Tel：000-0000000&nbsp; <br />Email：<a href=\"mailto:00@00000.com\">00@00000.com</a><br /><br /><strong>新闻咨询</strong><br />00000000000<br />新闻联络人:000<br />QQ：00000000<br />MSN： <a href=\"mailto:0000000000@000.com\">0000000000@000.com</a><br />Email：<a href=\"mailto:000000@0000.com\">000000@0000.com</a><br /><br /><strong>人才招聘</strong><br />电话：0000000<br />Email：<a href=\"mailto:000@000000.com\">000@000000.com</a><br />QQ:0000000000<br /><br /><strong>公司地址：</strong><br />00市00区00000000大厦00楼<br />邮政编码：000000<br />', '0', null, null, null, '0', '1', '0', '1289616497', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_comment
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_favorite
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_feed
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_file
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=320 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_finance
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_link
-- ----------------------------
INSERT INTO keke_witkey_link VALUES ('31', '1', 'PHPCLUB', 'http://www.phpclub.cn', '0', '0', '1', '1277375572', null);
INSERT INTO keke_witkey_link VALUES ('32', '1', '客客族', 'http://www.kekezu.com', '', '0', '1', '1278558617', null);
INSERT INTO keke_witkey_link VALUES ('33', '4', 'phpclub', 'http://www.phpclub.com', null, null, null, null, '15');

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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_member
-- ----------------------------
--INSERT INTO keke_witkey_member VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com');

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
) ENGINE=MyISAM AUTO_INCREMENT=253 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_message
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_pay
-- ----------------------------

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
INSERT INTO keke_witkey_rule VALUES ('288', 'taskpub_1', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('289', 'tasksign_1', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('290', 'taskwork_1', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('291', 'taskcomment_1', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('292', 'taskvote_1', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('293', 'tasksettop_1', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('294', 'tasksearch_1', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('295', 'workhide_1', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('296', 'taskrecommand_1', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('297', 'tasknotice_1', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('298', 'taskfav_2', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('299', 'taskjoin_6', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('300', 'taskwork_6', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('301', 'taskcomment_6', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('302', 'infoview_6', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('303', 'taskdelay_6', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('304', 'tasksettop_6', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('305', 'tasksearch_6', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('306', 'workhide_6', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('307', 'tasknotice_6', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('308', 'taskfav_2', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('309', 'taskfav_2', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('310', 'taskfav_2', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('311', 'taskfav_2', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('312', 'taskfav_2', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('313', 'taskpub_1', 'score_11', '0');
INSERT INTO keke_witkey_rule VALUES ('314', 'tasksign_1', 'score_11', '0');
INSERT INTO keke_witkey_rule VALUES ('315', 'taskwork_1', 'score_11', '0');
INSERT INTO keke_witkey_rule VALUES ('316', 'taskcomment_1', 'score_11', '0');
INSERT INTO keke_witkey_rule VALUES ('317', 'taskvote_1', 'score_11', '0');
INSERT INTO keke_witkey_rule VALUES ('318', 'tasksettop_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('319', 'tasksearch_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('320', 'workhide_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('321', 'taskrecommand_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('322', 'tasknotice_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('323', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('324', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('325', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('326', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('327', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('328', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('329', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('330', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('331', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('332', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('333', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('334', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('335', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('336', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('337', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('338', 'taskfav_1', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('339', 'taskfav_2', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('340', 'taskfav_2', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('341', 'taskfav_2', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('342', 'taskfav_2', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('343', 'taskfav_2', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('344', 'taskfav_2', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('345', 'taskpub_2', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('346', 'taskbid_2', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('347', 'taskcomment_2', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('348', 'taskfav_2', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('349', 'taskpub_6', 'score_11', '0');
INSERT INTO keke_witkey_rule VALUES ('350', 'personshop_create', 'score_11', '-1');
INSERT INTO keke_witkey_rule VALUES ('351', 'enterpriseshop_create', 'score_11', '0');
INSERT INTO keke_witkey_rule VALUES ('352', 'service_allow', 'score_11', '0');
INSERT INTO keke_witkey_rule VALUES ('353', 'studio_create', 'score_11', '0');
INSERT INTO keke_witkey_rule VALUES ('354', 'studio_join', 'score_11', '0');
INSERT INTO keke_witkey_rule VALUES ('355', 'taskfav_1', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('356', 'taskpub_2', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('357', 'taskbid_2', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('358', 'taskcomment_2', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('359', 'taskfav_2', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('360', 'taskpub_6', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('361', 'personshop_create', 'score_1', '-1');
INSERT INTO keke_witkey_rule VALUES ('362', 'enterpriseshop_create', 'score_1', '-1');
INSERT INTO keke_witkey_rule VALUES ('363', 'service_allow', 'score_1', '-1');
INSERT INTO keke_witkey_rule VALUES ('364', 'studio_create', 'score_1', '0');
INSERT INTO keke_witkey_rule VALUES ('365', 'studio_join', 'score_1', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=549 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_score_log
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_service
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_service_order
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_service_order_detail
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop_case
-- ----------------------------

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
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop_cus_cate
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop_member
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop_menu
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop_tpl_econfig
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_shop_tpl_pconfig
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_sign
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_space
-- ----------------------------
--INSERT INTO keke_witkey_space VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', null, '2', '1', '1', null, '男', null, null, '山东,滨州', '', '1285804800', '55555', null, null, '23423434', '232323@hotmail.com', '234234234', '234234234234', '234234234234', '11', '5,6,0', '很杀很杀', '很杀很杀', '1283755726', null, null, '0.00', '2552.50', '0', null, null, '0', '76', '0', '0', '0', '0', '1314321457', 'sdf@das.zxc', '', '所属银行:\r\n银行帐号:\r\n开户人姓名:', '747', '50', '0', '100', null, '5', '1', null, null, null, null, '1289962763', null);

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
) ENGINE=MyISAM AUTO_INCREMENT=145 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of keke_witkey_system_log
-- ----------------------------
INSERT INTO keke_witkey_system_log VALUES ('144', '0', '1', 'admin', null, 'admin2010-11-17 19:45:02登陆系统', '192.168.1.100', '1289994302');

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
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_task
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keke_witkey_work
-- ----------------------------

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


