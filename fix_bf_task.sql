ALTER TABLE bf_task ADD COLUMN shareimage  varchar(255) null  COMMENT '分享图' AFTER share;
ALTER TABLE bf_task MODIFY pinimage varchar(255) NULL;
ALTER TABLE  `bf_log` ADD  `fabudian` INT NULL DEFAULT NULL AFTER  `val` COMMENT  '麦点';
ALTER TABLE  `bf_log` ADD  `tasktype` INT( 3 ) NOT NULL AFTER  `fabudian` COMMENT  '任务类型';
ALTER TABLE  `bf_log` ADD  `totalmoney` INT NULL DEFAULT NULL AFTER  `fabudian` COMMENT  '存款';