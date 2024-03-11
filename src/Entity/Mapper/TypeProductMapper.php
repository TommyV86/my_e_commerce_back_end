<?php

namespace App\Entity\Mapper;

use App\Entity\Dto\TypeProductDtos\TypeProductDto;
use App\Entity\TypeProduct;

class TypeProductMapper {


    public function toEntity(TypeProductDto $typeProductDto) : TypeProduct {

        $typeProduct = new TypeProduct();
        $typeProduct->setName($typeProductDto->getName());

        return $typeProduct;
    }

    public function toDto(TypeProduct $typeProduct) : TypeProductDto {

        $typeProductDto = new TypeProductDto();
        $typeProductDto->setName($typeProduct->getName());

        return $typeProductDto;
    }
}