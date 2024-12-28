<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/cntnd/core_style@1.1.1/dist/core_style.css">
<style>
<?php
$mod = new cApiModule($cCurrentModule);
echo file_get_contents($cfgClient[$client]["module"]["path"].'/'.$mod->get("alias").'/css/'.$mod->get("alias").'.css')
?>
</style>
