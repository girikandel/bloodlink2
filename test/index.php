<html>

<head>
    <title>Test</title>
</head>

<body>
    <form name="myForm" action="/bloodlink/test/action_page.php" onsubmit="return validateForm()" method="post">
        Name: <input type="text" name="fname">
        <input type="submit" value="Submit">
    </form>

    <script>
        function validateForm() {
            let x = document.forms["myForm"]["fname"].value;
            if (x == "") {
                alert("Name must be filled out");
                return false;
            }
        } 
    </script>
</body>

</html>