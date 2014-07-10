<?php
class task_grade{
     public static function add($tid, $uid, $grade, $remark, $isHide, $type = 0){
         global $timestamp;
         if ($type == 1){
             $remark = '系统自动好评';
             $grade = 1;
             $isHide = 0;
             }elseif ($type == 2)
             $remark = '批量评价';
         if ($task = db :: one('task', 'id,type,suid,susername,buid,busername,credit', "id='$tid'")){
             if ($task['suid'] != $uid && $task['buid'] != $uid) return '错误';
             if ($task['suid'] == $uid) $isBuyer = false;
             else $isBuyer = true;
             if ($isBuyer){
                 $fuid = $task['buid'];
                 $fusername = $task['busername'];
                 $tuid = $task['suid'];
                 $tusername = $task['susername'];
                 }else{
                 $fuid = $task['suid'];
                 $fusername = $task['susername'];
                 $tuid = $task['buid'];
                 $tusername = $task['busername'];
                 }
             if ($grade == 1) $score = 1;
             elseif ($grade == 2) $score = 0;
             else{
                 $grade = 3;
                 $score = -1;
                 }
             if ($isHide) $isHide = 1;
             else $isHide = 0;
             if ($gradeInfo = self :: get($tid, $uid)){
                 // 已经评价过的，修改
                if (db :: update('credits', array(
                            'score' => $score,
                             'isHide' => $isHide,
                             'type' => $type,
                             'remark' => $remark,
                             'timestamp' => $timestamp
                            ), "id='$gradeInfo[id]'")){
                     if ($gradeInfo['score'] != $score){
                         if ($gradeInfo['score'] == 1){
                             $lastGrade = 1;
                             }elseif ($gradeInfo['score'] == 0){
                             $lastGrade = 2;
                             }else $lastGrade = 3;
                         if ($lastGrade != $grade){
                             if ($isBuyer){
                                 $up = 'sgrade' . $grade . '=sgrade' . $grade . '+1,sgrade' . $lastGrade . '=sgrade' . $lastGrade . '-1';
                                 }else{
                                 $up = 'bgrade' . $grade . '=bgrade' . $grade . '+1,bgrade' . $lastGrade . '=bgrade' . $lastGrade . '-1';
                                 }
                             db :: update('memberfields', $up, "uid='$tuid'");
                             }
                         }
                     // db::update('task', 'credit=credit|'.($isBuyer?1:2), "id='$task[id]'");
                    if ($isBuyer){
                         $msg = '您在' . language :: get('qu' . $task['type']) . '区的任务“' . $task['id'] . '”，买家修改了评分';
                         member_base :: sendPm($task['suid'], $msg, '任务“' . $task['id'] . '”，买家修改了评分', 'out_grade');
                         member_base :: sendSms($task['suid'], $msg, 'out_grade');
                         }else{
                         $msg = '您在' . language :: get('qu' . $task['type']) . '区接的任务“' . $task['id'] . '”，卖家修改了评分';
                         member_base :: sendPm($task['buid'], $msg, '任务“' . $task['id'] . '”，卖家修改了评分', 'in_grade');
                         member_base :: sendSms($task['buid'], $msg, 'in_grade');
                         }
                     return 2;
                     }
                 }else{
                 if (db :: insert('credits', array(
                            'tid' => $tid,
                             'fuid' => $fuid,
                             'fusername' => $fusername,
                             'tuid' => $tuid,
                             'tusername' => $tusername,
                             'isBuyer' => $isBuyer?1:0,
                             'score' => $score,
                             'isHide' => $isHide,
                             'type' => $type,
                             'remark' => $remark,
                             'timestamp' => $timestamp
                            ))){
                     db :: update('memberfields', $isBuyer?'sgrade' . $grade . '=sgrade' . $grade . '+1':'bgrade' . $grade . '=bgrade' . $grade . '+1', "uid='$tuid'");
                     db :: update('task', 'credit=credit|' . ($isBuyer?1:2), "id='$task[id]'");
                     if ($isBuyer){
                         $msg = '您在' . language :: get('qu' . $task['type']) . '区的任务“' . $task['id'] . '”，买家已评分';
                         member_base :: sendPm($task['suid'], $msg, '任务“' . $task['id'] . '”，买家已评分', 'out_grade');
                         member_base :: sendSms($task['suid'], $msg, 'out_grade');
                         }else{
                         $msg = '您在' . language :: get('qu' . $task['type']) . '区接的任务“' . $task['id'] . '”，卖家已评分';
                         member_base :: sendPm($task['buid'], $msg, '任务“' . $task['id'] . '”，卖家已评分', 'in_grade');
                         member_base :: sendSms($task['buid'], $msg, 'in_grade');
                         }
                     return 1;
                     }
                 }
             }
         return '对不起，该任务不存在';
         }
     public static function get($tid, $uid){
         return db :: one('credits', '*', "tid='$tid' and fuid='$uid'");
        /**
         * if ($task = db::one('task', 'suid,buid', "id='$tid'")) {
         * if ($task['suid'] != $uid && $task['buid'] != $uid) return array();
         * if ($task['suid'] == $uid) $isBuyer = false;
         * else $isBuyer = true;
         * if ($isBuyer) {
         * $fuid = $task['buid'];
         * } else {
         * $fuid = $task['suid'];
         * }
         * return db::one('credits', '*', "tid='$tid' and fuid='$fuid'");
         * }
         * return array();
         */
         }
    }
?>