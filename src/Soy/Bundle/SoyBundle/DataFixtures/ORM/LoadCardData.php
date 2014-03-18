<?php
/**
 * Created by PhpStorm.
 * User: kanni
 * Date: 3/18/14
 * Time: 6:26 PM
 */

namespace Soy\Bundle\SoyBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
//use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Soy\Bundle\SoyBundle\Entity\Card;
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
            $cardObject = new Card();
            $cardObject->setNumber($card['number'])
                ->setName($card['name'])
                ->setType($card['type'])
                ->setRarity($card['rarity'])
                ->setEdition($card['edition'])
                ->setArtist($card['artist'])
                ->setText($card['text'])
                ->setImage($card['image'])
                ->setMana($card['mana']);

            $manager->persist($cardObject);
        }

        $manager->flush();
    }

    public function getCardFile()
    {
        return __DIR__.'/../data/card-data.yml';
    }

} 