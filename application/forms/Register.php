<?php

class Application_Form_Register extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post')
		     ->setName('FormRegister');
		   
		$registerNom = new Zend_Form_Element_Text('user_nom');
		$registerNom->setRequired(true)
					->addValidator(new Zend_Validate_StringLength(array('min' => 3,
					 													'max' => 60)))
					->addFilter(new Zend_Filter_StripTags());

		$registerPrenom = new Zend_Form_Element_Text('user_prenom');
		$registerPrenom->setRequired(true)
					   ->addValidator(new Zend_Validate_StringLength(array('min' => 3,
					 													   'max' => 60)))
					   ->addFilter(new Zend_Filter_StripTags()); 

		$registerLogin = new Zend_Form_Element_Text('user_login');
		$registerLogin->setRequired(true)
					  ->addValidator(new Zend_Validate_StringLength(array('min' => 3,
					 													  'max' => 60)))
					  ->addFilter(new Zend_Filter_StripTags()); 
		 
		$registerPassword = new Zend_Form_Element_Text('user_password');
		$registerPassword->setRequired(true)
						 ->addValidator(new Zend_Validate_StringLength(array('min' => 3,
						 													 'max' => 60)))
						 ->addFilter(new Zend_Filter_StripTags()); 
					 
		$registerEmail = new Zend_Form_Element_Text('user_email');						 
		$registerEmail->setRequired(true)
					  ->addValidator(new Zend_Validate_EmailAddress());
		
		$registerSubmit = new Zend_Form_Element_Submit('user_submit');
		
		$registerReset = new Zend_Form_Element_Reset('user_reset');
		
		$this->addElement($registerNom);
		$this->addElement($registerPrenom);
		$this->addElement($registerLogin);
		$this->addElement($registerPassword);
		$this->addElement($registerEmail);
		$this->addElement($registerSubmit);
		$this->addElement($registerReset);
	}
}