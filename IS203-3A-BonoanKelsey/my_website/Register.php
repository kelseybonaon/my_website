<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="form-container"> 
        <form action="register.php" method="POST">
            <h2>Register</h2>

            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" required>

            <label for="middlename">Middle Name:</label>
            <input type="text" name="middlename">

            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" required>

            <label for="dob">Date of Birth:</label>
            <div>
                <select name="dob_month" required>
                    <option value="">Month</option>
                    <?php
                    $months = array(
                        '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                        '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                        '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                    );
                    foreach ($months as $num => $name) {
                        echo "<option value=\"$num\">$name</option>";
                    }
                    ?>
                </select>

                <select name="dob_day" required>
                    <option value="">Day</option>
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        $day = str_pad($i, 2, '0', STR_PAD_LEFT);
                        echo "<option value=\"$day\">$day</option>";
                    }
                    ?>
                </select>

                <select name="dob_year" required>
                    <option value="">Year</option>
                    <?php
                    for ($i = date('Y'); $i >= 1900; $i--) {
                        echo "<option value=\"$i\">$i</option>";
                    }
                    ?>
                </select>
            </div>

            <label for="email">Email:</label>
            <input type="text" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit" name="register">Register</button>
        </form>
        
        <p>Already have an account? <a href="index.php">Login here</a>.</p>
    </div> 
</body>
</html>
