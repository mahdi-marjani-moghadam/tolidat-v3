!function(t){t.fn.simpleMoneyFormat=function(){function e(e,n,l){for(var a="",i=l.split(""),p=[],u=0,r="",o=i.length-1;o>=0;o--)r+=i[o],3==++u&&(p.push(r),u=0,r="");u>0&&p.push(r);for(o=p.length-1;o>=0;o--){for(var c=p[o].split(""),f=c.length-1;f>=0;f--)a+=c[f];o>0&&(a+=",")}"input"==n?t(e).val(a):t(e).empty().text(a)}this.each(function(n,l){var a=null,i=null;t(l).is("input")||t(l).is("textarea")?(i=t(l).val().replace(/,/g,""),a="input"):(i=t(l).text().replace(/,/g,""),a="other"),t(l).on("paste keyup",function(){i=t(l).val().replace(/,/g,""),e(l,a,i)}),e(l,a,i)})}}(jQuery);