<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <form action="mailer.php" method="POST">
    <input placeholder="email" type="text" name="email">
    <input placeholder="phone" type="text" name="phone">
    <input placeholder="topic" type="text" name="topic">
    <textarea placeholder="message" type="text" name="message"></textarea>
    <input type="submit" value="submit">
  </form>

</body>
</html>

<?php 
  
  // session_start();

  // $data = array(
  //   'user' => array(
  //     'name' => 'Marek',
  //     'age' => 27
  //   ),
  //   'model' => array(
  //     'qwert' => 'qwer'
  //   )
  // );


  // echo $data['model']['qwert'];


  ///////////////////////////////////////////

  // http://localhost/app2/?name=Hannes

  // echo 'Hello ' . htmlspecialchars($_GET["name"]) . '!';

  ///////////////////////////////////////////

  // var_dump($_SERVER)

  // foreach ($_SERVER as $key => $value) {
  //   echo $key . ' - ' . $value . '<br>';
  // }

  ///////////////////////////////////////////

  // $_SESSION['name'] = 'Marek';
  // $_SESSION['age'] = 17;

  // foreach ($_SESSION as $key => $value) {
  //   echo $key . ' - ' . $value . '<br>';
  // }

?>