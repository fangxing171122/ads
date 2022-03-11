<?php
require __DIR__.DIRECTORY_SEPARATOR.'ads.php';
$token=(new Ads())->getAccessToken($_REQUEST);
//.....to be continued