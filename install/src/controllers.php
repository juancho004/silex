<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$app->match('/', function () use ($app, $install ){

	return new Response(
		$app['twig']->render( 'home.twig', array() )
	);
	

})->method('GET|POST');
