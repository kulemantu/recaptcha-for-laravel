<?php
/**
 * Created by Kago Kagichiri.
 * User: Kago
 * Date: 8/27/13
 * Time: 1:00 PM
 *
 */

require_once(Bundle::path('recaptcha') . '/src/recaptchalib.php');

Autoloader::map(array(
    'Recaptcha' => Bundle::path('recaptcha') . '/src/recaptcha.php',
));

Route::any('recaptcha-test', function(){
   return Recaptcha::widget();
});
