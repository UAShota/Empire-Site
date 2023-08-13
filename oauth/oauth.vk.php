<?php

/**
 * @name Модуль доступа к системе OAuth для ВКонтакте
 * @author clamdv
 * @copyright 2015
 */
 
require_once "oauth.base.php";  

class OAuthVK extends OAuth {
	
    const AUTH_ID = "vk";
    const CLIENT_ID = "4719819";
    const PRIVATE_KEY = "SUjYhRzFFrvrwQlO4j8L";
    const SERVER_URL = "http://oauth.vk.com/authorize?";
    const TOKEN_URL = "https://oauth.vk.com/access_token";
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
    
    public function GetUserInfo() {
        $url = sprintf(self::API_URL, $this->tokenData["access_token"], $this->tokenData["user_id"]);
        $respone = json_decode(file_get_contents($url), true);
        
        return $respone["response"][0];
    }                         
}

?>