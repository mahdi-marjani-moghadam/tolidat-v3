<div class="">
    <div class="border-2 p-5 mt-4 rounded bg-gray-50">

        <h1 class="truncate text-tolidatColor border-b pb-1 mb-2 ">
            <?php echo $list['side']['list']['company_name']; ?>
        </h1>



        <div class="flex flex-col items-center">
        <div class="flex flex-col sm:flex-row justify-around w-full">

            <div class="mx-auto sm:m-0" role="progressbar" aria-valuenow="<?php echo $list['side']['list']['priority'] ?>" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo $list['side']['list']['priority'] ?>; --size:8rem; --fg:hsl(<?php echo $list['side']['list']['priority'] ?>deg,70%,50%)">
            </div>

            <div class="text-center flex flex-col justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 150 150" xmlns:v="https://vecta.io/nano">
                    <circle cx="75" cy="75" r="74.75" fill="#fff" />
                    <g fill="#ff720e">
                        <circle cx="68.43" cy="57.74" r="16.55" />
                        <path d="M99.38 25.75l-15.34-4.19a58.61 58.61 0 0 0-30.96.02l-16.29 4.47A16.04 16.04 0 0 0 25 41.52v35.73c0 5.86 2.14 11.52 6.03 15.91l26.8 30.27c5.36 6.05 14.67 6.45 20.53.88l10.8-10.27L82 107.7l4.25-5.19 7.76 6.9 9.71-9.23a23.98 23.98 0 0 0 7.46-17.39V41.22c.01-7.23-4.83-13.56-11.8-15.47zm-1.1 58.05c-.08-1.6-.39-3.19-.96-4.72-3.31-8.95-13.04-6.03-17.13-2.72s-10.12 2.72-10.12 2.72h-3.05s-6.03.58-10.12-2.72c-4.09-3.31-13.82-6.23-17.13 2.72a36.11 36.11 0 0 0-1.25 4.16 33.61 33.61 0 0 1-3.82-15.61c0-18.69 15.15-33.83 33.83-33.83 18.69 0 33.83 15.15 33.83 33.83a33.32 33.32 0 0 1-4.08 16.17z" />
                    </g>
                    <path d="M99.84 80.2c-13.89 0-25.16 11.26-25.16 25.16s11.26 25.16 25.16 25.16S125 119.26 125 105.36 113.74 80.2 99.84 80.2zm-3.62 40.09L82 107.7l4.25-5.19 9.15 8.13 17.98-18.3 4.9 4.74-22.06 23.21z" fill="#5fb769" />
                </svg>
                تأیید شده توسط تولیدات

            </div>
        </div>


            <div class="w-full justify-around items-center text-center flex  border-t mt-2 pt-2">
                <div>
                    <span class="text-sm text-gray-600">محصولات:</span>
                    <span class="font-bold"><?php echo $list['side']['rate']['product_count'] ?>
                </div></span>
                <div>
                    <span class="text-sm text-gray-600">پکیج:</span>
                    <span class="font-bold"><?php echo $list['side']['rate']['package_type'] ?></span>
                </div>
            </div>

        </div>



    </div>

    <div class="border-2 p-5 mt-4 rounded bg-gray-50 ">

        <div class="row noMargin overlayCompany text-sm text-gray-700  leading-relaxed"> 
            <div>
                نام مدیرعامل :
                <span class="font-bold text-black"><?php echo ($list['side']['list']['maneger_name'] != "" ? $list['side']['list']['maneger_name'] : "-"); ?> </span>

            </div>
            <?php if (($list['side']['list']['company_type'] == 1)) { ?>
                <div>
                    شماره ثبت :
                    <span class="font-bold text-black"><?php echo ($list['side']['list']['registration_number'] != "" ? "مورد تایید تولیدات" : "-"); ?></span>
                </div>
                <div>
                    شناسه ملی :
                    <span class="font-bold text-black"><?php echo ($list['side']['list']['national_id'] != "" ? "مورد تایید تولیدات" : "-"); ?></span>
                </div>
            <?php } else { ?>
                <div>
                    شماره جواز :
                    <span class="font-bold text-black"><?php echo ($list['side']['licence']['licence_number'] != "" ? "مورد تایید تولیدات" : "-"); ?></span>
                </div>
                <div>
                    نوع جواز :
                    <span class="font-bold text-black"><?php echo ($list['side']['licence']['licence_name'] != "" ? $list['side']['licence']['licence_name'] : "-"); ?></span>
                </div>
            <?php } ?>
            <div class=" code-company">
                <p class="mt-2">کد اختصاصی مجموعه :
                    <span class="font-bold text-black border-2  border-tolidatColor rounded-full px-1 "><?php echo $list['side']['list']['Company_id'] ?></span>
                </p>


            </div>

            <div class="border-t mt-2 pt-2  ">
                
                <div class="flex flex-col branch-info  leading-relaxed ">
                    <?php
                    $cnt = 0;
                    foreach ($list['side']['branch_list'] as $branch => $k) :
                        if ($cnt == 0) :
                    ?>

                            <?php if (strlen($k['phones'][array_keys($k['phones'])[0]]['number'])) : ?>
                                <a id="btn-call-to-company" href="tel:<?php echo  $k['phones'][array_keys($k['phones'])[0]]['code'] . $k['phones'][array_keys($k['phones'])[0]]['number']; ?>">
                                    <?php echo  $k['phones'][array_keys($k['phones'])[0]]['code'] . $k['phones'][array_keys($k['phones'])[0]]['number']; ?>
                                </a>
                            <?php endif; ?>

                            <?php if (strlen($k['websites'][array_keys($k['websites'])[0]]['url'])) : ?>
                                <a class="border border-tolidatColor rounded-full px-4 my-1 w-auto inline-block" rel="nofollow" href="<?php echo  'http://' . $k['websites'][array_keys($k['websites'])[0]]['url']; ?>" target="_blank">
                                    <i class="pull-right text-center fa fa-globe" aria-hidden="true"></i>
                                    <span class="pull-right"><?php echo  $k['websites'][array_keys($k['websites'])[0]]['url']; ?></span>
                                </a>
                            <?php endif; ?>

                            <?php if (strlen($k['emails'][array_keys($k['emails'])[0]]['email'])) : ?>
                                <a href="mailto:<?php echo  $k['emails'][array_keys($k['emails'])[0]]['email']; ?>">
                                    <i class="pull-right text-center fa fa-envelope" aria-hidden="true"></i>
                                    <span class="pull-right"><?php echo  $k['emails'][array_keys($k['emails'])[0]]['email']; ?></span>
                                </a>
                            <?php endif; ?>

                            <?php if (strlen($k['addresses'][array_keys($k['addresses'])[0]]['address'])) : ?>
                                <a>
                                    <i class="pull-right text-center fa fa-map-marker" aria-hidden="true"></i>
                                    <span class="pull-right">
                                        <?php echo  $list['side']['province'] . ' - ' . $k['addresses'][array_keys($k['addresses'])[0]]['address']; ?>
                                    </span>
                                </a>
                            <?php endif; ?>

                            <?php if (strlen($k['addresses'][array_keys($k['addresses'])[0]]['location'])) : ?>
                                <div id="mapid" style="width:100% ; height:200px"></div>
                                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
                                    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
                                    crossorigin="anonymous" />

                                <!-- Make sure you put this AFTER Leaflet's CSS -->
                                <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                                            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                                            crossorigin=""></script>

                                <script>
                                    var map = L.map('mapid')
                                        .setView([<?php echo $k['addresses'][array_keys($k['addresses'])[0]]['location'] ?? '31.5,51.2' ?>], 16);

                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        attribution: '&copy; <a href="https://tarhoweb.com">Tarhoweb</a> contributors',
                                        // zoomOffset: -1
                                        // maxZoom: 18,
                                        // tileSize: 512
                                    }).addTo(map);


                                    //marker
                                    var marker = L.marker([<?php echo $k['addresses'][array_keys($k['addresses'])[0]]['location'] ?? '31.5,51.2' ?>])
                                        .addTo(map)
                                        .bindPopup(`<?php echo $list['side']['list']['company_name']?>`)
                                        .openPopup();



                                    //meghyas
                                    L.control.scale().addTo(map);

                                    //scroll disable zoom
                                    map.scrollWheelZoom.disable();
                                </script>
                            <?php endif; ?>
                    <?php
                        endif;

                        $cnt++;
                    endforeach;

                    ?>

                    <div class="category-inside border-t pt-2 flex flex-wrap gap-2">
                        دسته بندی:
                        <!-- <i class="pull-right text-center fa fa-bars" aria-hidden="true"></i> -->
                        <?php
                        $cnt = 0;
                        foreach ($list['side']['category_title'] as $category => $v) :
                        ?>
                            <a class="border border-tolidatColor px-1 rounded-full text-xs " href="<?php echo RELA_DIR . 'company/type/تولیدی/category/' . $v['Category_id'] ?>">
                                <?php echo  $v['title'] . ($cnt < count($list['side']['category_title']) - 1 ? ' - ' : ''); ?>
                            </a>
                        <?php
                            $cnt++;
                        endforeach;
                        ?>
                    </div>

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>
                </div>
            </div>

            <?php
            if (count($list['side']['socials'])) :
            ?>
                <div class="border-t mt-2 pt-2">
                    

                    <div class="icon-footer branch-info flex flex-col">
                        <?php
                        foreach ($list['side']['socials'] as $branch) :
                            if (count($branch)) {
                        ?>
                                <a target="_blank" href="<?php echo $branch['url']; ?>">
                                    <i class="pull-right text-center fa fa-<?php echo  $branch['type']; ?>" aria-hidden="true"></i>
                                    <span class="pull-right"><?php echo str_replace(array("http://", "https://"), "", $branch['url']); ?></span>
                                </a>
                        <?php
                            }
                        endforeach;
                        ?>
                    </div>
                </div>
            <?php
            endif;
            ?>

            <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
              
                <div id="qrcode" class="center-block"></div>
               





                <a class="text-white bg-tolidatColor rounded-full px-4 cursor-pointer "  onclick="myFunction('<?php echo RELA_DIR . $list['side']['list']['Company_id'] ?>')">کپی لینک پروفایل</a>

                <script>
                    function myFunction(copyText) {

                        /* Copy the text inside the text field */
                        navigator.clipboard.writeText(copyText);

                        /* Alert the copied text */
                        // window.location = copyText;

                        alert("آدرس پروفایل کپی شد.");
                    }
                </script>

            </div>
        </div>

    </div>
</div>

<style>
    #btn-call-to-company{
        background: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2MCA2MCI+PHBhdGggZD0ibTcuMTA0IDE0LjAzMiAxNS41ODYgMS45ODRzLS4wMTkuNSAwIC45NTNhMi44OTIgMi44OTIgMCAwIDEtLjgwOSAyLjFsLTQuNzQgNC43NDJjMi4zNjEgMy4zIDE2LjUgMTcuNCAxOS44IDE5LjhsMTYuODEzIDEuMTQxdjEuMWExLjg2NiAxLjg2NiAwIDAgMS0uNTQ5IDEuMzI3bC02LjUwNCA2LjUwNXMtMTEuMjYxLjk4OC0yNS45MjUtMTMuNjc0QzYuMTE3IDI1LjMgNy4xIDE0IDcuMSAxNCIgZmlsbD0iIzAwOWQwMCIvPjxwYXRoIGQ9Im03LjEwNCAxMy4wMzIgNi41MDQtNi41MDVjLjg5Ni0uODk1IDIuMzM0LS42NzggMy4xLjM1bDUuNTYzIDcuOGMuNzM4IDEgLjUgMi41MzEtLjM2IDMuNDI2bC00Ljc0IDQuNzQyYzIuMzYxIDMuMyA1LjMgNi45IDkuMSAxMC42OTkgMy44NDIgMy44IDcuNCA2LjcgMTAuNyA5LjFsNC43NC00Ljc0MmMuODk3LS44OTUgMi40NzEtMS4wMjYgMy40OTgtLjI4OWw3LjY0NiA1LjQ1NWMxLjAyNS43IDEuMyAyLjIuNCAzLjEwNWwtNi41MDQgNi41cy0xMS4yNjIuOTg4LTI1LjkyNS0xMy42NzRDNi4xMTcgMjQuMyA3LjEgMTMgNy4xIDEzIiBmaWxsPSIjZmZmIi8+PC9zdmc+) 10%/35px 27px no-repeat #0b0;
            padding: .5em 1em .5em 50px;
            content: "";
            color: white;
            border-radius: 50px;
            max-width:150px;
    }
    @media screen and (max-width:1023px) {   
        #btn-call-to-company{
            position: fixed;
            bottom: 20px;
            right: 10px;
            
        }
    }
    
</style>