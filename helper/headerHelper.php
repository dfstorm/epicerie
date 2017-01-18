<?php
  function getHeaderMeta() {
    $arrCoreCss = array(
      0 => 'css/style.css',
      1 => 'css/semantic.min.css'
    );

    $sHtml = '';
    if($arrCoreCss) {
      if(is_array($arrCoreCss)) {
        foreach ($arrCoreCss as $key => $value) {
          $sHtml .= '<link rel="stylesheet" href="'.BASE_URL.'assets/'.$value.'">';
        }
      }
    }
    return $sHtml;
  }
