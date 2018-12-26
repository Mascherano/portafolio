<?php

	namespace App\Controllers;

	use App\Models\Project;
	use Respect\Validation\Validator as v;

	class ProjectsController extends BaseController{
		public function getAddProjectAction($request){

			$responseMessage = null;

			//creamos una instancia de Job y la guardamos con el ORM Eloquent
			if($request->getMethod() == 'POST'){
				
				$postData = $request->getParsedBody();

				$projectValidator = v::key('title', v::stringType()->notEmpty())->key('description', v::stringType()->notEmpty());

				try{
					$projectValidator->assert($postData);

					$files = $request->getUploadedFiles();
					$logo = $files['logo'];

					$project = new Project();
					$project->title = $postData['title'];
					$project->description = $postData['description'];

					if($logo->getError() == UPLOAD_ERR_OK) {
						$fileName = $logo->getClientFilename();
						$logo->moveTo("uploads/$fileName");
						$project->logo = "uploads/$fileName";
					}
					
					$project->save();

					$responseMessage = 'Saved';
				}catch(\Exception $e){
					$responseMessage = $e->getMessage();
				}
			}

			return $this->renderHTML('addProject.twig', [
				'responseMessage' => $responseMessage
			]);
		}
	}