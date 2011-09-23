<?php

final class Application_Service_Blog
{
    const ARTICLE_CREATION_FAILURE_FORM_INVALID = 'articleCreationFailureFormInvalid';
    const COMMENT_CREATION_FAILURE_FORM_INVALID = 'commentCreationFailureFormInvalid';
    const ARTICLE_CREATION_SUCCESS = 'articleCreationSuccess';
    const COMMENT_CREATION_SUCCESS = 'commentCreationSuccess';
    
    /**
     * Find a category
     * @param int $id
     * @return Application_Model_Category
     */
    public function findCategory($id)
    {
        $categoryMapper = new Application_Model_Mapper_Category();
        return $categoryMapper->find((int) $id); 
    }
    
    /**
     * Finds all articles
     * @return array
     */
    public function listArticles()
    {
        $articleMapper = new Application_Model_Mapper_Article();
        return $articleMapper->selectAll(); 
    }
    
    /**
     * Save a comment
     * @param array|Application_Model_Comment|Zend_Form $comment
     * @throws Zend_Exception
     * @return string|Application_Model_Comment
     */
    public function saveComment($comment)
    {
        if (is_array($comment)) {
            $commentObj = new Application_Model_Comment();
			$commentObj->setArtId($comment['art_id'])
			    ->setContent($comment['com_content'])
			    ->setTitle($comment['com_title'])
			    ->setEmail($comment['com_email']);
        }
        elseif ($comment instanceof Application_Model_Comment) {
            $commentObj = $comment;
        }
        elseif ($comment instanceof Zend_Form) {
            if ($comment->isValid($_POST)) {
                $commentObj = new Application_Model_Comment();
				$commentObj->setArtId($comment->getValue('art_id'))
				    ->setContent($comment->getValue('com_content'))
				    ->setTitle($comment->getValue('com_title'))
				    ->setEmail($comment->getValue('com_email'));
				    
				$comment->reset();
            }
            else {
                return self::COMMENT_CREATION_FAILURE_FORM_INVALID;
            }
        } 
        else {
            throw new Zend_Exception('Parameter 1 must be an array, an instance
            of Application_Model_Comment or Zend_Form, ' . gettype($comment) . ' given');
        }
        
        $commentMapper = new Application_Model_Mapper_Comment();
        $commentMapper->save($commentObj);
        return $commentObj;
    }
    
    /**
     * Save an article
     * @param array|Application_Model_Article|Zend_Form $article
     * @throws Zend_Exception
     * @return string|Application_Model_Article
     */
    public function saveArticle($article)
    {
        if (is_array($article)) {
            $articleObj = new Application_Model_Article();
			$articleObj->setCatId($article['cat_id'])
			    ->setContent($article['art_content'])
			    ->setTitle($article['art_title']);
        }
        elseif ($article instanceof Application_Model_Article) {
            $articleObj = $article;
        }
        elseif ($article instanceof Zend_Form) {
            if ($article->isValid($_POST)) {
                $articleObj = new Application_Model_Article();
				$articleObj->setCatId($article->getValue('cat_id'))
				    ->setTitle($article->getValue('art_content'))
				    ->setContent($article->getValue('art_title'));
				    
				$article->reset();
            }
            else {
                return self::USER_CREATION_FAILURE_FORM_INVALID;
            }
        } 
        else {
            throw new Zend_Exception('Parameter 1 must be an array, an instance
            of Application_Model_Article or Zend_Form, ' . gettype($article) . ' given');
        }
        
        $articleMapper = new Application_Model_Mapper_Article();
        $articleMapper->save($articleObj);
        return $articleObj;
    }
}