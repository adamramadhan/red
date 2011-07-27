            <!-- FORM START -->
            <div id="red-edit-left">
                <h3>Data Koneksi</h3>
                <form accept-charset="utf-8" method="post" action="#" >
                <ul>
                    <li><?php $this->forms->textinput('twitter','Twitter', array( 'value' => $user['twitter'])); ?></li>
                    <li><?php $this->forms->textinput('yahoo','Y! Messenger', array( 'value' => $user['yahoo'])); ?></li>
                    <li><?php $this->forms->textinput('facebook','Facebook', array( 'value' => $user['facebook'])); ?></li>
                </ul>
                <p><input type="submit" value="Ubah" name="edit" id="button"></p>
                </form>
            </div>
            <!-- FORM ENDS -->
            
            <!-- INFORMATION START -->
            <div id="red-edit-right">
                <ul id="connect-status">
                    <li class="c" id="twitter"><?php echo $this->social->get_twitter($user['twitter']); ?></li>
                    <li class="c" id="yahoo"><?php echo $this->social->get_yahoo($user['yahoo']); ?></li>
                    <li class="c" id="facebook"><?php echo $this->social->getFacebookPageEdit($user['facebook']); ?></li>
                </ul>
            </div>
            <!-- INFORMATION ENDS -->           

            <div id="red-edit-right">
                <div id="red-profile-guides">
                <h3>Show your social activities.</h3>
                    <p>Tunjukan aktifitas sosial dalam satu halaman profil.</p>
                </div>
              <div id="red-profile-guides">
                <h3>Howto & Guide</h3>
                <ul>
                    <li>Akun twitter harus dapat diakses oleh public, contoh: billgates</li>
                    <li>Yahoo messenger harus lengkap, contoh: netcoid@yahoo.com, netcoid@rocketmail.com</li>
                    <li>URL atau ID <strong>Page</strong> facebook, bukan profile. contoh: cocacola, 40796308305</li>
                </ul>
                </div>
            </div>