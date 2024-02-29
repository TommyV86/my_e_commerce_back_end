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
        $typeProductRepository = $this->entityManager->getRepository(TypeProduct::class);
        $fruitType = $typeProductRepository->findOneByName('fruit');
        $legumeType = $typeProductRepository->findOneByName('légume');
        $viandeType = $typeProductRepository->findOneByName('viande');

        $products = new ArrayCollection();

        for ($i=0; $i < 15; $i++) { 
            $products->add(new Product());
        }

        $products->get(0)->setName('banane');
        $products->get(0)->setTypeProduct($fruitType);
        $products->get(0)->setDescription(
            'La banane est le fruit ou la baie dérivant de l\'
            inflorescence du bananier.
            Les bananes sont des fruits très généralement stériles issus de variétés 
            domestiquées. '
        );
        $products->get(0)->setPrice(1.50);

        $products->get(1)->setName('poire');
        $products->get(1)->setTypeProduct($fruitType);
        $products->get(1)->setDescription(
            'La poire est le fruit à pépins comestible au goût doux et sucré,
            produit par le poirier commun (Pyrus communis L.),
            arbre de la famille des Rosaceae'
        );
        $products->get(1)->setPrice(1.10);

        $products->get(2)->setName('fraise');
        $products->get(2)->setTypeProduct($fruitType);
        $products->get(2)->setDescription(
            'La fraise est un petit fruit rouge issu des fraisiers, 
            espèces de plantes herbacées appartenant au genre Fragaria 
            (famille des Rosacées), dont plusieurs variétés sont cultivées. 
        ');
        $products->get(2)->setPrice(1.20);

        $products->get(3)->setName('ananas');
        $products->get(3)->setTypeProduct($fruitType);
        $products->get(3)->setDescription(
            'L\'ananas (Ananas comosus) est une espèce de plantes xérophytes,
            originaire d\'Amérique du Sud, plus spécifiquement du Paraguay, 
            du nord-est de l`\'Argentine et sud du Brésil.'
        );
        $products->get(3)->setPrice(3.50);

        $products->get(4)->setName('pomme');
        $products->get(4)->setTypeProduct($fruitType);
        $products->get(4)->setDescription(
            'La pomme est un fruit comestible produit par un pommier.
            Les pommiers sont cultivés à travers le monde et représentent
            l\'espèce la plus cultivée du genre Malus.'
        );
        $products->get(4)->setPrice(2.30);

        $products->get(5)->setName('choux');
        $products->get(5)->setTypeProduct($legumeType);
        $products->get(5)->setDescription(
            'Chou est un nom vernaculaire ambigu
            désignant en français certaines espèces, 
            sous-espèces ou variétés de plantes appartenant 
            généralement à la famille des Brassicaceae,
            mais aussi à d\'autres familles botaniques.'
        );
        $products->get(5)->setPrice(0.50);

        $products->get(6)->setName('carotte');
        $products->get(6)->setTypeProduct($legumeType);
        $products->get(6)->setDescription(
            'La carotte est une plante bisannuelle de la famille des Apiacées
            (aussi appelées Ombellifères), largement cultivée pour sa racine pivotante charnue,
            comestible, de couleur généralement orangée, consommée ...'
        );
        $products->get(6)->setPrice(2.10);

        $products->get(7)->setName('aubergine');
        $products->get(7)->setTypeProduct($legumeType);
        $products->get(7)->setDescription(
            'L\'Aubergine est une plante dicotylédone de la famille des Solanaceae,
            cultivée pour son légume-fruit.'
        );
        $products->get(7)->setPrice(1.60);

        $products->get(8)->setName('courgette');
        $products->get(8)->setTypeProduct($legumeType);
        $products->get(8)->setDescription(
            'La courgette est une variété de plante à fleurs de la famille des Cucurbitaceae.
            C\'est une plante herbacée, mais c\'est aussi le fruit comestible de la plante 
            du même nom. '
        );
        $products->get(8)->setPrice(1.90);

        $products->get(9)->setName('poivron');
        $products->get(9)->setTypeProduct($legumeType);
        $products->get(9)->setDescription(
            'Les poivrons sont des variétés de piments doux de l\'espèce Capsicum 
            annuum à très gros fruits. Le terme désigne à la fois le fruit et la plante.'
        );
        $products->get(9)->setPrice(1);

        $products->get(10)->setName('boeuf bourgignon');
        $products->get(10)->setTypeProduct($viandeType);
        $products->get(10)->setDescription(
            'Le bœuf bourguignon est un véritable incontournable du terroir français !
            Il se savoure en toute saison et est synonyme de convivialité comme de tradition, 
            une recette qui vous réconfortera ...'
        );
        $products->get(10)->setPrice(13.50);

        $products->get(11)->setName('poulet entier');
        $products->get(11)->setTypeProduct($viandeType);
        $products->get(11)->setDescription(
            'Le poulet se cuisine en sauce, rôti, bouilli, découpé ou entier.
            Dans la longue liste des recettes de poulet, citons, entre autres.'
        );
        $products->get(11)->setPrice(8.30);

        $products->get(12)->setName('filet de porc');
        $products->get(12)->setTypeProduct($viandeType);
        $products->get(12)->setDescription(
            'Le filet de porc est un morceau tendre et maigre qui se situe 
            dans la région lombaire de l\'animal, dans la continuité du carré.
            Avec la pointe de filet, il constitue l\'extrémité de la longe de porc.'
        );
        $products->get(12)->setPrice(11.45);

        $products->get(13)->setName('cuisses de poulet');
        $products->get(13)->setTypeProduct($viandeType);
        $products->get(13)->setDescription(
            'Testez ces cuisses de poulet 
            et leurs pommes de terre au four ! Ce plat a beaucoup de qualités. 
            Tout d\'abord, il est simple à faire. En cas de manque d\'idées 
            pour le repas du soir ou du midi, vous allez pouvoir rapidement vous régaler.
        ');
        $products->get(13)->setPrice(6.23);
        
        $products->get(14)->setName('saucisse');
        $products->get(14)->setTypeProduct($viandeType);
        $products->get(14)->setDescription(
            'Une saucisse est un produit de charcuterie 
            composée principalement de viande hachée mélangée à d\'autres ingrédients.'
        );
        $products->get(14)->setPrice(9.13);

        foreach ($products as $prod) {
            $manager->persist($prod);
        }

        $manager->flush();

        echo '*** products persisted ***';
    }

    public static function getGroups(): array
    {
        return ['groupProd'];
    }
}
