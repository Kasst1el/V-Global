<?php
  class HomeController {
    public function index() {
      require_once('views/home/index.html');
    }
    public function catalog() {
      require_once('views/home/catalog.html');
    }

    public function contacts() {
      require_once('views/home/contacts.html');
    }

    public function partners() {
      require_once('views/home/partners.html');
    }

    public function BuyLV() {
      require_once('views/home/BuyLV.html');
    }


    public function error() {
      require_once('views/home/error.php');
    }
  }

