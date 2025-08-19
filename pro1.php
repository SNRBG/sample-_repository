<?php
/* Write a program to calculate gross salary of a person 
The gross salary formula:
Gross Salary = Basic Salary + HRA + DA + Allowance - PF
Where:
• HRA (House Rent Allowance) is 20% of the basic salary.
• DA (Dearness Allowance) is 50% of the basic salary.
• PF (Provident Fund) is 11% of the basic salary.
• Allowance depends on the employee’s grade (e.g., 1700 for grade 'A', 1500 for grade 'B', and 
1300 for other grades).
*/

class Employee {
    public $name, $basic, $grade;

    public function __construct($name, $basic, $grade) {
        $this->name = $name;
        $this->basic = $basic;
        $this->grade = strtoupper($grade);
    }

    public function getHRA() {
        return 0.20 * $this->basic;
    }

    public function getDA() {
        return 0.50 * $this->basic;
    }

    public function getPF() {
        return 0.11 * $this->basic;
    }

    public function getAllowance() {
        switch ($this->grade) {
            case 'A': return 1700;
            case 'B': return 1500;
            default:  return 1300;
        }
    }

    public function getGrossSalary() {
        return $this->basic + $this->getHRA() + $this->getDA() + $this->getAllowance() - $this->getPF();
    }
}

$grossSalary = "";
$details = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $basic = floatval($_POST["basic"]);
    $grade = $_POST["grade"];

    $emp = new Employee($name, $basic, $grade);
    $grossSalary = $emp->getGrossSalary();
    $details = [
        'HRA' => $emp->getHRA(),
        'DA' => $emp->getDA(),
        'PF' => $emp->getPF(),
        'Allowance' => $emp->getAllowance()
    ];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gross Salary Calculator - OOP</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
            padding: 50px;
        }
        .container {
            width: 450px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px #aaa;
        }
        h2 {
            text-align: center;
            color: #00796b;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        input[type="submit"] {
            background-color: #00796b;
            color: white;
            border: none;
            cursor: pointer;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background: #e0f2f1;
            border: 1px solid #00796b;
            border-radius: 5px;
        }
        .result p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Gross Salary Calculator</h2>
    <form method="post">
        <label>Employee Name:</label>
        <input type="text" name="name" required>

        <label>Basic Salary:</label>
        <input type="number" name="basic" step="0.01" required>

        <label>Grade:</label>
        <select name="grade" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">Other</option>
        </select>

        <input type="submit" value="Calculate">
    </form>

    <?php if ($grossSalary !== ""): ?>
        <div class="result">
            <p><strong>Employee:</strong> <?= htmlspecialchars($name) ?></p>
            <p><strong>Basic Salary :</strong> <?= htmlspecialchars($basic) ?></p>        
            <p><strong>HRA:</strong> ₹<?= number_format($details['HRA'], 2) ?></p>
            <p><strong>DA:</strong> ₹<?= number_format($details['DA'], 2) ?></p>
            <p><strong>PF:</strong> ₹<?= number_format($details['PF'], 2) ?></p>
            <p><strong>Allowance:</strong> ₹<?= number_format($details['Allowance'], 2) ?></p>
            <hr>
            <p><strong>Gross Salary:</strong> ₹<?= number_format($grossSalary, 2) ?></p>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
