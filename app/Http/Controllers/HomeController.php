<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    //

    public function index()
    {
        //array_rand ( array $array [, int $num = 1 ] );
        // $input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
        // $rand_keys = array_rand($input, 2);
        $secret_santas = [
            ["name" => "Neo Anderson", 'email' => 'neo@thematrix.com'],
            ["name" => "Morpheus Sandman", "email" => "morpheus@thematrix.com"], ["name" => "Trinity Trident", "email" => "trinity@thematrix.com"], ["name"=>"Cypher Reagan","email"=>"cypher@thematrix,com"],
            ["name"=>"Tank Chang","email"=>"tank@thematrix.com"]
        ];
        $rand_keys = array_rand($secret_santas, 2);
        dd($secret_santas);
        ddd($rand_keys);
        return view('welcome');
    }
}
