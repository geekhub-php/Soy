<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 05.03.14
 * Time: 21:12
 */

namespace Soy\Bundle\SoyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(type="string")
     */
    private $title;
    /**
     * @ORM\Column(type="text")
     */
    private $text;
    /**
     * @ORM\OneToOne(targetEntity="Image")
     */
    private $image;
    /**
     * @ORM\ManyToOne(targetEntity="Artist",inversedBy="cards")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="type_id",referencedColumnName="id")
     * })
     */
    private $artist;
    /**
     * @ORM\Column(type="integer")
     */
    private $power;
    /**
     * @ORM\Column(type="string")
     */
    private $mana;
    /**
     * @ORM\Column(type="string")
     */
    private $rarity;
    /**
     * @ORM\Column(type="integer")
     */
    private $toughness;
    /**
     * @ORM\ManyToMany(targetEntity="Format",inversedBy="cards")
     * @ORM\JoinTable(name="cards_formats")
     */
    private $formats;
    /**
     * @ORM\ManyToMany(targetEntity="Edition",inversedBy="cards")
     * @ORM\JoinTable(name="cards_editions")
     */
    private $editions;
    /**
     * @ORM\ManyToOne(targetEntity="Type",inversedBy="cards")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="type_id",referencedColumnName="id")
     * })
     */
    private $type;
    /**
     * @ORM\Column(type="string")
     */
    private $loyalty;
    /**
     * @ORM\ManyToMany(targetEntity="Color",inversedBy="cards")
     * @ORM\JoinTable(name="cards_colors")
     */
    private $colors;

    public function addColor(Color $color)
    {
        $color->addCard($this);
        $this->colors[] = $color;
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
    }

    /**
     * @return mixed
     */
    public function getLoyalty()
    {
        return $this->loyalty;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $locale;

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
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
    }

    /**
     * @return mixed
     */
    public function getEditions()
    {
        return $this->editions;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
    }

    /**
     * @param mixed $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    /**
     * @return mixed
     */
    public function getArtists()
    {
        return $this->artist;
    }

    /**
     * @param Image $image
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
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
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function getId()
    {
        return $this->id;
    }


    public function addFormat(Format $format)
    {
        $format->addCard($this);
        $this->formats[] = $format;
    }

    public function removeFormat(Format $format)
    {
        $this->formats->removeElement($format);
        $format->removeCard($this);
    }

    public function addEdition(Edition $edition)
    {
        $edition->addCard($this);
        $this->editions[] = $edition;
    }

    public function removeEdition(Edition $edition)
    {
        $this->editions->removeElement($edition);
        $edition->removeCard($this);
    }

    /**
     * @param mixed $formats
     */
    public function setFormats($formats)
    {
        $this->formats = $formats;
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
    }

    /**
     * @return mixed
     */
    public function getToughness()
    {
        return $this->toughness;
    }

}