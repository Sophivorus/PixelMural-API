<?php

class Users extends Controller {

	static function GET() {
		$User = self::getUser();
		json( $User );
	}

	static function POST() {
		$User = new User( $_POST ); // Unsafe!
		$User->normalise();
		$User->validate();
		$User->update();
		json( $User );
	}
}