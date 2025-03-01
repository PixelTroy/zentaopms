<?php
/**
 * The user entry point of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2021 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     entries
 * @version     1
 * @link        http://www.zentao.net
 */
class userEntry extends Entry
{
    /**
     * GET method.
     *
     * @param  int    $userID
     * @access public
     * @return void
     */
    public function get($userID = 0)
    {
        /* Get my info defaultly. */
        if(!$userID) return $this->getInfo($this->param('fields', ''));

        /* Get user by id. */
        $control = $this->loadController('user', 'profile');
        $control->profile($userID);

        $data = $this->getData();
        $user = $data->data->user;
        unset($user->password);

        $this->send(200, $user);
    }

    /**
     * Get my info.
     *
     * @param string $fields
     *
     * @access private
     * @return void
     */
    private function getInfo($fields = '')
    {
        $info = new stdclass();

        $profile = $this->loadModel('user')->getById($this->app->user->account);
        unset($profile->password);

        $info->profile = $this->format($profile, 'last:time,locked:time,birthday:date,join:date');

        if(!$fields) return $this->send(200, $info);

        /* Set other fields. */
        $fields = explode(',', $fields);

        $this->loadModel('my');
        foreach($fields as $field)
        {
            switch($field)
            {
                case 'product':
                    $info->product = $this->my->getProducts();
                    break;
                case 'project':
                    $info->project = $this->my->getProjects();
                    break;
                case 'doc':
                    $info->doc = $this->my->getDocs();
                    break;
                case 'actions':
                    $info->actions = $this->my->getActions();
                    break;
                case 'task':
                    $info->task = array('count' => 0, 'recentTask' => array());

                    $control = $this->loadController('my', 'task');
                    $control->task($this->param('type', 'assignedTo'), $this->param('order', 'id_desc'), $this->param('total', 0), $this->param('limit', 5), $this->param('page', 1));
                    $data = $this->getData();

                    if($data->status == 'success')
                    {
                        $info->task['count']       = $data->data->pager->recTotal;
                        $info->task['recentTasks'] = $data->data->tasks;
                    }

                    break;
                case 'todo':
                    $info->todo = array('count' => 0, 'recentTodos' => array());

                    $control = $this->loadController('my', 'todo');
                    $control->todo($this->param('date', 'all'), '', 'all', 'date_desc', 0, 0, $this->param('limit', 10), 1);
                    $data = $this->getData();

                    if($data->status == 'success')
                    {
                        $info->todo['count']       = $data->data->pager->recTotal;
                        $info->todo['recentTodos'] = $data->data->todos;
                    }

                    break;
            }
        }

        $this->send(200, $info);
    }

    /**
     * PUT method.
     *
     * @param  int    $userID
     * @access public
     * @return void
     */
    public function put($userID)
    {
        $oldUser = $this->loadModel('user')->getByID($userID, 'id');

        /* Set $_POST variables. */
        $fields = 'account,dept,realname,email,commiter,gender';
        $this->batchSetPost($fields, $oldUser);

        $this->setPost('password1', $this->request('password', ''));
        $this->setPost('password2', $this->request('password', ''));
        $this->setPost('verifyPassword', md5($this->app->user->password . $this->app->session->rand));

        $control = $this->loadController('user', 'edit');
        $control->edit($userID);

        $this->getData();
        $user = $this->user->getByID($userID, 'id');
        unset($user->password);

        $this->send(200, $this->format($user, 'last:time,locked:time'));
    }

    /**
     * DELETE method.
     *
     * @param  int    $userID
     * @access public
     * @return void
     */
    public function delete($userID)
    {
        $this->setPost('verifyPassword', md5($this->app->user->password . $this->app->session->rand));

        $control = $this->loadController('user', 'delete');
        $control->delete($userID);

        $this->getData();
        $this->sendSuccess(200, 'success');
    }
}
