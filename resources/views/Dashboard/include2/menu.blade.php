<div id="dashboard-options-menu" class="side-menu dashboard left closed">
    <!-- SVG PLUS -->
    <svg class="svg-plus">
    <use xlink:href="#svg-plus"></use>
    </svg>
    <!-- /SVG PLUS -->

    <!-- SIDE MENU HEADER -->
    <div class="side-menu-header">
        <!-- USER QUICKVIEW -->
        <div class="user-quickview">
            <!-- USER AVATAR -->
            <a href="{{lang_url('/')}}">
                <div class="outer-ring">
                    <div class="inner-ring"></div>
                    <figure class="user-avatar">

                        @if(auth()->user()->image !='')
                        <img   src="{{ asset('public/uploads/user_img')}}/{{auth()->user()->image}}" class="img-responsive img-circle" alt="{{auth()->user()->name}}" />
                        @else
                        <img  src="{{ asset('public/assets/'.DSH .'/images/dashboard/profile-default-image.png')}}" alt="{{auth()->user()->name}}">
                        @endif
                    </figure>
                </div>
            </a>
            <!-- /USER AVATAR -->

            <!-- USER INFORMATION -->
            <p class="user-name">{{auth()->user()->name}}</p>
<!--				<p class="user-money">$745.00</p>-->
            <!-- /USER INFORMATION -->
        </div>
        <!-- /USER QUICKVIEW -->
    </div>
    <!-- /SIDE MENU HEADER -->

    <!-- SIDE MENU TITLE -->
    <p class="side-menu-title"> {{ trans('cpanel.Your_Account') }}</p>
    <!-- /SIDE MENU TITLE -->

    <!-- DROPDOWN -->
    <ul class="dropdown dark hover-effect interactive">
        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item active">
            <a href="{{lang_url('dashboard/settings')}}">
                <span class="sl-icon icon-settings"></span>
                {{ trans('cpanel.Account_Settings') }}
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="{{lang_url('dashboard/notifications')}}">
                <span class="sl-icon icon-star"></span>
                {{ trans('cpanel.Notifications') }}
                @if(session('count_notfication')>0)
               {{ session('count_notfication')}}
            @endif
          
               
            </a>
            <!-- PIN -->
            <!--<span class="pin soft-edged big primary">49</span>-->
            <!-- /PIN -->
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item interactive">
            <a href="#">
                <span class="sl-icon icon-envelope"></span>
                {{ trans('cpanel.Messages') }}
                 @if(session('count_message')>0)
               
                  {{ session('count_message')}}
              
                 @endif
                <svg class="svg-arrow">
                <use xlink:href="#svg-arrow"></use>
                </svg>
                <!-- /SVG ARROW -->
            </a>

            <!-- INNER DROPDOWN -->
            <ul class="inner-dropdown">


                <li class="inner-dropdown-item">
                    <a href="{{lang_url('your-inbox')}}"> {{ trans('cpanel.Your_Inbox') }}</a>
                    <!--<span class="pin soft-edged secondary">2</span>-->
                </li>

                <li class="inner-dropdown-item">
                    <a href="{{lang_url('sent_messages')}}"> {{ trans('cpanel.Sent_messages') }}</a>
                    <!--<span class="pin soft-edged secondary">2</span>-->
                </li>

                <li class="inner-dropdown-item">
                    <a href="{{lang_url('messages_delted')}}"> {{ trans('cpanel.Deleted_Messages') }}</a>
                </li>

            </ul>
            <!-- INNER DROPDOWN -->

            <!-- PIN -->
            <span class="pin soft-edged big secondary">!</span>
            <!-- /PIN -->
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <!--        <li class="dropdown-item">
                    <a href="dashboard-purchases.php">
                        <span class="sl-icon icon-tag"></span>
                        Your Purchases
                    </a>
                </li>-->
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <!--
                                <li class="dropdown-item">
                                        <a href="dashboard-buycredits.php">
                            <span class="sl-icon icon-credit-card"></span>
                            Buy Credits
                        </a>
                                </li>
        -->
        <!-- /DROPDOWN ITEM -->
    </ul>
    <!-- /DROPDOWN -->

    <!-- SIDE MENU TITLE -->
<!--		<p class="side-menu-title">Info &amp; Statistics</p>-->
    <!-- /SIDE MENU TITLE -->

    <!--
                    <ul class="dropdown dark hover-effect">
                            <li class="dropdown-item">
                                    <a href="dashboard-statement.php">
                        <span class="sl-icon icon-layers"></span>
                        Sales Statement
                    </a>
                            </li>

                            <li class="dropdown-item">
                                    <a href="dashboard-statistics.php">
                        <span class="sl-icon icon-chart"></span>
                        Statistics
                    </a>
                            </li>
                    </ul>
    -->

    <!-- SIDE MENU TITLE -->
    <p class="side-menu-title">{{ trans('cpanel.Author_Tools') }}</p>
    <!-- /SIDE MENU TITLE -->

    <!-- DROPDOWN -->
    <ul class="dropdown dark hover-effect">
        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="{{lang_url('dashboard/items/create')}}">
                <span class="sl-icon icon-arrow-up-circle"></span>
                {{ trans('cpanel.Upload_Item') }}
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="{{lang_url('dashboard/items')}}">
                <span class="sl-icon icon-folder-alt"></span>
                {{ trans('cpanel.Manage_Items') }}
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <!--
                                <li class="dropdown-item">
                                        <a href="dashboard-withdrawals.php">
                            <span class="sl-icon icon-wallet"></span>
                            Withdrawals
                        </a>
                                </li>
        -->
        <!-- /DROPDOWN ITEM -->
    </ul>
    <!-- /DROPDOWN -->

    <a href="{{lang_url('logout')}}" class="button medium secondary">{{ trans('cpanel.log_out') }}</a>
</div>