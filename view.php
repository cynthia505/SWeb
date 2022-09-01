<?php
    require_once('connection.php');
    $res = $database->view();

    if(isset($_POST['delete-btn']))
    {
      $checkbox = $_POST['checkbox'];
  
          for($i=0;$i<count($checkbox);$i++){
  
              $del_id = $checkbox[$i];
              $result = $database->delete($del_id);
          }
      if($result){
          header("Location: view.php");
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <form method="post">
    <div>
    <div style="display: flex; float: right; padding-top: 10px;">
            <a href="handler.php" name="add-btn" style="color: white; background-color: dodgerblue; border: none; padding: 10px; margin-right: 10px; text-decoration: none; font-size: 15px;"></">Add Product</a>
            <input type="submit" id="delete-product-btn" value="Mass Delete" name="delete-btn" style="color: white; background-color: red; border: none; padding: 10px; margin-left: 10px; font-size: 15px;"></input>
    </div>
        <h1>Product List</h1>
    </div>
    <hr>

<div style="display: grid; grid-template-columns: auto auto auto auto; gap: 30px;">

    <?php
    while($r = mysqli_fetch_assoc($res)){
    ?>

        <?php
       if($r['type'] == 'DVD'){
        ?>

    <div style= "border: 1px solid gray; margin-top: 10px; margin-bottom: 10px; font-size: 18px;">
        <input type="checkbox" name="checkbox[]" class="delete-checkbox" value="<?php echo $r["sku"]; ?>">
        <h6 style="text-align: center;"><?php echo $r['sku'] ?></h6>
        <h6 style="text-align: center;"><?php echo $r['name'] ?></h6>
        <h6 style="text-align: center;"><?php echo $r['price'] . ' $'?></h6>
        <h6 style="text-align: center;"><?php echo 'Size: '. $r["size"] . ' MB'?></h6>
    </div>
        <?php }?>


        <?php
       if($r['type'] == 'Furniture'){
        ?>

    <div style= "border: 1px solid gray; margin-top: 10px; margin-bottom: 10px; font-size: 18px;">
        <input type="checkbox" name="checkbox[]" class="delete-checkbox" value="<?php echo $r["sku"]; ?>">
        <h6 style="text-align: center;"><?php echo $r['sku'] ?></h6>
        <h6 style="text-align: center;"><?php echo $r['name'] ?></h6>
        <h6 style="text-align: center;"><?php echo $r['price'] . ' $'?></h6>
        <h6 style="text-align: center;"><?php echo 'Dimensions: '. $r["height"] . 'x'?><?php echo $r["width"] . 'x'?><?php echo $r["length"]?></h6>
    </div>
        <?php } ?>

        <?php
        if($r['type'] == 'Book'){
        ?>

    <div style= "border: 1px solid gray; margin-top: 10px; margin-bottom: 10px; font-size: 18px;">
        <input type="checkbox" name="checkbox[]" class="delete-checkbox" value="<?php echo $r["sku"]; ?>">
        <h6 style="text-align: center;"><?php echo $r['sku'] ?></h6>
        <h6 style="text-align: center;"><?php echo $r['name'] ?></h6>
        <h6 style="text-align: center;"><?php echo $r['price'] . ' $'?></h6>
        <h6 style="text-align: center;"><?php echo 'Weight: '. $r["weight"] . ' KG'?></h6>
    </div>
        <?php }?>

    <?php }?>
        </div>
</form>

</body>
</html>