<?php include("../template/header.php"); ?>
<?php

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtName = (isset($_POST['txtName'])) ? $_POST['txtName'] : "";
$txtImage = (isset($_FILES['txtImage']['name'])) ? $_FILES['txtImage']['name'] : "";
$txtAction = (isset($_POST['action'])) ? $_POST['action'] : "";
$txtDescription = (isset($_POST['txtDescription'])) ? $_POST['txtDescription'] : "";
$txtPrice = (isset($_POST['txtPrice'])) ? $_POST['txtPrice'] : "";


include("../config/db.php");
switch ($txtAction) {
    case "Add":
        $sentenceSQL = $conection->prepare("INSERT INTO products (name, description, price, image) VALUES (:name, :description, :price, :image)");
        $sentenceSQL->bindParam(':name', $txtName);
        $sentenceSQL->bindParam(':description', $txtDescription);
        $sentenceSQL->bindParam(':price', $txtPrice);
        $date = new DateTime();
        $fileName = ($txtImage != '') ? $date->getTimestamp() . "_" . $_FILES["txtImage"]["name"] : "imagen.jpg";
        $tmpImage = $_FILES["txtImage"]["tmp_name"];
        if ($tmpImage != "") {
            move_uploaded_file($tmpImage, "../../img/" . $fileName);
        }
        $sentenceSQL->bindParam(':image', $fileName);
        $sentenceSQL->execute();
        header("Location:products.php");
        break;

    case "Modify":
        $sentenceSQL = $conection->prepare("UPDATE products SET name=:name WHERE id=:id");
        $sentenceSQL->bindParam(':id', $txtID);
        $sentenceSQL->bindParam(':name', $txtName);
        $sentenceSQL->execute();

        if ($txtImage != '') {
            $date = new DateTime();
            $fileName = ($txtImage != '') ? $date->getTimestamp() . "_" . $_FILES["txtImage"]["name"] : "imagen.jpg";
            $tmpImage = $_FILES["txtImage"]["tmp_name"];

            move_uploaded_file($tmpImage, "../../img/" . $fileName);

            $sentenceSQL = $conection->prepare("SELECT image FROM products WHERE id=:id");
            $sentenceSQL->bindParam(':id', $txtID);
            $sentenceSQL->execute();
            $product = $sentenceSQL->fetch(PDO::FETCH_LAZY);
            if (isset($product["image"]) && ($product["image"] != 'imagen.jpg')) {
                if (file_exists("../../img/" . $product["image"])) {
                    unlink("../../img/" . $product["image"]);
                }
            }

            $sentenceSQL = $conection->prepare("UPDATE products SET image=:image WHERE id=:id");
            $sentenceSQL->bindParam(':id', $txtID);
            $sentenceSQL->bindParam(':image', $fileName);
            $sentenceSQL->execute();
        }
        if ($txtDescription != '') {
            $sentenceSQL = $conection->prepare("UPDATE products SET description=:description WHERE id=:id");
            $sentenceSQL->bindParam(':id', $txtID);
            $sentenceSQL->bindParam(':description', $txtDescription);
            $sentenceSQL->execute();
        }
        if ($txtPrice != '') {
            $sentenceSQL = $conection->prepare("UPDATE products SET price=:price WHERE id=:id");
            $sentenceSQL->bindParam(':id', $txtID);
            $sentenceSQL->bindParam(':price', $txtPrice);
            $sentenceSQL->execute();
        }
        header("Location:products.php");
        break;

    case "Cancel":
        header("Location:products.php");
        break;

    case "Select":
        $sentenceSQL = $conection->prepare("SELECT * FROM products WHERE id=:id");
        $sentenceSQL->bindParam(':id', $txtID);
        $sentenceSQL->execute();
        $product = $sentenceSQL->fetch(PDO::FETCH_LAZY);
        $txtName = $product['name'];
        $txtDescription = $product['description'];
        $txtPrice = $product['price'];
        $txtImage = $product['image'];
        break;
    case "Delete":
        $sentenceSQL = $conection->prepare("SELECT image FROM products WHERE id=:id");
        $sentenceSQL->bindParam(':id', $txtID);
        $sentenceSQL->execute();
        $product = $sentenceSQL->fetch(PDO::FETCH_LAZY);
        if (isset($product["image"]) && ($product["image"] != 'imagen.jpg')) {
            if (file_exists("../../img/" . $product["image"])) {
                unlink("../../img/" . $product["image"]);
            }
        }
        $sentenceSQL = $conection->prepare("DELETE FROM products WHERE id=:id");
        $sentenceSQL->bindParam(':id', $txtID);
        $sentenceSQL->execute();
        header("Location:products.php");
        break;
}

$sentenceSQL = $conection->prepare("SELECT * FROM products");
$sentenceSQL->execute();
$productList = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">
    <br /><br />
    <div class="card">
        <div class="card-header">
            Products Info
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID"
                        id="txtID" placeholder="ID">
                </div>
                <div class="form-group">
                    <label for="txtName">Enter Name:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtName; ?>" name="txtName"
                        id="txtName" placeholder="name">
                </div>
                <div class="form-group">
                    <label for="txtImage">Select Image:</label>
                    <br />
                    <?php if ($txtImage != '') { ?>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImage ?>" width="400" height=""
                            alt="" srcset="">
                    <?php } ?>
                    <input type="file" class="form-control" value="<?php echo $txtImage; ?>" name="txtImage"
                        id="txtImage" placeholder="Enter Image">
                </div>
                <div class="form-group">
                    <label for="txtDescription">Description:</label>
                    <input type="text" class="form-control" value="<?php echo $txtDescription; ?>" name="txtDescription"
                        id="txtDescription" placeholder="Enter Description">
                </div>
                <div class="form-group">
                    <label for="txtPrice">Enter Price:</label>
                    <input type="number" required class="form-control" value="<?php echo $txtPrice; ?>" name="txtPrice"
                        id="txtPrice" placeholder="Enter price">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="action" <?php echo ($txtAction == "Select") ? "disabled" : ""; ?>
                        value="Add" id="" class="btn btn-success">Add</button>
                    <button type="submit" name="action" <?php echo ($txtAction != "Select") ? "disabled" : ""; ?>
                        value="Modify" id="" class="btn btn-warning">Modify</button>
                    <button type="submit" name="action" <?php echo ($txtAction != "Select") ? "disabled" : ""; ?>
                        value="Cancel" id="" class="btn btn-info">Cancel</button>
                </div>
            </form>
        </div>
    </div>

</div>
<div class="col-md-7">
    <br /><br />
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productList as $product) { ?>
                <tr>
                    <td>
                        <?php echo $product['id'] ?>
                    </td>
                    <td>
                        <?php echo $product['name'] ?>
                    </td>
                    <td>
                        <?php echo $product['description'] ?>
                    </td>
                    <td>
                        <?php echo $product['price'] ?>
                    </td>
                    <td>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $product['image'] ?>" width="400"
                            alt="" srcset="">

                    </td>
                    <td>
                        <form method="post">

                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $product['id'] ?>" />
                            <div class="list-group">
                                <input type="submit" name="action" value="Select" class="btn btn-primary" />
                                <br />
                                <input type="submit" name="action" value="Delete" class="btn btn-danger" />
                            </div>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../template/footer.php"); ?>