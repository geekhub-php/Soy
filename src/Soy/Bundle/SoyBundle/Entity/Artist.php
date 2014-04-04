<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 06.03.14
 * Time: 19:59
 */

namespace Soy\Bundle\SoyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Artist
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
     * @ORM\OneToMany(targetEntity="Card",mappedBy="artists")
     */
    private $cards;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    public function __construct()
    {
        $this->cards = new ArrayCollection();
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $cards
     */
    public function setCards($cards)
    {
        $this->cards = $cards;
    }

    public function addCard(Card $card)
    {
        $this->cards[]=$card;
    }

    /**
     * @return mixed
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

}