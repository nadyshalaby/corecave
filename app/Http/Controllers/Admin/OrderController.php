<?php

namespace App\Http\Controllers\Admin;

use App\Libs\Concretes\Controller;
use App\Libs\Concretes\Request;
use App\Libs\Statics\Config;
use App\Models\Order;
use Carbon\Carbon;
use Response;
use function twig;

class OrderController extends Controller {

    public function index() {
        $orders = Order::latest()->get();
        return _twig('admin/pages/orders.html', compact('orders'));
    }

    public function view($id) {
        $order = Order::find($id);
        if ($order) {
            $order->seen = 1;
            $order->save();
            $res = $order->toArray();

            return $res;
        }
        Response::withError(404);
    }

    public function search(Request $r) {
        if ($r->hasParam('q')) {
            $q = $r->getParam('q');
            $cols = (new Order)->getTableColumns();
            $orders = Order::latest();
            $orders->where('id', 'LIKE', "%$q%");
            foreach ($cols as $col) {
                if (in_array($col, ['id', 'created_at', 'updated_at'])) {
                    continue;
                }
                $orders->orWhere($col, 'LIKE', "%$q%");
            }
            $orders = $orders->get()->toArray();
            return $this->_formateOrders($orders);
        }

        $orders = Order::latest()->get()->toArray();
        return $this->_formateOrders($orders);
    }

    public function action($action, Request $r) {
        $state = 0;
        switch ($action) {
            case 'seen':
                $state = 1;
                break;
            case 'unseen':
                $action = 'seen';
                $state = 0;
                break;
            case 'rejected':
                $state = 1;
                break;
            case 'accepted':
                $action = 'rejected';
                $state = 0;
                break;
            case 'deleted':
                $action = 'deleted';
                break;
            default :
                $data = ['status' => 'error', 'msg' => 'This action not supported'];
                return $data;
        }

        if ($r->hasParam('ids')) {
            $ids = $r->getParam('ids');
            foreach ($ids as $id) {
                $this->_action($id, $action, $state);
            }
            $data = ['status' => 'success', 'msg' => 'Your changes have been applied'];
        } else {
            $data = ['status' => 'warning', 'msg' => 'Please mark at least one order'];
        }

        return $data;
    }

    private function _action($id, $action, $state) {
        $order = Order::find($id);
        if ($action === 'deleted') {
            
            $path = Config::extra('uploads.compressed');
            @unlink("$path/{$order->attachment}");
            
            $order->delete();
            return;
        }
        $order->$action = $state;
        $order->save();
    }

    public function filter($filter) {
        $filter = explode("|", $filter);
        $orders = Order::latest();
        $orders = $this->_filter($orders, $filter[0]);
        $orders = $this->_filter($orders, $filter[1])->get()->toArray();
        return $this->_formateOrders($orders);
    }

    private function _formateOrders($orders) {
        foreach (array_keys($orders) as $key) {
            $orders[$key]['created_at'] = (new Carbon($orders[$key]['created_at']))->diffForHumans();
            $orders[$key]['status'] = $this->_getOrderStatus($orders[$key]['seen'], $orders[$key]['rejected']);
            ;
            $orders[$key]['seen'] = $orders[$key]['seen'] ? 'seen' : 'un-seen';
        }

        return $orders;
    }

    private function _getOrderStatus($seen, $rejected) {
        $status = '';
        if ($rejected) {
            $status .='<i class="fa fa-thumbs-down text-danger"></i> ';
        } else {
            $status .='<i class="fa fa-thumbs-up text-success"></i> ';
        }
        if ($seen) {
            $status .='<i class="fa fa-eye text-primary"></i> ';
        } else {
            $status .='<i class="fa fa-eye-slash text-danger"></i> ';
        }
        return $status;
    }

    private function _filter(&$orders, $filter) {
        switch ($filter) {
            case 'all':
                return $orders;
            case 'accepted':
                return $orders->where('rejected', 0);
            case 'rejected':
                return $orders->where('rejected', 1);
            case 'seen':
                return $orders->where('seen', 1);
            case 'unseen':
                return $orders->where('seen', 0);
            case 'today':
                return $orders->where('created_at', '>=', Carbon::today()->toDateString());
            case 'basic-plan':
                return $orders->where('plan', 'Basic Plan');
            case 'pro-plan':
                return $orders->where('plan', 'Pro Plan');
            case 'economic-plan':
                return $orders->where('plan', 'Economic Plan');
            case 'enterprise-plan':
                return $orders->where('plan', 'Enterprise Plan');
        }
    }

}
