ALTER TABLE bf_task ADD COLUMN shareimage  varchar(255) null  COMMENT '分享图' AFTER share;
ALTER TABLE bf_task MODIFY pinimage varchar(255) NULL;
ALTER TABLE  `bf_log` ADD  `fabudian`  float(11,5) NOT NULL DEFAULT '0.00000'    COMMENT  '麦点' AFTER  `val`;
ALTER TABLE  `bf_log` ADD  `tasktype` float(11,5) NOT NULL DEFAULT '0.00000'   COMMENT  '任务类型' AFTER  `fabudian` ;
ALTER TABLE  `bf_log` ADD  `totalmoney` float(11,5) NOT NULL DEFAULT '0.00000'   COMMENT  '存款' AFTER  `fabudian`;
ALTER TABLE `bf_log` ADD `totalcredits` float(11,5) NOT NULL DEFAULT '0.00000' COMMENT '总积分数' AFTER `fabudian` ;

