<?php 
    include 'server2.php';
    $sql =<<<EOF
    CREATE TABLE PERFORMANCE
   (PERFORMANCE_ID      SERIAL   NOT NULL,
   STUDENT_ID        INTEGER     NOT NULL,
   QUESTION_ID       INTEGER     NOT NULL,
   STUDENTS_ANS      CHAR(100)   NOT NULL,
   REAL_ANS          CHAR(100)   NOT NULL,
   VERDICT           CHAR(50)	 NOT NULL
);
   
EOF;

$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
}
?>