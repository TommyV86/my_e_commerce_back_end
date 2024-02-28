<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use App\Entity\TypeProduct;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class CProductFixtures extends Fixture implements FixtureGroupInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $productO = new Product();
        $productTw = new Product();
        $productThr = new Product();
        $productFo = new Product();
        $productFi = new Product();
        $productSi = new Product();
        $productSe = new Product();
        $productEi = new Product();
        $productNi = new Product();
        $productTe = new Product();
        $productEl = new Product();
        $productTwe = new Product();
        $productThirt = new Product();
        $productFourt = new Product();
        $productFift = new Product();

        $typeProductRepository = $this->entityManager->getRepository(TypeProduct::class);
        $fruitType = $typeProductRepository->findOneByName('fruit');
        $legumeType = $typeProductRepository->findOneByName('légume');
        $viandeType = $typeProductRepository->findOneByName('viande');

        $productO->setName('banane');
        $productO->setTypeProduct($fruitType);
        $productO->setDescription(
            'La banane est le fruit ou la baie dérivant de l\'
            inflorescence du bananier.
            Les bananes sont des fruits très généralement stériles issus de variétés 
            domestiquées. '
        );

        $productTw->setName('poire');
        $productTw->setTypeProduct($fruitType);
        $productTw->setDescription(
            'La poire est le fruit à pépins comestible au goût doux et sucré,
            produit par le poirier commun (Pyrus communis L.),
            arbre de la famille des Rosaceae'
        );

        $productThr->setName('fraise');
        $productThr->setTypeProduct($fruitType);
        $productThr->setDescription(
            'La fraise est un petit fruit rouge issu des fraisiers, 
            espèces de plantes herbacées appartenant au genre Fragaria 
            (famille des Rosacées), dont plusieurs variétés sont cultivées. 
        ');

        $productFo->setName('ananas');
        $productFo->setTypeProduct($fruitType);
        $productFo->setDescription(
            'L\'ananas (Ananas comosus) est une espèce de plantes xérophytes,
            originaire d\'Amérique du Sud, plus spécifiquement du Paraguay, 
            du nord-est de l`\'Argentine et sud du Brésil.'
        );

        $productFi->setName('pomme');
        $productFi->setTypeProduct($fruitType);
        $productFi->setDescription(
            'La pomme est un fruit comestible produit par un pommier.
            Les pommiers sont cultivés à travers le monde et représentent
            l\'espèce la plus cultivée du genre Malus.'
        );

        $productSi->setName('choux');
        $productSi->setTypeProduct($legumeType);
        $productSi->setDescription(
            'Chou est un nom vernaculaire ambigu
            désignant en français certaines espèces, 
            sous-espèces ou variétés de plantes appartenant 
            généralement à la famille des Brassicaceae,
            mais aussi à d\'autres familles botaniques.'
        );

        $productSe->setName('carotte');
        $productSe->setTypeProduct($legumeType);
        $productSe->setDescription(
            'La carotte est une plante bisannuelle de la famille des Apiacées
            (aussi appelées Ombellifères), largement cultivée pour sa racine pivotante charnue,
            comestible, de couleur généralement orangée, consommée ...'
        );

        $productEi->setName('aubergine');
        $productEi->setTypeProduct($legumeType);
        $productEi->setDescription(
            'L\'Aubergine est une plante dicotylédone de la famille des Solanaceae,
            cultivée pour son légume-fruit.'
        );

        $productNi->setName('courgette');
        $productNi->setTypeProduct($legumeType);
        $productNi->setDescription(
            'La courgette est une variété de plante à fleurs de la famille des Cucurbitaceae.
            C\'est une plante herbacée, mais c\'est aussi le fruit comestible de la plante 
            du même nom. '
        );

        $productTe->setName('poivron');
        $productTe->setTypeProduct($legumeType);
        $productTe->setDescription(
            'Les poivrons sont des variétés de piments doux de l\'espèce Capsicum 
            annuum à très gros fruits. Le terme désigne à la fois le fruit et la plante.'
        );

        $productEl->setName('boeuf bourgignon');
        $productEl->setTypeProduct($viandeType);
        $productEl->setDescription(
            'Le bœuf bourguignon est un véritable incontournable du terroir français !
            Il se savoure en toute saison et est synonyme de convivialité comme de tradition, 
            une recette qui vous réconfortera ...'
        );

        $productTwe->setName('poulet entier');
        $productTwe->setTypeProduct($viandeType);
        $productTwe->setDescription(
            'Le poulet se cuisine en sauce, rôti, bouilli, découpé ou entier.
            Dans la longue liste des recettes de poulet, citons, entre autres.'
        );

        $productThirt->setName('filet de porc');
        $productThirt->setTypeProduct($viandeType);
        $productThirt->setDescription(
            'Le filet de porc est un morceau tendre et maigre qui se situe 
            dans la région lombaire de l\'animal, dans la continuité du carré.
            Avec la pointe de filet, il constitue l\'extrémité de la longe de porc.'
        );

        $productFourt->setName('cuisses de poulet');
        $productFourt->setTypeProduct($viandeType);
        $productFourt->setDescription(
            'Testez ces cuisses de poulet 
            et leurs pommes de terre au four ! Ce plat a beaucoup de qualités. 
            Tout d\'abord, il est simple à faire. En cas de manque d\'idées 
            pour le repas du soir ou du midi, vous allez pouvoir rapidement vous régaler.
        ');
        
        $productFift->setName('saucisse');
        $productFift->setTypeProduct($viandeType);
        $productFift->setDescription(
            'Une saucisse est un produit de charcuterie 
            composée principalement de viande hachée mélangée à d\'autres ingrédients.'
        );

        

        $manager->persist($productO);
        $manager->persist($productTw);
        $manager->persist($productThr);
        $manager->persist($productFo);
        $manager->persist($productFi);
        $manager->persist($productSi);
        $manager->persist($productSe);
        $manager->persist($productEi);
        $manager->persist($productNi);
        $manager->persist($productTe);
        $manager->persist($productEl);
        $manager->persist($productTwe);
        $manager->persist($productThirt);
        $manager->persist($productFourt);
        $manager->persist($productFift);

        $manager->flush();

        echo '*** products persisted ***';
    }

    public static function getGroups(): array
    {
        return ['groupProd'];
    }
}
