<?php
function clean($str) {
    return strtolower(preg_replace("/[^a-z]/", "", $str));
}

function generateBabyNames($father, $mother, $count = 8) {
    // Combine letters from both names
    $letters = array_unique(str_split($father . $mother));

    if (empty($letters)) {
        return ["No valid letters found."];
    }

    $names = [];
    for ($i = 0; $i < $count; $i++) {
        shuffle($letters);
        $length = rand(3, min(7, count($letters))); // baby name length between 3–7
        $subset = array_slice($letters, 0, $length);
        $babyName = ucfirst(implode("", $subset));
        $names[] = $babyName;
    }

    return array_unique($names);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $father = clean($_POST["father"]);
    $mother = clean($_POST["mother"]);

    $babyNames = generateBabyNames($father, $mother, 8); // generate 8 suggestions
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Baby Name Suggestions</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <h1>Baby Name Suggestions</h1>
      <p>Father: <strong><?= htmlspecialchars($_POST["father"]) ?></strong></p>
      <p>Mother: <strong><?= htmlspecialchars($_POST["mother"]) ?></strong></p>

      <h2>Suggested Baby Names:</h2>
      <ul>
        <?php foreach ($babyNames as $name): ?>
          <li style="font-size: 1.3em; color:#2563eb;"><?= htmlspecialchars($name) ?></li>
        <?php endforeach; ?>
      </ul>

      <a href="index.html" class="btn">Go Back</a>
    </div>
  </div>
</body>
</html>