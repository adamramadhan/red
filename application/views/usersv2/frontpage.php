            <div id="red-edit-left-wide">
                <h3>Kotak Informasi</h3>
                <form accept-charset="utf-8" method="post" >
                <ul>
                    <li><div id="js-middleware-wmd-menu"></div></li>
                    <li><label for="content"><?php echo l('informationbox'); ?></label><textarea rows="20" cols="65" name="informationbox" id="js-middleware-wmd-core"><?php echo $user['information']; ?></textarea></li>
                    <li><label for="preview">Preview</label>
                        <h1 id="title-suffix" style="padding: 5px;"></h1>
                        <div class="blog-post" id="js-middleware-wmd-preview"></div>
                    </li>
                </ul>
                <input type="hidden" name="js-middleware-wmd-output" value="" id="js-middleware-wmd-output">
                <p><input type="submit" value="Ubah" name="edit" id="button"></p>
                </form>
            </div>
            <!-- FORM ENDS -->          
            
            <div id="red-edit-right">
                <div id="red-profile-guides">
                <h3>What will visitor see first.</h3>
                    <p>Tulisan akan dimuat di halaman depan profil Anda.</p>
                </div>
              <div id="red-profile-guides">
                <h3>Howto & Guide</h3>
                    <p><a href="http://en.wikipedia.org/wiki/WYSIWYM">WYSIWYM</a> atau <i>What You See Is What You Mean</i> adalah fitur yang kami tambahkan dalam blog ini.</p>
                </div>
            </div>

    <link rel="stylesheet" type="text/css" href="/www-static/assets/js/middleware/wmd/wmd.css"/>
    <?php $views->css('blog'); ?>
    <script type="text/javascript" src="/www-static/assets/js/middleware/wmd/showdown.js"></script>
    <script type="text/javascript" src="/www-static/assets/js/middleware/wmd/wmd.js"></script> 
    <?php #$views->JS('jquery,middleware/jquery/jquery.validation,users/addarticle'); ?>
    <script type="text/javascript">
        setup_wmd({
        input: "js-middleware-wmd-core",
        button_bar: "js-middleware-wmd-menu",
        preview: "js-middleware-wmd-preview",
        output: "js-middleware-wmd-output"
    });
    </script>       
    <style>
    #js-middleware-wmd-preview {
        padding: 5px;
    }
    .text-title {
    width: 465px;
    }
    </style>