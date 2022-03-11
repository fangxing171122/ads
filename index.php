<?php
require __DIR__.DIRECTORY_SEPARATOR.'ads.php';
try{
    $data=[];
    $data['app_id']=1;
    $data['scope']=UrlEncode(["ad_query","ad_manage","report_service","account_service"]);
    $data['redirect_uri']='http://test.lo';
    $data['oauth_type']='advertiser';
    $data['state']='123';
    header("Location:".(new Ads())->getAuthPage($data,'toutiao'));
    
    
}catch(\Exception $e){
   exit($e->getMessage());
}
//    $result=(new Ads())->curlData('http://test.lo/demo.php',['param1'=>1,'param2'=>2]);
    //$result=(new Ads())->curlData('http://dt.chizao.com/version/index/list?page=1&size=10&appId=com.hnfh.syyd');