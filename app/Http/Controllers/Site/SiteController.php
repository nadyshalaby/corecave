<?php

namespace App\Http\Controllers\Site;

use App\Libs\Concretes\Controller;
use App\Libs\Concretes\Request;
use App\Libs\Statics\Config;
use App\Libs\Statics\Session;
use App\Models\Message;
use App\Models\Order;
use function goBack;
use function twig;

class SiteController extends Controller {

    public function arabic() {
        Session::put('site', 'site.arabic');
        return twig('site/index-ar.html');
    }

    public function english() {
        Session::put('site', 'site.english');
        return twig('site/index-en.html');
    }

    public function contact(Request $r) {
        $msg = new Message;
        $msg->name = $r->getParam('contact-name');
        $msg->from = $r->getParam('contact-email');
        $msg->to = "me";
        $msg->subject = "FeedBack";
        $msg->body = $r->getParam('contact-msg');
        $msg->seen = 0;

        $msg->save();

        goBack()->flash('success', 'Thanks, ' . $r->getParam('contact-name') . ' (^_^)! \n Your message has been recorded');
    }

    public function order(Request $r) {
        $order = new Order;
        $order->firstname = $r->getParam('order-firstname');
        $order->lastname = $r->getParam('order-lastname');
        $order->email = $r->getParam('order-email');
        $order->social_number = $r->getParam('order-social');
        $order->tel = $r->getParam('order-tel');
        $order->mobile = $r->getParam('order-mobile');
        $order->country = $r->getParam('order-country');
        $order->state = $r->getParam('order-state');
        $order->city = $r->getParam('order-city');
        $order->plan = $r->getParam('order-plan');
        $order->address_1 = $r->getParam('order-address_1');
        $order->address_2 = $r->getParam('order-address_2');
        $order->website = $r->getParam('order-site');
        $order->project_name = $r->getParam('order-project');
        $order->description = $r->getParam('order-description');
        $order->seen = 0;
        $order->rejected = 0;

        if ($r->hasFile('order-attachment')) {
            $file = $r->getFile('order-attachment');
            if (!$file->hasExtension(['zip', 'ZIP', 'rar', 'RAR'])) {
                goBack()->flash('warning', 'Please compress your files as ZIP or RAR before uploading, and try again');
                return;
            }
            if (!$file->upload(Config::extra('uploads.compressed'), null, false)) {
                goBack()->flash('error', 'There is an error uploading the file');
                return;
            }
            
            $order->attachment = $file->getLastDisplayName();
        }

        $order->save();
        
        goBack()->flash('success', 'Thanks, ' . $r->getParam('order-firstname') . ' ' . $r->getParam('order-lastname') . ' (^_^)! \n Your order has been submitted');
    }

}
