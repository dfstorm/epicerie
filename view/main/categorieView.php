<div class="ui wide-container" style="clear:both;  background:#eee;">
  <div class="ui container vertical stripe" style="padding: 0em 0em 4em 0em;">
    <div class=" wide column">

      <div class="ui pagination menu">
        <div class="ui pagination menu">
          <a class="item <?php echo ($iActualPage > 0?'':'disabled'); ?>"  href="<?php echo ($iActualPage <= 0 ? '':'?iPage='.($iActualPage - 1)); echo (isset($_GET['s'])?'&s='.$_GET['s']:''); ?>">
            Pr&eacute;c&eacute;dent
          </a>
          <?php
          $iPages = $iItems / $iItemPerPage;
          $iPage = 0;
          while($iPages > $iPage) {
            ?><a class="<?php echo ($iPage==$iActualPage?'active':''); ?> item" href="?iPage=<?php echo $iPage; echo (isset($_GET['s'])?'&s='.$_GET['s']:''); ?>">
              <?php echo $iPage+1; ?>
            </a><?php
            $iPage++;
          }
          ?>
          <a class="item <?php echo ($iActualPage + 1 > $iPages - 1 ?'disabled':''); ?>" href="<?php echo ($iPages +1 < $iActualPage?'':'?iPage='.($iActualPage + 1)); echo (isset($_GET['s'])?'&s='.$_GET['s']:''); ?>">
            Suivant
          </a>
        </div>
      </div>

      <div class="ui cards" style="margin: 20px 0px;">
      <?php if($arrItems) { foreach ($arrItems as $key => $value) { ?>
        <div class="card">
          <div class="content">
            <img class="right floated mini ui image" src="http://www.supermarches.ca<?php echo $value['sImg']; ?>">
            <div class="text" style="font-size: 18px;">
              <?php echo $value['sCaption']; ?>
            </div>
            <div class="meta">
              <?php echo $value['sBrand']; ?>
            </div>
            <div class="description">
              <div class="fr">
                <?php echo $value['sQty']; ?>
              </div>
              <div style="font-size: 20px;">
                <?php echo $value['sPrice']; ?>
              </div>
            </div>
          </div>
          <div class="extra content">
            <div class="fr">
              <?php echo $value['sDates']; ?>
            </div>
            <?php echo $value['sRef']; ?>
          </div>
        </div>
            <?php } } ?>
      </div>
      <div class="ui pagination menu">
        <div class="ui pagination menu">
          <a class="item <?php echo ($iActualPage > 0?'':'disabled'); ?>"  href="<?php echo ($iActualPage <= 0 ? '':'?iPage='.($iActualPage - 1)); echo (isset($_GET['s'])?'&s='.$_GET['s']:''); ?>">
            Pr&eacute;c&eacute;dent
          </a>
        <?php
        $iPages = $iItems / $iItemPerPage;
        $iPage = 0;
        while($iPages > $iPage) {
          ?><a class="<?php echo ($iPage==$iActualPage?'active':''); ?> item" href="?iPage=<?php echo $iPage; echo (isset($_GET['s'])?'&s='.$_GET['s']:''); ?>">
            <?php echo $iPage+1; ?>
          </a><?php
          $iPage++;
        }
        ?>
          <a class="item <?php echo ($iActualPage + 1 > $iPages - 1 ?'disabled':''); ?>" href="<?php echo ($iPages +1 < $iActualPage?'':'?iPage='.($iActualPage + 1)); echo (isset($_GET['s'])?'&s='.$_GET['s']:''); ?>">
            Suivant
          </a>

        </div>
      </div>
    </div>
  </div>
</div>
