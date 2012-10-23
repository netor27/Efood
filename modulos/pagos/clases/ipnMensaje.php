<?php

class IpnMensaje {

    public $txn_type = null;
    public $txn_id = null;
    public $receiver_email = null;
    public $item_name = null;
    public $item_number = null;
    public $payment_status = null;
    public $parent_txt_id = null;
    public $mc_gross = null;
    public $mc_fee = null;
    public $mc_currency = null;
    public $first_name = null;
    public $last_name = null;
    public $payer_email = null;
    public $payment_date = null;
    public $test_ipn = 0;
    public $custom = null;
    public $complete_post = null;

    function __construct() {
        
    }

    function toString() {
        $res = "";
        $res.="<table border='1'>";
        $res.="<tr><td>txn_type</td><td>" . $this->txn_type . "</td></tr>";
        $res.=" <tr><td> txn_id </td><td> " . $this->txn_id . "</td></tr>";
        $res.=" <tr><td> receirver_email </td><td>" . $this->receiver_email . "</td></tr>";
        $res.=" <tr><td> item_name </td><td>" . $this->item_name . "</td></tr>";
        $res.=" <tr><td> item_number </td><td>" . $this->item_number . "</td></tr>";
        $res.=" <tr><td> payment_status </td><td>" . $this->payment_status . "</td></tr>";
        $res.=" <tr><td> parent_txt_id </td><td>" . $this->parent_txt_id . "</td></tr>";
        $res.=" <tr><td> mc_gross (cantidad depositada)</td><td>" . $this->mc_gross . "</td></tr>";
        $res.=" <tr><td> mc_fee (comision) </td><td>" . $this->mc_fee . "</td></tr>";
        $res.=" <tr><td> mc_currency </td><td>" . $this->mc_currency . "</td></tr>";
        $res.=" <tr><td> first_name </td><td>" . $this->first_name . "</td></tr>";
        $res.=" <tr><td> last_name </td><td>" . $this->last_name . "</td></tr>";
        $res.=" <tr><td> payer_email </td><td>" . $this->payer_email . "</td></tr>";
        $res.=" <tr><td> payment_date </td><td>" . $this->payment_date . "</td></tr>";
        $res.=" <tr><td> test_ipn </td><td>" . $this->test_ipn . "</td></tr>";
        $res.=" <tr><td> custom </td><td>" . $this->custom . "</td></tr>";
        $res.="</table><br><br><br>";
        $res.="Complete post<br><br> " . $this->complete_post;        
        return $res;
    }

}

?>
