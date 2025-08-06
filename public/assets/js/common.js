(function( $ ){
$(function(){
	h_pos();
	popup();

	
	
	$(window).load(function(){
		nopi();
		h_pos();
		resizeWindow();
	
	});
	
	$(window).resize(function(){	
		deviceCheck();
		$('body').css('position','static');
		nopi();
		h_pos();
		resizeWindow();
	});
	
	
	function h_pos(){
		var h_pos = $('.main_notice .mn_list .mn_box .mn_pic').height();
		var h_nopi = $('.main_notice .mn_list h2').innerHeight();
		//var vod_h = $('.vd_pop').height();
		var pop_h = $('.popup').height();
		$('.main_notice .mn_list h2').css('top', h_pos - h_nopi);
		//$('.vd_pop').css('margin-top', - (vod_h / 2) );
		$('.popup').css('margin-top', - (pop_h / 2) );
		
	}
	
	var typingBool = false; 
	var typingIdx=0; 
	var typingTxt = $(".typing-txt").text(); // 타이핑될 텍스트를 가져온다 
		typingTxt=typingTxt.split(""); // 한글자씩 자른다. 
		if(typingBool==false){ // 타이핑이 진행되지 않았다면 
		   typingBool=true; 

		   var tyInt = setInterval(typing,100); // 반복동작 
		 } 

	 function typing(){ 
	   if(typingIdx<typingTxt.length){ // 타이핑될 텍스트 길이만큼 반복 
		 $(".typing").append(typingTxt[typingIdx]); // 한글자씩 이어준다. 
		 typingIdx++; 
	   } else{ 
		 clearInterval(tyInt); //끝나면 반복종료 
	   } 
	 } 
	
	 $('.sub_depth2_tab').text($('.pb_sub .pb_top .sub_depth2 li.on a').text());
		$('.sub_depth2_tab').click(function(){
			$('.sub_depth2 ul').toggle();
		});
		
		$('.sub_depth2 li a').click(function(){
			$('.sub_depth2 ul').hide();
		});
	
	
	
	
	$('.login_sec').clone().prependTo($('.quick'));
	$('.quick_list').clone().prependTo($('.main_quick'));
	
	$( '.go_top' ).click( function() {
		$( 'html, body' ).animate( { scrollTop : 0 }, 400 );
		return false;
	} );
	
	$('.go_quick').click(function(){
		$(this).toggleClass('open');
		$('.quick_area').toggle();
	});
	
	$('.global_wrap .go_select').click(function(){
		$('.global_wrap').addClass('open zd');
		
		$('.close_country, .global_wrap .country li a').click(function(){
			$('.global_wrap').removeClass('open');	
			setTimeout(function() {
				$('.global_wrap').removeClass('zd');	
			}, 300);
			
			
		});
	});
	
	
	var responSize = 1264; // 1280
	var device = '';
	
	var deviceCheck = function(){
	var  winWidth = $(window).width();
		if(winWidth >= responSize){
				if(device == 'pc'){
				}else{
					device = 'pc';
					eventreset(device);

					pcmenu(device);
					//PC---------------------
				}
			}else{
				if(device == 'mb'){
				}else{
					device = 'mb';
					eventreset(device);
					mbmenu(device);


					//mb-------------------
				}
			}
		};deviceCheck();



	/* */
	function eventreset(device){
		$('#gnb, .login_sec').removeClass('active');
		$('#gnb, .login_sec').css('opacity','0');
		$('.m_close, #gnb > h1, .login_sec > h1, #gnb .quick_sns, #gnb .nation_wrap').remove();
		$('.m_menu, .mp #gnb > ul > li.list_gnb > a, .m_user, .tool00').unbind('click');
		$("#gnb > ul > li.list_gnb  > a").removeClass('on')
		$(".mp #gnb .dpt2").attr('style','')
		$('.ov-bg, .popup, .tip00').hide();
		$(".mp .login_sec ul .join").prependTo(".mp .login_sec ul.logout");
		$(".gnb_etc .global_wrap").remove();
		
	}


	/*pc-menu*/
	function pcmenu(device){
		$('#head, .g_act').removeClass('mp').addClass('pc');
		$('.pc .my_wrap').hover(function(){
			$('.pc .my_list').stop().slideToggle();
		});
		nsel();
		toolmenu();

	}


	function mbmenu(device){
		
		$('#head, .g_act').removeClass('pc').addClass('mp');
		
		$('.m_menu').click(function(){
			$('#gnb, .login_sec').css('opacity','1');
			$('.ov-bg').show();
			$('.login_sec').removeClass('active');
			$('.m_close, #gnb > h1, #gnb .quick_sns, #gnb .nation_wrap').remove();
			$('.mp #gnb').prepend('<a class="m_close" href="#none"><img src="/images/btn_close_m.png" alt="mene_close"></a>');
			$('.inn > h1').clone().prependTo($('.mp #gnb'));
			$('.quick_sns').clone().appendTo($('.mp #gnb'));
			$('.nation_wrap').clone().appendTo($('.mp #gnb'));
			$('#gnb').addClass('active');
			$('.global_wrap .desc').show();
			//$(".mp #gnb.active > ul > li > a").attr('href','#none');
			nsel();
		
			
			$('.m_close').click(function(){
				$('#gnb').removeClass('active');
				$('.ov-bg').hide();
			}); 
		});
		
		$('.m_user').click(function(){
			$('#gnb, .login_sec').css('opacity','1');
			$('.ov-bg').show();
			$('#gnb').removeClass('active');
			$('.m_close, .login_sec > h1').remove();
			$('.mp .login_sec').prepend('<a class="m_close" href="#none"><img src="/images/btn_close_m.png" alt="mene_close"></a>');
			$('.inn > h1').clone().prependTo($('.mp .login_sec'));
			$('.login_sec').addClass('active');
			$(".mp .login_sec ul .join").appendTo(".mp .login_sec ul.logout");
			$('.mp .global_wrap').clone().appendTo($('.mp .login_sec'));
			$('.mp .global_wrap .go_select').html($('.mp .global_wrap .country li:first a').html());
			
			$('.mp .global_wrap .go_select').click(function(){
				$(this).siblings('.desc').slideDown();
				$('.mp .global_wrap li > a').click(function(){
					$('.mp .global_wrap .desc').slideUp();
				});
			});
			
			$('.m_close').click(function(){
				$('.login_sec').removeClass('active');
				$('.ov-bg').hide();
				$(".mp .login_sec ul .join").prependTo(".mp .login_sec ul.logout");
				$('.mp .global_wrap .desc').slideUp();
				$(".gnb_etc .global_wrap").remove();
			});
		});
		
		$(".mp #gnb > ul > li.list_gnb > a").click(function(){
			event.preventDefault();
			$(".mp #gnb .dpt2").slideUp();
			$(".mp #gnb > ul > li.list_gnb  > a").removeClass('on')
			if(!$(this).next().is(":visible"))
			{
				$(this).next().slideDown();
				$(this).addClass('on');
			}
		});
		
		
		
		mtoolmenu();
		

		
		
	}
	
	
	
	function popup(){
			$('.pop_close, .ov-bg, .popup_pay .my_btn00 ').click(function(){
				$('.ov-bg, .popup').fadeOut(200);
			});

			$('.pop_on').click(function(){
				$('.ov-bg, .popup').fadeIn(200);
			});
	}
	
	

	function nopi(){
		var sameHeight = 0;	
		$('.box').ready(function(){	
			$('.box').css('height','');
			$('.box').each(function(){	
				var itemHeight = $(this).innerHeight();
				if(itemHeight >= sameHeight){	
					sameHeight = itemHeight;	
				}
			});
			$('.box').css('height',sameHeight);	
		});
	};nopi();
	
	
	function nsel(){
		$('.nation_wrap').mouseover(function(){
			$(this).children('a').addClass('act');
			$('.nation_wrap .list').stop().slideDown();
		});
		
		$('.nation_wrap').mouseout(function(){
			$(this).children('a').removeClass('act');
			$('.nation_wrap .list').stop().slideUp();
		});
		
	}
	
	function toolmenu(){
		$('.pc .tip01').show();
		$('.pc .tool00').hover(function(){
			var tlnum = $(this);
			
			var tipwidth =$('.pc .tip00').eq(tlnum.index()-1).width();
			var tipheight =$('.pc .tip00').eq(tlnum.index()-1).height();
			
			var pos = parseFloat($(this).position().top);
			var pol = parseFloat($(this).position().left);
			
			$('.pc .tip00').eq(tlnum.index()-1).css('top', pos-tipheight-24);
			$('.pc .tip00').eq(tlnum.index()-1).css('left', pol-tipwidth/2+30);
			
			$('.pc .tool00').removeClass('act');
			tlnum.addClass('act');
			$('.pc .tip00').hide();
			$('.pc .tip00').eq(tlnum.index()-1).stop().fadeIn(200);
		},function(){
			$('.pc .tool00').removeClass('act');
			$('.pc .tip00').hide();
		});
		
	}
	
	function mtoolmenu(){
		//$('.mp .tip_wrap').prepend('<a class="act_close" href="#none"><img src="/images/close_act.png" alt="act_close"></a>');
		
		$('.mp .tool00').click(function(){
			var mtlnum = $(this);
			$('.mp .tool00').removeClass('act');
			mtlnum.addClass('act');
			$('.mp .tip00').hide();
			$('.mp .tip00').eq(mtlnum.index()-1).stop().fadeIn(200);
			$('.ov-bg').show();
		});	
		
		$('.ov-bg').click(function(){
			$('.mp .tip00, .ov-bg').fadeOut(200);
		});
		
}
	
	function resizeWindow()	{
		var h = $(window).height();
		var w = $(window).width();
		
		if (w <= 770)	{
			$(".account_wrap").css("min-height",h+"px");
		}	else	{
			$(".account_wrap").css("min-height","700px");
		}
	}
	

});
})( jQuery );