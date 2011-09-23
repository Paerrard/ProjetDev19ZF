<?php 


final class Application_Service_User
{
	const USER_CREATION_FAILURE_FORM_INVALID = 'userCreationFailureFormInvalid';
	const USER_CREATION_SUCCESS = 'userCreationSuccess';
	/**
	 * Saves a user
	 * @param array|Application_Model_Register|Zend_Form $user
	 * @throws Zend_Exception
	 */
	public function save($user)
	{
		if (is_array($user)) {
			$userObj = new Application_Model_Register();
			$userObj->setNom($user['user_nom'])
				     ->setPrenom($user['user_prenom'])
					 ->setLogin($user['user_login'])
					 ->setPassword($user['user_password'])
					 ->setEmail($user['user_email']);
		} elseif ($user instanceof Application_Model_Register) {
			$userObj = $user;
		} elseif ($user instanceof Zend_Form) {
			if ($user->isValid($_POST)) {
				$userObj = new Application_Model_Register();
				$userObj->setNom($user->getValue('user_nom'))
				        ->setPrenom($user->getValue('user_prenom'))
					    ->setLogin($user->getValue('user_login'))
					    ->setPassword($user->getValue('user_password'))
					    ->setEmail($user->getValue('user_email'));
				$user->reset();
			} else {
				return self::USER_CREATION_FAILURE_FORM_INVALID;
			}
		} else {
			throw new Zend_Exception('Parameter 1 must be an array, an 
			instance of Application_Model_Register or an instance of Zend_Form, ' . gettype($user). ' given');
		}
		
		$registerMapper = new Application_Model_Mapper_Register();
		$registerMapper->save($userObj); 
		return $userObj;
	}
}