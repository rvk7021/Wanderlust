<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="signin.css">
</head>

<body>

    <?php

    $emailErr = $pass1Err = "";
    $email = $pass1 = "";
    $fname = $lname = $email1 = $pass2 =  "";
    $phn = NULL;


    $sw1 = $sw2 =  0;

    $sw = 0;
    // define variables and set to empty values

    function count_digit($number)
    {
        return strlen((string) $number);
    }

    function test_input($data)
    {

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;
    }
    if(isset($_POST["done"])){

    if (empty($_POST["email"])) {

        $emailErr = " * Email is required";
    }
    if (!empty($_POST["email"])) {

        $email = test_input($_POST["email"]);

        // check if e-mail address is well-formed

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $emailErr = " * Invalid email format";
        } else {
            $sw1 = 1;
        }
    }
  

    if (empty($_POST["pass"])) {

        $pass1Err = "* password is required";
    }
    if (!empty($_POST["pass"])) {

        $pass1 = test_input($_POST["pass"]);
        if (strlen($pass1) < 9) {
            $pass1Err = "** password must of 9 or more length";
        }
        if (!preg_match("/^[a-zA-Z0-9' ]*$/", $pass1)) {

            $pass1Err = "***password only include  capital letter, samll letter, numbers ";
        } else {
            $sw2 = 1;
        }
    }
}

    ?>

    <div class="form">
        <form action="signin.php" method="post" autocomplete="off" >
            
            <h2>Sign In</h2>

            <section>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email">
                <span><?php echo  $emailErr; ?></span>
            </section>

            <section>
                <label for="pass">Password :</label>
                <input type="text" name="pass" id="pass">
                <span><?php echo  $pass1Err; ?></span>
            </section>

            <?php

            if ($sw1 && $sw2) {
                $database1 = "ap_project";
                $server_name = "localhost";
                $user_name = "root";
                $password2 = "A1a0B2b7C1c9";
                $connectiond = mysqli_connect($server_name, $user_name, $password2, $database1);
                if (!$connectiond) {
                    die("Failed" . mysqli_connect_error());
                }
                // echo "Connection established successfully.";
                $querye = "select * from data where password='$pass1'and email='$email'";
                $final1 = mysqli_query($connectiond, $querye);
                if (mysqli_num_rows($final1) == 1) {
                    $per = mysqli_fetch_assoc($final1);
                    $fname = $per["first_name"];
                    $lname = $per["last_name"];
                    $email1 = $per["email"];
                    $pass2 = $pass1;
                    $phn = $per["phone_no"];


                    $sw++;
                    $ac=(string)$fname[0].(string)$lname[0];
                }
                mysqli_close($connectiond);
            }
            ?>


            <input type="submit" value="Submit" name="done">
            <input type="reset" value="Reset">
            
        </form>
    </div>
    <?php
    if ($sw == 1) {
        echo '<p class="account"> 
           <!-- Succssefully Signed In 👍--><span>',$ac,'</span>
        </p>';
    } else if ($sw == 0) {
        echo "No such User exist";
    }
    ?>

</body>

</html>