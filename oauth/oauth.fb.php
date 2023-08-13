<?php

/**
 * @name Модуль доступа к системе OAuth для FaceBook
 * @author clamdv
 * @copyright 2015
 */

require_once "oauth.base.php";

class OAuthFaceBook extends OAuth {

    private $session = "";

    const AUTH_ID = "fb";
    const CLIENT_ID = "326066044256625";
    const PRIVATE_KEY = "9b079d7c91df76b60a914b5232b31a43";
    const SERVER_URL = "https://www.facebook.com/dialog/oauth?";
    const TOKEN_URL = "https://graph.facebook.com/oauth/access_token";
    const API_URL = "https://graph.facebook.com/me?fields=id,name&access_token=%s";

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
        $this->session = md5(uniqid(rand(), true));
        return self::TOKEN_URL;
    }

    protected function GetAuthParamsEx() {
        return array("state" => $this->session);
    }

    public function GetUserInfo() {
        $url = sprintf(self::API_URL, $this->tokenData["access_token"]);
        $response = json_decode(file_get_contents($url), true);
        return $response;
    }

    public function LoadTokenData($code) {
        $this->code = $code;
        parse_str($this->GetTokenData($code), $this->tokenData);
    }
}

?>