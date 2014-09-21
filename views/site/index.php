<?
$command = "/sbin/ifconfig eth0 | grep 'inet addr:' | cut -d: -f2 | awk '{ print $1}'";
$ip = exec ($command);
?>

本机IP：<?= $ip ?>
