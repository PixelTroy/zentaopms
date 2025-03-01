<?php
$config->task = new stdclass();
$config->task->batchCreate = 10;

$config->task->create   = new stdclass();
$config->task->edit     = new stdclass();
$config->task->start    = new stdclass();
$config->task->finish   = new stdclass();
$config->task->activate = new stdclass();

$config->task->create->requiredFields      = 'execution,name,type';
$config->task->edit->requiredFields        = $config->task->create->requiredFields;
$config->task->finish->requiredFields      = 'realStarted,finishedDate,currentConsumed';
$config->task->activate->requiredFields    = 'left';

$config->task->editor = new stdclass();
$config->task->editor->create   = array('id' => 'desc', 'tools' => 'simpleTools');
$config->task->editor->edit     = array('id' => 'desc,comment', 'tools' => 'simpleTools');
$config->task->editor->view     = array('id' => 'comment,lastComment', 'tools' => 'simpleTools');
$config->task->editor->assignto = array('id' => 'comment', 'tools' => 'simpleTools');
$config->task->editor->start    = array('id' => 'comment', 'tools' => 'simpleTools');
$config->task->editor->restart  = array('id' => 'comment', 'tools' => 'simpleTools');
$config->task->editor->finish   = array('id' => 'comment', 'tools' => 'simpleTools');
$config->task->editor->close    = array('id' => 'comment', 'tools' => 'simpleTools');
$config->task->editor->activate = array('id' => 'comment', 'tools' => 'simpleTools');
$config->task->editor->cancel   = array('id' => 'comment', 'tools' => 'simpleTools');
$config->task->editor->pause    = array('id' => 'comment', 'tools' => 'simpleTools');

$config->task->removeFields = 'objectTypeList,productList,executionList,gitlabID,gitlabProjectID,product';
$config->task->exportFields = '
    id, execution, module, story,
    name, desc,
    type, pri,estStarted, realStarted, deadline, status,estimate, consumed, left,
    mailto, progress,
    openedBy, openedDate, assignedTo, assignedDate,
    finishedBy, finishedDate, canceledBy, canceledDate,
    closedBy, closedDate, closedReason,
    lastEditedBy, lastEditedDate,files
    ';

$config->task->customCreateFields      = 'story,estStarted,deadline,mailto,pri,estimate';
$config->task->customBatchCreateFields = 'module,story,assignedTo,estimate,estStarted,deadline,desc,pri';
$config->task->customBatchEditFields   = 'module,assignedTo,status,pri,estimate,record,left,estStarted,deadline,finishedBy,canceledBy,closedBy,closedReason';

$config->task->custom = new stdclass();
$config->task->custom->createFields      = $config->task->customCreateFields;
$config->task->custom->batchCreateFields = 'module,story,assignedTo,estimate,desc,pri';
$config->task->custom->batchEditFields   = 'module,assignedTo,status,pri,estimate,record,left';

$config->task->datatable = new stdclass();
$config->task->datatable->defaultField = array('id', 'pri', 'name', 'status', 'assignedTo', 'finishedBy', 'estimate', 'consumed', 'left', 'progress', 'deadline', 'actions');

global $lang;
$config->task->datatable->fieldList['id']['title']    = 'idAB';
$config->task->datatable->fieldList['id']['fixed']    = 'left';
$config->task->datatable->fieldList['id']['width']    = '70';
$config->task->datatable->fieldList['id']['required'] = 'yes';

$config->task->datatable->fieldList['pri']['title']    = 'priAB';
$config->task->datatable->fieldList['pri']['fixed']    = 'left';
$config->task->datatable->fieldList['pri']['width']    = '50';
$config->task->datatable->fieldList['pri']['required'] = 'no';

$config->task->datatable->fieldList['name']['title']    = 'name';
$config->task->datatable->fieldList['name']['fixed']    = 'left';
$config->task->datatable->fieldList['name']['width']    = 'auto';
$config->task->datatable->fieldList['name']['required'] = 'yes';

$config->task->datatable->fieldList['type']['title']    = 'typeAB';
$config->task->datatable->fieldList['type']['fixed']    = 'no';
$config->task->datatable->fieldList['type']['width']    = '80';
$config->task->datatable->fieldList['type']['required'] = 'no';

$config->task->datatable->fieldList['status']['title']    = 'statusAB';
$config->task->datatable->fieldList['status']['fixed']    = 'no';
$config->task->datatable->fieldList['status']['width']    = '60';
$config->task->datatable->fieldList['status']['required'] = 'no';

$config->task->datatable->fieldList['estimate']['title']    = 'estimateAB';
$config->task->datatable->fieldList['estimate']['fixed']    = 'right';
$config->task->datatable->fieldList['estimate']['width']    = '60';
$config->task->datatable->fieldList['estimate']['required'] = 'no';

$config->task->datatable->fieldList['consumed']['title']    = 'consumedAB';
$config->task->datatable->fieldList['consumed']['fixed']    = 'no';
$config->task->datatable->fieldList['consumed']['width']    = '60';
$config->task->datatable->fieldList['consumed']['required'] = 'no';

$config->task->datatable->fieldList['left']['title']    = 'leftAB';
$config->task->datatable->fieldList['left']['fixed']    = 'no';
$config->task->datatable->fieldList['left']['width']    = '60';
$config->task->datatable->fieldList['left']['required'] = 'no';

$config->task->datatable->fieldList['progress']['title']    = 'progressAB';
$config->task->datatable->fieldList['progress']['fixed']    = 'no';
$config->task->datatable->fieldList['progress']['width']    = '50';
$config->task->datatable->fieldList['progress']['required'] = 'no';
$config->task->datatable->fieldList['progress']['sort']     = 'no';
$config->task->datatable->fieldList['progress']['name']     = $lang->task->progress;

$config->task->datatable->fieldList['deadline']['title']    = 'deadlineAB';
$config->task->datatable->fieldList['deadline']['fixed']    = 'no';
$config->task->datatable->fieldList['deadline']['width']    = '60';
$config->task->datatable->fieldList['deadline']['required'] = 'no';

$config->task->datatable->fieldList['openedBy']['title']    = 'openedByAB';
$config->task->datatable->fieldList['openedBy']['fixed']    = 'no';
$config->task->datatable->fieldList['openedBy']['width']    = '90';
$config->task->datatable->fieldList['openedBy']['required'] = 'no';

$config->task->datatable->fieldList['openedDate']['title']    = 'openedDate';
$config->task->datatable->fieldList['openedDate']['fixed']    = 'no';
$config->task->datatable->fieldList['openedDate']['width']    = '110';
$config->task->datatable->fieldList['openedDate']['required'] = 'no';

$config->task->datatable->fieldList['estStarted']['title']    = 'estStarted';
$config->task->datatable->fieldList['estStarted']['fixed']    = 'no';
$config->task->datatable->fieldList['estStarted']['width']    = '90';
$config->task->datatable->fieldList['estStarted']['required'] = 'no';

$config->task->datatable->fieldList['realStarted']['title']    = 'realStarted';
$config->task->datatable->fieldList['realStarted']['fixed']    = 'no';
$config->task->datatable->fieldList['realStarted']['width']    = '95';
$config->task->datatable->fieldList['realStarted']['required'] = 'no';

$config->task->datatable->fieldList['assignedTo']['title']    = 'assignedTo';
$config->task->datatable->fieldList['assignedTo']['fixed']    = 'no';
$config->task->datatable->fieldList['assignedTo']['width']    = '100';
$config->task->datatable->fieldList['assignedTo']['required'] = 'no';

$config->task->datatable->fieldList['assignedDate']['title']    = 'assignedDate';
$config->task->datatable->fieldList['assignedDate']['fixed']    = 'no';
$config->task->datatable->fieldList['assignedDate']['width']    = '110';
$config->task->datatable->fieldList['assignedDate']['required'] = 'no';

$config->task->datatable->fieldList['finishedBy']['title']    = 'finishedByAB';
$config->task->datatable->fieldList['finishedBy']['fixed']    = 'no';
$config->task->datatable->fieldList['finishedBy']['width']    = '80';
$config->task->datatable->fieldList['finishedBy']['required'] = 'no';

$config->task->datatable->fieldList['finishedDate']['title']    = 'finishedDateAB';
$config->task->datatable->fieldList['finishedDate']['fixed']    = 'no';
$config->task->datatable->fieldList['finishedDate']['width']    = '105';
$config->task->datatable->fieldList['finishedDate']['required'] = 'no';

$config->task->datatable->fieldList['canceledBy']['title']    = 'canceledBy';
$config->task->datatable->fieldList['canceledBy']['fixed']    = 'no';
$config->task->datatable->fieldList['canceledBy']['width']    = '110';
$config->task->datatable->fieldList['canceledBy']['required'] = 'no';

$config->task->datatable->fieldList['canceledDate']['title']    = 'canceledDate';
$config->task->datatable->fieldList['canceledDate']['fixed']    = 'no';
$config->task->datatable->fieldList['canceledDate']['width']    = '115';
$config->task->datatable->fieldList['canceledDate']['required'] = 'no';

$config->task->datatable->fieldList['closedBy']['title']    = 'closedBy';
$config->task->datatable->fieldList['closedBy']['fixed']    = 'no';
$config->task->datatable->fieldList['closedBy']['width']    = '100';
$config->task->datatable->fieldList['closedBy']['required'] = 'no';

$config->task->datatable->fieldList['closedDate']['title']    = 'closedDate';
$config->task->datatable->fieldList['closedDate']['fixed']    = 'no';
$config->task->datatable->fieldList['closedDate']['width']    = '95';
$config->task->datatable->fieldList['closedDate']['required'] = 'no';

$config->task->datatable->fieldList['closedReason']['title']    = 'closedReason';
$config->task->datatable->fieldList['closedReason']['fixed']    = 'no';
$config->task->datatable->fieldList['closedReason']['width']    = '120';
$config->task->datatable->fieldList['closedReason']['required'] = 'no';

$config->task->datatable->fieldList['story']['title']    = "storyAB";
$config->task->datatable->fieldList['story']['fixed']    = 'no';
$config->task->datatable->fieldList['story']['width']    = '70';
$config->task->datatable->fieldList['story']['required'] = 'no';
$config->task->datatable->fieldList['story']['name']     = $lang->task->story;

$config->task->datatable->fieldList['mailto']['title']    = 'mailto';
$config->task->datatable->fieldList['mailto']['fixed']    = 'no';
$config->task->datatable->fieldList['mailto']['width']    = '100';
$config->task->datatable->fieldList['mailto']['required'] = 'no';

$config->task->datatable->fieldList['lastEditedBy']['title']    = 'lastEditedBy';
$config->task->datatable->fieldList['lastEditedBy']['fixed']    = 'no';
$config->task->datatable->fieldList['lastEditedBy']['width']    = '95';
$config->task->datatable->fieldList['lastEditedBy']['required'] = 'no';

$config->task->datatable->fieldList['lastEditedDate']['title']    = 'lastEditedDate';
$config->task->datatable->fieldList['lastEditedDate']['fixed']    = 'no';
$config->task->datatable->fieldList['lastEditedDate']['width']    = '120';
$config->task->datatable->fieldList['lastEditedDate']['required'] = 'no';

$config->task->datatable->fieldList['actions']['title']    = 'actions';
$config->task->datatable->fieldList['actions']['fixed']    = 'right';
$config->task->datatable->fieldList['actions']['width']    = '180';
$config->task->datatable->fieldList['actions']['required'] = 'yes';
