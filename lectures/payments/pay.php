<?php
    use Stripe\Charge;
    use Stripe\Stripe;
    use Stripe\Error;


    require_once('vendor/autoload.php');

    $testAPIKey = "sk_test_72kKTkBkFYyZOUqoVKkMkgoz";
    Stripe::setApiKey($testAPIKey);


    // Get all the values from the form
    $token = $_POST['stripeToken'];
    $email = $_POST['stripeEmail'];
    $price = $_POST['price'] * $_POST['amount']; // retrieve from DB !!!

    $priceInCents = $price * 100;

    try
    {
        $charge = Charge::create(array(
            "amount" => $priceInCents,
            "currency" => "usd",
            "card" => $token,
            "description" => $email
        ));

        echo "payed";
    }
    catch (Error $e)
    {
        // The charge failed for some reason. Stripe's message will explain why.
        $message = $e->getMessage();

        // error
    }
