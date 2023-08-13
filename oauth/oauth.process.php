<?php

/**
 * @name Модуль тестирования модулей подключения к системам OAuth 
 * @author clamdv
 * @copyright 2015
 */

 include "oauth.vk.php";
 include "oauth.mail.php";
 include "oauth.fb.php";
 include "oauth.ok.php";
 include "oauth.twitter.php";

 class OAuthProcess {

    public function __construct()
    {
        $this->CODE = htmlspecialchars($_GET["code"]);
        $this->OAUTH = htmlspecialchars($_GET["oauth"]);

        if ($this->OAUTH == "vk") {
            $instance = new OAuthVK();
            $instance->LoadTokenData($this->CODE);
            $info = $instance->GetUserInfo();
            
            echo "Name: ".$info["first_name"]."<br/>Last Name: ".$info["last_name"]."<hr/>";
        } else
        if ($this->OAUTH == "mail") {
            $instance = new OAuthMail();
            $instance->LoadTokenData($this->CODE);
            $info = $instance->GetUserInfo();

            echo "Name: ".$info["first_name"]."<br/>Last Name: ".$info["last_name"]."<br/><img src='".$info["pic_180"]."'><hr/>";
            
        } else
        if ($this->OAUTH == "fb") {
            $instance = new OAuthFaceBook();
            $instance->LoadTokenData($this->CODE);
            $info = $instance->GetUserInfo();
            
            echo "Name: ".$info["name"]."<hr/>";
        } else
        if ($this->OAUTH == "ok") {
            $instance = new OAuthOK();
            $instance->LoadTokenData($this->CODE);
            $info = $instance->GetUserInfo();
            
            echo "Name: ".$info["first_name"]."<br/>Last Name: ".$info["last_name"]."<br/><img src='".$info["pic_1"]."'><hr/>";
        } else
        if ($this->OAUTH == "twit") {
            $instance = new OAuthTwitter();
            $instance->LoadTokenData($this->CODE);
            $info = $instance->GetUserInfo();
            
            echo "Name: ".$info["first_name"]."<br/>Last Name: ".$info["last_name"]."<br/><img src='".$info["pic_1"]."'><hr/>";
        }
    }
 }

?>