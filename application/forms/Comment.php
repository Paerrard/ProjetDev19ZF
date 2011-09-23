<?php 

class Application_Form_Comment extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post')
		     ->setName('FormComment');
		     
		$commentField = new Zend_Form_Element_Textarea('com_content');
		$commentField->setRequired(true)
					 ->addValidator(new Zend_Validate_StringLength(array('min' => 3,
					 													 'max' => 60)))
					 ->addFilter(new Zend_Filter_StripTags());
					 
		$commentTitle = new Zend_Form_Element_Text('com_title');			 
		$commentTitle->setRequired(true)
					 ->addValidator(new Zend_Validate_StringLength(array('min' => 3,
					 													 'max' => 120)))
					 ->addFilter(new Zend_Filter_StripTags());
					 
		$commentEmail = new Zend_Form_Element_Text('com_email');						 
		$commentEmail->setRequired(true)
					 ->addValidator(new Zend_Validate_EmailAddress());
		
		$commentSubmit = new Zend_Form_Element_Submit('com_submit');
		
		$commentReset = new Zend_Form_Element_Reset('com_reset');
		
		$this->addElement($commentTitle);
		$this->addElement($commentEmail);
		$this->addElement($commentField);
		$this->addElement($commentSubmit);
		$this->addElement($commentReset);
		
	}
}










