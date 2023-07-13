<?php

namespace App\Service;

class WishlistProvider{

    //const PAGINATOR_PER_PAGE = 4;

    //public function getWishlistPaginator($wishlist): array{
    //    return array_chunk($wishlist, self::PAGINATOR_PER_PAGE);
    //}

    public function transformWishlistDataForTwig(array $wishlist): array{
        if ($wishlist){
            foreach($wishlist as $wish){
                $wishlistArr[] = [
                    'SetId' => $wish->getSetId(),
                    'Name' => $wish->getName(),
                    'ImagePath' => $wish->getImagePath(),
                    'PromoklockiSRC' => $wish->getPromoklockiSRC(),
                    'EolYear' => $wish->getEolYear(),
                ];
            }
        }else{
            $wishlistArr = [];
        }
        
        return $wishlistArr;
    }
}