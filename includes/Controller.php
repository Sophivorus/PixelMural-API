<?php

abstract class Controller {

	static function getUser() {

		// First check if the user is authenticated
		if ( array_key_exists( 'Auth-Token', $_SERVER ) ) {
			$token = $_SERVER[ 'Auth-Token' ];
			$User = User::newFromToken( $token );
			if ( $User ) {
				return $User;
			}
		}

		// If not, check if the anon already exists
		$ip = $_SERVER[ 'REMOTE_ADDR' ];
		$User = User::newFromIp( $ip );
		if ( $User ) {
			return $User;
		}

		// Else, create a new anon
		$User = new User;
		$User->name = $ip; // IPs are the names of anonymous users
		$User->status = 'anon';
		$User->stroke = 1;
		$User->insert();
		return $User;
	}
}