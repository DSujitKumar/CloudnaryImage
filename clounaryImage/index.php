<?php
	require "vendor/autoload.php"; 
	require "config.php";
	require 'db.php';

	if (isset($_POST['submit'])) {



		$imgName=$_FILES["file"]["name"];
    	$tmpName=$_FILES["file"]["tmp_name"];
    	$product=$_POST['name'];
    	$price=$_POST['price'];
    	$descriptio=$_POST['desc'];
    	$discount=$_POST['discount'];
    	
    	$result=\Cloudinary\Uploader::upload($tmpName,$option=array());
    	$urlImg=$result['url'];
    	echo "<br>".$product."<br>";
    	echo $descriptio."<br>";

    	echo $price."<br>";
    	echo $discount."<br>";
    	echo cl_image_tag($urlImg);

    	$query="insert into product(name,description,cost,discount,image) values ('$product','$descriptio','$price','$discount','$urlImg')";
 		$qry=mysqli_query($con,$query);
 		echo $qry;
		if($qry) {
			echo "<b>Uploaded To DataBase...</b><br>";
		}else{
			echo (mysqli_error($con));
		}
	}
	
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Image Input</title>
	<style type="text/css">
		img{
			height: 200px;
			width: 300px;
		}
	</style>
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		<pre>
			Product Name:<input type="text" name="name">
			Product Desc:
				     <textarea name="desc" cols="22" rows="5"></textarea>
			Product price:<input type="text" name="price">
			Discount      : <input type="text" name="discount">
			<?php echo cl_image_upload_tag('image_id'); ?>
			<input type="submit" name="submit" value="Submit">
		</pre>
	</form>
	<hr><hr>

</body>
</html>