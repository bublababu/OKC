<?php

defined('BASEPATH') or exit('No direct script access allowed');



/*

| -------------------------------------------------------------------------

| CI Bootstrap 3 Configuration

| -------------------------------------------------------------------------

| This file lets you define default values to be passed into views 

| when calling MY_Controller's render() function. 

| 

| See example and detailed explanation from:

| 	/application/config/ci_bootstrap_example.php

*/



$config['ci_bootstrap'] = array(



	// Site name

	'site_name' => '<img src="'.BASE_URL.'/assets/dist/images/logo.png" alt="Sportsman’s Hunting Club" title="Sportsman’s Hunting Club">',



	// Default page title prefix

	'page_title_prefix' => '',



	// Default page title

	'page_title' => '',



	// Default meta data

	'meta_data'	=> array(

		'author'		=> '',

		'description'	=> '',

		'keywords'		=> ''

	),



	// Default scripts to embed at page head or end

	'scripts' => array(

		'head'	=> array(

			'assets/dist/frontend/lib.min.js',

			'assets/dist/frontend/app.min.js',
			'assets/dist/frontend/jquery.validationEngine-en.js',
			'assets/dist/frontend/jquery.validationEngine.js',
			'assets/dist/admin/js.cookie.min.js'

		),

		'foot'	=> array(),

	),



	// Default stylesheets to embed at page head

	'stylesheets' => array(

		'screen' => array(

			'assets/dist/frontend/lib.min.css',

			'assets/dist/frontend/app.min.css',

			'assets/dist/frontend/custom.css',
			'assets/dist/frontend/validationEngine.jquery.css'
		)

	),



	// Default CSS class for <body> tag

	'body_class' => 'container',



	// Multilingual settings

	/*	'languages' => array(

		'default'		=> 'en',

		'autoload'		=> array('general'),

		'available'		=> array(

			'en' => array(

				'label'	=> 'English',

				'value'	=> 'english'

			),

			'zh' => array(

				'label'	=> '繁體中文',

				'value'	=> 'traditional-chinese'

			),

			'cn' => array(

				'label'	=> '简体中文',

				'value'	=> 'simplified-chinese'

			),

			'es' => array(

				'label'	=> 'Español',

				'value' => 'spanish'

			)

		)

	),*/



	// Google Analytics User ID

	'ga_id' => '',



	// Menu items
	'menu' => array(

		

		'calendar' => array(

			'name'		=> 'Calendar',

			'url'		=> 'Calendar',

		),
	

		'HuntingFishing' => array(

			'name'		=> 'Hunting & Fishing',

			'url'		=> '',

			'children'  => array(

				'Hunting Photos'   => 'Photos',

				'Hunting Rules'		=> 'Hunting-rules',			

			),

		),

		'Leases' => array(

			'name'		=> 'Leases',

			'url'		=> '',

			'children'  => array(

				'Lease Information'   => 'Lease-Information',

				'Lease Map'		=> 'Lease-Map',			

			),

		),

	),

	'usermenu' => array(

		

		'calendar' => array(

			'name'		=> 'Calendar',

			'url'		=> 'Calendar',

		),

		'Forums' => array(

			'name'		=> 'Forums',

			'url'		=> 'http://forums.okcsportsmansclub.com/',

		),

		'My Account' => array(

			'name'		=> 'My Account',

			'url'		=> 'account',

		),

		'Reservations' => array(

			'name'		=> 'Reservations',

			'url'		=> '',

			'children'  => array(

				'Manage Reservations'   => 'account',

				'Hunting & Fishing'		=> 'reservations/activity',
				'Lodges' 				=> 'lodge-reservations/location',

			),

		),

		'HuntingFishing' => array(

			'name'		=> 'Hunting & Fishing',

			'url'		=> '',

			'children'  => array(

				'Hunting Photos'   => 'photos',

				'Hunting Rules'		=> 'hunting-rules',
				'Board of Directors' => 'board-of-directors',
				'Harvest Reports' =>  'reports',
				'Club Members' => 'members',
				'Photos' => 'brag-board-photos',

			),

		),

		'Leases' => array(

			'name'		=> 'Leases',

			'url'		=> '',

			'children'  => array(

				'Lease Information'   => 'lease-Information',

				//'Lease Map'		=> 'Lease_Map',
				'Lease Representatives'  => 'lease-representatives',
				'Lease List' => 'leases',

			),

		),

	),


	// Login page

	'login_url' => '',



	// Restricted pages

	'page_auth' => array(),



	// Email config

	'email' => array(

		'from_email'		=> '',

		'from_name'			=> '',

		'subject_prefix'	=> '',



		// Mailgun HTTP API

		'mailgun_api'		=> array(

			'domain'			=> '',

			'private_api_key'	=> ''

		),

	),



	// Debug tools

	'debug' => array(

		'view_data'	=> FALSE,

		'profiler'	=> FALSE

	),

);



/*

| -------------------------------------------------------------------------

| Override values from /application/config/config.php

| -------------------------------------------------------------------------

*/

$config['sess_cookie_name'] = 'ci_session_frontend';

