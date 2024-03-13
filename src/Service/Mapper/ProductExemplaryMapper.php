<?php

namespace App\Service\Mapper;

use App\Entity\Dto\ProductExemplaryDtos\ProductExemplaryDto;
use App\Entity\ProductExemplary;

class ProductExemplaryMapper {

    private $productMapper;

    public function __construct(
        ProductMapper $productMapper
    )
    {
        $this->productMapper = $productMapper;
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
                            ->setImageName($productExemplary->getImageName());

        return $productExemplaryDto;
    }
}