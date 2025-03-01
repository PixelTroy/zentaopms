<?php
/**
 * The tutorial lang file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     ZenTaoPMS
 * @version     $Id: zh-cn.php 5116 2013-07-12 06:37:48Z sunhao@cnezsoft.com $
 * @link        http://www.zentao.net
 */
$lang->tutorial = new stdclass();
$lang->tutorial->common           = 'Tutorial';
$lang->tutorial->desc             = 'You can know how to use ZenTao by doing tasks. It takes about 10 minutes, and you can quit anytime.';
$lang->tutorial->start            = "Let's go!";
$lang->tutorial->exit             = 'Quit';
$lang->tutorial->congratulation   = 'Congratulations! You have completed all tasks.';
$lang->tutorial->restart          = 'Restart';
$lang->tutorial->currentTask      = 'Current Task';
$lang->tutorial->allTasks         = 'All Tasks';
$lang->tutorial->previous         = 'Previous';
$lang->tutorial->nextTask         = 'Next';
$lang->tutorial->openTargetPage   = 'Open <strong class="task-page-name">%s</strong>';
$lang->tutorial->atTargetPage     = 'On <strong class="task-page-name">%s</strong>';
$lang->tutorial->reloadTargetPage = 'Reload';
$lang->tutorial->target           = 'Target';
$lang->tutorial->targetPageTip    = 'Open【%s】page by following this instruction.';
$lang->tutorial->targetAppTip     = 'Open <strong class="task-page-name">%s</strong>';
$lang->tutorial->requiredTip      = '【%s】is required.';
$lang->tutorial->congratulateTask = 'Congratulations! You have finished【<span class="task-name-current"></span>】!';
$lang->tutorial->serverErrorTip   = 'Error!';
$lang->tutorial->ajaxSetError     = 'Finished task must be defined. If you want to reset the Task, please set its value as null.';
$lang->tutorial->novice           = "For a quick start, let's go through a two-minute Tutorial.";
$lang->tutorial->dataNotSave      = "Data generated in this Tutorial will not be saved!";

$lang->tutorial->tasks = array();

$lang->tutorial->tasks['createAccount']         = array('title' => 'Create a User');
$lang->tutorial->tasks['createAccount']['nav']  = array('app' => 'admin', 'module' => 'user', 'method' => 'create', 'menuModule' => 'company', 'menu' => 'browseUser', 'form' => '#createForm', 'requiredFields' => 'account,realname,verifyPassword,password1,password2', 'submit' => '#submit', 'target' => '.create-user-btn', 'targetPageName' => 'Add User');
$lang->tutorial->tasks['createAccount']['desc'] = "<p>Create a User: </p><ul><li data-target='nav'>Open <span class='task-nav'>Admin <i class='icon icon-angle-right'></i> Company <i class='icon icon-angle-right'></i> Users<i class='icon icon-angle-right'></i> New;</span></li><li data-target='form'>Fill the form with user information;</li><li data-target='submit'>Save</li></ul>";

$lang->tutorial->tasks['createProgram']         = array('title' => 'Create a program');
$lang->tutorial->tasks['createProgram']['mode'] = 'new';
$lang->tutorial->tasks['createProgram']['nav']  = array('app' => 'program', 'module' => 'program', 'method' => 'create', 'menuModule' => 'program', 'menu' => '#heading>.header-btn:first,#navbar>.nav>li[data-id="browse"],.create-program-btn', 'form' => '#dataform', 'submit' => '#submit', 'target' => '.create-program-btn', 'targetPageName' => 'Create program');
$lang->tutorial->tasks['createProgram']['desc'] = "<p>Create a new program：</p><ul><li data-target='nav'>Open <span class='task-nav'>Program <i class='icon icon-angle-right'></i> Program list <i class='icon icon-angle-right'></i> Create program</span>;</li><li data-target='form'>Fill the form with program information;</li><li data-target='submit'>Save</li></ul>";

$lang->tutorial->tasks['createProduct']         = array('title' => 'Create a ' . $lang->productCommon);
$lang->tutorial->tasks['createProduct']['nav']  = array('app' => 'product', 'module' => 'product', 'method' => 'create', 'menuModule' => 'product', 'menu' => 'all', 'form' => '#createForm', 'submit' => '#submit', 'target' => '.create-product-btn', 'targetPageName' => $lang->productCommon);
$lang->tutorial->tasks['createProduct']['desc'] = "<p>Create a {$lang->productCommon}: </p><ul><li data-target='nav'> Open <span class='task-nav'>{$lang->productCommon} list <i class='icon icon-angle-right'></i> {$lang->productCommon} <i class='icon icon-angle-right'></i> New;</span></li><li data-target='form'>Fill the form with {$lang->productCommon} information;</li><li data-target='submit'>Save</li></ul>";

$lang->tutorial->tasks['createStory']         = array('title' => "Create a {$lang->SRCommon}");
$lang->tutorial->tasks['createStory']['nav']  = array('app' => 'product', 'module' => 'story', 'method' => 'create', 'menuModule' => 'story', 'menu' => '#productTableList>tr:not(.has-nest-child):first>.c-name>a,#heading>.header-btn:first,#navbar>.nav>li[data-id="all"],.create-story-btn', 'target' => '.create-story-btn', 'form' => '#dataform', 'submit' => '#submit', 'targetPageName' => "Create {$lang->SRCommon}");
$lang->tutorial->tasks['createStory']['desc'] = "<p>Create a story: </p><ul><li data-target='nav'>Open <span class='task-nav'>{$lang->productCommon} <i class='icon icon-angle-right'></i>Story <i class='icon icon-angle-right'></i>Create;</span></li><li data-target='form'>Fill the form with story information;</li><li data-target='submit'>Save</li></ul>";

$lang->tutorial->tasks['createProject']         = array('title' => 'Create a ' . $lang->executionCommon);
$lang->tutorial->tasks['createProject']['mode'] = 'new';
$lang->tutorial->tasks['createProject']['nav']  = array('app' => 'project', 'module' => 'project', 'method' => 'create', 'menuModule' => 'browse', 'menu' => '', 'form' => '#dataform', 'submit' => '#submit', 'target' => '.create-project-btn', 'targetPageName' => 'Create Project');
$lang->tutorial->tasks['createProject']['desc'] = "<p>Create a project: </p><ul><li data-target='nav'>Open <span class='task-nav'> Project <i class='icon icon-angle-right'></i> New</span> Page;</li><li data-target='form'>Fill the form with project information;</li><li data-target='submit'>Save</li></ul>";

$lang->tutorial->tasks['manageTeam']         = array('title' => "Manage Project Team");
$lang->tutorial->tasks['manageTeam']['mode'] = 'new';
$lang->tutorial->tasks['manageTeam']['nav']  = array('app' => 'project', 'module' => 'project', 'method' => 'managemembers', 'menuModule' => '', 'menu' => '#navbar>.nav>li[data-id="browse"],#cards>.col>.panel:first .project-name,#projectTableList>tr:first>.c-name a,#navbar>.nav>li[data-id="settings"],#subNavbar>.nav>li[data-id="members"],.manage-team-btn', 'target' => '.manage-team-btn', 'vars' => 'projectID=0', 'form' => '#teamForm', 'requiredFields' => 'accounts1,accounts', 'submit' => '#submit', 'targetPageName' => 'Manage team members');
$lang->tutorial->tasks['manageTeam']['desc'] = "<p>Manage project team members: </p><ul><li data-target='nav'>Open <span class='task-nav'> project <i class='icon icon-angle-right'></i> Team <i class='icon icon-angle-right'></i> Manage Team Members</span> Page；</li><li data-target='form'>Choose users for the team.</li><li data-target='submit'>Save</li></ul>";

$lang->tutorial->tasks['createProjectExecution']         = array('title' => 'Create a ' . $lang->executionCommon);
$lang->tutorial->tasks['createProjectExecution']['mode'] = 'new';
$lang->tutorial->tasks['createProjectExecution']['nav']  = array('app' => 'project', 'module' => 'execution', 'method' => 'create', 'menuModule' => 'browse', 'menu' => '#navbar>.nav>li[data-id="browse"],#cards>.col>.panel:first .project-name,#projectTableList>tr:first>.c-name a,#navbar>.nav>li[data-id="execution"],.create-execution-btn', 'form' => '#dataform', 'submit' => '#submit', 'target' => '.create-execution-btn', 'targetPageName' => 'Create' . $lang->executionCommon);
$lang->tutorial->tasks['createProjectExecution']['desc'] = "<p>Create a new {$lang->executionCommon}：</p><ul><li data-target='nav'>Open <span class='task-nav'> Project <i class='icon icon-angle-right'></i> {$lang->executionCommon} list <i class='icon icon-angle-right'></i> Create {$lang->executionCommon}</span>;</li><li data-target='form'>Fill the form with {$lang->executionCommon} information；</li><li data-target='submit'>Save {$lang->executionCommon}</li></ul>";

$lang->tutorial->tasks['createExecution']         = array('title' => 'Create a ' . $lang->executionCommon);
$lang->tutorial->tasks['createExecution']['mode'] = 'classic';
$lang->tutorial->tasks['createExecution']['nav']  = array('app' => 'execution', 'module' => 'execution', 'method' => 'create', 'menuModule' => 'browse', 'menu' => '#heading>.header-btn:first,#navbar>.nav>li[data-id="all"],.create-execution-btn', 'form' => '#dataform', 'submit' => '#submit', 'target' => '.create-execution-btn', 'targetPageName' => 'Create ' . $lang->executionCommon);
$lang->tutorial->tasks['createExecution']['desc'] = "<p>Create a new {$lang->executionCommon}：</p><ul><li data-target='nav'>Open <span class='task-nav'> Project <i class='icon icon-angle-right'></i> {$lang->executionCommon} list <i class='icon icon-angle-right'></i> Create {$lang->executionCommon}</span>;</li><li data-target='form'>Fill the form with {$lang->executionCommon} information；</li><li data-target='submit'>Save {$lang->executionCommon}</li></ul>";

$lang->tutorial->tasks['manageExecutionTeam']         = array('title' => "Manage Team");
$lang->tutorial->tasks['manageExecutionTeam']['mode'] = 'classic';
$lang->tutorial->tasks['manageExecutionTeam']['nav']  = array('app' => 'execution', 'module' => 'execution', 'method' => 'managemembers', 'menuModule' => '', 'menu' => '#navbar>.nav>li[data-id="browse"],#cards>.col>.panel:first .project-name,#executionTableList>tr:first>.c-name>a,#navbar>.nav>li[data-id="settings"],#subNavbar>.nav>li[data-id="team"],.manage-team-btn', 'target' => '.manage-team-btn', 'form' => '#teamForm', 'requiredFields' => 'account1', 'submit' => '#submit', 'targetPageName' => 'Manage team members');
$lang->tutorial->tasks['manageExecutionTeam']['desc'] = "<p>Manage project team members: </p><ul><li data-target='nav'>Open <span class='task-nav'> Project <i class='icon icon-angle-right'></i> Team <i class='icon icon-angle-right'></i> Manage Team Members</span> Page；</li><li data-target='form'>Choose users for the team.</li><li data-target='submit'>Save</li></ul>";

$lang->tutorial->tasks['linkStory']         = array('title' => 'Link a Story');
$lang->tutorial->tasks['linkStory']['mode'] = 'new';
$lang->tutorial->tasks['linkStory']['nav']  = array('app' => 'execution', 'module' => 'execution', 'method' => 'linkStory', 'menuModule' => 'story', 'menu' => '#heading>.header-btn:first,#navbar>.nav>li[data-id="all"],#navbar>.nav>li[data-id="story"],#executionTableList>tr:first>.c-name>a,.link-story-btn', 'target' => '.link-story-btn', 'form' => '#linkStoryForm', 'formType' => 'table', 'submit' => '#submit', 'targetPageName' => "Link {$lang->SRCommon}");
$lang->tutorial->tasks['linkStory']['desc'] = "<p>Link a Story to execution: </p><ul><li data-target='nav'>Open <span class='task-nav'> Execution <i class='icon icon-angle-right'></i> Story <i class='icon icon-angle-right'></i>Link Story;</span></li><li data-target='form'>Select stories from story list to relate;</li><li data-target='submit'>Save</li></ul>";

$lang->tutorial->tasks['linkExecutionStory']         = array('title' => 'Link a Story');
$lang->tutorial->tasks['linkExecutionStory']['mode'] = 'classic';
$lang->tutorial->tasks['linkExecutionStory']['nav']  = array('app' => 'execution', 'module' => 'execution', 'method' => 'linkStory', 'menuModule' => 'story', 'menu' => '#heading>.header-btn:first,#navbar>.nav>li[data-id="all"],#navbar>.nav>li[data-id="story"],#executionTableList>tr:first>.c-name>a,.link-story-btn', 'target' => '.link-story-btn', 'form' => '#linkStoryForm', 'formType' => 'table', 'submit' => '#submit', 'targetPageName' => "Link {$lang->SRCommon}");
$lang->tutorial->tasks['linkExecutionStory']['desc'] = "<p>Link a Story to {$lang->executionCommon}: </p><ul><li data-target='nav'>Open <span class='task-nav'> {$lang->executionCommon} <i class='icon icon-angle-right'></i> Story <i class='icon icon-angle-right'></i>Link Story;</span></li><li data-target='form'>Select stories from story list to relate;</li><li data-target='submit'>Save</li></ul>";

$lang->tutorial->tasks['createTask']         = array('title' => 'Task Breakdown');
$lang->tutorial->tasks['createTask']['mode'] = 'new';
$lang->tutorial->tasks['createTask']['nav']  = array('app' => 'execution', 'module' => 'task', 'method' => 'create', 'menuModule' => 'story', 'menu' => '', 'target' => '.btn-task-create', 'form' => '#dataform', 'submit' => '#submit', 'targetPageName' => 'Create Task');
$lang->tutorial->tasks['createTask']['desc'] = "<p>Task breakdown for a story: </p><ul><li data-target='nav'>Open <span class='task-nav'> Execution <i class='icon icon-angle-right'></i> Story <i class='icon icon-angle-right'></i> WBS;</span></li><li data-target='form'>Fill the form with task information;</li><li data-target='submit'>Save</li></ul>";

$lang->tutorial->tasks['createExecutionTask']         = array('title' => 'Task Breakdown');
$lang->tutorial->tasks['createExecutionTask']['mode'] = 'classic';
$lang->tutorial->tasks['createExecutionTask']['nav']  = array('app' => 'execution', 'module' => 'task', 'method' => 'create', 'menuModule' => 'story', 'menu' => '', 'target' => '.btn-task-create', 'form' => '#dataform', 'submit' => '#submit', 'targetPageName' => 'Create Task');
$lang->tutorial->tasks['createExecutionTask']['desc'] = "<p>Task breakdown for a story: </p><ul><li data-target='nav'>Open <span class='task-nav'> {$lang->executionCommon} <i class='icon icon-angle-right'></i> Story <i class='icon icon-angle-right'></i> WBS;</span></li><li data-target='form'>Fill the form with task information;</li><li data-target='submit'>Save</li></ul>";

$lang->tutorial->tasks['createBug']         = array('title' => 'Report Bug');
$lang->tutorial->tasks['createBug']['nav']  = array('app' => 'qa', 'module' => 'bug', 'method' => 'create', 'menuModule' => 'bug', 'menu' => 'bug', 'target' => '.create-bug-btn', 'form' => '#dataform', 'submit' => '#submit', 'targetPageName' => 'Report Bug');
$lang->tutorial->tasks['createBug']['desc'] = "<p>Report a Bug: </p><ul><li data-target='nav'>Open <span class='task-nav'> Test <i class='icon icon-angle-right'></i> Bug <i class='icon icon-angle-right'></i> Report Bug</span>；</li><li data-target='form'>Fill the form with bug information:</li><li data-target='submit'>Save</li></ul>";

$lang->tutorial->tasks['createBug']         = array('title' => 'Report Bug');
$lang->tutorial->tasks['createBug']['nav']  = array('module' => 'bug', 'method' => 'create', 'menuModule' => 'qa', 'menu' => 'bug', 'target' => '.btn-bug-create', 'vars' => 'productID=0', 'form' => '#dataform', 'submit' => '#submit', 'targetPageName' => 'Report Bug');
$lang->tutorial->tasks['createBug']['desc'] = "<p>Report a Bug: </p><ul><li data-target='nav'>Open <span class='task-nav'> QA <i class='icon icon-angle-right'></i> Bug <i class='icon icon-angle-right'></i> Report Bug</span>；</li><li data-target='form'>Fill the form with bug information:</li><li data-target='submit'>Save</li></ul>";
