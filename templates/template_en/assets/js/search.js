 $(document).ready(function () {
     var categoryCheckBoxes = $('input[name="c[]"]');
     var category = $('i[name="category[]"]');
     var provinceCheckBoxes = $('input[name="province[]"]');
     var province = $('i[name="province[]"]');
     var cityCheckBoxes = $('input[name="city[]"]');
     var city = $('i[name="city[]"]');
     var url = decodeURIComponent(window.location.pathname);
     var urlParams = url.split('/');
     var urlQueryParams = new URLSearchParams(window.location.search);
     var orderIndex = urlParams.indexOf('order');
     var viewIndex = urlParams.indexOf('view');
     var categoryIndex = urlParams.indexOf('c');
     var provinceIndex = urlParams.indexOf('province');
     var cityIndex = urlParams.indexOf('city');
     var categories = "";
     var provinces = "";
     var cities = "";
     var view = "";

     if (categoryIndex != -1) {
         if (urlParams[categoryIndex + 1]) {
             categories = urlParams[categoryIndex + 1];
         }
     }
     if (provinceIndex != -1) {
         if (urlParams[provinceIndex + 1]) {
             provinces = urlParams[provinceIndex + 1];
         }
     }
     if (cityIndex != -1) {
         if (urlParams[cityIndex + 1]) {
             cities = urlParams[cityIndex + 1];
         }
     }
     if (orderIndex != -1) {
         if (urlParams[orderIndex + 1]) {
             if (urlParams[orderIndex + 1] == 'ASC') {
                 $('#search-sort').data('value', 'ASC');
                 $('#search-sort i').removeClass('fa-sort-amount-desc a');
                 $('#search-sort i').addClass('fa-sort-amount-asc a');
             } else if (urlParams[orderIndex + 1] == 'DESC') {
                 $('#search-sort').data('value', 'DESC');
                 $('#search-sort i').removeClass('fa-sort-amount-asc a');
                 $('#search-sort i').addClass('fa-sort-amount-desc a');
             }
         }
     }
     if (viewIndex != -1) {
         if (urlParams[viewIndex + 1]) {
             view = urlParams[viewIndex + 1];
             showMethod(view);
         }
     }

     var categoriesArray = categories.split(',');
     var provincesArray = provinces.split(',');
     var citiesArray = cities.split(',');


     for (var i = 0; i < categoryCheckBoxes.length; i++) {
         if (categoriesArray.indexOf(categoryCheckBoxes[i].value) != -1) {
             categoryCheckBoxes[i].checked = true;
         }
     }

     for (var i = 0; i < provinceCheckBoxes.length; i++) {
         if (provincesArray.indexOf(provinceCheckBoxes[i].value) != -1) {
             provinceCheckBoxes[i].checked = true;
         }
     }

     for (var i = 0; i < cityCheckBoxes.length; i++) {
         if (citiesArray.indexOf(cityCheckBoxes[i].value) != -1) {
             cityCheckBoxes[i].checked = true;
         }
     }

     //------ vahed

     // categoryFillter
     function categoryFillter(fillterIndex) {
         var newUrl = "";
         categories = "";
         url = decodeURIComponent(window.location.pathname);
         urlParams = resetUrl(url.split('/'));
         categoryIndex = urlParams.indexOf('c');
         for (var i = 0; i < categoryCheckBoxes.length; i++) {
             if (categoryCheckBoxes[i].checked) {

                 if (categoryCheckBoxes[i].value == fillterIndex) {
                     categoryCheckBoxes[i].checked = false;
                 }
             }
         }
         for (var i = 0; i < categoryCheckBoxes.length; i++) {
             if (categoryCheckBoxes[i].checked) {
                 categories += categoryCheckBoxes[i].value + ',';
             }
         }
         categories = categories.substring(0, categories.length - 1);

         if (categoryIndex != -1 && (urlParams[categoryIndex + 1] != 'page' && urlParams[categoryIndex + 1] != 'city' && urlParams[categoryIndex + 1] != 'exportType' && urlParams[categoryIndex + 1] != 'order' && urlParams[categoryIndex + 1] != 'type' && urlParams[categoryIndex + 1] != 'q' && urlParams[categoryIndex + 1] != 'view')) {
             urlParams[categoryIndex + 1] = categories;
         } else if (categoryIndex != -1 && (urlParams[categoryIndex + 1] == 'page' || urlParams[categoryIndex + 1] == 'city' || urlParams[categoryIndex + 1] == 'exportType' || urlParams[categoryIndex + 1] == 'order' || urlParams[categoryIndex + 1] == 'type' || urlParams[categoryIndex + 1] == 'q' || urlParams[categoryIndex + 1] == 'view')) {
             for (var i = urlParams.length; i > categoryIndex; i--) {
                 urlParams[i] = urlParams[i - 1];
             }
             urlParams[categoryIndex + 1] = categories;
         } else {
             var l = urlParams.length;
             urlParams.splice(l, 0, 'c');
             urlParams.splice(l + 1, 0, categories);
         }
         for (var i = 0; i < urlParams.length; i++) {
             if (urlParams[i]) {
                 if (urlParams[i] == 'c' && categories == '') {
                     newUrl = newUrl;
                 } else {
                     newUrl += urlParams[i] + '/';
                 }
             }
         }

         newUrl = addSearchQueryInUrl(newUrl);

         window.location.href = window.location.protocol + '//' + window.location.host + '/' + newUrl;
     }
     $('body').on('change', '.search-box input[name="c[]"]', function () {
         var newUrl = "";
         categories = "";
         url = decodeURIComponent(window.location.pathname);
         urlParams = resetUrl(url.split('/'));
         categoryIndex = urlParams.indexOf('c');


         for (var i = 0; i < categoryCheckBoxes.length; i++) {
             if (categoryCheckBoxes[i].checked) {
                 categories += categoryCheckBoxes[i].value + ',';
             }
         }



         categories = categories.substring(0, categories.length - 1);

         //  console.log(categories);

         if (categoryIndex != -1 && (urlParams[categoryIndex + 1] != 'page' && urlParams[categoryIndex + 1] != 'city' && urlParams[categoryIndex + 1] != 'exportType' && urlParams[categoryIndex + 1] != 'order' && urlParams[categoryIndex + 1] != 'type' && urlParams[categoryIndex + 1] != 'q' && urlParams[categoryIndex + 1] != 'view')) {

             urlParams[categoryIndex + 1] = categories;
         } else if (categoryIndex != -1 && (urlParams[categoryIndex + 1] == 'page' || urlParams[categoryIndex + 1] == 'city' || urlParams[categoryIndex + 1] == 'exportType' || urlParams[categoryIndex + 1] == 'order' || urlParams[categoryIndex + 1] == 'type' || urlParams[categoryIndex + 1] == 'q' || urlParams[categoryIndex + 1] == 'view')) {

             for (var i = urlParams.length; i > categoryIndex; i--) {
                 urlParams[i] = urlParams[i - 1];
             }

             urlParams[categoryIndex + 1] = categories;

         } else {
             var l = urlParams.length;
             urlParams.splice(l, 0, 'c');
             urlParams.splice(l + 1, 0, categories);
         }

         //  console.log(urlParams);

         for (var i = 0; i < urlParams.length; i++) {
             if (urlParams[i]) {
                 if (urlParams[i] == 'c' && categories == '') {
                     newUrl = newUrl;
                 } else {
                     newUrl += urlParams[i] + '/';
                 }
             }
         }

         newUrl = addSearchQueryInUrl(newUrl);

         //  console.log(window.location.protocol + '//' + window.location.host + '/' + newUrl);
         window.location.href = window.location.protocol + '//' + window.location.host + '/' + newUrl;
     });
     $('.close-filter-container a').on('click', 'i[name="category[]"]', function (e) {
         e.preventDefault();
         fillterIndex = this.id;
         categoryFillter(fillterIndex);
     });

     // cityFillter
     function cityFillter(fillterIndex) {

         var newUrl = "";
         cities = "";
         url = decodeURIComponent(window.location.pathname);
         urlParams = resetUrl(url.split('/'));
         cityIndex = urlParams.indexOf('city');
         for (var i = 0; i < cityCheckBoxes.length; i++) {
             if (cityCheckBoxes[i].checked) {
                 if (cityCheckBoxes[i].id == fillterIndex) {
                     cityCheckBoxes[i].checked = false;
                 }
             }
         }

         for (var i = 0; i < cityCheckBoxes.length; i++) {
             if (cityCheckBoxes[i].checked) {
                 cities += cityCheckBoxes[i].value + ',';
             }
         }
         cities = cities.substring(0, cities.length - 1);

         if (cityIndex != -1 && (urlParams[cityIndex + 1] != 'page' && urlParams[cityIndex + 1] != 'city' && urlParams[cityIndex + 1] != 'exportType' && urlParams[cityIndex + 1] != 'order' && urlParams[cityIndex + 1] != 'type' && urlParams[cityIndex + 1] != 'q' && urlParams[cityIndex + 1] != 'view')) {
             urlParams[cityIndex + 1] = cities;
         } else if (cityIndex != -1 && (urlParams[cityIndex + 1] == 'page' || urlParams[cityIndex + 1] == 'city' || urlParams[cityIndex + 1] == 'exportType' || urlParams[cityIndex + 1] == 'order' || urlParams[cityIndex + 1] == 'type' || urlParams[cityIndex + 1] == 'q' || urlParams[cityIndex + 1] == 'view')) {
             for (var i = urlParams.length; i > cityIndex; i--) {
                 urlParams[i] = urlParams[i - 1];
             }
             urlParams[cityIndex + 1] = cities;
         } else {
             var l = urlParams.length;
             urlParams.splice(l, 0, 'city');
             urlParams.splice(l + 1, 0, cities);
         }
         for (var i = 0; i < urlParams.length; i++) {
             if (urlParams[i]) {
                 if (urlParams[i] == 'city' && cities == '') {
                     newUrl = newUrl;
                 } else {
                     newUrl += urlParams[i] + '/';
                 }
             }
         }
         newUrl = addSearchQueryInUrl(newUrl);

         window.location.href = window.location.protocol + '//' + window.location.host + '/' + newUrl;
     }
     $('.search-box').on('change', 'input[name="city[]"]', function (e) {
         e.preventDefault();

         var newUrl = "";
         cities = "";
         url = decodeURIComponent(window.location.pathname);
         urlParams = resetUrl(url.split('/'));
         cityIndex = urlParams.indexOf('city');

         for (var i = 0; i < cityCheckBoxes.length; i++) {
             if (cityCheckBoxes[i].checked) {
                 cities += cityCheckBoxes[i].value + ',';
             }
         }
         cities = cities.substring(0, cities.length - 1);
         if (cityIndex != -1 && (urlParams[cityIndex + 1] != 'page' && urlParams[cityIndex + 1] != 'category' && urlParams[cityIndex + 1] != 'exportType' && urlParams[cityIndex + 1] != 'order' && urlParams[cityIndex + 1] != 'type' && urlParams[cityIndex + 1] != 'q' != 'type' && urlParams[cityIndex + 1] != 'view')) {
             urlParams[cityIndex + 1] = cities;
         } else if (cityIndex != -1 && (urlParams[cityIndex + 1] == 'page' || urlParams[cityIndex + 1] == 'category' || urlParams[cityIndex + 1] == 'exportType' || urlParams[cityIndex + 1] == 'order' || urlParams[cityIndex + 1] == 'type' || urlParams[cityIndex + 1] == 'q' || urlParams[cityIndex + 1] == 'view')) {
             for (var i = urlParams.length; i > cityIndex; i--) {
                 urlParams[i] = urlParams[i - 1];
             }
             urlParams[cityIndex + 1] = cities;
         } else {
             var l = urlParams.length;
             urlParams.splice(l, 0, 'city');
             urlParams.splice(l + 1, 0, cities);
         }
         for (var i = 0; i < urlParams.length; i++) {
             if (urlParams[i]) {
                 if (urlParams[i] == 'city' && cities == '') {
                     newUrl = newUrl;
                 } else {
                     newUrl += urlParams[i] + '/';
                 }
             }
         }
         newUrl = addSearchQueryInUrl(newUrl);

         window.location.href = window.location.protocol + '//' + window.location.host + '/' + newUrl;
     });
     $('.close-filter-container a').on('click', 'i[name="city[]"]', function (e) {
         e.preventDefault();
         fillterIndex = this.id;
         cityFillter(fillterIndex);
     });

     // provinceFillter
     function provinceFillter(fillterIndex) {
         var newUrl = "";
         provinces = "";
         url = decodeURIComponent(window.location.pathname);
         urlParams = resetUrl(url.split('/'));


         provinceIndex = urlParams.indexOf('province');

         for (var i = 0; i < provinceCheckBoxes.length; i++) {
             if (provinceCheckBoxes[i].checked) {

                 if (provinceCheckBoxes[i].id == "province-" + fillterIndex) {

                     provinceCheckBoxes[i].checked = false;
                 }
             }
         }

         for (var i = 0; i < provinceCheckBoxes.length; i++) {
             if (provinceCheckBoxes[i].checked) {
                 provinces += provinceCheckBoxes[i].value + ',';
             }
         }
         provinces = provinces.substring(0, provinces.length - 1);

         if (provinceIndex != -1 && (urlParams[provinceIndex + 1] != 'page' && urlParams[provinceIndex + 1] != 'province' && urlParams[provinceIndex + 1] != 'exportType' && urlParams[provinceIndex + 1] != 'order' && urlParams[provinceIndex + 1] != 'type' && urlParams[provinceIndex + 1] != 'q' && urlParams[provinceIndex + 1] != 'view')) {
             urlParams[provinceIndex + 1] = provinces;
         } else if (provinceIndex != -1 && (urlParams[provinceIndex + 1] == 'page' || urlParams[provinceIndex + 1] == 'province' || urlParams[provinceIndex + 1] == 'exportType' || urlParams[provinceIndex + 1] == 'order' || urlParams[provinceIndex + 1] == 'type' || urlParams[provinceIndex + 1] == 'q' || urlParams[provinceIndex + 1] == 'view')) {
             for (var i = urlParams.length; i > provinceIndex; i--) {
                 urlParams[i] = urlParams[i - 1];
             }
             urlParams[provinceIndex + 1] = provinces;
         } else {
             var l = urlParams.length;
             urlParams.splice(l, 0, 'province');
             urlParams.splice(l + 1, 0, provinces);
         }
         for (var i = 0; i < urlParams.length; i++) {
             if (urlParams[i]) {
                 if (urlParams[i] == 'province' && provinces == '') {
                     newUrl = newUrl;
                 } else {
                     newUrl += urlParams[i] + '/';
                 }
             }
         }
         newUrl = addSearchQueryInUrl(newUrl);

         window.location.href = window.location.protocol + '//' + window.location.host + '/' + newUrl;
     }
     $('.search-box').on('change', 'input[name="province[]"]', function () {

         var newUrl = "";
         provinces = "";
         url = decodeURIComponent(window.location.pathname);
         urlParams = resetUrl(url.split('/'));
         provinceIndex = urlParams.indexOf('province');

         for (var i = 0; i < provinceCheckBoxes.length; i++) {
             if (provinceCheckBoxes[i].checked) {
                 provinces += provinceCheckBoxes[i].value + ',';
             }
         }

         provinces = provinces.substring(0, provinces.length - 1);

         if (provinceIndex != -1 && (urlParams[provinceIndex + 1] != 'page' && urlParams[provinceIndex + 1] != 'category' && urlParams[provinceIndex + 1] != 'exportType' && urlParams[provinceIndex + 1] != 'order' && urlParams[provinceIndex + 1] != 'type' && urlParams[provinceIndex + 1] != 'q' != 'type' && urlParams[provinceIndex + 1] != 'view')) {
             urlParams[provinceIndex + 1] = provinces;
         } else if (provinceIndex != -1 && (urlParams[provinceIndex + 1] == 'page' || urlParams[provinceIndex + 1] == 'category' || urlParams[provinceIndex + 1] == 'exportType' || urlParams[provinceIndex + 1] == 'order' || urlParams[provinceIndex + 1] == 'type' || urlParams[provinceIndex + 1] == 'q' || urlParams[provinceIndex + 1] == 'view')) {
             for (var i = urlParams.length; i > provinceIndex; i--) {
                 urlParams[i] = urlParams[i - 1];
             }
             urlParams[provinceIndex + 1] = provinces;
         } else {
             var l = urlParams.length;
             urlParams.splice(l, 0, 'province');
             urlParams.splice(l + 1, 0, provinces);
         }

         for (var i = 0; i < urlParams.length; i++) {
             if (urlParams[i]) {
                 if (urlParams[i] == 'province' && provinces == '') {
                     newUrl = newUrl;
                 } else {
                     newUrl += urlParams[i] + '/';
                 }
             }
         }
         newUrl = addSearchQueryInUrl(newUrl);

         window.location.href = window.location.protocol + '//' + window.location.host + '/' + newUrl;
     });
     $('.close-filter-container a').on('click', 'i[name="province[]"]', function () {
         fillterIndex = this.id;
         provinceFillter(fillterIndex);
     });


     //end vahed

     $('#search-sort').on('click', function (e) {
         e.preventDefault();
         var newUrl = "";
         var order = $(this).data('value');
         if (order == 'ASC') {
             order = 'DESC';
         } else {
             order = 'ASC';
         }
         if (orderIndex != -1) {
             urlParams[orderIndex + 1] = order;
         } else {
             var l = urlParams.length;
             urlParams.splice(l, 0, 'order');
             urlParams.splice(l + 1, 0, order);
         }
         for (var i = 0; i < urlParams.length; i++) {
             if (urlParams[i]) {
                 if (urlParams[i] == 'order' && order == '') {
                     newUrl = newUrl;
                 } else {
                     newUrl += urlParams[i] + '/';
                 }
             }
         }
         newUrl = addSearchQueryInUrl(newUrl);

         window.location.href = window.location.protocol + '//' + window.location.host + '/' + newUrl;
     });
     $('.showMethod').on('click', function (e) {
         e.preventDefault();
         var newUrl = "";
         var view = $(this).data('type');
         if (viewIndex != -1) {
             urlParams[viewIndex + 1] = view;
         } else {
             var l = urlParams.length;
             urlParams.splice(l, 0, 'view');
             urlParams.splice(l + 1, 0, view);
         }
         for (var i = 0; i < urlParams.length; i++) {
             if (urlParams[i]) {
                 if (urlParams[i] == 'view' && view == '') {
                     newUrl = newUrl;
                 } else {
                     newUrl += urlParams[i] + '/';
                 }
             }
         }
         newUrl = addSearchQueryInUrl(newUrl);

         window.location.href = window.location.protocol + '//' + window.location.host + '/' + newUrl;
     });

     function resetUrl(url) {
         var pageIndex = url.indexOf('page');
         if (pageIndex != -1) {
             delete url[pageIndex];
             delete url[pageIndex + 1];
         }
         return url;
     }

     function addSearchQueryInUrl($url) {
         if (urlQueryParams.has('q')) {
             var q = urlQueryParams.get('q');
             $url += '?q=' + q
         }
         return $url
     }
 });