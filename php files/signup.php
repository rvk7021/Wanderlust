<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login In</title>
    <link rel="stylesheet" href="signup.css">
</head>

<body>

    <?php

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

    $fnameErr = $lnameErr = $GenErr = $emailErr = $phnErr = $pass1Err = $pass2Err = "";
    $fname = $email = $pass1 = $pass2 =  "";
    $phn = NULL;

    $sw1 = $sw2 = $sw3 = $sw4 = $sw5 = $sw6 = $sw7 = 0;

    if (isset($_POST["done"])) {
        if (empty($_POST["fname"])) {

            $fnameErr = " *First Name is required";
        }
        if (!empty($_POST["fname"])) {

            $fname = test_input($_POST["fname"]);
            // $sw1=1;
        }
        // check if name only contains letters and whitespace

        if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {

            $fnameErr = " * Only letters and white space allowed";
        } else {
            $sw1 = 1;
        }
        if (empty($_POST["lname"])) {

            $lname = " ";
            $sw2 = 1;
        }
        if (!empty($_POST["lname"])) {

            $lname = test_input($_POST["lname"]);

            // check if name only contains letters and whitespace

            if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {

                $lnameErr = " * Only letters and white space allowed";
            } else {
                $sw2 = 1;
            }
        }
        if (empty($_POST["email"])) {

            $emailErr = " * Email is required";
        }
        if (!empty($_POST["email"])) {

            $email = test_input($_POST["email"]);

            // check if e-mail address is well-formed

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $emailErr = " * Invalid email format";
            } else {
                $sw3 = 1;
            }
        }

        if (empty($_POST["gen"])) {

            $GenErr = " * Gender is required";
        }
        if (!empty($_POST["gen"])) {

            $gen = test_input($_POST["gen"]);
            $sw4 = 1;
        }

        if (empty($_POST["phn"])) {

            $phnErr = "* Phone number is required";
        }
        if (!empty($_POST["phn"])) {

            if (count_digit($_POST["phn"]) != 10) {
                $phnErr = "* Abe phone number sirf 10 digit ka hi hota hai";
            } else {
                $phn = test_input($_POST["phn"]);
                $sw5 = 1;
            }
        }
    

        if (empty($_POST["pass"])) {

            $pass1Err = "* password is required";
        }
        if (!empty($_POST["pass"])) {

            $pass1 = test_input($_POST["pass"]);
            if (strlen($pass1) < 9) {
                $pass1Err = "** password must of 9 or more length";
                if (!preg_match("/^[a-zA-Z0-9' ]*$/", $pass1)) {

                    $pass1Err = "***password only include  capital letter, samll letter, numbers ";
                }
            }
            else {
                $database = "ap_project";
                $server_name = "localhost";
                $user_name = "root";
                $password2 = "A1a0B2b7C1c9";
                $connectiond = mysqli_connect($server_name, $user_name, $password2, $database);

                $querye = "select * from data where password='$pass1'";
                $final1 = mysqli_query($connectiond, $querye);
                if (!$connectiond) {
                    die("Failed" . mysqli_connect_error());
                }
                // echo "Connection established successfully.";
                if (mysqli_num_rows($final1)) {
                    $pass1Err = "** already such  password exist make another password";
                } else {
                    $sw6 = 1;
                }
                mysqli_close($connectiond);
            }
        }


        if (empty($_POST["conf"])) {

            $pass2Err = "*confirm  password is required";
        }
        if (!empty($_POST["conf"])) {

            $pass2 = test_input($_POST["conf"]);
            if ($pass1 != $pass2) {
                $pass2Err = "*!* Password does not match ";
            } else {
                $sw7 = 1;
            }
        }
    }

    ?>

    <form action="signup.php" method="post" autocomplete="off">
        <h2>Sign UP</h2>

        <section>
            <label for="fname">First Name :</label>
            <input type="text" name="fname" id="fname">
            <span><?php echo  $fnameErr; ?></span>
        </section>

        <section>
            <label for="lname">Last Name :</label>
            <input type="text" name="lname" id="lname">
            <span><?php echo  $lnameErr; ?></span>
        </section>

        <section class="gender">
            <label for="gen">Gender :</label>
            <input type="radio" name="gen" id="gen" value="M">Male
            <input type="radio" name="gen" id="gen" value="F">Female
            <input type="radio" name="gen" id="gen" value="O">Other
            <span><?php echo  $GenErr; ?></span>
        </section>

        <section>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email">
            <span><?php echo  $emailErr; ?></span>
        </section>

        <section>
            <label for="phn">Phone Number :</label>
            <select name="cocode" id="cocode">
                <option value="+7840">Abkhazia +7840</option>
                <option value="+93">Afghanistan +93</option>
                <option value="+61">Australia +61</option>
                <option value="+43">Austria +43</option>
                <option value="+374">Armenia +374</option>
                <option value="+880">Bangladesh +880</option>
                <option value="+229">Benin +229</option>
                <option value="+55">Brazil +55</option>
                <option value="+1">Canada +1</option>
                <option value="+53">Cuba +53</option>
                <option value="+357">Cyprus +357</option>
                <option value="+20">Egypt +20</option>
                <option value="+679">Fiji +679</option>
                <option value="+33">France +33</option>
                <option value="+49">Germany +49</option>
                <option value="+30">Greece +30</option>
                <option value="+852">Hong Kong +852</option>
                <option value="+91" selected>India +91 </option>
                <option value="+62">Indonesia +62</option>
                <option value="+39">Italy +39</option>
                <option value="+377">Monaco +377</option>
                <option value="+977">Nepal +977</option>
                <option value="+92">Pakistan +92</option>
                <option value="+51">Peru +51</option>
                <option value="+7">Russia +7</option>
            </select>
            <input type="number" name="phn" id="phn">
            <span><?php echo  $phnErr; ?></span>
        </section>

        <section>
            <label for="pass">Password :</label>
            <input type="text" name="pass" id="pass">
            <span><?php echo  $pass1Err; ?></span>
        </section>

        <section>
            <label for="conf">Confirm Password :</label>
            <input type="text" name="conf" id="conf">
            <span><?php echo  $pass2Err; ?></span>
        </section>


        <input type="submit" value="Submit" name="done">
        <input type="reset" value="Reset">

        <!-- <section>
            <p>Your Password is:
                <?php
                // if ($sw1 && $sw2 && $sw3 && $sw4 && $sw5 && $sw6 && $sw7)
                //     echo Succesfully ;
                //  echo "!",$sw1,$sw2,$sw3,$sw4,$sw5;
                ?>
            </p>
        </section> -->





        <?php
        if ($sw1 && $sw2 && $sw3 && $sw4 && $sw5 && $sw6 && $sw7) {
            $database = "ap_project";
            $server_name = "localhost";
            $user_name = "root";
            $password1 = "A1a0B2b7C1c9";
            $connectionr = mysqli_connect($server_name, $user_name, $password1, $database);

            if (!$connectionr) {
                die("Failed" . mysqli_connect_error());
            }
            $sw10 = 0;
            $phno = (string)$_POST["cocode"] . " " . (string)$phn;
            // echo "Connection established successfully.";
            $query10 = "insert into data (password,first_name,last_name,gender,email,phone_no) values('$pass1','$fname','$lname','$gen','$email','$phno')";
            $finalr = mysqli_query($connectionr, $query10);
            $msg = "";
            if (!$finalr) {
                die("ERROR:" . mysqli_error($connectionr));
            } else {
                $sw10 = 1;
            }

            mysqli_close($connectionr);

            if ($sw10 == 1) {
                echo '<p class="finalmsg"> 
            Succssefully Logged In 👍
            </p>';
            }
            // header('http://localhost/form.php');

        }
        ?>
    </form>
</body>

</html>