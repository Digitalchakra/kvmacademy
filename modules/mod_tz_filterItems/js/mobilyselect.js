/* ==========================================================
 * MobilySelect
 * date: 18.1.2010
 * author: Marcin Dziewulski
 * last update: 25.1.2010
 * web: http://www.mobily.pl or http://playground.mobily.pl
 * email: hello@mobily.pl
 * Free to use under the MIT license.
 * ========================================================== */
var $tz_t = jQuery.noConflict();
(function($tz_t) {
    $tz_t.fn.mobilyselect = function(options) {
        var defaults = {collection:"all",animation:"absolute",duration:500,listClass:"selecterContent",btnsClass:"selecterBtns",btnActiveClass:"active",elements:"li",onChange:function() {
        },onComplete:function() {
        }};
        var sets = $tz_t.extend({}, defaults, options);
        return this.each(function() {
            var $t = $tz_t(this),list = $t.find("." + sets.listClass),btns = $t.find("." + sets.btnsClass),btn = btns.find("a"),li = list.find(sets.elements),w = li.width(),h = li.height(),l = li.length,finishTime;
            if (sets.animation == "absolute") {
                li.css({position:"relative"}).children().css({position:"absolute",top:0,left:0})
            }
            var select = {init:function() {
                this.start();
                this.trigger()
            },start:function() {
                if (sets.collection != "all") {
                    li.hide().filter("." + sets.collection).show();
                    btn.removeClass(sets.btnActiveClass).filter(
                            function() {
                                return $tz_t(this).attr("rel") == sets.collection
                            }).addClass(sets.btnActiveClass)
                }
            },trigger:function() {
                btn.bind("click", function() {
                    var $t = $tz_t(this),rel = $t.attr("rel"),selected = li.filter("." + rel),s = li.filter(function() {
                        return $tz_t(this).css("display") == "block"
                    });
                    if (rel == "all") {
                        if (l != s.length) {
                            select.animation(li, li)
                        }
                    } else {
                        select.animation(li, selected)
                    }
                    btn.removeClass(sets.btnActiveClass);
                    $t.addClass(sets.btnActiveClass);
                    sets.onChange.call(this);
                    return false
                })
            },animation:function(not, selected) {
                switch (sets.animation) {
                    case"plain":
                        $tz_t(not).hide();
                        $tz_t(selected).show();
                        break;
                    case"fade":
                        $tz_t(not).fadeOut(sets.duration);
                        setTimeout(function() {
                            $tz_t(selected).fadeIn(sets.duration)
                        }, sets.duration + 400);
                        break;
                    case"absolute":
                        setTimeout(function() {
                            $tz_t(selected).show().children().animate({top:0,left:0}, sets.duration)
                        }, sets.duration + 400);
                        $tz_t(not).children().animate({top:-h + "px",left:-w + "px"}, sets.duration, function() {
                                    $tz_t(not).hide()
                                });
                        break
                }
                if (sets.animation == "absolute" || sets.animation == "fade") {
                    finishTime = sets.duration * 2 + 400
                } else {
                    finishTime = 100
                }
                setTimeout(function() {
                    sets.onComplete.call(this)
                }, finishTime)
            }}
            select.init()
        })
    }
}(jQuery));