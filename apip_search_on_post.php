<?php
  $servername = "localhost";
  $username = "jualbes1_wp146";
  $password = "1)p]28k1S6";
  $dbname = "jualbes1_wp146";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $x = $_GET['x'];
  $q = $_GET['q'];
  $kirim = '<div class="list-group">';
  $sql = "select * from wpfx_posts where post_type = 'product' and post_status = 'publish' and post_title like '%".$x."%' and post_title like '%".$q."%' order by post_title asc limit 5";
  $result = mysqli_query($conn, $sql);


  while($row = mysqli_fetch_assoc($result)) {
    $post_title = $row["post_title"];
    $link = str_replace(" ","-",$post_title);
    $post_id = $row["ID"];
    $post_excerpt = $row["post_excerpt"];



    // cari harga
    $sql2="select * from wpfx_postmeta where post_id='$post_id' and meta_key ='_regular_price'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    // $price = "Call for Price";
    $price = $row2["meta_value"];
    if ($price == 0 || $price == "0") {
      $price = "Call for Price";
    }
    else {
      $price = "Rp ".$price;
    }


    // cari _length
    $sql3="select * from wpfx_postmeta where post_id='$post_id' and meta_key ='_length'";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $length = $row3["meta_value"];


    // cari _width
    $sql4="select * from wpfx_postmeta where post_id='$post_id' and meta_key ='_width'";
    $result4 = mysqli_query($conn, $sql4);
    $row4 = mysqli_fetch_assoc($result4);
    $width = $row4["meta_value"];


    // cari _height
    $sql5="select * from wpfx_postmeta where post_id='$post_id' and meta_key ='_height'";
    $result5 = mysqli_query($conn, $sql5);
    $row5 = mysqli_fetch_assoc($result5);
    $height = $row5["meta_value"];


    $kirim = $kirim.'<a href="https://jualbesi.com/produk/'.$link.'/" class="list-group-item list-group-item-action">';
    $kirim = $kirim.'<div class="d-flex w-100 justify-content-between">';
    $kirim = $kirim.'<div class="" style="font-size: 12px;font-weight: bold;">'.$post_title.'</div>';
    $kirim = $kirim.'<div class="text-muted" style="font-size: 12px!important;">'.$price.'</div>';
    $kirim = $kirim.'</div>';
    $kirim = $kirim.'<div class="apipx">'.$post_excerpt.'</div>';
    $kirim = $kirim.'<div class="text-muted" style="font-size: 10px!important;">Dimensi: '.$length.'x'.$width.'x'.$height.'</div>';
    $kirim = $kirim.'</a>';
  }



  // cari post
  $sql2 = "select * from wpfx_posts where post_type ='post' and post_status ='publish' and post_title like '%".$x."%' order by post_title asc limit 2";
  $result2 = mysqli_query($conn, $sql2);

  while($row2 = mysqli_fetch_assoc($result2)) {
    $post_title2 = $row2["post_title"];
    $link2 = $row2["guid"];

    $kirim = $kirim.'<a href="'.$link2.'" class="list-group-item list-group-item-action">';
    $kirim = $kirim.'<div class="d-flex w-100 justify-content-between">';
    $kirim = $kirim.'<div class="" style="font-size: 12px;font-weight: bold;">'.$post_title2.'</div>';
    $kirim = $kirim.'<div class="text-muted" style="font-size: 12px!important;">Page</div>';
    $kirim = $kirim.'</div>';
    $kirim = $kirim.'</a>';
  }

  $kirim = $kirim.'</div>';
  echo $kirim;
?>
