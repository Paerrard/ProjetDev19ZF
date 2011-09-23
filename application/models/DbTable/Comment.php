<?php 


class Application_Model_DbTable_Comment extends Zend_Db_Table_Abstract
{
	public function __construct()
	{
		$config = array(
					'db' => Zend_Controller_Front::getInstance()->getParam('bootstrap')
																->getResource('db'),
					'name' => 'comment',
					'primary' => 'com_id',
					'referenceMap' => array( 
							'Article' => array( 'columns' => array( 'art_id' ),
												 'refTableClass' => 'Application_Model_DbTable_Article',
												 'refColumns' => array( 'art_id'),
												 'onDelete' => self::CASCADE,
												 'onUpdate' => self::CASCADE
												)				
											)
		);
		parent::__construct($config);
	}
	
}