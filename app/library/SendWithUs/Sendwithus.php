<?php

/**
 * Send_With_Us
 *
 *
 */

use sendwithus\API;

class SendWithUs{
    private $API_KEY = 'live_d3111823e9e60f954f19d9398a6ed177934b15e1';
    private $email_id = '';
    private $options = null;
    private $api = null;
    private $recipient = null;
    private $sender = null;
    private $data = null;
    private $cc = null;
    private $bcc = null;
    public $templates = null;
    private $template_id = null;

    function __construct(){
        $this->api = new \sendwithus\API($this->API_KEY);
        $this->set_sender();
        $this->set_templates();
    }

    /**
     * Prepare
     * Takes in template name and prepares it
     *
     * @param string $template_name
     */
    function prepare($template_name) {

        $this->email_id = $this->get_template_id($template_name);

        $template = $this->api->get_template($this->template_id);

    }

    /**
     * Set Sender
     **************************************************************/

    function set_sender() {

        $this->sender = array(
            'name' => 'Edu Repo',
            'address' => 'goshensoftinc@gmail.com',
            'reply-to' => 'goshensoftinc@gmail.com'
        );

    }

    /**
     * Set Templates
     **************************************************************/

    function set_templates() {
        $this->templates['activate'] = 'tem_xdhynLx2rKCtfwDroWPYY4';
        $this->templates['pw_reset'] = 'tem_Y327WRLtSJSYCHzE8k7gWL';
        $this->templates['new_user'] = 'tem_zerB7fF6R9oxjRExcHm9B9';
    }

    /**
     * Get Template ID
     **************************************************************/

    function get_template_id($template_name) {
        return $this->templates[$template_name];
    }

    /**
     * set recipient
     **************************************************************/

    function set_recipient($user) {
        $this->recipient = array(
            'name' => $user['fullname'],
            'address' => $user['email']
        );
    }

    /**
     * Set Data
     **************************************************************/

    function set_data($data) {
        $this->data = $data;
    }

    /**
     * Send Email
     **************************************************************/

    function simple_send() {
        $response = $this->api->send(
            $this->email_id,
            $this->recipient,
            array("email_data" => $this->data)
        );
        mail('goshensoftinc@gmail.com', 'test', print_r($response, 1));
        return $response;
    }
}