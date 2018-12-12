<?php
if (!defined('InternalAccess')) exit('error: 403 Access Denied');
?>
<!-- main-content start -->
<script>
var AllowEmptyTags = <?php echo $Config["AllowEmptyTags"]; ?>;//允许空话题
var MaxTagNum = <?php echo $Config["MaxTagsNum"]; ?>;//最多的话题数量
var MaxTitleChars = <?php echo $Config['MaxTitleChars']; ?>;//主题标题最多字节数
var MaxPostChars = <?php echo $Config['MaxPostChars']; ?>;//主题内容最多字节数
loadScript("<?php echo $Config['WebsitePath']; ?>/static/editor/ueditor.config.js?version=<?php echo CARBON_FORUM_VERSION; ?>",function() {
	loadScript("<?php echo $Config['WebsitePath']; ?>/static/editor/ueditor.all.min.js?version=<?php echo CARBON_FORUM_VERSION; ?>",function(){
		loadScript("<?php echo $Config['WebsitePath']; ?>/language/<?php echo ForumLanguage; ?>/<?php echo ForumLanguage; ?>.js?version=<?php echo CARBON_FORUM_VERSION; ?>",function(){
			loadScript("<?php echo $Config['WebsitePath']; ?>/static/js/default/new.function.js?version=<?php echo CARBON_FORUM_VERSION; ?>",function(){
				$("#editor").empty();
				InitNewTopicEditor();
				$.each(<?php echo json_encode(ArrayColumn($HotTagsArray, 'Name')); ?>,function(Offset,TagName) {
					TagsListAppend(TagName, Offset);
				});
				console.log('editor loaded.');
			});
		});
	});
});
</script>
<div class="main-content">
		<div class="main-box">
			<form name="NewForm" onkeydown="if(event.keyCode==13)return false;">
			<input type="hidden" name="FormHash" value="<?php echo $FormHash; ?>" />
			<input type="hidden" name="ContentHash" value="" />
			<p><input type="text" name="Title" id="Title" value="<?php echo htmlspecialchars($Title); ?>" style="width:624px;" placeholder="<?php echo $Lang['Title']; ?>" /></p>
		</div>
			<div id="editor" style="width:100%;height:320px;">Loading……</div>
			<script type="text/javascript">
			var Content='<?php echo $Content; ?>';
			</script>
		<div class="main-box" style="margin-top:20px;">
			<p>
				<div class="tags-list bth" style="width:624px;height:33px;border-bottom-width:2px;" onclick="JavaScript:document.NewForm.AlternativeTag.focus();">
					<span id="SelectTags" class="btn"></span>
					<input type="text" name="AlternativeTag" id="AlternativeTag" value="" class="tag-input" onfocus="JavaScript:GetTags();" placeholder="<?php echo $Lang['Add_Tags']; ?>" />
				</div>
			</p>
			<p>
				<div id="TagsList" class="btn">
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
			<p><div class="text-center"><input type="button" value="<?php echo $Lang['Submit']; ?>(Ctrl+Enter)" name="submit" class="textbtn" id="PublishButton"/></div><div class="c"></div></p>
			</form>
	</div>
</div>
<!-- main-content end -->
<!-- main-sider start -->
<div class="main-sider">
	<?php include($TemplatePath.'sider.php'); ?>
</div>
<!-- main-sider end -->