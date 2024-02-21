<?php
//where ill guyz register their reservation
$x = '10:12-14:93';
$num = preg_match_all('/^\d{2}:\d{2}-\d{2}:\d{2}$/',$x);
echo $num;

