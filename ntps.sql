/*
Navicat MySQL Data Transfer

Source Server         : 127
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : ntps

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-10-12 15:34:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ntp_adv`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_adv`;
CREATE TABLE `ntp_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `position` varchar(10) DEFAULT NULL COMMENT '广告位置',
  `page` varchar(100) DEFAULT NULL COMMENT '广告归属页面',
  `adv_name` varchar(50) DEFAULT NULL COMMENT '广告位名称',
  `wid` int(4) DEFAULT NULL,
  `height` int(4) DEFAULT NULL,
  `extend_file` varchar(50) DEFAULT NULL COMMENT '存放广告的文件名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_adv
-- ----------------------------
INSERT INTO `ntp_adv` VALUES ('1', null, 'A', 'index/index', '轮播banner', '1903', '440', '');
INSERT INTO `ntp_adv` VALUES ('2', null, 'B', 'index/index', '资讯广告', '900', '700', '');
INSERT INTO `ntp_adv` VALUES ('4', null, 'A', 'about_us', '关于我们广告', '457', '305', '');

-- ----------------------------
-- Table structure for `ntp_adv_pic`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_adv_pic`;
CREATE TABLE `ntp_adv_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adv_id` int(11) NOT NULL DEFAULT '0' COMMENT '广告位置id',
  `pic_id` int(11) NOT NULL DEFAULT '0' COMMENT '图片id',
  `create_at` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `title` varchar(100) DEFAULT NULL COMMENT '图片标题',
  `des` varchar(255) DEFAULT NULL COMMENT '图片描述',
  `link` varchar(50) DEFAULT NULL COMMENT '链接',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_adv_pic
-- ----------------------------
INSERT INTO `ntp_adv_pic` VALUES ('8', '1', '130', '1504170997', 'tu3', 'hahahahahahah ', 'https://www.baidu.com');
INSERT INTO `ntp_adv_pic` VALUES ('7', '1', '128', '1504170596', '图2', '哈哈哈哈哈', 'https://www.baidu.com');
INSERT INTO `ntp_adv_pic` VALUES ('6', '1', '127', '1504170570', '图1', '哈哈哈哈哈', 'https://www.baidu.com');
INSERT INTO `ntp_adv_pic` VALUES ('9', '2', '134', '1504234252', '认识世界', '从这里开始', '');
INSERT INTO `ntp_adv_pic` VALUES ('10', '4', '148', '1504516518', '哈哈哈哈', '山东快书电脑卡', '');
INSERT INTO `ntp_adv_pic` VALUES ('11', '4', '149', '1504516641', '梵蒂冈地方', '太突然', '');
INSERT INTO `ntp_adv_pic` VALUES ('12', '4', '150', '1504516666', '东方闪电很反感', '是个风格', '');

-- ----------------------------
-- Table structure for `ntp_article`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_article`;
CREATE TABLE `ntp_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT '文章标题',
  `keywords` varchar(100) DEFAULT NULL COMMENT '关键字',
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `cate_id` int(11) DEFAULT NULL COMMENT '所属分类',
  `des` varchar(255) DEFAULT NULL COMMENT '描述',
  `content` text COMMENT '内容',
  `cover_id` int(5) DEFAULT NULL COMMENT '封面图',
  `brand_id` int(6) DEFAULT NULL COMMENT '品牌id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_article
-- ----------------------------
INSERT INTO `ntp_article` VALUES ('18', '梵蒂冈地方', '', '1504660813', '27', '发过的', '<p><br></p>', '70', null);
INSERT INTO `ntp_article` VALUES ('4', '经营范围特广', '', '1504165501', '16', '那是相当的广啊', '<p><br></p>', '96', null);
INSERT INTO `ntp_article` VALUES ('29', '对客户特好', '', '1504166227', '16', '老好了', '', '125', null);
INSERT INTO `ntp_article` VALUES ('6', '强大，很强大，非常强大，无限强大', '', '1504172674', '17', '为什么不试试看呢，加入我们吧', '<div style=\"text-align: left;\"><font style=\"font-size: 14px;\"><span style=\"font-weight: bold;\">1.你看到的<br></span></font><font style=\"font-size: 14px;\"><span style=\"font-weight: bold;\">2.我看到的<br></span></font><font style=\"font-size: 14px;\"><span style=\"font-weight: bold;\">3.还有谁看到的<br></span></font><font style=\"font-size: 14px;\"><span style=\"font-weight: bold;\">。。。。</span></font><br></div>', '131', null);
INSERT INTO `ntp_article` VALUES ('7', '联系我们', '', '1504578133', '20', '手把手教学，让你知道怎么联系我们', '', '132', null);
INSERT INTO `ntp_article` VALUES ('8', '加入我们', '', '1504578153', '22', '加入我们，让你赢在起点，赚到疯狂', '', '133', null);
INSERT INTO `ntp_article` VALUES ('9', '邮递规则', '', '1504578173', '21', '让你读懂邮递规则，读懂女人', '<p><br></p>', '61', null);
INSERT INTO `ntp_article` VALUES ('10', '售后', '', '1504578192', '22', '售后让你找到托付一生的感觉', '<p><br></p>', '62', null);
INSERT INTO `ntp_article` VALUES ('11', '我们的服务宗旨', '', '1504578240', '20', '为人民服务', '<p>fdggjvjhkgjfdfhg<br></p>', '63', null);
INSERT INTO `ntp_article` VALUES ('12', '关于我们', '', '1504578254', '20', '集团，跨省市，跨国，跨星球，跨星系。。。。。', '<p>三个地方肯定看了更没法打是的法规记得发货客服对方是个好简单快乐是你得分机会代课老师到疯狂还记得付款了呢对方更好看了你的反馈</p><p>的双丰收的对方考虑是你俩说的对方说你的看法和能力康师傅还房贷呢纳斯达克考虑对方很拉风非电饭锅工会经费第三方光辉时的法国和地方<br></p>', '64', null);
INSERT INTO `ntp_article` VALUES ('13', '我们发布新产品啦', '', '1504660791', '26', '你值得拥有，不再烦恼', '我就是那天上最美的云彩，叫你弄下来。。。。<br>', '65', null);
INSERT INTO `ntp_article` VALUES ('28', '种类特多', '', '1504166181', '16', '那就是星星啊', '', '124', null);
INSERT INTO `ntp_article` VALUES ('27', '质量特优', '', '1504166092', '16', '那是相当的优啊', '', '123', null);
INSERT INTO `ntp_article` VALUES ('25', '速度特快', '', '1504165967', '16', '那是相当的快啊', '', '121', null);
INSERT INTO `ntp_article` VALUES ('19', 'sdijgd', '', '1504660826', '26', 'jsaj', '<p><br></p>', '77', null);
INSERT INTO `ntp_article` VALUES ('20', 'sdijgd', '', '1504660842', '28', 'jsaj', '<p><br></p>', '78', null);
INSERT INTO `ntp_article` VALUES ('21', 'sdijgd', '', '1504661137', '26', 'jsaj', '<p><br></p>', '79', null);
INSERT INTO `ntp_article` VALUES ('22', 'sdijgd', '', '1504661148', '27', 'jsaj', '<p><br></p>', '80', null);
INSERT INTO `ntp_article` VALUES ('23', 'sdijgd', '', '1504661161', '26', 'jsaj', '<p><br></p>', '81', null);
INSERT INTO `ntp_article` VALUES ('24', 'sdijgd', '', '1504661171', '27', 'jsaj', '<p style=\"text-align: center;\"><span style=\"font-weight: bold;\">花好月圆</span></p><p style=\"text-align: center;\"><img src=\"/upload/2017/08/29/2017-08-29-01-14-52-59a4c00cedc45.jpg\" style=\"width: 500px;\"><br></p>', '82', null);
INSERT INTO `ntp_article` VALUES ('30', '客服温柔', '', '1504166354', '16', '那是相当的酥骨啊', '', '126', null);
INSERT INTO `ntp_article` VALUES ('31', '我们能为你 做什么', '', '1504578270', '22', '做什么的', '&nbsp;很反感发了个花开富贵讽德诵功回复多少分过阿斯蒂芬VB从打分后果发给你挂号费受到广泛的适当啥大数据时代大声道更可能是大家可能是滴是滴是滴是滴是飒飒感受撒as<br>&nbsp;大公司大锅饭的活动蝴蝶飞飞更好地改善大打工的地方郭德纲的观点四大皆空给大家记得付款<br>对方是你还是短发好看哪里是孤儿地方开始固定价格不会吧v成本或部分地方记得付款了解更健康 <br>', '147', null);
INSERT INTO `ntp_article` VALUES ('33', '融汇融资业务定义', '', '1505976672', '40', '融汇融资业务定义', '<div style=\"text-align: center;\"><font style=\"font-size: 36px;\">业务定义</font></div><div style=\"text-align: left;\"><font style=\"font-size: 36px;\"><br></font></div><div style=\"text-align: left; line-height: 1.8;\"><font style=\"font-size: 24px;\">* 我公司融资担保：是指为达到企业经营，某种投资或消费目的，在融资申请人资金不足的情况下，通过担保提升申请人的信用，达到融资的目的。简单分类：公司融资担保和个人融资担保。</font></div><div style=\"text-align: left;\"><font style=\"font-size: 36px;\"><font style=\"font-size: 24px;\">* 担保方式为<span style=\"color: rgb(255, 0, 0);\"><span style=\"background-color: inherit;\">保证、抵押、质押</span></span>。留置和定金。</font><br></font></div><br>', null, null);
INSERT INTO `ntp_article` VALUES ('34', '融汇融资业务种类', '', '1506048187', '40', '融汇融资业务种类', '<div style=\"text-align: center;\"><br></div><div style=\"text-align: left;\"><br><div style=\"text-align: center;\"><font style=\"font-size: 36px;\">业务种类<br></font></div><div style=\"text-align: left;\"><font style=\"font-size: 36px;\"><br></font></div><div style=\"text-align: left; line-height: 1.8;\"><font style=\"font-size: 24px;\">* 根据融资担保的方式分类。</font></div><font style=\"font-size: 36px;\"><font style=\"font-size: 24px;\">* </font></font><font style=\"font-size: 36px;\"><font style=\"font-size: 24px;\"><span style=\"color: rgb(255, 0, 0);\"><span class=\"stl_16 stl_08 stl_09\">间接融资担保</span></span><span class=\"stl_17 stl_08 stl_09\">，直接融资担保，</span><span style=\"color: rgb(255, 0, 0);\"><span class=\"stl_16 stl_08 stl_09\">⾮融资类担保</span></span>。</font></font></div><div style=\"text-align: left;\"><font style=\"font-size: 36px;\"><font style=\"font-size: 24px;\"><br></font></font></div><br><font style=\"font-size: 36px;\"><font style=\"font-size: 24px;\"><font style=\"font-size: 36px;\"><font style=\"font-size: 24px;\">* </font></font><font style=\"font-size: 36px;\"><font style=\"font-size: 24px;\"><span style=\"color: rgb(255, 0, 0);\"></span>间接融资担保是原来大多数融资担保公司的选择，担保公司是为客户获取银行贷款提供担保的担保人。位置：提升信用，桥梁，承担风险。<br><br>* 直接融资担保：例如：企业债券担保：为申请人依法发行企业债券提供的担保，以保证购买该企业的债券投资人的合法权益；信托计划担保：为申请人依法通过发行信托计划直接从社会募集资金而提供的担保，以保证购买该信托计划投资人的合法权益。<br><br>* 非融资类担保：<span style=\"color: rgb(255, 0, 0);\">履约保证担保，财产保全担保等</span>。<br>&nbsp; <img src=\"/upload/2017/09/22/2017-09-22-02-41-37-59c47861b6fe0.jpeg\" style=\"width: 776.25px; height: 467.434px; float: none;\"><br>* 根据贷款用途分类&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; * 根据担保期限分类<br><font style=\"font-size: 18px;\">* <span style=\"color: rgb(255, 0, 0);\"><font style=\"font-size: 18px;\">流动资金贷款担保</font></span></font><font style=\"font-size: 18px;\"><span style=\"color: rgb(255, 0, 0);\">、固定资产</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; * 临时性贷款担保（一般三个月</font><br><font style=\"font-size: 18px;\"><span style=\"color: rgb(255, 0, 0);\">投资贷款担保、汽车消费贷款</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; 内），<span style=\"color: rgb(255, 0, 0);\">短期贷款担保（一般一</span><br><span style=\"color: rgb(255, 0, 0);\">担保，开立信用证保证担保，</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style=\"color: rgb(255, 0, 0);\">年期内）</span>，中期贷款贷款（一<br>房地产开发贷款担保，设备租&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 般一年以上~三年期内）。<br>赁融资担保，房屋按揭/加按/<br>转按揭贷款担保，开具承兑汇<br>票担保等</font><br><br></font></font></font></font>', null, null);

-- ----------------------------
-- Table structure for `ntp_brand`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_brand`;
CREATE TABLE `ntp_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '品牌名称',
  `cover_id` int(6) DEFAULT NULL COMMENT '品牌封面',
  `brand_des` varchar(255) DEFAULT NULL COMMENT '品牌简介',
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `cate_id` int(11) DEFAULT '0' COMMENT '分类id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_brand
-- ----------------------------
INSERT INTO `ntp_brand` VALUES ('4', '超薄', '171', 'asfasf', '1504234575', '31');
INSERT INTO `ntp_brand` VALUES ('2', '符合法规和', '170', 'sadfa', null, '32');
INSERT INTO `ntp_brand` VALUES ('5', '透气', '172', 'asfasf', '1504234592', '32');
INSERT INTO `ntp_brand` VALUES ('6', '哈哈', '173', '哈哈哈哈', '1504234724', '31');
INSERT INTO `ntp_brand` VALUES ('7', '呼呼', '174', '呼呼呼', '1504234760', '32');

-- ----------------------------
-- Table structure for `ntp_cate`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_cate`;
CREATE TABLE `ntp_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级id',
  `title` varchar(50) DEFAULT NULL COMMENT '分类名',
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `des` varchar(255) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_cate
-- ----------------------------
INSERT INTO `ntp_cate` VALUES ('1', '0', '图片', null, '');
INSERT INTO `ntp_cate` VALUES ('2', '23', '帮助中心', null, '');
INSERT INTO `ntp_cate` VALUES ('19', '24', '无极限问答', null, '有什么问题都可以问哦');
INSERT INTO `ntp_cate` VALUES ('4', '1', '风景', null, '');
INSERT INTO `ntp_cate` VALUES ('17', '23', '我们的强大', null, '');
INSERT INTO `ntp_cate` VALUES ('25', '1', '人物', null, '');
INSERT INTO `ntp_cate` VALUES ('27', '18', '今日即讯', null, '');
INSERT INTO `ntp_cate` VALUES ('28', '18', '漫思哲念', null, '');
INSERT INTO `ntp_cate` VALUES ('18', '23', '文章资讯', null, '');
INSERT INTO `ntp_cate` VALUES ('16', '23', '我们的优势', null, '让我们荡起双桨');
INSERT INTO `ntp_cate` VALUES ('20', '2', '公司信息', null, '公司信息');
INSERT INTO `ntp_cate` VALUES ('21', '2', '物流说明', null, '物流说明');
INSERT INTO `ntp_cate` VALUES ('22', '2', '其他', null, '其他');
INSERT INTO `ntp_cate` VALUES ('23', '0', '文章', null, '');
INSERT INTO `ntp_cate` VALUES ('24', '0', '问答', null, '');
INSERT INTO `ntp_cate` VALUES ('30', '0', '品牌', null, '');
INSERT INTO `ntp_cate` VALUES ('26', '18', '随笔心情', null, '生活里指尖洒落的缕缕灿烂，记得记录。。。。');
INSERT INTO `ntp_cate` VALUES ('31', '30', '生活用品', null, '');
INSERT INTO `ntp_cate` VALUES ('32', '30', '服装', null, '');
INSERT INTO `ntp_cate` VALUES ('33', '24', '有的问答', null, '');
INSERT INTO `ntp_cate` VALUES ('34', '24', '呼哈', null, '');
INSERT INTO `ntp_cate` VALUES ('35', '24', '时代和福克斯', null, '');
INSERT INTO `ntp_cate` VALUES ('37', '23', '公司模板', null, '');
INSERT INTO `ntp_cate` VALUES ('38', '37', '融汇融资', null, '');
INSERT INTO `ntp_cate` VALUES ('40', '38', '融汇业务介绍', null, '');

-- ----------------------------
-- Table structure for `ntp_cfg`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_cfg`;
CREATE TABLE `ntp_cfg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) DEFAULT NULL COMMENT '配置名称',
  `value` varchar(255) DEFAULT NULL COMMENT '配置值',
  `name` varchar(255) DEFAULT NULL COMMENT '配置注释',
  `reate_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `pic_id` int(11) DEFAULT '0' COMMENT '图片id',
  `title` varchar(100) DEFAULT NULL COMMENT '标题',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_cfg
-- ----------------------------
INSERT INTO `ntp_cfg` VALUES ('1', 'phone', '18080885646', '电话', null, '0', null);
INSERT INTO `ntp_cfg` VALUES ('3', 'mail', '44944@sla.com', '邮箱', null, '0', '');
INSERT INTO `ntp_cfg` VALUES ('4', 'official_name', '造作港', '官网名称', null, '0', null);
INSERT INTO `ntp_cfg` VALUES ('5', 'logo', '', 'logo图', null, '129', '造作官网');
INSERT INTO `ntp_cfg` VALUES ('6', 'shop', 'https://www.baidu.com', '商城链接', null, null, '我们的商城');

-- ----------------------------
-- Table structure for `ntp_comment`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_comment`;
CREATE TABLE `ntp_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COMMENT '内容',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户',
  `praise` int(11) NOT NULL DEFAULT '0' COMMENT '赞数量',
  `tread` int(11) NOT NULL DEFAULT '0' COMMENT '踩数量',
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `art_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_comment
-- ----------------------------
INSERT INTO `ntp_comment` VALUES ('1', '啥办法决定不就是段施工监控上的感觉你的福克斯', '3', '16', '10', null, '13');
INSERT INTO `ntp_comment` VALUES ('2', '随时都能收到', '3', '1', '0', '1504686807', '18');

-- ----------------------------
-- Table structure for `ntp_frendlink`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_frendlink`;
CREATE TABLE `ntp_frendlink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `link` varchar(100) NOT NULL COMMENT '链接',
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `is_show` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0:隐藏1：显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_frendlink
-- ----------------------------
INSERT INTO `ntp_frendlink` VALUES ('1', '手机版', 'https://www.baidu.com', null, '1');
INSERT INTO `ntp_frendlink` VALUES ('3', '按时发生', 'https://www.baidu.com', '1505113501', '1');

-- ----------------------------
-- Table structure for `ntp_menu`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_menu`;
CREATE TABLE `ntp_menu` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `link` varchar(255) DEFAULT NULL COMMENT '链接',
  `pid` int(10) DEFAULT '0' COMMENT '上级id',
  `weight` int(10) DEFAULT NULL COMMENT '排序',
  `is_top` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1:导航显示0：非导航显示',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0:页面1：操作',
  `is_show` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1:显示0：隐藏',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_menu
-- ----------------------------
INSERT INTO `ntp_menu` VALUES ('1', '首页', 'http://192.168.9.155/admin', '0', null, '1', '0', '1');
INSERT INTO `ntp_menu` VALUES ('2', '菜单管理', 'http://192.168.9.155/admin/menu', '0', null, '0', '0', '1');
INSERT INTO `ntp_menu` VALUES ('4', '用户管理', 'http://192.168.9.155/admin/user', '0', null, '1', '0', '1');
INSERT INTO `ntp_menu` VALUES ('17', '图片管理', 'http://192.168.9.155/admin/picture', '0', null, '0', '0', '1');
INSERT INTO `ntp_menu` VALUES ('25', '问答管理', 'http://192.168.9.155/admin/qus_list', '0', null, '1', '0', '1');
INSERT INTO `ntp_menu` VALUES ('19', '文章管理', 'http://192.168.9.155/admin/article', '0', null, '0', '0', '1');
INSERT INTO `ntp_menu` VALUES ('20', '品牌管理', 'http://192.168.9.155/admin/brand', '0', null, '0', '0', '1');
INSERT INTO `ntp_menu` VALUES ('21', '分类管理', 'http://192.168.9.155/admin/cate', '0', null, '1', '0', '1');
INSERT INTO `ntp_menu` VALUES ('22', '导航管理', 'http://192.168.9.155/admin/navigation', '0', null, '0', '0', '1');
INSERT INTO `ntp_menu` VALUES ('23', '广告管理', 'http://192.168.9.155/admin/adv', '0', null, '0', '0', '1');
INSERT INTO `ntp_menu` VALUES ('24', '配置管理', 'http://192.168.9.155/admin/cfg', '0', null, '1', '0', '1');
INSERT INTO `ntp_menu` VALUES ('26', '我们的团队', 'http://192.168.9.155/admin/team', '0', null, '0', '0', '1');
INSERT INTO `ntp_menu` VALUES ('27', '留言管理', 'http://192.168.9.155/admin/msg', '0', null, '0', '0', '1');
INSERT INTO `ntp_menu` VALUES ('28', '友情链接', 'http://192.168.9.155/admin/frendlink', '0', null, '1', '0', '1');

-- ----------------------------
-- Table structure for `ntp_msg`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_msg`;
CREATE TABLE `ntp_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL COMMENT '姓名',
  `mail` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `cont` varchar(255) DEFAULT NULL COMMENT '内容',
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_msg
-- ----------------------------
INSERT INTO `ntp_msg` VALUES ('1', 'asdfjk', '631962523@qq.com', 'sfghjhhgfds', '1504516037');
INSERT INTO `ntp_msg` VALUES ('2', 'as是', '6665655@qq.com', 'sfsdhgjkljhgfds', '1505111206');

-- ----------------------------
-- Table structure for `ntp_navigation`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_navigation`;
CREATE TABLE `ntp_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `url` varchar(50) DEFAULT NULL COMMENT '链接',
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `weight` int(6) DEFAULT NULL COMMENT '排序',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级',
  `is_show` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_navigation
-- ----------------------------
INSERT INTO `ntp_navigation` VALUES ('1', '首页', 'http://192.168.9.155/', null, '99', '0', '1');
INSERT INTO `ntp_navigation` VALUES ('2', '图片', 'http://192.168.9.155/pics', null, null, '0', '0');
INSERT INTO `ntp_navigation` VALUES ('4', '文章', 'http://192.168.9.155/article', null, null, '0', '0');
INSERT INTO `ntp_navigation` VALUES ('6', '问答', 'http://192.168.9.155/question', null, null, '0', '0');
INSERT INTO `ntp_navigation` VALUES ('11', '关于我们', 'http://192.168.9.155/about_us', null, null, '10', '1');
INSERT INTO `ntp_navigation` VALUES ('8', '品牌', 'http://192.168.9.155/brand', null, null, '0', '0');
INSERT INTO `ntp_navigation` VALUES ('10', '帮助', 'help', null, null, '0', '1');
INSERT INTO `ntp_navigation` VALUES ('12', '联系我们', 'http://192.168.9.155/contact_us', null, null, '10', '1');
INSERT INTO `ntp_navigation` VALUES ('13', '公司1', '', null, '2', '0', '1');
INSERT INTO `ntp_navigation` VALUES ('14', '公司2', 'http://192.168.9.155/', null, '3', '0', '1');
INSERT INTO `ntp_navigation` VALUES ('15', '公司3', '', null, '4', '0', '1');
INSERT INTO `ntp_navigation` VALUES ('16', '公司4', '', null, '5', '0', '1');
INSERT INTO `ntp_navigation` VALUES ('17', '业务定义', 'http://192.168.9.155/company/33', null, null, '13', '1');
INSERT INTO `ntp_navigation` VALUES ('18', '业务种类', 'http://192.168.9.155/company/34', null, null, '13', '1');
INSERT INTO `ntp_navigation` VALUES ('19', '融汇业务', 'http://192.168.9.155/company/35', null, null, '13', '1');

-- ----------------------------
-- Table structure for `ntp_our_team`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_our_team`;
CREATE TABLE `ntp_our_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL COMMENT '名称',
  `job_name` varchar(50) DEFAULT NULL COMMENT '职位，名称',
  `des` varchar(255) DEFAULT NULL COMMENT '简介',
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `head_img` int(11) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_our_team
-- ----------------------------
INSERT INTO `ntp_our_team` VALUES ('1', '咖啡', '金黄色的时代', '大幅度隔离开关面对对方考虑好地方发个发个发个更好更好', null, '146');

-- ----------------------------
-- Table structure for `ntp_pictures`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_pictures`;
CREATE TABLE `ntp_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_at` int(10) DEFAULT NULL COMMENT '修改时间',
  `true_path` varchar(100) NOT NULL COMMENT '地址',
  `source` varchar(50) DEFAULT NULL COMMENT '图片来源',
  `type` varchar(20) DEFAULT NULL COMMENT '图片类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_pictures
-- ----------------------------
INSERT INTO `ntp_pictures` VALUES ('70', '1503908280', null, '/upload/2017/08/28/2017-08-28-08-18-00-59a3d1b8baf69.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('23', '1503385348', null, '/upload/2017/08/22/4fa23d8d84a70a8fda1b5c26b0d84e34.jpg', 'admin/pic', null);
INSERT INTO `ntp_pictures` VALUES ('27', '1503385395', null, '/upload/2017/08/22/pm0053-2266ht.jpg', 'admin/pic', null);
INSERT INTO `ntp_pictures` VALUES ('35', '1503558268', null, '/upload/2017/08/24/2017-08-24-07-04-28-599e7a7cd2d21.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('36', '1503558272', null, '/upload/2017/08/24/2017-08-24-07-04-32-599e7a8008e85.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('37', '1503558283', null, '/upload/2017/08/24/2017-08-24-07-04-43-599e7a8b7ac67.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('38', '1503558317', null, '/upload/2017/08/24/2017-08-24-07-05-17-599e7aad8804d.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('39', '1503558344', null, '/upload/2017/08/24/2017-08-24-07-05-44-599e7ac855a3e.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('40', '1503558370', null, '/upload/2017/08/24/2017-08-24-07-06-10-599e7ae2bb438.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('41', '1503558412', null, '/upload/2017/08/24/2017-08-24-07-06-52-599e7b0c2e44a.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('42', '1503558415', null, '/upload/2017/08/24/2017-08-24-07-06-55-599e7b0f1a7f7.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('43', '1503558454', null, '/upload/2017/08/24/2017-08-24-07-07-34-599e7b36324b8.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('44', '1503558489', null, '/upload/2017/08/24/2017-08-24-07-08-09-599e7b599aaa8.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('45', '1503558504', null, '/upload/2017/08/24/2017-08-24-07-08-24-599e7b6819e51.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('46', '1503558532', null, '/upload/2017/08/24/2017-08-24-07-08-52-599e7b8491788.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('47', '1503558573', null, '/upload/2017/08/24/2017-08-24-07-09-33-599e7bad43edb.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('48', '1503558622', null, '/upload/2017/08/24/2017-08-24-07-10-22-599e7bdeab04f.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('49', '1503558793', null, '/upload/2017/08/24/2017-08-24-07-13-13-599e7c8938880.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('50', '1503558840', null, '/upload/2017/08/24/2017-08-24-07-14-00-599e7cb804b88.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('51', '1503558858', null, '/upload/2017/08/24/2017-08-24-07-14-18-599e7cca126f2.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('52', '1503558878', null, '/upload/2017/08/24/2017-08-24-07-14-38-599e7cde404de.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('53', '1503558899', null, '/upload/2017/08/24/2017-08-24-07-14-59-599e7cf3a146a.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('54', '1503559046', null, '/upload/2017/08/24/2017-08-24-07-17-26-599e7d866241a.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('55', '1503559054', null, '/upload/2017/08/24/2017-08-24-07-17-34-599e7d8e31c45.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('56', '1503559475', null, '/upload/2017/08/24/2017-08-24-07-24-35-599e7f33e1915.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('57', '1503559504', null, '/upload/2017/08/24/2017-08-24-07-25-04-599e7f508f7dc.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('58', '1503559575', null, '/upload/2017/08/24/2017-08-24-07-26-15-599e7f97c637d.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('59', '1503559578', null, '/upload/2017/08/24/2017-08-24-07-26-18-599e7f9a407b4.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('60', '1503559591', null, '/upload/2017/08/24/2017-08-24-07-26-31-599e7fa7e7102.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('61', '1503564133', null, '/upload/2017/08/24/2017-08-24-08-42-13-599e916564d98.jpg', 'admin/edit_art', null);
INSERT INTO `ntp_pictures` VALUES ('62', '1503564238', null, '/upload/2017/08/24/2017-08-24-08-43-58-599e91ce007ec.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('63', '1503626816', null, '/upload/2017/08/25/2017-08-25-02-06-56-599f8640e7eb5.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('64', '1503626826', null, '/upload/2017/08/25/2017-08-25-02-07-06-599f864a885bb.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('65', '1503626829', null, '/upload/2017/08/25/2017-08-25-02-07-09-599f864d19121.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('124', '1504166181', null, '/upload/2017/08/31/2017-08-31-07-56-21-59a7c125c52cb.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('123', '1504166092', null, '/upload/2017/08/31/2017-08-31-07-54-52-59a7c0cc42390.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('139', '1504494038', null, '无法获取上传文件', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('121', '1504165967', null, '/upload/2017/08/31/2017-08-31-07-52-47-59a7c04f1f2a9.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('71', '1503909214', null, '/upload/2017/08/28/2017-08-28-08-33-34-59a3d55e456d1.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('72', '1503909384', null, '/upload/2017/08/28/2017-08-28-08-36-24-59a3d608ae9c4.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('73', '1503909408', null, '/upload/2017/08/28/2017-08-28-08-36-48-59a3d620e0a94.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('74', '1503909447', null, '/upload/2017/08/28/2017-08-28-08-37-27-59a3d64794e88.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('75', '1503910212', null, '/upload/2017/08/28/2017-08-28-08-50-12-59a3d94472b2f.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('76', '1503910235', null, '/upload/2017/08/28/2017-08-28-08-50-35-59a3d95bba6b1.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('77', '1503910317', null, '/upload/2017/08/28/2017-08-28-08-51-57-59a3d9adcb1b1.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('78', '1503910344', null, '/upload/2017/08/28/2017-08-28-08-52-24-59a3d9c8d05b5.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('79', '1503910439', null, '/upload/2017/08/28/2017-08-28-08-53-59-59a3da27132eb.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('80', '1503910567', null, '/upload/2017/08/28/2017-08-28-08-56-07-59a3daa7bebf9.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('81', '1503910613', null, '/upload/2017/08/28/2017-08-28-08-56-53-59a3dad551e6c.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('82', '1503910635', null, '/upload/2017/08/28/2017-08-28-08-57-15-59a3daeb6fd4e.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('83', '1503911327', null, '/upload/2017/08/28/2017-08-28-09-08-47-59a3dd9f4ce88.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('84', '1503911439', null, '/upload/2017/08/28/2017-08-28-09-10-39-59a3de0f065d5.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('85', '1503911450', null, '/upload/2017/08/28/2017-08-28-09-10-50-59a3de1ae23f6.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('86', '1503911545', null, '/upload/2017/08/28/2017-08-28-09-12-25-59a3de79991db.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('87', '1503911610', null, '/upload/2017/08/28/2017-08-28-09-13-30-59a3deba38daf.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('88', '1503911619', null, '/upload/2017/08/28/2017-08-28-09-13-39-59a3dec3b71a5.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('89', '1503911634', null, '/upload/2017/08/28/2017-08-28-09-13-54-59a3ded2047cb.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('90', '1503911688', null, '/upload/2017/08/28/2017-08-28-09-14-48-59a3df086fc7f.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('91', '1503911697', null, '/upload/2017/08/28/2017-08-28-09-14-57-59a3df11e8953.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('92', '1503911775', null, '/upload/2017/08/28/2017-08-28-09-16-15-59a3df5f49abd.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('93', '1503911803', null, '/upload/2017/08/28/2017-08-28-09-16-43-59a3df7b2856f.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('94', '1503911980', null, '/upload/2017/08/28/2017-08-28-09-19-40-59a3e02c5d2e4.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('95', '1503912185', null, '/upload/2017/08/28/2017-08-28-09-23-05-59a3e0f9a3085.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('96', '1503912242', null, '/upload/2017/08/28/2017-08-28-09-24-02-59a3e132a4b6c.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('102', '1503991742', null, '/upload/2017/08/29/2017-08-29-07-29-02-59a517be736ee.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('98', '1503967797', null, '/upload/2017/08/29/2017-08-29-00-49-57-59a4ba35db1d8.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('99', '1503969015', null, '/upload/2017/08/29/2017-08-29-01-10-15-59a4bef7cab57.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('100', '1503969038', null, '/upload/2017/08/29/2017-08-29-01-10-38-59a4bf0ee64f3.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('101', '1503969292', null, '/upload/2017/08/29/2017-08-29-01-14-52-59a4c00cedc45.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('103', '1503991767', null, '/upload/2017/08/29/2017-08-29-07-29-27-59a517d7ce9b5.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('104', '1503992834', null, '/upload/2017/08/29/2017-08-29-07-47-14-59a51c02e0118.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('130', '1504170997', null, '/upload/2017/08/31/2017-08-31-09-16-37-59a7d3f521a6a.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('128', '1504170596', null, '/upload/2017/08/31/2017-08-31-09-09-56-59a7d264b4c0d.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('107', '1503993314', null, '/upload/2017/08/29/2017-08-29-07-55-14-59a51de2e1319.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('127', '1504170570', null, '/upload/2017/08/31/2017-08-31-09-09-30-59a7d24a54725.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('109', '1503993394', null, '/upload/2017/08/29/2017-08-29-07-56-34-59a51e3218a7b.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('131', '1504171548', null, '/upload/2017/08/31/2017-08-31-09-25-48-59a7d61c3d372.png', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('129', '1504170930', null, '/upload/2017/08/31/2017-08-31-09-15-30-59a7d3b2a22a4.jpg', 'admin/cfg_edit', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('156', '1504749481', null, '/upload/2017/09/07/2017-09-07-01-58-01-59b0a7a9a1af5.jpg', 'admin/pic', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('153', '1504601847', null, '/upload/2017/09/05/2017-09-05-08-57-27-59ae66f77892e.png', 'admin/pic', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('152', '1504601836', null, '/upload/2017/09/05/2017-09-05-08-57-16-59ae66eceaa42.png', 'admin/pic', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('154', '1504601861', null, '/upload/2017/09/05/2017-09-05-08-57-41-59ae67058b8b1.jpg', 'admin/pic', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('125', '1504166227', null, '/upload/2017/08/31/2017-08-31-07-57-07-59a7c1536b2b9.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('126', '1504166354', null, '/upload/2017/08/31/2017-08-31-07-59-14-59a7c1d2b2877.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('132', '1504228124', null, '/upload/2017/09/01/2017-09-01-01-08-44-59a8b31cb36e0.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('133', '1504228184', null, '/upload/2017/09/01/2017-09-01-01-09-44-59a8b3585c2a5.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('134', '1504234252', null, '/upload/2017/09/01/2017-09-01-02-50-52-59a8cb0c45627.png', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('135', '1504234575', null, '/upload/2017/09/01/2017-09-01-02-56-15-59a8cc4f92f91.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('136', '1504234592', null, '/upload/2017/09/01/2017-09-01-02-56-32-59a8cc60a9ef2.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('137', '1504234724', null, '/upload/2017/09/01/2017-09-01-02-58-44-59a8cce4bc0df.png', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('138', '1504234760', null, '/upload/2017/09/01/2017-09-01-02-59-19-59a8cd07f3c98.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('140', '1504494045', null, '无法获取上传文件', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('141', '1504494096', null, '/upload/2017/09/04/2017-09-04-03-01-36-59acc21045d12.png', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('142', '1504494166', null, '/upload/2017/09/04/2017-09-04-03-02-46-59acc256003c5.png', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('164', '1504836412', null, '/upload/2017/09/08/2017-09-08-02-06-52-59b1fb3c7fea7.jpg', 'change_headimg', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('144', '1504498748', null, '/upload/2017/09/04/2017-09-04-04-19-08-59acd43c5a4f4.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('146', '1504505401', null, '/upload/2017/09/04/2017-09-04-06-10-01-59acee390d0e3.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('147', '1504505889', null, '/upload/2017/09/04/2017-09-04-06-18-09-59acf021ca831.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('148', '1504516518', null, '/upload/2017/09/04/2017-09-04-09-15-18-59ad19a6d6dd3.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('149', '1504516641', null, '/upload/2017/09/04/2017-09-04-09-17-21-59ad1a219c612.jpg', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('150', '1504516666', null, '/upload/2017/09/04/2017-09-04-09-17-46-59ad1a3a67ad0.png', 'admin/edit_art', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('157', '1504836128', null, '/upload/2017/09/08/2017-09-08-02-02-08-59b1fa201de0e.png', 'change_headimg', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('158', '1504836138', null, '/upload/2017/09/08/2017-09-08-02-02-18-59b1fa2a4c010.png', 'change_headimg', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('165', '1504853072', null, '/upload/2017/09/08/2017-09-08-06-44-32-59b23c50509a5.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('166', '1504853088', null, '/upload/2017/09/08/2017-09-08-06-44-48-59b23c60cf62c.png', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('167', '1504853106', null, '/upload/2017/09/08/2017-09-08-06-45-06-59b23c72cb60c.png', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('168', '1504853311', null, '/upload/2017/09/08/2017-09-08-06-48-31-59b23d3f5b18f.png', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('169', '1504853325', null, '/upload/2017/09/08/2017-09-08-06-48-45-59b23d4d5a5a1.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('170', '1504853731', null, '/upload/2017/09/08/2017-09-08-06-55-31-59b23ee3bc254.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('171', '1504853769', null, '/upload/2017/09/08/2017-09-08-06-56-09-59b23f094ffb5.png', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('172', '1504853790', null, '/upload/2017/09/08/2017-09-08-06-56-30-59b23f1ee04a9.png', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('173', '1504853801', null, '/upload/2017/09/08/2017-09-08-06-56-41-59b23f290be93.png', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('174', '1504853811', null, '/upload/2017/09/08/2017-09-08-06-56-51-59b23f33973e4.jpg', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('175', '1505103258', null, '/upload/2017/09/11/2017-09-11-04-14-18-59b60d9a84a2a.png', 'admin/edit_brand', '非富文本');
INSERT INTO `ntp_pictures` VALUES ('176', '1505380126', null, '/upload/2017/09/14/2017-09-14-09-08-46-59ba471e130f2.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('177', '1505380139', null, '/upload/2017/09/14/2017-09-14-09-08-59-59ba472bda8a2.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('178', '1505380203', null, '/upload/2017/09/14/2017-09-14-09-10-03-59ba476b07f45.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('179', '1505380279', null, '/upload/2017/09/14/2017-09-14-09-11-19-59ba47b7295d4.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('180', '1505380289', null, '/upload/2017/09/14/2017-09-14-09-11-29-59ba47c12b492.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('181', '1505380309', null, '/upload/2017/09/14/2017-09-14-09-11-49-59ba47d5cbc66.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('182', '1505380319', null, '/upload/2017/09/14/2017-09-14-09-11-59-59ba47df741e4.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('183', '1505380327', null, '/upload/2017/09/14/2017-09-14-09-12-07-59ba47e7d4d5e.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('184', '1505380334', null, '/upload/2017/09/14/2017-09-14-09-12-14-59ba47eee15a7.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('185', '1505380341', null, '/upload/2017/09/14/2017-09-14-09-12-21-59ba47f5891c2.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('186', '1505380348', null, '/upload/2017/09/14/2017-09-14-09-12-28-59ba47fcc7c43.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('187', '1505380357', null, '/upload/2017/09/14/2017-09-14-09-12-37-59ba48052a979.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('188', '1505380363', null, '/upload/2017/09/14/2017-09-14-09-12-43-59ba480bca0f7.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('189', '1505380548', null, '/upload/2017/09/14/2017-09-14-09-15-48-59ba48c4db0c7.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('190', '1505380556', null, '/upload/2017/09/14/2017-09-14-09-15-56-59ba48cce2202.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('191', '1505380562', null, '/upload/2017/09/14/2017-09-14-09-16-02-59ba48d279a39.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('192', '1505380569', null, '/upload/2017/09/14/2017-09-14-09-16-09-59ba48d933b78.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('193', '1505380581', null, '/upload/2017/09/14/2017-09-14-09-16-21-59ba48e5749e6.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('194', '1505380593', null, '/upload/2017/09/14/2017-09-14-09-16-33-59ba48f160d4d.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('195', '1505380599', null, '/upload/2017/09/14/2017-09-14-09-16-39-59ba48f7924a4.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('196', '1505380604', null, '/upload/2017/09/14/2017-09-14-09-16-44-59ba48fce649e.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('197', '1505380610', null, '/upload/2017/09/14/2017-09-14-09-16-50-59ba4902cb215.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('198', '1505380616', null, '/upload/2017/09/14/2017-09-14-09-16-56-59ba490829314.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('199', '1505380621', null, '/upload/2017/09/14/2017-09-14-09-17-01-59ba490dea89e.jpg', 'admin/edit_art', '富文本');
INSERT INTO `ntp_pictures` VALUES ('201', '1506048097', null, '/upload/2017/09/22/2017-09-22-02-41-37-59c47861b6fe0.jpeg', 'admin/edit_art', '富文本');

-- ----------------------------
-- Table structure for `ntp_pic_shows`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_pic_shows`;
CREATE TABLE `ntp_pic_shows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_id` int(11) NOT NULL COMMENT '图片id',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `des` varchar(255) DEFAULT NULL COMMENT '描述',
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_at` int(10) DEFAULT NULL COMMENT '修改时间',
  `is_show` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1:展示2：隐藏',
  `cate_id` int(11) DEFAULT NULL COMMENT '分类id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_pic_shows
-- ----------------------------
INSERT INTO `ntp_pic_shows` VALUES ('25', '156', '梵蒂冈地方', '太突然', '1504078274', '1504749481', '1', '4');
INSERT INTO `ntp_pic_shows` VALUES ('24', '152', '添加', '描述1', '1503456334', '1504601836', '1', '25');
INSERT INTO `ntp_pic_shows` VALUES ('26', '153', '文档', '描述1', '1504078287', '1504601847', '1', '25');
INSERT INTO `ntp_pic_shows` VALUES ('27', '154', 'dhfg', '描述2', '1504161623', '1504601861', '1', '4');

-- ----------------------------
-- Table structure for `ntp_qustion`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_qustion`;
CREATE TABLE `ntp_qustion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL COMMENT '问题名称',
  `qus_des` varchar(255) DEFAULT NULL COMMENT '问题简述',
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `cate_id` int(11) DEFAULT NULL COMMENT '分类id',
  `default_asw` int(11) DEFAULT NULL COMMENT '默认回答id',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id  0为系统问题',
  `is_check` varchar(4) NOT NULL DEFAULT '0' COMMENT '0:未审核1：审核通过 -1审核未通过',
  `is_show` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1：展示0：不展示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_qustion
-- ----------------------------
INSERT INTO `ntp_qustion` VALUES ('1', '好玩吗', '再问你', null, '19', '1', '3', '0', '1');
INSERT INTO `ntp_qustion` VALUES ('4', '两只都是公的，两只都是公的，真变态，真变态。。。。', '', null, '19', '2', '3', '1', '1');
INSERT INTO `ntp_qustion` VALUES ('5', '好用不', '此产品大伙们觉得怎么样？', '1505097911', '19', null, '3', '0', '1');
INSERT INTO `ntp_qustion` VALUES ('6', '好用不', '此产品大伙们觉得怎么样？', '1505097920', '19', '0', '3', '1', '1');
INSERT INTO `ntp_qustion` VALUES ('7', '辅导费市房管局', '对方回复即可很快', '1505098886', '19', null, '3', '0', '1');

-- ----------------------------
-- Table structure for `ntp_qus_answer`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_qus_answer`;
CREATE TABLE `ntp_qus_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id 0为系统回答',
  `q_id` int(11) NOT NULL COMMENT '问题id',
  `answer` text COMMENT '回复',
  `is_check` varchar(6) NOT NULL DEFAULT '0' COMMENT '0:未审核 1审核通过 -1审核未通过',
  `create_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `is_show` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0:隐藏 1：显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_qus_answer
-- ----------------------------
INSERT INTO `ntp_qus_answer` VALUES ('1', '3', '1', 'his代付款公司计划年底房价可能付款', '1', null, '1');
INSERT INTO `ntp_qus_answer` VALUES ('2', '3', '4', '好好玩哦', '1', null, '1');
INSERT INTO `ntp_qus_answer` VALUES ('5', '3', '1', '好玩，好玩，好好玩', '1', '1505095847', '1');
INSERT INTO `ntp_qus_answer` VALUES ('6', '3', '1', '是否感受到', '0', '1505095961', '1');

-- ----------------------------
-- Table structure for `ntp_user`
-- ----------------------------
DROP TABLE IF EXISTS `ntp_user`;
CREATE TABLE `ntp_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '昵称',
  `truename` varchar(30) DEFAULT NULL COMMENT '真实姓名',
  `mail` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `mobile` varchar(12) DEFAULT NULL COMMENT '手机号',
  `is_admin` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0：非管理员用户1：管理员用户',
  `create_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_at` int(11) DEFAULT NULL COMMENT '修改时间',
  `delete_at` int(11) DEFAULT NULL COMMENT '删除时间',
  `log_time` int(11) DEFAULT NULL COMMENT '登录次数',
  `near_log` int(11) DEFAULT NULL COMMENT '最近登录时间',
  `pwd` varchar(255) NOT NULL COMMENT '密码',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0:禁用1：正常-1：删除',
  `head_img` int(11) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ntp_user
-- ----------------------------
INSERT INTO `ntp_user` VALUES ('1', 'adminer', '', '', '', '1', '0', null, null, '0', null, '$2y$10$Ufu.vzF/mxH.PkkRCROjD.sCFx1aw.v4FxEKRV0YLp3GYSTYQWevy', '1', '142');
INSERT INTO `ntp_user` VALUES ('3', 'test', '是的十多年方脑壳', '631962523@qq.com', '18080885646', '0', '0', '1505096177', null, '0', null, '$2y$10$Ufu.vzF/mxH.PkkRCROjD.sCFx1aw.v4FxEKRV0YLp3GYSTYQWevy', '1', null);
INSERT INTO `ntp_user` VALUES ('4', 'dansh', '', '6665655@qq.com', '', '0', '1504765076', null, null, null, null, '$2y$10$iKhNR3ddTRzGvteFE7LXquaUNOSenge4JuxI1Tta8ZArwrf/.3/ku', '1', '175');
