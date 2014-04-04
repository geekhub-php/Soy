<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 05.03.14
 * Time: 21:12
 */

namespace Soy\Bundle\SoyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Soy\Bundle\SoyBundle\Entity\Artist;
use Soy\Bundle\SoyBundle\Entity\Type;
use Soy\Bundle\SoyBundle\Entity\Edition;
use Soy\Bundle\SoyBundle\Entity\Number;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
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
     * @ORM\ManyToMany(targetEntity="Number",inversedBy="cards", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="cards_numbers")
     */
    private $numbers;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\OneToOne(targetEntity="Image", inversedBy="card", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Artist",inversedBy="cards", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="artist_id",referencedColumnName="id")
     */
    private $artist;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $power;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $toughness;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $mana;

    /**
     * @ORM\Column(type="string")
     */
    private $rarity;

    /**
     * @ORM\ManyToMany(targetEntity="Format", inversedBy="cards", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="cards_formats")
     */
    private $formats;

    /**
     * @ORM\ManyToMany(targetEntity="Edition",inversedBy="cards", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="cards_editions")
     */
    private $editions;

    /**
     * @ORM\ManyToOne(targetEntity="Type",inversedBy="cards", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="type_id",referencedColumnName="id")
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity="Card", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="otherPart_id", referencedColumnName="id", nullable=true)
     */
    private $otherPart;

//    /**
//     * @ORM\Column(type="string", nullable=true)
//     */
//    private $loyalty;
//
//    /**
//     * @ORM\ManyToMany(targetEntity="Color",inversedBy="cards")
//     * @ORM\JoinTable(name="cards_colors")
//     */
//    private $colors;
//
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $locale;

    public function addColor(Color $color)
    {
        $color->addCard($this);
        $this->colors[] = $color;

        return $this;
    }

    public function removeColor(Color $color)
    {
        $this->colors->removeElement($color);
        $color->removeCard($this);
    }

    /**
     * @param mixed $colors
     */
    public function setColors($colors)
    {
        $this->colors = $colors;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @param mixed $loyalty
     */
    public function setLoyalty($loyalty)
    {
        $this->loyalty = $loyalty;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLoyalty()
    {
        return $this->loyalty;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $editions
     */
    public function setEditions($editions)
    {
        $this->editions = $editions;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEditions()
    {
        return $this->editions;
    }

    /**
     * @param Type
     */
    public function setType(Type $type)
    {
        $type->addCard($this);
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $mana
     */
    public function setMana($mana)
    {
        $this->mana = $mana;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMana()
    {
        return $this->mana;
    }

    /**
     * @param mixed $power
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param mixed $rarity
     */
    public function setRarity($rarity)
    {
        $this->rarity = $rarity;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRarity()
    {
        return $this->rarity;
    }


    public function __construct()
    {
        $this->colors = new ArrayCollection();
        $this->formats = new ArrayCollection();
        $this->editions = new ArrayCollection();
        $this->numbers = new ArrayCollection();
    }

    /**
     * @param mixed $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * @param Artist
     */
    public function addArtist($artist)
    {
        $artist->addCard($this);
        $this->artist = $artist;
    }

    /**
     * @return mixed
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param Image $image
     */
    public function setImage(Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function addFormat(Format $format)
    {
        $format->addCard($this);
        $this->formats[] = $format;

        return $this;
    }

    public function removeFormat(Format $format)
    {
        $this->formats->removeElement($format);
        $format->removeCard($this);

        return $this;
    }

    public function addEdition(Edition $edition)
    {
        $edition->addCard($this);
        $this->editions[] = $edition;

        return $this;
    }

    public function removeEdition(Edition $edition)
    {
        $this->editions->removeElement($edition);
        $edition->removeCard($this);

        return $this;
    }

    /**
     * @param mixed $formats
     */
    public function setFormats($formats)
    {
        $this->formats = $formats;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormats()
    {
        return $this->formats;
    }

    /**
     * @param mixed $toughness
     */
    public function setToughness($toughness)
    {
        $this->toughness = $toughness;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getToughness()
    {
        return $this->toughness;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    public function addNumber(Number $number)
    {
        $number->addCard($this);
        $this->numbers[] = $number;
    }

    public function removeNumber(Number $number)
    {
        $this->numbers->removeElement($number);
        $number->removeCard($this);
    }

    /**
     * @param mixed $otherPart
     */
    public function setOtherPart($otherPart)
    {
        $this->otherPart = $otherPart;
    }

    /**
     * @return mixed
     */
    public function getOtherPart()
    {
        return $this->otherPart;
    }


}