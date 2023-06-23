$(function(){
	'use strict';

    // MULTISELECT
    $('[data-input="multiselect"]').multiSelect();
    // END MULTISELECT

    // SELECT2
    $('[data-input="select2"], .select2').each(function(){
        var $this = $(this),
            placeholder = ($this.attr('placeholder') === undefined) ? 'Select a choice' : $this.attr('placeholder');

        $this.select2({
            placeholder: placeholder,
            allowClear: true
        });
    });
    $('[data-input="select2-tags"], .select2-tags').each(function(){
        var $this = $(this),
            placeholder = ($this.attr('placeholder') === undefined) ? 'Select a choice' : $this.attr('placeholder'),
            data_tags = ($this.attr('data-tags') === undefined) ? false : $this.attr('data-tags'),
            tags;

            if(data_tags){
                tags = data_tags.replace(/\s+/g, '');
                tags = tags.split(",");
            }
            else{
                tags = [];
            }

        $this.select2({
            placeholder: placeholder,
            tags: tags
        });
    });
    // END SELECT2



    // DATE RANGE PICKER
    $('[data-input="daterangepicker"]').each(function(){
        var $this = $(this),
            timePicker = ($this.attr('data-time') === undefined) ? false : true,
            format = ($this.attr('data-format') === undefined) ? 'YYYY-MM-DD' : $this.attr('data-format');

        $this.daterangepicker({
            timePicker: timePicker,
            timePickerIncrement: 5,
            format: format,
            applyClass: 'btn-primary'
        });
    });
    // END DATE RANGE PICKER


    // COLOR PICKER
    $('[data-input="colorpicker"]').each(function(){
        var $this = $(this);

        $this.minicolors({
            control: $(this).attr('data-control') || 'hue',
            defaultValue: $(this).attr('data-defaultValue') || '',
            inline: $(this).attr('data-inline') === 'true',
            letterCase: $(this).attr('data-letterCase') || 'lowercase',
            opacity: $(this).attr('data-opacity'),
            position: $(this).attr('data-position') || 'bottom left',
            theme: 'bootstrap'
        });
    });
    // END COLOR PICKER
     
     
    


    // FORM VALIDATE
    $('[data-validate="form"]').each(function(){
        var $this = $(this);
        
        $this.validate({
            focusCleanup: true,
            errorClass: "text-danger",
            errorPlacement: function(error, element) {
                if ( element.parent().hasClass('nice-checkbox') || element.parent().hasClass('nice-radio') || element.parent().hasClass('input-group') ) {
                    error.appendTo( element.parent().parent() );
                }
                else{
                    error.appendTo( element.parent() );
                }
            }
        });
    });
    // END FORM VALIDATE
    



    // DROPZONE
    $('form[data-input="dropzone"]').each(function(){
        var $this = $(this),
            url = $this.attr('action');

        $this.dropzone({ url: url });
    });
    // END DROPZONE
    




    // BOOTSTRAP WYSIHTML5
    $('[data-input="wysihtml5"]').each(function(i){
        var $this = $(this),
            font_styles = ($this.attr('data-fontstyles') === 'false') ? false : true,
            emphasis = ($this.attr('data-emphasis') === 'false') ? false : true,
            lists = ($this.attr('data-lists') === 'false') ? false : true,
            link = ($this.attr('data-link') === 'false') ? false : true,
            image = ($this.attr('data-image') === 'false') ? false : true,
            html = ($this.attr('data-html') === undefined) ? true : false,
            color = ($this.attr('data-color') === undefined) ? false : true;

        $this.wysihtml5({
            "font-styles": font_styles, //Font styling, e.g. h1, h2, etc. Default true
            "emphasis": emphasis, //Italics, bold, etc. Default true
            "lists": lists, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
            "html": html, //Button which allows you to edit the generated HTML. Default false
            "link": link, //Button to insert a link. Default true
            "image": image, //Button to insert an image. Default true,
            "color": color, //Button to change color of font  
            "events": {
                "focus": function() { 
                    var editor = $this.data("wysihtml5").editor,
                        composer = editor.composer,
                        iframe = composer.iframe;

                    $(iframe).addClass('wysihtml5-focus');
                },
                "blur": function() { 
                    var editor = $this.data("wysihtml5").editor,
                        composer = editor.composer,
                        iframe = composer.iframe;

                    $(iframe).removeClass('wysihtml5-focus');
                }
            }
        });
    });
    // END BOOTSTRAP WYSIHTML5

    // easyPieChart
    $('.easyPieChart').each(function(){
        var $this = $(this),
            barColor = $this.attr('data-barColor'),
            trackColor = $this.attr('data-trackColor'),
            scaleColor = $this.attr('data-scaleColor'),
            lineWidth = $this.attr('data-lineWidth'),
            size = $this.attr('data-size'),
            rotate = $this.attr('data-rotate');

        // default for undefined
        barColor = (barColor === undefined) ? '#13A89E' : barColor ;        // teal
        trackColor = (trackColor === undefined) ? '#ecf0f1' : trackColor ;  // cloud
        scaleColor = (scaleColor === undefined) ? '#bdc3c7' : scaleColor ;  // silver
        lineWidth = (lineWidth === undefined) ? 3 : parseInt(lineWidth) ;
        size = (size === undefined) ? 110 : parseInt(size) ;
        rotate = (rotate === undefined) ? 0 : parseInt(rotate) ;

        trackColor = (trackColor == 'false' || trackColor == '') ? false : trackColor ;
        scaleColor = (scaleColor == 'false' || scaleColor == '') ? false : scaleColor ;

        // initilize easy pie chart
        $this.easyPieChart({
            barColor: barColor,
            trackColor: trackColor,
            scaleColor: scaleColor,
            lineWidth: lineWidth,
            size: size,
            rotate: rotate,
            onStep: function(from, to, currentValue) {
                $(this.el).find('span').text(currentValue.toFixed(0) +'%');
            }
        });
    });
});
    





// Be carefull to init wow: its not working on document ready
// WOW ANIMATED
// Panel Animated on viewport
var panel_aimated = true; // set to false if you dont want use animated on panel

if (panel_aimated) {
    var animated_panel = new WOW({
        boxClass:     'panel-animated',
        animateClass: 'animated fadeInUp',
        offset:       0
    });

    animated_panel.init();
};

// alias #1
var animated_onshow = new WOW({
    boxClass:     'animated-onshow',
    animateClass: 'animated',
    offset:       0
});

new WOW().init(); // use with default class .wow
// END WOW ANIMATED