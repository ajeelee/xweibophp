<?php 
if(!defined('IN_APPLICATION')){
	exit('ACCESS DENIED!');
}
$web_page_title = isset($pageInfo['page_name']) ?  APP::F('escape', $pageInfo['page_name']) : null;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo F('web_page_title', null, $web_page_title);?></title>
<?php TPL::plugin('include/css_link');?>
<?php TPL::plugin('include/js_link');?>
<link href="<?php echo W_BASE_URL;?>css/default/pub.css" rel="stylesheet" type="text/css" />
<?php 
// 专题自定义背景
if (isset($pageInfo) && $pageInfo['params'] && ($params = json_decode($pageInfo['params'],true)) && isset($params['bg']) && !empty($params['bg'])) {
	$aligh=array('','left','center','right');
	$s = sprintf("html{background:url('%s') %s top %s %s;}",
							 $params['bg'],
							 (isset($params['fixed'])&&$params['fixed']==1)?'fixed':'',
							 isset($params['align'])?$aligh[$params['align']]:'left',
							 isset($params['repeat'])&&$params['repeat']==1?'repeat':'no-repeat'
							 );
	echo '<style>' .$s. '</style>';
	
}?>
</head>
<body id="custom">
	<div id="wrap">
		<div class="wrap-in">
			<!-- 头部 开始-->
			<?php TPL::plugin('include/header'); ?>
            <!-- 头部 结束-->
			<div id="container">
				<div class="extra">
					<!-- 站点导航 开始 -->
					<?php Xpipe::pagelet('common.siteNav'); ?>
					<!-- 站点导航 结束 -->
				</div>
				<div class="content">
					<div class="main-wrap">
                        <div class="main">
                            <div class="main-bd">
							<?php
                        if (isset($main_modules) && is_array($main_modules)) {
	                		foreach ($main_modules as $key => $mod) {
	                			Xpipe::pagelet('component/component_'. $mod['component_id']. '.run', $mod );
	                			//广告
								if ($mod['component_id'] == 10) {
									echo F('show_ad', 'today_topic', 'xad-box xad-box-p2');
								}
	             			}
                        }
                        ?>
							</div>
                        </div>
						<div class="aside">
							<!-- 用户信息 开始-->
							<?php TPL::module('user_preview'); ?>
							<!-- 用户信息 结束-->
							
                        <?php
                        if (isset($side_modules) && is_array($side_modules)) {
	                		foreach ($side_modules as $key => $mod) {
	                			Xpipe::pagelet('component/component_'. $mod['component_id']. '.run', $mod );
	             			}
                        }
                        ?>
							<?php echo F('show_ad', 'sidebar', '');?>
						</div>
					</div>
				</div>
			</div>
			<!-- 尾部 开始 -->
			<?php TPL::module('footer');?>
			<!-- 尾部 结束 -->
		</div>
	</div>
	<?php TPL::module('gotop');?>
</body>
</html>
