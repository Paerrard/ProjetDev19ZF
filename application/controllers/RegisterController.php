<?php
class RegisterController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$id = (int) $this->getRequest()->getParam('id');
		$form = new Application_Form_Register();
		$this->view->message = '';
		
		if ($this->getRequest()->isPost()) {
			$userService = new Application_Service_User;
			$result = $userService->save($form);
			
			if ($result instanceof Application_Model_Register){
				$this->view->message = "L'utilisateur {$result->getNom()} a bien été créé";
			} elseif (Application_Service_User::USER_CREATION_FAILURE_FORM_INVALID === $result){
				$this->view->message = "Erreur dans les données du formulaire";
			} else {
				$this->view->message = "Erreur inconnue";
			}
			
//			switch( $result ) {
//				case Application_Service_User::USER_CREATION_FAILURE_F ORM_INVALID:
//					$this->view->message = "Erreur dans les données du formulaire";
//					break;
//				case ($result instanceof Application_Model_Register) :
//					$this->view->message = "L'utilisateur {$result->getNom()} a bien été créé";
//					break;
//				default: 
//					print 'erreur'; exit;
//			}
		}
		
		$this->view->form = $form;
		$this->view->form->setAction('/register/' . $id);
	}
}