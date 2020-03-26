<?php

class NameValidator
{
    var $name;
    function __construct($name)
    {
        $this->name = $name;
    }
    function validate()
    {
        if ($this->name == "" || strlen($this->name) > 20 || strlen($this->name) < 3) {
            return "user Name must be more than 3 characters and less than 20";
        }
        return "true";
    }
}
class EmailValidator
{
    var $email;
    function __construct($email)
    {
        $this->email = $email;
    }
    function validate()
    {;
        if ($this->email == "" || !filter_var($this->email, FILTER_VALIDATE_EMAIL))
            return "It's not Valid Email";
        return "true";
    }
}
class PasswordValidator
{
    var $pass;
    function __construct($password)
    {
        $this->pass = $password;
    }
    function validate()
    {

        if (strlen($this->pass) < 10 || $this->pass = "")
            return "Password must be at least 10 characters length";
        return "true";
    }
}
class PhoneValidator
{
    var $phonePattern = "/^01[0125][0-9]{8}$/ ";
    var $phone;
    function __construct($number)
    {
        $this->phone = $number;
    }
    function validate()
    {
        if ($this->phone == "" || !preg_match($this->phonePattern, $this->phone))
            return "Phone Number not Valid";
        return "true";
    }
}
class MsgValidator
{
    var $msg;
    function __construct($msg)
    {
        $this->msg = $msg;
    }
    function validate()
    {
        if ($this->msg == "")
            return "Message is required";
        return "true";
    }
}
class MovieTitle
{
    var $title;
    public function __construct($Title)
    {
        $this->title = $Title;
    }
    public function validate()
    {
        if (strlen($this->title) < 3)
            return "Movie Title must be at least 3 characters";
        return "true";
    }
}
class MovieDesc
{
    var $desc;
    function __construct($desc)
    {
        $this->desc = $desc;
    }
    function validate()
    {
        if (strlen($this->desc) < 15)
            return "Movie Description must be at least 15 characters";
        return "true";
    }
}
class MovieImg
{
    var $oldName, $tmpName, $ext, $newName, $isEmpty;
    function __construct($img)
    {
        if ($img["size"] == "int(0)") {
            $this->isEmpty = true;
        } else {
            $this->oldName = htmlspecialchars($img["name"]);
            $this->tmpName = htmlspecialchars($img["tmp_name"]);
            $this->ext = pathinfo($this->oldName, PATHINFO_EXTENSION);
            $this->newName = uniqid() . ".$this->ext";
        }
    }
    function upload()
    {
        if (!$this->isEmpty) {
            move_uploaded_file($this->tmpName, "images/$this->newName");
            return $this->newName;
        } else {
            return "null";
        }
    }
}