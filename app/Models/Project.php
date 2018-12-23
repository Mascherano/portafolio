<?php

	namespace App\Models;	
	use Illuminate\Database\Eloquent\Model;

	class Project extends Model{

		protected $table = 'projects';

		public function getDurationAsString(){
		    $years = floor($this->months / 12);
		    $extraMonths = $this->months % 12;

		    if($years < 1){
		      return "Project duration $extraMonths meses";
		    } else if($extraMonths < 1){
		      return "Project duration $years años";
		    } else {
		      return "Project duration $years años $extraMonths meses";
		    }
		}
	}