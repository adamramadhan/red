<?php 
/*$text= '
hallo, kami hari ini akan mencoba sistim comment, dapat dilihat pada halaman produk dan di blog ini.
jika belum memfollow organisasi lainnya, kini saatnya untuk memfollow, kalian dapat melihat update terakhir seputar produk beserta commentnya.

<h3>Verify</h3>Kemananan bertransaksi adalah salah satu tujuan dibentuknya netcoid, banyaknya usaha yang memalsukan identitasnya untuk melakukan penipuan atau lebih umum disebut "scammers" atau "A fraudulent business scheme; a swindle." yang mempunyai arti Skema penipuan usaha; sebuah penipuan.

<img src="http://dl.dropbox.com/u/5984602/blog/4-satu.png" />
Dengan sistim verifikasi, kami berharap dapat mengurangi angka tersebut sebanyak munkin dengan innovasi dan ide dari beberapa organisasi, kawan dan lainnya yang tidak bisa kami sebut satu - satu, terutama untuk keluarga besar netcoid.

<h4>Bagaimana?</h4>
<img src="http://dl.dropbox.com/u/5984602/blog/4-dua.png" />

Terdapat 4 kemunkinan jika anda ingin melihat status verifikasi;
<b>Terverifikasi ( dapat melihat data )</b>
Hal ini terjadi jika anda login + saling mengikuti.
<b>Terverifikasi ( Tidak dapat melihat data )</b>
Hal ini terjadi dikarenakan anda tidak login atau anda login tetapi tidak saling mengikuti.
<b>Tidak terverifikasi</b>
Hal ini terjadi dikarenakan akun belum terdapat data ( belum mengaplikasi dokumen yang dibutuhkan ).
<b>Team</b>
Hal ini terjadi dikarenakan akun tersebut adalah akun anggota team netcoid ( investor, partnership, netcoid sendiri, atau anggota netcoid yang mempunyai toko atau organisasi diluar netcoid ).

<h4>FAQS</h4>1. Apakah kena biaya ?
- tidak anda tidak diperkenakan biaya untuk menjadi anggota verifikasi. jika iya anda dapat melaporkan hal tersebut ke security@networks.co.id atau langsung message <a href="/netcoid">netcoid</a>

2. Kita masih dapat memalsukan dokumen?
- kemunkinan ini tidak kami tolak hanya saja untuk PT, CV atau Organisasi non-profit, akan kami periksa dan harus sesuai dengan nama akun yang dibuka, secara umum netcoid berusaha untuk menciptakan kondisi sesama munkin dengan realita berbisnis di dunia nyata, hanya saja kami mencoba menutupi kekurangan jarak, kemudahan dan keterbukaan, sehingga hal ini dapat terjadi, 

3. Nama akun saya tidak sama dengan Dokumen saya ?
- akan kami bantu lakukan perubahan nama jika dokumen anda sah.

4. Lainnya ?

<a href="/verify">www.networks.co.id/verify</a>

Terimakasih

Adam Ramadhan
';

$line = trim($text);
$line = preg_replace('/\s\s+/', ' ', $line);
$line = str_replace(">\n<", '><', $line);
$line = trim($line);
echo $line;
*/

		# edit
		var_dump(explode('.',$_SERVER['HTTP_HOST']));
		var_dump(explode('.', $_SERVER['SERVER_NAME'], 2));
		# stop edit

?>