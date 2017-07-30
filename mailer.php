<?php 

  //email 5-30
  //phone 7-11
  //topic 5-25
  //message 5-2000

  include_once 'vendor/autoload.php';

  $mail = new Mail;

  if(isset($_POST['email'])){

    $formValid = true;

    //check email

    $email = $_POST['email'];

    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
    {
      $formValid=false;
    }

    if ((strlen($email)<5) || (strlen($email)>30))
    {
      $formValid=false;
    }


    // //check phone

    $phone = $_POST['phone'];

    if(!is_numeric($phone)){
      $formValid=false;
    }
    if ((strlen($phone)<7) || (strlen($phone)>11))
    {
      $formValid=false;
    }

    // //check topic

    $topic = $_POST['topic'];
    if(ctype_alnum($topic)===false){
      $formValid=false;
    }
    if ((strlen($topic)<5) || (strlen($topic)>25))
    {
      $formValid=false;
    }

    // //check message
    $message = $_POST['message'];
    if(ctype_alnum($message)===false){
      $formValid=false;
    }
    if ((strlen($message)<5) || (strlen($message)>2000))
    {
      $formValid=false;
    }

    var_dump($formValid);

    if($formValid == true){
      $data = [
          'nadawca_imie' => $email,
          'odpowiedz' => '', //opcjonalnie
          'odpowiedz_imie' => '', //opcjonalnie
          'odbiorca' => 'marekwil89@gmail.com',
          'odbiorca_imie' => 'awaAUTO',
          'tytul' => $topic,
          'tresc' => $message,
          'telefon' => $phone

          /*
          //pojedyńczy załącznik
          'attach' => __DIR__.'exapmle.pdf',

          //tablica załączników
          'attach' => array(
              __DIR__.'exapmle1.pdf',
              __DIR__.'exapmle2.pdf',
          ),
          */
      ];

      $mail = new Mail;
      $mail->smtp( $data );
    }

    


  };


?>