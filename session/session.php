<?php
  
  function debugLog($val){
    echo "<pre>";
    echo var_dump($val);
    echo "</pre>";
  }

  session_start();

  if(!isset($_SESSION['todos'])){
    $_SESSION['todos'] = [];
  }

  if(isset($_POST['type'])){
    $type = $_POST['type'];
    if($type === 'create'){
      $_SESSION['todos'][] = $_POST['title'];
    }else if($type === 'delete'){
      array_splice($_SESSION['todos'], $_POST['id'], 1);
    }else if($type === 'edit'){
      $_SESSION['todos'][$_POST['id']] = $_POST['title'];
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div>
    <form action=<?=$_SERVER["PHP_SELF"]?> method="POST">
      <input type="text" name="title" require>
      <input type="submit" name="type" value="create">
    </form>
  </div>
  <div>
    <ul>
      <?php for($i=0; $i<count($_SESSION['todos']); $i++):?>
        <li>
          <form action=<?=$_SERVER["PHP_SELF"]?> method="post">
            <input type="text" name="title" value=<?=$_SESSION['todos'][$i]?>>
            <input type="hidden" name="id" value=<?=$i?>>
            <button type="submit" name="type" value="delete">delete</button>
            <button type="submit" name="type" value="edit">edit</button>
          </form>
        </li>
      <?php endfor; ?>
    </ul>
  </div>

</body>
</html>