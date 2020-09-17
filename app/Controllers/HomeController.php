<?php

namespace App\Controllers;

use App\Models\Product;

class HomeController extends Controller
{

   public function index($request, $response)
   {
        $create = Product::create([
            'name' => 'rato',
            'price' => '5.000',
            'location' => 'luanda, kilamba',
        ]);

        return $this->container->view->render($response, 'home.twig');
   }

   public function getall($request, $response)
   {
        $users = $this->container->db->table('products')->get();
        foreach ($users as $user){
            echo $user->name . "</br>";
            echo $user->price . "</br>";
        }
      return $this->container->view->render($response, 'templates/app.twig');
   }

}