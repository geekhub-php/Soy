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

class ParseSitemapCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('soy:parse:sitemap')
            ->setDescription('Parse sitemap of magiccards.info')
            ->addOption(
               'lang',
                null,
                InputOption::VALUE_REQUIRED,
                'What language parse'
            );

    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container=$this->getContainer();
        $lang=$input->getOption('lang');
        $parser=$container->get('sitemap_parser');
        $parser->parseUrlsByLocale($lang);
        $doctrineManager=$container->get('doctrine');
        $entityManager=$doctrineManager->getEntityManager();
        $doctrineManager->resetEntityManager();
        $urls=$parser->getUrls();
        foreach($urls as $url){
            $entity=new SiteUrl();
            $entity->setUrl($url);
            $entity->setLocale($lang);
            $entityManager->persist($entity);
           }
        $entityManager->flush();
    }
} 