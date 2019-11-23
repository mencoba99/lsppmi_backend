<?php


namespace App\Http\Helpers;

use App\Models\MemberCertificationAPL02;
use Route;

/**
 * Class GeneralHelper
 * Untuk Helper yang bisa digunakan baik di view maupun controller
 *
 * @package App\Http\Helpers
 */
class GeneralHelper
{
    /**
     * Method getBreadcrumb
     * Untuk generate breadcrumb di setiap halaman yang diambil dari Route dan nama Class dan Action
     *
     * @return array String
     */
    public static function getBreadcrumb()
    {
        $currentRoute = Route::current();
        $action       = $currentRoute->action;
        $breadcrumb   = '<!-- begin:: Subheader -->
                            <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                                <div class="kt-subheader__main">';

        if ($action['prefix']) {
            $actionArr = explode('/', $action['prefix']);
            if (count($actionArr) > 0) {
                $text_1     = str_replace('-', ' ', $actionArr[0]);
                $text_1     = ucwords($text_1);
                $breadcrumb .= '<h3 class="kt-subheader__title">' . $text_1 . '</h3>';
                $subtext    = Route::currentRouteName();
                if ($subtext) {
                    $breadcrumb .= '<span class="kt-subheader__separator kt-hidden"></span>
                                    <div class="kt-subheader__breadcrumbs">
                                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>';
                    $subtextArr = explode('.', $subtext);
                    foreach ($subtextArr as $item) {
                        $subtext_1  = str_replace('-', ' ', $item);
                        $subtext_1  = ucwords($subtext_1);
                        $breadcrumb .= '<span class="kt-subheader__breadcrumbs-separator"></span>
                                        <a href="" class="kt-subheader__breadcrumbs-link">' . $subtext_1 . ' </a>';
                    }
                    $breadcrumb .= '</div>
                                </div>';
                }
            }
        } else {
            $breadcrumb .= '<h3 class="kt-subheader__title">Dashboard</h3>
                                </div>';
        }

        $breadcrumb .= '<div class="kt-subheader__toolbar">
                            <div class="kt-subheader__wrapper">
                                <a href="#" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker" data-toggle="kt-tooltip" title="Tanggal hari ini" data-placement="left">
                                    <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Hari ini </span>&nbsp;&nbsp;
                                    <span class="kt-subheader__btn-daterange-date" id="kt_dashboard_daterangepicker_date">' . date('D, d F') . '</span>
                
                                    <!--<i class="flaticon2-calendar-1"></i>-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24" />
                                            <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" id="check" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" id="Combined-Shape" fill="#000000" />
                                        </g>
                                    </svg> </a>
                            </div>
                        </div>
                    </div>
                    <!-- end:: Subheader -->';
        return $breadcrumb;
    }

    /**
     * Helper untuk Page Title dengan mengambil dari Route Prefix dan route name
     *
     * @param string $title
     * @return string
     */
    public static function getPageTitle($title = '')
    {
        $prefix    = Route::current()->action['prefix'];
        $actionArr = explode('/', $prefix);
        if (count($actionArr) > 0) {
            $text_1 = str_replace('-', ' ', $actionArr[0]);
            $text_1 = ucwords($text_1);
            $title  .= $text_1;
        }

        $title      .= ' - ';
        $subtext    = Route::currentRouteName();
        $subtextArr = explode('.', $subtext);
        foreach ($subtextArr as $item) {
            $subtext_1 = str_replace('-', ' ', $item);
            $subtext_1 = ucwords($subtext_1);
            $title     .= $subtext_1 . " ";
        }

        if (!empty($title))
            return $title;
        else
            return 'Dashboard';
    }

    /**
     * Helper untuk cek Kompeten atau tidak KUK pada form APL02
     *
     * @param $memberCertificationId
     * @param $competenceKukId
     * @return bool
     */
    public static function getCompetentStatusAPL02($memberCertificationId, $competenceKukId)
    {
        $cek = MemberCertificationAPL02::where('member_certification_id', $memberCertificationId)->where('competence_kuk_id', $competenceKukId)->first();
        if ($cek && $cek->count() > 0) {
            if ($cek->is_competent) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $proof
     * @return array|bool
     */
    public static function getAPL01File($proof)
    {
        $trimProof = str_replace(['{','}'],'',$proof);

        $arrProof = explode(',',$trimProof);
        if ($arrProof && count($arrProof) > 0) {
            return $arrProof;
        } else {
            return false;
        }
    }
}
