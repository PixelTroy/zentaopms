<?php
/**
 * The html template file of setstoryconcept method of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2020 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Guangming Sun<sunguangming@cnezsoft.com>
 * @package     ZenTaoPMS
 * @version     $Id: browsestoryconcept.html.php 4129 2020-09-01 01:58:14Z sgm $
 */
?>
<?php include '../../common/view/header.html.php';?>
<style>
.table-form>tbody>tr>th{text-align: center}
</style>
<div id='mainMenu' class='clearfix'>
  <div class='pull-right'>
    <?php if(common::hasPriv('custom', 'setstoryconcept')) echo html::a($this->createLink('custom', 'setstoryconcept', '', '', true), $lang->custom->setStoryConcept, '', "class='btn btn-primary iframe' data-width=50%");?>
  </div>
</div>
<div id='mainContent' class='main-row'>
  <div class='main-col main-content main-table'>
      <table class='table table-form'>
        <thead>
          <tr>
            <?php if(common::hasPriv('custom', 'setDefaultConcept')):?>
            <th class='c-default text-center'><?php echo $lang->custom->default;?> </th>
            <?php endif;?>
            <?php if($this->config->URAndSR):?>
            <th class='text-left'><?php echo $lang->custom->URConcept;?> </th>
            <?php endif;?>
            <th class='text-left'><?php echo $lang->custom->SRConcept;?> </th>
            <th class='c-actions-2 text-left'><?php echo $lang->actions;?> </th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($URSRList as $key => $URSR):?>
          <tr>
            <?php if(common::hasPriv('custom', 'setDefaultConcept')):?>
            <td class='text-center'><input type="radio" name='default' value='<?php echo $key;?>' <?php if($key == $config->custom->URSR) echo 'checked';?>></td>
            <?php endif;?>
            <?php if($this->config->URAndSR):?>
            <td class='text-left URBox'><?php echo $URSR['URName'];?></td>
            <?php endif;?>
            <td class='text-left SRBox'><?php echo $URSR['SRName'];?></td>
            <td class='c-actions'>
              <?php $disabled = $key == $config->custom->URSR ? "disabled=disabled" : '';?>
              <?php if(common::hasPriv('custom', 'editStoryConcept'))   echo html::a($this->createLink('custom', 'editStoryConcept', "id=$key", '', true), "<i class='icon icon-edit'></i>", '', "class='btn iframe' data-width=50% title={$lang->edit}");?>
              <?php if(common::hasPriv('custom', 'deleteStoryConcept')) echo html::a($this->createLink('custom', 'deleteStoryConcept', "id=$key"), "<i class='icon icon-trash'></i>", 'hiddenwin', "class='btn' $disabled title={$lang->delete} data-group='admin'");?>
            </td>
          </tr>
        <?php endforeach;?>
        </tbody>
      </table>
  </div>
</div>
<script>
$("input[name='default']").change(function()
{
    var checked = $(this).val();
    hiddenwin.location.href = createLink('custom', 'setDefaultConcept', 'key=' + checked);
})
<?php if(!$this->config->URAndSR):?>
/* Duplicate removal. */
var $SRBox = $('.table-form .SRBox');
$SRBox.each(function(i)
{
    var $this = $(this);
    var name  = $this.html();
    $SRBox.each(function(j)
    {
        if(j <= i) return;
        if(name == $(this).html())
        {
            if($(this).closest('tr').find(':radio').prop('checked'))
            {
                $this.closest('tr').hide();
            }
            else
            {
                $(this).closest('tr').hide();
            }
        }
    })
})
<?php endif;?>
</script>
<?php include '../../common/view/footer.html.php';?>
