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
//use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
//use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Dumper;

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
        $parser = $container->get('card_parser');
        $dumper = new Dumper();
        $repository = $container->get('doctrine')->getRepository('SoyParseBundle:SiteUrl');
        $card_urls = $repository->findAll();
        $i = 0;

        foreach($card_urls as $card_url){
            $parser->init($card_url->getUrl());
            $card_array[] = $parser->getCardData();
            $i++;
            if($i%10 == 0){var_dump($i);};
        }

        $yaml = $dumper->dump($card_array, 3);
        file_put_contents('src/Soy/Bundle/SoyBundle/DataFixtures/data/cards.yml', $yaml); exit();

        $doctrineManager = $container->get('doctrine');
        $entityManager = $doctrineManager->getEntityManager();
        $doctrineManager->resetEntityManager();
        $urls = $parser->getUrls();
        foreach($urls as $url){
            $entity = new SiteUrl();
            $entity->setUrl($url);
            $entityManager->persist($entity);
        }
        $entityManager->flush();
    }
} 