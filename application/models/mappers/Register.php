<?php

class Application_Model_Mapper_Register
{
	private $_dbTable = null;
	
	public function __construct()
	{
		$this->_dbTable = new Application_Model_DbTable_Register();
	}
	
	/**
	 * Finds a article for a given id
	 * @param int $id
	 * @return Application_Model_Register
	 */
	public function find($id)
	{
		$row = $this->_dbTable->find($id)->current();
		return $this->_rowToObject($row);
	}
	
	/**
	 * Inserts or updates an article
	 * @param Application_Model_Register $register
	 */
	public function save(Application_Model_Register $register)
	{
		$data = $this->_objectToArray($register);
		
		if (0 === (int) $register->getId()) {
			unset($data['user_id']);
			return $this->_dbTable->insert($data);
		} else {
			$where = array('user_id = ?' => $register->getId());
			return $this->_dbTable->update($data, $where);
		}
	}
	

	/**
	 * Deletes an article for a given id
	 * @param Application_Model_Register $register
	 */
	public function delete(Application_Model_Register $register)
	{
		$where = array('user_id = ?' => $register->getId());
		return $this->_dbTable->delete($where);
	}
	
	/**
	 * Lists all articles
	 * @return multitype:Application_Model_Register
	 */
	public function selectAll()
	{
		$rowSet = $this->_dbTable->fetchAll();
		$register = array();
		foreach ($rowSet as $row) {
			$register[] = $this->_rowToObject($row);
		}
		return $register;
	}
	
	/**
	 * Builds an article from a Zend_Db_Table_Row object
	 * @param Zend_Db_Table_Row $row
	 * @return Application_Model_Register
	 */
	private function _rowToObject(Zend_Db_Table_Row $row) 
	{
		$register = new Application_Model_Register();
		$register->setId($row->user_id)
				 ->setNom($row->user_nom)
				 ->setPrenom($row->user_prenom)
				 ->setLogin($row->user_login)
				 ->setPassword($row->user_password)
				 ->setEmail($row->user_email);
		return $register;
	}
	
	/**
	 * Builds an array from object's properties
	 * @param Application_Model_Article $article
	 * @return array
	 */
	private function _objectToArray(Application_Model_Register $register)
	{
		$data = array();
		$data['user_id'] = $register->getId();
		$data['user_nom'] = $register->getNom();
		$data['user_prenom'] = $register->getPrenom();
		$data['user_login'] = $register->getLogin();
		$data['user_password'] = $register->getPassword();
		$data['user_email'] = $register->getEmail();
		return $data;
	}
}