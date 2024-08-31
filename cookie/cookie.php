<?php 
if(isset($_COOKIE["visitCount"])){
  $newVisitCount = (int)$_COOKIE["visitCount"] + 1;

  setcookie("visitCount", (string)$newVisitCount, [
      "expires"=>time()+10,
      "httpOnly"=>true
  ]);
  echo "訪問回数は{$newVisitCount}です。";
  
}else{
  setcookie("visitCount", "1", [
    "expires"=>time()+10,
    "httpOnly"=>true
  ]);
  echo "訪問回数は1回です。";
}

