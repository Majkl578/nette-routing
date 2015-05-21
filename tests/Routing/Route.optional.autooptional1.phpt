<?php

/**
 * Test: Nette\Application\Routers\Route and auto-optional as optional sequences.
 */

use Nette\Application\Routers\Route,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';

require __DIR__ . '/Route.inc';


$route = new Route('<presenter>/[<action>/[<id \d{1,3}>]]', [
	'action' => 'default',
]);

testRouteIn($route, '/presenter/action/12/any');

testRouteIn($route, '/presenter/action/12/', 'Presenter', [
	'action' => 'action',
	'id' => '12',
	'test' => 'testvalue',
], '/presenter/action/12?test=testvalue');

testRouteIn($route, '/presenter/action/12', 'Presenter', [
	'action' => 'action',
	'id' => '12',
	'test' => 'testvalue',
], '/presenter/action/12?test=testvalue');

testRouteIn($route, '/presenter/action/1234');

testRouteIn($route, '/presenter/action/', 'Presenter', [
	'action' => 'action',
	'id' => NULL,
	'test' => 'testvalue',
], '/presenter/action/?test=testvalue');

testRouteIn($route, '/presenter/action', 'Presenter', [
	'action' => 'action',
	'id' => NULL,
	'test' => 'testvalue',
], '/presenter/action/?test=testvalue');

testRouteIn($route, '/presenter/', 'Presenter', [
	'action' => 'default',
	'id' => NULL,
	'test' => 'testvalue',
], '/presenter/?test=testvalue');

testRouteIn($route, '/presenter', 'Presenter', [
	'action' => 'default',
	'id' => NULL,
	'test' => 'testvalue',
], '/presenter/?test=testvalue');

testRouteIn($route, '/');
