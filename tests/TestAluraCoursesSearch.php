<?php

namespace Jayrods\AluraCourses\Tests;

use \Jayrods\AluraCourses\AluraCoursesSearch;
use \PHPUnit\Framework\TestCase;
use \Symfony\Component\DomCrawler\Crawler;
use \Psr\Http\Message\StreamInterface;
use \Psr\Http\Message\ResponseInterface;
use \GuzzleHttp\ClientInterface;

class TestAluraCoursesSearch extends TestCase
{
    /**
     * 
     */
    private $httpClientMock;

    /**
     * 
     */
    private $url = 'url-test';

    /**
     * 
     */
    protected function setUp(): void
    {
        $html = <<<FIM
            <html>
                <body>
                    <span class="card-curso__nome">Course Test 1</span>
                    <span class="card-curso__nome">Course Test 2</span>
                    <span class="card-curso__nome">Course Test 3</span>
                <body>
            <html>
        FIM;

        $stream = $this->createMock(StreamInterface::class);
        $stream->expects($this->once())
            ->method('__toString')
            ->willReturn($html);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->expects($this->once())
            ->method('request')
            ->with('GET', $this->url)
            ->willReturn($response);

        $this->httpClientMock = $httpClient;
    }

    /**
     * 
     */
    public function testSearchMustReturnCourses()
    {
        $crawler = new Crawler();
        $buscador = new AluraCoursesSearch($this->httpClientMock, $crawler);
        $courses = $buscador->search($this->url);

        $this->assertCount(3, $courses);
        $this->assertEquals('Course Test 1', $courses[0]);
        $this->assertEquals('Course Test 2', $courses[1]);
        $this->assertEquals('Course Test 3', $courses[2]);
    }
}
