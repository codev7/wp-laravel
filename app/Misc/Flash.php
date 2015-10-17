<?php

namespace CMV\Misc;

use Illuminate\Session\CommandsServiceProvider;


/*

our own custom flash, fairly straight forward

*/
class Flash
{

    public static function renderTopFlash()
    {
        if (\Session::has('flash_message')) {

            $flashes = \Session::get('flash_message');

            $output = null;
            foreach ($flashes as $flash) {


                if ($flash['location'] == 'top') {

                    $output .= '<div class="alert alert-page pa_page_alerts_dark alert-' . $flash['status'] . '  alert-dark" data-animate="true" style="">';

                    $output .= '<button type="button" data-dismiss="alert" class="close">×</button>';

                    $output .= $flash['message'];

                    $output .= '</div>';
                }

            }

            return $output;

        } else {


            return false;
        }
    }

    public static function killAllFlashes()
    {
        \Session::pull('flash_message');
    }

    public static function renderMainFlash()
    {

        if (\Session::has('flash_message')) {

            $flashes = \Session::get('flash_message');

            $output = null;
            foreach ($flashes as $flash) {


                if ($flash['location'] == 'main') {

                    $output .= '<div style="top: 15px; right: 15px; width: 25%;" class="pos-f alert alert-page pa_page_alerts_dark alert-' . $flash['status'] . '  alert-dark" data-animate="true" style="">';

                    $output .= '<button type="button" data-dismiss="alert" class="close">×</button>';

                    $output .= $flash['message'];

                    $output .= '</div>';
                }

            }

            return $output;

        } else {


            return false;
        }

    }

    public static function success($message, $location = 'main')
    {

        if (\Session::has('flash_message') && $location != 'top')
            $flash = \Session::get('flash_message');
        else
            $flash = [];

        $flash[] = ['status' => 'success', 'message' => $message, 'location' => $location];
        \Session::flash('flash_message', $flash);

    }

    public static function error($message, $location = 'main')
    {
        if (\Session::has('flash_message') && $location != 'top')
            $flash = \Session::get('flash_message');
        else
            $flash = [];

        $flash[] = ['status' => 'danger', 'message' => $message, 'location' => $location];
        \Session::flash('flash_message', $flash);

    }

    public static function warning($message, $location = 'main')
    {
        if (\Session::has('flash_message') && $location != 'top')
            $flash = \Session::get('flash_message');
        else
            $flash = [];

        $flash[] = ['status' => 'warning', 'message' => $message, 'location' => $location];
        \Session::flash('flash_message', $flash);

    }

    public static function primary($message, $location = 'main')
    {
        if (\Session::has('flash_message') && $location != 'top')
            $flash = \Session::get('flash_message');
        else
            $flash = [];

        $flash[] = ['status' => 'primary', 'message' => $message, 'location' => $location];
        \Session::flash('flash_message', $flash);

    }

    public static function message($message, $location = 'main')
    {
        if (\Session::has('flash_message') && $location != 'top')
            $flash = \Session::get('flash_message');
        else
            $flash = [];

        $flash[] = ['status' => 'default', 'message' => $message, 'location' => $location];
        \Session::flash('flash_message', $flash);

    }

    public static function info($message, $location = 'main')
    {
        if (\Session::has('flash_message') && $location != 'top')
            $flash = \Session::get('flash_message');
        else
            $flash = [];

        $flash[] = ['status' => 'info', 'message' => $message, 'location' => $location];
        \Session::flash('flash_message', $flash);

    }
}