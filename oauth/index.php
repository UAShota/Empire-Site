<?php

/**
 * @author clamdv
 * @copyright 2015
 */

    ini_set('error_reporting', E_ALL);
    ini_set('display_errors',1);
    error_reporting(E_ALL); 

    include "oauth/oauth.process.php";

    if (isset($_GET["code"]) && isset($_GET["oauth"]))
        $oauthProcess = new OAuthProcess();

    $testLinkVK = new OAuthVK();
    echo "<a target=blank href='".$testLinkVK->GetAuthUrl()."'>link VK</a><br/>";

    $testLinkMail = new OAuthMail();
    echo "<a target=blank href='".$testLinkMail->GetAuthUrl()."'>link Mail</a><br/>";

    $testLinkFaceBook = new OAuthFaceBook();
    echo "<a target=blank href='".$testLinkFaceBook->GetAuthUrl()."'>link FaceBook</a><br/>";
    
    $testLinkOK = new OAuthOK();
    echo "<a target=blank href='".$testLinkOK->GetAuthUrl()."'>link OK</a><br/>";
    
    $testLinkTwit = new OAuthTwitter();
    echo "<a target=blank href='http://2.kz/?oauth=twit&code=1'>link Twitter</a><br/>";        
?>