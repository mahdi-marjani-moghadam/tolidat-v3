$(document).ready(function() {
    var $body = $('body');
        /*$minus = $('.boxPrice .minus'),
        $plus = $('.boxPrice .plus');
        packageList = $.parseJSON($('.packagesList').val());

    var cnt = 0;
    $.each(packageList, function(i, v) {
        var html = $('<li class="'+(cnt === 0 ? 'active' : '')+'"><a data-id="'+v.Package_id+'" data-type="'+v.englishTitle+'" class="text-center white-color '+v.englishTitle+'">'+v.packagetype+'</a></li>')

        $('.tab-container ul').append(html);
        cnt++;
    });

    var counter = cnt === 3 ? 2 : 1;
    $minus.on('click', function(e) {
        e.preventDefault();

        var $this = $(this),
            $box = $this.parents('.boxPrice');

        if(counter >= 1) {
            $plus.prop('disabled', false);

            counter--;

            switch (counter) {
                case 1: {

                    calculate($box, packageList[1]);

                    $(this).prop('disabled', true);

                    break;
                }
                case 2: {
                    calculate($box, packageList[2]);

                    break;
                }
                case 3: {
                    calculate($box, packageList[3]);

                    break;
                }
            }
        }

        var activeId = $('.tab-container li.active a').data('id');
        $box.find('.choosePkg').attr('data-id', activeId);
    });

    $plus.on('click', function(e) {
        e.preventDefault();

        var $this = $(this),
            $box = $this.parents('.boxPrice');

        if(counter <= 3) {
            $minus.prop('disabled', false);

            switch (counter) {
                case 1: {
                    calculate($box, packageList[2]);

                    break;
                }
                case 2: {
                    calculate($box, packageList[3]);

                    break;
                }
                case 3: {
                    calculate($box, packageList[4]);

                    $(this).prop('disabled', true);

                    break;
                }
            }

            counter++;
        }

        var activeId = $('.tab-container li.active a').data('id');
        $box.find('.choosePkg').attr('data-id', activeId);
    });

    $('.tab-container li a').on('click', function() {
        var $this = $(this),
            id = $this.data('id'),
            $box = $this.parents('.boxPrice'),
            type = $this.data('type');

        if($(this).hasClass('active')) {
            return false;
        }

        switch (type) {
            case 'bronze': {
                calculate($box, packageList[1]);
                counter = 1;

                $minus.prop('disabled', true);
                $plus.prop('disabled', false);

                break;
            }
            case 'silver': {
                calculate($box, packageList[2]);
                counter = 2;

                $minus.prop('disabled', false);
                $plus.prop('disabled', false);

                break;
            }
            case 'gold': {
                calculate($box, packageList[3]);
                counter = 3;

                $minus.prop('disabled', false);
                $plus.prop('disabled', false);

                break;
            }
            case 'platinum': {
                calculate($box, packageList[4]);
                counter = 4;

                $minus.prop('disabled', false);
                $plus.prop('disabled', true);

                break;
            }
        }

        $box.find('.choosePkg').attr('data-id', id);
    });

    function calculate($box, $obj) {
        try {
            var $countHolderCat = $box.find('.count-holder.cat'),
                $countHolderProd = $box.find('.count-holder.prod'),
                $priceHolder = $box.find('.price-holder'),
                $packagePriceType = $box.find('.package-type'),
                $buttonChoose = $box.find('.choose-button button'),
                $tabContainer = $box.find('.tab-container');

            $packagePriceType.html($obj.packagetype);

            $tabContainer.find('li').removeClass('active');
            $tabContainer.find('a.'+$obj.englishTitle).parent().addClass('active');

            cleanBoxClass($box, $obj.englishTitle);
            cleanBtnClass($buttonChoose, $obj.englishTitle);

            animateNum($priceHolder, $obj.price);
            animateNum($countHolderCat, $obj.category);
            animateNum($countHolderProd, $obj.product);
        } catch (e) {}
    }

    function cleanBoxClass($el, packageType) {
        $el.removeAttr('class');
        $el.addClass('boxPrice ' + packageType);
    }

    function cleanBtnClass($el, packageType) {
        $el.removeAttr('class');
        $el.addClass('btn btn-block white-color choosePkg ' + packageType);
    }

    function animateNum($el, price) {
        var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',');

        $el.animateNumber({
            number: price,
            numberStep: comma_separator_number_step
        });
    }*/

    $body.on('click', '.choose-button button', function() {
        var id = $(this).attr('data-id');

        $('.packageType').val(id);
    });
});
