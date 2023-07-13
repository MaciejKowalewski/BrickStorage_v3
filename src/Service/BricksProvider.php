<?php

namespace App\Service;

class BricksProvider{

    public function transformBricksDataForTwig(array $bricks): array{
        if ($bricks){
            foreach($bricks as $brick){
                $BricksArr[] = [
                    'id' => $brick->getid(),
                    'BrickId' => $brick->getBrickId(),
                    'Name' => $brick->getName(),
                    'ImagePath' => $brick->getImagePath(),
                    'Color' => $brick->getColor(),
                    'BrickType' => $brick->getPartType(),
                    'Quantity' => $brick->getQuantity(),
                ];
            }
        }else{
            $BricksArr = [];
        }
        
        return $BricksArr;
    }
}