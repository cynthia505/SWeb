<?php
require_once('connection.php');

if(isset($_POST["save"])){
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['product'];
    $size = $_POST['size'];
    $height= $_POST['height'];
    $width= $_POST['width'];
    $length= $_POST['length'];
    $weight= $_POST['weight'];
    
    if($type == "DVD" & !empty($_POST['size'])){
        $res = $database->insertForDvd($sku, $name, $price,$type, $size);
        if($res){
            header("Location: view.php");
        }else{
            echo "Data insertion failed";
        }
    }else if($type == "Furniture" & !empty($_POST['height']) || ($_POST['width']) || $_POST['length'] ){
        $res2 = $database->insertForFurniture($sku, $name, $price, $type, $height, $width, $length);
        if($res2){
            header("Location: view.php");
        }else{
            echo "Data insertion failed";
        }
    }else if($type == "Book" & !empty($_POST['weight'])){
        $res3 = $database->insertForBook($sku, $name, $price,$type, $weight);
        if($res3){
            header("Location: view.php");
        }else{
            echo "Data insertion failed";
        }
    }else{
        echo "Please submit required data!";
    }
}

if(isset($_POST["cancel"])){
    header("Location: view.php");
}
?>

<!DOCTYPE html>
    <html>
    <head>
        <title>Add Product</title>
        <style>
        *{
            font-family: sans-serif;
        }
        </style>
    </head>
    <body>

        <div class="form">
            <form method="post">

            <div>
                <div style="display: flex; float: right; padding-top: 10px;">
                <input type="submit" name="save" style="color: white; background-color: dodgerblue; border: none; padding: 10px; margin-right: 10px; text-decoration: none; font-size: 16px;"></input>
                <a href="view.php" name="cancel" style="color: white; background-color: red; border: none; padding: 10px; margin-right: 10px; text-decoration: none; font-size: 16px;">Cancel</a>
            </div>
                <h1>Add Product</h1>
            </div>
            <hr>


                <div class="form-group" style="padding-top: 5px; margin-top: 20px;">
                    <label>SKU</label>
                    <div>
                        <input type="text" name="sku" id="sku"  style="border: 1px solid gray; padding: 3px;  width: 20%; " required>
                    </div>
                </div>

                <div class="form-group" style="padding-top: 5px; margin-top: 20px;">
                    <label>Name</label>
                    <div>
                        <input type="text" name="name"  id="name" style="border: 1px solid gray; padding: 3px;  width: 20%; " required>
                    </div>
                </div>

                <div class="form-group" style="padding-top: 5px; margin-top: 20px;">
                    <label>Price($)</label>
                    <div>
                        <input type="number" name="price" id="price" style="border: 1px solid gray; padding: 3px;  width: 20%; margin-bottom: 20px;" required>
                    </div>
                </div>
                <label >Type Switcher</label><br>
                <select id="productType" name="product" style="padding-top: 5px; width: 20%;" onChange="prodType(this.value);">
                
                    <option name="type" value="chooseType">Choose Type</option>
                    <option name="type" value="DVD">DVD-Disc</option>
                    <option name="type" value="Furniture">Furniture</option>
                    <option name="type" value="Book">Book</option>
                </select>
                
                <!-- DVD FORM -->

                <div style="display: none;" id="dvdForm">

                <div class="form-group" style="padding-top: 5px; margin-top: 20px;">
                    <label>Size(MB)</label>
                <div>
                     <input type="number" name="size" id="size" style="margin-bottom: 20px; border: 1px solid gray; padding: 3px;  width: 20%; " >
                     <h6 style="font-size: 12px; font-weight: bolder;"><?php echo "Please Provide Size" ?></h6>
                </div>
                </div>

                </div>

                <!-- FURNITURE FORM -->
                
                <div style="display: none;" id="furnitureForm">

                    <div class="form-group" style="padding-top: 5px; margin-top: 20px;">
                    <label>Height(CM)</label>
                    <div>
                    <input type="number" name="height" id="height" style="margin-bottom: 20px; border: 1px solid gray; padding: 3px;  width: 20%; " >
                    </div>
                </div>

                <div class="form-group">
                    <label>width(CM)</label>
                    <div>
                    <input type="number" name="width" id="width" style="margin-bottom: 20px; border: 1px solid gray; padding: 3px;  width: 20%; ;" >
                    </div>
                    </div>
                <div class="form-group">
                    <label>Length(CM)</label>
                    <div>
                    <input type="number" name="length" id="length" style="margin-bottom: 20px; border: 1px solid gray; padding: 3px;  width: 20%; " >
                    </div>
                    </div>
                    <h6 style="font-size: 12px; font-weight: bolder;"><?php echo "Please Provide Dimensions" ?></h6>
                </div>

                <!-- BOOK FORM -->
                
                
                <div style="display: none;" id="bookForm">
                    <div class="form-group" style="padding-top: 5px; margin-top: 20px;">
                    <label>Weight(KG)</label>
                    <div>
                        <input type="number" name="weight" id="weight" style="margin-bottom: 20px; border: 1px solid gray; padding: 3px;  width: 20%; " >
                        <h6 style="font-size: 12px; font-weight: bolder;"><?php echo "Please Provide Weight" ?></h6>
                    </div>
                    </div>
                </div>

            </form>
        </div>
    </body>
    </html>


<script>
    function prodType(prod){
  var dvdForm = document.getElementById("dvdForm");
  var furnitureForm = document.getElementById("furnitureForm");
  var bookForm = document.getElementById("bookForm");

  if(prod == "chooseType"){
    dvdForm.style.display="none";
    furnitureForm.style.display="none";
    bookForm.style.display="none";
  }
  
  if(prod=="DVD"){
    dvdForm.style.display="block";
    furnitureForm.style.display="none";
    bookForm.style.display="none";
  }else if(prod=="Furniture"){
    dvdForm.style.display="none";
    bookForm.style.display="none";
    furnitureForm.style.display="block";
  }else if(prod=="Book"){
    dvdForm.style.display="none";
    furnitureForm.style.display="none";
    bookForm.style.display="block";
  }
}
</script>