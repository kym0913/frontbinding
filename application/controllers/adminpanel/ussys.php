<?php
class ussys extends CI_Controller{
	private $openid="请在微信菜单签到中打开";
	var $method_config;
	function __construct()
	{
		parent::__construct();


//拉去用户openid 与数据库对比，是的话就显示index，没有就显示add
//		$this->load->model(array('Times_model'));
	//	$this->load->helper(array('member','auto_codeIgniter','string'));

	//	$this->method_config['upload'] = array(
//										'thumb'=>array('upload_size'=>1024,'upload_file_type'=>'jpg|png|gif','upload_path'=>'uploadfile/user','upload_url'=>SITE_URL.'uploadfile/user/'),
	//									);
	}




	function index()
	{


		if (isset($_GET['code'])){
				$code=$_GET['code'];
				file_put_contents('code.json', '{"code": "'.$code.'"}');
				$this->choose();


		}else{
		    file_put_contents('code.json', '{"code": "no code"}');
		}
	}

	function choose(){
		$res = file_get_contents('code.json');
		$result = json_decode($res, true);
		$codenow = $result["code"];

		$getopenid = $this->http_get('https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx7cf2f38dcfb28d91&secret=3b67147276b813bf88a711e00fc17a57&code='.$codenow.'&grant_type=authorization_code');
		if ($getopenid)
		{
			$json = json_decode($getopenid,true);
			@$openid=$json['openid'];
			file_put_contents('openid.json', '{"openid": "'.$openid.'"}');
			if (!$json || isset($json['errcode']))
			{
			file_put_contents('openid.json', '{"openid": "no openid"}');
			}
			$this->openid=$openid;
		}
		$query = $this->db->query('select * from t_sys_memberbd  where mems_openid ="'.$openid.'"');
		$list=$query->result();
		if(count($list)==1)
		{
			$this->ussed();
		}else
		{
			$this->add();
		}



	}

	function http_get($url)
	{
		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
		}
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		if(intval($aStatus["http_code"])==200){
			return $sContent;
		}else{
			return false;
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
					<title>签到la</title>


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

								if(isset($_POST['submit'])&&$_POST['submit']=="提交")
								{
									$txt_username=strip_tags(trim($_POST['txtusername']));
									$txt_company=strip_tags(trim($_POST['company']));
									$txt_mobile=strip_tags(trim($_POST['mobile']));
									$txt_openid=$_POST['hid'];
									$txt_totaltime="0";

if($txt_openid=='请在微信菜单签到中打开'){}else{

									$data = array(
										'mems_name' => $txt_username,
										'mems_company' => $txt_company,
										'mems_phone' => $txt_mobile,
										'mems_openid' => $txt_openid,
										'mems_totaltime' => $txt_totaltime,
																);

									$res=$this->db->insert('t_sys_memberbd', $data);

								}
							}
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
			<script language="javascript" src="/scripts/adminpanel/ussys/edit.js"></script>
			<style>
			.prompt{
				margin:5;
			}
			</style>


	</head>
	<body>
		<form class="form-horizontal" role="form" id="validateform" name="validateform" action="http://km0913.imwork.net/adminpanel/ussys/add" method="post" >
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
									<input name="openid" id="openid" type="text" class="form-control" value="<?php echo $this->openid ?>" disabled="true"/>
									<input type="hidden" id="hid" name="hid" value="<?php echo $this->openid ?>" />
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


	<?php
}


}
?>
