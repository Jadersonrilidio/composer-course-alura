<?php

namespace Jayrods\AluraCourses;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class CryptocurrencyPricesProvider
{
    /**
     * @var ClientInterface
     */
    private ClientInterface $httpClient;

    /**
     * @var Crawler
     */
    private Crawler $crawler;

    /**
     * AluraCoursesSearch class Constructor.
     *
     * @param ClientInterface $httpClient
     * @param Crawler         $crawler
     *
     * @return void
     */
    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    /**
     * Search for the courses on the alura website referenced page.
     *
     * @param string $url The URL address to search with.
     *
     * @return array
     */
    public function search(string $url): array
    {
        $response = $this->httpClient->request('GET', $url);

        $html = $response->getBody();

        $this->crawler->addHtmlContent($html);

        //todo - resolve how to work with complex html entities with Crawler
        $list = $this->crawler->filter('a.cmc-link');

        $currencies = array();

        foreach ($list as $item) {
            var_dump($item->childNodes);
            print_r($item);
            $currencies[] = 'nothing yet';
        }

        return $currencies;
    }
}
