<?php
$dns = 'mysql:dbname=test_phpdb;host=localhost;port=8889';
$conn = new PDO($dns, 'test_user', 'pwd');
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function disp_assoc($pst){
  echo '<pre>';
  print_r($pst->fetchAll());
  echo '</pre>';
}

try{
  // 変更前のレコード確認
  $stmt = $conn->query('SELECT * from txn_stocks');
  disp_assoc($stmt);
  
  // 店舗Cのすべての在庫数を+10
  $conn->exec("UPDATE txn_stocks as stock set `amount` = `amount`+10 where stock.shop_id = 3");

  echo "has changed amount";
  // 変更後のレコード確認
  $stmt = $conn->query('SELECT * from txn_stocks');
  disp_assoc($stmt);
}catch(Error $error){
  echo "error発生:{$error}";
}



try {
  $stmt = $conn->query(
    "SELECT `name`, `pref_id` from mst_shops"
  );

  disp_assoc($stmt);

  $ok = $conn->exec(
    "INSERT into mst_shops (`name`, `pref_id`, `updated_by`)
     values ('店舗D', 4, 'me')"
  );

  echo "has changed";
  $stmt = $conn->query(
    "SELECT `name`, `pref_id` from mst_shops"
  );
  disp_assoc($stmt);

} catch (Error $e) {
  echo "エラー";
  throw "エラー発生:{$e}";
}

try {
  $amoutChairShopA = $conn->query(
    "SELECT amount from txn_stocks
     where shop_id=1 and product_id=2"
  );
  disp_assoc($amoutChairShopA);

} catch (Exception $error) {
  throw $error;
}