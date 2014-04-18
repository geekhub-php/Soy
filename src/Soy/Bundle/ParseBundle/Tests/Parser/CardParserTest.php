<?php

namespace Soy\Bundle\ParseBundle\Tests\Parser;


use Soy\Bundle\ParseBundle\Parser\CardParser;

class CardParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider numberProvider
     */
    public function testGetCardNumber($expected, $actual)
    {
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider nameProvider
     */
    public function testGetCardName($expected, $actual)
    {
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider typeProvider
     */
    public function testGetCardType($expected, $actual)
    {
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider editionProvider
     */
    public function testGetCardEdition($expected, $actual)
    {
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider rarityProvider
     */
    public function testGetCardRarity($expected, $actual)
    {
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider manaProvider
     */
    public function testGetCardMana($expected, $actual)
    {
        $this->assertEquals($expected, $actual);
    }

    public function numberProvider()
    {
        for ($i = 0; $i < 5; $i++) {
            $parsers[$i] = new CardParser();
            $parsers[$i]->init("http://magiccards.info/bng/en/{$i}.html");
            $data[$i] = $parsers[$i]->getCardNumber();
        }
        return array
        (
            array(1, $data[0]),
            array(2, $data[1]),
            array(3, $data[2]),
            array(4, $data[3]),
            array(5, $data[4])
        );
    }

    public function nameProvider()
    {
        for ($i = 0; $i < 5; $i++) {
            $parsers[$i] = new CardParser();
            $parsers[$i]->init("http://magiccards.info/bng/en/{$i}.html");
            $data[$i] = $parsers[$i]->getCardName();
        }
        return array
        (
            array("Acolyte's Reward", $data[0]),
            array("Akroan Phalanx", $data[1]),
            array("Akroan Skyguard", $data[2]),
            array("Archetype of Courage", $data[3]),
            array("Brimaz, King of Oreskos", $data[4])
        );

    }

    public function typeProvider()
    {
        for ($i = 0; $i < 5; $i++) {
            $parsers[$i] = new CardParser();
            $parsers[$i]->init("http://magiccards.info/bng/en/{$i}.html");
            $data[$i] = $parsers[$i]->getCardType();
        }
        return array
        (
            array("Instant", $data[0]),
            array("Creature — Human Soldier 3/3", $data[1]),
            array("Creature — Human Soldier 1/1", $data[2]),
            array("Enchantment Creature — Human Soldier 2/2", $data[3]),
            array("Legendary Creature — Cat Soldier 3/4", $data[4])
        );

    }

    public function editionProvider()
    {
        for ($i = 0; $i < 5; $i++) {
            $parsers[$i] = new CardParser();
            $parsers[$i]->init("http://magiccards.info/bng/en/{$i}.html");
            $data[$i] = $parsers[$i]->getCardEdition();
        }
        return array
        (
            array("Born of the Gods", $data[0]),
            array("Born of the Gods", $data[1]),
            array("Born of the Gods", $data[2]),
            array("Born of the Gods", $data[3]),
            array("Born of the Gods", $data[4])
        );

    }

    public function rarityProvider()
    {
        for ($i = 0; $i < 5; $i++) {
            $parsers[$i] = new CardParser();
            $parsers[$i]->init("http://magiccards.info/bng/en/{$i}.html");
            $data[$i] = $parsers[$i]->getCardRarity();
        }
        return array
        (
            array("Uncommon", $data[0]),
            array("Uncommon", $data[1]),
            array("Common", $data[2]),
            array("Uncommon", $data[3]),
            array("Mythic Rare", $data[4])
        );
    }

    public function manaProvider()
    {
        for ($i = 0; $i < 5; $i++) {
            $parsers[$i] = new CardParser();
            $parsers[$i]->init("http://magiccards.info/bng/en/{$i}.html");
            $data[$i] = $parsers[$i]->getCardMana();
        }
        return array
        (
            array("1W", $data[0]),
            array("3W", $data[1]),
            array("1W", $data[2]),
            array("1WW", $data[3]),
            array("1WW", $data[4])
        );

    }


}
 