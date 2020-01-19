<?php
/**
 * Created by PhpStorm.
 * User: irapcover
 * Date: 06/06/2017
 * Time: 15:03
 */

use App\Models\Tags;
use Elasticsearch\ClientBuilder;
include 'inc_security.php';
$keywords = getValue('postalcode_startsWith', 'str', 'GET', '');

// Tìm từ elasticsearch
$client = ClientBuilder::create()->build();

$params = [
    'index' => 'giaca_v2',
    'type' => 'tags',
    'body' => [
        "from" => 0,
        "size" => 10,
        'query' => [
            'wildcard' => [
                'name' => '*'.$keywords.'*'
            ],
        ]
    ]
];

$searchResult = $client->search($params);
$hits = $searchResult["hits"]["hits"];
$arrayResult = array();
if(count($hits) > 0){
    for ($i = 0; $i < count($hits); $i++){
        $arrayResult['tag'][] = ['tag_id'=> $hits[$i]["_source"]["id"], "tag_name" => $hits[$i]["_source"]["name"]];
    }
}


header('Content-Type: application/json');
echo json_encode($arrayResult);