<?php

class successForm {

    var $msgs = array();  //Holds submitted form error messages
    var $num_msgs;   //The number of errors in submitted form

    /* Class constructor */

    function successForm() {
        /**
         * Get form value and error arrays, used when there
         * is an error with a user-submitted form.
         */
        if (isset($_SESSION['msg_array'])) {
            $this->msgs = $_SESSION['msg_array'];
            $this->num_msgs = count($this->msgs);

            unset($_SESSION['msg_array']);
        } else {
            $this->num_msgs = 0;
        }
    }

    /**
     * setError - Records new form error given the form
     * field name and the error message attached to it.
     */
    function setMsg($field, $msg) {
        $this->msgs[$field] = $msg;
        $this->$num_msgs = count($this->msgs);
    }

    /**
     * error - Returns the error message attached to the
     * given field, if none exists, the empty string is returned.
     */
    function msg($field) {
        if (array_key_exists($field, $this->msgs)) {
            return "<center><font size=\"2\" align=\"center\" color=\"green\">" . $this->msgs[$field] . "</font></center>";
        } else {
            return "";
        }
    }

    /* getErrorArray - Returns the array of error messages */

    function getMsgArray() {
        return $this->msgs;
    }
}
?>
