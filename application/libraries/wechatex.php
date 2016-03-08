<?php
include APPPATH.'libraries\wechat.php';
class WechatEx extends Wechat{
  const EVENT_SUBSCRIBE = 'SUBSCRIBE';//关注订阅号
  const EVENT_UNSUBSCRIBE = 'UNSUBSCRIBE';//已关注后取消关注
  const EVENT_SCAN= 'SCAN';//关注后再扫描
  const EVENT_CLICK= 'CLICK';//点击推事件
  const EVENT_VIEW= 'VIEW';//跳转URL

  const EVENT_LOCATION= 'LOCATION';//用户同意上传位置信息后，服务器每5秒触发一次推送

  const EVENT_SCANCODE_PUSH= 'SCANCODE_PUSH';//用户点击自定义扫码按钮，扫码推事件
  const EVENT_SCANCODE_WAITMSG= 'SCANCODE_WAITMSG';//扫码时弹出消息等待提示框
  const EVENT_PIC_SYSPHOTO = 'PIC_SYSPHOTO';//弹出系统拍照发图
  const EVENT_PIC_PHOTO_OR_ALBUM = 'PIC_PHOTO_OR_ALBUM';//弹出拍照或者相册发图
  const EVENT_PIC_WEIXIN = 'PIC_WEIXIN'; //弹出微信相册发图器

  const EVENT_LOCATION_SELECT = 'LOCATION_SELECT';//弹出地理位置选择器

  function __construct($options)
{
  parent::__construct($options);
}

  public function run()
{
  $this->valid();
  $type = $this -> getRev() ->getRevType();
  switch ($type) {
    case Wechat::MSGTYPE_TEXT:
      $this->onText();
      break;
    case Wechat::MSGTYPE_EVENT:
    $info = $this ->getRevEvent();//event,key
    if (isset($info['event'])){
      switch(strtoupper($info['event'])){
        case self::EVENT_SUBSCRIBE:
          $this->onSubscribe();
          break;
        case self::EVENT_UNSUBSCRIBE:
          $this->onUnsubscribe();
          break;
          //关注后再次扫描
        case self::EVENT_SCAN:
          $this->onScan();
          break;

        case self::EVENT_LOCATION:
          $this->onLocation();
          break;
          //点击菜单时：CLICK
        case self::EVENT_CLICK:
          $this->onClick();
          break;

          //点击菜单跳转链接时的事件推送
        case self::EVENT_VIEW:
          $this->onView();
          break;
        case self::EVENT_SCANCODE_PUSH:
          $this->onScanCodePush();
          break;
        case self::EVENT_SCANCODE_WAITMSG:
          $this->onScanCodeWaitMsg();
          break;
        case self::EVENT_PIC_SYSPHOTO:
          $this->onPicSysPhoto();
          break;
        case self::EVENT_PIC_PHOTO_OR_ALBUM:
          $this->onPicPhotoOrAlbum();
          break;
        case self::EVENT_PIC_WEIXIN:
          $this->onPicWeixin();
          break;
        case self::EVENT_LOCATION_SELECT:
          $this->onLocationSelect();
          break;
        default:
          $this->onUnknown();
                                        }
                              }
    case Wechat::MSGTYPE_IMAGE:
      $this->onImage();
      break;
    case Wechat::MSGTYPE_LOCATION:
      $this->onLocation();
      break;
    case Wechat::MSGTYPE_LINK:
      $this->onLink();
      break;
    case Wechat::MSGTYPE_VOICE:
      $this->onVoice();
      break;
    case Wechat::MSGTYPE_VIDEO:
      $this->onVideo();
       break;
    default:
      $this->onUnknown();
  }
}

protected function onScanCodePush(){$this->defaultReply();}
protected function onScanCodeWaitMsg(){$this->defaultReply();}

protected function onPicWeixin(){$this->defaultReply();}
protected function onPicSysPhoto(){$this->defaultReply();}
protected function onPicPhotoOrAlbum(){$this->defaultReply();}

protected function onLocationSelect(){$this->defaultReply();}
//用户关注时触发，用于子类重写

protected function onSubscribe(){
  $this->defaultReply();
}

protected function onUnsubscribe() {
  $this->defaultReply();
}

protected function onClick(){
  $this->defaultReply();
}

protected function onView() {
  $this->defaultReply();
}

protected function onScan(){
  $this->defaultReply();
}

protected function onText() {
  $this->defaultReply();
}

protected function onImage() {
  $this->defaultReply();
}

protected function onVoice() {
  $this->defaultReply();
}

protected function onVideo() {
  $this->defaultReply();
}

protected function onLocation() {
  $this->defaultReply();
}

protected function onLink() {
  $this->defaultReply();
}

protected function onUnknown() {
  $this->defaultReply();
}

protected function defaultReply() {
  $this->text('')->reply();
}

}
?>
