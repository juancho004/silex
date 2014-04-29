<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use \Doctrine\Common\Cache\ApcCache;
use \Doctrine\Common\Cache\ArrayCache;
use Silex\Provider\FormServiceProvider;
use Symfony\Component\HttpFoundation\Response;


$app      = new Application();
$confp    = new Lib('conn');

$app->register(new FormServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());

$app->register(new Silex\Provider\ModelsServiceProvider(), array(
  'models.path' => __DIR__ . DS . 'models' . DS
));

$app->register(new TwigServiceProvider(), array(
  'twig.path'    => array(PATH_TEMPLATES.DS.'install'),
  #'twig.options' => array('cache' => PATH_CACHE.'/twig'), 
));

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
  #add custom globals, filters, tags, ...
  $path = PATH_TEMPLATES.DS.'install';
  $app['template'] = $path;
  return $twig;
}));




#instancia de modelos
$install  = new InstallSilex($app);


$app->error(function (\LogicException $e, $code) {
  $error_logic = error_get_last();
  $error_logic = "[date: ".date('r')."] [type: ".$error_logic['type']."] [pid: ".getmypid()."] [client: ".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT']."] PHP ".$error_logic['message']." ".$error_logic['file']." on line ".$error_logic['line']."\n";
  error_log($error_logic, 3, PATH_ROOT."/logs/errors.log");
});

$app->error(function (\Exception $e, $code) use ($app) {

  switch ($code) {
  case 404:
    $message = 'Lo sentimos, la pagina No existe 404';
  break;

  default:
    $message = 'Lo sentimos, la pagina No existe';
  break;
  }
  echo $message;
  exit;
});

return $app;
