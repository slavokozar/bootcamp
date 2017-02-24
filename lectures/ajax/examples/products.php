<?php

    $products = [
        (object)[
            'name' => 'Notebook',
            'price' => '2000 &euro;'
        ],
        (object)[
            'name' => 'Mobile phone',
            'price' => '200 &euro;'
        ],
        (object)[
            'name' => 'Notebook2',
            'price' => '23123 &euro;'
        ],
        (object)[
            'name' => 'Desktop',
            'price' => '1230 &euro;'
        ],
        (object)[
            'name' => 'Television',
            'price' => '124123 &euro;'
        ]
    ];


    if(isset($_POST['id']) && $_POST['id'] >= 0 && $_POST['id'] < count($products)) {


        $product = $products[$_POST['id']];
        $count = count($products);


        $response = [
            'product' => $product,
            'count' => $count
        ];

        echo json_encode($response);
    }


