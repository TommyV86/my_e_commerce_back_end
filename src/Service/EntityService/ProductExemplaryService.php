<?php

namespace App\Service\EntityService;

use App\Entity\Cart;
use App\Entity\Person;
use App\Entity\Product;
use App\Entity\ProductExemplary;
use App\Utility\CheckRole;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class ProductExemplaryService 
{

    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;
    private CheckRole $checkRole;


    private Person $person;
    private mixed $data;
    private array $cartArray;
    private EntityRepository $productManager;
    private EntityRepository $cartManager;

    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        CheckRole $checkRole,

        
    ){
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->checkRole = $checkRole;

    }

    public function save(Request $request) : bool {

        //deserialisation lorsque le front sera developpé
        //à réadapter pour le front, ajouter une vérification via le role

        $this->data = $request->getContent();
        $this->cartArray = json_decode($this->data, true);

        if(!$this->checkRole->isRoleUser($this->serializer, $this->entityManager, $this->cartArray)){ 
            return false;
        } else {
            $this->person = $this->checkRole->isRoleUser($this->serializer, $this->entityManager, $this->cartArray);
        };

        //récupérer depuis la data cartDto
        //ensuite persister tous les prod exs contenus dans cart

        $this->productManager = $this->entityManager->getRepository(Product::class);
        $this->cartManager = $this->entityManager->getRepository(Cart::class);

        foreach ($this->cartArray['_products'] as $prodDto) {

            //find prod by name
            $prodFromDb = $this->productManager->findOneByName($prodDto['_name']);
            //find last cart
            $lastCartFromDb = $this->cartManager->findLastCart(); 
             
            
            $prodEx = new ProductExemplary();
            $prodEx->setQuantity($prodDto['_quantity'])
                    ->setDatePurchase(new DateTime('now'))
                    ->setProduct($prodFromDb)
                    ->setCart($lastCartFromDb)
                    ->setImageName($prodFromDb->getName());

            $this->entityManager->persist($prodEx);
        }
        $this->entityManager->flush();      

        return true;
    }
}