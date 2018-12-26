<?php

	namespace App\Controllers;
	use App\Models\{Job, Project};

	class IndexController extends BaseController{
		public function indexAction(){
			$jobs = Job::all();
			$projects = Project::all();

			$nombre = 'Marcelo González';
			$limitMonths = 1000;

			return $this->renderHTML('index.twig', [
				'nombre' => $nombre,
				'jobs' => $jobs,
				'projects' => $projects
			]);
		}
	}