<?php
class ussys extends Front_Controller{
	private $openid="请在微信菜单签到中打开";
	var $method_config;
	function __construct()
	{
		parent::__construct();
	}




	function index()
	{


		if (isset($_GET['code'])){
				$code=$_GET['code'];
				file_put_contents('code.json', '{"code": "'.$code.'"}');
				$this->choose();


		}else{
		    file_put_contents('code.json', '{"code": "no code"}');
				echo "没接收到code";
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
			$errcode=isset($json['errcode'])?$json['errcode']:'no cause';
			file_put_contents('openid.json', '{"openid": "'.$errcode.'"}');
			}
			$this->openid=$openid;
		}
		$query = $this->db->query('select * from t_sys_memberbd  where mems_openid ="'.$openid.'"');
		$list=$query->result();
		if(count($list)==1)
		{
		$this->view('ussed');
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



	function dismess($message)
	{
		echo"<script>window.alert('".$message."');</script>";
	}


	function GoOrRefreshPage($time,$pagename)
	{
		echo"<META HTTP-EQUIV=REFRESH CONTENT='".$time.";URL=".$pagename."'>";
	}


function add(){

								if(isset($_POST['submit'])&&$_POST['submit']=="提交")
								{
									$txt_username=strip_tags(trim($_POST['txtusername']));
									$txt_company=strip_tags(trim($_POST['company']));
									$txt_mobile=strip_tags(trim($_POST['mobile']));
									$txt_openid=$_POST['hid'];
									$txt_totaltime="0";

									if($txt_openid=='请在微信菜单签到中打开'){
										$this->dismess('请在微信菜单签到中打开');
									}else{
									$data = array(
										'mems_name' => $txt_username,
										'mems_company' => $txt_company,
										'mems_phone' => $txt_mobile,
										'mems_openid' => $txt_openid,
										'mems_totaltime' => $txt_totaltime,
																);

									$res=$this->db->insert('t_sys_memberbd', $data);

									if($res){
										$this->dismess('提交成功！');
										$this->GoOrRefreshPage(0,'http://km0913.imwork.net/ussys/index');
									}

								}
							}
									$this->view('add',array('openid'=>$this->openid));
}


}
?>
