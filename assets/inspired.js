var INS = window.INS || {};
INS = {
	init: function() {
		var template = shop.template;
		this.Main.init();
		if(template == 'index')
			this.Home.init();
		if(template == 'cart')
			this.Cart.init();
		if(template == 'product')
			this.Product.init();
		if(template == 'collection')
			this.Collection.init();
	},
	resize: function() {
		this.actionResize.init();
	},
	load: function() {
		this.loadPage.init();
	}
}
$(document).ready(function() {
	INS.init();
})
$(window).on('load resize', function(){
	INS.load();
});
$(window).on('resize', function(){
	INS.resize();
});
INS.Main = {
	settings: {
		context: null,
		moneyFormat: window.shop.moneyFormat,
		shopCurrency: window.shop.shopCurrency,
		productDiscr: null,
		productId: null,
		productJson: null,
		productAvailable: true,
		productVariantsSize: 0,
		productOptionsSize: 0,
		productOptions: [],
		selectedVariantId: null,
		linkOptionSelectorsEnabled: false,
		addToCartLabel: "Thêm vào giỏ",
		soldOutLabel: "Hết hàng",
		unavailableLabel: "Chưa có hàng"
	},
	init: function(){
		this.bindEvents();
	},
	bindEvents: function(){
		var self = this;
		this.buildFastClickMenthol();
		$(document).on('click', '.insQickview', this.buildQuickviewAjaxEvent.bind(this));
		$(document).on('click', '.qtyControl', this.buildQtyChangedEvent.bind(this));
		$(document).on('click', '.listThumbs .imgThumb a', this.buildImageChangedEvent.bind(this));
		$(document).on('click', '.miniCart .itemCart a.removeCart', this.buildRemoveItemMiniCartEvent.bind(this));
		$(document).on('submit','.customerForm form', this.buildAjaxCustomerFormEvent.bind(this));
		this.buildReplaceImageMenthol(3000);
		this.buildReplaceRegExpImgEvent();
		this.buildAddCartEvents();
		this.buildMobileEvents();
		this.buildScrollEvents();
	},
	buildFastClickMenthol: function(){
		$(function() {
			FastClick.attach(document.body);
		});
	},
	buildVariantSelectorMenthol: function(settings){
		this.settings = $.extend(this.settings, settings);
		var productOptions = this.settings['productOptions'];
		if (typeof this.settings == 'object' ){
			if (this.settings['productVariantsSize'] >= 1) {
				var selectId = 'product-select-' + this.settings['productId'];
				var id_product = this.settings['productId'];
				var form_this = $('#pd-'+ id_product +'-template');
				if (this.settings['productDiscr'] > 0) {
					selectId = selectId + '-' + this.settings['productDiscr'];
				}
				new Haravan.OptionSelectors(selectId, {
					product: this.settings['productJson'],
					onVariantSelected: $.proxy(this.buildVariantSelectedEvent, this),
					enableHistoryState: false
				});
				// Auto-select first available variant on page load.
				for (var i=0;i <= this.settings['productVariantsFirst'].length - 1;i++){
					form_this.find('.single-option-selector:eq(' + i + ')').val(this.settings['productVariantsFirst'][i]).trigger('change');
					form_this.find('.swatch:eq(' + i + ') .swatch-element[data-value="' +this.settings['productVariantsFirst'][i]+ '"] label').addClass('sd');
				}
				if (this.settings['productOptionsSize'] > 1) {
					if (this.settings['linkOptionSelectorsEnabled']) {
						Haravan.linkOptionSelectors(this.settings['productJson']);
					}
				}
				form_this.find('.selector-wrapper').find('label').hide();
				form_this.find('.single-option-selector').each(function(index) {
					var spanToInsert = $('<label class="option-selector__label">' + productOptions[index] + ': </label>');
					$(this).before(spanToInsert);
				});
			}
			$('.swatch-element label').click(function(){
				$(this).parents('.swatch-element').siblings().find('label').removeClass('sd');
				$(this).addClass('sd');
				var val = $(this).parents('.swatch-element').attr('data-value');
				var option = $(this).parents('.swatch').data('option');
				$('.single-option-selector[data-option="'+option+'"]').val(val).change();
			})
		}
	},
	buildVariantSelectedEvent: function(variant,parent) {
		var $parent = $('[id="' + parent.domIdPrefix + '"]').parents('.productTemplate'),
				moneyFormat = shop.moneyFormat,
				$skuText = $parent.find('.listInfoDesc ul li.sku span'),
				$priceEl = $parent.find('.pdPriceWrap .price'),
				$compareEl = $parent.find('.pdPriceWrap .comparePrice'),
				$saleEl = $parent.find('.pdPriceWrap .compareSaleOff'),
				$addCartEl = $parent.find('.btn-addCart'),
				$soldOutEl = $parent.find('.btnSoldout'),
				$splitBuyEl = $parent.find('.splitBuyButton');
		if (variant) {
			if(variant.sku !== null){
				$skuText.html(variant.sku);
			}else{
				$skuText.html('Null');
			}
			if(variant.featured_image != null ) {
				var img = Haravan.resizeImage(variant.featured_image.src,'master');
				if(img.indexOf('http') != -1 || img.indexOf('https') != -1){
					img = img.replace(/http:|https:/gi, "");
				}
				$parent.find('.pdImgThumbs .listThumbs .imgThumb a[data-image="'+img+'"] img').trigger('click');
			}
			if(variant.price > 0){
				$priceEl.find('#pdPriceNumber').html(Haravan.formatMoney(variant.price, moneyFormat));
				if(variant.compare_at_price > variant.price){
					var prod_sold = variant.price ;
					var prod_compare = variant.compare_at_price / 100;
					var sale = 100 - (prod_sold / prod_compare) ;
					var sale_persent = Math.round(sale);
					$compareEl.removeClass('hidden').find('#pdComparePriceNumber').html(Haravan.formatMoney(variant.compare_at_price, moneyFormat));
					$saleEl.removeClass('hidden').find('#pdCompareSalePrice').html(Haravan.formatMoney((variant.compare_at_price - variant.price), moneyFormat));
					$saleEl.find('#pdCompareSaleOff').html(sale_persent + '%');
				}else{
					$compareEl.addClass('hidden');
					$saleEl.addClass('hidden');
				}
			}else{
				$priceEl.find('#pdPriceNumber').html('Liên hệ');
				$compareEl.addClass('hidden');
				$saleEl.addClass('hidden');
			}
			if(variant.available){
				$addCartEl.removeClass('hidden');
				$splitBuyEl.removeClass('hidden');
				$soldOutEl.addClass('hidden');
			}else{
				$addCartEl.addClass('hidden');
				$splitBuyEl.addClass('hidden');
				$soldOutEl.removeClass('hidden');
			}
		}else{
			$addCartEl.addClass('hidden');
			$splitBuyEl.addClass('hidden');
			$soldOutEl.removeClass('hidden');
		}
		$(document).trigger('variant.changed', variant);
	},
	buildQuickviewAjaxEvent: function(e){
		e.preventDefault();
		var self = this,
				$target = ($(e.target).hasClass('fa')) ? $(e.target).parent() : $(e.target);
		$.ajax({
			url : '/products/' + $target.data('handle') + '?view=quick-view',
			async: true,
			beforeSend: function() {
				$('.pageLoading').addClass('in');
				$('#modalQuickView').remove();
			},
			success: function(data){
				function loadProduct(){
					$('body').append('<div class="modal fade hidden-xs" id="modalQuickView" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-body"></div></div></div></div>');
					$('#modalQuickView .modal-body').html(data);
					//self.buildFixheightThumbMenthol();
					$(document).on('shown.bs.modal','#modalQuickView', function (event) {
						setTimeout(function(){$(window).trigger('resize');},0)
					});
				};
				$.when(
					loadProduct()
				).then(self.buildVariantSelectorMenthol(window['initializeProduct' + $target.data('id')]));
				$('#modalQuickView').modal('show');
				$('.pageLoading').removeClass('in');
				/*$('#modalQuickView').on('show.bs.modal', function (event) {
					setTimeout(function(){$(window).trigger('resize');},300)
				});*/
			},
			error: function(xhr, text) {
				console.log(xhr.responseText);
			}
		});
	},
	buildQtyChangedEvent: function(e){
		e.preventDefault();
		var $this = $(e.target),
				$parent = $this.parent(),
				$input = $parent.find('#pdQuantity'),
				valIn = parseInt($input.val()),
				typePlus = $this.hasClass('plus');
		if(typePlus){
			$input.val(valIn + 1);
		}else{
			if(valIn > 1){
				$input.val(valIn - 1);
			}
		}
	},
	buildImageChangedEvent: function(e){
		e.preventDefault();
		$('.listThumbs .imgThumb').removeClass('active');
		$(e.target).parents('.imgThumb').addClass('active');
		var src = $(e.target).parents('a').data('image');
		$(e.target).parents('.productTemplate').find('.featureImg img').attr('src',src);
	},
	buildFixheightThumbMenthol: function(){
		var $el = $('.pdImgThumbs');
		if($el.size() > 0 ){
			$el.css('height','auto').removeClass('autoHeight');
			setTimeout(function(){
				var elHeight = $el.height(),
						feaHeight = $('#imgFeatured').height() + 70;
				if(elHeight > feaHeight){
					$el.css('height',$('#imgFeatured').height()).addClass('autoHeight');
				}
			},500)
		}
	},
	buildReplaceImageMenthol: function(time){
		var imgArr = ['_thumb','_compact','_medium','_large'],
				index = 0,
				key = '_icon';
		var timeReplace = setInterval(function(){
			$('.imgLoopItem').each(function(){
				var imgSrc = $(this).attr('src'),
						imgReg = imgSrc.replace(key,imgArr[index]);
				$(this).attr('src',imgReg);
			})
			key = imgArr[index];
			index++;
			if( index >= imgArr.length ){
				$('.imgLoopItem').attr('data-reg',true).css('width','auto');
				clearInterval(timeReplace);
				return;
			}
		},time);
	},
	buildReplaceRegExpImgEvent: function(){
		var $imgEl = $('.imgLoopItem');
		$(window).scroll(function(){
			var sizeReplace = $('.imgLoopItem[data-reg="false"]').length;
			if(sizeReplace == 0){
				$imgEl.css('width','auto');
				return;
			}
			$imgEl.each(function(index, el){
				var src = $(el).attr('src');
				var regExp = src.replace(/icon|thumb|compact|medium|large/gi, "large");
				$(el).attr({'data-reg': true, 'src': regExp});
			});
		})
	},
	buildOwlSliderMenthol: function(el,lg,md,sm,xs,xxs,mar){
		var $el = el;
		if($el.children().size() == 0 ){
			return false;
		}
		if($el.children().size() > 1 ){
			var owl = $el;
			owl.owlCarousel({
				items: lg,
				slideBy: lg,
				loop: false,
				autoplay: false,
				margin: mar,
				responsiveClass: true,
				lazyLoad:true,
				smartSpeed: 500,
				dots: true,
				nav : true,
				navText: ['‹' , '›'],
				responsive: {
					0: {
						items: xxs
					},
					320: {
						items: xs
					},
					480: {
						items: xs
					},
					768: {
						items: sm
					},
					992: {
						items: md
					},
					1200: {
						items: lg
					}
				}
			});
			owl.find('.owl-prev').addClass('disabled')
			owl.on('initialized.owl.carousel changed.owl.carousel refreshed.owl.carousel', function (event) {
				if (!event.namespace) return;
				var carousel = event.relatedTarget,
						element = event.target,
						current = carousel.current();
				$('.owl-next', element).toggleClass('disabled', current === carousel.maximum());
				$('.owl-prev', element).toggleClass('disabled', current === carousel.minimum());
			})
		}else{
			$el.addClass('oneItem cleafix');
			return;
		}
	},
	buildAddCartMenthol: function(id,qty){
		var $this = this;
		qty = parseInt(qty);
		$.ajax({
			type: 'POST',
			url: '/cart/add.js',
			data: 'quantity=' + qty + '&id=' + id,
			dataType: 'json',
			async: false,
			success: function(line_item) {
				swal({
					title: "Hoàn thành!",
					text: "Thêm vào giỏ thành công...",
					icon: "success",
					button: "Đóng",
				});
				$this.buildGetMiniCartMenthol();
			},
			error: function(XMLHttpRequest, textStatus) {
				Haravan.onError(XMLHttpRequest, textStatus);
			}
		});
	},
	buildAddCartEvents: function(){
		var $this = this;
		$(document).on('click','.Addcart', function(e){
			e.preventDefault();
			var id = $(this).attr('data-variantid') || $(this).parents('.productTemplate').find('.select > select').val(),
					qty = $(this).parents('.productTemplate').find('.qty').val() || 1;
			$this.buildAddCartMenthol(id,qty);
		});
		$(document).on('click','#modalQuickView .btn-addCart', function(e){
			e.preventDefault();
			var id = $('#modalQuickView .select > select').val(),
					qty = $('#modalQuickView input.qty').val() || 1;
			$('#modalQuickView').modal('hide');
			$this.buildAddCartMenthol(id,qty);
		});
	},
	buildGetMiniCartMenthol: function(){
		var $miniCart = $('.miniCart');
		var params = {
			type: 'POST',
			url: '/cart?view=mini',
			beforeSend: function() {
				$('.pageLoading').addClass('in');
			},
			success: function(data) {
				$miniCart.html(data);
				var parsed = $.parseHTML(data);
				$('.numberCart').html($(parsed).filter('.wrap__list-cart').val());
				$('#cartPrice').html($(parsed).filter('.wrap__total_money').val());
				$('.pageLoading').removeClass('in');
			}
		};
		jQuery.ajax(params);
	},
	buildRemoveItemMiniCartEvent: function(e){
		e.preventDefault();
		var $this = this;
		var $target = ($(e.target).hasClass('fa')) ? $(e.target).parents('a') : $(e.target);
		var id = $target.attr('data-id');
		$('.itemCart[data-id="'+id+'"]').remove();
		INS.Cart.updateCart(id,0);
	},
	buildMobileEvents: function(){
		$(document).on('click','.btnMBToggleNav, .closeMenuMB, .overlayMenu', function(){
			$('body').toggleClass('openNav');
		});
		$(document).on('click','.navSiteMain ul.nav-navbar li a i', function(e){
			e.preventDefault();
			$(this).parent().toggleClass('open').next().slideToggle();
		});
		$(document).on('click','#sidebarMenu .menuHeading', function(e){
			e.preventDefault();
			$(this).toggleClass('open').next().slideToggle();
		});
	},
	buildScrollEvents: function(){
		$(window).scroll(function(){
			var scrollTop = $(this).scrollTop(),
					elTop = $('.headerTemp').offset().top | 150 ;
			if(scrollTop > elTop){
				$('.backToTop').fadeIn(500);
			}else{
				$('.backToTop').fadeOut(200);
			}
		});
		$('.backToTop').click(function(e){
			e.preventDefault();
			$('body,html').animate({
				scrollTop: 0
			},800)
		})
	},
	buildAjaxCustomerFormEvent: function(e){
		e.preventDefault();
		var $form = $(e.target);
		$.post('/account/contact', {
			form_type:"customer",
			utf8: "✓",
			"contact": {
				"tags":"Khách hàng đăng ký nhận bản tin",
				"first_name":'',
				"last_name":'',
				"email": $form.find('input[name="contact[email]"]').val()
			}
		}, function(r){
			swal({
				title: "Hoàn thành!",
				text: "Đăng ký bản tin thành công...",
				icon: "success",
				button: "Đóng",
			})
			$form.find('input[name="contact[email]"]').val('')
		});
	},
};
INS.Home = {
	init: function(){
		this.buildOwlSliderEvents();
		this.buildCountdownMenthol();
	},
	buildOwlSliderEvents: function(){
		var $this = this;
		var sliderOWl = jQuery('.sliderWrap').owlCarousel({
			items: 1,
			lazyLoad:true,
			loop: false,
			autoplay: true,
			autoplayTimeout: 5000,
			margin: 0,
			responsiveClass: true,
			paginationSpeed : 800,
			smartSpeed: 800,
			nav : true,
			navText: ['‹' , '›'],
			afterAction: function(){

			}
		});
		var $brandSlide = $('.slideBrands');
		$.each($brandSlide, function(i,el){
			INS.Main.buildOwlSliderMenthol($(el),6,5,4,3,3,10);
		});
		var $blogOwl = $('.slideBlogHome');
		INS.Main.buildOwlSliderMenthol($blogOwl,3,3,2,1,1,15);

		var $blogReview = $('.slideRevivews');
		INS.Main.buildOwlSliderMenthol($blogReview,2,2,1,1,1,30);

		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			$(window).trigger('resize');
		})
	},
	buildCountdownMenthol: function(){
		var endDate = $('#timeCountdown').data('time');
		if(endDate == '')
			return false;
		$('#timeCountdown').countdown({
			date: endDate,
			render: function(data) {
				$(this.el).html('<div class="day box-time-date"><span class="time-num time-day">' + this.leadingZeros(data.days, 2) + '</span><span class="text">Ngày</span></div><div class="hour box-time-date"><span class="time-num">' + this.leadingZeros(data.hours, 2) + '</span><span class="text">Giờ</span></div><div class="min box-time-date"><span class="time-num">' + this.leadingZeros(data.min, 2) + '</span><span class="text">Phút<span></div><div class="sec box-time-date"><span class="time-num">' + this.leadingZeros(data.sec, 2) + '</span><span class="text">Giây<span></div>');
			}   
		});
	}
};
INS.Cart = {
	init: function(){
		this.actionCart();
	},
	actionCart: function(){
		$(document).on('keypress change','textarea#CartSpecialInstructions', function(){
			$.ajax({
				type: "POST",
				url: '/cart/update.js',
				data: {"note": $(this).val()},
				dataType: 'json',
				success: function() {} 
			});
		})
		$(document).on('change','.ajaxcart__qty-num',function(){
			var $this = $(this);
			var qty = $this.val();
			var id = $this.data('id');
			if( qty == 0){
				$this.val(1);
			}
			INS.Cart.updateCart(id,qty);
		});
	},
	updateCart: function (id,qty){
		var params = {
			type: 'POST',
			url: '/cart/change.js',
			data: 'quantity='+ qty +'&id=' + id,
			dataType: 'json',
			success: function(cart) {
				INS.Cart.updateMoney(id);
				INS.Main.buildGetMiniCartMenthol();
				$('.numberCart').html(cart.item_count);
				if(cart.item_count == 0 && shop.template == 'cart' )
					window.location.reload();
			}
		};
		jQuery.ajax(params);
	},
	updateMoney: function(id){
		$.ajax({
			url : "/cart?view=mini",
			success: function(data){
				var parsed = $.parseHTML(data);
				$('.cartCount').attr('data-price', $(parsed).filter('.moneyNotF').val());
				$('.ajaxcart .list_button_cart p span.money').html($(parsed).filter('.wrap__total_money').val()); 
				$('.list_product_cart[data-id="'+id+'"] .cpro_item_inner .money_line span.money').html($(parsed).filter('.line_money_temp[data-id="'+id+'"]').val()); 
			}
		})
	}
};
INS.Product = {
	init: function(){
		this.buildProductMenthol();
		INS.Main.buildVariantSelectorMenthol(shop.productSetting);
	},
	buildProductMenthol: function(){
		var $pdRelatedOwl = $('.contentRelatedPd');
		INS.Main.buildOwlSliderMenthol($pdRelatedOwl,5,5,3,2,1,10);
		$("a.pdFancybox").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600, 
			'speedOut'		:	200
		});
		if($('.shortDesc .desc').html().trim() == '' ){
			$('.shortDesc').hide();
		}
		if($('.pdTopIndex.random').size() > 0 ){
			$('#starNumber').html(Math.floor((Math.random() * 100) + 1));
		}
		$(document).on('click', '.openAds, .colseAds', function(){
			$('.itemAdsPd').toggleClass('open');
		})
		setTimeout(function(){
			$('.itemAdsPd').addClass('open');
		},3000)
	}
};
INS.Collection = {
	init: function(){
		this.toggleFilter();
		this.ajaxClickInputFilter();
		this.toggleNavMobile();
		this.onChangedViewProduct();
		this.buildCollectionSortBy();
	},
	toggleFilter: function(){
		$(document).on('click', '.toggleFilter a, .closeFilter', function(){
			$('.headFilter').slideToggle();
		})
		$(document).on('click', '.moduleGroup .title', function(){
			$(this).toggleClass('open').parent().next().slideToggle();
			$(this).parents('.moduleGroup').siblings().find('.title').removeClass('open');
			$(this).parents('.moduleGroup').siblings().find('.moduleContent').slideUp();
		})
	},
	ajaxClickInputFilter: function(){
		var $this = this;
		$(document).on('click','.checkBoxList li input',function(){
			jQuery(this).parent().toggleClass('active');
			var _url = $this.ajaxGetFilterQuery() + '&view=filter&page=1';
			$this.ajaxRenderHTML(_url);
		})
		$(document).on('click','.content_sortPagiBar.pagiFilter li a', function(e){
			e.preventDefault();
			$this.ajaxRenderHTML($(this).attr('href'))
		});
	},
	ajaxGetFilterQuery: function(){
		var _query = '', _price = '', _vendor = '', _color = '', _size = '', _id = '';
		_id = $('#coll-handle').val();
		var _str = '/search?q=filter=';
		_query = "("+_id+")";

		jQuery('.filterPrice .checkBoxList li.active').each(function(){
			_price = _price + jQuery(this).find('input').data('price') + '||';
		})
		_price=_price.substring(0,_price.length -2);
		if(_price != ""){
			_price='('+_price+')';
			_query+='&&'+_price;
		}

		jQuery('.filterBrand .checkBoxList li.active').each(function(){
			_vendor = _vendor + jQuery(this).find('input').data('vendor') + '||';
		})
		_vendor=_vendor.substring(0,_vendor.length -2);
		if(_vendor != ""){
			_vendor='('+_vendor+')';
			_query+='&&'+_vendor;
		}

		jQuery('.filterColor .checkBoxList li.active').each(function(){
			_color = _color + jQuery(this).find('input').data('color') + '||';
		})
		_color=_color.substring(0,_color.length -2);
		if(_color != ""){
			_color='('+_color+')';
			_query+='&&'+_color;
		}

		jQuery('.filterTag .checkBoxList li.active').each(function(){
			_size = _size + jQuery(this).find('input').data('size') + '||';
		})
		_size=_size.substring(0,_size.length -2);
		if(_size != ""){
			_size='('+_size+')';
			_query+='&&'+_size;
		}
		_str += encodeURIComponent(_query);
		return _str;
	},
	ajaxRenderHTML: function(str){
		jQuery.ajax({
			url : str,
			async: true,
			success: function(data){
				jQuery("#pd_collection").html(data);
				var parsed = $.parseHTML(data);
				$('.page_head span.countPd').html('(' + $(parsed).filter('#totalPdFilter').val() + ' sản phẩm)');
				if(sessionStorage.page_view == 'view_grid' ){
					$('.filter').removeClass('view_list').addClass('view_grid');
				}else{
					$('.filter').removeClass('view_grid').addClass('view_list');
				}
				INS.actionResize.init();
				INS.Main.buildReplaceImageMenthol(0);
			}
		});
	},
	toggleNavMobile: function(){
		$(document).on('click','#childNavCatelog .menu-item.head a', function(){
			$(this).parents('#childNavCatelog').fadeOut(500);
		});
		$(document).on('click', '.fil_mobile a, .overlay_chir.filter', function(){
			$('body').toggleClass('open_drawer_filter');
		});
	},
	onChangedViewProduct: function(){
		$(document).on('click','.display-product-option li', function(){
			if($(this).hasClass('selected'))
				return;
			$('#pd_collection').hide();
			$('.display-product-option li').removeClass('selected');
			$(this).addClass('selected');
			sessionStorage.page_view = $(this).data('view');
			if(sessionStorage.page_view.indexOf('view_grid') != -1 ){
				$('.filter').removeClass('view_list').addClass('view_grid');
			}else{
				$('.filter').removeClass('view_grid').addClass('view_list');
			}
			setTimeout(function(){
				$('#pd_collection').fadeIn(300);
				$(window).trigger('resize');
			},500)
		})
		$(document).ready(function(){
			$('.display-product-option li').removeClass('selected');
			if(sessionStorage.page_view == 'undefined' || sessionStorage.page_view == null){
				sessionStorage.page_view = 'view_grid';
			}
			if(sessionStorage.page_view == 'view_grid' ){
				$('.filter').removeClass('view_list').addClass('view_grid');
				$('.display-product-option li.view-as-grid').addClass('selected');
			}else{
				$('.filter').removeClass('view_grid').addClass('view_list');
				$('.display-product-option li.view-as-list').addClass('selected');
			}
		})
	},
	buildCollectionSortBy: function(){
		Haravan.queryParams = {};
		if (location.search.length) {
			for (var aKeyValue, i = 0, aCouples = location.search.substr(1).split('&'); i < aCouples.length; i++) {
				aKeyValue = aCouples[i].split('=');
				if (aKeyValue.length > 1) {
					Haravan.queryParams[decodeURIComponent(aKeyValue[0])] = decodeURIComponent(aKeyValue[1]);
				}
			}
		}
		var collFilters = jQuery('.coll-filter');
		collFilters.change(function() {
			var newTags = [];
			var newURL = '',
					handle = $('#coll-handle').data('handle');
			delete Haravan.queryParams.page;
			collFilters.each(function() { 
				if (jQuery(this).val()) {
					newTags.push(jQuery(this).val());
				}
			});
			if(handle != '' && handle != null){
				newURL = '/collections/' + handle;
				if (newTags.length) {
					newURL += '/' + newTags.join('+');
				}
				var search = jQuery.param(Haravan.queryParams);
				if (search.length) {
					newURL += '?' + search;
				}
				location.href = newURL;    
			}else{
				if (newTags.length) {
					Haravan.queryParams.constraint = newTags.join('+');        
				}
				else {
					delete Haravan.queryParams.constraint;
				}
				location.search = jQuery.param(Haravan.queryParams);
			}

		});
		jQuery('.sort-by')
		.val($('#coll-handle').data('sort'))
		.bind('change', function() {
			Haravan.queryParams.sort_by = jQuery(this).val();
			location.search = jQuery.param(Haravan.queryParams);
		});
	}
};
/* js for resize */
INS.actionResize = {
	init: function(){
		this.buildFixheightItemMenthol();
		INS.Main.buildFixheightThumbMenthol();
	},
	buildFixheightItemMenthol: function(){
		$('.elementFixHeight').css('height','auto');
		setTimeout(function(){
			$('.elementFixHeight').each(function(i,el){
				var elWidth = $(el).width();
				$(el).height(elWidth);
			})
		},250)
	}
};
INS.loadPage = {
	init : function(){
		this.pageLoad();
		this.buildMenuResize();
	},
	pageLoad: function(){
		$('#insLoadpage').delay(500).fadeOut(500);
	},
	buildMenuResize: function(){
		if($(window).width() < 992)
			$('#headerNav ul li ul li a i.fa-angle-right').removeClass('fa-angle-right').addClass('fa-angle-down');
		else
			$('#headerNav ul li ul li a i.fa-angle-down').removeClass('fa-angle-down').addClass('fa-angle-right');
	}
};