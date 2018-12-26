<?php

	namespace App\Controllers;

	use App\Models\User;
	use Respect\Validation\Validator as v;

	class UsersController extends BaseController{
		public function saveUser($request){

			$responseMessage = null;

			//creamos una instancia de User y la guardamos con el ORM Eloquent
			if($request->getMethod() == 'POST'){
				$postData = $request->getParsedBody();
				
				$userValidator = v::key('email', v::stringType()->notEmpty())->key('password', v::stringType()->notEmpty());

				try{
					$userValidator->assert($postData);

					$user = new User();
					$user->email = $postData['email'];
					$user->password = password_hash($postData['password'], PASSWORD_DEFAULT) ;

					$user->save();

					$responseMessage = 'Saved';
				}catch(\Exception $e){
					$responseMessage = $e->getMessage();
				}
			}

			return $this->renderHTML('addUser.twig', [
				'responseMessage' => $responseMessage
			]);
		}
	}