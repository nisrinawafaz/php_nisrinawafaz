<?php

session_start();

if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 0;
}

if (!isset($_SESSION['data'])) {
    $_SESSION['data'] = [];
}

$fields = [
    'nama' => 'text',
    'umur' => 'number',
    'hobi' => 'text'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_SESSION['form_data'] ?? [];
    $_SESSION['form_data'] = array_merge($data, array_intersect_key($_POST, $fields));
    $_SESSION['step']++;
}

if ($_SESSION['step'] >= count($fields)) {
    foreach ($_SESSION['form_data'] as $key => $value) {
        echo "<p><strong>" . ucfirst($key) . ":</strong> " . htmlspecialchars($value) . "</p>";
    }
} else {
    $current_field = array_keys($fields)[$_SESSION['step']];
    $input_type = $fields[$current_field];
    echo "<form method='POST'>";
    echo "<label for='$current_field'>" . ucfirst($current_field) . " Anda :</label>";
    echo "<input type='$input_type' name='$current_field' id='$current_field' required>";
    echo "<br><br>";
    echo "<button type='submit'>SUBMIT</button>";
    echo "</form>";
}