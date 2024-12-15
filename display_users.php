<html>
    <head>
        <title>Users Table</title>
        <style>
            table {
                width: 50%;
                border-collapse: collapse;
                margin: 25px 0;
                font-size: 18px;
                text-align: left;
            }

            th, td {
                padding: 12px;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <h1>Users List</h1>
        <table>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Level</th>
            </tr>

            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Lab_5b";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error); 
                }

            $sql = "SELECT matric, name, role FROM users"; 
            $result = $conn->query($sql); 
            
            if ($result->num_rows > 0) {  
                while($row = $result->fetch_assoc()) { 
                    echo "<tr>"; 
                    echo "<td>" . $row["matric"] . "</td>"; 
                    echo "<td>" . $row["name"] . "</td>"; 
                    echo "<td>" . $row["role"] . "</td>"; 
                    echo "</tr>"; 
                } 
            } else { 
                echo "<tr><td colspan='3'>No data available</td></tr>"; 
            } 
            
            $conn->close(); 
            ?>
        </table>
    </body>
</html>