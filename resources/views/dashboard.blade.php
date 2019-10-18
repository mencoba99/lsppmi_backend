@extends('layouts.base')

@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--Begin::Dashboard 7-->

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-8">
                <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
                    <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Exclusive Datatable Plugin
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-md dropdown-menu-fit">

                                    <!--begin::Nav-->
                                    <ul class="kt-nav">
                                        <li class="kt-nav__head">
                                            Export Options
                                            <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                <span class="kt-nav__link-text">Activity</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                                <span class="kt-nav__link-text">FAQ</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-link"></i>
                                                <span class="kt-nav__link-text">Settings</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                                <span class="kt-nav__link-text">Support</span>
                                                <span class="kt-nav__link-badge">
																		<span class="kt-badge kt-badge--success">5</span>
																	</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__foot">
                                            <a class="btn btn-label-danger btn-bold btn-sm" href="#">Upgrade plan</a>
                                            <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                        </li>
                                    </ul>

                                    <!--end::Nav-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">

                        <!--begin: Datatable -->
                        <div class="kt-datatable" id="kt_datatable_latest_orders"></div>

                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
            <div class="col-xl-4">

                <!--begin:: Widgets/Inbound Bandwidth-->
                <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder kt-portlet--height-fluid-half">
                    <div class="kt-portlet__head kt-portlet__space-x">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Inbound Bandwidth
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="#" class="btn btn-label-success btn-sm btn-bold dropdown-toggle" data-toggle="dropdown">
                                Export
                            </a>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                            <span class="kt-nav__link-text">Reports</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-send"></i>
                                            <span class="kt-nav__link-text">Messages</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                            <span class="kt-nav__link-text">Charts</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                            <span class="kt-nav__link-text">Members</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-settings"></i>
                                            <span class="kt-nav__link-text">Settings</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fluid">
                        <div class="kt-widget20">
                            <div class="kt-widget20__content kt-portlet__space-x">
                                <span class="kt-widget20__number kt-font-brand">670+</span>
                                <span class="kt-widget20__desc">Successful transactions</span>
                            </div>
                            <div class="kt-widget20__chart" style="height:130px;">
                                <canvas id="kt_chart_bandwidth1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Inbound Bandwidth-->
                <div class="kt-space-20"></div>

                <!--begin:: Widgets/Outbound Bandwidth-->
                <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder kt-portlet--height-fluid-half">
                    <div class="kt-portlet__head kt-portlet__space-x">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Outbound Bandwidth
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="#" class="btn btn-label-warning btn-sm  btn-bold dropdown-toggle" data-toggle="dropdown">
                                Download
                            </a>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                            <span class="kt-nav__link-text">Reports</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-send"></i>
                                            <span class="kt-nav__link-text">Messages</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                            <span class="kt-nav__link-text">Charts</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                            <span class="kt-nav__link-text">Members</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-settings"></i>
                                            <span class="kt-nav__link-text">Settings</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fluid">
                        <div class="kt-widget20">
                            <div class="kt-widget20__content kt-portlet__space-x">
                                <span class="kt-widget20__number kt-font-danger">1340+</span>
                                <span class="kt-widget20__desc">Completed orders</span>
                            </div>
                            <div class="kt-widget20__chart" style="height:130px;">
                                <canvas id="kt_chart_bandwidth2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Outbound Bandwidth-->
            </div>
        </div>

        <!--End::Section-->

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-4">

                <!--begin:: Widgets/Trends-->
                <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
                    <div class="kt-portlet__head kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Trends
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                <span class="kt-nav__link-text">Reports</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-send"></i>
                                                <span class="kt-nav__link-text">Messages</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                <span class="kt-nav__link-text">Charts</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                <span class="kt-nav__link-text">Members</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                <span class="kt-nav__link-text">Settings</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fluid kt-portlet__body--fit">
                        <div class="kt-widget4 kt-widget4--sticky">
                            <div class="kt-widget4__chart">
                                <canvas id="kt_chart_trends_stats" style="height: 240px;"></canvas>
                            </div>
                            <div class="kt-widget4__items kt-widget4__items--bottom kt-portlet__space-x kt-margin-b-20">
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__img kt-widget4__img--logo">
                                        <img src="{{ Storage::url('media/client-logos/logo3.png')}}" alt="">
                                    </div>
                                    <div class="kt-widget4__info">
                                        <a href="#" class="kt-widget4__title">
                                            Phyton
                                        </a>
                                        <span class="kt-widget4__sub">
																A Programming Language
															</span>
                                    </div>
                                    <span class="kt-widget4__ext">
															<span class="kt-widget4__number kt-font-danger">+$17</span>
														</span>
                                </div>
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__img kt-widget4__img--logo">
                                        <img src="{{ Storage::url('media/client-logos/logo1.png')}}" alt="">
                                    </div>
                                    <div class="kt-widget4__info">
                                        <a href="#" class="kt-widget4__title">
                                            FlyThemes
                                        </a>
                                        <span class="kt-widget4__sub">
																A Let's Fly Fast Again Language
															</span>
                                    </div>
                                    <span class="kt-widget4__ext">
															<span class="kt-widget4__number kt-font-danger">+$300</span>
														</span>
                                </div>
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__img kt-widget4__img--logo">
                                        <img src="{{ Storage::url('media/client-logos/logo2.png')}}" alt="">
                                    </div>
                                    <div class="kt-widget4__info">
                                        <a href="#" class="kt-widget4__title">
                                            AirApp
                                        </a>
                                        <span class="kt-widget4__sub">
																Awesome App For Project Management
															</span>
                                    </div>
                                    <span class="kt-widget4__ext">
															<span class="kt-widget4__number kt-font-danger">+$6700</span>
														</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Trends-->
            </div>
            <div class="col-xl-4">

                <!--begin:: Widgets/Sales Stats-->
                <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
                    <div class="kt-portlet__head kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Sales Stats
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">Finance</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-graph-1"></i>
                                                <span class="kt-nav__link-text">Statistics</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                                <span class="kt-nav__link-text">Events</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-layers-1"></i>
                                                <span class="kt-nav__link-text">Reports</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">HR</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                                <span class="kt-nav__link-text">Notifications</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-file-1"></i>
                                                <span class="kt-nav__link-text">Files</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <!--begin::Widget 6-->
                        <div class="kt-widget15">
                            <div class="kt-widget15__chart">
                                <canvas id="kt_chart_sales_stats" style="height:160px;"></canvas>
                            </div>
                            <div class="kt-widget15__items kt-margin-t-40">
                                <div class="row">
                                    <div class="col">
                                        <div class="kt-widget15__item">
																<span class="kt-widget15__stats">
																	63%
																</span>
                                            <span class="kt-widget15__text">
																	Sales Grow
																</span>
                                            <div class="kt-space-10"></div>
                                            <div class="progress kt-widget15__chart-progress--sm">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="kt-widget15__item">
																<span class="kt-widget15__stats">
																	54%
																</span>
                                            <span class="kt-widget15__text">
																	Orders Grow
																</span>
                                            <div class="kt-space-10"></div>
                                            <div class="progress kt-progress--sm">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="kt-widget15__item">
																<span class="kt-widget15__stats">
																	41%
																</span>
                                            <span class="kt-widget15__text">
																	Profit Grow
																</span>
                                            <div class="kt-space-10"></div>
                                            <div class="progress kt-progress--sm">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 55%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="kt-widget15__item">
																<span class="kt-widget15__stats">
																	79%
																</span>
                                            <span class="kt-widget15__text">
																	Member Grow
																</span>
                                            <div class="kt-space-10"></div>
                                            <div class="progress kt-progress--sm">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 60%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="kt-widget15__desc">
                                            * lorem ipsum dolor sit amet consectetuer sediat elit
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end::Widget 6-->
                    </div>
                </div>

                <!--end:: Widgets/Sales Stats-->
            </div>
            <div class="col-xl-4">

                <!--begin:: Widgets/Top Locations-->
                <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Top Locations
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">Finance</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-graph-1"></i>
                                                <span class="kt-nav__link-text">Statistics</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                                <span class="kt-nav__link-text">Events</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-layers-1"></i>
                                                <span class="kt-nav__link-text">Reports</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">HR</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                                <span class="kt-nav__link-text">Notifications</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-file-1"></i>
                                                <span class="kt-nav__link-text">Files</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget15">
                            <div class="kt-widget15__map">
                                <div id="kt_chart_latest_trends_map" style="height:320px;"></div>
                            </div>
                            <div class="kt-widget15__items kt-margin-t-30">
                                <div class="row">
                                    <div class="col">

                                        <!--begin::widget item-->
                                        <div class="kt-widget15__item">
																<span class="kt-widget15__stats">
																	63%
																</span>
                                            <span class="kt-widget15__text">
																	London
																</span>
                                            <div class="kt-space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                        <!--end::widget item-->
                                    </div>
                                    <div class="col">

                                        <!--begin::widget item-->
                                        <div class="kt-widget15__item">
																<span class="kt-widget15__stats">
																	54%
																</span>
                                            <span class="kt-widget15__text">
																	Glasgow
																</span>
                                            <div class="kt-space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                        <!--end::widget item-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">

                                        <!--begin::widget item-->
                                        <div class="kt-widget15__item">
																<span class="kt-widget15__stats">
																	41%
																</span>
                                            <span class="kt-widget15__text">
																	Dublin
																</span>
                                            <div class="kt-space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 55%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                        <!--end::widget item-->
                                    </div>
                                    <div class="col">

                                        <!--begin::widget item-->
                                        <div class="kt-widget15__item">
																<span class="kt-widget15__stats">
																	79%
																</span>
                                            <span class="kt-widget15__text">
																	Edinburgh
																</span>
                                            <div class="kt-space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 60%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                            <!--end::widget item-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Top Locations-->
            </div>
        </div>

        <!--End::Section-->

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-4">

                <!--begin:: Widgets/Download Files-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Download Files
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
                                Latest
                            </a>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">

                                <!--begin::Nav-->
                                <ul class="kt-nav">
                                    <li class="kt-nav__head">
                                        Export Options
                                        <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                    </li>
                                    <li class="kt-nav__separator"></li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-drop"></i>
                                            <span class="kt-nav__link-text">Activity</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                            <span class="kt-nav__link-text">FAQ</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-link"></i>
                                            <span class="kt-nav__link-text">Settings</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                            <span class="kt-nav__link-text">Support</span>
                                            <span class="kt-nav__link-badge">
																	<span class="kt-badge kt-badge--success">5</span>
																</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__separator"></li>
                                    <li class="kt-nav__foot">
                                        <a class="btn btn-label-danger btn-bold btn-sm" href="#">Upgrade plan</a>
                                        <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                    </li>
                                </ul>

                                <!--end::Nav-->
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <!--begin::k-widget4-->
                        <div class="kt-widget4">
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__pic kt-widget4__pic--icon">
                                    <img src="{{ Storage::url('media/files/doc.svg')}}" alt="">
                                </div>
                                <a href="#" class="kt-widget4__title">
                                    Metronic Documentation
                                </a>
                                <div class="kt-widget4__tools">
                                    <a href="#" class="btn btn-clean btn-icon btn-sm">
                                        <i class="flaticon2-download-symbol-of-down-arrow-in-a-rectangle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__pic kt-widget4__pic--icon">
                                    <img src="{{ Storage::url('media/files/jpg.svg')}}" alt="">
                                </div>
                                <a href="#" class="kt-widget4__title">
                                    Project Launch Event
                                </a>
                                <div class="kt-widget4__tools">
                                    <a href="#" class="btn btn-clean btn-icon btn-sm">
                                        <i class="flaticon2-download-symbol-of-down-arrow-in-a-rectangle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__pic kt-widget4__pic--icon">
                                    <img src="{{ Storage::url('media/files/pdf.svg')}}" alt="">
                                </div>
                                <a href="#" class="kt-widget4__title">
                                    Full Developer Manual For 4.7
                                </a>
                                <div class="kt-widget4__tools">
                                    <a href="#" class="btn btn-clean btn-icon btn-sm">
                                        <i class="flaticon2-download-symbol-of-down-arrow-in-a-rectangle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__pic kt-widget4__pic--icon">
                                    <img src="{{ Storage::url('media/files/javascript.svg')}}" alt="">
                                </div>
                                <a href="#" class="kt-widget4__title">
                                    Make JS Great Again
                                </a>
                                <div class="kt-widget4__tools">
                                    <a href="#" class="btn btn-clean btn-icon btn-sm">
                                        <i class="flaticon2-download-symbol-of-down-arrow-in-a-rectangle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__pic kt-widget4__pic--icon">
                                    <img src="{{ Storage::url('media/files/zip.svg')}}" alt="">
                                </div>
                                <a href="#" class="kt-widget4__title">
                                    Download Ziped version OF 5.0
                                </a>
                                <div class="kt-widget4__tools">
                                    <a href="#" class="btn btn-clean btn-icon btn-sm">
                                        <i class="flaticon2-download-symbol-of-down-arrow-in-a-rectangle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__pic kt-widget4__pic--icon">
                                    <img src="{{ Storage::url('media/files/pdf.svg')}}" alt="">
                                </div>
                                <a href="#" class="kt-widget4__title">
                                    Finance Report 2016/2017
                                </a>
                                <div class="kt-widget4__tools">
                                    <a href="#" class="btn btn-clean btn-icon btn-sm">
                                        <i class="flaticon2-download-symbol-of-down-arrow-in-a-rectangle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!--end::Widget 9-->
                    </div>
                </div>

                <!--end:: Widgets/Download Files-->
            </div>
            <div class="col-xl-4">

                <!--begin:: Widgets/New Users-->
                <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                New Users
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_widget4_tab1_content" role="tab">
                                        Today
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_widget4_tab2_content" role="tab">
                                        Month
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_widget4_tab1_content">
                                <div class="kt-widget4">
                                    <div class="kt-widget4__item">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img src="{{ Storage::url('media/users/100_4.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="#" class="kt-widget4__username">
                                                Anna Strong
                                            </a>
                                            <p class="kt-widget4__text">
                                                Visual Designer,Google Inc
                                            </p>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-label-brand btn-bold">Follow</a>
                                    </div>
                                    <div class="kt-widget4__item">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img src="{{ Storage::url('media/users/100_14.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="#" class="kt-widget4__username">
                                                Milano Esco
                                            </a>
                                            <p class="kt-widget4__text">
                                                Product Designer, Apple Inc
                                            </p>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-label-warning btn-bold">Follow</a>
                                    </div>
                                    <div class="kt-widget4__item">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img src="{{ Storage::url('media/users/100_11.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="#" class="kt-widget4__username">
                                                Nick Bold
                                            </a>
                                            <p class="kt-widget4__text">
                                                Web Developer, Facebook Inc
                                            </p>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-label-danger btn-bold">Follow</a>
                                    </div>
                                    <div class="kt-widget4__item">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img src="{{ Storage::url('media/users/100_1.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="#" class="kt-widget4__username">
                                                Wiltor Delton
                                            </a>
                                            <p class="kt-widget4__text">
                                                Project Manager, Amazon Inc
                                            </p>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-label-success btn-bold">Follow</a>
                                    </div>
                                    <div class="kt-widget4__item">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img src="{{ Storage::url('media/users/100_5.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="#" class="kt-widget4__username">
                                                Nick Stone
                                            </a>
                                            <p class="kt-widget4__text">
                                                Visual Designer, Github Inc
                                            </p>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-label-primary btn-bold">Follow</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_widget4_tab2_content">
                                <div class="kt-widget4">
                                    <div class="kt-widget4__item">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img src="{{ Storage::url('media/users/100_2.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="#" class="kt-widget4__username">
                                                Kristika Bold
                                            </a>
                                            <p class="kt-widget4__text">
                                                Product Designer,Apple Inc
                                            </p>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-label-success">Follow</a>
                                    </div>
                                    <div class="kt-widget4__item">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img src="{{ Storage::url('media/users/100_13.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="#" class="kt-widget4__username">
                                                Ron Silk
                                            </a>
                                            <p class="kt-widget4__text">
                                                Release Manager, Loop Inc
                                            </p>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-label-brand">Follow</a>
                                    </div>
                                    <div class="kt-widget4__item">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img src="{{ Storage::url('media/users/100_9.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="#" class="kt-widget4__username">
                                                Nick Bold
                                            </a>
                                            <p class="kt-widget4__text">
                                                Web Developer, Facebook Inc
                                            </p>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-label-danger">Follow</a>
                                    </div>
                                    <div class="kt-widget4__item">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img src="{{ Storage::url('media/users/100_2.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="#" class="kt-widget4__username">
                                                Wiltor Delton
                                            </a>
                                            <p class="kt-widget4__text">
                                                Project Manager, Amazon Inc
                                            </p>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-label-success">Follow</a>
                                    </div>
                                    <div class="kt-widget4__item">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img src="{{ Storage::url('media/users/100_8.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="#" class="kt-widget4__username">
                                                Nick Bold
                                            </a>
                                            <p class="kt-widget4__text">
                                                Web Developer, Facebook Inc
                                            </p>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-label-info">Follow</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/New Users-->
            </div>
            <div class="col-xl-4">

                <!--begin:: Widgets/Last Updates-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Latest Updates
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
                                Today
                            </a>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">

                                <!--begin::Nav-->
                                <ul class="kt-nav">
                                    <li class="kt-nav__head">
                                        Export Options
                                        <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                    </li>
                                    <li class="kt-nav__separator"></li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-drop"></i>
                                            <span class="kt-nav__link-text">Activity</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                            <span class="kt-nav__link-text">FAQ</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-link"></i>
                                            <span class="kt-nav__link-text">Settings</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                            <span class="kt-nav__link-text">Support</span>
                                            <span class="kt-nav__link-badge">
																	<span class="kt-badge kt-badge--success">5</span>
																</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__separator"></li>
                                    <li class="kt-nav__foot">
                                        <a class="btn btn-label-danger btn-bold btn-sm" href="#">Upgrade plan</a>
                                        <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                    </li>
                                </ul>

                                <!--end::Nav-->
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <!--begin::widget 12-->
                        <div class="kt-widget4">
                            <div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="flaticon-pie-chart-1 kt-font-info"></i>
													</span>
                                <a href="#" class="kt-widget4__title kt-widget4__title--light">
                                    Metronic v6 has been arrived!
                                </a>
                                <span class="kt-widget4__number kt-font-info">+500</span>
                            </div>
                            <div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="flaticon-safe-shield-protection  kt-font-success"></i>
													</span>
                                <a href="#" class="kt-widget4__title kt-widget4__title--light">
                                    Metronic community meet-up 2019 in Rome.
                                </a>
                                <span class="kt-widget4__number kt-font-success">+1260</span>
                            </div>
                            <div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="flaticon2-line-chart kt-font-danger"></i>
													</span>
                                <a href="#" class="kt-widget4__title kt-widget4__title--light">
                                    Metronic Angular 7 version will be landing soon...
                                </a>
                                <span class="kt-widget4__number kt-font-danger">+1080</span>
                            </div>
                            <div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="flaticon2-pie-chart-1 kt-font-primary"></i>
													</span>
                                <a href="#" class="kt-widget4__title kt-widget4__title--light">
                                    ale! Purchase Metronic at 70% off for limited time
                                </a>
                                <span class="kt-widget4__number kt-font-primary">70% Off!</span>
                            </div>
                            <div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="flaticon2-rocket kt-font-brand"></i>
													</span>
                                <a href="#" class="kt-widget4__title kt-widget4__title--light">
                                    Metronic VueJS version is in progress. Stay tuned!
                                </a>
                                <span class="kt-widget4__number kt-font-brand">+134</span>
                            </div>
                            <div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="flaticon2-notification kt-font-warning"></i>
													</span>
                                <a href="#" class="kt-widget4__title kt-widget4__title--light">
                                    Black Friday! Purchase Metronic at ever lowest 90% off for limited time
                                </a>
                                <span class="kt-widget4__number kt-font-warning">70% Off!</span>
                            </div>
                            <div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="flaticon2-file kt-font-success"></i>
													</span>
                                <a href="#" class="kt-widget4__title kt-widget4__title--light">
                                    Metronic React version is in progress.
                                </a>
                                <span class="kt-widget4__number kt-font-success">+13%</span>
                            </div>
                        </div>

                        <!--end::Widget 12-->
                    </div>
                </div>

                <!--end:: Widgets/Last Updates-->
            </div>
        </div>

        <!--End::Section-->

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-8">

                <!--begin:: Widgets/Best Sellers-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Best Sellers
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_widget5_tab1_content" role="tab">
                                        Latest
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_widget5_tab2_content" role="tab">
                                        Month
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_widget5_tab3_content" role="tab">
                                        All time
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
                                <div class="kt-widget5">
                                    <div class="kt-widget5__item">
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__pic">
                                                <img class="kt-widget7__img" src="{{ Storage::url('media/products/product27.jpg')}}" alt="">
                                            </div>
                                            <div class="kt-widget5__section">
                                                <a href="#" class="kt-widget5__title">
                                                    Great Logo Designn
                                                </a>
                                                <p class="kt-widget5__desc">
                                                    Metronic admin themes.
                                                </p>
                                                <div class="kt-widget5__info">
                                                    <span>Author:</span>
                                                    <span class="kt-font-info">Keenthemes</span>
                                                    <span>Released:</span>
                                                    <span class="kt-font-info">23.08.17</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">19,200</span>
                                                <span class="kt-widget5__sales">sales</span>
                                            </div>
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">1046</span>
                                                <span class="kt-widget5__votes">votes</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__item">
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__pic">
                                                <img class="kt-widget7__img" src="{{ Storage::url('media/products/product22.jpg')}}" alt="">
                                            </div>
                                            <div class="kt-widget5__section">
                                                <a href="#" class="kt-widget5__title">
                                                    Branding Mockup
                                                </a>
                                                <p class="kt-widget5__desc">
                                                    Metronic bootstrap themes.
                                                </p>
                                                <div class="kt-widget5__info">
                                                    <span>Author:</span>
                                                    <span class="kt-font-info">Fly themes</span>
                                                    <span>Released:</span>
                                                    <span class="kt-font-info">23.08.17</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">24,583</span>
                                                <span class="kt-widget5__sales">sales</span>
                                            </div>
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">3809</span>
                                                <span class="kt-widget5__votes">votes</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__item">
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__pic">
                                                <img class="kt-widget7__img" src="{{ Storage::url('media/products/product15.jpg')}}" alt="">
                                            </div>
                                            <div class="kt-widget5__section">
                                                <a href="#" class="kt-widget5__title">
                                                    Awesome Mobile App
                                                </a>
                                                <p class="kt-widget5__desc">
                                                    Metronic admin themes.Lorem Ipsum Amet
                                                </p>
                                                <div class="kt-widget5__info">
                                                    <span>Author:</span>
                                                    <span class="kt-font-info">Fly themes</span>
                                                    <span>Released:</span>
                                                    <span class="kt-font-info">23.08.17</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">210,054</span>
                                                <span class="kt-widget5__sales">sales</span>
                                            </div>
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">1103</span>
                                                <span class="kt-widget5__votes">votes</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_widget5_tab2_content">
                                <div class="kt-widget5">
                                    <div class="kt-widget5__item">
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__pic">
                                                <img class="kt-widget7__img" src="{{ Storage::url('media/products/product10.jpg')}}" alt="">
                                            </div>
                                            <div class="kt-widget5__section">
                                                <a href="#" class="kt-widget5__title">
                                                    Branding Mockup
                                                </a>
                                                <p class="kt-widget5__desc">
                                                    Metronic bootstrap themes.
                                                </p>
                                                <div class="kt-widget5__info">
                                                    <span>Author:</span>
                                                    <span class="kt-font-info">Fly themes</span>
                                                    <span>Released:</span>
                                                    <span class="kt-font-info">23.08.17</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">24,583</span>
                                                <span class="kt-widget5__sales">sales</span>
                                            </div>
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">3809</span>
                                                <span class="kt-widget5__votes">votes</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__item">
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__pic">
                                                <img class="kt-widget7__img" src="{{ Storage::url('media/products/product11.jpg')}}" alt="">
                                            </div>
                                            <div class="kt-widget5__section">
                                                <a href="#" class="kt-widget5__title">
                                                    Awesome Mobile App
                                                </a>
                                                <p class="kt-widget5__desc">
                                                    Metronic admin themes.Lorem Ipsum Amet
                                                </p>
                                                <div class="kt-widget5__info">
                                                    <span>Author:</span>
                                                    <span class="kt-font-info">Fly themes</span>
                                                    <span>Released:</span>
                                                    <span class="kt-font-info">23.08.17</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">210,054</span>
                                                <span class="kt-widget5__sales">sales</span>
                                            </div>
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">1103</span>
                                                <span class="kt-widget5__votes">votes</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__item">
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__pic">
                                                <img class="kt-widget7__img" src="{{ Storage::url('media/products/product6.jpg')}}" alt="">
                                            </div>
                                            <div class="kt-widget5__section">
                                                <a href="#" class="kt-widget5__title">
                                                    Great Logo Designn
                                                </a>
                                                <p class="kt-widget5__desc">
                                                    Metronic admin themes.
                                                </p>
                                                <div class="kt-widget5__info">
                                                    <span>Author:</span>
                                                    <span class="kt-font-info">Keenthemes</span>
                                                    <span>Released:</span>
                                                    <span class="kt-font-info">23.08.17</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">19,200</span>
                                                <span class="kt-widget5__sales">sales</span>
                                            </div>
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">1046</span>
                                                <span class="kt-widget5__votes">votes</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_widget5_tab3_content">
                                <div class="kt-widget5">
                                    <div class="kt-widget5__item">
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__pic">
                                                <img class="kt-widget7__img" src="{{ Storage::url('media/products/product11.jpg')}}" alt="">
                                            </div>
                                            <div class="kt-widget5__section">
                                                <a href="#" class="kt-widget5__title">
                                                    Awesome Mobile App
                                                </a>
                                                <p class="kt-widget5__desc">
                                                    Metronic admin themes.Lorem Ipsum Amet
                                                </p>
                                                <div class="kt-widget5__info">
                                                    <span>Author:</span>
                                                    <span class="kt-font-info">Fly themes</span>
                                                    <span>Released:</span>
                                                    <span class="kt-font-info">23.08.17</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">210,054</span>
                                                <span class="kt-widget5__sales">sales</span>
                                            </div>
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">1103</span>
                                                <span class="kt-widget5__votes">votes</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__item">
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__pic">
                                                <img class="kt-widget7__img" src="{{ Storage::url('media/products/product6.jpg')}}" alt="">
                                            </div>
                                            <div class="kt-widget5__section">
                                                <a href="#" class="kt-widget5__title">
                                                    Great Logo Designn
                                                </a>
                                                <p class="kt-widget5__desc">
                                                    Metronic admin themes.
                                                </p>
                                                <div class="kt-widget5__info">
                                                    <span>Author:</span>
                                                    <span class="kt-font-info">Keenthemes</span>
                                                    <span>Released:</span>
                                                    <span class="kt-font-info">23.08.17</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">19,200</span>
                                                <span class="kt-widget5__sales">sales</span>
                                            </div>
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">1046</span>
                                                <span class="kt-widget5__votes">votes</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__item">
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__pic">
                                                <img class="kt-widget7__img" src="{{ Storage::url('media/products/product10.jpg')}}" alt="">
                                            </div>
                                            <div class="kt-widget5__section">
                                                <a href="#" class="kt-widget5__title">
                                                    Branding Mockup
                                                </a>
                                                <p class="kt-widget5__desc">
                                                    Metronic bootstrap themes.
                                                </p>
                                                <div class="kt-widget5__info">
                                                    <span>Author:</span>
                                                    <span class="kt-font-info">Fly themes</span>
                                                    <span>Released:</span>
                                                    <span class="kt-font-info">23.08.17</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">24,583</span>
                                                <span class="kt-widget5__sales">sales</span>
                                            </div>
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">3809</span>
                                                <span class="kt-widget5__votes">votes</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Best Sellers-->
            </div>
            <div class="col-xl-4">

                <!--begin:: Widgets/Authors Profit-->
                <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Authors Profit
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
                                All
                            </a>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">Finance</span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-graph-1"></i>
                                            <span class="kt-nav__link-text">Statistics</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                            <span class="kt-nav__link-text">Events</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-layers-1"></i>
                                            <span class="kt-nav__link-text">Reports</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">HR</span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                            <span class="kt-nav__link-text">Notifications</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-file-1"></i>
                                            <span class="kt-nav__link-text">Files</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget4">
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__pic kt-widget4__pic--logo">
                                    <img src="{{ Storage::url('media/client-logos/logo5.png')}}" alt="">
                                </div>
                                <div class="kt-widget4__info">
                                    <a href="#" class="kt-widget4__title">
                                        Trump Themes
                                    </a>
                                    <p class="kt-widget4__text">
                                        Make Metronic Great Again
                                    </p>
                                </div>
                                <span class="kt-widget4__number kt-font-brand">+$2500</span>
                            </div>
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__pic kt-widget4__pic--logo">
                                    <img src="{{ Storage::url('media/client-logos/logo4.png')}}" alt="">
                                </div>
                                <div class="kt-widget4__info">
                                    <a href="#" class="kt-widget4__title">
                                        StarBucks
                                    </a>
                                    <p class="kt-widget4__text">
                                        Good Coffee & Snacks
                                    </p>
                                </div>
                                <span class="kt-widget4__number kt-font-brand">-$290</span>
                            </div>
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__pic kt-widget4__pic--logo">
                                    <img src="{{ Storage::url('media/client-logos/logo3.png')}}" alt="">
                                </div>
                                <div class="kt-widget4__info">
                                    <a href="#" class="kt-widget4__title">
                                        Phyton
                                    </a>
                                    <p class="kt-widget4__text">
                                        A Programming Language
                                    </p>
                                </div>
                                <span class="kt-widget4__number kt-font-brand">+$17</span>
                            </div>
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__pic kt-widget4__pic--logo">
                                    <img src="{{ Storage::url('media/client-logos/logo2.png')}}" alt="">
                                </div>
                                <div class="kt-widget4__info">
                                    <a href="#" class="kt-widget4__title">
                                        GreenMakers
                                    </a>
                                    <p class="kt-widget4__text">
                                        Make Green Great Again
                                    </p>
                                </div>
                                <span class="kt-widget4__number kt-font-brand">-$2.50</span>
                            </div>
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__pic kt-widget4__pic--logo">
                                    <img src="{{ Storage::url('media/client-logos/logo1.png')}}" alt="">
                                </div>
                                <div class="kt-widget4__info">
                                    <a href="#" class="kt-widget4__title">
                                        FlyThemes
                                    </a>
                                    <p class="kt-widget4__text">
                                        A Let's Fly Fast Again Language
                                    </p>
                                </div>
                                <span class="kt-widget4__number kt-font-brand">+$200</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Authors Profit-->
            </div>
        </div>

        <!--End::Section-->

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-6">

                <!--begin:: Widgets/Finance Summary-->
                <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
                    <div class="kt-portlet__head kt-portlet__space-x">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Finance Summary
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">Finance</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-graph-1"></i>
                                                <span class="kt-nav__link-text">Statistics</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                                <span class="kt-nav__link-text">Events</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-layers-1"></i>
                                                <span class="kt-nav__link-text">Reports</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">HR</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                                <span class="kt-nav__link-text">Notifications</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-file-1"></i>
                                                <span class="kt-nav__link-text">Files</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fluid">
                        <div class="kt-widget12">
                            <div class="kt-widget12__content kt-portlet__space-x kt-portlet__space-y">
                                <div class="kt-widget12__item">
                                    <div class="kt-widget12__info">
                                        <span class="kt-widget12__desc">Annual Companies Taxes EMS</span>
                                        <span class="kt-widget12__value">$500,000</span>
                                    </div>
                                    <div class="kt-widget12__info">
                                        <span class="kt-widget12__desc">Next Tax Review Date</span>
                                        <span class="kt-widget12__value">July 24,2017</span>
                                    </div>
                                </div>
                                <div class="kt-widget12__item">
                                    <div class="kt-widget12__info">
                                        <span class="kt-widget12__desc">Avarage Product Price</span>
                                        <span class="kt-widget12__value">$60,70</span>
                                    </div>
                                    <div class="kt-widget12__info">
                                        <span class="kt-widget12__desc">Satisfication Rate</span>
                                        <div class="kt-widget12__progress">
                                            <div class="progress kt-progress--sm">
                                                <div class="progress-bar bg-brand" role="progressbar" style="width: 60%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget12__stat">
																	63%
																</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget12__chart" style="height:290px;">
                                <canvas id="kt_chart_finance_summary"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Finance Summary-->
            </div>
            <div class="col-xl-6">

                <!--begin:: Widgets/Order Statistics-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Order Statistics
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
                                Export
                            </a>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">

                                <!--begin::Nav-->
                                <ul class="kt-nav">
                                    <li class="kt-nav__head">
                                        Export Options
                                        <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                    </li>
                                    <li class="kt-nav__separator"></li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-drop"></i>
                                            <span class="kt-nav__link-text">Activity</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                            <span class="kt-nav__link-text">FAQ</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-link"></i>
                                            <span class="kt-nav__link-text">Settings</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                            <span class="kt-nav__link-text">Support</span>
                                            <span class="kt-nav__link-badge">
																	<span class="kt-badge kt-badge--success">5</span>
																</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__separator"></li>
                                    <li class="kt-nav__foot">
                                        <a class="btn btn-label-danger btn-bold btn-sm" href="#">Upgrade plan</a>
                                        <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                    </li>
                                </ul>

                                <!--end::Nav-->
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fluid">
                        <div class="kt-widget12">
                            <div class="kt-widget12__content">
                                <div class="kt-widget12__item">
                                    <div class="kt-widget12__info">
                                        <span class="kt-widget12__desc">Annual Taxes EMS</span>
                                        <span class="kt-widget12__value">$400,000</span>
                                    </div>
                                    <div class="kt-widget12__info">
                                        <span class="kt-widget12__desc">Finance Review Date</span>
                                        <span class="kt-widget12__value">July 24,2019</span>
                                    </div>
                                </div>
                                <div class="kt-widget12__item">
                                    <div class="kt-widget12__info">
                                        <span class="kt-widget12__desc">Avarage Revenue</span>
                                        <span class="kt-widget12__value">$60M</span>
                                    </div>
                                    <div class="kt-widget12__info">
                                        <span class="kt-widget12__desc">Revenue Margin</span>
                                        <div class="kt-widget12__progress">
                                            <div class="progress kt-progress--sm">
                                                <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 40%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget12__stat">
																	40%
																</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget12__chart" style="height:250px;">
                                <canvas id="kt_chart_order_statistics"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Order Statistics-->
            </div>
        </div>

        <!--End::Section-->

        <!--End::Dashboard 7-->
    </div>

    <!-- end:: Content -->
@endsection

