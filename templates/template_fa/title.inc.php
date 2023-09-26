<?php
global $company_info;
if ($company_info != -1) {
	$information_company = getInformation($list['company_id']);
	//print_r_debug($list['seo']['meta_keyword']);
	$banner = getBanner($list['company_id']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<title><?php echo (strlen($list['seo']['title']) > 0 ? $list['seo']['title'] : 'سایت اجتماعی تولیدات'); ?></title>
	<meta name="keywords" http-equiv="keywords" content="<?php echo ($list['seo']['meta_keyword']) ?>">
	<meta name="description" http-equiv="description" content="<?php echo ($list['seo']['description']); ?>">

	<?php if (strlen($list['canonical']) > 0) { ?>
		<link rel="canonical" href="<?php echo $list['canonical']; ?>"><?php } ?>

	<link rel="icon" type="image/png" href="<?php echo TEMPLATE_DIR; ?>assets/image/favicon.png">


	<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/style.css?1">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


	<style>
		.slick-slide {
			margin: 0 15px;
		}

		.slick-list {
			margin: 0 -15px;
		}
	</style>

	<?php if ($_SERVER['HTTP_HOST'] == 'tolidat.ir') : ?>


		<?php /*

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-3DNW76V5VK"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag('js', new Date());

			gtag('config', 'G-3DNW76V5VK');
		</script>

		<script>
			var baseURL = "<?php echo RELA_DIR; ?>";
		</script>

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-210017835-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag('js', new Date());

			gtag('config', 'UA-210017835-1');
		</script>
		*/ ?>

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-5FFC9W6');</script>
		<!-- End Google Tag Manager -->
		
	<?php endif; ?>

	

</head>

<body dir="rtl" class="">

	<?php if ($_SERVER['HTTP_HOST'] == 'tolidat.ir') : ?>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FFC9W6"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
	<?php endif; ?>

	<div class="">

		<!-- navigation -->
		<div class="relative">
			<div class="border-b-2 border-gray-100">
				<div class="flex flex-wrap justify-between items-center      container mx-auto px-3 sm:px-4">

					<div class="flex mb-3 w-full lg:w-auto items-center justify-center relative">

						<!-- mobile menu  -->
						<div class="lg:hidden absolute right-0 top-4">
							<button id="btn-show-mobile-menu" type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-tolidatColor" @click="toggle" @mousedown="if (open) $event.preventDefault()" aria-expanded="false" :aria-expanded="open.toString()">
								<span class="sr-only">Open menu</span>
								<svg class="h-6 w-6" x-description="Heroicon name: outline/menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
								</svg>
							</button>
                    	</div>

						<a class="w-full sm:w-auto flex justify-center" href="<?php echo RELA_DIR ?><?php echo isset($_SESSION['city']) ? $_SESSION['city'] : '' ?>">
							<img class="w-auto h-14" src="<?php echo TEMPLATE_DIR ?>assets/image/tolidat-logo.png" alt="Logo">
						</a>

					</div>

					<!-- search bar -->
					<!-- < ?php include __DIR__ . '/search.template.php'; ?> -->

					<nav id="container-mobile-menu" class="hidden lg:flex flex-row flex-wrap flex-grow w-full lg:w-auto">
						<div class="relative flex justify-ends flex-col lg:flex-row w-full lg:ml-0">

							<?php /*
							<div class="inline-flex border-b lg:border-0 border-gray-200  h-12 lg:h-8 px-4">
								<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class=" lg:w-auto flex items-center  w-full text-gray-500 hover:text-gray-900" name="" id="">
									<option value="<?php echo RELA_DIR ?>">انتخاب شهر</option>
									<option <?php echo ($_SESSION['city'] == 'تهران')?'selected':''?> value="تهران">تهران</option>
									<option <?php echo ($_SESSION['city'] == 'مشهد')?'selected':''?> value="مشهد">مشهد</option>
								</select>
							</div>
							*/?>

							<div class="inline-flex border-b lg:border-0 border-gray-200 h-12 lg:h-8">
								<a href="<?php echo RELA_DIR; ?><?php echo isset($_SESSION['city']) ? $_SESSION['city'] : '' ?>" class="w-full lg:w-auto flex items-center px-4   text-gray-500 hover:text-gray-900">
									خانه
								</a>
							</div>


							





							<div class="inline-flex border-b lg:border-0 border-gray-200 h-12 lg:h-8">
								<a href="<?php echo RELA_DIR; ?>company" class="w-full lg:w-auto flex items-center px-4 text-base font-medium text-gray-500 hover:text-gray-900">
									جستجوگر تولیدات
								</a>
							</div>

							<div class="inline-flex border-b lg:border-0 border-gray-200 h-12 lg:h-8">
								<a href="<?php echo RELA_DIR; ?>package/all" class="w-full lg:w-auto flex items-center px-4 text-base font-medium text-gray-500 hover:text-gray-900">
									تعرفه ها
								</a>
							</div>

							<div class="relative cursor-pointer 	">
								<?php if ($information_company != null) : ?>

									<div class="hidden lg:flex lg:items-center show-profile-menu lg:pt-1">
										<span> 
											<?php echo $information_company['companyName']  ?> 
										</span>

										<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
											<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
										</svg>
									</div>

									<div class="flex flex-col rounded-md top-10 left-0 lg:w-40 lg:hidden lg:absolute lg:bg-white lg:shadow-md profile-menu z-10">
										<div class="title-login w-full inline-flex border-b border-gray-200 h-12 lg:h-8">
											<a href="<?php echo RELA_DIR . "profile"; ?>" class="w-full  flex items-center px-4 text-base font-medium text-gray-500 hover:text-gray-900">
												پروفایل کاربری
											</a>
										</div>

										<div class="w-full inline-flex border-b lg:border-0 border-gray-200 h-12 lg:h-8">
											<a href="<?php echo RELA_DIR . 'login/logout' ?>" class="w-full  flex items-center px-4 text-base font-medium text-gray-500 hover:text-gray-900">
												خروج
											</a>
										</div>	
									</div>
									
								<?php else : ?>

									<!-- <img src="https://img.icons8.com/ios-filled/30/aaaaaa/user-male-circle.png"  /> -->
									<div class="hidden lg:inline-block show-profile-menu pr-2">
										<svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
										</svg>
									</div>

									<div class="flex flex-col rounded-md top-10 left-0 lg:w-40 lg:hidden lg:absolute lg:bg-white lg:shadow-md profile-menu z-10">
										<div class="w-full inline-flex border-b border-gray-200 h-12 lg:h-8">
											<a href="<?php echo RELA_DIR . "login" ?>" class="w-full flex items-center px-4 text-base font-medium text-gray-500 hover:text-gray-900">
												ورود
											</a>
										</div>

										<div class="w-full inline-flex border-b lg:border-0 border-gray-200 h-12 lg:h-8">
											<a href="<?php echo RELA_DIR . "register" ?>" class="w-full flex items-center px-4 text-base font-medium text-gray-500 hover:text-gray-900">
												ثبت نام
												<!-- <img src="https://img.icons8.com/ios-filled/30/aaaaaa/user-male-circle.png" /> -->
											</a>
										</div>	
									</div>
									

								<?php endif ?>
							</div>
						</div>
					</nav>

					<!-- <div>
						< ?php if ($information_company != null) : ?>

							<div class="title-login inline-flex h-12 lg:h-8">
								<a href="< ?php echo RELA_DIR . "profile"; ?>" class="w-full lg:w-auto flex items-center px-4 text-base font-medium text-gray-500 hover:text-gray-900">
									< ?php echo $information_company['companyName'] ?>
									<img class="mr-1" src="https://img.icons8.com/ios-filled/30/aaaaaa/user-male-circle.png" />
								</a>

							</div>
							
							< ?php else : ?>
							<div class="inline-flex h-12 lg:h-8">



								<a href="< ?php echo RELA_DIR . "login" ?>" class="flex items-center  px-4   text-gray-500 hover:text-gray-900">
									ورود
								</a>



								
								<a href="< ?php echo RELA_DIR . "register" ?>" class="w-full lg:w-auto flex items-center px-4   text-gray-500 hover:text-gray-900">
										ثبت نام 
									<img src="https://img.icons8.com/ios-filled/30/aaaaaa/user-male-circle.png" />
								</a>
								
							</div>

						< ?php endif ?>
					</div>  -->

					<!-- phone icon and call -->
					<!-- <div class="hidden xl:flex items-center justify-end ">
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
							</svg>
						</div>

						<div class="text-sm ">
							<p class="text-gray-500">پشتیبانی تولیدات</p>
							<p class=" font-medium text-black" dir="ltr">۰۲۱-۲۲۴۳۵۲۰۰</p>
						</div>
					</div> -->

				</div>
			</div>
		</div>

			
		<script>
			var $profile = $('.profile-menu');
			var $body = $('body');

			$('.show-profile-menu').on("click", function (e) {
				e.stopPropagation();
				if ($profile.hasClass('is-active')) {
					$profile.removeClass('is-active');
				} else {
					$profile.addClass('is-active');
				}
				// e.stopPropagation();
				// $(this).toggleClass('is-active');
				// $('.menu-content').toggleClass("is-open");

			});

			$body.on('click', function () {
				if ($profile.hasClass('is-active')) {
					$profile.removeClass('is-active');
				}
			});
			// $(".menu-content").on("click", function (e) {
			// 	e.stopPropagation();
			// });
		</script>