<?php

namespace App\Service\EntityService;

use App\Entity\Cart;
use App\Entity\Product;
use App\Entity\ProductExemplary;
use App\Repository\CartRepository;
use App\Service\Mapper\ProductExemplaryMapper;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class ProductExemplaryService 
{

    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;
    private ProductExemplaryMapper $prodExMapper;

    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        ProductExemplaryMapper $prodExMapper
    ){
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->prodExMapper = $prodExMapper;
    }

    public function save(Request $request) : bool {

        //deserialisation lorsque le front sera developpé
        //à réadapter pour le front, ajouter une vérification via le role

        $data = $request->getContent();
        $datasIntoArray = json_decode($data, true);

        $idCart = (int) $datasIntoArray['id'];
        $cart = $this->entityManager->getRepository(Cart::class)->find($idCart);

        $prodExs = new ArrayCollection();

        $prodExs->add($datasIntoArray['productExemplary']);
        $prodExs->add($datasIntoArray['productExemplary']);
        $prodExs->add($datasIntoArray['productExemplary']);

        //boucler dans la collection et persister chaque prod ex

        foreach ($prodExs as $prodEx) {
            
            $prodEx = $this->serializer->deserialize($data, ProductExemplary::class, "json");
            $prodEx->setCart($cart);

            $this->entityManager->persist($prodEx);
        }
        
        //$this->entityManager->persist();
        $this->entityManager->flush();

        return $prodExs === null ? false : true;
    }
}