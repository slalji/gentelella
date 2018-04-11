   <?php
   
   # Setup request to send json via POST.
   function getToken($length)
   {
       return substr(str_shuffle(implode("", (array_merge(range(0, 25))))), 0, $length);
   }
    

    $bank = array (
        "name"=>"AMANA BANK",
        "address"=>array (
            // "line1"=>"Azikiwe",
            // "line2"=>"Azikiwe St",
            "city"=>"DAR ES SALAAM",
            "countrySubdivision"=>"DA",
            // "postalCode"=>"14102",
            "country"=>"TZA"
        ),
    );

    $sender = array(
        "account"=>"255784238772",//phone number
        "firstName"=>"Mohammedjawaad",
        "lastName"=>"Kassam",
        "address"=> array(
            "line1"=>"BIBI TITI RD",//"Buguruni",
            "city"=>"DAR ES SALAAM",//"Dar es Salaam",
            "countrySubdivision"=>"DA",//"DA",
            //"postalCode"=>"12102",
            "country"=>"TZA",//"TZA"
        ),
        "bank"=>$bank
    );

    $recipient = array(
        "pan"=>'5184680430000006', //merchant_lookup
        "firstName"=>"Pizza",
        "lastName"=>"Hut",
        "currency"=>"TZS",
        "address"=> array(
            "city"=>"Dar es salaam",
            "countrySubdivision"=>"DR",
            "country"=>"TZA"
        ),
    );

    $payment = array(
        "reference"=>getToken(19),
        "sender"=>$sender,
        "recipient"=>$recipient,
        "amount"=>20,
        "source"=>"BANK_ACC",
    );
    $amount = 20;    

    $ch = curl_init( 'http://mpqr/payment' );
    $payload = json_encode( $payment );
   
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    # Return response instead of printing.
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    # Send request.
    $result = curl_exec($ch);

    curl_close($ch);
    # Print response.
  print_r( "Here<pre>".$result."</pre>"); 

    return $result;
    ?>