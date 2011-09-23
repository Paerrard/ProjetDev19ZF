<?php

// la classe porte le nom du fichier
class ErrorController extends Zend_Controller_Action
{

	// fonction public correspondant à l'action qui va déclencher une vue
	public function errorAction()
	{
		$errorHandler = $this->_getParam('error_handler');
		$exception = $errorHandler->exception;
		$this->view->message = $exception->getMessage();
		$this->view->trace   = $exception->getTraceAsString();
		switch ($errorHandler->type) {
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER :
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION :
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE :
				$httpCode = 404;
				break;
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER :
			default :
				$httpCode = 500;
				break;
		}
		$this->getResponse()->setHttpResponseCode($httpCode);
	}
}






