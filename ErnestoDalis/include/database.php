<?php

include("constants.php");

class MySQLDB {

    var $connection;         //The MySQL database connection

    /* Note: call getNumMembers() to access $num_members! */

    /* Class constructor */

    function MySQLDB() {
        /* Make connection to database */
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME)
                or die(mysql_error() . '<br><h1>Faile include/constants.php suveskite savo MySQLDB duomenis.</h1>');
    }

    /**
     * confirmUserPass - Checks whether or not the given
     * username is in the database, if so it checks if the
     * given password is the same password in the database
     * for that user. If the user doesn't exist or if the
     * passwords don't match up, it returns an error code
     * (1 or 2). On success it returns 0.
     */
    function confirmUserPass($username, $password) {
        /* Add slashes if necessary (for query) */
        if (!get_magic_quotes_gpc()) {
            $username = addslashes($username);
        }

        /* Verify that user is in database */
        $q = "SELECT password FROM " . TBL_USERS . " WHERE username = '$username'";
        $result = mysqli_query($this->connection, $q);
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return 1; //Indicates username failure
        }

        /* Retrieve password from result, strip slashes */
        $dbarray = mysqli_fetch_array($result);
        $dbarray['password'] = stripslashes($dbarray['password']);
        $password = stripslashes($password);

        /* Validate that password is correct */
        if ($password === $dbarray['password']) {
            return 0; //Success! Username and password confirmed
        } else {
            return 2; //Indicates password failure
        }
    }

    /**
     * confirmUserID - Checks whether or not the given
     * username is in the database, if so it checks if the
     * given userid is the same userid in the database
     * for that user. If the user doesn't exist or if the
     * userids don't match up, it returns an error code
     * (1 or 2). On success it returns 0.
     */
    function confirmUserID($username, $userid) {
        /* Add slashes if necessary (for query) */
        if (!get_magic_quotes_gpc()) {
            $username = addslashes($username);
        }

        /* Verify that user is in database */
        $q = "SELECT id FROM " . TBL_USERS . " WHERE username = '$username'";
        $result = mysqli_query($this->connection, $q);
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return 1; //Indicates username failure
        }

        /* Retrieve userid from result, strip slashes */
        $dbarray = mysqli_fetch_array($result);
        $dbarray['id'] = stripslashes($dbarray['id']);
        $userid = stripslashes($userid);

        /* Validate that userid is correct */
        if ($userid == $dbarray['id']) {
            return 0; //Success! Username and userid confirmed
        } else {
            return 2; //Indicates userid invalid
        }
    }

    /**
     * usernameTaken - Returns true if the username has
     * been taken by another user, false otherwise.
     */
    function usernameTaken($username) {
        if (!get_magic_quotes_gpc()) {
            $username = addslashes($username);
        }
        $q = "SELECT username FROM " . TBL_USERS . " WHERE username = '$username'";
        $result = mysqli_query($this->connection, $q);
        return (mysqli_num_rows($result) > 0);
    }

    /**
     * usernameBanned - Returns true if the username has
     * been banned by the administrator.
     */
    function usernameBanned($username) {
        if (!get_magic_quotes_gpc()) {
            $username = addslashes($username);
        }
        $q = "SELECT username FROM " . TBL_BANNED_USERS . " WHERE username= '$username'";
        $result = mysqli_query($this->connection, $q);
        return (mysqli_num_rows($result) > 0);
    }

    /**
     * addNewUser - Inserts the given (username, password, email)
     * info into the database. Appropriate user level is set.
     * Returns true on success, false otherwise.
     */
    function addNewUser($username, $password, $email) {
        $time = time();
        /* If admin sign up, give admin user level */
        if (strcasecmp($username, ADMIN_NAME) == 0) {
            $ulevel = ADMIN_LEVEL;
        } else {
            $ulevel = USER_LEVEL;
        }
        $q = "INSERT INTO " . TBL_USERS . " VALUES ('$username', '$password', '0', '$ulevel', '$email')";
        return mysqli_query($this->connection, $q);
    }

    /**
     * updateUserField - Updates a field, specified by the field
     * parameter, in the user's row of the database.
     */
    function updateUserField($username, $field, $value) {
        $q = "UPDATE " . TBL_USERS . " SET " . $field . " = '$value' WHERE username = '$username'";
        return mysqli_query($this->connection, $q);
    }

    /**
     * getUserInfo - Returns the result array from a mysql
     * query asking for all information stored regarding
     * the given username. If query fails, NULL is returned.
     */
    function getUserInfo($username) {
        $q = "SELECT * FROM " . TBL_USERS . " WHERE username = '$username'";
        $result = mysqli_query($this->connection, $q);
        /* Error occurred, return given name by default */
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return NULL;
        }
        /* Return result array */
        $dbarray = mysqli_fetch_array($result);
        return $dbarray;
    }

    /**
     * getNumMembers - Returns the number of signed-up users
     * of the website, banned members not included. The first
     * time the function is called on page load, the database
     * is queried, on subsequent calls, the stored result
     * is returned. This is to improve efficiency, effectively
     * not querying the database when no call is made.
     */
    function getNumMembers() {
        if ($this->num_members < 0) {
            $q = "SELECT * FROM " . TBL_USERS;
            $result = mysqli_query($this->connection, $q);
            $this->num_members = mysqli_num_rows($result);
        }
        return $this->num_members;
    }
    /**
     * query - Performs the given query on the database and
     * returns the result, which may be false, true or a
     * resource identifier.
     */
    function query($query) {
        return mysqli_query($this->connection, $query);
    }

}

/* Create database connection */
$database = new MySQLDB;
?>
