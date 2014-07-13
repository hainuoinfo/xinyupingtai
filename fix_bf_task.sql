ALTER TABLE bf_task ADD COLUMN shareimage  varchar(255) null  COMMENT '分享图' AFTER share;
ALTER TABLE bf_task MODIFY pinimage varchar(255) NULL;
ALTER TABLE  `bf_log` ADD  `fabudian`  float(11,3) NOT NULL DEFAULT '0.00000'    COMMENT  '麦点' AFTER  `val`;
ALTER TABLE  `bf_log` ADD  `tasktype` smallint NOT NULL DEFAULT '0.00000'   COMMENT  '任务类型' AFTER  `fabudian` ;
ALTER TABLE  `bf_log` ADD  `totalmoney` float(11,3) NOT NULL DEFAULT '0.00000'   COMMENT  '存款' AFTER  `fabudian`;
ALTER TABLE `bf_log` ADD `totalcredits` float(11,3) NOT NULL DEFAULT '0.00000' COMMENT '总积分数' AFTER `fabudian` ;
ALTER TABLE `bf_task` ADD `photourl` varchar(255) null COMMENT '来路任务图片地址' AFTER `itemurl`;
####清理数据库，将系统初始化
UPDATE  `bf_user_groups` SET  `users` =  '0';
UPDATE  `bf_user_groups` SET  `users` =  '1' WHERE  `bf_user_groups`.`id` =3;
TRUNCATE TABLE `bf_members`;
TRUNCATE TABLE  `bf_log`;
TRUNCATE TABLE  `bf_ensure_log`;
TRUNCATE TABLE  `bf_log_flow_vip`;
TRUNCATE TABLE  `bf_log_member`;
TRUNCATE TABLE  `bf_log_vip`;
TRUNCATE TABLE  `bf_memberconfigs`;
TRUNCATE TABLE  `bf_memberfields`;
TRUNCATE TABLE  `bf_buyers`;
TRUNCATE TABLE  `bf_top_buyer`;
TRUNCATE TABLE  `bf_membertask`;
TRUNCATE TABLE  `bf_task`;
TRUNCATE TABLE  `bf_taskshops`;
TRUNCATE TABLE  `bf_task_collect`;
TRUNCATE TABLE  `bf_task_collects`;
TRUNCATE TABLE  `bf_task_log`;
TRUNCATE TABLE  `bf_task_reflow_log`;
TRUNCATE TABLE  `bf_task_reflow_tpl`;
TRUNCATE TABLE  `bf_task_tpl`;
TRUNCATE TABLE  `bf_tyro_task_list`;
TRUNCATE TABLE  `bf_blacks`;
TRUNCATE TABLE  `bf_card`;
TRUNCATE TABLE  `bf_credits`;
TRUNCATE TABLE  `bf_from` ;
TRUNCATE TABLE  `bf_kefu_review`;
TRUNCATE TABLE  `bf_kill`;
TRUNCATE TABLE  `bf_log_exchange`;
TRUNCATE TABLE  `bf_memberlog`;
TRUNCATE TABLE  `bf_message_log`;
TRUNCATE TABLE  `bf_moderator`;
TRUNCATE TABLE  `bf_msg`;
TRUNCATE TABLE  `bf_pwd2_log`;
TRUNCATE TABLE  `bf_pwd_log`;
TRUNCATE TABLE  `bf_rcard`;
TRUNCATE TABLE  `bf_sellers`;
TRUNCATE TABLE  `bf_sms`;
TRUNCATE TABLE  `bf_tie_account` ;#原始数据type均为alipay
TRUNCATE TABLE  `bf_topup`;
TRUNCATE TABLE  `bf_top_credit`;
TRUNCATE TABLE  `bf_top_seller`;
TRUNCATE TABLE  `bf_top_spread`;
TRUNCATE TABLE  `bf_vcode_log`;
INSERT INTO `bf_members` VALUES ('3', '952c5e4fe106d5f8a08df8809e0348b9', '3', '0', '美乐管理员', '0c564666608fa4d9355b5421587a811c', '0c564666608fa4d9355b5421587a811c', '阿江', '373718549', '373718549@qq.com', '13982017238', '2', '河北省秦皇岛市海港区迎宾路天洋新城1号1单元602', '0', '5', '3', '0', '10', '0', '10', '0', '', 'e9bb48', '1299826011', '2130706433', '1360043711', '3084473953', '1', '17', '0', '0', '0', '1', '0');

## 清理结束

ALTER TABLE `bf_kill` ADD `updatetime` timestamp null COMMENT '上次更新时间' AFTER `name`;//自动初始化秒杀麦点
#ALTER TABLE bf_kill MODIFY  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP COMMENT '上次更新时间';
/* 2014年7月13日修正 */
ALTER TABLE bf_task ADD COLUMN `isFMaxBTSCount` int(3) null COMMENT '限制接手人被投诉次数' after `FMaxBTSCount`;//发布任务
ALTER TABLE bf_task CHANGE scorelvl scoreLvl int;