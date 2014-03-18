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
use Symfony\Component\Console\Input\InputInterface;
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
//        $card_urls[] = $repository->findOneBy(array('id' => 581));
//        $card_urls[] = $repository->findOneBy(array('id' => 583));
//        $card_urls[] = $repository->findOneBy(array('id' => 585));
        $card_urls = $repository->findAll();

        $progress = $this->getHelperSet()->get('progress');
        $progress->start($output, count($card_urls));

        foreach($card_urls as $card_url){
            $parser->init($card_url->getUrl());
//            $card_array[] = array(
//                'card' => $parser->getCardData()
//            );
            $card_array[] = $parser->getCardData();
            $progress->advance();
        }
        $progress->finish();

        $yaml = $dumper->dump($card_array, 4);
        file_put_contents('src/Soy/Bundle/SoyBundle/DataFixtures/data/cards.yml', $yaml);
    }
} 