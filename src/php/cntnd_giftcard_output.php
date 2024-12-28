<?php
// cntnd_giftcard_output
$cntnd_module = "cntnd_giftcard";

// assert framework initialization
defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.');

// editmode
$editmode = cRegistry::isBackendEditMode();

// includes
cInclude('module', 'includes/class.cntnd_giftcard.php');
if ($editmode) {
    cInclude('module', 'includes/script.cntnd_giftcard.php');
    cInclude('module', 'includes/style.cntnd_giftcard.php');
}

// module
if ($editmode){
    echo '<span class="module_box"><label class="module_label">'.mi18n("MODULE").'</label></span>';
}

// PUBLIC
$uriBuilder = cUriBuilderFrontcontent::getInstance();
$uriBuilder->buildUrl(['idart' => $idart], true);
$redirect = $uriBuilder->getUrl();

if (!empty($_GET['result']) && $_GET['result'] == "success") {
    echo '<div class="cntnd_alert cntnd_alert-primary">' . mi18n("SUCCESS") . '</div>';
}
echo '<div class="cntnd_giftcard">';
echo '<form method="post" id="cntnd_giftcard-reservation" name="cntnd_giftcard-reservation" action="https://giftcard.schuepfenried.ch/order/">';

// show messages
if (!empty($_GET['result']) && $_GET['result'] == "failure") {
    echo '<div id="cntnd_giftcard-form"></div>';
}
$failureMsg = (!empty($_GET['error']) && $_GET['error'] == "failure") ? '' : 'hide';
echo '<div class="cntnd_alert cntnd_alert-danger cntnd_booking-validation ' . $failureMsg . '">';
echo mi18n("VALIDATION");
echo '<ul>';
echo '<li class="cntnd_booking-validation-required">' . mi18n("VALIDATION_REQUIRED") . '</li>';
echo '</ul>';
echo '</div>';
if (!empty($_GET['error']) && $_GET['error'] == "payment") {
    echo '<div class="cntnd_alert cntnd_alert-danger">' . mi18n("PAYMENT_FAILURE") . '</li></div>';
}
else if (!empty($_GET['error'])) {
    echo '<div class="cntnd_alert cntnd_alert-danger">' . mi18n("FAILURE") . '</li></div>';
}

$tpl = cSmartyFrontend::getInstance();
$tpl->display('default.html');

echo '<button type="submit" class="btn btn-primary">' . mi18n("SAVE") . '</button>&nbsp;';
echo '<button type="reset" class="btn">' . mi18n("RESET") . '</button>';
echo '<input type="hidden" name="required" id="cntnd_giftcard-required" />';
echo '<input type="hidden" name="fields" id="cntnd_giftcard-fields" />';
echo '<input type="hidden" name="redirect" value="' . $redirect . '" />';
echo '</form>';
echo '</div>';
?>
