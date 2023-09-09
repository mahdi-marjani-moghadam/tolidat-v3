</div>
</div>

<!-- modal-img-->
<div class="hidden holder-modal modal fade" id="myModal-img" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>

            <div class="modal-body">
                <div class="logo-modal boxBorder">
                    <img class="center-block" src="src" alt="" />
                </div>
            </div>
        </div>

    </div>

</div>
</div>

<?php include_once "wiki.template.php"; ?>

<!--------------------------- Scripts --------------------------->
<!-- <script src="< ?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script> -->
<!-- <script src="< ?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/highcharts/highcharts.js"></script> -->
<script>
    $.iziToastError = function(msg) {
        iziToast.settings({
            onOpen: function(e) {}
        });
        iziToast.show({
            title: 'خطا',
            color: 'red',
            icon: 'fa fa-times-circle',
            iconColor: 'red',
            rtl: true,
            position: 'topCenter',
            timeout: 10000,
            message: msg
        });
    };
    $(function() {
        ////////////// Ajax contact /////////////////

        $(".addContactUs").on("submit", function(e) {
            e.preventDefault();
            var form = $('.addContactUs')[0];
            var formData = new FormData(form);
            var cnt = 0;

            $('.addContactUs').find('[required]').each(function() {
                if ($(this).val() === '') {
                    cnt++;
                }
            });

            if (cnt === 0) {
                $.ajax({
                    url: '/companyContacts/add',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        var result = $.parseJSON(data);
                        $.each(result, function(key, value) {
                            console.log(value[0]);

                            if (result.result == -1) {
                                if ($("." + key).find('.errorHandler').length == 1) {
                                    return;
                                }
                                $("." + key).append("<div class='errorHandler'>" + value + "</div>");
                                $("." + key).find('.requiredIcon').empty().text('*');


                                $.iziToastError(value, '.iziContainer');

                                return;
                            }

                            if (key == 'msg') {
                                $.iziToastSuccess(value, '.iziContainer');
                                $('.addContactUs').find('input[type="text"], input[type="email"], textarea').each(function() {
                                    $(this).val("");
                                });
                                $('.fade').modal('hide');
                                $('.errorHandler').remove();
                                $('.fa-check').remove();
                            }
                        });
                    }
                });
            } else {
                $.iziToastError('لطفا موارد اجباری را پر نمایید', '.iziContainer');
                cnt = 0;
            }
        });

        $('input[type="text"], textarea').focus(function() {
            $(this).keypress(function() {
                $(this).parent().find('.errorHandler').remove();
                $(this).parent('div').find('.requiredIcon').html('<i class="fa fa-check"></i>');
            });
        });

        // jQuery('#qrcode').qrcode({
        //     text: "< ?php echo RELA_DIR . 'company/Detail/' . $list['side']['list']['Company_id']; ?>",
        //     width: 80,
        //     height: 80
        // });

        // $('.carousel-vertical').each(function() {
        //     var $this = $(this),
        //         cnt = 0;
        //     setTimeout(function() {
        //         try {
        //             $this.slick({
        //                 slidesToShow: 1,
        //                 slidesToScroll: 1,
        //                 infinite: true,
        //                 autoplay: true,
        //                 vertical: true,
        //                 verticalSwiping: true,
        //                 lazyLoad: 'ondemand',
        //                 responsive: [
        //                     {
        //                         breakpoint: 767,
        //                         settings: {
        //                             slidesToShow: 1,
        //                             slidesToScroll: 1
        //                         }
        //                     },
        //                     {
        //                         breakpoint: 560,
        //                         settings: {
        //                             slidesToShow: 1,
        //                             slidesToScroll: 1
        //                         }
        //                     },
        //                     {
        //                         breakpoint: 480,
        //                         settings: {
        //                             slidesToShow: 1,
        //                             slidesToScroll: 1
        //                         }
        //                     }
        //                 ]
        //             })
        //         } catch(e) {}
        //     }, cnt);

        //     cnt += 400;
        // });

        $('.logoContainer-img img').click(function() {
            var title = $(this).attr('data-title');
            var src = $(this).attr('src');

            $('#myModal-img').find('.modal-title').html(title);
            $('#myModal-img .modal-body img').attr('src', src);
            $('#myModal-img').modal('show');
        });

        // $('.section-title').stickit({
        //     top: 85,
        //     zIndex: 1,
        //     scope: StickScope.Document
        // }, {
        //     top: 112,
        //     screenMaxWidth: 1200
        // }, {
        //     top: 1,
        //     screenMaxWidth: 768
        // });

        // $('[rel="popover"]').popover({
        //     container: 'body',
        //     html: true,
        //     content: function() {
        //         return $($(this).data('popover-content')).clone(true).removeClass('hide');
        //     }
        // }).click(function(e) {
        //     e.preventDefault();
        // });

        var url = window.location.href.split('/').filter(function(v) {
            return v !== ''
        })[2];

        $('.tab .tabMenu li').each(function() {
            var menuUrl = $(this).find('a').attr('href');

            if (menuUrl !== undefined) {
                var tmp = menuUrl.split('/').filter(function(v) {
                    return v !== ''
                })[2];

                if (tmp === url) {
                    $(this).addClass('active');
                }
            }
        });

        try {
            var priorityArr = JSON.parse('<?php echo $list['side']['list']['priority_details'] ?>'),
                serie,
                pieDataSeries = [],
                sumPercent = 0,
                remainPercent = 100;

            Object.keys(priorityArr).map(function(item) {

                sumPercent += parseInt(priorityArr[item].totalScore);

                serie = {
                    name: priorityArr[item].persian_name,
                    y: priorityArr[item].totalScore,
                    color: priorityArr[item].color,
                    link: priorityArr[item].link,
                    menuName: item
                };

                pieDataSeries.push(serie);
            });

            remainPercent -= sumPercent;

            pieDataSeries.push({
                name: 'امتیاز کسب نشده',
                y: remainPercent,
                color: '#f9f9f9'
            });

            Highcharts.chart('pieContainer', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie',
                    events: {
                        load: function() {
                            $('#pieContainer').append('<div class="totalContainer transition text-center">' + sumPercent + ' %</div>');
                        }
                    }
                },
                title: {
                    text: ''
                },
                tooltip: {
                    formatter: function() {
                        return '<strong style="color: #ff660c">' + this.point.name + ' : </strong>' + this.point.y + ' % ';
                    },
                    useHTML: true,
                    style: {
                        direction: 'rtl',
                        color: '#555',
                        fontSize: '15px',
                        fontWeight: 'bold',
                        fontFamily: 'Samim',
                        zIndex: 99
                    },
                    backgroundColor: 'rgba(255,255,255,1)'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        borderColor: '#eee',
                        borderWidth: 1
                    },
                    series: {
                        events: {
                            click: function(event) {
                                var link = event.point.link;
                                if (link !== '' && link !== undefined)
                                    window.location.replace(link);
                            }
                        }
                    }
                },
                series: [{
                    data: pieDataSeries,
                    innerSize: '80%'
                }]
            });

        } catch (e) {}
    });
</script>