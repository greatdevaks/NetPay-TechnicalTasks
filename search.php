<form action="search.php" method="GET">
    <input type="text" name="query" />
    <input type="submit" value="Search" />
</form>
<?php

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "mydb";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 

// // // Create database
// // $sql = "CREATE DATABASE myDB";
// // if ($conn->query($sql) === TRUE) {
// //     echo "Database created successfully";
// // } else {
// //     echo "Error creating database: " . $conn->error;
// // }

// // sql to create table
// $sql = "CREATE TABLE MyDirs (
// category_id INT AUTO_INCREMENT PRIMARY KEY,
// name VARCHAR(100) NOT NULL,
// parent VARCHAR(100) DEFAULT NULL
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table MyDirs created successfully";
// } else {
//     echo "Error creating table: " . $conn->error;
// }

// $assoc_array = array();
// $assoc_array["C:"] = "";
// $assoc_array["Documents"] = "C:";
// $assoc_array["Images"] = "Documents";
// $assoc_array["Image1.jpg"] = "Images";
// $assoc_array["Image2.jpg"] = "Images";
// $assoc_array["Image3.jpg"] = "Images";
// $assoc_array["Works"] = "Documents";
// $assoc_array["Letter.doc"] = "Works";
// $assoc_array["Accountant"] = "Works";
// $assoc_array["Accounting.xls"] = "Accountant";
// $assoc_array["AnnualReport"] = "Accountant";
// $assoc_array["Program Files"] = "C:";
// $assoc_array["Skype"] = "Program Files";
// $assoc_array["Skype.exe"] = "Skype";
// $assoc_array["Readme.txt"] = "Skype";
// $assoc_array["Mysql"] = "Program Files";
// $assoc_array["Mysql.exe"] = "Mysql";
// $assoc_array["Mysql.com"] = "Mysql";

// foreach ($assoc_array as $key => $value) {
//  $sql = "INSERT INTO MyDirs (name, parent) VALUES ('$key', '$value')";

//  if ($conn->query($sql) === TRUE) {
//      echo "New record created successfully";
//  } else {
//      echo "Error: " . $sql . "<br>" . $conn->error;
//  }
// }

// $conn->close();

function get_paths($node) { 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    // look up the parent of this node 
    $sql = 'SELECT parent FROM MyDirs WHERE name LIKE "%'.$node.'%";';
    $result = $conn->query($sql); 
    $row = $result->fetch_assoc(); 
    // save the path in this array 
    $path = array(); 
    // only continue if this $node isn't the root node 
    // (that's the node with no parent) 
    if ($row['parent']!='') { 
        // the last part of the path to $node, is the name 
        // of the parent of $node 
        $path[] = $row['parent']; 
        // we should add the path to the parent of this node 
        // to the path 
        $path = array_merge(get_paths($row['parent']), $path); 
    } 
    $conn->close();
    // return the path 
    return $path; 
} 

function get_path($node) { 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    // look up the parent of this node 
    $sql = 'SELECT name, parent FROM MyDirs WHERE name LIKE "%'.$node.'%";';
    $result = $conn->query($sql);  

    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    foreach ($rows as $val) {
        print_r($val);
        echo "<br>";
        print_r(get_paths($val['name']));
        echo "<br><br>";
    }
    
    $conn->close();
   
} 

$query = $_GET['query']; 

print_r(get_path($query));
?>