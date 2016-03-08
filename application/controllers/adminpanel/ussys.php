<?php
class ussys extends CI_Controller{

	var $method_config;
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Memberbp_model'));

//拉去用户openid 与数据库对比，是的话就显示index，没有就显示add
//		$this->load->model(array('Times_model'));
	//	$this->load->helper(array('member','auto_codeIgniter','string'));

	//	$this->method_config['upload'] = array(
//										'thumb'=>array('upload_size'=>1024,'upload_file_type'=>'jpg|png|gif','upload_path'=>'uploadfile/user','upload_url'=>SITE_URL.'uploadfile/user/'),
	//									);
	}




	function index()
	{
		$a=false;
		if($a)
		{
				$this->ussed();
		}else{
				$this->add();
		}
	}

	function ussed(){
		?>

		<!DOCTYPE html>
		<html lang="en">
			<head>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
					<link rel="stylesheet" href="/css/weui.css"/>
					<title>签到系统</title>


			</head>
			<body ontouchstart>
				<div style="margin:55% auto;">
					<a href="javascript:;" class="weui_btn weui_btn_primary" style="width:300px;">签到</a>
				</div>
			</body>
		</html>
		<?php
	}

function add(){
	?>
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



	</head>
	<body>
		<form class="form-horizontal" role="form" id="validateform" name="validateform" action="ussys.php" >
		<div class='panel panel-default'>
			<div class='panel-body'>
				<fieldset>
						<legend>基本信息</legend>
							<div class="form-group">
								<label class="col-sm-2 control-label">姓名</label>
								<div class="col-sm-4">
									<input type="text" name="username"  id="username"  class="form-control validate[required]"  placeholder="请输入用户名" >
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">公司</label>
								<div class="col-sm-4">
									<input type="text" name="company"  id="company"  class="form-control"  placeholder="请输入公司名称" >
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">手机号</label>
								<div class="col-sm-4">
									<input name="mobile" type="text" class="form-control  validate[required,custom[mobile]]" placeholder="请输入手机号" size="45" />
								</div>
							</div>



					</fieldset>



				<div class='form-actions'>
				<a href="javascript:;" class="weui_btn weui_btn_primary">提交</a>
				</div>
		     </div>

		</form>
		<script language="javascript" type="text/javascript">

			var id = <?php echo $data_info['user_id']?>;
			var edit= <?php echo $is_edit?"true":"false"?>;
			var folder_name = "adminpanel";
			function getThumb(v,s,w,h){
				$("#thumb").val(v);
				$("#thumb_SRC").attr("src","<?php echo $this->method_config['upload']['thumb']['upload_url']?>"+v);
				$("#dialog" ).dialog("close");
			}

			require(['<?php echo SITE_URL?>scripts/common.js'], function (common) {
				require(['<?php echo SITE_URL?>scripts/adminpanel/ussys/edit.js']);
			});
		</script>
	</body>
	</html>


	<?php
}


}
?>
