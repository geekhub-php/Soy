<?php

namespace Soy\Bundle\SoyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Card
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Card
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="rarity", type="string", length=255)
     */
    private $rarity;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="edition", type="object")
     */
    private $edition;

    /**
     * @var string
     *
     * @ORM\Column(name="artist", type="string", length=255)
     */
    private $artist;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="mana", type="string", length=255)
     */
    private $mana;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Card
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Card
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Card
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set rarity
     *
     * @param string $rarity
     * @return Card
     */
    public function setRarity($rarity)
    {
        $this->rarity = $rarity;
    
        return $this;
    }

    /**
     * Get rarity
     *
     * @return string 
     */
    public function getRarity()
    {
        return $this->rarity;
    }

    /**
     * Set edition
     *
     * @param \stdClass $edition
     * @return Card
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;
    
        return $this;
    }

    /**
     * Get edition
     *
     * @return \stdClass 
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * Set artist
     *
     * @param string $artist
     * @return Card
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    
        return $this;
    }

    /**
     * Get artist
     *
     * @return string 
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Card
     */
    public function setText($text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Card
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set mana
     *
     * @param string $mana
     * @return Card
     */
    public function setMana($mana)
    {
        $this->mana = $mana;
    
        return $this;
    }

    /**
     * Get mana
     *
     * @return string 
     */
    public function getMana()
    {
        return $this->mana;
    }
}
