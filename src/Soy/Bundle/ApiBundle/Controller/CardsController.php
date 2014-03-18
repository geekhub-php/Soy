<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 13.03.14
 * Time: 20:52
 */

namespace Soy\Bundle\ApiBundle\Controller;


use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CardController extends Controller
{
    public function getCardAction($slug)
    {
        $card=$this->getDoctrine()->getRepository('SoyBundle:Card')->find($slug);
        $view = new View();
        $view->setData($card)
              ->setFormat('json');
        return $this->get('fos_rest.view_handler')->handle($view);
    }


}