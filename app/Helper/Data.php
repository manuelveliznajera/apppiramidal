<?php

namespace App\Helper;

class Data 
{


     static function getData()
    {
        return  $data = [

          [
             'id'   => 1,
             'pid'  => null,
             'name' => 'Jhon Carter',
             'nivel' => 'Father',
             'email' => 'carter@email.com',
             'phone' => 236567787
           
     
            ],
           [
         
             'id'   => 2,
             'pid'  => 1,
             'name' => 'Carl Michel',
             'nivel' => 'Child',
             'email' => 'carter@email.com',
             'phone' => 236567787
           
     
            ],
           [
         
             'id'   => 3,
             'pid'  => 2,
             'name' => 'Carl Michel',
             'nivel' => 'Grandchild',
             'email' => 'carter@email.com',
             'phone' => 236567787
           
     
            ],
           [
         
             'id'   => 4,
             'pid'  => 2,
             'name' => 'Carl Michel',
             'nivel' => 'Grandchild',
             'email' => 'carter@email.com',
             'phone' => 236567787
           
     
            ],
            [
         
             'id'   => 5,
             'pid'  => 1,
             'name' => 'Nelly Sack',
             'nivel' => 'Child',
             'email' => 'carter@email.com',
             'phone' => 236567787
            
     
            ],
            [
         
            'id'   => 6,
            'pid'  => 5,
            'name' => 'Carl Michel',
            'nivel' => 'Grandchild',
            'email' => 'carter@email.com',
            'phone' => 236567787
              
        
               ],
              [
            
            'id'   => 7,
            'pid'  => 5,
            'name' => 'Carl Michel',
            'nivel' => 'Grandchild',
             'email' => 'carter@email.com',
             'phone' => 236567787
              
        
               ],
         ];
    }
}