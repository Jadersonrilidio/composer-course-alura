#!/usr/bin/env php
<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Jayrods\AluraCourses\{AluraCoursesSearch};
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(array(
    'base_uri' => 'https://www.alura.com.br/'
));

$crawler = new Crawler();

$buscador = new AluraCoursesSearch($client, $crawler);

$courses = $buscador->search('cursos-online-programacao/php');

foreach ($courses as $course) {
    echo $course . PHP_EOL;
}
