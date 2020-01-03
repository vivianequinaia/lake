<?php

namespace App\Entities;

class Bird
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
                "color" => "yellow",
                "is_duck" => false
            ],
            4 => [
                "name" => "augustinho carrara",
                "color" => "green",
                "is_duck" => false
            ],
            5 => [
                "name" => "gertrudes",
                "color" => "red",
                "is_duck" => true
            ],
        ];
    }
}
