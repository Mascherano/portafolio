<?php

	namespace App\Controllers;
	use App\Models\{Job, Project};

	class IndexController {
		public function indexAction(){
			$jobs = Job::all();

			$projects = Project::all();

			$nombre = 'Marcelo González';
			$limitMonths = 1000;

			include '../views/index.php';
		}
	}