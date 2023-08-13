<?php

/**
 * @name Модуль доступа к системе OAuth для Одноклассники
 * @author clamdv
 * @copyright 2015
 */

require_once "oauth.base.php";

class OAuthOK extends OAuth {

    const AUTH_ID = "ok";
    const CLIENT_ID = "1118268416";
    const PRIVATE_KEY = "CC30B5356447DFA04A04675E";
    const PUBLIC_KEY = "CBANGIKDEBABABABA";
    const SERVER_URL = "http://www.odnoklassniki.ru/oauth/authorize?";
    const TOKEN_URL = "https://api.odnoklassniki.ru/oauth/token.do";
    const API_URL = "http://api.odnoklassniki.ru/fb.do?";

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
    
    protected function GetClientParams() {
        return array_merge(
            parent::GetClientParams(),
            parent::GetSecretParams(),
            array (                    
                "grant_type" => "authorization_code",
            )
        );
    }    
    
    protected function GetTokenData() {
        return @file_get_contents(self::TOKEN_URL, false, stream_context_create($this->GetPostQuery()));
    }            

    public function GetUserInfo() {
        $opts = array (
            "access_token" => $this->tokenData["access_token"],
            "method" => "users.getCurrentUser",
            "application_key" => self::PUBLIC_KEY,
            "sig" => md5('application_key='.self::PUBLIC_KEY.'method=users.getCurrentUser'.md5($this->tokenData["access_token"].self::PRIVATE_KEY)) 
        );            
        $response = json_decode(@file_get_contents(self::API_URL.http_build_query($opts)), true);
        
        return $response;
    }
}

?>