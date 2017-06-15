<?php
/*
 *      index.php
 *      
 *      Copyright 2011 Ahmad Zafrullah Mardiansyah <zaf@zaf-laptop>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */
  
include "convert.php";
 
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 
<head>
    <title>cipher | 23Pstars</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="generator" content="Geany 0.18" />
    <style type="text/css">
    a:link {color: #000000; text-decoration: none}
    a:visited {color: #000000; text-decoration: none}
    a:hover {color: #FF0000; text-decoration: underline}
    </style>
    <script type="text/javascript">
    function SelectAll(id){
        document.getElementById(id).focus();
        document.getElementById(id).select();
    }
    function Info(){
        alert("Original code by :"+'\n\n'+"Ahmad Zafrullah Mardiansyah");
    }
    function InfoCaesar(){
        alert("Key hanya berupa kombinasi angka,"+'\n'+"dan plan text tidak boleh mengandung angka!");
    }
    function InfoVigenere(){
        alert("Key hanya berupa kombinasi kata, tidak boleh mengandung angka,"+'\n'+"dan plan text tidak boleh mengandung angka!");
    }
    </script>
</head>
 
<body>
    <center>
    <h2>Simple cipher implementation with PHP</h2>
    <h4><a onclick="Info()">by 23Pstars</a></h4>
    </center>
    <table width="600" align="center">
    <tr><td width="50%" valign="top">
    <fieldset>
    <legend><b>Caesar</b></legend>
    <form action="" method="post">
    <input type="text" name="key_caesar" id="key_caesar" value="the key..." onclick="SelectAll('key_caesar')" />
    <input type="submit" value="?" onclick="InfoCaesar()" /><br/>
    <textarea rows="4" name="plantext_caesar" id="plantext_caesar" cols="33" onclick="SelectAll('plantext_caesar')" >plan text...</textarea><br/>
    <input type="submit" name="encrypt_caesar" value="Encrypt" /><input type="submit" name="decrypt_caesar" value="Decrypt" /><input type="reset" value="Reset" />
    </form>
    </fieldset>
    </td><td valign="top" colspan="3">
    <fieldset>
    <legend><b>Result</b></legend>
    <?php
    //----------------------------------------------------------------//
    // caesar                                                         //
    //----------------------------------------------------------------//
        if((isset($_POST['key_caesar'])) && (isset($_POST['plantext_caesar'])) && isset($_POST['encrypt_caesar'])){
            $key=$_POST['key_caesar'];
            $plantext=$_POST['plantext_caesar'];
            $split_key=str_split($key);
            $i=0;
            $split_chr=str_split($plantext);
            while ($key>52){
                $key=$key-52;
            }
            foreach($split_chr as $chr){
                if (char_to_dec($chr)!=null){
                    $split_nmbr[$i]=char_to_dec($chr);
                } else {
                    $split_nmbr[$i]=$chr;
                }
                $i++;
            }
            echo '<textarea rows="4" id="result" cols="33" onclick="SelectAll(\'result\')" >';
            foreach($split_nmbr as $nmbr){
                if (($nmbr+$key)>52){
                    if (dec_to_char($nmbr)!=null){
                        echo dec_to_char(($nmbr+$key)-52);
                    } else {
                        echo $nmbr;
                    }
                } else {
                    if (dec_to_char($nmbr)!=null){
                        echo dec_to_char($nmbr+$key);
                    } else {
                        echo $nmbr;
                    }
                }
            }
            echo '</textarea><br/>';
        } else if ((isset($_POST['key_caesar'])) && (isset($_POST['plantext_caesar'])) && isset($_POST['decrypt_caesar'])){
            $key=$_POST['key_caesar'];
            $plantext=$_POST['plantext_caesar'];
            $i=0;
            $split_chr=str_split($plantext);
            while ($key>52){
                $key=$key-52;
            }
            foreach($split_chr as $chr){
                if (char_to_dec($chr)!=null){
                    $split_nmbr[$i]=char_to_dec($chr);
                } else {
                    $split_nmbr[$i]=$chr;
                }
                $i++;
            }
            echo '<textarea rows="4" id="result" cols="33" onclick="SelectAll(\'result\')" >';
            foreach($split_nmbr as $nmbr){
                if (($nmbr-$key)<1){
                    if (dec_to_char($nmbr)!=null){
                        echo dec_to_char(($nmbr-$key)+52);
                    } else {
                        echo $nmbr;
                    }
                } else {
                    if (dec_to_char($nmbr)!=null){
                        echo dec_to_char($nmbr-$key);
                    } else {
                        echo $nmbr;
                    }
                }
            }
            echo '</textarea><br/>';
             
    //----------------------------------------------------------------//
    // vigenere                                                       //
    //----------------------------------------------------------------//
        } else if ((isset($_POST['key_vigenere'])) && (isset($_POST['plantext_vigenere'])) && (isset($_POST['encrypt_vigenere']))){
            $key=$_POST['key_vigenere'];
            $plantext=$_POST['plantext_vigenere'];
            $len_key=strlen($key);
            $len_plantext=strlen($plantext);
            $split_key=str_split($key);
            $split_plantext=str_split($plantext);
             
            echo '<textarea rows="4" id="result" cols="33" onclick="SelectAll(\'result\')" >';
            $i=0;
            for($j=0;$j<$len_plantext;$j++){
                if ($i==$len_key){
                    $i=0;
                }
                $split_key2[$j]=$split_key[$i];
                $i++;
            }
            for($k=0;$k<$len_plantext;$k++){
                $a=char_to_dec($split_key2[$k]);
                $b=char_to_dec($split_plantext[$k]);
                if (($a && $b)!=null){
                    echo (tabel_vigenere_encrypt($a, $b));
                } else {
                    echo $split_plantext[$k];
                }
            }
            echo '</textarea><br/>';
        } else if ((isset($_POST['key_vigenere'])) && (isset($_POST['plantext_vigenere'])) && (isset($_POST['decrypt_vigenere']))){
            $key=$_POST['key_vigenere'];
            $plantext=$_POST['plantext_vigenere'];
            $len_key=strlen($key);
            $len_plantext=strlen($plantext);
            $split_key=str_split($key);
            $split_plantext=str_split($plantext);
             
            echo '<textarea rows="4" id="result" cols="33" onclick="SelectAll(\'result\')" >';
            $i=0;
            for($j=0;$j<$len_plantext;$j++){
                if ($i==$len_key){
                    $i=0;
                }
                $split_key2[$j]=$split_key[$i];
                $i++;
            }
             
            for($k=0;$k<$len_plantext;$k++){
                $a=char_to_dec($split_key2[$k]);
                $b=char_to_dec($split_plantext[$k]);
                if (($a && $b)!=null){
                    echo (tabel_vigenere_decrypt($b, $a));
                } else {
                    echo $split_plantext[$k];
                }
            }
             
            echo '</textarea><br/>';
 
        } else {
            echo "result here...";
        }
    ?>
    </fieldset>
    </td></tr>
    <tr><td valign="top">
    <fieldset>
    <legend><b>Vigenere</b></legend>
    <form action="" method="post">
    <input type="text" name="key_vigenere" id="key_vigenere" value="the key..." onclick="SelectAll('key_vigenere')" />
    <input type="submit" value="?" onclick="InfoVigenere()" /><br/>
    <textarea rows="4" name="plantext_vigenere" id="plantext_vigenere" cols="33" onclick="SelectAll('plantext_vigenere')" >plan text...</textarea><br/>
    <input type="submit" name="encrypt_vigenere" value="Encrypt" /><input type="submit" name="decrypt_vigenere" value="Decrypt" /><input type="reset" value="Reset" />
    </form>
    </fieldset>
    </td></tr>
    <!-- masih dalam pengerjaan :p
    <tr><td valign="top">
    <fieldset>
    <legend><b>Playfair</b></legend>
    <form action="" method="post">
    <input type="text" name="key_playfair" id="key_playfair" value="the key..." onclick="SelectAll('key_playfair')" /><br/>
    <textarea rows="4" name="plantext_playfair" id="plantext_playfair" cols="33" onclick="SelectAll('plantext_playfair')" >plan text...</textarea><br/>
    <input type="submit" name="encrypt_playfair" value="Encrypt" /><input type="submit" name="Decrypt_playfair" value="Decrypt" /><input type="reset" value="Reset" />
    </form>
    </fieldset>
    </td></tr>
    -->
    </table>
</body>
</html>