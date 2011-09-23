<?php 

class Application_Model_Mapper_Article
{
	private $_dbTable = null;
	
	public function __construct()
	{
		$this->_dbTable = new Application_Model_DbTable_Article();
	}
	
	/**
	 * Finds a article for a given id
	 * @param int $id
	 * @return Application_Model_Article
	 */
	public function find($id)
	{
		$row = $this->_dbTable->find($id)->current();
		return $this->_rowToObject($row);
	}
	
	/**
	 * Inserts or updates an article
	 * @param Application_Model_Article $article
	 */
	public function save(Application_Model_Article $article)
	{
		$data = $this->_objectToArray($article);
		
		if (0 === (int) $article->getId()) {
			unset($data['art_id']);
			return $this->_dbTable->insert($data);
		} else {
			$where = array('art_id = ?' => $article->getId());
			return $this->_dbTable->update($data, $where);
		}
	}
	

	/**
	 * Deletes an article for a given id
	 * @param Application_Model_Article $article
	 */
	public function delete(Application_Model_Article $article)
	{
		$where = array('art_id = ?' => $article->getId());
		return $this->_dbTable->delete($where);
	}
	
	/**
	 * Lists all articles
	 * @return multitype:Application_Model_Article
	 */
	public function selectAll()
	{
		$rowSet = $this->_dbTable->fetchAll();
		$articles = array();
		foreach ($rowSet as $row) {
			$articles[] = $this->_rowToObject($row);
		}
		return $articles;
	}
	
	public function selectByCategoryId($catId)
	{
		$where = array('cat_id = ?' => $catId);
		$rowSet = $this->_dbTable->fetchAll($where);
		$articles = array();
		foreach ($rowSet as $row) {
			$articles[] = $this->_rowToObject($row);
		}
		return $articles;
	}
	/**
	 * Builds an article from a Zend_Db_Table_Row object
	 * @param Zend_Db_Table_Row $row
	 * @return Application_Model_Article
	 */
	private function _rowToObject(Zend_Db_Table_Row $row) 
	{
		$article = new Application_Model_Article();
		$article->setId($row->art_id)
				->setCatId($row->cat_id)
				->setTitle($row->art_title)
				->setContent($row->art_content);
		return $article;
	}
	
	/**
	 * Builds an array from object's properties
	 * @param Application_Model_Article $article
	 * @return array
	 */
	private function _objectToArray(Application_Model_Article $article)
	{
		$data = array();
		$data['art_id'] = $article->getId();
		$data['cat_id'] = $article->getCatId();
		$data['art_title'] = $article->getTitle();
		$data['art_content'] = $article->getContent();
		return $data;
	}
}










