<?php echo file_get_contents("search_results_header.html"); ?>


<?php
$servername = "localhost";
$username = "id20603116_jsekavec";
$password = "****************";
$dbname = "id20603116_sql_project";
//  id20603116_sql_project

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// I want to create a session cookie here somehow... I think 




////////////////////////////


$myArray = [];
$in = 0;
$variabl;
$testarr = [1,2,3,4];
/*
for($i = 0; $i<4; $i++){
    echo $testarr[$i];
}*/

$myPostArgs = filter_input_array(INPUT_POST);

// var_dump($myPostArgs);

foreach ($_POST as $param_name => $param_val) {
    $variabl = $param_val;
    //echo $variabl . "<br>";
    array_push($myArray,$variabl);
}
/*
foreach ($myArray as $value) {

    echo $value . " HA! <br>";
}*/
// Okay... Now we have a populated array to try to push to the sql statements.
// That was... beyond annoying.

$product_name = "%" . $myArray[0] . "%";
$product_city = "%" . $myArray[1] . "%";

//echo "Product Name: " . $product_name . "<br>". "Product City: " . $product_city . "<br>"; 

// Now to parse some things into ints...


$minqty = 0;
$maxqty = 999999999999;
$minprice = 0;
$maxprice = 99999999999999999;

//$rangeArray = [$minqty, $maxqty, $minprice, $maxprice];


$var2 = $myArray[2];
$var3 = $myArray[3];
$var4 = $myArray[4];
$var5 = $myArray[5];



$integerIDs = array_map('intval', $myArray);

/*
echo "FINAL VALUES <br>";


for($i = 2; $i < 6; $i++){
    echo "<br>" . $integerIDs[$i] . "<br>";
}*/

if($integerIDs[2] != 0){
    $minqty = $integerIDs[2];
}
if($integerIDs[3] != 0){
    $maxqty = $integerIDs[3];
}
if($integerIDs[4] != 0){
    $minprice = $integerIDs[4];
}
if($integerIDs[5] != 0){
    $minqty = $integerIDs[5];
}

$sql = "SELECT * 
FROM products
WHERE pname LIKE '$product_name' AND city LIKE '$product_city' AND quantity >= '$minqty'AND quantity <= '$maxqty' AND price >= '$minprice' AND price <= '$maxprice'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  echo "<table style=\"width: 500px; table-layout: fixed; border: 1px solid white\"> <tr> <td style=\"color: white;border: 1px solid white;\">ID</td> <td style=\"color: white; border: 1px solid white;\">Name</td> <td style=\"color: white; border: 1px solid white;\">City</td> <td style=\"color: white; border: 1px solid white;\">Quantity</td> <td style=\"color: white; border: 1px solid white;\">Price</td> </tr> </table> <br>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<table style=\"width: 500px; table-layout: fixed; border: 1px solid white;\">" . "<tr>" . "<td style=\"color:white; border: 1px solid white;\">" . $row["pid"]. "</td>" . "<td style=\"color:white; border: 1px solid white\">" . $row["pname"] . "</td>" . "<td style=\"color:white; border: 1px solid white\">" .$row["city"] . "</td>" . "<td style=\"color:white; border: 1px solid white;\">" .$row["quantity"] . "</td>". "<td style=\"color:white; border: 1px solid white;\">" . $row["price"] . "</td>". "</tr>". "</table>" ."<br>";
  }

} else {
  echo "0 results";
}

// <div class="qty_child">



$conn->close();
?>

<?php echo file_get_contents("search_results_footer.html"); ?>