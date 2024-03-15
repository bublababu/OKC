<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
	'site_name' => 'Admin Panel',

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
			'assets/dist/admin/adminlte.min.js',
			'assets/dist/admin/lib.min.js',
			'assets/dist/admin/app.min.js',
			'assets/dist/admin/jquery.validate.js',
			'assets/dist/admin/jquery.validate.additional-methods.min.js',
			'assets/grocery_crud/js/jquery_plugins/ui/jquery-ui-1.10.3.custom.min.js',
			'assets/dist/admin/js.cookie.min.js',
			'assets/dist/frontend/jquery.validationEngine-en.js',
			'assets/dist/frontend/jquery.validationEngine.js'

		),
		'foot'	=> array(
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/dist/admin/adminlte.min.css',
			'assets/dist/admin/lib.min.css',
			'assets/dist/admin/app.min.css',
			'assets/grocery_crud/css/ui/simple/jquery-ui-1.10.1.custom.min.css',
			'assets/dist/frontend/validationEngine.jquery.css'
		)
	),

	// Default CSS class for <body> tag
	'body_class' => '',
	
	// Multilingual settings
	'languages' => array(
	),

	// Menu items
	'menu' => array(
		'home' => array(
			'name'		=> 'Dashboard',
			'url'		=> '',
			'icon'		=> 'fa fa-tachometer',
		),
		/*'user' => array(
			'name'		=> 'Users',
			'url'		=> 'user',
			'icon'		=> 'fa fa-users',
			'children'  => array(
				'List'			=> 'user',
				'Create'		=> 'user/create',
				'User Groups'	=> 'user/group',
			)
		),*/
	/*	'blog' => array(
			'name'		=> 'Blog',
			'url'		=> 'blog',
			'icon'		=> 'ion ion-edit',	// can use Ionicons instead of FontAwesome
			'children'  => array(
				'Blog Posts'		=> 'blog/post',
				'Blog Categories'	=> 'blog/category',
				'Blog Tags'			=> 'blog/tag',
			)
		),*/
	/*	'cover_photo' => array(
			'name'		=> 'Cover Photos',
			'url'		=> 'cover_photo',
			'icon'		=> 'ion ion-image',	// can use Ionicons instead of FontAwesome
		),*/
		/*'panel' => array(
			'name'		=> 'Admin Panel',
			'url'		=> 'panel',
			'icon'		=> 'fa fa-cog',
			'children'  => array(
				'Admin Users'			=> 'panel/admin_user',
				'Create Admin User'		=> 'panel/admin_user_create',
				'Admin User Groups'		=> 'panel/admin_user_group',
			)
		),*/
		/******************OKS Menu Start******************/
		/*'event' => array(
			'name'		=> 'Event',
			'url'		=> 'event',
			'icon'		=> 'fa fa-calendar',
			'children'  => array(
				'List'			=> 'event',
				'Create'		=> 'event/create',				
			)
		),*/
		'Reservations' => array(
			'name'		=> 'Reservations',
			'url'		=> '',
			'icon'		=> 'fa fa-star',
			'children'  => array(
				'Reservations'			=> 'reservations',
				'Lodge Reservations'		=> 'lodge-reservations',				
			)
		),
		'Reports' => array(
			'name'		=> 'Reports',
			'url'		=> '',
			'icon'		=> 'fa fa-bar-chart ',
			'children'  => array(
				'Unfilled Harvest'			=> 'reports/unfilled-harvest',
				'Harvest'		=> 'reports/harvest',	
				'Reservations'		=> 'reports/reservations',	
				'Guests'		=> 'reports/guests',				
			)
		),
		'Leases' => array(
			'name'		=> 'Leases',
			'url'		=> '',
			'icon'		=> 'fa fa-globe',
			'children'  => array(
				'Leases'			=> 'leases',
				'Lease Areas'		=> 'lease-areas',				
			)
		),
		'Lodges' => array(
			'name'		=> 'Lodges',
			'url'		=> 'lodges',
			'icon'		=> 'fa fa-home',			
		),
		'Game Type' => array(
			'name'		=> 'Game Type',
			'url'		=> 'gametype',
			'icon'		=> 'fa fa-twitter',			
		),
		'Guest Types' => array(
			'name'		=> 'Guest Types',
			'url'		=> 'guest-types',
			'icon'		=> 'fa fa-users',			
		),
		'Reservation Types' => array(
			'name'		=> 'Reservation Types',
			'url'		=> 'reservation-types',
			'icon'		=> 'fa fa-list',			
		),
		
		
		
		'People' => array(
			'name'		=> 'People',
			'url'		=> '',
			'icon'		=> 'fa fa-bar-chart ',
			'children'  => array(
				'People List'			=> 'people',
				'Annual forms List'			=> 'people/forms-list',
				'Submission Date'		=> 'people/submission',
				'Annual Form Instruction'		=> 'people/forms',
				'Signup Forms'		=> 'people/signup-form',
				'Signup Submitted Forms'		=> 'people/signup-submitted-form',
			)
		),
		
		
		'ContentPages' => array(
			'name'		=> 'Content Pages',
			'url'		=> 'ContentPages',
			'icon'		=> 'fa fa-television',			
		),
		'Media' => array(
			'name'		=> 'Media',
			'url'		=> 'media',
			'icon'		=> 'fa fa-folder-open-o',			
		),
		/*'Calendar' => array(
			'name'		=> 'Event Calendar',
			'url'		=> 'EventCalendar',
			'icon'		=> 'fa fa-calendar',			
		),*/
		'User Assessment' => array(
			'name'		=> 'User Assessment',
			'url'		=> '',
			'icon'		=> 'fa fa-bar-chart ',
			'children'  => array(
				'Manage PPT'			=> 'assessment/ppt',
				'Question And Answer'		=> 'assessment',
				'Settings'		=> 'assessment/settings',
								
			),			
		),
		'emailtemplate' => array(
			'name'		=> 'Email Template',
			'url'		=> 'Email-Template',
			'icon'		=> 'fa fa-envelope',			
		),
		/******************OKS Menu End******************/
		/*'util' => array(
			'name'		=> 'Utilities',
			'url'		=> 'util',
			'icon'		=> 'fa fa-cogs',
			'children'  => array(
				'Database Versions'		=> 'util/list_db',
			)
		),*/
		'logout' => array(
			'name'		=> 'Sign Out',
			'url'		=> 'panel/logout',
			'icon'		=> 'fa fa-sign-out',
		)
	),

	// Login page
	'login_url' => 'admin/login',

	// Restricted pages
	'page_auth' => array(
		'user/create'				=> array('webmaster', 'admin', 'manager'),
		'user/group'				=> array('webmaster', 'admin', 'manager'),
		'panel'						=> array('webmaster'),
		'panel/admin_user'			=> array('webmaster'),
		'panel/admin_user_create'	=> array('webmaster'),
		'panel/admin_user_group'	=> array('webmaster'),
		'util'						=> array('webmaster'),
		'util/list_db'				=> array('webmaster'),
		'util/backup_db'			=> array('webmaster'),
		'util/restore_db'			=> array('webmaster'),
		'util/remove_db'			=> array('webmaster'),
	),

	// AdminLTE settings
	'adminlte' => array(
		'body_class' => array(
			'webmaster'	=> 'skin-red',
			'admin'		=> 'skin-purple',
			'manager'	=> 'skin-black',
			'staff'		=> 'skin-blue',
		)
	),

	// Useful links to display at bottom of sidemenu
	'useful_links' => array(
		array(
			'auth'		=> array('webmaster', 'admin', 'manager', 'staff'),
			'name'		=> 'Frontend Website',
			'url'		=> '',
			'target'	=> '_blank',
			'color'		=> 'text-aqua'
		),
	/*	array(
			'auth'		=> array('webmaster', 'admin'),
			'name'		=> 'API Site',
			'url'		=> 'api',
			'target'	=> '_blank',
			'color'		=> 'text-orange'
		),
		array(
			'auth'		=> array('webmaster', 'admin', 'manager', 'staff'),
			'name'		=> 'Github Repo',
			'url'		=> CI_BOOTSTRAP_REPO,
			'target'	=> '_blank',
			'color'		=> 'text-green'
		),*/
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
$config['sess_cookie_name'] = 'ci_session_admin';