<?php
/**
 * The browse view file of tree module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     tree
 * @version     $Id: browse.html.php 4796 2013-06-06 02:21:59Z zhujinyonging@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>

<?php if($viewType != 'story'):?>
<style>
li.tree-item-story > .tree-actions .tree-action[data-type=sort] {display: none;}
li.tree-item-story > .tree-actions .tree-action[data-type=delete] {display: none;}
</style>
<?php endif;?>
<?php js::set('viewType', $viewType);?>
<?php $this->app->loadLang('doc');?>
<?php $hasBranch = (strpos('story|bug|case', $viewType) !== false and (!empty($root->type) && $root->type != 'normal')) ? true : false;?>
<?php $name = $viewType == 'line' ? $lang->tree->line : (($viewType == 'doc' or $viewType == 'feedback' or $viewType == 'trainskill' or $viewType == 'trainpost') ? $lang->tree->cate : $lang->tree->name);?>
<?php $name = $viewType == 'doc' ? $lang->doc->catalogName : $name;?>
<?php $title = ($viewType == 'line' or $viewType == 'trainskill' or $viewType == 'trainpost') ? '' : ((strpos($viewType, 'doc') !== false) ? $lang->doc->childType : ((strpos($viewType, 'feedback') !== false) ? $lang->tree->subCategory : $lang->tree->child));?>
<!--div id="mainMenu" class="clearfix">
  <div class="btn-toolbar pull-left">
    <?php $backLink = $this->session->{$viewType . 'List'} ? $this->session->{$viewType . 'List'} : 'javascript:history.go(-1)';?>
    <?php echo html::a($backLink, '<i class="icon icon-back icon-sm"></i> ' . $lang->goback, '', 'class="btn btn-secondary"');?>
    <div class="divider"></div>
    <div class="page-title">
      <?php $rootName = $viewType == 'line' or $viewType == 'trainskill' or $viewType == 'trainpost' ? '' : $root->name;?>
      <span class="text" title='<?php echo $rootName;?>'>
        <?php
        if($viewType == 'doc')
        {
            echo $lang->doc->manageType . $lang->colon . $root->name;
        }
        elseif($viewType == 'feedback')
        {
            echo $lang->feedback->manageCate;
        }
        elseif($viewType == 'line')
        {
            echo $lang->tree->manageLine;
        }
        elseif($viewType == 'trainskill')
        {
            echo $lang->tree->manageTrainskill;
        }
        elseif($viewType == 'trainpost')
        {
            echo $lang->tree->manageTrainpost;
        }
        else
        {
            echo $lang->tree->common . $lang->colon . $root->name;
        }
        ?>
      </span>
    </div>
  </div>
</div-->
<div id="mainContent" class="main-row">
  <div class="side-col col-4">
    <div class="panel">
      <div class="panel-heading">
        <div class="panel-title"><?php echo $title;?></div>
      </div>
      <div class="panel-body">
        <ul id='modulesTree' data-name='tree-<?php echo $viewType;?>'></ul>
      </div>
    </div>
  </div>
  <div class="main-col col-8">
    <div class="panel">
      <div class="panel-heading">
        <div class="panel-title">
          <?php $manageChild = 'manage' . ucfirst($viewType) . 'Child';?>
          <?php if(strpos($viewType, 'trainskill') === false and strpos($viewType, 'trainpost') === false) echo strpos($viewType, 'doc') !== false ? $lang->doc->manageType : $lang->tree->$manageChild;?>
        </div>
        <?php if($viewType == 'story' and $allProduct and $canBeChanged):?>
        <div class="panel-actions btn-toolbar"><?php echo html::a('javascript:toggleCopy()', $lang->tree->syncFromProduct, '', "class='btn btn-sm btn-primary'")?></div>
        <?php endif;?>
      </div>
      <div class="panel-body">
        <form id='childrenForm' method='post' target='hiddenwin' action='<?php echo $this->createLink('tree', 'manageChild', "root=$rootID&viewType=$viewType");?>'>
          <table class='table table-form table-auto'>
            <tr>
              <?php if($viewType != 'line' && $viewType != 'trainskill' && $viewType != 'trainpost'):?>
              <td class="text-middle text-right with-padding">
                <?php
                echo "<span>" . html::a($this->createLink('tree', 'browse', "root=$rootID&viewType=$viewType&currentModuleID=0&branch=0&from=$from", '', ''), empty($root->name) ? '' : $root->name, '', "data-app='{$this->app->tab}'") . "<i class='icon icon-angle-right muted'></i></span>";
                foreach($parentModules as $module)
                {
                    echo "<span>" . html::a($this->createLink('tree', 'browse', "root=$rootID&viewType=$viewType&currentModuleID=$module->id&branch=0&from=$from"), $module->name, '', "data-app='{$this->app->tab}'") . " <i class='icon icon-angle-right muted'></i></span>";
                }
                ?>
              </td>
              <?php endif;?>
              <td>
                <div id='sonModule'>
                  <?php if($viewType == 'story' and $allProduct):?>
                  <div class='table-row row-module copy' style='display: none;'>
                    <div class='table-col col-module'><?php echo html::select('allProduct', $allProduct, '', "class='form-control chosen' onchange=\"syncProductOrProject(this,'product')\"");?></div>
                    <div class='table-col col-shorts'><?php echo html::select('productModule', $productModules, '', "class='form-control chosen'");?></div>
                    <div class='table-col col-actions'>
                      <?php echo html::commonButton('', "id='copyModule' onclick='syncModule($currentProduct, \"story\")'", 'btn btn-link btn-icon', 'icon icon-copy');?>
                    </div>
                  </div>
                  <?php endif;?>

                  <?php $maxOrder = 0;?>
                  <?php foreach($sons as $sonModule):?>
                  <?php if($sonModule->order > $maxOrder) $maxOrder = $sonModule->order;?>
                  <?php $disabled = $sonModule->type == $viewType ? '' : 'disabled';?>
                  <div class="table-row row-module">
                    <div class="table-col col-module"><?php echo html::input("modules[id$sonModule->id]", $sonModule->name, 'class="form-control"' . $disabled);?></div>
                    <?php if($hasBranch):?>
                    <div class="table-col col-module"><?php echo html::select("branch[id$sonModule->id]", $branches, $sonModule->branch, 'class="form-control" disabled');?></div>
                    <?php endif;?>
                    <div class="table-col col-shorts"><?php echo html::input("shorts[id$sonModule->id]", $sonModule->short, "class='form-control' placeholder='{$lang->tree->short}' $disabled") . html::hidden("order[id$sonModule->id]", $sonModule->order);?></div>
                    <div class="table-col col-actions"> </div>
                  </div>
                  <?php endforeach;?>
                  <?php for($i = 0; $i < TREE::NEW_CHILD_COUNT ; $i ++):?>
                  <div class="table-row row-module row-module-new">
                    <div class="table-col col-module"><?php echo html::input("modules[]", '', "class='form-control' placeholder='{$name}'");?></div>
                    <?php if($hasBranch):?>
                    <div class="table-col col-module"><?php echo html::select("branch[]", $branches, $branch, 'class="form-control"');?></div>
                    <?php endif;?>
                    <div class="table-col col-shorts"><?php echo html::input("shorts[]", '', "class='form-control' placeholder='{$lang->tree->short}'");?></div>
                    <div class="table-col col-actions">
                      <button type="button" class="btn btn-link btn-icon btn-add" onclick="addItem(this)"><i class="icon icon-plus"></i></button>
                      <button type="button" class="btn btn-link btn-icon btn-delete" onclick="deleteItem(this)"><i class="icon icon-close"></i></button>
                    </div>
                  </div>
                  <?php endfor;?>
                </div>

                <div id="insertItemBox" class="template">
                  <div class="table-row row-module row-module-new">
                    <div class="table-col col-module"><?php echo html::input("modules[]", '', "class='form-control' placeholder='{$name}'");?></div>
                    <?php if($hasBranch):?>
                    <div class="table-col col-module"><?php echo html::select("branch[]", $branches, $branch, 'class="form-control"');?></div>
                    <?php endif;?>
                    <div class="table-col col-shorts"><?php echo html::input("shorts[]", '', "class='form-control' placeholder='{$lang->tree->short}'");?></div>
                    <div class="table-col col-actions">
                      <button type="button" class="btn btn-link btn-icon btn-add" onclick="addItem(this)"><i class="icon icon-plus"></i></button>
                      <button type="button" class="btn btn-link btn-icon btn-delete" onclick="deleteItem(this)"><i class="icon icon-close"></i></button>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <?php if($viewType != 'line' && $viewType != 'trainskill' && $viewType != 'trainpost'):?>
              <td></td>
              <?php endif;?>
              <td colspan="2" class="form-actions">
                <?php if($canBeChanged) echo html::submitButton();?>
                <?php if(!isonlybody()) echo html::backButton();?>
                <?php echo html::hidden('parentModuleID', $currentModuleID);?>
                <?php echo html::hidden('maxOrder', $maxOrder);?>
              </td>
            </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
<?php js::set('tab', $this->app->tab);?>
<script>
$(function()
{
    var data = $.parseJSON('<?php echo helper::jsonEncode4Parse($tree);?>');
    var options =
    {
        initialState: 'preserve',
        data: data,
        sortable:
        {
            lazy: true,
            nested: true,
            canMoveHere: function($ele, $target)
            {
                if($ele && $target && $ele.parent().closest('li').attr('data-id') !== $target.parent().closest('li').attr('data-id')) return false;
            }
        },
        itemCreator: function($li, item)
        {
            var link = (item.id !== undefined && item.type != 'line') ? ('<a href="' + createLink('tree', 'browse', 'rootID=<?php echo $rootID ?>&viewType=<?php echo $viewType ?>&moduleID={0}&branch={1}&from=<?php echo $from;?>'.format(item.id, item.branch)) + '" data-app="' + tab + '">' + item.name + '</a>') : ('<span class="tree-toggle">' + item.name + '</span>');
            var $toggle = $('<span class="module-name" data-id="' + item.id + '">' + link + '</span>');
            if(item.type === 'bug') $toggle.append('&nbsp; <span class="text-muted">[B]</span>');
            if(item.type === 'case') $toggle.append('&nbsp; <span class="text-muted">[C]</span>');
            $li.append($toggle);
            if(item.nodeType || item.type) $li.addClass('tree-item-' + (item.nodeType || item.type));
            $li.toggleClass('active', <?php echo $currentModuleID ?> === item.id);
            return true;
        },
        actions:
        {
            sort:
            {
                title: '<?php echo $lang->tree->dragAndSort ?>',
                template: '<a class="sort-handler"><i class="icon-move"></i></a>'
            },
            edit:
            {
                linkTemplate: '<?php echo helper::createLink('tree', 'edit', "moduleID={0}&type=$viewType"); ?>',
                title: '<?php echo $viewType == 'doc' ? $lang->doc->editType : ($viewType == 'feedback' ? $lang->tree->editCategory : $lang->tree->edit);?>',
                template: '<a><i class="icon-edit"></i></a>'
            },
            "delete":
            {
                linkTemplate: '<?php echo helper::createLink('tree', 'delete', "rootID=$rootID&moduleID={0}"); ?>',
                title: '<?php echo $viewType == 'doc' ? $lang->doc->deleteType : ($viewType == 'feedback' ? $lang->tree->delCategory : $lang->tree->delete)?>',
                template: '<a><i class="icon-trash"></i></a>'
            },
            subModules:
            {
                linkTemplate: '<?php echo helper::createLink('tree', 'browse', "rootID=$rootID&viewType=$viewType&moduleID={0}&branch={1}"); ?>',
                title: '<?php echo $title;?>',
                template: '<a><?php echo $viewType == 'line' ? '' : '<i class="icon-split"></i>';?></a>',
            }
        },
        action: function(event)
        {
            var action = event.action, $target = $(event.target), item = event.item;
            if(action.type === 'edit')
            {
                new $.zui.ModalTrigger({
                    type: 'ajax',
                    url: action.linkTemplate.format(item.id),
                    keyboard: true
                }).show();
            }
            else if(action.type === 'delete')
            {
                hiddenwin.location.href = action.linkTemplate.format(item.id);
            }
            else if(action.type === 'sort')
            {
                var orders = {};
                $('#modulesTree').find('li:not(.tree-action-item)').each(function()
                {
                    var $li = $(this);
                    if($li.hasClass('tree-item-branch')) return;

                    var item = $li.data();
                    orders['orders[' + item.id + ']'] = $li.attr('data-order') || item.order;
                });

                $.post('<?php echo $this->createLink('tree', 'updateOrder', "rootID=$rootID&viewType=$viewType");?>', orders, function(data)
                {
                    $('.main-col').load(location.href + ' .main-col .panel');
                }).error(function()
                {
                    bootbox.alert(lang.timeout);
                });
            }
            else if(action.type === 'subModules')
            {
                window.location.href = action.linkTemplate.format(item.id, item.branch);
            }
        }
    };

    if(<?php echo (common::hasPriv('tree', 'updateorder') and $canBeChanged) ? 'false' : 'true' ?>) options.actions["sort"] = false;
    if(<?php echo (common::hasPriv('tree', 'edit') and $canBeChanged) ? 'false' : 'true' ?>) options.actions["edit"] = false;
    if(<?php echo (common::hasPriv('tree', 'delete') and $canBeChanged) ? 'false' : 'true' ?>) options.actions["delete"] = false;
    if(<?php echo $canBeChanged ? 'false' : 'true' ?>) options.actions["subModules"] = false;

    var $tree = $('#modulesTree').tree(options);

    var tree = $tree.data('zui.tree');
    if(<?php echo $currentModuleID ?>)
    {
        var $currentLi = $tree.find('.module-name[data-id=' + <?php echo $currentModuleID ?> + ']').closest('li');
        if($currentLi.length) tree.show($currentLi);
    }

    $tree.on('mouseenter', 'li:not(.tree-action-item)', function(e)
    {
        $('#modulesTree').find('li.hover').removeClass('hover');
        $(this).addClass('hover');
        e.stopPropagation();
    });

    $('#subNavbar > ul > li > a[href*=tree][href*=browse]').not('[href*=<?php echo $viewType;?>]').parent().removeClass('active');
    if(window.config.viewType == 'line') $('#modulemenu > .nav > li > a[href*=product][href*=all]').parent('li[data-id=all]').addClass('active');
    if(viewType == 'case' || viewType == 'caselib') $('#subNavbar li[data-id="' + viewType +'"]').addClass('active');
});
</script>
<?php
if(strpos($viewType, 'doc') !== false)
{
    include '../../doc/view/footer.html.php';
}
else
{
    include '../../common/view/footer.html.php';
}
?>
