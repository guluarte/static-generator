        <div  class ="aligncenter">
          <ul class="unstyled inline ">
            <li><a href="https://twitter.com/share" class="twitter-share-button" data-via="funnythings247" data-count="vertical">Tweet</a>

              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>

              <li class="facebook"><div class="fb-like" data-href="<?php echo $site['url']; ?><?php echo $post['url']; ?>" data-width="450" data-layout="box_count" data-show-faces="true" data-send="false"></div></li>

              <li class="googleplus"><g:plusone size="tall"></g:plusone><script type="text/javascript">
              (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
              })();
            </script></li>
            <li>
              <a href="//www.pinterest.com/pin/create/button/?url=<?php echo $site['url_encode']; ?><?php echo $post['url_encode']; ?>&media=<?php echo $site['image_path_encode']; ?><?php echo $post['image_encode']; ?>&description=<?php echo $post['title_encode']; ?><?php echo urlencode(" #funny #wtf #lol #random #funnythings247")?>" data-pin-do="buttonPin" data-pin-config="above"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>
            </li>
          </ul>
        </div>