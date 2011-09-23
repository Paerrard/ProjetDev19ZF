<?php


class Application_Model_DbTable_Article extends Zend_Db_Table_Abstract
{
	public function __construct()
	{
		$config = array(
					'db' => Zend_Controller_Front::getInstance()->getParam('bootstrap')
																->getResource('db'),
					'name' => 'article',
					'primary' => 'art_id',
					'referenceMap' => array( 
							'Category' => array( 'columns' => array( 'cat_id' ),
												 'refTableClass' => 'Application_Model_DbTable_Category',
												 'refColumns' => array( 'cat_id'),
												 'onDelete' => self::CASCADE,
												 'onUpdate' => self::CASCADE
												)				
											),
					'dependentTables' => array('Application_Model_DbTable_Comment')
		);
		parent::__construct($config);
	}
	
}