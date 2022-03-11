<?php
class Ads
{    
    /**
     *@desc 通过授权code获取token
     *@param array $data 参数 
     **/
    public static function getAccessToken($data=[])
    {   
        $type=isset($data['platform_type'])?$data['platform_type']:'';
        switch($type){
            case 'toutiao':
                $param=[];
                $param['app_id']=isset($data['app_id'])?$data['app_id']:'';
                $param['secret']=isset($data['secret'])?$data['secret']:'';
                $param['grant_type']=isset($data['grant_type'])?$data['grant_type']:'auth_code';
                $param['auth_code']=isset($data['auth_code'])?$data['auth_code']:'';
                $result=self::curlData('https://ad.oceanengine.com/open_api/oauth2/access_token/',$param);
                $token=isset($result['data']['access_token'])?$result['data']['access_token']:'';
                //to be continued...
            break;
            case 'guangdiantong':
                $url='https://ad.oceanengine.com/open_api/oauth2/access_token/?client_id
='.(isset($data['app_id'])?$data['app_id']:'').'&client_secret='.(isset($data['client_secret'])?$data['client_secret']:'');
                isset($data['grant_type']) and $url.='&grant_type='.$data['grant_type'];
                isset($data['authorization_code']) and $url.='&authorization_code='.$data['authorization_code'];
                $result=self::curlData($url);
                $token=isset($result['access_token'])?$result['access_token']:'';
                //to be continued...
            break;
            default:
                $token='';
            break;
        } 
        return $token;
    }
    
    /**
     *@desc 展示授权页面
     *@param array $data 参数 
     *@param string $type 授权平台
     **/
    public static function getAuthPage($data=[],$type='')
    { 
         switch($type){
            case 'toutiao'://头条
                $url='https://ad.oceanengine.com/openapi/audit/oauth.html?app_id='.(isset($data['app_id'])?$data['app_id']:'').'&redirect_uri='.(isset($data['redirect_uri'])?UrlEncode($data['redirect_uri'].'&platform_type=toutiao'):'');
                isset($data['state']) and $url.=$data['state'];
                isset($data['scope']) and $url.=$data['scope'];
            break;
            case 'guangdiantong'://广点通
                $url='https://developers.e.qq.com/oauth/authorize?client_id='.(isset($data['client_id'])?$data['client_id']:'').'&client_id='.(isset($data['redirect_uri'])?$data['redirect_uri']:'');
                isset($data['state']) and $url.=$data['state'];
                isset($data['scope']) and $url.=$data['scope'];
                isset($data['oauth_type']) and $url.=$data['oauth_type'];
                isset($data['account_display_number']) and $url.=$data['account_display_number'];
            break;
            default:
                $url='';
            break;
        } 
        return $url;
    } 
    
    //授权平台
    public static function platform($param='')
    {
        return [
            'toutiao'=>'头条-巨量引擎开放平台',
            'guangdiantong'=>'广点通开放后台',
            'kuaishou'=>'快手磁力引擎',
            'huawei'=>'华为',
            'xiaomi'=>'小米'
        ];
    }
    
    public static function curlData($url,$data=[],$header=["Content-type:application/json;charset='utf-8'","Accept:application/json"])
    {  
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        if(is_array($data)){
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
        }
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $result=json_decode(curl_exec($ch),true);
        curl_close($ch);
        return $result;
    }
}





