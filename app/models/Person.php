<?php
class Person {
    protected $name;
    protected $email;
    protected $phone;

    public function setData($name, $email, $phone) {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getName() {
        return $this->name;
    }
}
