<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>用户绑定</title>
    <link rel="stylesheet" href="/css/weui.css"/>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css">
    <link type="text/css" href="/css/jquery-ui-1.10.0.custom.css" rel="stylesheet" />
    <link type="text/css" href="/css/weui.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/adminpanel/style.css">
    <script language="javascript" type="text/javascript"> var SITE_URL = "/";</script>
    <script src="/scripts/require.js" ></script>
    <script language="javascript" src="/scripts/adminpanel/ussys/edit.js"></script>
    <style>
    .prompt{
      margin:5;
    }
    </style>


</head>
<body>
  <form class="form-horizontal" role="form" id="validateform" name="validateform" action="http://km0913.imwork.net/ussys/add" method="post" >
  <div class='panel panel-default'>
    <div class='panel-body'>
      <fieldset>
          <legend>基本信息</legend>
            <div class="form-group">
              <label class="col-sm-2 control-label">用户名</label>
              <div class="col-sm-4">
                <input type="text" name="txtusername"  id="txtusername"  class="form-control validate[required]"  placeholder="请输入用户名" >
                <h5 id="nameprompt" class="prompt"></h5>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">公司</label>
              <div class="col-sm-4">
                <input type="text" name="company"  id="company"  class="form-control"  placeholder="请输入公司名称" >
                <h5 id="comprompt" class="prompt"></h5>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">手机号</label>
              <div class="col-sm-4">
                <input name="mobile" id="mobile" type="text" class="form-control" placeholder="请输入手机号" size="45" />
                <h5 id="phoneprompt" class="prompt"></h5>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">openid</label>
              <div class="col-sm-4">
                <input name="openid" id="openid" type="text" class="form-control" value="<?php echo $openid; ?>" disabled="true"/>
                <input type="hidden" id="hid" name="hid" value="<?php echo $openid; ?>" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">总时长</label>
              <div class="col-sm-4">
                <input name="totaltime" id="totaltime" type="text" class="form-control" value="0" disabled="true"/>

              </div>
            </div>

        </fieldset>



      <div class='form-actions'>
      <input type="submit" value="提交" name="submit"  class="weui_btn weui_btn_primary"/>


      </div>
       </div>

  </form>

</body>
</html>
