$(function(){
	var num=$('#banner ul li').length;
	var imgw=$('#banner div.bimg').width();
	var settime=null;
	var i=0;
	//控制切切换
	$('#banner ul').width(imgw*num);
	$('.ctrl span').click(function(){
		i=$(this).index();
		$(this).addClass('active').siblings('span').removeClass('active');
		$('#banner ul').animate({left:"-"+(i*imgw)+'px'},1000);
	});
	//自动轮播
	function autoplay(){
		settime=setInterval(function(){
			i++;
			if(i<num){
				$('#banner ul').animate({left:"-"+(i*imgw)+'px'},1000);
				$('.ctrl span').eq(i).addClass('active').siblings('span').removeClass('active');
			}else{
				i=0;
				$('#banner ul').animate({left:"-"+(i*imgw)+'px'},1000);
				$('.ctrl span').eq(i).addClass('active').siblings('span').removeClass('active');
			}
		},4000);
	}
	//鼠标经过时停止
	$('#banner').hover(function(){clearInterval(settime);},function(){autoplay();});

	//调用轮播
	autoplay();
});

window.onload=function(){
var a = document.getElementById("right").offsetHeight;
var b = document.getElementById("left").style.height = a + 'px';	
}
$(function(){
	var _index = 0;
	$(".pro_ul .pro_li").siblings(".pro_li").hide();
	$(".pro_ul .pro_li").eq(0).show().siblings(".fade_img").hide();
	$(".pro_ul .ul1 li").mouseover(function(){
		_index=$(this).index();
		$(this).stop().addClass("lick").siblings().removeClass("lick");
		$(this).parent().parent().find(".pro_li").eq(_index).show().siblings(".pro_li").hide();
	});

/*
$(".left_nav ul.down li").click(function(){
	$(this).addClass("down_li").siblings("ul.down li").removeClass("down_li");
	if($(this).find("ul.down1").is(":hidden")){
		$(this).find("ul.down1").slideToggle();									 
	}else{
		$(this).find("ul.down1").slideToggle();									 
	}


	var w = 0;
	$(".xqy_img").eq(0).show().siblings(".xqy_img").hide();
	$(".xqy_gg ul li").click(function(){
		w=$(this).index();
		$(this).addClass("li_borr").siblings().removeClass("li_borr");
		$(this).parent().parent().find(".xqy_img").eq(w).fadeIn().siblings(".xqy_img").fadeOut();
	});


})*/


	var G = 0;
	$(".xqy_img").eq(0).show().siblings(".xqy_img").hide();
$(".xqy_gg li").click(function(){
	G = $(this).index();
	$(this).addClass("li_borr").siblings().removeClass("li_borr");
	$(".xqy_img").eq(G).show().siblings(".xqy_img").hide();
})
})

//sql防注入
var url = location.search;
var re=/^\?(.*)(select%20|insert%20|delete%20from%20|count\(|drop%20table|update%20truncate%20|asc\(|mid\(|char\(|xp_cmdshell|exec%20master|net%20localgroup%20administrators|\"|:|net%20user|\|%20or%20)(.*)$/gi;
var e = re.test(url);
if(e) {
    alert("地址中含有非法字符～");
    location.href="index.php";
}
