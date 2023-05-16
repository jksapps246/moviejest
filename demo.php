<!DOCTYPE HTML>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>

    <form method="get">
        <input type="text" name="num1" placeholder="Number 1">
        <select name="oper">
            <label>Choose Operation</label>
            <option value="add">Add</option>
            <option value="sub">Subtract</option>
        </select>
        <input type="text" name="num2" placeholder="Number 2">
        <button type="submit" name="submit">Calculate</button>
        <?php
            if(isset($_GET["submit"])){
                $num1 = $_GET["num1"];
                $oper = $_GET["oper"];
                $num2 = $_GET["num2"];
                switch ($oper) {
                    case "add":
                        $sum = $num1 + $num2;
                        echo "Value: " . $sum;
                        break;
                    case "sub":
                        $sum = $num1 - $num2;
                        echo "Value: " . $sum;
                        break;
                    default:
                        $sum = "Error";
                        echo "Value: " . $sum;
                        break;
                   } 
            }
        ?>
    </form>
    </body>
</html>