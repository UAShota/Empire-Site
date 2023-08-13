<?php

/**
 * @name Модуль доступа к системе OAuth для Twitter
 * @author clamdv
 * @copyright 2015
 */
 
require_once "oauth.base.php";  

class OAuthTwitter extends OAuth {
	
    const AUTH_ID = "twit";
    const CLIENT_ID = "2969433789";
    const PRIVATE_KEY = "n9AQ147GZudWEkQnJAi4DOjt6";
    const SECRET_KEY = "eUUZMXY5tbc4eNsaQsc3YbFi9w8Ft5tYBb3LHXdgjwMloHn29U";
    const SERVER_URL = "https://api.twitter.com/oauth2/token";
    const API_URL = "https://api.vk.com/method/users.get?access_token=%s&uids=%d&fields=uid,first_name,last_name,screen_name";
    
    protected function GetAuthId() {
        return self::AUTH_ID;
    }
    
    protected function GetClientId() {
        return self::CLIENT_ID;
    }
    
    protected function GetPrivateKey() {
        return self::PRIVATE_KEY;
    }
    
    protected function GetServerUrl() {
        return self::SERVER_URL;
    }
    
    protected function GetTokenUrl() {
        return self::TOKEN_URL;
    }
    
    protected function GetHeaderParams() {
    /*        
        if ($this->tokenData == null) {
            
            hash_hmac()
            
            return array_merge(
                parent::GetHeaderParams(), 
                array(
                    "Authorization: OAuth",
                    "oauth_callback=".$this->GetRedirectUrl()
                    "oauth_consumer_key=".$self::PRIVATE_KEY,
                    "oauth_nonce=".base64_decode(rand()),
                    "oauth_signature=",
                    "oauth_signature_method=HMAC-SHA1",
                    "oauth_timestamp=".1"318467427",
                    "oauth_version=1.0"         
                )
            );
        } else {
            return array_merge(
                parent::GetHeaderParams(), 
                array(
                    "Authorization: Bearer ".$this->tokenData["access_token"]            
                )
            );            
        }
    */
    }      

    protected function GetClientParams() {
        return array(
            "grant_type" => "client_credentials"            
        );
    }
    
    /**
     * Формирование блока секретных параметров
     */    
    protected function GetSecretParams() {
        return array();
    }     

    /**
     * Загрузка сессионных данных
     */
    public function LoadTokenData($code) {
        $this->code = $code;
        $this->tokenData = json_decode(file_get_contents(self::SERVER_URL, false, stream_context_create($this->GetPostQuery())), true);
        
        print_r($this->tokenData);
    }    
    
    public function GetUserInfo() {
        $url = sprintf(self::API_URL, $this->tokenData["access_token"], $this->tokenData["user_id"]);
        $respone = json_decode(file_get_contents($url), true);
        
        return $respone["response"][0];
    }                         
}

?>