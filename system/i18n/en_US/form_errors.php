<?php
$lang = array
(
		'contact_name' => array
			(
				'required' => 'The name field cannot be left blank.',
				'standard_text' => 'Only standard text allowed in the name field.',
				'length' => 'The name field must be between 2 and 20 characters in length.',
			),

		'contact_email' => array
			(
				'required' => 'The email field cannot be left blank.',
				'email' => 'The email must be in a valid email format.',
				'email_domain' => 'The email must be a valid email address.',
			),

		'contact_subject' => array
			(
				'required' => 'The subject cannot be left blank.',
				'length' => 'The subject must be between 5 and 30 characters in length.',
				'standard_text' => 'The subject can only contain standard text characters.',
			),

		'contact_message' => array
			(
				'required' => 'The message field cannot be left blank.',
				'standard_text' => 'The message can only contain standard text characters.',
			),
		'password' => array
			(
				'incorrect' => 'invalid password : please re-enter your password',
				'required' => 'The password field cannot be left blank.',
				'length' => 'Password must be between 4 and 120 characters in length.',
				'default' => 'Password field error',
			),
		'password_confirm' => array
				(
				'required' => 'The password confirm field cannot be left blank.',
				'default' => 'Please enter the same password in both fields for confirmation.',
				),
		'username' => array
			(
				'not_found' => 'invalid username : please re-enter your correct username',
				'required' => 'The password field cannot be left blank.',
				'length' => 'Username must be between 4 and 120 characters in length.',
				'username_exists' => 'The username you entered is already registered on Snippetz, please select another',
			),
		'email' => array
				(
				'required' => 'The email field cannot be left blank.',
				'email' => 'The email must be in a valid email format.',
				'email_domain' => 'The email must be a valid email address.',
				'username_exists' => 'The email you entered is already registered on Snippetz',
				),
		'profile_pic' => array
				(
				'url' => 'Your profile pic must be a valid URL',
				'default' => 'Your profile pic must be a valid URL.',
				)
				
);