<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "togel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT n.id as no,tanggal,k.name as name,angka  FROM nomor n INNER JOIN kota k ON n.kota_id= k.id ORDER BY n.id ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    //echo $row["no"] ." - ". $row["tanggal"]. " - " . $row["name"]. "  - " . $row["angka"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
require_once("SimpleXLSXGen.php");
$books = "[
    ['No', 'Tanggal', 'Sidney', 'Singapore', 'Hong Kong' ],
    [618260307, 'The Hobbit', 'J. R. R. Tolkien', 'Houghton Mifflin', 'USA'],
    [908606664, 'Slinky Malinki', 'Lynley Dodd', 'Mallinson Rendel', 'NZ']
]";
$books = echo $books;
$xlsx = Shuchkin\SimpleXLSXGen::fromArray( $books );
$xlsx->saveAs('books.xlsx'); 
//downloadAs('books.xlsx'); //or $xlsx_content = (string) $xlsx 
?>