<?php

include "header.php";
include "db.php";

if (isset($_POST['submit'])) {
    $student_name = $_POST['student_name'];
    $matric_number = $_POST['matric_number'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    $test1 = $_POST['test1'];
    $test2 = $_POST['test2'];
    $final = $_POST['final'];

    $total = $test1 + $test2 + $final;
    //80 - 100 = A
    //65 - 79 = B
    //50 - 64 = C
    //40 - 49 = D
    //0 - 39 = E


    if ($total >= 80) {
        $grade = "A";
    } elseif ($total >= 65 && $total <= 79) {
        $grade = "B";
    } elseif ($total >= 50 && $total <= 64) {
        $grade = "C";
    } elseif ($total >= 40 && $total <= 49) {
        $grade = "D";
    } elseif ($total >= 0 && $total <= 39) {
        $grade = "E";
    } elseif ($total >= -50 && $total < 0) {
        $grade = "SUPER F";
    } else {
        $grade = "EXECUTION";
    }

    $sql = $conn->prepare("INSERT INTO result 
    (student_name, matric_number, subject_name, subject_code, test1, test2, 
    final, total, grade) VALUES ('$student_name', '$matric_number', '$subject_name', 
    '$subject_code', '$test1', '$test2', '$final', '$total', '$grade')");

    if ($sql->execute()) {
        header("Location: index.php");
    }
}

$student_name = "";
$matric_number = "";
$subject_name = "";
$subject_code = "";
$test1 = "";
$test2 = "";
$final = "";
?>

<h2>ADD RESULTS</h2>

<?php
include "form.php";
include "footer.php";
?>