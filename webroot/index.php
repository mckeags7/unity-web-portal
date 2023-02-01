<?php

require_once "../resources/autoload.php";

require_once $LOC_HEADER;
?>

<h1>Cluster Notices</h1>
<hr>

<?php

$notices = $SQL->getNotices();
foreach ($notices as $notice) {
    echo "<div class='notice'>";
    echo "<span class='noticeTitle'>" . $notice["title"] . "</span>";
    echo $notice["message"];
    echo "</div>";
}

?>

<?php
require_once $LOC_FOOTER;
