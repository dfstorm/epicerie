<html>
  <head>
    <title>Epicerie</title>
    <?php echo getHeaderMeta(); ?>
  </head>
  <body style="background: #eee;">
    <div class="pusher" style="background:#eee;">
      <div class="ui wide-container" style="clear:both; background:#eee;">
        <form methode="GET" action="<?php echo BASE_URL; ?>main/search/">
          <div class="ui container vertical stripe" style="padding: 0em 0em 2em 0em;">
            <div class=" wide column">
              <p style="font-size: 2em; padding-top: 2em;">Centralisation de sp&eacute;ciaux de la r&eacute;gion de Qu&eacute;bec<br/>
                    <a href="<?php echo BASE_URL; ?>main/search/?s=Maxi" class="ui label">Maxi</a>
                    <a href="<?php echo BASE_URL; ?>main/search/?s=Iga"class="ui label">Iga</a>
                    <a href="<?php echo BASE_URL; ?>main/search/?s=Metro"class="ui label">Metro</a>
                    <a href="<?php echo BASE_URL; ?>main/search/?s=Provigo"class="ui label">Provigo</a>
                    <a href="<?php echo BASE_URL; ?>main/search/?s=Pharmaprix"class="ui label">Pharmaprix</a>

              </p>
              <div class="ui icon huge input" style="min-width:70%;">
                <input type="text" name="s" id="s" value="<?php echo (isset($_GET['s'])?$_GET['s']:''); ?>" placeholder="Rechercher parmis tous les sp&eacute;ciaux...">
                <i class=" search link icon"></i>
              </div>
            </div>
          </div>
        </form>
      </div>
