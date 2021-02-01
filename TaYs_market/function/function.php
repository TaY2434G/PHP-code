<?php
function escape($yet){
  foreach ($yet as $key => $value) {
    $done[$key] = htmlspecialchars($value,ENT_QUOTES,'UTF-8');
  }
  return $done;
}
?>
