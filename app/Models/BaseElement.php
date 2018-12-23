<?php
	
	namespace App\Models;
	require_once('Printable.php');

	class BaseElement implements Printable{
		protected $title;
		public $description;
		public  $visible = true;
		public $months;

		public function __construct($title, $description){
			$this->setTitle($title);
			$this->description = $description;
		}

		public function setTitle($title){
			$this->title = ($title == '') ? 'N/A' : $title;
		}

		public function getTitle(){
			return $this->title;
		}

		public function getDurationAsString(){
		    $years = floor($this->months / 12);
		    $extraMonths = $this->months % 12;

		    if($years < 1){
		      return "$extraMonths meses";
		    } else if($extraMonths < 1){
		      return "$years años";
		    } else {
		      return "$years años $extraMonths meses";
		    }
		}

		public function getDescription(){
			return $this->description;
		}
	}