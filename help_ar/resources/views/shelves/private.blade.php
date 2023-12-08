<?php
error_reporting(0);
?>
<!--@extends('simple-layout') -->
@section('body')
    <div class="container">
        <h5> Extended Help Page </h5>
        @foreach($masterDataPrivate['shelves'] as $keyshelf => $shelve)
             @if($shelve['classification']==2)
            <div data-level1="level1_<?php echo $keyshelf; ?>" class="tab   <?php if($keyshelf == 1) {echo 'active';} ?>">
                <div class="tab-title">
                     {{$shelve['name']}}
                </div>
            </div>    
            <div class="tab-content">
                <div class="customalign">
                    <div class="description"> <?php echo $shelve['description'] ?></div>
                    
                    @if($shelve['column_level']==2)  
                        @foreach($shelve['books'] as $keybook => $book)
                        <div class="tablevelone first-child  <?php if($keybook == 1) {echo 'active';} ?>">
                            <a class="tab-title_level1">{{$book['name']}} </a>
                        </div>    
                        <div class="tab-content">
                            <div class="customalignone">
                                <div class="descriptionbook"><?php echo $book['description'] ?></div>
                            
                                @foreach($book['chapters'] as $keya => $chapter)
                                    <div class="tableveltwo first-child <?php if($keya == 1) {echo 'active';} ?>">
                                        <a class="tab-title_level2"> {{$chapter['name']}}</a>
                                    </div>    
                                    <div class="tab-content">
                                        <div class="customaligntwo">
                                            <div class="descriptiontwo"> <?php echo $chapter['description'] ?></div>
                                                @foreach($chapter['pages'] as $keyb => $page)
                                                <div class="wrapper">
                                                    <div class="accordion accordion_level2">
                                                    <div id="target_page<?php echo $keyb; ?>"  class="accordion__panel  <?php if($keyb == 1) {echo 'is-active';} ?>">
                                                       <div data-target="level2_<?php echo $keyb; ?>" class="accordion__heading"><button class="accordion__btn_1" >{{$page['name']}}</button></div>
                                                        <div class="accordion__content">
                                                            <div class="accordion__inner">
                                                                <?php echo $page['html'] ?> 
                                                                </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                    </div>
                                </div> 
                                @endforeach
                            </div><!-- comment -->
                        </div><!-- comment -->
                    @endforeach
                    
                    @elseif($shelve['column_level']==1) 
                    @foreach($shelve['books'] as $keyboo => $book)
                        <div class="wrapper">
                            <div class="accordion">
                                <div class="accordion__panel_1">
                                <div class="accordion__heading" id="targetsegment_<?php echo $book['specid']; ?>" ><button class="accordion__btn_1" >{{$book['name']}}</button></div>
                                <div class="accordion__content_1">
                                    <div class="accordion__inner">
                                        <?php echo $book['description'] ?>
                        @foreach($book['pages'] as $keyb => $page)
                              
                        <div class="wrapper">
                                    <div class="accordion">
                                        <div class="accordion__panel">
                                             <div class="accordion__heading"><button class="accordion__btn_1" >{{$page['name']}}</button><button class="copylinkbutton" id="copyButton" onclick="copyLink(<?php echo $keyb; ?>)" style="text-align: right;">Copy Link</button> <span id="copyResult"></span></div>
                                        <div class="accordion__content" data-contenttype="level1" id="targetpage_<?php echo $keyb; ?>"  data-bookkey="<?php echo $keyshelf; ?>" data-segmentkey="<?php echo $book['specid']; ?>" data-pagekey="<?php echo $keyb; ?>">
                                            <div class="accordion__inner">
                                                <?php echo $page['html'] ?> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              
                            @endforeach  
                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach 
                @endif  
            </div>    
            </div> 
             @endif
        @endforeach
    </div>    
@stop        
  

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript"><!-- comment -->
            
         

$(function() {
    $('.tab').on('click', function(e) {
        $('.tablevelone').removeClass('active');
        $(this).next().find('.tablevelone').eq(0).addClass('active');
        $('.tableveltwo').removeClass('active');
        $(this).next().find('.tableveltwo').eq(0).addClass('active');
     });
     
     $('.tablevelone').on('click', function(e) {
        $('.tableveltwo').removeClass('active');
        $(this).next().find('.tableveltwo').eq(0).addClass('active');
     });
     
     
    $('.tab-title').on('click', function(e) {
        e.preventDefault();
        var _self = $(this);
        $('.tab').removeClass('active');
        _self.parent().addClass('active');
      });
      
       $('.tab-title_level1').on('click', function(e) {
        e.preventDefault();
        var _self = $(this);
        $('.tablevelone').removeClass('active');
        _self.parent().addClass('active');
      });

    $('.tab-title_level2').on('click', function(e) {
        e.preventDefault();
        var _self = $(this);
        $('.tableveltwo').removeClass('active');
        _self.parent().addClass('active');
      });
});

$( document ).ready(function() {
    accordion();
});
 function accordion(){
     const accordion = document.querySelector(".accordion");
    const accordionPanels = document.querySelectorAll(".accordion__panel");
    const accordionTriggers = document.querySelectorAll(".accordion__btn");
    const accordionPanels_1 = document.querySelectorAll(".accordion__panel_1");
    const accordionTriggers_1 = document.querySelectorAll(".accordion__btn_1");
    let speedAnimation = 300;
   
    accordionTriggers.forEach((trigger) => {
	trigger.addEventListener("click", (e) => {
              
		let panel = trigger.parentNode.parentNode.querySelector(".accordion__content");
		if (e.target.parentNode.parentNode.classList.contains("is-active")) {
			slideUp(panel, speedAnimation);

			panel.addEventListener("transitionrun",() => {
					trigger.parentNode.parentNode.classList.remove("is-active");
				},
				{ once: true }
			);
		} else {
			accordionPanels.forEach(function (item) {
				if (item.classList.contains("is-active")) {
					slideUp(item.querySelector(".accordion__content"), speedAnimation);

					item.querySelector(".accordion__content").addEventListener("transitionrun",() => {
							item.classList.remove("is-active");
						},
						{ once: true }
					);
				}
			});
			trigger.parentNode.parentNode.classList.add("is-active");
			slideDown(panel, speedAnimation);
		}
	});
});

     accordionTriggers_1.forEach((trigger) => {
	trigger.addEventListener("click", (e) => {
              
		let panel = trigger.parentNode.parentNode.querySelector(".accordion__content_1");
		if (e.target.parentNode.parentNode.classList.contains("is-active")) {
			slideUp(panel, speedAnimation);

			panel.addEventListener("transitionrun",() => {
					trigger.parentNode.parentNode.classList.remove("is-active");
				},
				{ once: true }
			);
		} else {
			accordionPanels_1.forEach(function (item) {
				if (item.classList.contains("is-active")) {
					slideUp(item.querySelector(".accordion__content_1"), speedAnimation);

					item.querySelector(".accordion__content_1").addEventListener("transitionrun",() => {
							item.classList.remove("is-active");
						},
						{ once: true }
					);
				}
			});
			trigger.parentNode.parentNode.classList.add("is-active");
			slideDown(panel, speedAnimation);
		}
	});
});

let slideUp = (target, duration = 500) => {
	target.style.transitionProperty = "height, margin, padding";
	target.style.transitionDuration = duration + "ms";
	target.style.boxSizing = "border-box";
	target.style.height = target.offsetHeight + "px";
	target.offsetHeight;
	target.style.overflow = "hidden";
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;
	window.setTimeout(() => {
		target.style.display = "none";
		target.style.removeProperty("height");
		target.style.removeProperty("padding-top");
		target.style.removeProperty("padding-bottom");
		target.style.removeProperty("margin-top");
		target.style.removeProperty("margin-bottom");
		target.style.removeProperty("overflow");
		target.style.removeProperty("transition-duration");
		target.style.removeProperty("transition-property");
		//alert("!");
	}, duration);
};

let slideDown = (target, duration = 500) => {
	target.style.removeProperty("display");
	let display = window.getComputedStyle(target).display;

	if (display === "none") display = "block";

	target.style.display = display;
	let height = target.offsetHeight;
	target.style.overflow = "hidden";
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;
	target.offsetHeight;
	target.style.boxSizing = "border-box";
	target.style.transitionProperty = "height, margin, padding";
	target.style.transitionDuration = duration + "ms";
	target.style.height = height + "px";
	target.style.removeProperty("padding-top");
	target.style.removeProperty("padding-bottom");
	target.style.removeProperty("margin-top");
	target.style.removeProperty("margin-bottom");
	window.setTimeout(() => {
		target.style.removeProperty("height");
		target.style.removeProperty("overflow");
		target.style.removeProperty("transition-duration");
		target.style.removeProperty("transition-property");
	}, duration);
};

let slideToggle = (target, duration = 500) => {
	if (window.getComputedStyle(target).display === "none") {
		return slideDown(target, duration);
	} else {
		return slideUp(target, duration);
	}
};
 }

 $(document).ready(function(){

    var leftmenukey=$("#targetpage_<?php echo $target; ?>").attr('data-bookkey');
    var pagekey=$("#targetpage_<?php echo $target; ?>").attr('data-pagekey');
    var segmentkey=$("#targetpage_<?php echo $target; ?>").attr('data-segmentkey');
    var contenttype=$("#targetpage_<?php echo $target; ?>").attr('data-contenttype');
    $('div[data-level1="level1_'+leftmenukey+'"]').find(".tab-title").click();
    setTimeout(function(){
        $('#targetsegment_'+segmentkey).find("button").click();
        // console.log($('#targetsegment_'+segmentkey))
    }, 1000);
    setTimeout(function(){
        $("#targetpage_<?php echo $target; ?>").prev().click();
        // console.log($("#targetpage_<?php echo $target; ?>"))
        document.getElementById("targetpage_<?php echo $target; ?>").scrollIntoView({ block: 'start', behavior: 'smooth' });

    }, 2000);



 })

 function copyLink(linkText) {
    var link='<?php echo $copyLink; ?>'+linkText;
    // Copy the text inside the text field
    navigator.clipboard.writeText(link);

  // Alert the copied text
//   alert("Copied the text: " + link);
}

    </script>
