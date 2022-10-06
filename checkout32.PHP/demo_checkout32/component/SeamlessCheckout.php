<?php

class SeamlessCheckout
{
    private static function _call($params) {
        $paramsStr = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, NL_ENDPOINT);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $paramsStr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $result = curl_exec($ch);
        if (!empty($result)) {
            $str_result = str_replace('&', '&amp;', (string) $result);
            $xml = simplexml_load_string($str_result);
            $json_result = json_encode($xml);
            $result = json_decode($json_result, true);
        }
        return $result;
    }

    public static function setExpressCheckout($params)
    {
        $inputs = array(
            'merchant_id' => MERCHANT_ID,
            'merchant_password' => md5(MERCHANT_PASSWORD),
            'version' => VERSION,
            'function' => 'SetExpressCheckout',
            'receiver_email' => RECEIVER_EMAIL,
            'order_code' => $params['order_code'],
            'total_amount' => $params['total_amount'],
            'payment_method' => $params['payment_method'],
            'payment_type' => $params['payment_type'],
            'order_description' => $params['order_description'],
            'tax_amount' => $params['tax_amount'],
            'discount_amount' => $params['discount_amount'],
            'fee_shipping' => $params['fee_shipping'],
            'bank_code' => $params['bank_code'],
            'return_url' => $params['return_url'],
            'cancel_url' => $params['cancel_url'],
            'notify_url' => $params['notify_url'],
            'time_limit' => $params['time_limit'],
            'buyer_fullname' => $params['buyer_fullname'],
            'buyer_email' => $params['buyer_email'],
            'buyer_mobile' => $params['buyer_mobile'],
            'buyer_address' => $params['buyer_address'],
            'cur_code' => $params['cur_code'],
            'lang_code' => $params['lang_code'],
            'affiliate_code' => $params['affiliate_code'],
            'card_number' => $params['card_number'],
            'card_fullname' => $params['card_fullname'],
            'card_month' => $params['card_month'],
            'card_year' => $params['card_year'],
        );
        $result = static::_call($inputs);
        return $result;
    }

    public static function authenTransaction($params)
    {
        $inputs = array(
            'merchant_id' => MERCHANT_ID,
            'merchant_password' => md5(MERCHANT_PASSWORD),
            'version' => VERSION,
            'function' => 'AuthenTransaction',
            'token' => $params['token'],
            'otp' => $params['otp'],
            'auth_url' => $params['auth_url']
        );
        $result = static::_call($inputs);
        return $result;
    }

    public static function getTransactionDetail($params)
    {
        $inputs = array(
            'merchant_id' => MERCHANT_ID,
            'merchant_password' => md5(MERCHANT_PASSWORD),
            'version' => VERSION,
            'function' => 'GetTransactionDetail',
            'token' => $params['token'],
        );
        $result = static::_call($inputs);
        return $result;
    }

    public static function getRequestField($params)
    {
        $inputs = array(
            'merchant_id' => MERCHANT_ID,
            'merchant_password' => md5(MERCHANT_PASSWORD),
            'version' => VERSION,
            'function' => 'GetRequestField',
            'receiver_email' => RECEIVER_EMAIL,
            'payment_method' => $params['payment_method'],
            'bank_code' => $params['bank_code']
        );
        $result = static::_call($inputs);
        return $result;
    }

    public static function getBanksByPaymentMethod($payment_method)
    {
        switch ($payment_method) {
            case 'ATM_ONLINE':
                $banks = array('AGB', 'BAB', 'BIDV', 'EXB', 'MSB', 'STB', 'SGB', 'NVB', 'PGB', 'GPB', 'ICB', 'TCB',
                    'TPB', 'VAB', 'VIB', 'VCB', 'MB', 'ACB', 'HDB', 'VPB', 'OJB', 'SHB', 'SEA', 'OCB', 'ABB', 'NAB');
                break;
            case 'IB_ONLINE':
                $banks = array('BIDV', 'EXB', 'STB', 'ICB', 'TCB', 'VCB', 'DAB', 'ACB');
                break;
            case 'QRCODE':
                $banks = array('AGB', 'MSB', 'NVB', 'ICB', 'VCB', 'VCBPAY', 'MB', 'VPB', 'SHB', 'OCB', 'ABB', 'SCB',
                    'IVB', 'WCP');
                break;
            case 'CASH_IN_SHOP':
                $banks = array('VIETTELPOST');
                break;
        }
        $bank_info = array();
        foreach ($banks as $bank) {
            $bank_info[$bank] = self::getBankName($bank);
        }
        return $bank_info;
    }

    public static function getBankName($bank_code)
    {
        $list_bank_name = array(
            'AGB' => 'Ngân hàng Nông nghiệp và Phát triển Nông thôn',
            'BAB' => 'Ngân hàng TMCP Bắc Á',
            'BIDV' => 'Ngân hàng Đầu tư và Phát triển Việt Nam',
            'EXB' => 'Ngân hàng TMCP Xuất Nhập Khẩu',
            'MSB' => 'Ngân hàng TMCP Hàng Hải',
            'STB' => 'Ngân hàng TMCP Sài Gòn Thương Tín',
            'SGB' => 'Ngân hàng TMCP  Sài Gòn Công thương',
            'NVB' => 'Ngân hàng TMCP Nam Việt',
            'PGB' => 'Ngân hàng TMCP Xăng Dầu Petrolimex',
            'GPB' => 'Ngân hàng TMCP Dầu Khí',
            'ICB' => 'Ngân hàng TMCP Công Thương',
            'TCB' => 'Ngân hàng TMCP Kỹ Thương',
            'TPB' => 'Ngân hàng TMCP Tiên Phong',
            'VAB' => 'Ngân hàng TMCP Việt Á',
            'VIB' => 'Ngân hàng TMCP Quốc tế',
            'VCB' => 'Ngân hàng TMCP Ngoại Thương Việt Nam',
            'VCBPAY' => 'VCBPAY',
            'DAB' => 'Ngân hàng TMCP Đông Á',
            'MB' => 'Ngân hàng TMCP Quân Đội',
            'ACB' => 'Ngân hàng TMCP Á Châu',
            'HDB' => 'Ngân hàng TMCP Phát Triển Nhà TP.Hồ Chí Minh',
            'VPB' => 'Ngân hàng TMCP Việt Nam Thịnh Vượng',
            'OJB' => 'Ngân hàng TMCP Đại Dương',
            'SHB' => 'Ngân hàng TMCP Sài Gòn - Hà Nội',
            'SEA' => 'Ngân hàng TMCP Đông Nam Á',
            'OCB' => 'Ngân hàng Phương Đông Việt Nam',
            'ABB' => 'Ngân hàng TMCP An Bình',
            'NAB' => 'Ngân hàng Nam Á',
            'SCB' => 'Ngân hàng TMCP Sài Gòn',
            'IVB' => 'Ngân hàng TNHH Indovina',
            'WCP' => 'WeChat Pay',
            'VIETTELPOST' => 'Viettelpost',
        );
        $bank_name = (array_key_exists($bank_code, $list_bank_name)) ? $list_bank_name[$bank_code] : 'N/A';
        return $bank_name;
    }
}