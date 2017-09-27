<?php

$db = new PDO('mysql:host=127.0.0.1;dbname=families', 'root');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = $db->prepare("
SELECT children.name FROM children 
INNER JOIN colors 
ON children.`f_color` = colors.id 
WHERE colors.color = 'red';");
$query->execute();

$result = $query->fetchAll();

var_dump($result);

echo "<br>";
echo "<br>";
echo "<br>";

$query = $db->prepare("SELECT children.name FROM adults
INNER JOIN children
ON adults.`child1` = children.id
WHERE adults.pet_name = 'syd'
GROUP BY children.id;");
$query->execute();

$result = $query->fetch();

var_dump($result);

echo "<br>";
echo "<br>";
echo "<br>";


$query = $db->prepare("SELECT children.name, adults.pet_name FROM adults
INNER JOIN children 
ON adults.`child1` = children.id
WHERE adults.dob  > '1985-01-01';");
$query->execute();

$result = $query->fetchAll();

var_dump($result);

echo "<br>";
echo "<br>";
echo "<br>";

$query = $db->prepare("SELECT colors.color FROM children
INNER JOIN adults
ON adults.`child1` = children.id
INNER JOIN colors
ON children.`f_color` = colors.id
WHERE adults.dob >= '1991-01-01'
GROUP BY f_color
ORDER BY COUNT(colors.color) DESC LIMIT 1;");
$query->execute();

$result = $query->fetch();

var_dump($result);