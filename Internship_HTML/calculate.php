<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gradePoints = $_POST['gradePoints'];
    $creditHours = $_POST['creditHours'];

    $totalGradePoints = 0;
    $totalCreditHours = 0;

    for ($i = 0; $i < count($gradePoints); $i++) {
        $totalGradePoints += $gradePoints[$i] * $creditHours[$i];
        $totalCreditHours += $creditHours[$i];
    }

    $cgpa = $totalGradePoints / $totalCreditHours;
    echo "<div id='result'>Your CGPA is: " . number_format($cgpa, 2) . "</div>";
}
?>
