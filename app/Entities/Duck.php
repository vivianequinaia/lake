<?php

namespace App\Entities;

class Duck
{
    public function getAll()
    {
        return [
            0 => [
                "name" => "josifredo",
                "color" => "blue",
                "is_duck" => false
            ],
            1 => [
                "name" => "alfredo",
                "color" => "yellow",
                "is_duck" => true
            ],
            2 => [
                "name" => "gertrudes",
                "color" => "yellow",
                "is_duck" => true
            ],
            3 => [
                "name" => "adalberto",
                "color" => "pink",
                "is_duck" => false
            ],
            4 => [
                "name" => "augustinho carrara",
                "color" => "blue",
                "is_duck" => false
            ],
            5 => [
                "name" => "Glorinha",
                "color" => "red",
                "is_duck" => false
            ],
        ];
    }
}
