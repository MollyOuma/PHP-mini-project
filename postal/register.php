<!DOCTYPE html>
<html lang="en">
    <head>
        <meta>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Website and system designer. Kashing74 KE">
        <title>Register Page</title>

        <!-- Bootstrap CSS File -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />

        <script src="verify.js"></script>
    </head>
    <body>
        <div class="container" style="margin-top:30px">
            <!-- Header Section -->
            <header class="jumbotron text-center row" style="margin-bottom:2px; background:linear-gradient(white, #0073e6); padding:2Opx;">
				<div class="col-sm-2">
                    <img class="img-fluid float-left" src="bootstrap/image/logo.png" alt="logo">
				</div>
				<div class="col-sm-8">
					<h1 class="font-bold">Welcome to the world of designers</h1>
				</div>
				<div class="col-sm-2">
					<nav class="btn-group-vertical btn-group-sm" role="group" aria-label="button-group">
			    		<button type="button" class="btn btn-secondary" onclick="location.href='register.php'">Erase Entries</button>
						<button type="button" class="btn btn-secondary" onclick="location.href='index.php'">Cancel</button>
					</nav>
				</div>
			</header>
            <!-- Body Section -->
            <div class="row" style="padding-left: 0px;">
                <!-- Left-side Column Menu Section -->
                <nav class="col-sm-2">
                    <ul class="nav nav-pills flex-column">
                        <?php include('nav.php'); ?>
                    </ul>
                </nav>
                <!-- Validate Input -->
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        require('process-register.php');
                    } // End of the main Submit conditional.
                ?>
                <div class="col-sm-8">
                    <h2 class="h2 text-center">Register</h2>
                    <h3 class="text-center">Items marked with an asterisk * are required</h3>
                    <?php
                    try {
                        require_once ("connection.php");$query = "SELECT * FROM prices"; //#1
                        $result = mysqli_query ($conn, $query); 
                        // Run the query.
                        if ($result) { // If it ran OK, display the records.
                            $row = mysqli_fetch_array($result, MYSQLI_NUM);
                            $yearsarray = array(
                                "Standard one year:", "Standard five year:",
                                "Military one year:", "Under 21 one year:",
                                "Other - Give what you can. Maybe:" );
                            echo '<h6 class="text-center text-danger">Membership classes:</h6>' ;
                            echo '<h6 class="text-center text-danger small"> ';
                            for ($j = 0, $i = 0; $j < 5; $j++, $i = $i + 2) {
                                echo $yearsarray[$j] . " &pound; " . htmlspecialchars($row[$i], ENT_QUOTES) . " GB, &dollar; " . htmlspecialchars($row[$i + 1], ENT_QUOTES) . " US";
                                if ($j != 4) {
                                    if ($j % 2 == 0) {
                                    echo "</h6><h6 class='text-center text-danger small'>"; }
                                else {
                                    echo " , "; }
                                }
                            }
                            echo "</h6>";
                            }
                            ?>
                            <form action="register.php" method="post" onsubmit="return checked();" name="regform" id="regform">
                                <div class="form-group row">
                                    <label for="Firstname" class="col-sm-4 col-form-label">*First Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="Firstname" name="Firstname" placeholder="First Name" maxlength="30" required value="<?php if (isset($_POS['Firstname'])) echo htmlspecialchars($_POST['Firstname'], ENT_QUOTES); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Lastname" class="col-sm-4 col-form-label">*Last Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="Lastname" name="Lastname" placeholder="Last Name" maxlength="30" required value="<?php if (isset($_POST['Lastname'])) echo htmlspecialchars($_POST['Lastname'], ENT_QUOTES); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label">*E-mail:</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="Email" name="Email" placeholder="E-mail" maxlength="60" required value="<?php if (isset($_POST['Email'])) echo htmlspecialchars($_POST['Email'], ENT_QUOTES); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password1" class="col-sm-4 col-form-label">*Password:</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Password" minlength="8" maxlength="12" required value="<?php if (isset($_POST['password1'])) echo htmlspecialchars($_POST['password1'], ENT_QUOTES); ?>" >
                                        <span id='message'>Between 8 and 12 characters.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password2" class="col-sm-4 col-form-label">
                                    *Confirm Password:</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password" minlength="8" maxlength="12" required value="<?php if (isset($_POST['password2'])) echo htmlspecialchars($_POST['password2'], ENT_QUOTES); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="level" class="col-sm-4 col-form-label">*Membership Class</label>
                                    <div class="col-sm-8"> <!--#2-->
                                        <select id="level" name="level" class="form-control" required>
                                            <option value="0" >-Select-</option>
                                                <?php
                                                for ($j = 0, $i = 0; $j < 5; $j++, $i = $i + 2) {
                                                    echo '<option value="' . htmlspecialchars($row[$i], ENT_QUOTES) . '" ';
                                                    if ((isset($_POST['level'])) && ( $_POST['level'] == $row[$i])) {
                                                        ?>
                                                        selected
                                                        <?php 
                                                    }
                                                    echo ">" . $yearsarray[$j] . " " . htmlspecialchars($row[$i], ENT_QUOTES) . " &pound; GB, " . htmlspecialchars($row[$i + 1], ENT_QUOTES) . "&dollar; US</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row"> <!--#3-->
                                    <label for="address1" class="col-sm-4 col-form-label">*Address:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="address1" name="address1" placeholder="Address" maxlength="30" required value="<?php if (isset($_POST['address1']))
                                        echo htmlspecialchars($_POST['address1'], ENT_QUOTES); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address2" class="col-sm-4 col-form-label">Address:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="address2" name="address2" placeholder="Address" maxlength="30" value="<?php if (isset($_POST['address2']))
                                        echo htmlspecialchars($_POST['address2'], ENT_QUOTES); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="city" class="col-sm-4 col-form-label">*City:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="City" maxlength="30" required value="<?php if (isset($_POST['city'])) echo htmlspecialchars($_POST['city'], ENT_QUOTES); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="state_country" class="col-sm-4 col-form-label">*State/Country:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="state_country" name="state_country" placeholder="State or Country" maxlength="30" required value="<?php if (isset($_POST['state_country'])) echo htmlspecialchars($_POST['state_country'], ENT_QUOTES); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Zip_code" class="col-sm-4 col-form-label">*Zip Code:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="Zip_code" name="Zip_code" placeholder="Zip Code or Postal Code" maxlength="15" required value="<?php if (isset($_POST['Zip_code'])) echo htmlspecialchars($_POST['Zip_code'], ENT_QUOTES); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Phone" class="col-sm-4 col-form-label">Phone Number:</label>
                                    <div class="col-sm-8">
                                        <input type="tel" class="form-control" id="Phone" name="Phone" placeholder="Phone Number" maxlength="30" value="<?php if (isset($_POST['Phone'])) echo htmlspecialchars($_POST['Phone'], ENT_QUOTES); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label"></label>
                                    <div class="col-sm-8">
                                        <input id="submit" class="btn btn-primary" type="submit" name="submit" value="Register">
                                    </div>
                                </div>
                            </form>

                            </div>
                            <!-- Right-side Column Content Section -->
                            <?php
                            if(!isset($errorstring)) {
                                echo '<aside class="col-sm-2">';
                                include('col-cards.php');
                                echo '</aside>';
                                echo '</div>';
                                echo '<footer class="jumbotron text-center row col-sm-14"
                                style="padding-bottom:1px; padding-top:8px;">';
                            }
                        else {
                                echo '<footer class="jumbotron text-center col-sm-12"
                                style="padding-bottom:1px; padding-top:8px;">';
                        }
                        include('footer.php');
                        echo "</footer>";
                        echo "</div>";
                    }
                    catch(Exception $e) {// We finally handle any problems here
                        // print "An Exception occurred. Message: " . $e->getMessage();
                        print "The system is busy please try later";
                    }
                    catch(Error $e) {
                        //print "An Error occurred. Message: " . $e->getMessage();
                        print "The system is busy please try again later.";
                    }
                ?>
            </div>
        </div>
    </body>
</html>