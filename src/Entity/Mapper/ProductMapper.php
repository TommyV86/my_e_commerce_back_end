<?php

namespace App\Entity\Mapper;

use App\Entity\Dto\ProductDtos\ProductDto;
use App\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;

class ProductMapper {

    //injecter prodex et typeprod mapper
    private ProductExemplaryMapper $productExMapper;
    private TypeProductMapper $typeProdMapper;

    public function __construct(
        ProductExemplaryMapper $productExMapper,
        TypeProductMapper $typeProdMapper
    )
    {
        $this->productExMapper = $productExMapper;
        $this->typeProdMapper = $typeProdMapper;
    }

    public function toEntity(ProductDto $productDto) : Product {
        
        $product = new Product();
        $typeProd = $this->typeProdMapper->toEntity($productDto->getTypeProductDto());
        $prodExsDto = $productDto->getProductExemplariesDto();

        $product->setName($productDto->getName())
                ->setDescription($productDto->getDescription())
                ->setTypeProduct($typeProd)
                ->setProductExemplaries($this->productExemplariesToEntity($prodExsDto));

        return $product;
    }

    public function toDto(Product $product) : ProductDto {
        
        $productDto = new ProductDto();
        $typeProdDto = $this->typeProdMapper->toDto($product->getTypeProduct());
        $prodExs = $product->getProductExemplaries();

        $productDto->setName($product->getName())
                   ->setDescription($product->getDescription())
                   ->setTypeProductDto($typeProdDto)
                   ->setProductExemplariesDto($this->productExemplariesToDto($prodExs));

        return $productDto;
    }


    // mapper functions collection product ex à dev

    private function productExemplariesToEntity($prodExsDto) : ArrayCollection {
        
        $prodExs = new ArrayCollection();
        foreach ($prodExsDto as $pExDto) {
            $prodExs->add($this->productExMapper->toEntity($pExDto));
        }

        return $prodExs;
    }

    private function productExemplariesToDto($prodExs) : ArrayCollection {

        $prodExsDto = new ArrayCollection();
        foreach ($prodExs as $pEx) {
            $prodExsDto->add($this->productExMapper->toDto($pEx));
        }

        return$prodExsDto;
    }

}