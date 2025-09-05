<?php
$con = mysqli_connect("localhost", "root", "", "testdb");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$keyword_nama = isset($_GET['nama']) ? $_GET['nama'] : '';
$keyword_alamat = isset($_GET['alamat']) ? $_GET['alamat'] : '';

$sql = "SELECT DISTINCT p.nama, p.alamat, GROUP_CONCAT(h.hobi SEPARATOR ', ') as daftar_hobi
        FROM person p 
        LEFT JOIN hobi h ON p.id = h.person_id
        WHERE 1=1";

if (!empty($keyword_nama)) {
    $sql .= " AND p.nama LIKE '%" . mysqli_real_escape_string($con, $keyword_nama) . "%'";
}

if (!empty($keyword_alamat)) {
    $sql .= " AND p.alamat LIKE '%" . mysqli_real_escape_string($con, $keyword_alamat) . "%'";
}

$sql .= " GROUP BY p.id, p.nama, p.alamat";
$data = mysqli_query($con, $sql);

?>



<!DOCTYPE html>
<html>

<head>
    <title>Soal 3</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: leceft;
        }

        .search-container {
            margin-top: 20px;
            border: 2px solid black;
            padding: 20px;
            display: inline-block;
        }

        .button-center {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>
                Nama
                </td>
            <th>
                Alamat
                </td>
            <th>
                Hobi
                </td>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nama'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['alamat'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['daftar_hobi'] ?? ''); ?></td>
            </tr>
        <?php } ?>
    </table>
    <div class="search-container">
        <form method="GET" action="">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama"><br><br>
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat"><br><br>
            <button type="submit" class="button-center">SEARCH</button>
        </form>
    </div>
</body>

</html>

<?php
mysqli_close($con);
?>