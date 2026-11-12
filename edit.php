<?php
include 'db.php';
include "header.php";

//fallback, ?? equal to if else 
$id = $_GET['id'] ?? 0;

$sql = $conn->prepare("SELECT * FROM result WHERE id = $id");

$sql->execute();

$row = $sql->get_result()->fetch_assoc();
/*$row = [id, student_name, matric_number, subject_name, subject_code, test1, test2, final, total, grade]
[1, niggachin, 2022....,
2, amad, 2020......    ]
*/

$student_name = $row['student_name'];
$matric_number = $row['matric_number'];
$subject_name = $row['subject_name'];
$subject_code = $row['subject_code'];
$test1 = $row['test1'];
$test2 = $row['test2'];
$final = $row['final'];

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
    //-50 - 0 = SUPER F
    //-100 - -51 = EXECUTION

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

    $sql = $conn->prepare("UPDATE result SET
    student_name = '$student_name', 
    matric_number = '$matric_number', 
    subject_name = '$subject_name',
    subject_code = '$subject_code', 
    test1 = '$test1', 
    test2 = '$test2', 
    final = '$final', 
    total = '$total', 
    grade = '$grade' 
    WHERE id = $id");

    if ($sql->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Update failed: " . $sql->error;
    }

}

?>


<h2>Edit Result</h2>

<?php
include "form.php";
include "footer.php";
?>