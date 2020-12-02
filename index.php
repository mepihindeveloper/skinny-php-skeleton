<?php
declare(strict_types = 1);

use skinny\Skinny;

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

defined('IS_CLI') or define('IS_CLI', PHP_SAPI === 'cli');
defined('ROOT') or define('ROOT', (IS_CLI ? getenv('PWD') : $_SERVER['DOCUMENT_ROOT']) . '/');

require_once __DIR__ . '/vendor/autoload.php';

/** @var Skinny $app */
$app = Skinny::getInstance();

$app->get('index', '', static function()
{
	return 'Welcome to index page';
});

$app->post('home', 'home', static function() use ($app)
{
	return $app->getResponse()->json(['Welcome to home page']);
});

if (!$app->run())
{
	throw new RuntimeException('Ошибка запроса. Не найдены совпадения по указанному маршруту.');
}
?>

<script
		src="https://code.jquery.com/jquery-3.5.1.min.js"
		integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
		crossorigin="anonymous"></script>

<script>
    $.post('/home', {}, response => {
        console.log(response);
    });
</script>
