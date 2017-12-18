<?php
$current_options = wp_parse_args(  get_option( 'busiprof_theme_options', array() ), theme_setup_data() );
if( $current_options['home_banner_strip_enabled'] == 'on' && $current_options['slider_head_title'] != '' ) { ?>
<div class="clearfix"></div>
<!-- Slider -->
<?php } $banner_list = get_banner(); if(!empty($banner_list) || $current_options['slider_image']!='' ) { ?>
<div id="main" role="main">
    <?php if(empty($banner_list)){ ?>
	<section class="slider">
		<ul class="slides">
            <li>
                <img alt="img" src="<?php echo esc_url($current_options['slider_image']); ?>" />
                <div class="container">
                    <div class="slide-caption">
                        <?php if($current_options['caption_head']!='') {?>
                        <h2><?php echo esc_html($current_options['caption_head']); ?></h2>
                        <?php } if($current_options['caption_text']!='') {?>
                        <p><?php echo esc_html($current_options['caption_text']); ?></p>
                        <?php } ?>
                        <?php if($current_options['readmore_text_link']!=''){ ?>
                        <div><a href="<?php echo esc_url($current_options['readmore_text_link']); ?>" target="_blank" class="flex-btn"><?php echo esc_html($current_options['readmore_text']); ?></a>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </li>
        </ul>
	</section>
    <?php }else{ $banner_css_src = get_template_directory_uri() . '/css/custom/css/focusStyle.css';?>

    <link rel="stylesheet" href="<?php echo $banner_css_src; ?>" type="text/css">
    <div id="focus-banner">
        <ul id="focus-banner-list">
            <?php foreach ($banner_list as $k => $v){?>
            <li> <a href="#" class="focus-banner-img"> <img src="<?php echo $v['guid'];?>" alt=""> </a>
                <div class="focus-banner-text">
                    <p></p>
                </div>
            </li>
            <?php }?>
        </ul>
        <a href="javascript:;" id="next-img" class="focus-handle"></a> <a href="javascript:;" id="prev-img" class="focus-handle"></a>
        <ul id="focus-bubble">
        </ul>
    </div>

    <script type="text/javascript">
        var $=jQuery.noConflict();
        $(function(){
            var focusBanner=function(){
                var $focusBanner=$("#focus-banner"),
                    $bannerList=$("#focus-banner-list li"),
                    $focusHandle=$(".focus-handle"),
                    $bannerImg=$(".focus-banner-img"),
                    $nextBnt=$("#next-img"),
                    $prevBnt=$("#prev-img"),
                    $focusBubble=$("#focus-bubble"),
                    bannerLength=$bannerList.length,
                    _index=0,
                    _timer="";

                var _height=$(".focus-banner-img").find("img").height();
                $focusBanner.height(_height);
                $bannerImg.height(_height);

                for(var i=0; i<bannerLength; i++){
                    $bannerList.eq(i).css("zIndex",bannerLength-i);
                    $focusBubble.append('<li><a href="javascript:;">'+i+'</a></li>');
                }
                $focusBubble.find("li").eq(0).addClass("current");
                var bubbleLength=$focusBubble.find("li").length;
                $focusBubble.css({
                    //"width":bubbleLength*22,
                    "marginLeft":-bubbleLength*11
                });//初始化

                $focusBubble.on("click","li",function(){
                    $(this).addClass("current").siblings().removeClass("current");
                    _index=$(this).index();
                    changeImg(_index);
                });//点击轮换

                $prevBnt.on("click",function(){
                    _index++
                    if(_index>bannerLength-1){
                        _index=0;
                    }
                    changeImg(_index);
                });//下一张

                $nextBnt.on("click",function(){
                    _index--
                    if(_index<0){
                        _index=bannerLength-1;
                    }
                    changeImg(_index);
                });//上一张

                function changeImg(_index){
                    $bannerList.eq(_index).fadeIn(250);
                    $bannerList.eq(_index).siblings().fadeOut(200);
                    $focusBubble.find("li").removeClass("current");
                    $focusBubble.find("li").eq(_index).addClass("current");
                    clearInterval(_timer);
                    _timer=setInterval(function(){$nextBnt.click()},5000)
                }//切换主函数
                _timer=setInterval(function(){$nextBnt.click()},5000);


                function isIE() { //ie?
                    if (!!window.ActiveXObject || "ActiveXObject" in window)
                        return true;
                    else
                        return false;
                }

                if(!isIE()){
                    $(window).resize(function(){
                        window.location.reload();
                    });
                }else{
                    if(!+'\v1' && !'1'[0]){
                        alert("老铁什么年代啦还在搞ie8以下版本啊！")
                    } else{
                        $(window).resize(function(){
                            window.location.reload();
                        });
                    };
                }

            }();
        })
    </script>
    <?php } ?>
</div>
<!-- End of Slider -->
<div class="clearfix"></div>
<?php } else{

	?>
<?php
} ?>
<section class="header-title"><h2><?php echo esc_html($current_options['slider_head_title']); ?> </h2></section>
<div class="clearfix"></div>