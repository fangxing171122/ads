<?php
$content = file_get_contents('php://input');
$post    = json_decode($content,true);
file_put_contents('./log.txt',date('Y-m-d H:i:s',time()).PHP_EOL. var_export($post,1).PHP_EOL,FILE_APPEND);
return json_encode(['code'=>0,'msg'=>file_get_contents('php://input')]);
