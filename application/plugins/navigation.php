<?php

/**
 * Plugin de navigation
 * @author Dev19
 */
class Application_Plugin_Navigation extends Zend_Controller_Plugin_Abstract
{    
    
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
    	$navigation = Zend_Registry::get('Zend_Navigation');
    	$blogContainer = $navigation->findById('blog');
    	
    	$categoryMapper = new Application_Model_Mapper_Category();
    	$categories = $categoryMapper->selectAll();
    	
    	$categoryPages = array();
    	foreach ($categories as $category) {
    		$options = array( 'type' => 'mvc',
    						  'controller' => 'blog',
    						  'action' => 'category',
    						  'params' => array( 'id' => $category->getId()),
    						  'label' => $category->getLabel(),
    						  'route' => 'category',
    		                  'visible' => 1,
    		                  'id' => 'category' . $category->getId(),
    						  'class' => 'parent'
    						);
    						
    		$categoryPage = Zend_Navigation_Page::factory($options);
    		$articlePages = array();
    		foreach ($category->getArticles() as $article) {
    			$options = array( 'type' => 'mvc',
    						  	  'controller' => 'blog',
    						  	  'action' => 'article',
    						 	  'params' => array( 'id' => $article->getId()),
    						 	  'label' => $article->getTitle(),
    						  	  'route' => 'article2',
    		                  	  'visible' => 1,
    		                  	  'id' => 'article' . $article->getId()
    							);
    						
    			$articlePage = Zend_Navigation_Page::factory($options);
    			$articlePages[] = $articlePage;
    		}
    		$categoryPage->addPages($articlePages);
    		$categoryPages[] = $categoryPage;
    	}
    	$blogContainer->addPages($categoryPages);
   	
    }
    
}
