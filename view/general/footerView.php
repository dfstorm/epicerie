    <div class="ui wide-container" style="">
      <div class="ui container vertical stripe" style="padding: 1em 0em 0em 0em;">
        <div class=" wide column">
          <h3 style="font-weight: normal;">Afficher par cat&eacute;gories</h3>
          <p>
            <select class="ui dropdown huge selection" onchange="listOnChange(this);" style="min-height:3em;">
                <?php $i = 1; foreach($arrList as $iIndex => $itemData) { $i++; ?>
                <option value="<?php echo BASE_URL.'main/'.$iIndex; ?>">
                    <?php echo $itemData['sName']; ?>
                </option>
                <?php } ?>
            </select>
          </p>
          <script>
          function listOnChange(it) {
              window.location.href = it.value;
          }
          </script>
          <div class="ui red segment">
            <h3>Attention</h3>
            <p>
                Ce site web est un simple outils personnel de recherche. Le moteur de recherche est plus que non fonctionnel et ce limite &agrave; le recherche d'un seul mot clef &agrave; la fois. De plus, je ne peux être tenue responsable d'erreur et vous utilisez ce service &agrave; vos risques et p&eacute;rils. Merci.
            </p>
          </div>
          <p><a href="https://github.com/dfstorm/epicerie" target="_blank">Code source</a> - Copyright 2017 Gabriel Genois - Sous licence <a href="http://www.gnu.org/licenses/" target="_blank">GNU GPL</a></p>
        </div>
      </div>
    </div>
  </div>
  <div class="ui wide-container" style="clear:both; background:#eee; margin-top:20px;"></div>
  <style>
    .fl { float:left; }
    .fr { float:right; }
    .subCat { color:#000; }
    .subCat:hover { color:#21BA45; }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/js/semantic.min.js"></script>
  <!-- Piwik -->
  <script type="text/javascript">
    var _paq = _paq || [];
    // tracker methods like "setCustomDimension" should be called before "trackPageView"
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
      var u="//s.genois.me/";
      _paq.push(['setTrackerUrl', u+'piwik.php']);
      _paq.push(['setSiteId', '3']);
      var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
      g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
  </script>
  <!-- End Piwik Code -->
  </body>
</html>
