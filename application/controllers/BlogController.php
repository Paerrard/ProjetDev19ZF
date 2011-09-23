<?php

class BlogController extends Zend_Controller_Action
{
	/**
	 * Blog service instance
	 * @var unknown_type
	 */
	private $_blogService;
	
	public function init()
	{
		$this->_blogService = new Application_Service_Blog();
	}
	public function indexAction()
	{
		$this->view->categories = $this->_blogService->listAllCategories();
	}
	
	public function categoryAction()
	{
		$id = (int) $this->getRequest()->getParam('id');
		$this->view->category = $this->_blogService->findCategory($id);
	}
	
	public function articleAction()
	{
		$id = (int) $this->getRequest()->getParam('id');
		$this->view->article = $this->_blogService->findArticle($id);
		
		$form = new Application_Form_Comment();
		
		if ($this->getRequest()->isPost()) {
		    $result = $this->_blogService->saveComment($form);
		    
			if (Application_Service_User::COMMENT_CREATION_FAILURE_FORM_INVALID == $result) {
			    $this->view->message = "Le commentaire {$result->getTitle()} a bien été créé";
			}
			elseif ($result instanceof Application_Model_Comment) {
			    $this->view->message = "Erreur dans les données du formulaire";
			}
			else {
			    $this->view->message = "Erreur inconnue";
			}
		}
		
		$this->view->form = $form;
		$this->view->form->setAction('/blog/article/id/' . $id);
	}
	
}





