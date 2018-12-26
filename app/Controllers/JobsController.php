<?php

	namespace App\Controllers;

	use App\Models\Job;
	use Respect\Validation\Validator as v;

	class JobsController extends BaseController{
		public function getAddJobAction($request){

			$responseMessage = null;

			//creamos una instancia de Job y la guardamos con el ORM Eloquent
			if($request->getMethod() == 'POST'){
				$postData = $request->getParsedBody();
				
				$jobValidator = v::key('title', v::stringType()->notEmpty())->key('description', v::stringType()->notEmpty());

				try{
					$jobValidator->assert($postData);

					$files = $request->getUploadedFiles();
					$logo = $files['logo'];

					$job = new Job();
					$job->title = $postData['title'];
					$job->description = $postData['description'];

					if($logo->getError() == UPLOAD_ERR_OK) {
						$fileName = $logo->getClientFilename();
						$logo->moveTo("uploads/$fileName");
						$job->logo = "uploads/$fileName";
					}

					$job->save();

					$responseMessage = 'Saved';
				}catch(\Exception $e){
					$responseMessage = $e->getMessage();
				}
			}

			return $this->renderHTML('addJob.twig', [
				'responseMessage' => $responseMessage
			]);
		}
	}