<?php
/* Write a program for Student Record Management System.
   Add student records (Name, Roll No, Marks), Store data in a .txt file, 
   Display all records in a table, Delete all records (reset functionality) 
*/

$file = "students.txt";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add record
    if (isset($_POST["submit"])) {
        $name = trim($_POST["name"]);
        $roll = trim($_POST["roll"]);
        $marks = trim($_POST["marks"]);

        if ($name && $roll && is_numeric($marks)) {
            $data = "$name|$roll|$marks\n";
            file_put_contents($file, $data, FILE_APPEND);
            $message = "Record added successfully.";
        } else {
            $message = "Please enter valid data.";
        }
    }

    // Reset file
    if (isset($_POST["reset"])) {
        file_put_contents($file, "");
        $message = "All records deleted.";
    }
}

// Load records
$records = [];
if (file_exists($file)) {
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        $parts = explode("|", $line);
        if (count($parts) === 3) {
            $records[] = [
                "name" => $parts[0],
                "roll" => $parts[1],
                "marks" => $parts[2]
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Record System</title>
    <style>
        body { 
            font-family: Arial; 
            background: #f4f4f4; 
            padding: 20px; 
        }
        .container { 
            width: 600px; 
            margin: auto; 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 0 10px #aaa; 
        }
        h2 { 
            text-align: center; 
            color: #333; 
        }
        form { 
            margin-bottom: 20px; 
        }
        input[type="text"], input[type="number"] {
            width: 100%; 
            padding: 10px; 
            margin: 5px 0 15px; 
            border: 1px solid #ccc; 
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px 20px; 
            border: none; 
            background: #2196F3; 
            color: white; 
            border-radius: 5px;
            cursor: pointer; 
            margin-right: 10px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        table, th, td { 
            border
