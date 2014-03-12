<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 08.03.14
 * Time: 17:57
 */

namespace Soy\Bundle\ParseBundle\Command;


use Soy\Bundle\ParseBundle\Entity\SiteUrl;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ParseCardCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('parse:card')
            ->setDescription("Parse card's page");

    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $repository = $container->get('doctrine')->getRepository('SoyParseBundle:SiteUrl');
        $url = $repository->findOneBy(array('id' => 420));

        $parser = $container->get('card_parser');
        $parser->init($url->getUrl());
        $parser->getCardData();
        var_dump($parser->getCardData());exit();

        $doctrineManager = $container->get('doctrine');
        $entityManager = $doctrineManager->getEntityManager();
        $doctrineManager->resetEntityManager();
        $urls = $parser->getUrls();
        foreach($urls as $url){
            $entity = new SiteUrl();
            $entity->setUrl($url);
            $entity->setLocale($lang);
            $entityManager->persist($entity);
        }
        $entityManager->flush();
    }
} 