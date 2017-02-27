<?php
interface Order
{
    public function shipOrder();
    public function completeOrder();
    public function getStatus():
}