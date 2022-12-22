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
             'phone' => 236567787,
             'img'   => "img/partner/1.jpg"
          
            ],
            [
         
              'id'   => 2,
              'pid'  => 1,
              'name' => 'Nelly Sack',
              'nivel' => 'Child',
              'email' => 'carter@email.com',
              'phone' => 236567787,
              'img'   => "img/partner/2.jpg"
             
      
             ],
           [
             'id'   => 3,
             'pid'  => 1,
             'name' => 'Carl Michel',
             'nivel' => 'Child',
             'email' => 'carter@email.com',
             'phone' => 236567787,
             'img'   => "img/partner/3.jpg"
            ],
           [
         
             'id'   => 4,
             'pid'  => 2,
             'name' => 'Amelia Tylor',
             'nivel' => 'Grandchild',
             'email' => 'carter@email.com',
             'phone' => 236567787,
             'img'   => "img/logonew.png"
           
            ],
           [
         
             'id'   => 5,
             'pid'  => 2,
             'name' => 'Lian Brown',
             'nivel' => 'Grandchild',
             'email' => 'carter@email.com',
             'phone' => 236567787,
             'img'   => "img/partner/5.jpg"
           
     
            ],
           
            [
         
            'id'   => 6,
            'pid'  => 3,
            'name' => 'Emma Smith',
            'nivel' => 'Grandchild',
            'email' => 'carter@email.com',
            'phone' => 236567787,
            'img'   => "img/partner/6.jpg"
              
        
               ],
              [
            
            'id'   => 7,
            'pid'  => 3,
            'name' => 'Paul Walker',
            'nivel' => 'Grandchild',
             'email' => 'carter@email.com',
             'phone' => 236567787,
             'img'   => "img/logonew.png"
              
               ],
               
              [
            
            'id'   => 8,
            'pid'  => 4,
            'name' => 'Paul Walker',
            'nivel' => 'Grandchild',
             'email' => 'carter@email.com',
             'phone' => 236567787,
             'img'   => "img/partner/8.jpg"
              
               ],

              [
            
            'id'   => 9,
            'pid'  => 4,
            'name' => 'Paul Walker',
            'nivel' => 'Grandchild',
             'email' => 'carter@email.com',
             'phone' => 236567787,
             'img'   => "img/partner/7.jpg"
              
               ],
            
         ];
    }
}