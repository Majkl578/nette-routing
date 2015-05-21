<?php

/**
 * Test: Nette\Application\Routers\SimpleRouter basic functions.
 */

use Nette\Http,
	Nette\Application\Routers\SimpleRouter,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$router = new SimpleRouter([
	'id' => 12,
	'any' => 'anyvalue',
]);

$url = new Http\UrlScript('http://nette.org/file.php');
$url->setScriptPath('/file.php');
$url->setQuery([
	'presenter' => 'myPresenter',
	'action' => 'action',
	'id' => '12',
	'test' => 'testvalue',
]);
$httpRequest = new Http\Request($url);

$req = $router->match($httpRequest);
Assert::same( 'myPresenter',  $req->getPresenterName() );
Assert::same( 'action',  $req->parameters['action'] );
Assert::same( '12',  $req->parameters['id'] );
Assert::same( 'testvalue',  $req->parameters['test'] );
Assert::same( 'anyvalue',  $req->parameters['any'] );

$url = $router->constructUrl($req, $httpRequest->url);
Assert::same( 'http://nette.org/file.php?action=action&test=testvalue&presenter=myPresenter',  $url );
