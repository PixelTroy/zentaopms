<?php
/**
 * The html product kanban file of kanban method of product module of ZenTaoPMS.
 *
 * @copyright   Copyright 2021-2021 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@easycorp.ltd>
 * @package     ZenTaoPMS
 * @version     $Id
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kanban.html.php';?>
<?php if(empty($kanbanGroup)):?>
<div class="table-empty-tip cell">
  <p class="text-muted"><?php echo $lang->project->empty;?></p>
</div>
<?php else:?>
<div id='kanbanList'>
  <?php foreach($kanbanGroup as $type => $projectGroup):?>
  <?php if(empty($projectGroup)) continue;?>
  <div class='panel kanban-panel'>
    <div class='panel-heading'>
      <strong><?php echo $lang->project->typeList[$type];?></strong>
    </div>
    <div class='panel-body'>
      <div id='kanban-<?php echo $type;?>' class='kanban'></div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php
$kanbanColumns = array();
$kanbanColumns['waitProject']    = array('name' => $lang->project->waitProjects, 'type' => 'waitProject');
$kanbanColumns['doingProject']   = array('name' => $lang->project->doingProjects, 'type' => 'doingProject');
$kanbanColumns['doingExecution'] = array('name' => $lang->project->doingExecutions, 'type' => 'doingExecution');
$kanbanColumns['closedProject']  = array('name' => $lang->project->closedProjects, 'type' => 'closedProject');
$userPrivs = array();
$userPrivs['project']   = common::hasPriv('project', 'index');
$userPrivs['execution'] = common::hasPriv('execution', 'task');
js::set('kanbanColumns',    $kanbanColumns);
js::set('userPrivs',        $userPrivs);
js::set('kanbanGroup',      $kanbanGroup);
js::set('latestExecutions', $latestExecutions);
js::set('programPairs',     $programPairs);
js::set('doingText',        $lang->project->statusList['doing']);
?>
<?php endif; ?>
<?php include '../../common/view/footer.html.php';?>
