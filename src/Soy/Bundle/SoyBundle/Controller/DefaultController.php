<?php

namespace Soy\Bundle\SoyBundle\Controller;

use Soy\Bundle\SoyBundle\Entity\Search;
use Soy\Bundle\SoyBundle\Form\Type\SearchFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function mainAction()
    {

    }

    public function randomCardAction()
    {
        $card = $this->getDoctrine()->getRepository('SoyBundle:Card')->find(rand(1, 50));
        $form = $this->createForm(new SearchFormType(), null)->createView();
        return $this->render('');
    }

    /**
     * Traditional search for a card tittle
     * Search for parameters if request is @parameter=value,parameter=value
     */
    public function searchCardsAction(Request $request)
    {
        $search = new Search();
        $searchForm = $this->createForm(new SearchFormType(), $search);
        $searchForm->handleRequest($request);
        $cardSpec = array();

        if ($searchForm->isValid()) {
            if ($search->getRequest()[0] <> '@') {
                $card = $this->getDoctrine()->getRepository('SoyBundle:Card')->find($search->getRequest());
            } else {
                $normalRequest = str_replace('@', '', $search->getRequest());
                $criterias = explode(',', $normalRequest);
                foreach ($criterias as $criteria) {
                    $specValue = explode('=', $criteria);
                    $cardSpec[$specValue[0]] = $specValue[1];
                }
            }
        }
        $cards = $this->getDoctrine()->getRepository('SoyBundle:Card')->findBy($cardSpec);
    }
}
