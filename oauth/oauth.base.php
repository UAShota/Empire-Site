<?php

/**
 * @name Базовый класс модулей доступа к системам OAuth 
 * @author clamdv
 * @copyright 2015
 */

abstract class OAuth {
   
    /**
     * Формат ссылки на возврат от системы OAuth
     */   
    const REDIRECT_URL = "http://%s/?oauth=%s";
    /**
     * Формат запроса на создание сессии
     */    
    const OAUTH_DEF_URL = "%s%s&response_type=code";
    /**
     * Формат запроса получения данных сессии
     */    
    const OAUTH_TOKEN_URL = "%s?%s";
    
    /**
     * Массив данных сессии
     */    
    protected $tokenData;
    
    /**
     * Уникальный идентификатор сессии для OAuth
     */    
    protected $code;
    
    /**
     * Идентификатор модуля
     */    
    abstract protected function GetAuthId();
    
    /**
     * Идентификатор приложения
     */    
    abstract protected function GetClientId();
    
    /**
     * Приватный ключ приложения
     */    
    abstract protected function GetPrivateKey();
    
    /**
     * Ссылка на запрос установки сессии
     */    
    abstract protected function GetServerUrl();
    
    /**
     * Ссылка на получение сессионных данных
     */    
    abstract protected function GetTokenUrl();
    
    /**
     * Ссылка на получение пользвоательских данных
     */    
    abstract public function GetUserInfo();
    
    protected function GetRedirectUrl() {
        return sprintf(self::REDIRECT_URL, $_SERVER["HTTP_HOST"], $this->GetAuthId());        
    }  
    
    /**
     * Формирование блока параметров заголовка
     */
    protected function GetHeaderParams() {
        return array(
            "Content-Type: application/x-www-form-urlencoded; charset=UTF-8"
        );
    }      

    /**
     * Формирование блока базовых параметров
     */
    protected function GetClientParams() {
        $opts = array(
            "client_id" => $this->GetClientId(),
            "redirect_uri" => $this->GetRedirectUrl()
        );
        return $opts;
    }
    
    /**
     * Формирование блока секретных параметров
     */    
    protected function GetSecretParams() {
        $opts = array(
            "client_secret" => $this->GetPrivateKey(),
            "code" => $this->code
        );
        return $opts;
    }    
    
    /**
     * Формирование Post запроса для подверженных паранойе систем
     */    
    protected function GetPostQuery() {
        return array('http' =>
            array(
                'method' => 'POST',
                'header' => implode("\r\n", $this->GetHeaderParams()),
                'content' => http_build_query($this->GetClientParams())
            )
        );        
    }    

    /**
     * Получение сессионных данных
     */
    protected function GetTokenData() {
        return file_get_contents($this->GetAuthTokenUrl());
    }

    /**
     * Получение ссылки для создания сессии
     */
    protected function GetAuthTokenUrl() {
        return sprintf(self::OAUTH_TOKEN_URL, $this->GetTokenUrl(), 
            http_build_query(array_merge($this->GetClientParams(), $this->GetSecretParams()))); 
    }

    /**
     * Получение идентификатора соединения на основе кода приложения
     */
    public function GetAuthUrl() {
        return sprintf(self::OAUTH_DEF_URL, $this->GetServerUrl(), http_build_query($this->GetClientParams()));
    }

    /**
     * Загрузка сессионных данных
     */
    public function LoadTokenData($code) {
        $this->code = $code;
        $this->tokenData = json_decode($this->GetTokenData(), true);
    }
}

?>