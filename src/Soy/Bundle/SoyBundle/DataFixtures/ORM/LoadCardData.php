<?php
/**
 * Created by PhpStorm.
 * User: kanni
 * Date: 3/18/14
 * Time: 6:26 PM
 */

namespace Soy\Bundle\SoyBundle\DataFixtures\ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\AbstractFixture;
//use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Soy\Bundle\SoyBundle\Entity\Card;
use Soy\Bundle\SoyBundle\Entity\Image;
use Soy\Bundle\SoyBundle\Entity\Artist;
use Soy\Bundle\SoyBundle\Entity\Edition;
use Soy\Bundle\SoyBundle\Entity\Type;
use Soy\Bundle\SoyBundle\Entity\Number;
use Soy\Bundle\SoyBundle\Entity\Format;
use Symfony\Component\Yaml\Yaml;

class LoadCardData extends AbstractFixture //implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $cards = Yaml::parse($this->getCardFile());

        foreach($cards as $card){
            $this->createImage($card['image']);
            $this->createArtist($card['artist']);
            $this->createEditions($card['edition']);
            $this->createFormats($card['format']);
            $this->createType($card['type']);
            $this->createNumbers($card['number']);
            $cardObject = new Card();
            $cardObject->setName($card['name'])
                ->setText($card['text'])
                ->setPower($card['powerAndToughness']['power'])
                ->setToughness($card['powerAndToughness']['toughness'])
                ->setRarity($card['rarity'])
                ->setImage($this->getReference('image'))
                ->setMana($card['mana'])
                ->setType($this->getReference($card['type']))
                ->addArtist($this->getReference($card['artist']));

            foreach($card['edition'] as $edition){
                $cardObject->addEdition($this->getReference($edition));
            }
            foreach($card['number'] as $number){
                $cardObject->addNumber($this->getReference($number));
            }
            foreach($card['format'] as $format){
                $cardObject->addFormat($this->getReference($format));
            }
            $this->createOtherPart($card['otherPart'], $cardObject);

            $manager->persist($cardObject);
        }

        $manager->flush();
    }

    public function createImage($path)
    {
        $image = new Image();
        $image->setPath($path);
        $this->setReference('image', $image);

        return $image;
    }

    public function createType($type)
    {
        $typeObject = NULL;
        if(!$this->hasReference($type)){
            $typeObject = new Type();
            $this->setReference($type, $typeObject);
            $typeObject->setName($type);
        }

        return $typeObject;
    }

    public function createArtist($name)
    {
        $artist = NULL;
        if(!$this->hasReference($name)){
            $artist = new Artist();
            $artist->setName($name);
            $this->setReference($name, $artist);
        }

        return $artist;
    }

    public function createNumbers(array $numbers)
    {
        $numberObjects = new ArrayCollection();
        foreach($numbers as $number){
            if(!$this->hasReference($number)){
                $numberObject = new Number();
                $numberObject->setName($number);
                $this->setReference($number, $numberObject);
                $numberObjects[] = $numberObject;
            }
        }

        return $numberObjects;
    }

    public function createEditions(array $editions)
    {
        $editionObjects = new ArrayCollection();
        foreach($editions as $edition){
            if(!$this->hasReference($edition)){
                $editionObject = new Edition();
                $editionObject->setName($edition);
                $this->setReference($edition, $editionObject);
                $editionObjects[] = $editionObject;
            }
        }

        return $editionObjects;
    }

    public function createFormats(array $formats)
    {
        $formatObjects = new ArrayCollection();
        foreach($formats as $format){
            if(!$this->hasReference($format)){
                $formatObject = new Format();
                $formatObject->setName($format);
                $this->setReference($format, $formatObject);
                $formatObjects[] = $formatObject;
            }
        }

        return $formatObjects;
    }

    public function createOtherPart($name, Card $cardObject)
    {
        if($name !== NULL){
            $this->setReference($cardObject->getName(), $cardObject);
            if($this->hasReference($name)){
                $cardObject->setOtherPart($this->getReference($name));
                $this->getReference($name)->setOtherPart($cardObject);
            }
        }
    }

    public function getCardFile()
    {
        return __DIR__.'/../data/cards.yml';
    }

} 