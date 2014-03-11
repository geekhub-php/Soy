<?php

namespace Soy\Bundle\ParseBundle\Parser;


use Doctrine\Common\Collections\ArrayCollection;
//use Goutte\Client;
use Guzzle\Http\Client;
use Symfony\Component\DomCrawler\Crawler;

class SitemapParser
{
    private $urls;
    const SITEMAP_URL='http://magiccards.info/sitemap.html';
    const SITE_URL='http://magiccards.info';
    /**
     * @var \Symfony\Component\DomCrawler\Crawler
     */
    private $crawler;

    public function __construct()
    {
        $client = new Client(self::SITEMAP_URL);
        $response = $client->get()->send();
        $this->crawler = new Crawler((string)$response->getBody());
    }

    public function parseUrlsByLocale($locale)
    {
        $position=0;
        switch ($locale){
            case 'en':
                $position=0;
               break;
            case 'de':
                $position=1;
                break;
            case 'fr':
                $position=2;
                break;
            case 'it':
                $position=3;
                break;
            case 'es':
                $position=4;
                break;
            case 'pt':
                $position=5;
                break;
            case 'jp':
                $position=6;
                break;
            case 'cn':
                $position=7;
                break;
            case 'ru':
                $position=8;
                break;
            case 'tw':
                $position=9;
               break;
            case 'ko':
                $position=10;
                break;
        }

        $this->urls = new ArrayCollection();
        $sitemapLinks = $this->crawler->filter('body > table[cellpadding="0"][cellspacing="0"][width="100%"][border="0"]')
            ->eq($position)->filter('a')->each(
                function(Crawler $node)
                {
                    return self::SITE_URL.$node->attr('href');
                });

        /**
         * @var \DomElement $domElement
         */
       //foreach($sitemapLinks as $sitemapLink){
        for ($i=0;$i<3;$i++)
        {
           print $sitemapLinks[$i];
            $client = new Client($sitemapLinks[$i]);
            $page = (string)$client->get()->send()->getBody();
            $crawler = new Crawler($page);

            $links = $crawler->filter('body > table[cellpadding="3"] > tr > td > a')->each(
                function(Crawler $node)
                {
                    return self::SITE_URL.$node->attr('href');
                });

            foreach ($links as $link){
                $this->setUrl($link);
            }
//            $client->request('GET',self::SITEMAP_URL);
        }
    }
    private function setUrl($url)
    {
        $this->urls[]=$url;
    }
    public function getUrls()
    {
        return $this->urls;
    }

}