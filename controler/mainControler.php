<?php
  class mainControler {

    public $core = false;

    function __construct($coreCi) {
      $this->core = $coreCi;
    }

    public function search() {
      $arrData = [];
      $arrData['iItemPerPage'] = 12;
      $arrData['arrList'] = $this->core->database('sourcesList','select');
      $this->core->load('view','general/headerView');
      if(isset($_GET['s'])) {
        if($_GET['s'] == '') {
          header('Location: '.BASE_URL);
        }
        $iOffset = 0;
        $arrData['iActualPage'] = 0;
        if(isset($_GET['iPage'])) {
          $arrData['iActualPage'] = $_GET['iPage'];
        }
        $arrData['arrAllItems'] = $this->core->database('items','search',array('s' =>$_GET['s']));
        $arrData['iItems'] = count($arrData['arrAllItems']);
        $iOffset = $_GET['iPage'] * $arrData['iItemPerPage'];
        for($i = 0; $i < $arrData['iItemPerPage']; $i++) {
          if($arrData['arrAllItems'][$i+$iOffset]) {
            $arrData['arrItems'][$i] = $arrData['arrAllItems'][$i+$iOffset];
          }
        }
        $this->core->load('view','main/categorieView',$arrData);
      }
      $this->core->load('view','general/footerView',$arrData);
    }

    public function index($iNoCategory = 'nope') {
      $arrData = [];
      $arrData['arrList'] = $this->core->database('sourcesList','select');
      $arrData['iItemPerPage'] = 12;
      $this->core->load('view','general/headerView');
      if($iNoCategory !== 'nope') {
        $arrData['arrItems'] = [];
        $iOffset = 0;
        $arrData['iActualPage'] = 0;
        if(isset($_GET['iPage'])) {
          $arrData['iActualPage'] = $_GET['iPage'];
        }
        $arrData['arrAllItems'] = $this->core->database('items','select',array('iSourcesList' =>$iNoCategory));
        $arrData['iItems'] = count($arrData['arrAllItems']);
        $iOffset = $_GET['iPage'] * $arrData['iItemPerPage'];
        for($i = 0; $i < $arrData['iItemPerPage']; $i++) {
          if($arrData['arrAllItems'][$i+$iOffset]) {
            $arrData['arrItems'][$i] = $arrData['arrAllItems'][$i+$iOffset];
          }
        }
        $this->core->load('view','main/categorieView',$arrData);
      }
      $this->core->load('view','general/footerView',$arrData);
    }
    
    public function notFound() {
      echo 'not found';
    }
  }
