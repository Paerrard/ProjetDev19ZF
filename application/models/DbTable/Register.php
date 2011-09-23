<?php

class Application_Model_DbTable_Register extends Zend_Db_Table_Abstract
{
	public function __construct()
	{
		$config = array(
					'db' => Zend_Controller_Front::getInstance()->getParam('bootstrap')
																->getResource('db'),
					'name' => 'user',
					'primary' => 'user_id',
				);
		parent::__construct($config);
	}
}