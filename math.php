<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Calculator</title>
</head>
<body>
    <h2>Math Calculator</h2>
    <form action="" method="POST">
        <input type="text" name="input1" placeholder="Enter first number" required>
        <select name="operator1" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <input type="text" name="input2" placeholder="Enter second number" required>
        <select name="operator2" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <input type="text" name="input3" placeholder="Enter third number" required>
        <button type="submit">Calculate</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the input values and operators
        $input1 = $_POST['input1'];
        $operator1 = $_POST['operator1'];
        $input2 = $_POST['input2'];
        $operator2 = $_POST['operator2'];
        $input3 = $_POST['input3'];

        // Validate that the inputs are numeric
        if (!is_numeric($input1) || !is_numeric($input2) || !is_numeric($input3)) {
            echo "ERROR: All inputs must be valid numbers.";
            exit;
        }

        // Perform the calculation with precedence for * and /
        $result = 0;
        switch ($operator1) {
            case '*':
            case '/':
                // Calculate the first operation with precedence
                if ($operator1 == '*') {
                    $temp = $input1 * $input2;
                } else {
                    if ($input2 == 0) {
                        echo "ERROR: Division by zero is not allowed.";
                        exit;
                    }
                    $temp = $input1 / $input2;
                }
                // Now apply the second operation
                if ($operator2 == '+') {
                    $result = $temp + $input3;
                } elseif ($operator2 == '-') {
                    $result = $temp - $input3;
                } elseif ($operator2 == '*') {
                    $result = $temp * $input3;
                } elseif ($operator2 == '/') {
                    if ($input3 == 0) {
                        echo "ERROR: Division by zero is not allowed.";
                        exit;
                    }
                    $result = $temp / $input3;
                }
                break;

            case '+':
            case '-':
                // Calculate the second operation first if it's * or /
                if ($operator2 == '*') {
                    $temp = $input2 * $input3;
                } elseif ($operator2 == '/') {
                    if ($input3 == 0) {
                        echo "ERROR: Division by zero is not allowed.";
                        exit;
                    }
                    $temp = $input2 / $input3;
                } else {
                    $temp = $input2;
                }
                // Now apply the first operation
                if ($operator1 == '+') {
                    $result = $input1 + $temp;
                } elseif ($operator1 == '-') {
                    $result = $input1 - $temp;
                }
                break;
        }

        // Display the result
        echo "<h3>Result: $result</h3>";
    }
    ?>
</body>
</html>