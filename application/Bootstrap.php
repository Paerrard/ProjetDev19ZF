<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    private $_view = null;
    private $_db = null;
    
    private function _getView()
    {
        if (null === $this->_view) {
            $this->bootstrap('view');
            $this->_view = $this->getResource('view');
        }
        
        return $this->_view;
    }
    
	private function _getDb()
    {
        if (null === $this->_db) {
            $this->bootstrap('db');
            $this->_db = $this->getResource('db');
        }
        
        return $this->_db;
    }
    
    protected function _initRouter()
    {
        $this->bootstrap('frontController');
        $router = $this->getResource('frontController')->getRouter();
        $configFile = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'routes.ini';
        $routerConfig = new Zend_Config_Ini($configFile, 'production');
        $router->addConfig($routerConfig, 'routes');
    }
    
    protected function _initHeadLink()
    {
        $this->_getView()->headLink()->appendStylesheet('/css/styles.css');
        $this->_getView()->headLink()->appendStylesheet('/css/menu.css');
    }
    
    protected function _initHeadTitle()
    {
        $this->_getView()->headTitle()->setSeparator(' - ');
        if ('development' == APPLICATION_ENV) {
            $this->_getView()->headTitle('[ENV]', 'APPEND');
        }
    }
    
    protected function _initHeadMeta()
    {
        $this->_getView()->headMeta()->appendName('keywords', 'zend, puissance, flexible')
                         ->headMeta()->appendName('author', 'Martial Saunois')
                         ->headMeta()->appendName('generator', 'Zend Studio');
    }
    
    protected function _initHeadScript()
    {
        $this->_getView()->headScript()->appendFile('/js/jquery.js');
        $this->_getView()->headScript()->appendFile('/js/menu.js');
    }
    
    protected function _initInlineScript()
    {
       // $this->_getView()->inlineScript()->appendFile('/js/script.js');
    }
    
    protected function _initNavigation()
    {
        $configFile = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'navigation.xml';
        $navConfig = new Zend_Config_Xml($configFile, 'main');
        $navContainer = new Zend_Navigation($navConfig);

        $this->_getView()->navigation($navContainer);
        Zend_Registry::set('Zend_Navigation',$navContainer);
    }

}














