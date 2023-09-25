<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $ROOT_PATH = getenv('ROOT_PATH');

    $request_body = file_get_contents('php://input');
    $payload = json_decode($request_body,true);

    require_once $ROOT_PATH . '/assets/core/api_response.php';
    require_once $ROOT_PATH . '/assets/core/handle_token.php';
    require_once $ROOT_PATH . '/assets/core/sql_pdo.php';
    require_once $ROOT_PATH . '/assets/module-skeleton/module-skeleton.php';
    

    function get_app_info() {
        $appInfoArr = [];
        foreach (getallheaders() as $name => $value) {
            $headerKey = strtolower(str_replace('-', '_', $name));
            if($headerKey=="x_encrypted_key") $token=$value;
            if($headerKey=="x_user_id") $appInfoArr['userID'] = $value;
        }
        
        // JWT Token class initialization
        $jwt = new JWToken();
        // Decode the token
        $appInfo = $jwt->decodeToken($token);
        // Extract the data
        foreach ($appInfo as $key => $value) {
            $appInfoArr[$key] = $value;
        }
        return $appInfoArr;
    }

    $appInfo = get_app_info();

    //DB connection initialization
    $DB = new PDODB($appInfo);


    //Business logic class initialization
    $Skeleton = new Skeleton($appInfo,$DB, $payload);

    $action_execution_function = function() use ($Skeleton){
        $Skeleton->skeleton_method();

        $response = new ApiResponse($Skeleton->status_code, $Skeleton->status, $Skeleton->msg, $Skeleton->data);
        echo $response->toJson();
    };

    // Action not found exception handler function
    $action_not_found = function(){
        $response = new ApiResponse(404, "error", "Action not found", null);
        echo $response->toJson();
    };


    // Function execution based action
    switch ($payload ? $payload['action'] : "") {
        case '<action_name>':
                $action_execution_function();
            break;
        default:
                $action_not_found();
            break;
    }