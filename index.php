<?php

    $arr = [
        [
            [
                "id" => "92",
                "father_id" => null,
            ],
            [
                "id" => "93",
                "father_id" => "92"
            ],
            [
                "id" => "94",
                "father_id" => "93"
            ]
        ],
        [
            [
                "id" => "92",
                "father_id" => null,
            ],
            [
                "id" => "93",
                "father_id" => "92"
            ],
            [
                "id" => "95",
                "father_id" => "93"
            ]
        ],
        [
            [
                "id" => "101",
                "father_id" => null
            ],
            [
                "id" => "102",
                "father_id" => "101"
            ],
            [
                "id" => "103",
                "father_id" => "102",
            ],
            [
                "id" => "105",
                "father_id" => "103"
            ],
        ]    
    ];

    function searchForNode(&$newArr, $node) {
        foreach($newArr as &$currNode) {
            // var_dump($currNode);
            if($node["father_id"] == $currNode["id"]) {
                if(!in_array($node["id"], array_column($currNode, "id"))) {
                    $currNode["children"][] = ["id" => $node["id"], "children" => []];
                }
            }
            else {
                searchForNode($currNode["chilren"], $node);
            }
        }
    }

    $newArr = [];
    foreach($arr as $subArr) {
        foreach($subArr as $node) {
            if($node["father_id"] == null) {
                $found = false;
                foreach($newArr as $newSubArr) {
                    if($newSubArr["id"] == $node["id"]) {
                        $found = true;
                        break;
                    }
                }
                if(!$found) {
                    $newArr[] = [
                        "id" => $node["id"],
                        "children" => []
                    ];
                }
            }
            else {
                searchForNode($newArr, $node);
            } 
        }
    }

    var_dump($newArr);
