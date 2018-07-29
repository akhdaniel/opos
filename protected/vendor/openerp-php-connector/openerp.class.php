<?php
/* OpenERP PHP connection script. Under GPL V3 , All Rights Are Reserverd , tejas.tank.mca@gmail.com
 *
 * @Author : Tejas L Tank.
 * @Email : tejas.tank.mca@gmail.com
 * @Country : India
 * @Date : 14 Feb 2011
 * @License : GPL V3
 * @Contact : www.facebook.com/tejaskumar.tank or www.linkedin.com/profile/view?id=48881854
 *
 *
 * OpenERP XML-RPC connections methods are db, common, object , report , wizard
 *
 *
 *
 *
 */
session_start();

include("xmlrpc/xmlrpc.inc");

class OpenERP {

    public $server = "http://192.168.2.37:8069/xmlrpc/";
    public $database = "test";
    public $uid = "";/**  @uid = once user succesful login then this will asign the user id */
    public $username = ""; /*     * * @userid = general name of user which require to login at openerp server */
    public $passwrod = "";/** @password = password require to login at openerp server * */

    public function login($username = "admin", $password="a", $database="test", $server="http://192.168.2.37:8069/xmlrpc/") {
        $this->server = $server;
        $this->database = $database;
        $this->username = $username;
        $this->passwrod = $password;

        $sock = new xmlrpc_client($this->server . 'common');
        $msg = new xmlrpcmsg('login');
        $msg->addParam(new xmlrpcval($this->database, "string"));
        $msg->addParam(new xmlrpcval($this->username, "string"));
        $msg->addParam(new xmlrpcval($this->passwrod, "string"));

        $resp = $sock->send($msg);


        if($resp->errno > 0 ){
            print "Error : ". $resp->errstr;
            return -1;
        }
        //print_r($resp->value()->me['int']);
        $val = $resp->value();
        //var_dump($val->me);exit;

        if(isset($val->me['boolean']) && $val->me['boolean'] == false ){
            return -1;
        }

        //$id = $val->scalarval();
        $this->uid = $resp->value()->me['int'];
        if ( $resp->value()->me['int'] ) {
            return $resp->value()->me['int']; 
        } else {
            return -1; 
        }
    }

    public function create($values, $model_name) {
        $ret = new stdClass;

        $client = new xmlrpc_client($this->server . "object");

        //   ['execute','userid','password','module.name',{values....}]
        $msg = new xmlrpcmsg('execute');
        $msg->addParam(new xmlrpcval($this->database, "string"));  //* database name */
        $msg->addParam(new xmlrpcval($this->uid, "int")); /* useid */
        $msg->addParam(new xmlrpcval($this->passwrod, "string"));/** password */
        $msg->addParam(new xmlrpcval($model_name, "string"));/** model name where operation will held * */
        $msg->addParam(new xmlrpcval("create", "string"));/** method which u like to execute */
        $msg->addParam(new xmlrpcval($values, "struct"));/** parameters of the methods with values....  */

        $resp = $client->send($msg);

        if ($resp->faultCode()){
            $ret->status = 'error';
            $ret->msg = $resp->raw_data;
            return $ret ;
        }
        else{
            $ret->status = 'success';
            $ret->msg = $resp->value()->scalarval();
            return $ret ;
        }
    }

    public function write($ids, $values, $model_name) {
        $client = new xmlrpc_client($this->server . "object");
        //   ['execute','userid','password','module.name',{values....}]

        $id_val = array();
        $count = 0;
        foreach ($ids as $id)
            $id_val[$count++] = new xmlrpcval($id, "int");

        $msg = new xmlrpcmsg('execute');
        $msg->addParam(new xmlrpcval($this->database, "string"));  //* database name */
        $msg->addParam(new xmlrpcval($this->uid, "int")); /* useid */
        $msg->addParam(new xmlrpcval($this->passwrod, "string"));/** password */
        $msg->addParam(new xmlrpcval($model_name, "string"));/** model name where operation will held * */
        $msg->addParam(new xmlrpcval("write", "string"));/** method which u like to execute */
        $msg->addParam(new xmlrpcval($id_val, "array"));/** ids of record which to be updting..   this array must be xmlrpcval array */
        $msg->addParam(new xmlrpcval($values, "struct"));/** parameters of the methods with values....  */
        $resp = $client->send($msg);

        if ($resp->faultCode())
            return -1;  /* if the record is not writable or not existing the ids or not having permissions  */
        else
            return $resp->value()->scalarval();  /* return new generated id of record */
    }

    public function read($ids, $fields, $model_name) {
        $client = new xmlrpc_client($this->server."object");
        //   ['execute','userid','password','module.name',{values....}]
        $client->return_type = 'phpvals';

        $id_val = array();
        $count = 0;
        foreach ($ids as $id)
            $id_val[$count++] = new xmlrpcval($id, "int");

        $fields_val = array();
        $count = 0;
        foreach ($fields as $field)
            $fields_val[$count++] = new xmlrpcval($field, "string");

        $msg = new xmlrpcmsg('execute');
        $msg->addParam(new xmlrpcval($this->database, "string"));  //* database name */
        $msg->addParam(new xmlrpcval($this->uid, "int")); /* useid */
        $msg->addParam(new xmlrpcval($this->passwrod, "string"));/** password */
        $msg->addParam(new xmlrpcval($model_name, "string"));/** model name where operation will held * */
        $msg->addParam(new xmlrpcval("read", "string"));/** method which u like to execute */
        $msg->addParam(new xmlrpcval($id_val, "array"));/** ids of record which to be updting..   this array must be xmlrpcval array */
        $msg->addParam(new xmlrpcval($fields_val, "array"));/** parameters of the methods with values....  */
        $resp = $client->send($msg);


        if ($resp->faultCode())
            return -1;  
        else
            return ( $resp->value() );
    }

    public function search($attribute, $operator, $keyword, $model_name){

        $client = new xmlrpc_client($this->server."object");
        $client->return_type = 'phpvals';

        $search_arrays=array(
            new xmlrpcval($attribute , "string"),
            new xmlrpcval($operator,"string"),
            new xmlrpcval($keyword,"string")
        );

        $key = array(
            new xmlrpcval(
                $search_arrays,
                "array"
            ),
        );
        $msg = new xmlrpcmsg('execute');
        $msg->addParam(new xmlrpcval($this->database, "string"));
        $msg->addParam(new xmlrpcval($this->uid, "int"));
        $msg->addParam(new xmlrpcval($this->passwrod, "string"));
        $msg->addParam(new xmlrpcval($model_name, "string"));
        $msg->addParam(new xmlrpcval("search", "string"));
        $msg->addParam(new xmlrpcval($key, "array"));
        $resp = $client->send($msg);
        //print "resp:";
        //var_dump($resp);
        if ($resp->faultCode())
            return -1;  /* if the record is not writable or not existing the ids or not having permissions  */
        else{
            if($val = $resp->value()){
                return $val;     
            }
            else
            {
                return -1;
            }
        }
    }

    public function unlink($ids , $model_name) {
        
        $client = new xmlrpc_client($this->server ."object");
      
        $client->return_type = 'phpvals';

        $id_val = array();
        $count = 0;
        foreach ($ids as $id)
            $id_val[$count++] = new xmlrpcval($id, "int");

        $msg = new xmlrpcmsg('execute');
        $msg->addParam(new xmlrpcval($this->database, "string"));  //* database name */
        $msg->addParam(new xmlrpcval($this->uid, "int")); /* useid */
        $msg->addParam(new xmlrpcval($this->passwrod, "string"));/** password */
        $msg->addParam(new xmlrpcval($model_name, "string"));/** model name where operation will held * */
        $msg->addParam(new xmlrpcval("unlink", "string"));/** method which u like to execute */
        $msg->addParam(new xmlrpcval($id_val, "array"));/** ids of record which to be updting..   this array must be xmlrpcval array */
        //        $msg->addParam(new xmlrpcval($fields_val, "array"));/** parameters of the methods with values....  */
        $resp = $client->send($msg);

        if ($resp->faultCode())
            return -1;  /* if the record is not writable or not existing the ids or not having permissions  */
        else
            print_r( $resp->value() );
            //return ( $resp->value() );
    }

    public function execWf($wfname, $model, $id){
        $client = new xmlrpc_client($this->server ."object");
        //$client->return_type = 'phpvals';
        $msgpost = new xmlrpcmsg('exec_workflow');
        $msgpost->addParam(new xmlrpcval($this->database, "string")); #dbname
        $msgpost->addParam(new xmlrpcval($this->uid, "int")); #uid
        $msgpost->addParam(new xmlrpcval($this->passwrod, "string")); #password
        $msgpost->addParam(new xmlrpcval($model, "string")); #object
        $msgpost->addParam(new xmlrpcval($wfname, "string")); #workflow message
        $msgpost->addParam(new xmlrpcval($id, "int")); #vaoucher_id
            
        $resp = $client->send( $msgpost );    

        if ($resp->faultCode()){            
            return -1; 
        }
        else
            return ( $resp->value() );  
    }
    public function exec($fname, $model, $ids){
  
        $ret = new stdClass;
        $id_val = array();
        $count = 0;
        foreach ($ids as $id)
            $id_val[$count++] = new xmlrpcval($id, "int");

        $client = new xmlrpc_client($this->server ."object");
        //$client->return_type = 'phpvals';
        $msgpost = new xmlrpcmsg('execute');
        $msgpost->addParam(new xmlrpcval($this->database, "string")); #dbname
        $msgpost->addParam(new xmlrpcval($this->uid, "int")); #uid
        $msgpost->addParam(new xmlrpcval($this->passwrod, "string")); #password
        $msgpost->addParam(new xmlrpcval($model, "string")); #object
        $msgpost->addParam(new xmlrpcval($fname, "string"));/** method which u like to execute */
        $msgpost->addParam(new xmlrpcval($id_val, "array")); #vaoucher_id
            
        $resp = $client->send( $msgpost );    
        if ($resp->faultCode()){
            $ret->status = 'error';
            $ret->msg = $resp->raw_data;
            return $ret ;
        }
        else{
            $ret->status = 'success';
            $ret->msg = $resp->value()->scalarval();
            return $ret ;
        }
    }    
}

?>