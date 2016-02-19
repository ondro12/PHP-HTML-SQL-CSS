<?php

return "
<!DOCTYPE html>
<html>
<head>
<style>
#login {
      width: 300px;
      float: right;
      background-color: #FFFF00;
}
#cart {
      margin-top: 10px;
      width: 300px;
      float: right;
      clear: both;
      background-color: #0066CC;
}
#content {
  width:900px;
  margin:auto;
  background-color: #00CC66;
}
</style>
<title>$pageData->title</title>
</head>
<meta http-equiv='content-type' content='text/html;charset=utf-8' />
<body>
<div id='content'>
  <div id='login'>
    $pageData->login
  </div>
  <div id='cart'>
    $pageData->cart
  </div>
    $pageData->content
</div>
</body>
</html>";