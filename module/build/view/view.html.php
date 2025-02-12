<?php
/**
 * The view file of build module's view method of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     build
 * @version     $Id: view.html.php 4386 2013-02-19 07:37:45Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<?php js::set('confirmUnlinkStory', $lang->build->confirmUnlinkStory)?>
<?php js::set('confirmUnlinkBug', $lang->build->confirmUnlinkBug)?>
<?php js::set('flow', $config->global->flow)?>
<?php if(isonlybody()):?>
<style>
#stories .action {display: none;}
#bugs .action {display: none;}
tbody tr td:first-child input {display: none;}
</style>
<?php endif;?>
<div id='mainMenu' class='clearfix'>
  <div class='btn-toolbar pull-left'>
    <?php $browseLink = $this->session->buildList ? $this->session->buildList : $this->createLink('execution', 'build', "executionID=$build->execution");?>
    <?php common::printBack($browseLink, 'btn btn-secondary');?>
    <div class='divider'></div>
    <div class='page-title'>
      <span class='text' title='<?php echo $build->name;?>'>
      <?php echo html::a('javascript:void(0)', "<span class='label label-id'>{$build->id}</span> " . $build->name . " <span class='caret'></span>", '', "data-toggle='dropdown' class='btn btn-link btn-active-text'");?>
      <?php
      echo "<ul class='dropdown-menu'>";
      foreach($buildPairs as $id => $name)
      {
          echo '<li' . ($id == $build->id ? " class='active'" : '') . '>';
          echo html::a($this->createLink('build', 'view', "buildID=$id"), $name);
          echo '</li>';
      }
      echo '</ul>';
      ?>
      </span>
      <?php if($build->deleted):?>
      <span class='label label-danger'><?php echo $lang->build->deleted;?></span>
      <?php endif; ?>
    </div>
  </div>
  <?php if(!isonlybody()):?>
  <div class='btn-toolbar pull-right'>
    <?php
    if(!$build->deleted and $canBeChanged)
    {
        echo $this->buildOperateMenu($build, 'view');

        if(common::hasPriv('build', 'edit'))   echo html::a($this->createLink('build', 'edit',   "buildID=$build->id"), "<i class='icon-common-edit icon-edit'></i> " . $this->lang->edit, '', "class='btn btn-link' title='{$this->lang->edit}' data-app='{$app->tab}'");
        if(common::hasPriv('build', 'delete')) echo html::a($this->createLink('build', 'delete', "buildID=$build->id"), "<i class='icon-common-delete icon-trash'></i> " . $this->lang->delete, '', "class='btn btn-link' title='{$this->lang->delete}' target='hiddenwin' data-app='{$app->tab}'");
    }
    ?>
  </div>
  <?php endif;?>
</div>
<div id='mainContent' class='main-content'>
  <div class='tabs' id='tabsNav'>
  <?php $countStories = count($stories); $countBugs = count($bugs); $countGeneratedBugs = count($generatedBugs);?>
    <ul class='nav nav-tabs'>
      <li <?php if($type == 'story')        echo "class='active'"?>><a href='#stories' data-toggle='tab'><?php echo html::icon($lang->icons['story'], 'text-primary') . ' ' . $lang->build->stories;?></a></li>
      <li <?php if($type == 'bug')          echo "class='active'"?>><a href='#bugs' data-toggle='tab'><?php echo html::icon($lang->icons['bug'], 'text-green') . ' ' . $lang->build->bugs;?></a></li>
      <li <?php if($type == 'generatedBug') echo "class='active'"?>><a href='#generatedBugs' data-toggle='tab'><?php echo html::icon($lang->icons['bug'], 'text-red') . ' ' . $lang->build->generatedBugs;?></a></li>
      <li <?php if($type == 'buildInfo')    echo "class='active'"?>><a href='#buildInfo' data-toggle='tab'><?php echo html::icon($lang->icons['plan'], 'text-info') . ' ' . $lang->build->view;?></a></li>
    </ul>
    <div class='tab-content'>
      <div class='tab-pane <?php if($type == 'story') echo 'active'?>' id='stories'>
        <?php if($canBeChanged and common::hasPriv('build', 'linkStory')):?>
        <div class='actions'><?php echo html::a("javascript:showLink($build->id, \"story\")", '<i class="icon-link"></i> ' . $lang->build->linkStory, '', "class='btn btn-primary'");?></div>
        <div class='linkBox cell hidden'></div>
        <?php endif;?>
        <form class='main-table table-story' data-ride='table' method='post' target='hiddenwin' action='<?php echo inlink('batchUnlinkStory', "buildID={$build->id}")?>' id='linkedStoriesForm'>
          <table class='table has-sort-head' id='storyList'>
            <?php $canBatchUnlink = ($canBeChanged and common::hasPriv('build', 'batchUnlinkStory'));?>
            <?php $vars = "buildID={$build->id}&type=story&link=$link&param=$param&orderBy=%s";?>
            <thead>
              <tr class='text-center'>
                <th class='c-id text-left'>
                  <?php if($canBatchUnlink):?>
                  <div class="checkbox-primary check-all" title="<?php echo $lang->selectAll?>">
                    <label></label>
                  </div>
                  <?php endif;?>
                  <?php common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?>
                </th>
                <th class='c-id'><?php common::printOrderLink('pri', $orderBy, $vars, $lang->priAB);?></th>
                <th class='text-left'><?php common::printOrderLink('title', $orderBy, $vars, $lang->story->title);?></th>
                <th class='c-user'><?php common::printOrderLink('openedBy', $orderBy, $vars, $lang->openedByAB);?></th>
                <th class='c-id text-right'><?php common::printOrderLink('estimate', $orderBy, $vars, $lang->story->estimateAB);?></th>
                <th class='c-status'><?php common::printOrderLink('status', $orderBy, $vars, $lang->statusAB);?></th>
                <th class='c-status'><?php common::printOrderLink('stage', $orderBy, $vars, $lang->story->stageAB);?></th>
                <th class='c-actions-1'><?php echo $lang->actions?></th>
              </tr>
            </thead>
            <tbody class='text-center'>
              <?php $objectID = $this->app->tab == 'execution' ? $build->execution : $build->project;?>
              <?php foreach($stories as $storyID => $story):?>
              <?php $storyLink = $this->createLink('story', 'view', "storyID=$story->id&version=0&param=$objectID", '', true);?>
              <tr>
                <td class='c-id text-left'>
                  <?php if($canBatchUnlink):?>
                  <?php echo html::checkbox('unlinkStories', array($story->id => sprintf('%03d', $story->id)));?>
                  <?php else:?>
                  <?php printf('%03d', $story->id);?>
                  <?php endif;?>
                </td>
                <td><span class='label-pri label-pri-<?php echo $story->pri;?>' title='<?php echo zget($lang->story->priList, $story->pri, $story->pri);?>'><?php echo zget($lang->story->priList, $story->pri, $story->pri);?></span></td>
                <td class='text-left nobr' title='<?php echo $story->title?>'>
                  <?php
                  if($story->parent > 0) echo "<span class='label'>{$lang->story->childrenAB}</span>";
                  echo html::a($storyLink,$story->title, '', isonlybody() ? "data-width='1000'" : "class='iframe' data-width='1000'");
                  ?>
                </td>
                <td><?php echo zget($users, $story->openedBy);?></td>
                <td class='text-right' title="<?php echo $story->estimate . ' ' . $lang->hourCommon;?>"><?php echo $story->estimate . $config->hourUnit;?></td>
                <td>
                  <span class='status-story status-<?php echo $story->status;?>'>
                    <?php echo $this->processStatus('story', $story);?>
                  </span>
                </td>
                <td><?php echo $lang->story->stageList[$story->stage];?></td>
                <td class='c-actions'>
                  <?php
                  if($canBeChanged and common::hasPriv('build', 'unlinkStory'))
                  {
                      $unlinkURL = inlink('unlinkStory', "buildID=$build->id&story=$story->id");
                      echo html::a("###", '<i class="icon-unlink"></i>', '', "onclick='ajaxDelete(\"$unlinkURL\", \"storyList\", confirmUnlinkStory)' class='btn' title='{$lang->build->unlinkStory}'");
                  }
                  ?>
                </td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
          <div class='table-footer'>
            <?php if($countStories):?>
            <?php if($canBatchUnlink):?>
            <div class="checkbox-primary check-all"><label><?php echo $lang->selectAll?></label></div>
            <div class="table-actions btn-toolbar">
              <?php echo html::submitButton($lang->build->batchUnlink, '', 'btn');?>
            </div>
            <?php endif;?>
            <div class='table-statistic'><?php echo sprintf($lang->build->finishStories, $countStories);?></div>
            <?php endif;?>
            <?php
            $this->app->rawParams['type'] = 'story';
            $storyPager->show('right', 'pagerjs');
            $this->app->rawParams['type'] = $type;
            ?>
          </div>
        </form>
      </div>
      <div class='tab-pane <?php if($type == 'bug') echo 'active'?>' id='bugs'>
        <?php if($canBeChanged and common::hasPriv('build', 'linkBug')):?>
        <div class='actions'><?php echo html::a("javascript:showLink($build->id, \"bug\")", '<i class="icon-bug"></i> ' . $lang->build->linkBug, '', "class='btn btn-primary'");?></div>
        <div class='linkBox cell hidden'></div>
        <?php endif;?>
        <form class='main-table table-bug' data-ride='table' method='post' target='hiddenwin' action="<?php echo inLink('batchUnlinkBug', "build=$build->id");?>" id='linkedBugsForm'>
          <table class='table has-sort-head' id='bugList'>
            <?php $canBatchUnlink = $canBeChanged and common::hasPriv('build', 'batchUnlinkBug');?>
            <?php $vars = "buildID={$build->id}&type=bug&link=$link&param=$param&orderBy=%s";?>
            <thead>
              <tr class='text-center'>
                <th class='c-id text-left'>
                  <?php if($canBatchUnlink):?>
                  <div class="checkbox-primary check-all" title="<?php echo $lang->selectAll?>">
                    <label></label>
                  </div>
                  <?php endif;?>
                  <?php common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?>
                </th>
                <th class='text-left'>  <?php common::printOrderLink('title',        $orderBy, $vars, $lang->bug->title);?></th>
                <th class='c-status'>   <?php common::printOrderLink('status',       $orderBy, $vars, $lang->bug->status);?></th>
                <th class='c-user'>     <?php common::printOrderLink('openedBy',     $orderBy, $vars, $lang->openedByAB);?></th>
                <th class='c-date'>     <?php common::printOrderLink('openedDate',   $orderBy, $vars, $lang->bug->openedDateAB);?></th>
                <th class='c-user'>     <?php common::printOrderLink('resolvedBy',   $orderBy, $vars, $lang->bug->resolvedByAB);?></th>
                <th class='c-date'>     <?php common::printOrderLink('resolvedDate', $orderBy, $vars, $lang->bug->resolvedDateAB);?></th>
                <th class='c-actions-1'><?php echo $lang->actions?></th>
              </tr>
            </thead>
            <tbody class='text-center'>
              <?php foreach($bugs as $bug):?>
              <?php $bugLink = $this->createLink('bug', 'view', "bugID=$bug->id", '', true);?>
              <tr>
                <td class='c-id text-left'>
                  <?php if($canBatchUnlink):?>
                  <?php echo html::checkbox('unlinkBugs', array($bug->id => sprintf('%03d', $bug->id)));?>
                  <?php else:?>
                  <?php printf('%03d', $bug->id);?>
                  <?php endif;?>
                <td class='text-left nobr' title='<?php echo $bug->title?>'>
                    <?php echo html::a($bugLink, $bug->title, '', isonlybody() ? "data-width='1000'" : "class='iframe' data-width='1000'");?>
                </td>
                <td>
                  <span class='status-bug status-<?php echo $bug->status?>'>
                    <?php echo $this->processStatus('bug', $bug);?>
                  </span>
                </td>
                <td><?php echo zget($users, $bug->openedBy);?></td>
                <td><?php echo substr($bug->openedDate, 5, 11)?></td>
                <td><?php echo zget($users, $bug->resolvedBy);?></td>
                <td><?php echo substr($bug->resolvedDate, 5, 11)?></td>
                <td class='c-actions'>
                  <?php
                  if($canBeChanged and common::hasPriv('build', 'unlinkBug'))
                  {
                      $unlinkURL = inlink('unlinkBug', "buildID=$build->id&bug=$bug->id");
                      echo html::a("###", '<i class="icon-unlink"></i>', '', "onclick='ajaxDelete(\"$unlinkURL\", \"bugList\", confirmUnlinkBug)' class='btn' title='{$lang->build->unlinkBug}'");
                  }
                  ?>
                </td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
          <div class='table-footer'>
            <?php if($countBugs):?>
            <?php if($canBatchUnlink):?>
            <div class="checkbox-primary check-all"><label><?php echo $lang->selectAll?></label></div>
            <div class="table-actions btn-toolbar">
              <?php echo html::submitButton($lang->build->batchUnlink, '', 'btn');?>
            </div>
            <?php endif;?>
            <div class='table-statistic'><?php echo sprintf($lang->build->resolvedBugs, $countBugs);?></div>
            <?php endif;?>
            <?php
            $this->app->rawParams['type'] = 'bug';
            $bugPager->show('right', 'pagerjs');
            $this->app->rawParams['type'] = $type;
            ?>
          </div>
        </form>
      </div>
      <div class='tab-pane <?php if($type == 'generatedBug') echo 'active'?>' id='generatedBugs'>
        <div class='main-table' data-ride='table'>
          <table class='table has-sort-head'>
            <?php $vars = "buildID={$build->id}&type=generatedBug&link=$link&param=$param&orderBy=%s";?>
            <thead>
              <tr class='text-center'>
                <th class='c-id text-left'><?php common::printOrderLink('id',       $orderBy, $vars, $lang->idAB);?></th>
                <th class='c-status'> <?php common::printOrderLink('severity',     $orderBy, $vars, $lang->bug->severityAB);?></th>
                <th class='text-left'><?php common::printOrderLink('title',        $orderBy, $vars, $lang->bug->title);?></th>
                <th class='c-status'> <?php common::printOrderLink('status',       $orderBy, $vars, $lang->bug->status);?></th>
                <th class='c-user'>   <?php common::printOrderLink('openedBy',     $orderBy, $vars, $lang->openedByAB);?></th>
                <th class='c-date'>   <?php common::printOrderLink('openedDate',   $orderBy, $vars, $lang->bug->openedDateAB);?></th>
                <th class='c-user'>   <?php common::printOrderLink('resolvedBy',   $orderBy, $vars, $lang->bug->resolvedByAB);?></th>
                <th class='c-date'>   <?php common::printOrderLink('resolvedDate', $orderBy, $vars, $lang->bug->resolvedDateAB);?></th>
              </tr>
            </thead>
            <?php
            $hasCustomSeverity = false;
            foreach($lang->bug->severityList as $severityKey => $severityValue)
            {
                if(!empty($severityKey) and (string)$severityKey != (string)$severityValue)
                {
                    $hasCustomSeverity = true;
                    break;
                }
            }
            ?>
            <tbody class='text-center'>
              <?php foreach($generatedBugs as $bug):?>
              <?php $bugLink = $this->createLink('bug', 'view', "bugID=$bug->id", '', true);?>
              <tr>
                <td class='text-left'><?php printf('%03d', $bug->id);?></td>
                <td>
                  <?php if($hasCustomSeverity):?>
                  <span class='label-severity-custom' data-severity='<?php echo $bug->severity;?>' title='<?php echo zget($lang->bug->severityList, $bug->severity);?>'><?php echo zget($lang->bug->severityList, $bug->severity, $bug->severity);?></span>
                  <?php else:?>
                  <span class='label-severity' data-severity='<?php echo $bug->severity;?>' title='<?php echo zget($lang->bug->severityList, $bug->severity, $bug->severity);?>'></span>
                  <?php endif;?>
                </td>
                <td class='text-left nobr' title='<?php echo $bug->title?>'>
                    <?php echo html::a($bugLink, $bug->title, '', isonlybody() ? "data-width='1000'" : "class='iframe' data-width='1000'");?>
                </td>
                <td>
                  <span class='status-bug status-<?php echo $bug->status?>'>
                    <?php echo $this->processStatus('bug', $bug);?>
                  </span>
                </td>
                <td><?php echo zget($users, $bug->openedBy);?></td>
                <td><?php echo substr($bug->openedDate, 5, 11)?></td>
                <td><?php echo zget($users, $bug->resolvedBy);?></td>
                <td><?php echo substr($bug->resolvedDate, 5, 11)?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
          <div class='table-footer'>
            <?php if($countGeneratedBugs):?>
            <div class='table-statistic'><?php echo sprintf($lang->build->createdBugs, $countGeneratedBugs);?></div>
            <?php endif;?>
            <?php
            $this->app->rawParams['type'] = 'generatedBug';
            $generatedBugPager->show('right', 'pagerjs');
            $this->app->rawParams['type'] = $type;
            ?>
          </div>
        </div>
      </div>
      <div class='tab-pane <?php if($type == 'buildInfo') echo 'active'?>' id='buildInfo'>
        <div class='cell'>
          <div class='detail'>
            <div class='detail-title'><?php echo $lang->build->basicInfo?></div>
            <div class='detail-content'>
              <table class='table table-data table-condensed table-borderless table-fixed'>
                <tr>
                  <th><?php echo $lang->build->product;?></th>
                  <td><?php echo $build->productName;?></td>
                </tr>
                <?php if($build->productType != 'normal'):?>
                <tr>
                  <th><?php echo $lang->product->branch;?></th>
                  <td><?php echo $branchName;?></td>
                </tr>
                <?php endif;?>
                <tr>
                  <th><?php echo $lang->build->name;?></th>
                  <td><?php echo $build->name;?></td>
                </tr>
                <tr>
                  <th><?php echo $lang->build->builder;?></th>
                  <td><?php echo zget($users, $build->builder);?></td>
                </tr>
                <tr>
                  <th><?php echo $lang->build->date;?></th>
                  <td><?php echo $build->date;?></td>
                </tr>
                <tr>
                  <th><?php echo $lang->build->scmPath;?></th>
                  <td style='word-break:break-all;'><?php echo html::a($build->scmPath, $build->scmPath, '_blank')?></td>
                </tr>
                <tr>
                  <th><?php echo $lang->build->filePath;?></th>
                  <td style='word-break:break-all;'><?php echo html::a($build->filePath, $build->filePath, '_blank');?></td>
                </tr>
                <?php $this->printExtendFields($build, 'table', 'inForm=0');?>
                <tr>
                  <th style="vertical-align:top"><?php echo $lang->build->desc;?></th>
                  <td>
                    <?php if($build->desc):?>
                    <?php echo $build->desc;?>
                    <?php else:?>
                    <?php echo $lang->noData;?>
                    <?php endif;?>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <?php echo $this->fetch('file', 'printFiles', array('files' => $build->files, 'fieldset' => 'true'));?>
          <?php include '../../common/view/action.html.php';?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php js::set('param', helper::safe64Decode($param))?>
<?php js::set('link', $link)?>
<?php js::set('buildID', $build->id)?>
<?php js::set('type', $type)?>
<?php include '../../common/view/footer.html.php';?>
