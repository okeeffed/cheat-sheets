# PDO Help Sheet

// Full website list

http://php.net/manual/en/class.pdostatement.php

## Setting up and making a query

```php
<?php

// SET TCP/IP CONNECTION IN SEQUEL PRO TO CONNECT TO MAMP FIRST

// SEQUEL PRO SETTINGS

// NAME: MAMP
// HOST: 127.0.0.1
// USERNAME: root
// PASSWORD: root
// PORT: 3306

$user = 'root';
$password = 'root';
$db = 'test-database';
$host= 'localhost';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM user";
    // use exec() because no results are returned
    foreach($conn->query($sql) as $row){
	    echo $row['name'] . "\t";
	    echo $row['email'] . "\t";
	    echo $row['password'] . "\n";
	}
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
```

## Treehouse Query Challenge

```php
<?php
include "helper.php";

/*
 * helper.php contains
 * $results->query("SELECT member_id, email, fullname, level FROM members");
 */
$user = $results->fetchAll(PDO::FETCH_ASSOC);
foreach ($user as $key)
{
  send_offer(
    $key['member_id'],
    $key['email'],
    $key['fullname'],
    $key['level']);
}
?>
```
