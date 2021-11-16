<?php

namespace App\Http\Controllers;

use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestingController extends Controller
{
    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts(['localhost:9200'])
            ->build();
    }

    public function search(Request $request)
    {
        $params = [
            'index' => 'user',
            'body' => [
//                "aggs" => [
//                    "avg_age" => ["avg" => ["field" => "age"]]
//                ],


                // simple text search
                'query' => [
//                'match' => [
//                    'name' => $request->search
//                ] ,

                    // combined fields search
                    /*'combined_fields' => [
                        'query' => $request->search,
                        "fields" => ["name", "email"],
                        "operator" => "and"
                    ],*/

                    // multi match search
//                    'multi_match' => [
//                        'query' => $request->search,
//                        "fields" => ["name", "email"],
//                        "operator" => "and",
//                        "minimum_should_match" => "50%"
//                    ]


                    // filter with search and check condition with fuzziness [ 'must'= 'and' operator & 'should'='or' operator ]
                    "bool" => [
                        "must" => [
                            "match" => [
                                "name" => [
                                    'query' => $request->search,
                                    "fuzziness" => 2 // number of character.max value= 2
                                ]
                            ]
                        ],



//                        "filter" => [
//                            "range" => ["age" => ["gte" => $request->age ?? 10]]
//                        ]
                    ]

                ]
            ]
        ];

        return $this->client->search($params);
//    $response = $this->client->info();
        // dump($response);

//    return view('test',compact('response'));


//    dd($response);

    }


    public function save()
    {
        $params = [
            'index' => 'user',
            'id' => (string)Str::uuid(),
            'body' => [
                'name' => 'Rifat ' . Str::random(6),
                'age' => rand(10, 99),
                'salary' => rand(5000, 10000),
                'email' => 'shuvo@gmail.com',
                'language' => collect(['php', 'ruby', 'java', 'javascript', 'bash'])
                    ->random(2)
                    ->values()
                    ->all(),
            ]
        ];

        return $this->client->index($params);

    }

    public function find($id)
    {
        $params = [
            'index' => 'user',
            'id' => $id
        ];

        return $this->client->get($params);

    }
}
