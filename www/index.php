<?php

/**
 * DEMO APP
 * todo tests
 */

use Ing\QRCode as QR;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

//$app['debug'] = true;

$app->match('/', function (Request $request) {
    // todo validation
    $text = (string) $request->get('t', 'Hello World!');
    $width = (int) $request->get('w', 200);
    $height = (int) $request->get('h', 200);

    $qrCode = new QR\QRCode($text, $width, $height);
    $qrCode->setRenderer(new QR\Renderer\GoogleChartsRenderer());

    return $qrCode->generate();
});

$app->run();
