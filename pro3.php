<?php
/* Write a program for Grade Calculator Using Functions. 
   Calculate total, average and grade and display the same. */

function calculateTotal($marks) {
    return array_sum($marks);
}

function calculateAverage($marks) {
    return array_sum($marks) / count($marks);
}

function getGrade($average) {
    if ($average >= 90) return "A+";
    elseif ($average >= 80) return "A";
    elseif ($average >= 70) return "B";
    elseif ($average >= 60) return "C";
    elseif ($average >= 50) return "D";
    else return "F";
}

$total = $average = $grade = $name = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];

    $marks = [
        floatval($_POST["subject1"]),
        floatval($_POST["subject2"]),
        floatval($_POST["subject3"]),
        floatval($_POST["subject4"])
    ];

    $total = calculateTotal($marks);
    $average = calculateAverage($marks);
    $grade = getGrade($average);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Grade Calculator</title>
    <style>
        body { font-family: Arial; background: #f7f7f7; padding: 30px; }
        .box { background: white; width: 450px; margin: auto; padding: 20px; border-radius: 8px; 
               box-shadow: 0 0 10px #aaa; }
        input { width: 100%; padding: 8px; margin: 6px 0; }
        input[type="submit"] { background: #4CAF50; color: white; border: none; }
        .result { background: #e8f5e9; padding: 10px; margin-top: 15px; border: 1px solid 
                  #4CAF50; border-radius: 4px; }
    </style>
</head>
<body>

<div class="box">
    <h2>Student Grade Calculator</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Student Name" required>
        <input type="number" name="subject1" placeholder="Subject 1 Marks" required>
        <input type="number" name="subject2" placeholder="Subject 2 Marks" required>
        <input type="number" name="subject3" placeholder="Subject 3 Marks" required>
        <input type="number" name="subject4" placeholder="Subject 4 Marks" required>
        <input type="submit" value="Calculate">
    </form>

    <?php if ($grade): ?>
    <div class="result">
        <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
        <p><strong>Total:</strong> <?= $total ?></p>
        <p><strong>Average:</strong> <?= number_format($average, 2) ?></p>
        <p><strong>Grade:</strong> <?= $grade ?></p>
    </div>
    <?php endif; ?>
</div>

</body>
</html>
