<?php

require_once __DIR__ . '/vendor/autoload.php';

use \GuzzleHttp\Client;
use \Jayrods\AluraCourses\{AluraCoursesSearch, CryptocurrencyPricesProvider};
use \Symfony\Component\DomCrawler\Crawler;

# --------------------------------------------------------------------------------
# AUTOLOADING SEPARATE CLASSES AND FILES WITH COMPOSER AUTOLOAD

// TestClass::test();

// var_dump(env('RANDOM_VARIABLE_TEST', 'no value found'));

// exit;

# --------------------------------------------------------------------------------
# GETTING ALURA PHP COURSES WITH CRAWLER

$client = new Client(array(
    'base_uri' => 'https://www.alura.com.br/'
));

$crawler = new Crawler();

$buscador = new AluraCoursesSearch($client, $crawler);

$courses = $buscador->search('cursos-online-programacao/php');

foreach ($courses as $course) {
    echo $course . PHP_EOL;
}

# --------------------------------------------------------------------------------
# GETTING CRYPTOCURRENCIES PRICES WITH CRAWLER

// $client = new Client(['base_uri' => 'https://coinmarketcap.com/']);

// $crawler = new Crawler();

// $buscador = new CryptocurrencyPricesProvider($client, $crawler);

// $currencies = $buscador->search('');

# --------------------------------------------------------------------------------
#
