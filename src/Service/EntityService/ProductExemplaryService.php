<?php

namespace App\Service\EntityService;

use App\Entity\Cart;
use App\Entity\ProductExemplary;
use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class ProductExemplaryService 
{

    private $serializer;
    private $entityManager;

    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager
    ){
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }

    public function save(
        Request $request, 
        CartRepository $cartRepository) : bool {

        //deserialisation lorsque le front sera developpé
        //à réadapter pour le front, ajouter une vérification via le role

        $data = $request->getContent();
        $datasIntoArray = json_decode($data, true);

        $idCart = (int) $datasIntoArray['id'];
        $cart = $cartRepository->find($idCart);

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