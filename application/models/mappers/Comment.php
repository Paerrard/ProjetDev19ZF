<?php 

class Application_Model_Mapper_Comment
{
	private $_dbTable = null;
	
	public function __construct()
	{
		$this->_dbTable = new Application_Model_DbTable_Comment();
	}
	
	/**
	 * Finds a comment for a given id
	 * @param int $id
	 * @return Application_Model_Comment
	 */
	public function find($id)
	{
		$row = $this->_dbTable->find($id)->current();
		return $this->_rowToObject($row);
	}
	
	/**
	 * Inserts or updates a comment
	 * @param Application_Model_Comment $comment
	 */
	public function save(Application_Model_Comment $comment)
	{
		$data = $this->_objectToArray($comment);

		if (0 === (int) $comment->getId()) {
			unset($data['com_id']);
			return $this->_dbTable->insert($data);
		} else {
			$where = array('com_id = ?' => $comment->getId());
			return $this->_dbTable->update($data, $where);
		}
	}
	

	/**
	 * Deletes a comment for a given id
	 * @param Application_Model_Comment $comment
	 */
	public function delete(Application_Model_Comment $comment)
	{
		$where = array('com_id = ?' => $comment->getId());
		return $this->_dbTable->delete($where);
	}
	
	
	public function selectByArticleId($articleId)
	{
		$where = array('art_id = ?' => $articleId);
		$rowSet = $this->_dbTable->fetchAll($where);
		$comments = array();
		foreach ($rowSet as $row) {
			$comments[] = $this->_rowToObject($row);
		}
		return $comments;
	}
	/**
	 * Builds a comment from a Zend_Db_Table_Row object
	 * @param Zend_Db_Table_Row $row
	 * @return Application_Model_Comment
	 */
	private function _rowToObject(Zend_Db_Table_Row $row) 
	{
		$comment = new Application_Model_Comment();
		$comment->setId($row->com_id)
				->setArtId($row->art_id)
				->setContent($row->com_content)
				->setTitle($row->com_title)
				->setEmail($row->com_email);
		return $comment;
	}
	
	/**
	 * Builds an array from object's properties
	 * @param Application_Model_Comment $comment
	 * @return array
	 */
	private function _objectToArray(Application_Model_Comment $comment)
	{
		$data = array();
		$data['com_id'] = $comment->getId();
		$data['art_id'] = $comment->getArtId();
		$data['com_content'] = $comment->getContent();
		$data['com_title'] = $comment->getTitle();
		$data['com_email'] = $comment->getEmail();
		return $data;
	}
}










