<?php

namespace App\Http\Controllers\Admin;

use App\Libs\Concretes\Controller;
use App\Libs\Concretes\Request;
use App\Models\Message;
use Auth;
use Carbon\Carbon;
use Response;

class MessageController extends Controller {

    public function index() {     
        $msgs = Message::latest()->where('to','me')->orWhere('to',Auth::getUser()->email)->get();
        return twig('admin/pages/messages.html',  compact('msgs'));
    }
    
     public function view($id) {
        $msg = Message::find($id);
        if ($msg) {
            $msg->seen = 1;
            $msg->save();
            $res = $msg->toArray();
            $res['created_at'] = (new Carbon($res['created_at']))->toRfc850String();
            return $res;
        }
        Response::withError(404);
    }

    public function search(Request $r) {
        if ($r->hasParam('q')) {
            $q = $r->getParam('q');
            $cols = (new Message)->getTableColumns();
            $msgs = Message::latest();
            $msgs->where('id', 'LIKE', "%$q%");
            foreach ($cols as $col) {
                if (in_array($col, ['id', 'created_at', 'updated_at'])) {
                    continue;
                }
                $msgs->orWhere($col, 'LIKE', "%$q%");
            }
            $msgs = $msgs->get()->toArray();
            return $this->_formateMessages($msgs);
        }

        $msgs = Message::latest()->get()->toArray();
        return $this->_formateMessages($msgs);
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
            $data = ['status' => 'warning', 'msg' => 'Please mark at least one message'];
        }

        return $data;
    }

    private function _action($id, $action, $state) {
        $msg = Message::find($id);
         if ($action === 'deleted') {
            $msg->delete();
            return;
        }
        $msg->$action = $state;
        $msg->save();
    }

    public function filter($filter) {
        $msgs = Message::latest();
        $msgs = $this->_filter($msgs, $filter)->get()->toArray();
        return $this->_formateMessages($msgs);
    }

    private function _formateMessages($msgs) {
        foreach (array_keys($msgs) as $key) {
            $msgs[$key]['created_at'] = (new Carbon($msgs[$key]['created_at']))->diffForHumans();
            $msgs[$key]['seen'] = $msgs[$key]['seen'] ? 'seen' : 'un-seen';
        }

        return $msgs;
    }

    private function _filter(&$msgs, $filter) {
        switch ($filter) {
            case 'all':
                return $msgs;
            case 'foreign':
                return $msgs->where('to', 'me');
            case 'rejected':
                return $msgs->where('rejected', 1);
            case 'seen':
                return $msgs->where('seen', 1);
            case 'unseen':
                return $msgs->where('seen', 0);
            case 'today':
                return $msgs->where('created_at', '>=', Carbon::today()->toDateString());
        }
    }

}
