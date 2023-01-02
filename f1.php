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
if (isset($_GET["num"]) && isset($_GET["operation"])) {
    $Operation = $_GET["operation"];
    $elements = explode(",", $_GET["num"]);
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
