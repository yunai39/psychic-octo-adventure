<?php

$config = array(
	'security'		=> array(
			'user_class'		=> 	'CMS\Model\User',
			'user_encoder'		=> 	'md5',
			'user_provider'		=>	'CMS\Service\MyUserProvider',
	),
	
);