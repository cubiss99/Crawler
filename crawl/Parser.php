<?php

abstract class Parser
{
    // Function to make GET request using cURL
    function curlGet($url)
    {
        $ch = curl_init();    // Khoi tao cURL session
        // Set gia tri tham so cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $results = curl_exec($ch);    // Executing cURL session
        curl_close($ch);  // Dong cURL session
        return $results;  // tra ve html
    }


    // Function to return XPath object
    function returnXPathObject($item)
    {
        $xmlPageDom = new DOMDocument();    // khoi tao DomDocument object
        libxml_use_internal_errors(true); // dom chuyen tu html5 -> html4
        @$xmlPageDom->loadHTML('<?xml encoding="utf-8" ?>' . $item);    // Loading html page
        $xmlPageXPath = new DOMXPath($xmlPageDom);  // khoi tao XPath DOM object
        return $xmlPageXPath;    // tra ve XPath object
    }
    function insertToDB($website, $title, $category, $description, $content, $date)
    {
        // ket noi mysql
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "crawler";
        $conn = mysqli_connect($servername, $username, $password, $database);

        // chuyen dau nhay ' -> \'
        $content = mysqli_real_escape_string($conn, $content);
        $title = mysqli_real_escape_string($conn, $title);
        $description = mysqli_real_escape_string($conn, $description);
        // insert database
        $sql = "insert into article values(null, '" . $website . "', '" . "" . $title . "', '" . $category . "','" . $description . "', '" . $content . "', '" . $date . "')";
        $result = mysqli_query($conn, $sql);
        if ($result) echo '<script>alert("thành công !!!");</script>;';
        else echo '<script>alert("thất bại ' . $sql . '!!!");</script>;';
    }
    abstract public function articleParser($url);
}
