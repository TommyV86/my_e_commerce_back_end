<?php

namespace App\Service\Mapper;

use App\Entity\Dto\ProductDtos\ProductDto;
use App\Entity\Product;

class ProductMapper {

    //injecter prodex et typeprod mapper
    private TypeProductMapper $typeProdMapper;

    public function __construct(
        TypeProductMapper $typeProdMapper
    )
    {
        $this->typeProdMapper = $typeProdMapper;
    }

    public function toEntity(ProductDto $productDto) : Product {
        
        $product = new Product();
        $typeProd = $this->typeProdMapper->toEntity($productDto->getTypeProductDto());

        $product->setName($productDto->getName())
                ->setPrice($productDto->getPrice())
                ->setDescription($productDto->getDescription())
                ->setTypeProduct($typeProd)
                ->setQuantity($productDto->getQuantity());

        return $product;
    }

    public function toDto(Product $product) : ProductDto {
        
        $productDto = new ProductDto();
        $typeProdDto = $this->typeProdMapper->toDto($product->getTypeProduct());

        $productDto->setName($product->getName())
                   ->setPrice($product->getPrice())
                   ->setDescription($product->getDescription())
                   ->setTypeProductDto($typeProdDto);
        return $productDto;
    }


    // mapper functions collection product ex à dev



}