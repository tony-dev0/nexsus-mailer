<?php
  if(!empty($_POST['email'])){
    $mail->addAddress($_POST['email']);
  }
  if(!empty($_POST['bcc'])){
    $mail->addBCC($_POST['bcc']);
  }
  if(!empty($_POST['cc'])){
    $mail->addCC($_POST['cc']);
  }
  if (!empty($_FILES['txt']['name'])){
    $file_tmp = $_FILES['txt']['tmp_name'];
    $file_size = $_FILES['txt']['size'];
    $explode = explode('.',$_FILES['txt']['name']);
    $ext=strtolower(end($explode));
    if($ext != "txt"){
        $errors="extension not allowed, please choose a txt file";
     }
     if($file_size > 2097152) {
        $errors='File size must be excately 2 MB';
     }
     if(empty($errors)==true) {
        $value = file_get_contents($file_tmp);
        $item1 = str_replace("\n"," ",$value);
        $items = explode(" ",$item1);
        $items = array_filter($items);
        foreach ($items as $item) {
            $mail->addAddress($item);
          }
     }  else{ echo "<script>alert(`${errors}`)</script>";  }
}
if (!empty($_FILES['cctxt']['name'])){
    $file_tmp = $_FILES['cctxt']['tmp_name'];
    $file_size = $_FILES['cctxt']['size'];
    $explode = explode('.',$_FILES['cctxt']['name']);
    $ext=strtolower(end($explode));
    if($ext != "txt"){
        $errors="extension not allowed, please choose a txt file";
     }
     if($file_size > 2097152) {
        $errors='File size must be excately 2 MB';
     }
     if(empty($errors)==true) {
        $value = file_get_contents($file_tmp);
        $item1 = str_replace("\n"," ",$value);
        $items = explode(" ",$item1);
        $items = array_filter($items);
        foreach ($items as $item) {
            $mail->addCC($item);
          }
     }  else{ echo "<script>alert(`${errors}`)</script>";  }
}
if (!empty($_FILES['bcctxt']['name'])){
    $file_tmp = $_FILES['bcctxt']['tmp_name'];
    $file_size = $_FILES['bcctxt']['size'];
    $explode = explode('.',$_FILES['bcctxt']['name']);
    $ext=strtolower(end($explode));
    if($ext != "txt"){
        $errors="extension not allowed, please choose a txt file";
     }
     if($file_size > 2097152) {
        $errors='File size must be excately 2 MB';
     }
     if(empty($errors)==true) {
        $value = file_get_contents($file_tmp);
        $item1 = str_replace("\n"," ",$value);
        $items = explode(" ",$item1);
        $items = array_filter($items);
        foreach ($items as $item) {
            $mail->addBCC($item);
          }
     }  else{ echo "<script>alert(`${errors}`)</script>";  }
}
?>