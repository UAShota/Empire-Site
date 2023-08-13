<?php

/**
 * @name Модуль доступа к системе OAuth для Mail.ru
 * @author clamdv
 * @copyright 2015
 */

require_once "oauth.base.php";

class OAuthMail extends OAuth {

    const AUTH_ID = "mail";
    const CLIENT_ID = "728841";
    const PRIVATE_KEY = "32d643ca681e98987d56ed0b51667675";
    const SECRET_KEY = "2d17aec9f34d05f4941f1af906392b61";
    const SERVER_URL = "https://connect.mail.ru/oauth/authorize?";
    const TOKEN_URL = "https://connect.mail.ru/oauth/token?grant_type=authorization_code&";
    const API_URL = "http://www.appsmail.ru/platform/api";

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
            parent::GetSecretParams()
        );
    }        

    protected function GetTokenData() {
        return @file_get_contents(self::TOKEN_URL, false, stream_context_create($this->GetPostQuery()));
    }

    public function GetUserInfo() {
        $request_params = array(
            "app_id" => self::CLIENT_ID,
            "method" => "users.getInfo",
            "secure" => 1,
            "session_key" => $this->tokenData["access_token"]
        );
        ksort($request_params);

        $params = "";
        foreach ($request_params as $key => $value)
            $params .= $key."=".$value;

        $url = self::API_URL."?".http_build_query($request_params)."&sig=".md5($params.self::SECRET_KEY);
        $response = json_decode(file_get_contents($url), true);
        
        return $response[0];
    }
}

?>