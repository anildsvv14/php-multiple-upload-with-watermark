
<?php
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {
            $mynewfile=move_uploaded_file($file_tmp,"uploaded/".$file_name);
			//water mark image that want to be front image
		 	$stamp = imagecreatefrompng('images/wat.png');
			//back image that used in background 
			$im = imagecreatefromjpeg('uploaded/'.$file_name);
			imagecopy($im, $stamp, 100, 350, 0, 0, imagesx($stamp), imagesy($stamp));
			header('Content-Type: image/png');
			
			//output the image
			imagepng($im,'watermark/'.$file_name, 0);
			
			
			
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>
<html>
   <body>
      
      <form action = "" method = "POST" enctype = "multipart/form-data">
         <input type = "file" name = "image" />
         <input type = "submit"/>			
      </form>
      
   </body>
</html>

