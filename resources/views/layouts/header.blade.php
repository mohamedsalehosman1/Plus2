<div class="header-dashboard">
    <div class="wrap">
        <!-- Header Left Section -->
        <div class="header-left">
            <!-- Logo -->
            <a href="index-2.html">
                <img class="" id="logo_header_mobile" alt="Logo" src="{{ asset('assets/images/logo/logo.png') }}"
                    data-light="images/logo/logo.png" data-dark="{{ asset('assets/images/logo/logo.png') }}"
                    data-width="154px" data-height="52px"
                    data-retina="{{ asset('assets/images/logo/logo.png') }}">
            </a>

            <!-- Menu Toggle Button -->
            <div class="button-show-hide">
                <i class="icon-menu-left"></i>
            </div>

            <!-- Search Form -->
            <form class="form-search flex-grow">
                <fieldset class="name">
                    <input type="text" placeholder="Search here..." class="show-search" name="name" tabindex="2" required>
                </fieldset>
                <div class="button-submit">
                    <button type="submit">
                        <i class="icon-search"></i>
                    </button>
                </div>

                <!-- Search Suggestions -->
                <div class="box-content-search" id="box-content-search">
                    <!-- Top Selling Products -->
                    <ul class="mb-24">
                        <li class="mb-14">
                            <div class="body-title">Top selling product</div>
                        </li>
                        <li class="mb-14"><div class="divider"></div></li>
                        <li>
                            <ul>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/images/products/17.png') }}" alt="Dog Food">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Dog Food Rachael Ray Nutrish®</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10"><div class="divider"></div></li>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/images/products/18.png') }}" alt="Natural Dog Food">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Natural Dog Food Healthy Dog Food</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10"><div class="divider"></div></li>
                                <li class="product-item gap14">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/images/products/19.png') }}" alt="Freshpet Dog Food">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Freshpet Healthy Dog Food and Cat</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Order Products -->
                    <ul>
                        <li class="mb-14">
                            <div class="body-title">Order product</div>
                        </li>
                        <li class="mb-14"><div class="divider"></div></li>
                        <li>
                            <ul>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/images/products/20.png') }}" alt="Sojos Crunchy">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Sojos Crunchy Natural Grain Free...</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10"><div class="divider"></div></li>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/images/products/21.png') }}" alt="Kristin Watson">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Kristin Watson</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10"><div class="divider"></div></li>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/images/products/22.png') }}" alt="Mega Pumpkin Bone">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Mega Pumpkin Bone</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10"><div class="divider"></div></li>
                                <li class="product-item gap14">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/images/products/23.png') }}" alt="Mega Pumpkin Bone">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Mega Pumpkin Bone</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </form>
        </div>

        <!-- Header Grid Section -->
        <div class="header-grid">

            <!-- Notification Dropdown -->
            <div class="popup-wrap message type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-item">
                            <span class="text-tiny">1</span>
                            <i class="icon-bell"></i>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton2">
                        <li><h6>Notifications</h6></li>
                        <li>
                            <div class="message-item item-1">
                                <div class="image">
                                    <i class="icon-noti-1"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">Discount available</div>
                                    <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus at, ullamcorper nec diam</div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#" class="tf-button w-full">View all</a></li>
                    </ul>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="popup-wrap user type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-user wg-user">
                            <span class="image">
                                <img src="{{ asset('assets/images/avatar/user-1.png') }}" alt="User Avatar">
                            </span>
                            <span class="flex flex-column">
                                <span class="body-title mb-2">Kristin Watson</span>
                                <span class="text-tiny">{{ auth()->user()?->name }}</span>
                            </span>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton3">
                        <li>
                            <a href="{{ auth()->guard('admins')->check() ? route('admin.profile') : (auth()->guard('vendors')->check() ? route('vendors.profile') : '#') }}" class="user-item">
                                <div class="icon"><i class="icon-user"></i></div>
                                <div class="body-title-2">Account</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon"><i class="icon-mail"></i></div>
                                <div class="body-title-2">Inbox</div>
                                <div class="number">27</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon"><i class="icon-file-text"></i></div>
                                <div class="body-title-2">Taskboard</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon"><i class="icon-headphones"></i></div>
                                <div class="body-title-2">Support</div>
                            </a>
                        </li>
                        <li>
                            <form action="{{ auth('admins')->user() ? route('logout') : route('vendors.logout') }}" method="POST">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                            <ul>
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (including Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
