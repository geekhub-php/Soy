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

    public function init($url)
    {
        $client = new Client($url);
        $response = $client->get()->send();
        $this->crawler = new Crawler((string)$response->getBody());
    }

    public function getCardNumber()
    {
        $number_artist = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[style="padding: 0 0.5em;"] > small > b')->text();
        $number = substr($number_artist, 0, strpos($number_artist, ' '));

        return $number;
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

    public function getCardRarity()
    {
        $edition_rarity = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[style="padding: 0 0.5em;"] > small > b')->eq(1)->text();
        $rarity = substr($edition_rarity, strpos($edition_rarity, '(')+1, -1);

        return $rarity;
    }

    public function getCardEdition()
    {
        $edition_rarity = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[style="padding: 0 0.5em;"] > small > b')->eq(1)->text();
        $edition = substr($edition_rarity, 0, strpos($edition_rarity, '(')-1);

        return $edition;
    }

    public function getCardArtist()
    {
        $number_artist = $this->crawler->filter('body > table[style="margin: 0 0 0.5em 0;"] > tr >  td[style="padding: 0 0.5em;"] > small > b')->text();
        $artist = $artist = substr($number_artist, strpos($number_artist, '(')+1, -1);

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
            'mana' => $this->getCardMana()
        );

        return $cardData;
    }

}