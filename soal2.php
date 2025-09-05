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
    $step = $_POST['step'];
    $next = $step + 1;

    $current_field = array_keys($fields)[$step];
    if (isset($_POST[$current_field])) {
        $_SESSION['data'][$current_field] = $_POST[$current_field];
    }

    $_SESSION['step'] = $next;

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if ($_SESSION['step'] >= count($fields)) {
    foreach ($_SESSION['data'] as $key => $value) {
        echo "<p><strong>" . ucfirst($key) . ":</strong> " . htmlspecialchars($value) . "</p>";
    }

    session_destroy();
} else {
    $step = $_SESSION['step'];
    $current_field = array_keys($fields)[$step];
    $input_type = $fields[$current_field];
    echo "<form method='POST'>";
    echo "<label for='$current_field'>" . ucfirst($current_field) . " Anda :</label>";
    echo "<input type='$input_type' name='$current_field' id='$current_field' required>";
    echo "<input type='hidden' name='step' value='$step'/>";
    echo "<br><br>";
    echo "<button type='submit'>SUBMIT</button>";
    echo "</form>";
}