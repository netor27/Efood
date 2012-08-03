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
        $res = "Mensaje recibido " + date("d/m/Y  H:i:s");
        $res.=" /n txn_type => " . $this->txn_type;
        $res.=" /n txn_id => " . $this->txn_id;
        $res.=" /n receirver_email =>" . $this->receiver_email;
        $res.=" /n item_name =>" . $this->item_name;
        $res.=" /n item_number =>" . $this->item_number;
        $res.=" /n payment_status =>" . $this->payment_status;
        $res.=" /n parent_txt_id =>" . $this->parent_txt_id;
        $res.=" /n mc_gross (cantidad depositada)=>" . $this->mc_gross;
        $res.=" /n mc_fee (comision) =>" . $this->mc_fee;
        $res.=" /n mc_currency =>" . $this->mc_currency;
        $res.=" /n first_name =>" . $this->first_name;
        $res.=" /n last_name =>" . $this->last_name;
        $res.=" /n payer_email =>" . $this->payer_email;        
        $res.=" /n payment_date =>" . $this->payment_date;
        $res.=" /n test_ipn =>" . $this->test_ipn;
        $res.=" /n custom =>" . $this->custom;
        $res.=" /n/n/n/n Complete post/n/n/n " . $this->complete_post;
        return $res;
    }

}

?>
