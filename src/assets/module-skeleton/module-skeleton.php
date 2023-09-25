<?php

$ROOT_PATH=getenv('ROOT_PATH');
if($ROOT_PATH==""){
    echo "Path not set. System terminated";
    exit;
}

require_once $ROOT_PATH . "/assets/core/err.php";

class SkeletonData{
    //Common Properties associate with database table 
    public $example_property;
}


class Skeleton extends SkeletonData {
    public $data;
    public $msg;
    public $status;
    public $status_code;
    public $total_data;
    //Standard Filter for listing by page limit. Use for paging
    public $page_start;
    public $page_limit;

    //Standard Properties
    public $user_id;//User id that access this class
    public $branch_id;//Branch id that access this class
    public $app_name; //app name
    public $DB;//Class of DB connector from sql_com

    // Class Initialized
    public function __construct($appinfo,$db, $payload){
        $this->user_id = $appinfo['userID'];//Get userid that access 
        $this->app_name = $appinfo['app_name'];//Get app name  that access
        $this->branch_id= $appinfo['sid'];//Get branch id that access=$appinfo['from'];//Get userid that access
        $this->DB=$db;//Set the Db class for db connection

        // mapping payload to properties
        $this->example_property = $payload['example_property'] ?? null;
        

    }
    
    /**
     * API response Body builder function
     * @param integer $status_code
     * @param string $status
     * @param string $msg
     * @param array $data
     */
    function resBody($status_code, $status, $msg, $data){
            $this->status_code = $status_code;
            $this->status = $status;
            $this->msg = $msg;
            $this->data = $data;
    }


    /**
     * method name: skeleton_method 
     * Table: <table name>
     * @return boolean
     */
    function skeleton_method() {
        try {
            //logic goes here

            $this->resBody('<status code>','<status>','<msg>','<data>');
            return true;
        } catch (Throwable $e) {
            //if any error occurs, it will be handled here
            ErrorHandler::handleException($e, $this->app_name, $this->user_id);
            $this->resBody(400,'error','Internal Server Error',null);
            return false;
        }  
    }

}