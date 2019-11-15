<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

include 'connect.php';

    if (!isset( $_POST['Submit'] )) {
        echo "<p>ERROR - form was not submitted</p>";
    }
    else {
        $insertquery = "INSERT INTO ValidTable SET Firstname=?, Lastname=?, Username=?, Age=?, Email=?, Password=?";
    
        $insertstmt = $mysqli->prepare($insertquery);

        $hashedpassword = password_hash($_POST['pass'], PASSWORD_DEFAULT);

        $insertstmt->bind_param('sssiss', $_POST['fname'], $_POST['lname'], $_POST['uname'], $_POST['age'], $_POST['email'], $hashedpassword);

        if (!$insertstmt->execute()) {
            echo "Error: ".$mysqli->error;
        }
        else {
            echo "New user creation was successful<br>";
            echo "<a href=\"display.php\">display</a>";
        }

$mysqli->close();
    }
}
else {
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Add User</title>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-           WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js">
    </script>

    <!-- regex script -->
    <script>
        function validateForm() {
            var myRegexCheck = "/^[A-Za-Z0-9_]{1-20}$/";
            var username = document.forms["myForm"]["uname"].value;
            if (!username.match(myRegexCheck)) {
                alert("Username is invalid");
                return false;
            }
        }
    </script>



    </head>
    <body>
        <h1>Add New User</h1>
        <form action="form.php" id="submitForm" onSubmit="return validateForm()" method="post" >
            Firstname: <input type="text" id="fname" name="fname"/><br>
            Lastname:  <input type="text" id="lname" name="lname"/><br>
            Username:  <input type="text" id="uname" name="uname"/><br>
            Age:       <input type="text" id="age"   name="age"/>  <br>
            Email:     <input type="email" id="email" name="email"/><br> <!-- email regex on lecture 8 -->
            Password:  <input type="text" id="pass"  name="pass"/><br>
    Re-type Password:  <input type="text" id="passC"  name="passC"/><br>
            <input type="submit" id="Submit" name="Submit" value="Submit" action="display.php"/>
        </form>

    <!-- validation script -->
    <script>
    $("#submitForm").validate({
    rules: {
    fname: "required",
    lname: "required",
    uname: "required",
    age: "required",
    email: {
        required: true,
        email: true
},
    pass: {
        required: true,
        minlength: 5,
},
    passC: {
        required: true,
        minlength: 5,
        equalTo: "#pass"
}
},

// Validation messages
messages: {
    fname: "Please enter your firstname",
    lname: "Please enter your lastname",
    age: "Please enter your age",
    email: "Please enter a valid email address",
    pass: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long",
    }
    /*passC: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long",
        equalTo: "Your passwords must match"
    },*/ // error here somewhere
}

});
    </script>

</body>
</html>
<?php
}
?>
