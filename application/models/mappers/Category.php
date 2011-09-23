<?php 

class Application_Model_Mapper_Category
{
	private $_dbTable = null;
	
	public function __construct()
	{
		$this->_dbTable = new Application_Model_DbTable_Category();
	}
	
	/**
	 * Finds a category for a given id
	 * @param int $id
	 * @return Application_Model_Category
	 */
	public function find($id)
	{
		$row = $this->_dbTable->find($id)->current();
		return $this->_rowToObject($row);
	}
	
	/**
	 * Inserts or updates a category
	 * @param Application_Model_Category $category
	 */
	public function save(Application_Model_Category $category)
	{
		$data = $this->_objectToArray($category);
		
		if (0 === (int) $category->getId()) {
			unset($data['cat_id']);
			return $this->_dbTable->insert($data);
		} else {
			$where = array('cat_id = ?' => $category->getId());
			return $this->_dbTable->update($data, $where);
		}
	}
	

	/**
	 * Deletes a category for a given id
	 * @param Application_Model_Category $category
	 */
	public function delete(Application_Model_Category $category)
	{
		$where = array('cat_id = ?' => $category->getId());
		return $this->_dbTable->delete($where);
	}
	
	/**
	 * Lists all categories
	 * @return multitype:Application_Model_Category 
	 */
	public function selectAll()
	{
		$rowSet = $this->_dbTable->fetchAll();
		$categories = array();
		foreach ($rowSet as $row) {
			$categories[] = $this->_rowToObject($row);
		}
		return $categories;
	}
	
	/**
	 * Builds a category from a Zend_Db_Table_Row object
	 * @param Zend_Db_Table_Row $row
	 * @return Application_Model_Category
	 */
	private function _rowToObject(Zend_Db_Table_Row $row) 
	{
		$category = new Application_Model_Category();
		$category->setId($row->cat_id)
				 ->setLabel($row->cat_label);
		return $category;
	}
	
	/**
	 * Builds an array from object's properties
	 * @param Application_Model_Category $category
	 * @return array
	 */
	private function _objectToArray(Application_Model_Category $category)
	{
		$data = array();
		$data['cat_id'] = $category->getId();
		$data['cat_label'] = $category->getLabel();
		return $data;
	}
}










