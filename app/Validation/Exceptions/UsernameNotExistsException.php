<?php
namespace Validation\Exceptions;
/**
 * Description of UsernameNotExistsException
 *
 * @author Admin
 */

use Respect\Validation\Exceptions\ValidationException;

class UsernameNotExistsException extends ValidationException {
	
	public static $defaultTemplates = array(
		self::MODE_DEFAULT => [
			'Le nom d\'utilisateur existe déjà'
		],
		self::MODE_NEGATIVE => [
			'Le nom d\'utilisateur existe déjà'
		]
	);
}
