<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Lab_5b";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['matric'])) {
        $matric = $_GET['matric'];

        $sql = "SELECT * FROM users WHERE matric=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $matric);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
        } else {
            echo "User not found.";
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $matric = $_POST['matric'];
        $name = $_POST['name'];
        $role = $_POST['role'];

        $sql = "UPDATE users SET name=?, role=? WHERE matric=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $role, $matric);

        if ($stmt->execute()) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    }
    $conn->close();
    ?>

    <form action="update.php" method="post">
        <input type="hidden" name="matric" value="<?php echo $row['matric']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="">Please select</option>
            <option value="student" <?php if ($row['role'] == 'student') echo 'selected'; ?>>Student</option>
            <option value="teacher" <?php if ($row['role'] == 'teacher') echo 'selected'; ?>>Teacher</option>
            <option value="admin" <?php if ($row['role'] == 'admin') echo 'selected'; ?>>Admin</option>
        </select><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
