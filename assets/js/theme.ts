// Loaded
console.log("--- Site Loaded ---");
import Swiper, { Pagination, Navigation, Autoplay } from "swiper";
import "swiper/css";
let ajaxUrl = "/wp-admin/admin-ajax.php";
// let ajaxUrl = "https://everywhere.pl/www/bh/wp-admin/admin-ajax.php";

// Rendered
// document.addEventListener("click", (ev) => {
// 	let target = ev.target as HTMLElement;

// 	if (
// 		!target.classList.contains("bapf_hascolarr") ||
// 		target.classList.contains("bapf_button") ||
// 		!target.getAttribute("data-name") ||
// 		!target.classList.contains("bapf_ccolaps")
// 	)
// 		console.log("TARGET");
// 	console.log(target);
// 	deselectFilters();
// });
window.addEventListener("DOMContentLoaded", () => {
	console.log("--- Site Rendered ---");
	handleAddToCart();
	handleQuantityInputs();
	cartStatusUpd();
	cartCount();
	wishCount();
	handleMobileNav();
	fv_fields();
	handleCouponTimer();
	deselectFilters();
	changeFilters();
	hadleOtherAddr();
	setInterval(handleCouponTimer, 60 * 1000);
	fvNameAction();

	if (window.innerWidth > 1200) {
		let searchBtnTest = document.querySelector(
			"[data-make_search]"
		) as HTMLAnchorElement;
		let searchers = document.querySelectorAll(".dgwt-wcas-search-input");
		Array.from(searchers).forEach((el) => {
			el.addEventListener("focusout", (ev) => {
				searchBtnTest.click();
			});
		});
	}

	// Main Slider
	const hero = new Swiper(".hero", {
		modules: [Pagination, Navigation, Autoplay],
		direction: "horizontal",
		autoplay: {
			delay: 4000,
		},
		pagination: {
			el: ".hero__pagination",
			clickable: true,
			renderBullet: function (index, className) {
				if (index.toString().length < 2)
					return '<span class="' + className + '">0' + (index + 1) + "</span>";
				return '<span class="' + className + '">' + (index + 1) + "</span>";
			},
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
	});
	// Detect product carousels and make them Swiper
	const buildCarousels = (el) => {
		let carouselId = el.dataset.slider;
		let container = ".product-carousel-" + carouselId;
		let paginationContainer = ".carousel-pagination-" + carouselId;
		const carousel = new Swiper(container, {
			modules: [Pagination, Navigation, Autoplay],
			direction: "horizontal",
			slidesPerView: 1,
			slidesPerGroup: 1,
			loop: true,
			spaceBetween: 30,
			autoplay: {
				delay: 5000,
			},
			hashNavigation: {
				watchState: true,
			},
			pagination: {
				el: paginationContainer,
				clickable: true,
				renderBullet: function (index, className) {
					return (
						'<button class="transition-all hover:cursor-pointer ' +
						className +
						'"></button>'
					);
				},
			},
			breakpoints: {
				400: {
					slidesPerView: 2,
					slidesPerGroup: 2,
				},
				640: {
					slidesPerView: 2,
					slidesPerGroup: 2,
				},
				991: {
					slidesPerView: 3,
					slidesPerGroup: 3,
				},
				1240: {
					slidesPerView: 4,
					slidesPerGroup: 4,
				},
				1440: {
					slidesPerView: 5,
					slidesPerGroup: 5,
				},
				1760: {
					slidesPerView: 6,
					slidesPerGroup: 6,
				},
			},
		});
	};
	let carousels = document.querySelectorAll(".product-carousel");
	carousels.forEach((carousel) => buildCarousels(carousel));

	let tooltipsParents = document.querySelectorAll(".has-tooltip");
	for (let tooltipParent of tooltipsParents) {
		let tooltipTrigger = tooltipParent.querySelector("[data-tooltip_trigger]");
		let tooltip = tooltipParent.querySelector("[data-tooltip]");

		tooltipTrigger.addEventListener("mouseover", () => {
			tooltip.classList.add("flex");
			tooltip.classList.remove("hidden");
		});
		tooltipTrigger.addEventListener("mouseout", () => {
			tooltip.classList.remove("flex");
			tooltip.classList.add("hidden");
		});
	}

	let searchBtn = document.querySelectorAll("[data-make_search]");
	searchBtn.forEach((el) => {
		el.addEventListener("click", (ev) => {
			ev.preventDefault();
			let target = ev.currentTarget as HTMLAnchorElement;
			let searchBar = target.parentNode.querySelector("[data-searchform]");
			searchBar.classList.toggle("hidden");
			if (!searchBar.classList.contains("hidden")) {
				target.classList.add("active");
				(
					target.parentNode.querySelector(
						".dgwt-wcas-search-input"
					) as HTMLInputElement
				).focus();
			} else target.classList.remove("active");
		});
	});

	let goToPaymet = document.querySelector("[data-go_to_payment]");
	let placeOrder = document.querySelector("[data-place_order]");
	let customerInfo = document.querySelector("[data-customer_info]");
	let paymentShipping = document.querySelector("[data-payment_shipping]");
	let submitOrder = document.querySelector("[data-place_order]");
	let addrTitle = document.querySelector("[data_title_addr]");
	let payTitle = document.querySelector("[data_title_pay]");
	let deliveryAddr = document.querySelector("[data-delivery_addr]");
	let backToAddr = document.querySelector("[data-back_to_cust]");
	let paymentImgsCount = {
		count: 0,
		imgSrc: "https://boardhouse.pl/wp-content/themes/bh-prod-1/assets/img/",

		// imgSrc:
		// "https://everywhere.pl/www/bh/wp-content/themes/boardhouse-theme/assets/img/",
		imgs: ["przelew.svg", "pobranie.svg", "Przelewy24_logo.svg"],
	};

	if (goToPaymet) {
		goToPaymet.addEventListener("click", (e) => {
			e.preventDefault();
			updateCheckoutProps();
			if (validateCustomer()) {
				window.scrollTo(0, 0);
				customerInfo.classList.add("hidden");
				goToPaymet.classList.add("hidden");
				addrTitle.classList.add("hidden");
				paymentShipping.classList.remove("hidden");
				placeOrder.classList.remove("hidden");
				payTitle.classList.remove("hidden");
				deliveryAddr.classList.remove("hidden");
				renderCheckoutItems();
			}
		});

		backToAddr.addEventListener("click", (e) => {
			e.preventDefault();
			window.scrollTo(0, 0);
			customerInfo.classList.remove("hidden");
			goToPaymet.classList.remove("hidden");
			addrTitle.classList.remove("hidden");
			paymentShipping.classList.add("hidden");
			placeOrder.classList.add("hidden");
			payTitle.classList.add("hidden");
			deliveryAddr.classList.add("hidden");
		});

		submitOrder.addEventListener("click", (e) => {
			e.preventDefault();
			document.getElementById("place_order").click();
		});

		let checkout = {
			name: null,
			lastName: null,
			tel: null,
			email: null,
			street: null,
			city: null,
			code: null,
			country: "Poland",
			privacy_policy: null,
		};

		let paymentDefaultDiv = document.querySelector(".shipping-boxes.payment")
			.children[0] as HTMLLabelElement;
		let shippingDefaultDiv = document.querySelector(".shipping-boxes.shipping")
			.children[0] as HTMLLabelElement;
		let paymentTemplate = paymentDefaultDiv.cloneNode(true) as HTMLLabelElement;
		let shippingTemplate = shippingDefaultDiv.cloneNode(
			true
		) as HTMLLabelElement;
		let boxesOverlay = document.querySelectorAll("[data-boxes_overlau]");

		document.addEventListener("update_checkout", () => {
			boxesOverlay.forEach((overlay) => {
				overlayToggleHidden(overlay);
			});
		});

		document.addEventListener("updated_checkout", () => {
			updateCheckoutProps();
			renderCheckoutItems();
			checkShippingMethod();
			paymentImgsCount.count = 0;
			boxesOverlay.forEach((overlay) => {
				overlayToggleHidden(overlay);
			});
		});
		document.addEventListener("payment_method_selected", () => {
			renderCheckoutItems();
			paymentImgsCount.count = 0;
		});

		function overlayToggleHidden(overlay) {
			overlay.classList.toggle("hidden");
		}

		function checkShippingMethod() {
			let paczkomat = document.querySelector(
				"#shipping_method_0_flexible_shipping_single5"
			) as HTMLInputElement;
			if (!paczkomat) return;

			if (paczkomat.checked) {
				document.querySelector(".inPost-wrapper").classList.remove("hidden");
				return;
			}
			document.querySelector(".inPost-wrapper").classList.add("hidden");
		}

		function updateCheckoutProps() {
			checkout.name = (
				document.getElementById("billing_first_name") as HTMLInputElement
			).value;
			checkout.lastName = (
				document.getElementById("billing_last_name") as HTMLInputElement
			).value;
			checkout.tel = (
				document.getElementById("billing_phone") as HTMLInputElement
			).value;
			checkout.email = (
				document.getElementById("billing_email") as HTMLInputElement
			).value;
			checkout.street = (
				document.getElementById("billing_address_1") as HTMLInputElement
			).value;
			checkout.city = (
				document.getElementById("billing_city") as HTMLInputElement
			).value;
			checkout.code = (
				document.getElementById("billing_postcode") as HTMLInputElement
			).value;
			checkout.privacy_policy = document.getElementById(
				"privacy_policy"
			) as HTMLInputElement;
			let name = deliveryAddr.querySelector("[data-name]");
			let street = deliveryAddr.querySelector("[data-street]");
			let addr = deliveryAddr.querySelector("[data-addr]");
			let country = deliveryAddr.querySelector("[data-country]");
			let tel = deliveryAddr.querySelector("[data-tel]");
			let email = deliveryAddr.querySelector("[data-email]");

			name.innerHTML = checkout.name + " " + checkout.lastName;
			street.innerHTML = checkout.street;
			addr.innerHTML = checkout.code + " " + checkout.city;
			country.innerHTML = checkout.country;
			tel.innerHTML = checkout.tel;
			email.innerHTML = checkout.email;

			console.log("--- Props Updated ---");
			console.log(checkout);
			paymentImgsCount.count = 0;
		}

		function renderCheckoutItems() {
			let shippingRadios = document.getElementsByName("shipping_method[0]");
			let paymentRadios = document.getElementsByName("payment_method");
			shippingDefaultDiv.classList.add("hidden");
			paymentDefaultDiv.classList.add("hidden");
			renderLabels(
				shippingRadios,
				".shipping-boxes.shipping",
				shippingTemplate
			);
			renderLabels(paymentRadios, ".shipping-boxes.payment", paymentTemplate);
		}

		function renderLabels(
			radios: any,
			wrapperClassList: string,
			labelTemplate: HTMLLabelElement
		) {
			let wrapper = document.querySelector(wrapperClassList);
			wrapper.innerHTML = "";
			radios.forEach((radio: HTMLInputElement) => {
				let template = labelTemplate.cloneNode(true) as HTMLLabelElement;
				let rFor = radio.id;
				let rLable = radio.parentNode.children[1].innerHTML;
				let rImg = (radio.parentNode.children[2] as HTMLElement).dataset
					.shipping_img;
				if (wrapperClassList === ".shipping-boxes.payment") {
					let someNumber = paymentImgsCount.count;
					rImg =
						paymentImgsCount.imgSrc +
						paymentImgsCount.imgs[paymentImgsCount.count];
					paymentImgsCount.count++;
					console.log(paymentImgsCount.count + " -- COUNT");
				}
				if (radio.checked) template.classList.add("active");
				template.setAttribute("for", rFor);
				template.querySelector("[data-box_text]").innerHTML = rLable;
				template.querySelector("[data-box_img]").setAttribute("src", rImg);
				wrapper.appendChild(template);
			});
		}

		function validateCustomer() {
			if (!checkout.name) {
				alert("Nie podałeś(-aś) imienia");
				return false;
			}
			if (!checkout.lastName) {
				alert("Nie podałeś(-aś) nazwiska");
				return false;
			}
			if (!checkout.tel) {
				alert("Nie podałeś(-aś) numeru telefonu");
				return false;
			}
			if (!checkout.email) {
				alert("Nie podałeś(-aś) adresu email");
				return false;
			}
			if (!checkout.street) {
				alert("Nie podałeś(-aś) ulicę");
				return false;
			}
			if (!checkout.city) {
				alert("Nie podałeś(-aś) miasta");
				return false;
			}
			if (!checkout.code) {
				alert("Nie podałeś(-aś) kodu pocztowego");
				return false;
			}
			if (!checkout.privacy_policy.checked) {
				alert(
					"By złożyć zamówienie musisz zaakceptować Politykę Prywatności i Regulamin"
				);
				return false;
			}
			return true;
		}
	}

	document.addEventListener("updated_wc_div", () => {
		cartStatusUpd();
		handleQuantityInputs();
	});

	document.addEventListener("updated_wc_div", () => {
		window.location.reload();
	});

	document.addEventListener("removed_from_cart", () => {
		cartCount();
	});

	document.addEventListener("added_to_cart", () => {
		cartCount();
	});

	document.addEventListener("scroll", () => {
		let stickyHeader = document.querySelector("[data-sticky_header]");
		if (window.scrollY > 300)
			stickyHeader.classList.remove("-translate-y-full");
		else stickyHeader.classList.add("-translate-y-full");
	});
});

function hadleOtherAddr() {
	let addrGroups = document.querySelectorAll("[data-other-address]");
	let addrTrigger = document.querySelector(
		"#ship-to-different-address-checkbox"
	);
	console.log("chuj");
	if (!addrGroups || !addrTrigger) return;

	addrTrigger.addEventListener("input", (ev) => {
		let target = ev.currentTarget as HTMLInputElement;
		if (target.checked) {
			Array.from(addrGroups).forEach((el) => {
				el.classList.remove("hidden");
			});
		} else {
			Array.from(addrGroups).forEach((el) => {
				el.classList.add("hidden");
			});
		}
	});
}

function deselectFilters() {
	let activeFilers = document.querySelectorAll(".bapf_ccolaps");
	console.log(activeFilers);
	if (!activeFilers) return;
	Array.from(activeFilers).forEach((el) => {
		console.log(el);
		(el.querySelector(".bapf_hascolarr") as HTMLElement).click();
	});
}

function changeFilters() {
	let selects = document.querySelectorAll(".bapf_hascolarr");
	if (!selects) return;

	Array.from(selects).forEach((el) => {
		el.addEventListener("click", (ev) => {
			if (
				!(
					(ev.currentTarget as HTMLElement).parentNode.parentNode as HTMLElement
				).classList.contains("bapf_ccolaps")
			)
				deselectFilters();
		});
	});
}

function ajaxRemoveFromCartEvts() {
	let productRemove = document.querySelectorAll('[aria-label="Usuń element"]');
	console.log(productRemove);
	Array.from(productRemove).forEach((el) => {
		el.addEventListener("click", (ev) => {
			ev.preventDefault();
			let target = ev.currentTarget as HTMLAnchorElement;
			let product_id = target.getAttribute("data-product_id");
			let parent = target.parentNode.parentNode.parentNode;
			console.log(product_id);
			ajaxRemoveFromCart(product_id, parent);
		});
	});
}

function ajaxRemoveFromCart(product_id, row) {
	let data = new FormData();
	data.append("action", "cart_remove");
	data.append("product_id", product_id);
	row.style.opacity = "0.3";
	fetch(ajaxUrl, {
		method: "POST",
		body: data,
		credentials: "same-origin",
	})
		.then((response) => response.json())
		.then((json) => {
			console.log(json);
			if (json == "Remove success") {
				row.innerHTML = "Usunięto produkt";
				row.style.opacity = "1";
				cartCount();
				cartStatusUpd();
			}
		});
}

function cartStatusUpd() {
	let statusWrapper = document.querySelector("[data_cart-status]");
	if (!statusWrapper) return null;

	let statusBar = statusWrapper.querySelector(
		"[data-status_bar]"
	) as HTMLElement;
	let statusSvg = statusWrapper.querySelector("[data-cart_status_svg]");
	let statusText = statusWrapper.querySelector("[data-status_bar_text]");

	statusSvg.classList.add("shakey");
	statusWrapper.classList.add("opacity-50");
	const data = new FormData();
	data.append("action", "fetch_status");
	fetch(ajaxUrl, {
		method: "POST",
		body: data,
		credentials: "same-origin",
	})
		.then((response) => response.json())
		.then((json) => {
			handleStatus(json);
			statusWrapper.classList.remove("opacity-50");
			statusSvg.classList.remove("shakey");
		});

	function handleStatus(status) {
		if (status.remains == 0) {
			statusText.textContent = "Obowiązuje Cię darmowa wysyłka";
			statusBar.classList.remove("bg-orange");
			statusBar.classList.add("bg-green");
		} else {
			statusBar.classList.add("bg-orange");
			statusBar.classList.remove("bg-green");
			statusText.textContent =
				"Do darmowej dostawy brakuje " + status.remains + " zł";
		}
		statusBar.style.width = status.percent + "%";
	}
}

function handleQuantityInputs() {
	let quantityWrappers = document.querySelectorAll(".product .quantity");
	if (!quantityWrappers) return;
	if (quantityWrappers.length > 0) {
		for (let quantityWrapper of quantityWrappers) {
			let quantityInput = quantityWrapper.getElementsByTagName("input")[0];
			let quantityUp = quantityWrapper.querySelector("[data-up]");
			let quantityDown = quantityWrapper.querySelector("[data-down]");

			if (quantityUp)
				quantityUp.addEventListener("click", (e) => {
					e.preventDefault();
					let currentValue = parseInt(quantityInput.value);
					currentValue++;
					quantityInput.value = currentValue.toString();
					let updBtn = document.getElementsByName("update_cart")[0];
					if (updBtn) updBtn.removeAttribute("disabled");
				});

			if (quantityDown)
				quantityDown.addEventListener("click", (e) => {
					e.preventDefault();
					let currentValue = parseInt(quantityInput.value);
					if (currentValue > 1) currentValue--;
					quantityInput.value = currentValue.toString();
					let updBtn = document.getElementsByName("update_cart")[0];
					if (updBtn) updBtn.removeAttribute("disabled");
				});
		}
	}
}
function handleAddToCart() {
	let btn = document.querySelector(".single_add_to_cart_button");
	if (!btn) return;

	btn.addEventListener("click", (e) => {
		e.preventDefault();
		let target = e.currentTarget as HTMLButtonElement;
		let targetParent = target.parentNode;
		let isVariable = target.value ? false : true;
		let quantity = targetParent.querySelector('[name="quantity"]');
		if (isVariable) {
			let productId = targetParent.querySelector('[name="product_id"]');
			let variationId = targetParent.querySelector('[name="variation_id"]');
			if (!productId && !variationId) return;
			addVariableProduct(
				(productId as HTMLInputElement).value,
				(variationId as HTMLInputElement).value,
				(quantity as HTMLInputElement).value,
				btn
			);
		} else {
			addProduct(
				(btn as HTMLButtonElement).value,
				(quantity as HTMLInputElement).value,
				btn
			);
		}
	});

	let closeBtn = document.querySelector("[data-close_cart_popup]");
	closeBtn.addEventListener("click", (e) => {
		e.preventDefault();
		document.querySelector("[data-cart_popup]").classList.add("hidden");
	});
}
function addVariableProduct(product_id, variation_id, quantity, btn) {
	btn.textContent = "Dodaję produkt...";
	console.log("--- Add Variable Product to Cart ---");
	const data = new FormData();
	data.append("action", "add_variable");
	data.append("product_id", product_id);
	data.append("variation_id", variation_id);
	data.append("quantity", quantity);
	fetch(ajaxUrl, {
		method: "POST",
		body: data,
		credentials: "same-origin",
	})
		.then((response) => {
			return response.json();
		})
		.then((json) => {
			handleCartPopup(json, quantity, btn);
			cartCount();
		});
}
function addProduct(add_to_cart, quantity, btn) {
	console.log("--- Add Simple Product to Cart ---");
	btn.textContent = "Dodaję produkt...";
	const data = new FormData();
	data.append("action", "add_variable");
	data.append("product_id", add_to_cart);
	data.append("quantity", quantity);
	fetch(ajaxUrl, {
		method: "POST",
		body: data,
		credentials: "same-origin",
	})
		.then((response) => {
			return response.json();
		})
		.then((json) => {
			handleCartPopup(json, quantity, btn);
			cartCount();
		})
		.catch((err) => {
			console.log(err);
		});
}
function showCartMessage(msg) {
	alert(msg);
}
function handleCartPopup(add_response, quantity, btn) {
	let addToCartPopup = document.querySelector("[data-cart_popup]");
	let popupCart = addToCartPopup.querySelector("[data-cp_cart]");

	let cpIcon = addToCartPopup.querySelector("[data-cp_icon]");
	let cpSuccess = addToCartPopup.querySelector("[data-cp_success]");
	let cpFail = addToCartPopup.querySelector("[data-cp_fail]");

	cpFail.classList.add("hidden");

	if (add_response.err) {
		btn.textContent = "Dodaj do koszyka";
		btn.blur();
		// showCartMessage(add_response.msg);
		addToCartPopup.classList.remove("hidden");
		cpFail.classList.remove("hidden");
		cpIcon.classList.add("hidden");
		cpSuccess.classList.add("hidden");
		popupCart.innerHTML =
			"<div class='text-center py-10 px-10'>" + add_response.msg + "</div>";

		return;
	}
	if (!add_response[0]) {
		btn.textContent = "Dodaj do koszyka";
		btn.blur();
		addToCartPopup.classList.remove("hidden");
		popupCart.innerHTML =
			"<div class='text-center py-10 px-10'>" +
			"Prawdopodobnie już posiadasz maksymalną ilość tego produktu w swoim koszyku. Sprawdź i spróbuj jeszcze raz." +
			"</div>";
		cpFail.classList.remove("hidden");
		cpIcon.classList.add("hidden");
		cpSuccess.classList.add("hidden");
		return;
	}
	cpFail.classList.add("hidden");
	cpIcon.classList.remove("hidden");
	cpSuccess.classList.remove("hidden");
	console.log("--- Product Added To Cart ---");
	btn.textContent = "Dodano produkt";
	btn.blur();
	console.log("--- Handle Cart PopUp ---");
	addToCartPopup.classList.remove("hidden");
	popupCart.classList.add("loading");
	document.querySelector("[data-cp_amount]").textContent = quantity;
	const data = new FormData();
	data.append("action", "html_cart");
	fetch(ajaxUrl, {
		method: "POST",
		body: data,
		credentials: "same-origin",
	})
		.then((response) => response.text())
		.then((text) => {
			popupCart.innerHTML = text;
			ajaxRemoveFromCartEvts();
			let popupProceed = popupCart.querySelector("[data-close-pop-up-proceed]");
			popupProceed.addEventListener("click", (ev) => {
				ev.preventDefault();
				document.querySelector("[data-cart_popup]").classList.add("hidden");
			});
			popupCart.classList.remove("loading");
			cartStatusUpd();
		});
}
function getUserCartItems() {
	console.log("--- Get User Cart Items ---");
}

function wishCount() {
	console.log("--- Update Wish Count ---");
	let cartCounter = document.querySelectorAll("[data-wish_counter]");
	if (!cartCounter) return;

	const data = new FormData();
	data.append("action", "wishlist_load_count");
	fetch(ajaxUrl, {
		method: "POST",
		body: data,
		credentials: "same-origin",
	})
		.then((response) => {
			console.log(JSON);
			return response.json();
		})
		.then((json) => {
			console.log(json);
			renderWishCount(json);
		});

	function renderWishCount(count) {
		if (parseInt(count.count) > 0) {
			cartCounter.forEach((counter) => {
				console.log(counter);
				counter.classList.remove("opacity-0");
				counter.innerHTML = count.count;
			});
		}
	}
}

function cartCount() {
	let cartCounter = document.querySelectorAll("[data-cart_counter]");
	if (!cartCounter) return;

	const data = new FormData();
	data.append("action", "cart_count");
	fetch(ajaxUrl, {
		method: "POST",
		body: data,
		credentials: "same-origin",
	})
		.then((response) => response.text())
		.then((text) => {
			renderCount(text);
		});

	function renderCount(count) {
		if (parseInt(count) > 0) {
			cartCounter.forEach((counter) => {
				counter.classList.remove("opacity-0");
				counter.innerHTML = count;
			});
		}
	}
}

function handleMobileNav() {
	const mobileNav = {
		wrapper: document.querySelector("[data-mobile_nav]"),
		btnOpen: document.querySelectorAll("[data-open_mobile_nav]"),
		btnClose: document.querySelector("[data-close_mobile_nav]"),
		items: document.querySelectorAll("[data-mobile_tab_for]"),
	};
	mobileNav.btnClose.addEventListener("click", (e) => {
		e.preventDefault();
		mobileNav.wrapper.classList.toggle("-translate-x-full");
	});
	mobileNav.btnOpen.forEach((btn) => {
		btn.addEventListener("click", (e) => {
			e.preventDefault();
			mobileNav.wrapper.classList.toggle("-translate-x-full");
		});
	});
	mobileNav.items.forEach((el) => {
		let tabFor = el.getAttribute("data-mobile_tab_for");
		let isParent = el.getAttribute("data-parent");
		if (isParent !== "0") {
			el.addEventListener("click", (e) => {
				e.preventDefault();
				let target = e.currentTarget as HTMLAnchorElement;
				target.classList.toggle("active");
				let caret = target.querySelector("[data-caret]") as HTMLElement;
				caret.classList.toggle("-rotate-90");
				let isActive = target.classList.contains("active");
				let child = document.querySelector(
					'[data-mobile_tab="' + tabFor + '"]'
				) as HTMLElement;
				let childHeight = child.scrollHeight;
				if (isActive) child.style.height = childHeight + "px";
				else child.style.height = "0px";
			});
		}
	});
}

function fv_fields() {
	let fvInput = document.querySelector("#wantFV") as HTMLInputElement;
	if (!fvInput) return;
	fvInput.addEventListener("change", () => {
		let fvFields = document.querySelector("[data-fv_fields]");
		if (fvInput.checked) fvFields.classList.remove("hidden");
		else fvFields.classList.add("hidden");
	});
}

function handleCouponTimer() {
	let timer = document.querySelector("[data-coupon_expires]") as HTMLElement;
	if (!timer) return;
	let expires = new Date(timer.dataset.coupon_expires);
	let today = new Date();
	// Return if Expired
	if (expires.getTime() - today.getTime() < 0) {
		timer.innerHTML = "WYGASŁ";
		return;
	}
	// Continue
	let delta = Math.abs(expires.getTime() - today.getTime()) / 1000;
	let days = Math.floor(delta / 86400);
	delta -= days * 86400;
	let hours = Math.floor(delta / 3600) % 24;
	delta -= hours * 3600;
	let minutes = Math.floor(delta / 60) % 60;

	//Show Time
	timer.querySelector("[data-coupon_days]").innerHTML = days + " dni";
	timer.querySelector("[data-coupon_hours]").innerHTML = hours + " godzin";
	timer.querySelector("[data-coupon_minutes]").innerHTML = minutes + " minut";
}

function fvNameAction() {
	let fvName = document.querySelectorAll("input[name='fv_name']");
	if (!fvName) return;

	let nipField = document.querySelector(".nip-wrapper");
	console.log(fvName);
	Array.from(fvName).forEach((el) => {
		el.addEventListener("change", (ev) => {
			let target = ev.currentTarget as HTMLInputElement;
			if (target.checked && target.id == "fvPrivate") {
				nipField.classList.add("hidden");
				return;
			}
			nipField.classList.remove("hidden");
		});
	});
}
