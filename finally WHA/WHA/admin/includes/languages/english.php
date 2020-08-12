<?php

	function lang($phrase){
		static $lang =array(
			//mavbar
			'HOME' =>'Home',
			'CATEGORY'=>'Category',
			'PAGE1'=> 'Courses',
			'PAGE2'=>'Instructors',
			'PAGE3'=>'Clients',
			'PAGE4'=>"News",
			'PAGE5'=>'Contact',
			'PAGE6'=>'Edit Admin',
			'PAGE7'=>'Certification',
			'PAGE8'=>'Jobs',
			'VIEW WEBSITE'=>'View Website',
			'LOGOUT'=>"Logout",
			'DEFAULT_TITLE'=>'Admin Page'

		);
		return $lang[$phrase] ;
	}