<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;
	
	class Job extends Model{

		protected $table = 'jobs';

		public function getDurationAsString(){
		    $years = floor($this->months / 12);
		    $extraMonths = $this->months % 12;

		    if($years < 1){
		      return "Job duration $extraMonths meses";
		    } else if($extraMonths < 1){
		      return "Job duration $years años";
		    } else {
		      return "Job duration $years años $extraMonths meses";
		    }
		}
	}