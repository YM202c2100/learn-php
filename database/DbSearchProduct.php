<form action=<?= $_SERVER["REQUEST_URI"]?> method="get">
  <input type="number" 
    name="product_id" 
    placeholder="検索したい商品IDを入力…"
  >
  <button type="submit">検索</button>
</form>

<?php
  if(!isset($_GET["product_id"])) die();
  
  require_once "model.product.php";
  use model\ProductModel;

  $message = "";
  try{
    $dsn = 'mysql:host=localhost;port=8889;dbname=test_phpdb';
    $conn = new PDO($dsn, 'test_user', 'pwd');

    $pst = $conn->prepare(
      "SELECT `name`, `delete_flg` from mst_products
       where id = :id"
    );
    $pst->bindValue(':id', $_GET['product_id'], PDO::PARAM_INT);

    $pst->execute();
    $result = $pst->fetchAll(PDO::FETCH_CLASS, ProductModel::class)[0];

    if(empty($result)
       ||$result->delete_flg === 1){
      $message = "一致する商品が見つかりません。";
    }else{
      $message = "商品名は{$result->name}です。";
    }

  }catch(Exception){
    $message = "時間をおいて再度お試しください";
  }

  echo $message;
?>