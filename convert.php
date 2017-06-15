<?php
/*
 *      convert.php
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
  
function char_to_dec($a){
    $i=ord($a);
    if ($i>=97 && $i<=122){
        return ($i-96);
    } else if ($i>=65 && $i<=90){
        return ($i-38);
    } else {
        return null;
    }
}
 
function dec_to_char($a){
    if ($a>=1 && $a<=26){
        return (chr($a+96));
    } else if ($a>=27 && $a<=52){
        return (chr($a+38));
    } else {
        return null;
    }
}
 
function tabel_vigenere_encrypt($a, $b){
    $i=$a+$b-1;
    if ($i>26){
        $i=$i-26;
    }
    return (dec_to_char($i));
}
function tabel_vigenere_decrypt($a, $b){
    $i=$a-$b+1;
    if ($i<1){
        $i=$i+26;
    }
    return (dec_to_char($i));
}
 
?>