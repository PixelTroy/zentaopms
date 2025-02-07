<?php
/**
 * The browse view file of plan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     plan
 * @version     $Id: browse.html.php 4707 2013-05-02 06:57:41Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php js::set('confirmDelete', $lang->productplan->confirmDelete)?>
<?php js::set('browseType', $browseType);?>
<?php js::set('productID', $productID);?>
<div id="mainMenu" class="clearfix">
  <div class="btn-toolbar pull-left">
    <?php foreach(customModel::getFeatureMenu($this->moduleName, $this->methodName) as $menuItem):?>
    <?php if(isset($menuItem->hidden)) continue;?>
    <?php $label   = "<span class='text'>{$menuItem->text}</span>";?>
    <?php $label  .= $menuItem->name == $browseType ? " <span class='label label-light label-badge'>{$pager->recTotal}</span>" : '';?>
    <?php $active  = $menuItem->name == $browseType ? 'btn-active-text' : '';?>
    <?php echo html::a($this->inlink('browse', "productID=$productID&branch=$branch&browseType={$menuItem->name}"), $label, '', "class='btn btn-link $active' id='{$menuItem->name}'");?>
    <?php endforeach;?>
  </div>
  <div class="btn-toolbar pull-right">
    <?php if(common::canModify('product', $product)):?>
    <?php common::printLink('productplan', 'create', "productID=$product->id&branch=$branch", "<i class='icon icon-plus'></i> {$lang->productplan->create}", '', "class='btn btn-primary'");?>
    <?php endif;?>
  </div>
</div>
<div id="mainContent">
  <?php if(empty($plans)):?>
  <div class="table-empty-tip">
    <p>
      <span class="text-muted"><?php echo $lang->productplan->noPlan;?></span>
      <?php if(common::canModify('product', $product) and common::hasPriv('productplan', 'create') and $browseType != 'overdue'):?>
      <?php echo html::a($this->createLink('productplan', 'create', "productID=$product->id&branch=$branch"), "<i class='icon icon-plus'></i> " . $lang->productplan->create, '', "class='btn btn-info'");?>
      <?php endif;?>
    </p>
  </div>
  <?php else:?>
  <form class='main-table table-productplan' data-ride='table' method='post' id='productplanForm' action='<?php echo inlink('batchEdit', "productID=$product->id&branch=$branch")?>'>
    <table class='table has-sort-head' id="productplanList">
      <thead>
      <?php $vars = "productID=$productID&branch=$branch&browseType=$browseType&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"; ?>
      <tr>
        <th class='c-id'>
          <?php if(common::hasPriv('productplan', 'batchEdit')):?>
          <div class="checkbox-primary check-all" title="<?php echo $lang->selectAll?>">
            <label></label>
          </div>
          <?php endif;?>
          <?php common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?>
        </th>
        <th class='c-title'><?php common::printOrderLink('title', $orderBy, $vars, $lang->productplan->title);?></th>
        <?php if($this->session->currentProductType != 'normal'):?>
        <th class='c-branch'><?php common::printOrderLink('branch',$orderBy, $vars, $lang->productplan->branch);?></th>
        <?php endif;?>
        <th class='c-date'><?php common::printOrderLink('begin', $orderBy, $vars, $lang->productplan->begin);?></th>
        <th class='c-date'><?php common::printOrderLink('end',   $orderBy, $vars, $lang->productplan->end);?></th>
        <th class='c-story'><?php echo $lang->productplan->stories;?></th>
        <th class='c-bug'><?php echo $lang->productplan->bugs;?></th>
        <th class='c-hour'><?php echo $lang->productplan->hour;?></th>
        <th class='c-execution'><?php echo $lang->productplan->execution;?></th>
        <th><?php echo $lang->productplan->desc;?></th>
        <?php
        $extendFields = $this->productplan->getFlowExtendFields();
        foreach($extendFields as $extendField) echo "<th>{$extendField->name}</th>";
        ?>
        <th class='c-actions-6 text-center'><?php echo $lang->actions;?></th>
      </tr>
      </thead>
      <tbody>
      <?php $this->loadModel('file');?>
      <?php foreach($plans as $plan):?>
      <?php
      $canBeChanged = common::canBeChanged('plan', $plan);
      $attribute    = $canBeChanged ? '' : 'disabled';

      $plan = $this->file->replaceImgURL($plan, 'desc');
      if($plan->parent == '-1')
      {
          $parent   = $plan->id;
          $children = isset($plan->children) ? $plan->children : 0;
      }
      if($plan->parent == 0) $parent = 0;
      if(!empty($parent) and $plan->parent > 0 and $plan->parent != $parent) $parent = 0;
      if($plan->parent <= 0) $i = 0;

      $class = '';
      if(!empty($parent) and $plan->parent == $parent)
      {
          $class  = "table-children parent-{$parent}";
          $class .= $i == 0 ? ' table-child-top' : '';
          $class .= ($i + 1 == $children) ? ' table-child-bottom' : '';
          $i++;
      }
      ?>
      <tr class='<?php echo $class;?>'>
        <td class='cell-id'>
          <?php if(common::hasPriv('productplan', 'batchEdit')):?>
          <?php echo html::checkbox('planIDList', array($plan->id => ''), '', $attribute) . html::a(helper::createLink('productplan', 'view', "planID=$plan->id"), sprintf('%03d', $plan->id));?>
          <?php else:?>
          <?php echo sprintf('%03d', $plan->id);?>
          <?php endif;?>
        </td>
        <td class='c-title text-left<?php if($plan->parent == '-1') echo ' has-child';?>' title="<?php echo $plan->title?>">
          <?php
          echo html::a(inlink('view', "id=$plan->id"), $plan->title);
          if($plan->parent == '-1') echo '<a class="task-toggle" data-id="' . $plan->id . '"><i class="icon icon-angle-double-right"></i></a>';
          ?>
        </td>
        <?php if($this->session->currentProductType != 'normal'):?>
        <td class='c-branch' title='<?php echo $branches[$plan->branch];?>'><?php echo $branches[$plan->branch];?></td>
        <?php endif;?>
        <td><?php echo $plan->begin == '2030-01-01' ? $lang->productplan->future : $plan->begin;?></td>
        <td><?php echo $plan->end == '2030-01-01' ? $lang->productplan->future : $plan->end;?></td>
        <td class='text-center'><?php echo $plan->stories;?></td>
        <td class='text-center'><?php echo $plan->bugs;?></td>
        <td class='text-center'><?php echo $plan->hour;?></td>
        <td class='text-center'><?php if(!empty($plan->projectID)) echo html::a(helper::createLink('execution', 'task', 'projectID=' . $plan->projectID), '<i class="icon-search"></i>');?></td>
        <td class='text-left content'>
          <?php $desc = trim(strip_tags(str_replace(array('</p>', '<br />', '<br>', '<br/>'), "\n", str_replace(array("\n", "\r"), '', $plan->desc)), '<img>'));?>
          <div title='<?php echo $desc;?>'><?php echo nl2br($desc);?></div>
        </td>
        <?php foreach($extendFields as $extendField) echo "<td>" . $this->loadModel('flow')->getFieldValue($extendField, $plan) . "</td>";?>
        <td class='c-actions'>
          <?php
          if(common::hasPriv('execution', 'create', $plan))
          {
              $executionLink = $config->systemMode == 'new' ? '#projects' : $this->createLink('execution', 'create', "projectID=0&executionID=0&copyExecutionID=0&plan=$plan->id&confirm=no&productID=$productID");
              if($config->systemMode == 'new')
              {
                  echo html::a($executionLink, '<i class="icon-plus"></i>', '', "data-toggle='modal' data-id='$plan->id' onclick='getPlanID(this)' class='btn' title='{$lang->productplan->createExecution}'");
              }
              else
              {
                  echo html::a($executionLink, '<i class="icon-plus"></i>', '', "class='btn' title='{$lang->productplan->createExecution}'");
              }
          }
          if(common::hasPriv('productplan', 'linkStory', $plan) and $plan->parent >= 0) echo html::a(inlink('view', "planID=$plan->id&type=story&orderBy=id_desc&link=true"), '<i class="icon-link"></i>', '', "class='btn' title='{$lang->productplan->linkStory}'");
          if(common::hasPriv('productplan', 'linkBug', $plan)) echo html::a(inlink('view', "planID=$plan->id&type=bug&orderBy=id_desc&link=true"), '<i class="icon-bug"></i>', '', "class='btn' title='{$lang->productplan->linkBug}'");
          common::printIcon('productplan', 'edit', "planID=$plan->id", $plan, 'list');
          if(common::hasPriv('productplan', 'create', $plan))
          {
              if($plan->parent > '0') echo "<button type='button' class='disabled btn'><i class='disabled icon-split' title='{$this->lang->productplan->children}'></i></button> ";
              if($plan->parent <= '0') echo html::a($this->createLink('productplan', 'create', "product=$productID&branch=$branch&parent={$plan->id}"), "<i class='icon-split'></i>", '', "class='btn' title='{$this->lang->productplan->children}'");
          }

          if(common::hasPriv('productplan', 'delete', $plan))
          {
              $deleteURL = '###';
              $disabled  = 'disabled';
              if($plan->parent >= 0)
              {
                  $deleteURL = $this->createLink('productplan', 'delete', "planID=$plan->id&confirm=no");
                  $disabled  = '';
              }
              echo html::a($deleteURL, '<i class="icon-trash"></i>', 'hiddenwin', "class='btn {$disabled}' title='{$lang->productplan->delete}'");
          }
          ?>
        </td>
      </tr>
      <?php endforeach;?>
      </tbody>
    </table>
    <div class="table-footer">
      <?php if(common::hasPriv('productplan', 'batchEdit')):?>
      <div class="checkbox-primary check-all"><label><?php echo $lang->selectAll?></label></div>
      <div class="table-actions btn-toolbar">
        <?php echo html::submitButton($lang->edit, '', 'btn');?>
      </div>
      <?php endif;?>
      <?php $pager->show('right', 'pagerjs');?>
    </div>
  </form>
  <?php endif;?>
</div>
<div class="modal fade" id="projects">
  <div class="modal-dialog mw-500px">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo $lang->productplan->selectProjects;?></h4>
      </div>
      <div class="modal-body">
        <table class='table table-form'>
          <tr>
            <th><?php echo $lang->productplan->project?></th>
            <td><?php echo html::select('projects', $projects, '', "class='form-control chosen' id=project");?></td>
          </tr>
          <tr>
            <td colspan='2' class='text-center'>
              <?php echo html::hidden('planID', '');?>
              <?php echo html::commonButton($lang->productplan->nextStep, "id='createExecutionButton'", 'btn btn-primary btn-wide');?>
              <?php echo html::commonButton($lang->cancel, "data-dismiss='modal'", 'btn btn-default btn-wide');?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
