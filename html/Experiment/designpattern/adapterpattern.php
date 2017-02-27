<?php

class Mobile {
    private $mobile;
    private $charger;
    function __construct($mobile, $charger) {
        $this->mobile = $mobile;
        $this->charger  = $charger;
    }
    function getMobile() {
        return $this->mobile;
    }

    function getCharger() {

        return $this->charger;
    }

}

class MobileAdapter {

    private $mobile;
    function __construct(Mobile $mobile) {
        $this->mobile = $mobile;
    }
    function getMobileAndCharger() {
        return $this->mobile->getMobile().' has this  '.$this->mobile->getCharger();
    }
}

 
  $mobile = new Mobile("Mi", "Design C3");
  $mobileAdapter = new MobileAdapter($mobile);
  echo('Mobile and charger: '.$mobileAdapter->getMobileAndCharger());

?>
