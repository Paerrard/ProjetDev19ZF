<?php 


class WebserviceController extends Zend_Controller_Action
{
	public function init()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
	}
	public function soapAction()
	{
		$options = array( 'soap_version' => SOAP_1_2);
		$server = new Zend_Soap_Server('http://site1.debian.formation.local/webservice/wsdl', $options);
		$server->setObject(new Application_Service_Blog);
		$server->handle();
	}
	
	public function wsdlAction()
	{
		$autodiscover = new Zend_Soap_AutoDiscover();
		$autodiscover->setClass('Application_Service_Blog');
		$autodiscover->setUri('http://site1.debian.formation.local/webservice/soap');
		$autodiscover->handle();
	}


}










