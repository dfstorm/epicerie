<?php
/*
    Copyright 2017 Gabriel Genois

    This file is part of Aurelius.

    Aurelius is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Aurelius is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Aurelius.  If not, see <http://www.gnu.org/licenses/>.

*/
  define("BASE_URL", '/');
  class core {


    // FolderLevel. (Ex.: /:0, /e/:1. /e/s/:2.)
    public $iSubFolder = 0;

    // Database configuration
    private $dbHost = '';
    private $dbUser = '';
    private $dbPass = '';
    private $dbData = '';

    private $ctrl = array();
    public $db = false;

    function __construct() {
      // ini session
      //session_start(); // not needed.

      // connect database
      $this->dbConnect();

      // load base helpers
      $this->load('helper','headerHelper');

      // Load the right thing
      $this->controlerBridge();

    }

    function __destruct() {
      mysqli_close($this->db);
    }

    public function database($sDbName,$sAction,$arrParams,$iLimit=1000) {
      $arrIndexArray = array(
        'user' => 'iNoUser'
      );
      switch ($sAction) {
        // "search" is project specific.
        case 'search':
          $sQuery = "SELECT * FROM $sDbName WHERE sCaption LIKE '%".$arrParams['s']."%' OR sQty LIKE '%".$arrParams['s']."%' OR sRef LIKE '%".$arrParams['s']."%' OR sBrand LIKE '%".$arrParams['s']."%';";
          $rResult = $this->db->query($sQuery);
          if($rResult) {
            $returnData = array();
            while ($row = mysqli_fetch_assoc($rResult)) {
                $returnData[] = $row;
            }
            return $returnData;
          }
          else {
            return false;
          }
          break;
        case 'select':
          $sQuery = "";
          if(is_array($arrParams)) {
            $rValues = array();
            foreach ($arrParams as $key => $value) {
              $rValues[] = $key."='".$value."'";
            }
            $sQuery = "SELECT * FROM $sDbName WHERE ".implode(" AND ",$rValues)." LIMIT ".$iLimit;
          } else {
            $sQuery = "SELECT * FROM $sDbName LIMIT ".$iLimit;
          }
          $rResult = $this->db->query($sQuery);
          if($rResult) {
            $returnData = array();
            while ($row = mysqli_fetch_assoc($rResult)) {
                $returnData[] = $row;
            }
            return $returnData;
          }
          else {
            return false;
          }
          break;
        case 'insert':
          $sQuery = "";
          if(is_array($arrParams)) {
            $rKeys = array();
            $rValues = array();
            foreach ($arrParams as $key => $value) {
              $rKeys[] = $key;
              $rValues[] = "'".$value."'";
            }
            $sQuery = "INSERT INTO $sDbName (".implode(",",$rKeys).") VALUES (".implode(",",$rValues).")";
          } else {
            return false;
          }
          $rResult = $this->db->query($sQuery);
          return true;
          break;
        case 'update':
          $sQuery = "";
          if(is_array($arrParams)) {
            $rValues = array();
            foreach ($arrParams as $key => $value) {
              if($key !== $arrIndexArray[$sDbName]) {
                $rValues[] = $key."='".$value."'";
              }
            }
            $sQuery = "UPDATE $sDbName SET ".implode(",",$rValues)." WHERE ".$arrIndexArray[$sDbName]."=".$arrParams[$arrIndexArray[$sDbName]];
          } else {
            return false;
          }
          $rResult = $this->db->query($sQuery);
          return true;
          break;
        default:
          # code...
          break;
      }
    }

    public function load($sMode,$sPath,$arrData = false) {
      switch ($sMode) {
        case 'view':
          if($arrData) {
            if(is_array($arrData)) {
              extract($arrData);
            }
          }
          require(realpath('').'/view/'.$sPath.'.php');
          break;
          case 'helper':
            require(realpath('').'/helper/'.$sPath.'.php');
            break;
        default:
          return false;
          break;
      }
    }

    public function controlerBridge() {
      require('controler/mainControler.php');
      $arrControlerReference = array(
        'main' => 'mainControler'
      );
      if($this->getPageSection()) {
        if(isset($arrControlerReference[$this->getPageSection()])) {

          if($this->getPageSection() !== 'main') {
            require('controler/'.$arrControlerReference[$this->getPageSection()].'.php');
          }
          if(class_exists($arrControlerReference[$this->getPageSection()])) {
            $this->ctrl[$arrControlerReference[$this->getPageSection()]] =  new $arrControlerReference[$this->getPageSection()]($this);
          } else {
            exit('System failure');
          }
          if($this->getPageSection(1) && method_exists($arrControlerReference[$this->getPageSection()],$this->getPageSection(1))) {

            $this->ctrl[$arrControlerReference[$this->getPageSection()]]->{$this->getPageSection(1)}();
          } else {

            $a1 = false;
            if($this->getPageSection(1)) {
              $a1 = $this->getPageSection(1);
            }

            $this->ctrl[$arrControlerReference[$this->getPageSection()]]->index($a1);
          }
        } else {
          mainControler::notFound();
        }
      } else {
        if(class_exists('mainControler')) {
          $this->ctrl['mainControler'] =  new mainControler($this);
          if($this->getPageSection() == 'mainControler') {
            if($this->getPageSection(1)) {
              $this->ctrl['mainControler']->{$this->getPageSection(1)}();
            } else {
              $this->ctrl['mainControler']->index();
            }
          } else {
            $this->ctrl['mainControler']->index();
          }
        } else {
          echo 'system offline. Sorry.';
          exit();
        }
      }
    }

    public function getPageSection($iIndex = 0) {
      $path = ltrim($_SERVER['REQUEST_URI'], '/');
        $elements = explode('/', $path);
        if(isset($elements[$this->iSubFolder + $iIndex])) {
          return $elements[$this->iSubFolder + $iIndex];
        } else {
          return false;
        }
    }


    public function dbConnect() {
      $this->db = new mysqli(
        $this->dbHost,
        $this->dbUser,
        $this->dbPass,
        $this->dbData
      );
    }

    public function coreInit() {
      // Place to put security and other inits...
    }
  }
