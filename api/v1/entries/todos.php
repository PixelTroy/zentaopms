<?php
/**
 * The todos entry point of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2021 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     entries
 * @version     1
 * @link        http://www.zentao.net
 */
class todosEntry extends entry
{
    /**
     * GET method.
     *
     * @access public
     * @return void
     */
    public function get()
    {
        $control = $this->loadController('my', 'todo');
        $control->todo($this->param('date', 'all'), $this->param('user', ''), $this->param('status', 'all'), $this->param('order', 'date_desc'), 0, $this->param('total', 0), $this->param('limit', 20), $this->param('page', 1));
        $data = $this->getData();

        if(!isset($data->status)) return $this->sendError(400, 'error');
        if(isset($data->status) and $data->status == 'fail') return $this->sendError(400, $data->message);

        $pager  = $data->data->pager;
        $result = array();
        foreach($data->data->todos as $todo)
        {
            $result[] = $this->format($todo, 'assignedDate:time,finishedDate:time,closedDate:time');
        }
        return $this->send(200, array('page' => $pager->pageID, 'total' => $pager->recTotal, 'limit' => $pager->recPerPage, 'todos' => $result));
    }

    /**
     * POST method.
     *
     * @access public
     * @return void
     */
    public function post()
    {
        $fields = 'name,desc,begin,end,private';
        $this->batchSetPost($fields);

        $this->setPost('date', $this->request('date', date("Y-m-d")));
        $this->setPost('type', $this->request('type', 'custom'));
        $this->setPost('status', $this->request('status', 'wait'));
        $this->setPost('begin', str_replace(':', '', $this->request('begin')));
        $this->setPost('end', str_replace(':', '', $this->request('end')));
        $this->setPost('pri', $this->request('pri', '3'));

        $control = $this->loadController('todo', 'create');
        $this->requireFields('name');

        $control->create();

        $data = $this->getData();
        if(isset($data->result) and $data->result == 'fail') return $this->sendError(400, $data->message);
        if(isset($data->result) and !isset($data->id)) return $this->sendError(400, $data->message);

        $todo = $this->loadModel('todo')->getByID($data->id);
        
        $this->send(201, $this->format($todo, 'assignedDate:time,finishedDate:time,closedDate:time'));
    }
}
