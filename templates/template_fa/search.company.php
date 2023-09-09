<link rel='stylesheet' href="<?php echo  RELA_DIR ?>templates/assets/js/search/jquery.auto-complete.css">
<script src='<?php echo RELA_DIR . 'templates/'; ?>assets/js/search/jquery.auto-complete.min.js'></script>

<script>
    var baseURL = "<?php echo RELA_DIR; ?>";
    var c = "<?php echo ($list['c'] ?? '') ?>";
    var province = "<?php echo ($list['province'] ?? '') ?>";
    var city = "<?php echo ($list['city'] ?? '') ?>";
</script>

<script type="text/javascript">
    $(function($) {
        $('input[name=q]').autoComplete({
            ajax: '<?php echo RELA_DIR ?>company/ajaxSearch',
            postData: {}
        });
    });

    $body = $('body');


    $body.on('submit', '#searchParam', function(e) {
        e.preventDefault();
        submit_search();
    });

    // search function
    function submit_search() {

        var question = $('#q').val(),
            final_address = baseURL + 'company';

        if (c !== '') {
            final_address += '/c/' + c;

        }

        if (province !== '') {
            final_address += '/province/' + province;

        }

        if (city !== '') {
            final_address += '/city/' + city;

        }

        if (question.length > 0) {
            var urlParams = new URLSearchParams(window.location.search);
            
            if(urlParams.has('q')){
                urlParams.delete('q');
            }

            final_address += '/?q=' + question;
        }

        // console.log(final_address);


        window.location.href = final_address;
    }

    $('body').on('keydown', '#q', function(e) {
            var keyCode = e.which ? e.which : e.keycode;

            if (keyCode === 13) {
                submit_search();
            }
        })
        .focus(function() {
            $(this).parents('.search-wrap').addClass('active');
        })
        .blur(function() {
            $(this).parents('.search-wrap').removeClass('active');
        });
</script>
<!-- end search bar -->

<!-- sm:w-full -->
<form class="search-bar flex flex-grow lg:w-auto items-center" method="post" id="searchParam">

    <div class="keyboard-container-search-bar flex-grow">
        <input type="text" name="q" id="q" class="w-full flex-grow text-sm h-9  place keyboard q border-tolidatColor bg-gray-50 border-2 focus:outline-none rounded rounded-l-none px-3" placeholder="جست و جو در بین کسب و کارها ..." value="<?php echo isset($_GET['q']) ? $_GET['q'] : '' ?>">
    </div>


    <button type="submit" class="w-12 justify-center inline-flex submit text-large border-tolidatColor bg-tolidatColor border-r-0 rounded rounded-r-none items-center py-1 px-2 text-white h-9">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </button>

    <!-- icon mobile menu -->
    <div class="sm:mr-2 sm:-my-2  lg:hidden mr-1 hidden">
        <button id="btn-show-mobile-menu" type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-tolidatColor" @click="toggle" @mousedown="if (open) $event.preventDefault()" aria-expanded="false" :aria-expanded="open.toString()">
            <span class="sr-only">Open menu</span>
            <svg class="h-6 w-6" x-description="Heroicon name: outline/menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>
</form>