<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 13.03.14
 * Time: 20:52
 */

namespace Soy\Bundle\ApiBundle\Controller;


use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\RequestParam;

class CardsController extends Controller
{
    /**
     * @View()
     * @RequestParam(name="cardName",requirements="[a-z]+")
     */
    public function getCardAction(ParamFetcher $paramFetcher)
    {
        $cardName = $paramFetcher->get('cardName');
        $card = $this->getDoctrine()->getRepository('SoyBundle:Card')->find($cardName);
        return $card;
    }

    /**
     * @View()
     */
    public function getCardsAction()
    {
        return $this->getDoctrine()->getRepository('SoyBundle:Card')->findAll();
    }


}