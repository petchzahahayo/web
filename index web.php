<?php
//ติดต่อ
$servername = "localhost";
$username = "root";
$password = "123456";

try {
    $conn = new PDO("mysql:host=$servername;dbname=com", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //*echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


//เอาเข้า
if(! empty($_GET['1'])&& !empty($_GET['2'])&& !empty($_GET['3']))
{
$idcom = $_GET['1'];
$brand = $_GET['2'];
$price = $_GET['3'];

//เอาออก
$sql = "INSERT INTO computer(idcom,brand,price)
VALUES('$idcom','$brand','$price')";
$conn ->exec ($sql);
header("Location: index.php");
}

if(!empty($_POST['id']))
{
$Del = $_POST['id'];

$sql="DELETE FROM computer WHERE idcom=$Del";
$conn->exec($sql);
header("Location: index.php");
}

//แก้ไข
if(! empty($_GET['4'])&& !empty($_GET['5'])&& !empty($_GET['6']))
{
    $idcom = $_GET['4'];
    $brand = $_GET['5'];
   $price = $_GET['6'];

$sql = "UPDATE computer SET idcom='$idcom',brand='$brand',price='$price' where idcom='$idcom'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn ->exec ($sql);
header("Location: index.php");
}
?>



<html>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>

<div class="w3-container w3-content w3-padding-64" style="max-width:800px">
   <!--ส่วนเพิ่มข้อมูล-->
  <form metod="GET"action="index.php"class="w3-half w3-container" >    
    <h2 class="w3-wide w3-center">INSERT</h2>
   
    <div class="w3-row w3-padding-30">
        
              <input class="w3-input w3-border" type="text" placeholder="ID" name="1" >
            <br>
            
              <input class="w3-input w3-border" type="text" placeholder="Brand" name="2">
           <br>
           
            <input class="w3-input w3-border" type="text" placeholder="Price" name="3">
        
           <input type="submit" value="Enter"class="w3-button w3-black w3-section w3-center">
     </div>     
  </form> 
  
  <!--ส่วนแก้ไขข้อมูล-->
  <form metod="GET" class="w3-half w3-container" >
  <div class="w3-row w3-padding-30">
  <h2 class="w3-wide w3-center">EDIT</h2>
    <input type=text name="4" placeholder="ID" class="w3-input w3-border"><br>
    <input type=text name="5" placeholder="Brand" class="w3-input w3-border"><br>
    <input type=text name="6" placeholder="Price" class="w3-input w3-border">

    <input type="submit" value="Enter"class="w3-button w3-black w3-section w3-center">
  </div> 
  </form> 

<br>
<!--ส่วนลบข้อมูล-->
  <form  method="POST">
        <h2 class="w3-wide w3-center">DELETE</h2>
          <input class="w3-input w3-border" type="text" placeholder="ID_Delete" name="id">
   
          <input type="submit" value="Enter"class="w3-button w3-black w3-section w3-center">
  </from>    
</div>

<!--แสดงผล-->
<center>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }

</style>
 <h2 class="w3-wide w3-center">DATA</h2>
<table style="width:60%">
  <tr>
    <th>ID</th>
    <th>Brand</th> 
    <th>Price</th>
  </tr>
  <tr>

    <td>
    <?php
    $sql = "SELECT * FROM computer";
    $stmt = $conn->prepare( $sql ); 
    $stmt->execute();
    while($data=$stmt->fetch() ){
      
     echo $data ['idcom']."<br><hr>";
      }?>
    </td>

    <td>
    <?php
    $sql = "SELECT * FROM computer";
    $stmt = $conn->prepare( $sql ); 
    $stmt->execute();
    while($data=$stmt->fetch() ){
    echo $data ['brand']."<br><hr>";
    }?>
    </td>
    
    <td>
    <?php
    $sql = "SELECT * FROM computer";
    $stmt = $conn->prepare( $sql ); 
    $stmt->execute();
    while($data=$stmt->fetch() ){
      echo $data ['price']."<br><hr>";
    } ?>
    </td>

  </tr>
</table>
</center>
<hr>
</body>
</html>
     








