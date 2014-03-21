<?php

namespace Soy\Bundle\ParseBundle\Parser;

use Doctrine\Common\Collections\ArrayCollection;
use Goutte\Client;
class CardParser
{
    /**
     * @var \Symfony\Component\DomCrawler\Crawler
     */
    private $crawler;

    public function init($url)
    {
        $client=new Client();
        $this->crawler=$client->request('GET',$url);
    }
    public function getCardTittle()
    {
        $tittle=$this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[valign="top"] > span[style="font-size: 1.5em;"] > a')->text();
        return $tittle;
    }
    public function getCardText()
    {
        $description=$this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[valign="top"] > p.ctext')->text();
        return $description;
    }
    public function getCardImage()
    {
        $image=$this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr > td[width="312"] > img')->getNode(0)->getAttribute('src');
        return $image;
    }
    public function getCardMana()
    {
        $text=$this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[valign="top"][style="padding: 0.5em;"] > p')->first()->text();
        $allstring=explode(", ",$text);
        $parts=explode(" (",$allstring[1]);
        return $parts[0];
    }
    public function getCardData()
    {
        $cardData=new ArrayCollection();
        $cardData->add($this->getCardTittle());
        $cardData->add($this->getCardText());
        $cardData->add($this->getCardImage());
        $cardData->add($this->getCardMana());
        return $cardData;



    }

}