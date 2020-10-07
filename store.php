<?php

//start session
 session_start();

require_once("includes/createDB.php");
require_once("includes/component.php");

// create instance of Createdb class
$database = new CreateDb("Productdb", "Producttb");

//add to cart
if (isset($_POST['add']))
{
    /// print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'store.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }
    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }       

}

?>






<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My Web</title>

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />

    <!-- Bootstrap CDN -->	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

     <!-- Additional CSS -->	
     <link rel="stylesheet" href="assets/css/store-style.css">   

</head>

    <!-- Navigation Bar-->
<?php require_once("includes/navi.php"); ?>

 
<body>
	

<div class="container">
	<div class="row row-cols-1 row-cols-md-4 text-center py-5">

		<?php   
			$result = $database->getData();
			while ($row = mysqli_fetch_assoc($result))
			{
			    component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
			}
		?>

	</div>	
</div>




    <!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>