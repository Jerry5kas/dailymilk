<?php
namespace App\Services;

class UserService {
    public static function getUserById($mysqli, $uid) {
        $uid = (int)$uid;
        $res = $mysqli->query("select * from tbl_user where id=".$uid." limit 1");
        if (!$res || $res->num_rows === 0) {
            return null;
        }
        return $res->fetch_assoc();
    }

    public static function getWalletData($mysqli, $uid) {
        $user = self::getUserById($mysqli, $uid);
        if (!$user) {
            return null;
        }
        $curr = $mysqli->query("select signupcredit,refercredit from setting limit 1")->fetch_assoc();
        return [
            'wallet' => $user['wallet'],
            'code' => $user['code'],
            'signupcredit' => isset($curr['signupcredit']) ? $curr['signupcredit'] : 0,
            'refercredit' => isset($curr['refercredit']) ? $curr['refercredit'] : 0
        ];
    }

    public static function addWalletAmount($mysqli, $uid, $amount) {
        $uid = (int)$uid;
        $amount = (float)$amount;
        $res = $mysqli->query("select * from tbl_user where id=".$uid." limit 1");
        if (!$res || $res->num_rows === 0) {
            return null;
        }
        $user = $res->fetch_assoc();
        $newWallet = $user['wallet'] + $amount;
        $table = "tbl_user";
        $field = array('wallet'=>$newWallet);
        $where = "where id=".$uid."";
        $h = new \Milkman();
        $h->Ins_milk_updata_Api($field,$table,$where);

        $table="wallet_report";
        $field_values=array("uid","message","status","amt");
        $data_values=array((string)$uid,'Wallet Balance Added!!','Credit',(string)$amount);
        $h = new \Milkman();
        $h->Ins_milk_latest_Api($field_values,$data_values,$table);

        $res = $mysqli->query("select * from tbl_user where id=".$uid." limit 1");
        if (!$res || $res->num_rows === 0) {
            return null;
        }
        $user = $res->fetch_assoc();
        return $user['wallet'];
    }
}
