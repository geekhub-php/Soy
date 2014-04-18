<?php

namespace Soy\Bundle\SoyBundle\Controller;

use Soy\Bundle\SoyBundle\Entity\Search;
use Soy\Bundle\SoyBundle\Form\Type\SearchFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{

    public function searchCardsAction(Request $request)
    {
        $search = new Search();
        $search->setPowerCompare('equal');
        $search->setToughnessCompare('equal');

        $searchForm = $this->createForm(new SearchFormType(), $search);

        $searchForm->handleRequest($request);

        if ($searchForm->isValid()) {
            $qb = $this->getDoctrine()->getManager()->createQueryBuilder();
            $qb->select('c')->from('SoyBundle:Card', 'c');

            if ($search->getName() !== NULL) {
                $qb->andWhere('c.name LIKE :name')
                    ->setParameter('name', '%'.$search->getName().'%');
            }
            if ($search->getNumber() !== NULL) {
                $qb->join('c.numbers', 'n')
                    ->andWhere('n.name = :number')
                    ->setParameter('number', '#'.$search->getNumber());
            }
            if ($search->getArtist() !== NULL) {
                $qb->join('c.artist', 'a')
                    ->andWhere('a.name LIKE :artist')
                    ->setParameter('artist', '%'.$search->getArtist().'%');
            }
            if ($search->getText() !== NULL) {
                $qb->andWhere('c.text LIKE :text')
                    ->setParameter('text', '%'.$search->getText().'%');
            }
            if ($search->getMana() !== NULL) {
                $qb->andWhere('c.mana LIKE :mana')
                    ->setParameter('mana', '%'.$search->getMana().'%');
            }
            if ($search->getPower() !== NULL) {
                switch ($search->getPowerCompare()) {
                    case 'equal':
                        $qb->andWhere('c.power = :power');
                        break;
                    case 'less':
                        $qb->andWhere('c.power < :power');
                        break;
                    case 'more':
                        $qb->andWhere('c.power > :power');
                        break;
                    case 'lessOrEqual':
                        $qb->andWhere('c.power <= :power');
                        break;
                    case 'moreOrEqual':
                        $qb->andWhere('c.power >=:power');
                        break;
                }
                $qb->setParameter('power', $search->getPower());
            }
            if ($search->getToughness() !== NULL) {
                switch ($search->getToughnessCompare()) {
                    case 'equal':
                        $qb->andWhere('c.toughness = :toughness');
                        break;
                    case 'less':
                        $qb->andWhere('c.toughness < :toughness');
                        break;
                    case 'more':
                        $qb->andWhere('c.toughness > :toughness');
                        break;
                    case 'lessOrEqual':
                        $qb->andWhere('c.toughness <= :toughness');
                        break;
                    case 'moreOrEqual':
                        $qb->andWhere('c.toughness >=:toughness');
                        break;
                }
                $qb->setParameter('toughness', $search->getToughness());
            }
            if (count($search->getFormats()) !== 0) {
                $qb->join('c.formats', 'f');
                foreach($search->getFormats() as $format) {
                    $qb->andWhere('f.name = :format')
                        ->setParameter('format', $format->getName());
                }
            }
            if (count($search->getEditions()) !== 0) {
                $qb->join('c.editions', 'e');
                foreach($search->getEditions() as $edition) {
                    $qb->andWhere('e.name = :edition')
                        ->setParameter('edition', $edition->getName());
                }
            }
            if ($search->getType() !== NULL) {
                $qb->join('c.type', 't')
                    ->andWhere('t.name = :type')
                    ->setParameter('type', $search->getType()->getName());

            }
            $query = $qb->getQuery();

            $cards = $query->getResult();

            return $this->render('SoyBundle:Search:result.html.twig', array(
                'cards' => $cards
            ));

        }

        return $this->render('SoyBundle:Search:search.html.twig', array(
            'form' => $searchForm->createView(),
        ));
    }

}
