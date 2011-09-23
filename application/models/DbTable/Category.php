<?php 

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract
{
	public function __construct()
	{
		$config = array(
					'db' => Zend_Controller_Front::getInstance()->getParam('bootstrap')
																->getResource('db'),
					'name' => 'category',
					'primary' => 'cat_id',
					'dependentTables' => array( 'Application_Model_DbTable_Article')
		);
		parent::__construct($config);
	}
	
}