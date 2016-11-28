<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\SalonsModel; 


class BaseController extends Controller
{
	/**
	 * Ce champ va contenir l'engine de Plates qui va servir à afficher mes vues 
	 */
	protected $engine;

	public function __construct(){
		//Je fais appel à la méthode __construct de la classe parente (Controller) ce qui me permet de surcharger cette méthode et non de la rédéfinir entièrement
		/*parent::__construct();*/

		// Je stocke dans la variable de class engine une instance de League\Plates\Engine alors que cette instance a été crée directement dans la méthode show de Controller 
		$this->engine = new \League\Plates\Engine(self::PATH_VIEWS);

		$this->engine->loadExtension(new \W\View\Plates\PlatesExtensions());

		$app = getApp();

		$salonsModel = new SalonsModel();

		// Rend certaines données disponibles à tous les vues
		// accessible avec $w_user & $w_current_route dans les fichiers de vue
		$this->engine->addData(
			[
				'w_user' 		  => $this->getUser(),
				'w_current_route' => $app->getCurrentRoute(),
				'w_site_name'	  => $app->getConfig('site_name'),
				'salons'		  => $salonsModel->findAll(),
			]
		);
	}

	public function show($file, array $data = array()){
		$file = str_replace('.php', '', $file);

		// Affiche le template
		echo $this->engine->render($file, $data);
		die();
	}

	/**
	 * Cette fonction sert à ajouter des données qui seront disponibles dans toutes les vues fabriquées par this->engine donc par le BaseController
	 Par exemple, pour ajouter une liste d'utilisateurs à mes vues, j'utilise $this->addGlobalData(array('users' => $users));
	 */
	public function addGlobalData(array $datas){
		$this->engine->addData($datas);
	}
	
}