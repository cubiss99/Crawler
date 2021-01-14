<?php
if (isset($_GET['no'])) {
    

    $this->$xoa = "UPDATE `title` SET `category`='',`description`='',`content`='',`date`='' WHERE no =".$_GET['no'];
    insert_remove($xoa);
}