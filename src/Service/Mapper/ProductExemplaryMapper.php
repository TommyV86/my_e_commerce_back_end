<?php

namespace App\Service\Mapper;

use App\Entity\Dto\ProductExemplaryDtos\ProductExemplaryDto;
use App\Entity\ProductExemplary;

class ProductExemplaryMapper {

    private ProductMapper $prodMapper;

    public function __construct(ProductMapper $prodMapper)
    {
        $this->prodMapper = $prodMapper;
    }

    public function toEntity(ProductExemplaryDto $productExemplaryDto) : ProductExemplary {

        $productExemplary = new ProductExemplary();
        $productExemplary->setQuantity($productExemplaryDto->getQuantity())
                         ->setImageName($productExemplaryDto->getImageName());

        return $productExemplary;
    }

    public function toDto(ProductExemplary $productExemplary) : ProductExemplaryDto {

        $productExemplaryDto = new ProductExemplaryDto();
        $productExemplaryDto->setQuantity($productExemplary->getQuantity())
                            ->setImageName($productExemplary->getImageName())
                            ->setProductDto($this->prodMapper->toDto($productExemplary->getProduct()));

        return $productExemplaryDto;
    }
}