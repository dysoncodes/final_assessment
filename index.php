<?php

include "db.php";
include "auth.php";

$search = $_GET['search'] ?? ''; // Get the search term from the query string, default to empty string if not set

//%$search%, eg: %Al = Ali,
$like = "%$search%";

$sql = $conn->prepare("SELECT * FROM result 
WHERE student_name LIKE ? OR matric_number LIKE ? 
OR subject_name LIKE ? OR subject_code LIKE ?");

$sql->bind_param("ssss", $like, $like, $like, $like);
// s = string, i = integer, d = double, b = blob   
$sql->execute();

$result = $sql->get_result();

include "header.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Assessment / Grading System</title>
</head>

<body>

    <h2>Student Records</h2>

    <a href="add.php">+ Add Result</a>

    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by name or id"
            value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
        <a href="index.php">Show all</a><br><br>
    </form>

    <div>

        <table border="5" cellspacing="0" cellpadding="7">

            <tr>
                <th>No.</th>
                <th>Student Name</th>
                <th>Matric No.</th>
                <th>Subject</th>
                <th>Subject Code</th>
                <th>Test 1 (20%)</th>
                <th>Test 2 (30%)</th>
                <th>Final (50%)</th>
                <th>Total (100%)</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>

            <?php
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['student_name'] . "</td>";
                echo "<td>" . $row['matric_number'] . "</td>";
                echo "<td>" . $row['subject_name'] . "</td>";
                echo "<td>" . $row['subject_code'] . "</td>";
                echo "<td>" . $row['test1'] . "</td>";
                echo "<td>" . $row['test2'] . "</td>";
                echo "<td>" . $row['final'] . "</td>";
                echo "<td>" . $row['total'] . "</td>";
                echo "<td>" . $row['grade'] . "</td>";
                echo "<td>";
                echo "<button><a href='edit.php?id=" . $row['id'] . "'>Edit</a></button>";
                echo "<button><a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a></button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>