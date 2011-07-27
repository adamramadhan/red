        <!-- FORM START -->
        <div id="red-edit-left-wide">
            <h3>Edit Artikel</h3>
            <form id="form-blogadd" accept-charset="utf-8" method="post">
            <ul>
                <li><label for="input-title">Judul</label><input type="text" title="<?php echo l('blog_title_error'); ?>" value="<?php echo $data['title']; ?>" id="input-title" class="text-title" name="title"></li>
                <li><div id="js-middleware-wmd-menu"></div></li>
                <li><label for="content">Tulisan</label><textarea title="<?php echo l('blog_content_empty'); ?>" rows="50" cols="65" name="content" id="js-middleware-wmd-core"><?php echo $data['content']; ?></textarea></li>
                <li><label for="preview">Preview</label>
                <h1 id="title-suffix" style="padding: 5px;"><?php echo $data['title']; ?></h1>
                <div class="blog-post" id="js-middleware-wmd-preview"></div>
                </li>
                <li><label for="input-title">Tag</label><input type="text"
                    value="<?php echo $data['tag']; ?>" title="<?php echo l('blog_tag_empty'); ?>" id="input-tag" class="textinput" name="tag"></li>
            </ul>
            <input type="hidden" name="js-middleware-wmd-output" value="" id="js-middleware-wmd-output">
            <p><input type="submit" value="Edit" name="editpost" id="button"></p>
            </form>
        </div>
        <!-- FORM ENDS -->
        
        <div id="red-edit-right">   
        <div id="red-profile-guides">
        <style>
        .highlight{background: none repeat scroll 0 0 #FFFCBB;}
        </style>
            <h3>Howto & Guide</h3>
            <p><a href="http://en.wikipedia.org/wiki/WYSIWYM">WYSIWYM</a> atau <i>What You See Is What You Mean</i>
            adalah fitur yang kami tambahkan dalam blog ini;</p>
            <br>
            <p><strong>1. Headers</strong></p>
            <p><code class="highlight">## Tajuk (2) ##</code></p>
            <p><code class="highlight">### Tajuk (3)</code></p>
            <br>
            <p><strong>2. Formats</strong></p>
            <p><code class="highlight">*tulisan miring*</code></p>
            <p><code class="highlight">**tulisan tebal**</code></p>
            <p><code class="highlight">*tulisan miring **tebal** dan miring*</code></p>
            <br>
            <p><strong>3a. Unorderd Lists</strong></p>
            <p><code class="highlight">- list satu</code></p>
            <p><code class="highlight">- list dua</code></p>
            <p><code class="highlight">- list tiga</code></p>
            <br>
            <p><strong>3b. Orderd Lists</strong></p>
            <p><code class="highlight">3. list tiga</code></p>
            <p><code class="highlight">1. list satu</code></p>
            <p><code class="highlight">2. list dua</code></p>
            <br>
            <p><strong>4a. Links</strong></p>
            <p><code class="highlight">[This link](http://eg.net/)</code></p>       
            <br>
            <p><strong>4b. Inline Links</strong></p>
            <p><code class="highlight">ini adalah [link text][1] ke eg.com dan [link dua][2]<br/><br/>[1]: http://eg.com<br/>[2]: http://eg2.com</code></p><br>
            <h3>Review?</h3>
            <p>Anda hanya dapat mengirim satu artikel sampai artikel tersebut di approve.</p>
        </div>  
        </div>

    <link rel="stylesheet" type="text/css" href="/www-static/assets/js/middleware/wmd/wmd.css"/>
    <?php $views->css('blog'); ?>
    <script type="text/javascript" src="/www-static/assets/js/middleware/wmd/showdown.js"></script>
    <script type="text/javascript" src="/www-static/assets/js/middleware/wmd/wmd.js"></script> 
    <?php $views->JS('middleware/jquery/jquery.validation,users/addarticle'); ?>
    <style>
        #js-middleware-wmd-preview {
            padding: 5px;
        }
        .text-title {
        width: 465px;
        }
    </style>