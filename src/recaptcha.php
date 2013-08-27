<?php
/**
 * Created by Kago Kagichiri.
 * User: Kago
 * Date: 8/27/13
 * Time: 1:02 PM
 *
 */

class Recaptcha
{

    public $public_key;
    public $private_key;
    public $response;

    public function __construct($params = array())
    {
        if (!count($params)) {
            $params = Config::get('recaptcha::keys');
        }

        $this->public_key = arr($params, 'public_key', null);
        $this->private_key = arr($params, 'private_key', null);
    }

    public static function make($params = array())
    {
        $recaptcha = new Recaptcha($params);
        return $recaptcha;
    }

    public function widget()
    {
        if (!$this->public_key) {
            throw new Exception("No public key defined.");
        }

        return recaptcha_get_html($this->public_key);
    }

    public function verify()
    {
        if (!$this->private_key) {
            throw new Exception("No public key defined");
        }

        $resp = recaptcha_check_answer($this->private_key,
            $_SERVER["REMOTE_ADDR"],
            $_POST["recaptcha_challenge_field"],
            $_POST["recaptcha_response_field"]);

        $this->response = $resp;

        return $this;
    }

    public function passes()
    {
        return $this->verify()
            ->response
            ->is_valid;
    }

}