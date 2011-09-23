<?php

// déclaration de la constante d'environnement
defined('APPLICATION_ENV') ||
	define('APPLICATION_ENV', getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production');
defined('ROOT_PATH') || 
	define('ROOT_PATH' , dirname(dirname(__FILE__)));

defined('APPLICATION_PATH') || 
	define('APPLICATION_PATH' , ROOT_PATH . DIRECTORY_SEPARATOR . 'application');	

defined('CONFIG_PATH') || 
	define('CONFIG_PATH' , APPLICATION_PATH . DIRECTORY_SEPARATOR . 'configs');



// gestion des exceptions // attends une fonction // que l'on évolue en classe et que l'on transforme
// en une méthode anonyme
/*set_error_handler(array('StartupTools', 'handlerErrors'));

class StartupTools
{
	public static function handlerErrors($code, $message)
	{
		
	}
}
*/
	
ini_set('display_errors', true);

// pas de gestion d'espace mémoire utilisation de fonction anonyme pour les fonctions de callback
set_error_handler(function($code, $message)
					{
						echo '<pre>';
						echo '<p><strong>' .$message. '</strong></p>';
						echo '</pre>';
					});


set_exception_handler(function($exception)
					{
						echo '<pre>';
						echo '<p><strong>' . $exception->getMessage() . '</strong></p>';
						echo '<br />';
						// renvoi une trace
						echo $exception->getTraceAsString();
						echo '</pre>';
						
					});


require_once 'Zend/Application.php';
$application = new Zend_Application(APPLICATION_ENV, CONFIG_PATH . DIRECTORY_SEPARATOR . 'application.ini');

$application->bootstrap()
			->run();
			