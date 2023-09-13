<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use CodeIgniter\Controller;
use Config\Services;
use App\Libraries\CcavenueCrypto;

class PaymentController extends Controller {

//    public function index()
//    {
//        return view('payment_form');
//    }

    public function book_now() {
        $data['page_title'] = "Book Now";
        $data['current_page'] = "book_now";
        $data['load_page'] = "payment/book_now";
        $merchant_data = MERCHANT_ID;
        $working_key = WORKING_KEY; //Shared by CCAVENUES
        $access_code = ACCESS_CODE; //Shared by CCAVENUES
        $this->CcavenueCrypto = new CcavenueCrypto();
        //$CcavenueCrypto = new CcavenueCrypto();
        $encrypted_data = $this->CcavenueCrypto->encrypt($merchant_data, $working_key);
        $data['production_url']=PRODUCTION_URL.'transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
        //$SeoModel = new SeoModel();
        //$data['seo'] = $SeoModel->get_seo_details(['id' => 10]);
        return view('site/content/kernel', $data);
        
        
    }

    public function save() {

        $data = $this->input->post(array(
            'tid' => 'tid',
            'merchant_id' => 'merchant_id',
            'order_id' => 'order_id',
            'amount' => 'amount',
            'currency' => 'currency',
            'redirect_url' => 'redirect_url',
            'cancel_url' => 'cancel_url',
            'language' => 'language',
            'delivery_name' => 'delivery_name',
            'delivery_address' => 'delivery_address',
            'delivery_city' => 'delivery_city',
            'delivery_state' => 'delivery_state',
            'delivery_zip' => 'delivery_zip',
            'delivery_country' => 'delivery_country',
            'delivery_tel' => 'delivery_tel'
        ));

        //var_dump($data);
        $merchant_data = MERCHANT_ID;
        $working_key = WORKING_KEY; //Shared by CCAVENUES
        $access_code = ACCESS_CODE; //Shared by CCAVENUES

        foreach ($data as $key => $value) {
            $merchant_data .= $key . '=' . $value . '&';
        }

        //$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
        //$this->load->library('CcavenueCrypto');

        $encrypted_data = $this->someclass->encrypt($merchant_data, $working_key);

        var_dump($encrypted_data);
        ?>
        <form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
            <?php
            echo "<input type=hidden name=encRequest value=$encrypted_data>";
            echo "<input type=hidden name=access_code value=$access_code>";
            ?>
        </form></center><script language='javascript'>document.redirect.submit();</script>


        <?php
        echo "Payment Works";
    }

//    public function redirect()
//    {
//        $payment_model = new PaymentModel();
//
//        $encryption_service = Services::encrypter();
//
//        $merchant_id = $encryption_service->decrypt($this->request->getPost('encResp'));
//        $order_id = $encryption_service->decrypt($this->request->getPost('orderId'));
//        $status_code = $encryption_service->decrypt($this->request->getPost('orderStatus'));
//
//        if ($status_code === 'Success') {
//            $payment_model->updatePaymentStatus($order_id, 'success');
//        } else {
//            $payment_model->updatePaymentStatus($order_id, 'failed');
//        }
//
//        return view('payment_response', ['status' => $status_code]);
//    }
}
