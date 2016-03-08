<?php
include APPPATH.'libraries/wechatex.php';
class MyWechat extends WechatEx {
  private $_ci;
  function __construct($options){
    parent::__construct($options);
    if (function_exists("get_instance") && defined("APPPATH")){
      $this->_ci =& get_instance();
      //$this->_ci->load->model('product_model', 'product');
      //$this->_ci->load->model('post_model', 'post');
                                                              }
                                 }
 protected function onSubscribe()
{
   $this->text('Hi,你终于来了~[Heart]感谢你关注怡雅，我们将为你带来怡雅最新的实时动态，行业前沿的热点剖析，努力为你创造全新的阅读平台，欢迎你与我们交流互动！')->reply();
}
 protected function onUnsubscribe()
{
   $this->text('悄悄地我走了，正如我悄悄地来。')->reply();
}
 protected function onText(){
   $this->text('您的消息我们会尽力一一回复')->reply();
 }
 protected function onImage(){
   $this->text("this's an image")->reply();
 }
 protected function onLocation()
{
   $info = $this->getRevGeo();
   $this->text("收到了位置消息：({$info['x']},{$info['y']})")->reply();
}
 protected function onLink()
{
   $info = $this->getRevLink();
   $url = $info['url'];
   $this->text("收到链接消息：({$info['url']},{$info['title']},{$info['description']})")->reply();
}
 protected function onVoice()
{
   $info = $this->getRevVoice();
   $this->text("收到链接消息：({$info['mediaid']},{$info['format']})")->reply();
}
protected function onUnknown()
{
  $this->text('收到未知消息')->reply();
}
//下面是cache的保存，微信服务器获取token次数有限


//真实微信号里只要有的事件，具体逻辑就可以写到这里。
}





?>
