<?php

namespace App\Entity\Mapper;

use App\Entity\Dto\ProductExemplaryDtos\ProductExemplaryDto;
use App\Entity\ProductExemplary;

class ProductExemplaryMapper {

    //injecter mapper cart et product
    private $cartMapper;
    private $productMapper;

    public function __construct(
        CartMapper $cartMapper,
        ProductMapper $productMapper
    )
    {
        $this->cartMapper = $cartMapper;
        $this->productMapper = $productMapper;
    }


    public function toEntity(ProductExemplaryDto $productExemplaryDto) : ProductExemplary {

        $productExemplary = new ProductExemplary();
        $cart = $this->cartMapper->toEntity($productExemplaryDto->getCartDto());
        $product = $this->productMapper->toEntity($productExemplaryDto->getProductDto());

        $productExemplary->setQuantity($productExemplaryDto->getQuantity())
                         ->setImageName($productExemplaryDto->getImageName())
                         ->setCart($cart)
                         ->setProduct($product);

        return $productExemplary;
    }

    public function toDto(ProductExemplary $productExemplary) : ProductExemplaryDto {

        $productExemplaryDto = new ProductExemplaryDto();
        $cartDto = $this->cartMapper->toDto($productExemplary->getCart());
        $productDto = $this->productMapper->toDto($productExemplary->getProduct());

        $productExemplaryDto->setQuantity($productExemplary->getQuantity())
                            ->setImageName($productExemplary->getImageName())
                            ->setCartDto($cartDto)
                            ->setProductDto($productDto);

        return $productExemplaryDto;
    }
}