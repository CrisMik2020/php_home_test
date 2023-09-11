
<?php
define('LOGIN_USERNAME', 'admin');
define('LOGIN_PASSWORD', '3188d808-a4c2-4a42-a713-78d77c1fe884');

define('URL_TO_CURRENT_FILE_RELATIVE_TO_DOMAIN', $_SERVER['URL'] ?? $_SERVER['SCRIPT_NAME']); // esempio: /mailup-landing/client.php;
define('PROJECT_ROOT_PATH', dirname(dirname(dirname((new ReflectionClass(\Composer\Autoload\ClassLoader::class))->getFileName()))));
define(
    'URL_ROOT_PORTION', // esempio: /mailup-landing/
    str_replace(
        str_replace(DIRECTORY_SEPARATOR, '/', str_replace( // ritorna /src/constants.php
            PROJECT_ROOT_PATH,
            '',
            ($dbg = debug_backtrace())[count($dbg) - 1]['file']
        )),
        '',
        URL_TO_CURRENT_FILE_RELATIVE_TO_DOMAIN
    )
);

define('CSV_PATH', __DIR__ . '/../data/db.csv');
function htmlEncode(string $string): string
{
	return htmlentities($string, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'utf-8');
}
