<?php
  require 'autoload.php';
  use Qiniu\Auth;
  use Qiniu\Storage\UploadManager;
  $accessKey = '_NXM--4S18dy8BPsik61OlCwAXIJg6J3QlX2LP7R';
  $secretKey = 'AAtfDVxv45Xmb0O7s8ygy-e7__xZU3C11WnDTU6Q';
  $auth = new Auth($accessKey, $secretKey);
  // 空间名  https://developer.qiniu.io/kodo/manual/concepts
  $bucket = 'a10086';
  // 生成上传Token
  $token = $auth->uploadToken($bucket);

  