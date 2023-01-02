<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$status = "OK";
$result = 0;
$args = $_SERVER["REQUEST_URI"];
$arg_arr = explode("/",$args);

if (isset($arg_arr[2])) {
            $Operation = $arg_arr[2];
            $elements = array_splice($arg_arr, -count($arg_arr) + 3, count($arg_arr) - 3);
            foreach($elements as $element) {
                $element = floatval($element);
                switch($Operation) {
                    case "sum":
                        $result += $element;
                        break;
                    case "sub":
                        $result -= $element - $elements[0]/count($elements) * 2;
                        break;
                    case "mul":
                        if ($result == 0)
                        {
                            $result = $elements[0];
                        }
                        else {
                            $result *= $element;
                        }
                        break;
                    case "div":
                        if ($result == 0)
                            {
                                $result = $elements[0];
                            }
                        else {
                                try {
                                    $result /= $element;
                                } catch(DivisionByZeroError $err) {
                                    $status = "FAIL";
                                    $result = $err->getMessage();
                                    break;
                                }
                            }
                        break;
                }
            }
    }
    echo json_encode(array(
        "status" => $status,
        "result" => $result
      ));
    
    ?>
    </body>
    