<?php

if (isset($SSO)) {
  if (!$_SESSION["user_exists"]) {
    redirect($CONFIG["site"]["prefix"] . "/panel/new_account.php");
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <style>
    <?php
    // set global css variables from branding
    echo ":root {";
    foreach ($BRANDING["colors"] as $var_name => $var_value) {
      echo "--$var_name: $var_value;";
    }
    echo "}";
    ?>
  </style>

  <link rel="stylesheet" type="text/css" href="<?php echo $CONFIG["site"]["prefix"]; ?>/css/global.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $CONFIG["site"]["prefix"]; ?>/css/navbar.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $CONFIG["site"]["prefix"]; ?>/css/modal.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $CONFIG["site"]["prefix"]; ?>/css/tables.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo $BRANDING["site"]["description"] ?>">

  <title><?php echo $BRANDING["site"]["name"]; ?></title>
</head>

<body>

  <header>
    <img id="imgLogo" draggable=false src="<?php echo $CONFIG["site"]["prefix"]; ?>/res/logo.png">
    <a href="<?php echo $CONFIG["upstream"]["repo"] ?>" target="_blank" class="unity-state"><?php echo $CONFIG["upstream"]["version"] ?></a>
    <button class="hamburger vertical-align"><img draggable="false" src="<?php echo $CONFIG["site"]["prefix"]; ?>/res/menu.png" alt="Menu Button"></button>
  </header>

  <nav class="mainNav">
    <?php
    // Public Items - Always Visible
    echo "<a href='" . $CONFIG["site"]["prefix"] . "/index.php'>Home</a>";
    echo "<a target='_blank' href='" . $BRANDING["site"]["docs_url"] . "'>Documentation</a>";

    if (isset($_SESSION["user_exists"]) && $_SESSION["user_exists"]) {
      // Menu Items for Present Users
      echo "<a href='" . $CONFIG["site"]["prefix"] . "/panel/support.php'>Support</a>";
      echo "<a href='" . $CONFIG["site"]["prefix"] . "/panel/account.php'>Account Settings</a>";
      echo "<a href='" . $CONFIG["site"]["prefix"] . "/panel/groups.php'>My PIs</a>";

      if (isset($_SESSION["is_pi"]) && $_SESSION["is_pi"]) {
        // PI only pages
        echo "<a href='" . $CONFIG["site"]["prefix"] . "/panel/pi.php'>My Users</a>";
      }

      if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]) {
        // Admin only pages
        echo "<a href='" . $CONFIG["site"]["prefix"] . "/admin/user-mgmt.php'>User Management</a>";
      }

      // additional branding items
      $num_additional_items = count($BRANDING["menuitems"]["labels"]);
      for ($i = 0; $i < $num_additional_items; $i++) {
        echo "<a target='_blank' href='" . $BRANDING["menuitems"]["links"][$i] . "'>" . $BRANDING["menuitems"]["labels"][$i] . "</a>";
      }
    } else {
      echo "<a href='" . $CONFIG["site"]["prefix"] . "/panel/account.php'>Login / Request Account</a>";
    }
    ?>
  </nav>

  <div class="modalWrapper" style="display: none;">
    <div class="modalContent">
      <div class="modalTitleWrapper">
        <span class="modalTitle"></span>
        <button style="position: absolute; right: 10px; top: 10px;" class="btnClose"></button>
      </div>
      <div class="modalBody"></div>
      <div class="modalMessages"></div>
      <div class="modalButtons">
        <div class='buttonList messageButtons' style='display: none;'><button class='btnOkay'>Okay</button></div>
        <div class='buttonList yesnoButtons' style='display: none;'><button class='btnYes'>Yes</button><button class='btnNo'>No</button></div>
      </div>
    </div>
  </div>
  <script src="<?php echo $CONFIG["site"]["prefix"]; ?>/js/modal.js"></script>

  <main>