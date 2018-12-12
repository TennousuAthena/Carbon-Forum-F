<?php
if (!defined('InternalAccess')) exit('error: 403 Access Denied');
?>
<script type="text/javascript">
	var AllowEmptyTags = <?php echo $Config["AllowEmptyTags"]; ?>;//允许空话题
	var MaxTagNum = <?php echo $Config["MaxTagsNum"]; ?>;//最多的话题数量
	var MaxTitleChars = <?php echo $Config['MaxTitleChars']; ?>;//主题标题最多字节数
	var MaxPostChars = <?php echo $Config['MaxPostChars']; ?>;//主题内容最多字节数
	loadScript("<?php echo $Config['WebsitePath']; ?>/static/js/mobile/topic.function.js?version=<?php echo CARBON_FORUM_VERSION; ?>", function() {
		$.each(<?php echo json_encode(ArrayColumn($HotTagsArray, 'Name')); ?>,function(Offset,TagName) {
			TagsListAppend(TagName, Offset);
		});
	});
</script>
<form name="NewForm">
	<input type="hidden" name="FormHash" value="<?php echo $FormHash; ?>" />
	<input type="hidden" name="ContentHash" value="" />
	<p><input type="text" name="Title" id="Title" value="<?php echo htmlspecialchars($Title); ?>" placeholder="<?php echo $Lang['Title']; ?>" /></p>
	<p>
		<label class="button block" style="cursor: pointer;">
			<i class="icon picture"></i>
			<input type="file" id="upfile" onchange="javascript:UploadPicture('Content');" accept="image/*" style="display:none;" />
		</label>
	</p>
	<p>
		<textarea name="Content" id="Content" rows="10" placeholder="<?php echo $Lang['Content']; ?>"></textarea>
	</p>
	<p>
		<input type="text" name="AlternativeTag" id="AlternativeTag" value="" onclick="JavaScript:GetTags();" placeholder="<?php echo $Lang['Add_Tags']; ?>" />
		<ul id="SelectTags" class="list">
			<li class="divider"><?php echo $Lang['Tags']; ?></li>
		</ul>
	</p>
	<p>
		<div id="TagsList">
		</div>
	</p>
    <?php if($Config['CAPTCHAmethod']== 'geetest' && $Config['GeetestID']!= 'null' && $Config['GeetestKey']!= 'null'){ ?>
        <p class="text-center">
        <div id="embed-captcha"></div>
        <p id="wait" class="show">正在加载验证码......</p>
        <p id="notice" class="hide">请先完成验证</p>

        <script type="text/javascript">
            var handlerEmbed = function (captchaObj) {
                $("#PublishButton").click(function (e) {
                    var validate = captchaObj.getValidate();
                    if (!validate) {
                        $("#notice")[0].className = "show";
                        setTimeout(function () {
                            $("#notice")[0].className = "hide";
                        }, 2000);
                        e.preventDefault();
                    }else{
                        CreateNewTopic();
                    }
                });
                // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
                captchaObj.appendTo("#embed-captcha");
                captchaObj.onReady(function () {
                    $("#wait")[0].className = "hide";
                });
                captchaObj.onError(function () {
                    alert("验证码出错啦！请刷新重试");
                });
                // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
            };
            $.ajax({
                // 获取id，challenge，success（是否启用failback）
                url: "/geetest?t=" + (new Date()).getTime(), // 加随机数防止缓存
                type: "get",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    // 使用initGeetest接口
                    // 参数1：配置参数
                    // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
                    initGeetest({
                        gt: data.gt,
                        challenge: data.challenge,
                        new_captcha: data.new_captcha,
                        product: "embed", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                        offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                        // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
                    }, handlerEmbed);
                }
            });
        </script>
        <script src="<?php echo $Config['WebsitePath']; ?>/static/js/gt.js"></script>
    <?php } ?>
	<p><input type="button" value="<?php echo $Lang['Submit']; ?>" name="submit" class="button block green" id="PublishButton" style="width:100%;" /></p>
</form>