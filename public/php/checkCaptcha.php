<?php
/**
 * Created by PhpStorm.
 * User: Diego
 * Date: 22/08/2017
 * Time: 14:03
 */

$captcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LczvS0UAAAAABXxJ5KQtrZuvA36e2Amw10WVDy_&response=" . $_POST['response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
if($captcha->success == false)
{
    print_r(json_encode(array('status' => 'error', 'message' => 'No valid Captcha')));
}
else
{
    // Everything went ok...
}