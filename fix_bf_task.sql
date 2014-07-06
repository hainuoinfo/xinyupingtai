ALTER TABLE bf_task ADD COLUMN shareimage  varchar(255) null  COMMENT '分享图' AFTER share;
ALTER TABLE bf_task MODIFY pinimage varchar(255) NULL;
ALTER TABLE  `bf_log` ADD  `fabudian` INT NULL DEFAULT NULL   COMMENT  '麦点' AFTER  `val`;
ALTER TABLE  `bf_log` ADD  `tasktype` INT( 3 ) NOT NULL  COMMENT  '任务类型' AFTER  `fabudian` ;
ALTER TABLE  `bf_log` ADD  `totalmoney` INT NULL DEFAULT NULL   COMMENT  '存款' AFTER  `fabudian`;
ALTER TABLE `bf_log` ADD `totalcredits` INT NOT NULL DEFAULT '0' COMMENT '总积分数' AFTER `fabudian` ;