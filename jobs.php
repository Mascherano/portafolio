<?php

	require_once('app/Models/Job.php');
	require_once('app/Models/Project.php');
	require_once('app/Models/Printable.php');
	require_once('lib1/Project.php');

	use App\Models\{Job, Project, Printable};

	$job1 = new Job('PHP Developer', 'this is awesome job!!');
	$job1->months = 9;

	$job2 = new Job('Javascript Developer', 'this is awesome job!!');
	$job2->months = 13;

	$job3 = new Job('Devops', 'this is awesome job!!');
	$job3->months = 15;

	$project1 = new Project('Project 1', 'Description 1');
	$project1->months = 15;

	$jobs = [
		$job1,
		$job2,
		$job3
	];

	$projects = [
		$project1
	];

	function printElement(Printable $job){

	    if($job->visible == false){
	      return;
	    }

	    echo '<li class="work-position">';
	    echo '<h5>' . $job->getTitle(). '</h5>';
	    echo '<p>' . $job->getDescription() . '</p>';
	    echo '<p>' . $job->getDurationAsString() . '</p>';
	    echo '<strong>Achievements:</strong>';
	    echo '<ul>';
	    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
	    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
	    echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
	    echo '</ul>';
	    echo '</li>';
	}