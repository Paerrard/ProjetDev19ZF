<?php 

/**
 * Categorie
 * @author JB
 *
 */
class Application_Model_Category
{
	/**
	 * @var int
	 */
	private $_id;
	
	/**
	 * @var string
	 */
	private $_label;
	/**
	 * @var array
	 */
	private $_articles = null;
	/**
	 * @return the $_id
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * @param int $_id
	 */
	public function setId($_id) {
		$this->_id = (int) $_id;
		return $this;
	}

	/**
	 * @return the $_label
	 */
	public function getLabel() {
		return $this->_label;
	}

	/**
	 * @param string $_label
	 */
	public function setLabel($_label) {
		$this->_label = (string) $_label;
		return $this;
	}
	/**
	 * @return the $_articles
	 */
	public function getArticles() 
	{
		if (null === $this->_articles) {
			$articleMapper = new Application_Model_Mapper_Article();
			$this->_articles = $articleMapper->selectByCategoryId($this->_id);
		}
		return $this->_articles;
	}

	/**
	 * @param array $_articles
	 */
	public function setArticles(array $_articles) 
	{
		$this->_articles = $_articles;
		return $this;
	}


}