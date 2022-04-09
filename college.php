<?php

class College implements JsonSerializable
{
    private $id;
    private $name;
    private $grade;

    function __construct($id, $subject, $finalgrade)
    {
        $this->id = $id;
        $this->subject = $subject;
        $this->finalgrade = $finalgrade;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}

?>