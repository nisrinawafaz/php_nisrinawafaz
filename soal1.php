<?php

$jml = $_GET['jml'] ?? '';
echo "<table border=1 style='border-collapse: collapse;'>\n";
for ($a = $jml; $a > 0; $a--) {
    $total = ($a * ($a + 1)) / 2;
    echo "<tr><td colspan='$jml'>TOTAL : $total</tr>\n";
    echo "<tr>\n";
    for ($b = $a; $b > 0; $b--) {
        echo "<td>$b</td>";
    }
    echo "</tr>\n";
}
echo "</table>";

?>