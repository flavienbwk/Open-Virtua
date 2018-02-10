<?php

$Page = new Page();
$bddModel = new bddModel($Page);

$apiModel = new apiModel($Page, $bddModel->database);
$apiGetModel = new apiGetModel($Page, $bddModel->database);
$apiPostModel = new apiPostModel($Page, $bddModel->database);
$headers = getallheaders();


$api_key_name = "X-Ov-Api-Key";
$response = ["error" => true, "message" => "Missing or wrong '$api_key_name' API key.", "results" => []];

$header = getallheaders();
if (isset($header[$api_key_name]) || isset($header[strtolower($api_key_name)])) {
    $api_key_name = (isset($header[$api_key_name])) ? $api_key_name : strtolower($api_key_name);
    if (($header[$api_key_name] == $apiModel->getMasterApiKey() || $header[$api_key_name] == $apiModel->getMasterApiKey())) {
        if ($apiModel->isIpAuthorized($Page->getIp())) {
            if (!$Page->getConfigVar("https_required") || ($Page->getConfigVar("https_required") && $Page->isConnectionSecure())) {
                $method = $_SERVER['REQUEST_METHOD'];

                if ($method) {
                    if ($method == "GET") {
                        $parameters = (isset($_GET["parameters"])) ? $_GET["parameters"] : null;
                        if ($apiGetModel->checkRequest($parameters)) {
                            $result = $apiGetModel->execute();
                            if (sizeof($result) >= 3) {
                                if ($result["error"]) {
                                    $response["error"] = false;
                                    $response["results"] = $result["results"];
                                }
                                $response["message"] = $result["message"];
                            } else {
                                $response["message"] = "Error from the function executed. Please contact us.";
                            }
                        } else {
                            $response["message"] = "Bad GET request. Invalid parameters.";
                        }
                    } else if ($method == "POST") {
                        if ($apiPostModel->checkRequest($_POST)) {
                            $result = $apiPostModel->execute();
                            if (sizeof($result) >= 3) {
                                $response = $result;
                            } else {
                                $response["message"] = "Error from the function executed. Please contact us.";
                            }
                        } else {
                            $response["message"] = "Bad POST request. Invalid parameters.";
                        }
                    } else if ($method == "EMPTY") {
                        if ($apiGetModel->checkRequest()) {
                            $response = $apiGetModel->execute();
                        } else {
                            $response["message"] = "Bad EMPTY request. Internal error.";
                        }
                    } else {
                        $response["message"] = "Bad request. Please provide a valid method.";
                    }
                } else {
                    $response["message"] = "Impossible to detect the method of the request. Please provide a valid method.";
                }
            } else {
                $response["message"] = "Connection refused : HTTPS required (you can change that under /Web/config.json).";
            }
        } else {
            $response["message"] = "Your IP address isn't authorized, please go under /Web/config.json to add it.";
        }
    } else {
        $response["message"] = "Invalid API key.";
    }
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: x-ov-api-key");
echo json_encode($response);

