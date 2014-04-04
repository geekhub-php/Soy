<?php

namespace Soy\Bundle\ParseBundle\Parser;

use Doctrine\Common\Collections\ArrayCollection;
//use Goutte\Client;
use Guzzle\Http\Client;
use Symfony\Component\DomCrawler\Crawler;

class CardParser
{
    /**
     * @var \Symfony\Component\DomCrawler\Crawler
     */
    private $crawler;

    private $otherPart;

    /**
     * @param mixed $otherPart
     */
    public function setCardOtherPart($otherPart)
    {
        $this->otherPart = $otherPart;
    }

    /**
     * @return mixed
     */
    public function getCardOtherPart()
    {
        return $this->otherPart;
    }

    public function init($url)
    {
        $client = new Client($url);
        $response = $client->get()->send();
        $this->crawler = new Crawler((string)$response->getBody());
    }

    public function getCardNumber()
    {
        $numbers = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[style="padding: 0 0.5em;"] > small > u')
            ->eq(1)->previousAll()->filter('a')
            ->each(function(Crawler $node){
                return trim($node->text());
            });
        $numbers = array_reverse($numbers);

        foreach(array_keys($numbers) as $key){
            if(strpos($numbers[$key], '#') !== 0){
                $this->setCardOtherPart($numbers[$key]);
                unset($numbers[$key]);
            }
        }

        $number_artist = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[style="padding: 0 0.5em;"] > small > b')->text();
        array_unshift($numbers, substr($number_artist, 0, strpos($number_artist, ' ')));

        return $numbers;
    }

    public function getCardName()
    {
        $name = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[valign="top"] > span[style="font-size: 1.5em;"] > a')->text();

        return $name;
    }

    public function getCardType()
    {
        $type_mana = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[valign="top"][style="padding: 0.5em;"][width="70%"] > p')->first()->text();
        $type = substr($type_mana, 0, strpos($type_mana, ','));

        if(strlen($type==NULL)){
            $type = trim($type_mana);
        }

        return $type;
    }

    public function getCardPowerAndToughness()
    {
        $type = $this->getCardType();
        if(!strpos($type, '/')){
            $powerAndToughness = array(
                'power' => NULL,
                'toughness' => NULL
            );
        } else {
            $powerAndToughness = substr($type, strpos($type, '/')-1);
            $powerAndToughness = array(
                'power' => substr($powerAndToughness, 0, 1),
                'toughness' => substr($powerAndToughness, -1)
            );
        }

        return $powerAndToughness;
    }

    public function getCardRarity()
    {
        $edition_rarity = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[style="padding: 0 0.5em;"] > small > b')->eq(1)->text();
        $rarity = substr($edition_rarity, strpos($edition_rarity, '(')+1, -1);

        return $rarity;
    }

    public function getCardEdition()
    {
        $editions = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[style="padding: 0 0.5em;"] > small > u')
            ->eq(2)->previousAll()->filter('a')
            ->each(function(Crawler $node){
                if(strpos($node->text(), '#')!==0){
                    return $node->text();
                }
            });

        foreach (array_keys($editions) as $key) {
            if($editions[$key]==NULL or $editions[$key]==$this->getCardOtherPart()){
                unset($editions[$key]);
            }
        }
        $editions = array_reverse($editions);

        $edition_rarity = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[style="padding: 0 0.5em;"] > small > b')->eq(1)->text();
        array_unshift($editions, substr($edition_rarity, 0, strpos($edition_rarity, '(')-1));

        return $editions;
    }

    public function getCardArtist()
    {
        $number_artist = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[style="padding: 0 0.5em;"] > small > b')->text();
        $artist = substr($number_artist, strpos($number_artist, '(')+1, -1);

        return $artist;
    }

    public function getCardText()
    {
        $description = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[valign="top"] > p.ctext')->text();

        return $description;
    }

    public function getCardImage()
    {
        $image = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr > td[width="312"] > img')->attr('src');

        return $image;
    }

    public function getCardMana()
    {
        $type_mana = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[valign="top"][style="padding: 0.5em;"] > p')->first()->text();
        if(strpos($type_mana,',')!=false){
            $mana = substr($type_mana, strpos($type_mana, ',')+1);
            $mana = trim($mana);
        }else{
            $mana = NULL;
        }

        return $mana;
    }

    public function getCardFormat()
    {
        $formats = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[valign="top"] > ul > li.legal')
            ->each(function(Crawler $node){
                return $node->text();
            });

        return $formats;
    }

    public function getCardData()
    {
        $cardData = array(
            'number' => $this->getCardNumber(),
            'name' => $this->getCardName(),
            'type' => $this->getCardType(),
            'rarity' => $this->getCardRarity(),
            'edition' => $this->getCardEdition(),
            'artist' => $this->getCardArtist(),
            'text' => $this->getCardText(),
            'image' => $this->getCardImage(),
            'mana' => $this->getCardMana(),
            'powerAndToughness' => $this->getCardPowerAndToughness(),
            'format' => $this->getCardFormat(),
            'otherPart' => $this->getCardOtherPart()
        );

        $this->setCardOtherPart(NULL);

        return $cardData;
    }

}