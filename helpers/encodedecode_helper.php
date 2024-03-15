<?php
function encode($data) {
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function decode($data) {
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}
?>