document.addEventListener("DOMContentLoaded", function(){ window.addEventListener("DOMContentLoaded", function(){
	var swiper = new Swiper( ".uagb-block-d1f2f0c0 .uagb-swiper",
		{"autoplay":{"delay":5000,"disableOnInteraction":false,"pauseOnMouseEnter":false,"stopOnLastSlide":false},"loop":true,"speed":2500,"effect":"fade","direction":"horizontal","flipEffect":{"slideShadows":false},"fadeEffect":{"crossFade":true},"pagination":{"el":".uagb-block-d1f2f0c0 .swiper-pagination","clickable":true,"hideOnClick":false},"navigation":{"nextEl":".uagb-block-d1f2f0c0 .swiper-button-next","prevEl":".uagb-block-d1f2f0c0 .swiper-button-prev"}}	);
});

window.addEventListener( 'load', function() {
	UAGBTabs.init( '.uagb-block-3e183a80' );
	UAGBTabs.anchorTabId( '.uagb-block-3e183a80' );
});
window.addEventListener( 'hashchange', function() {
	UAGBTabs.anchorTabId( '.uagb-block-3e183a80' );
}, false );
 });