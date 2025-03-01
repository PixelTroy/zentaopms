<?php
/**
 * The action module English file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     action
 * @version     $Id: de.php 4729 2013-05-03 07:53:55Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
$lang->action->common     = 'Log';
$lang->action->product    = $lang->productCommon;
$lang->action->project    = 'Project';
$lang->action->execution  = $lang->executionCommon;
$lang->action->objectType = 'Object Type';
$lang->action->objectID   = 'ID';
$lang->action->objectName = 'Objekt Name';
$lang->action->actor      = 'Handler';
$lang->action->action     = 'Aktion';
$lang->action->actionID   = 'Aktion ID';
$lang->action->date       = 'Datum';
$lang->action->extra      = 'Wertschöpfung';

$lang->action->trash       = 'Aufräumen';
$lang->action->undelete    = 'Wiederherstellen';
$lang->action->hideOne     = 'Verstecken';
$lang->action->hideAll     = 'Alle verstecken';
$lang->action->editComment = 'Bearbeiten';
$lang->action->create      = 'Kommentar hinzufügen';
$lang->action->comment     = 'Kommentar';

$lang->action->trashTips      = 'Hinweis: Alle Löschungen in ZenTao sind logische Löschungen.';
$lang->action->textDiff       = 'Text Format';
$lang->action->original       = 'Original Format';
$lang->action->confirmHideAll = 'Möchten Sie alle Einträge verstecken?';
$lang->action->needEdit       = '%s existiert bereits. Bitte bearbeiten.';
$lang->action->historyEdit    = 'Der Verlauf darf nicht leer sein.';
$lang->action->noDynamic      = 'Kein Verlauf. ';

$lang->action->history = new stdclass();
$lang->action->history->action = 'Link';
$lang->action->history->field  = 'Feld';
$lang->action->history->old    = 'Alter Wert';
$lang->action->history->new    = 'Neuer Wert';
$lang->action->history->diff   = 'Diff';

$lang->action->dynamic = new stdclass();
$lang->action->dynamic->today      = 'Heute';
$lang->action->dynamic->yesterday  = 'Gestern';
$lang->action->dynamic->twoDaysAgo = 'Vorgestern';
$lang->action->dynamic->thisWeek   = 'Diese Woche';
$lang->action->dynamic->lastWeek   = 'Letze Woche';
$lang->action->dynamic->thisMonth  = 'Dieser Monat';
$lang->action->dynamic->lastMonth  = 'Letzer Monat';
$lang->action->dynamic->all        = 'Alle';
$lang->action->dynamic->hidden     = 'Versteckt';
$lang->action->dynamic->search     = 'Suche';

$lang->action->periods['all']       = $lang->action->dynamic->all;
$lang->action->periods['today']     = $lang->action->dynamic->today;
$lang->action->periods['yesterday'] = $lang->action->dynamic->yesterday;
$lang->action->periods['thisweek']  = $lang->action->dynamic->thisWeek;
$lang->action->periods['lastweek']  = $lang->action->dynamic->lastWeek;
$lang->action->periods['thismonth'] = $lang->action->dynamic->thisMonth;
$lang->action->periods['lastmonth'] = $lang->action->dynamic->lastMonth;

$lang->action->objectTypes['product']     = $lang->productCommon;
$lang->action->objectTypes['branch']      = 'Branch';
$lang->action->objectTypes['story']       = $lang->SRCommon;
$lang->action->objectTypes['design']      = 'Design';
$lang->action->objectTypes['productplan'] = 'Plan';
$lang->action->objectTypes['release']     = 'Release';
$lang->action->objectTypes['program']     = 'Program';
$lang->action->objectTypes['project']     = 'Project';
$lang->action->objectTypes['execution']   = $lang->executionCommon;
$lang->action->objectTypes['task']        = 'Aufgabe';
$lang->action->objectTypes['build']       = 'Build';
$lang->action->objectTypes['job']         = 'Job';
$lang->action->objectTypes['bug']         = 'Bug';
$lang->action->objectTypes['case']        = 'Fälle';
$lang->action->objectTypes['caseresult']  = 'Fallergebnisse';
$lang->action->objectTypes['stepresult']  = 'Schritte';
$lang->action->objectTypes['caselib']     = 'Bibliothek';
$lang->action->objectTypes['testsuite']   = 'Suite';
$lang->action->objectTypes['testtask']    = 'Test Build';
$lang->action->objectTypes['testreport']  = 'Berichte';
$lang->action->objectTypes['doc']         = 'Dok';
$lang->action->objectTypes['doclib']      = 'Dok Bibliothek';
$lang->action->objectTypes['todo']        = 'Todo';
$lang->action->objectTypes['risk']        = 'Risk';
$lang->action->objectTypes['issue']       = 'Issue';
$lang->action->objectTypes['module']      = 'Modul';
$lang->action->objectTypes['user']        = 'Benutzer';
$lang->action->objectTypes['stakeholder'] = 'Stakeholder';
$lang->action->objectTypes['budget']      = 'Cost Estimate';
$lang->action->objectTypes['entry']       = 'Eintrag';
$lang->action->objectTypes['webhook']     = 'Webhook';
$lang->action->objectTypes['job']         = 'Job';
$lang->action->objectTypes['team']        = 'Team';
$lang->action->objectTypes['whitelist']   = 'Whitelist';
$lang->action->objectTypes['pipeline']    = 'GitLib';

/* 用来描述操作历史记录。*/
$lang->action->desc = new stdclass();
$lang->action->desc->common          = '$date, <strong>$action</strong> von <strong>$actor</strong>.' . "\n";
$lang->action->desc->extra           = '$date, <strong>$action</strong> als <strong>$extra</strong> von <strong>$actor</strong>.' . "\n";
$lang->action->desc->opened          = '$date, erstellt von <strong>$actor</strong> .' . "\n";
$lang->action->desc->openedbysystem  = '$date, opened by system.' . "\n";
$lang->action->desc->created         = '$date, erstellt von  <strong>$actor</strong> .' . "\n";
$lang->action->desc->added           = '$date, hinzugefügt durch <strong>$actor</strong> .' . "\n";
$lang->action->desc->changed         = '$date, bearbeitet von <strong>$actor</strong> .' . "\n";
$lang->action->desc->edited          = '$date, bearbeitet von <strong>$actor</strong> .' . "\n";
$lang->action->desc->assigned        = '$date, <strong>$actor</strong> zugewisen an <strong>$extra</strong>.' . "\n";
$lang->action->desc->closed          = '$date, geschlossen von <strong>$actor</strong> .' . "\n";
$lang->action->desc->closedbysystem  = '$date, closed by system.' . "\n";
$lang->action->desc->deleted         = '$date, gelöscht von <strong>$actor</strong> .' . "\n";
$lang->action->desc->deletedfile     = '$date, <strong>$actor</strong> löschte <strong><i>$extra</i></strong>.' . "\n";
$lang->action->desc->editfile        = '$date, <strong>$actor</strong> bearbeitete <strong><i>$extra</i></strong>.' . "\n";
$lang->action->desc->erased          = '$date, gelöscht von <strong>$actor</strong> .' . "\n";
$lang->action->desc->undeleted       = '$date, wiederhergestellt von <strong>$actor</strong> .' . "\n";
$lang->action->desc->hidden          = '$date, versteckt von <strong>$actor</strong> .' . "\n";
$lang->action->desc->commented       = '$date, hinzugefügt von <strong>$actor</strong>.' . "\n";
$lang->action->desc->activated       = '$date, aktiviert von <strong>$actor</strong> .' . "\n";
$lang->action->desc->blocked         = '$date, geblockt von <strong>$actor</strong> .' . "\n";
$lang->action->desc->moved           = '$date, verschoben von <strong>$actor</strong> , ursprünglich "$extra".' . "\n";
$lang->action->desc->confirmed       = '$date, <strong>$actor</strong> hat die Anpassung der Story bestätigt. Das letzte Build ist <strong>#$extra</strong>.' . "\n";
$lang->action->desc->caseconfirmed   = '$date, <strong>$actor</strong> hat die Anpassung des Falls bestätigt. Das letzte Build ist <strong>#$extra</strong>' . "\n";
$lang->action->desc->bugconfirmed    = '$date, <strong>$actor</strong> hat den Bug bestätigt.' . "\n";
$lang->action->desc->frombug         = '$date, konvertiert von <strong>$actor</strong>. Die ID war <strong>$extra</strong>.';
$lang->action->desc->started         = '$date, gestartet von <strong>$actor</strong>.' . "\n";
$lang->action->desc->restarted       = '$date, continued by <strong>$actor</strong>.' . "\n";
$lang->action->desc->delayed         = '$date, zurückgestellt von <strong>$actor</strong>.' . "\n";
$lang->action->desc->suspended       = '$date, ausgesetzt von <strong>$actor</strong>.' . "\n";
$lang->action->desc->recordestimate  = '$date, aufgenommen von <strong>$actor</strong> und hat <strong>$extra</strong> Stunden aufgebraucht.';
$lang->action->desc->editestimate    = '$date, <strong>$actor</strong> Stunden angepaast.';
$lang->action->desc->deleteestimate  = '$date, <strong>$actor</strong> Stunden gelöscht.';
$lang->action->desc->canceled        = '$date, abgebrochen von <strong>$actor</strong>.' . "\n";
$lang->action->desc->svncommited     = '$date, <strong>$actor</strong> festgelegt. Build ist <strong>#$extra</strong>.' . "\n";
$lang->action->desc->gitcommited     = '$date, <strong>$actor</strong> festgelegt. Build ist <strong>#$extra</strong>.' . "\n";
$lang->action->desc->finished        = '$date, abgeschlossen von <strong>$actor</strong>.' . "\n";
$lang->action->desc->paused          = '$date, pausiert von <strong>$actor</strong>.' . "\n";
$lang->action->desc->verified        = '$date, überprüft von <strong>$actor</strong>.' . "\n";
$lang->action->desc->diff1           = '<strong><i>%s</i></strong> wurde geändert. Es war "%s" und ist jetzt "%s".<br />' . "\n";
$lang->action->desc->diff2           = '<strong><i>%s</i></strong> wurde geändert. Die Differenz ist ' . "\n" . "<blockquote class='textdiff'>%s</blockquote>" . "\n<blockquote class='original'>%s</blockquote>";
$lang->action->desc->diff3           = 'Dateiname %s wurde geändert zu %s .' . "\n";
$lang->action->desc->linked2bug      = '$date Verknüpft mit <strong>$extra</strong> von <strong>$actor</strong>';
$lang->action->desc->linked2testtask = '$date, linked to <strong>$extra</strong> by <strong>$actor</strong>';
$lang->action->desc->resolved        = '$date, resolved by <strong>$actor</strong> ' . "\n";
$lang->action->desc->managed         = '$date, by <strong>$actor</strong> managed.' . "\n";
$lang->action->desc->estimated       = '$date, by <strong>$actor</strong> estimated.' . "\n";
$lang->action->desc->run             = '$date, by <strong>$actor</strong> executed.' . "\n";

/* 子任务修改父任务的历史操作记录 */
$lang->action->desc->createchildren     = '$date, <strong>$actor</strong> created a child task <strong>$extra</strong>。' . "\n";
$lang->action->desc->linkchildtask      = '$date, <strong>$actor</strong> linked a child task <strong>$extra</strong>。' . "\n";
$lang->action->desc->unlinkchildrentask = '$date, <strong>$actor</strong> unlinked a child task <strong>$extra</strong>。' . "\n";
$lang->action->desc->linkparenttask     = '$date, <strong>$actor</strong> linked to a parent task <strong>$extra</strong>。' . "\n";
$lang->action->desc->unlinkparenttask   = '$date, <strong>$actor</strong> unlinked a parent task <strong>$extra</strong>。' . "\n";
$lang->action->desc->deletechildrentask = '$date, <strong>$actor</strong> deleted a child task <strong>$extra</strong>。' . "\n";

/* 用来描述和父子需求相关的操作历史记录。*/
$lang->action->desc->createchildrenstory = '$date, <strong>$actor</strong> created a child story <strong>$extra</strong>。' . "\n";
$lang->action->desc->linkchildstory      = '$date, <strong>$actor</strong> linked a child story <strong>$extra</strong>。' . "\n";
$lang->action->desc->unlinkchildrenstory = '$date, <strong>$actor</strong> unlinked a child story <strong>$extra</strong>。' . "\n";
$lang->action->desc->linkparentstory     = '$date, <strong>$actor</strong> linked to a parent story <strong>$extra</strong>。' . "\n";
$lang->action->desc->unlinkparentstory   = '$date, <strong>$actor</strong> unlinked a parent story <strong>$extra</strong>。' . "\n";
$lang->action->desc->deletechildrenstory = '$date, <strong>$actor</strong> deleted a child story <strong>$extra</strong>。' . "\n";

/* 关联用例和移除用例时的历史操作记录。*/
$lang->action->desc->linkrelatedcase   = '$date, <strong>$actor</strong> hat einen Fall verknüpft <strong>$extra</strong>.' . "\n";
$lang->action->desc->unlinkrelatedcase = '$date, <strong>$actor</strong> hate eine Fallverknüpfung aufgelöst <strong>$extra</strong>.' . "\n";

/* 用来显示动态信息。*/
$lang->action->label                        = new stdclass();
$lang->action->label->created               = 'created ';
$lang->action->label->opened                = 'opened ';
$lang->action->label->openedbysystem        = 'Opened by system ';
$lang->action->label->closedbysystem        = 'Closed by system ';
$lang->action->label->added                 = 'added';
$lang->action->label->changed               = 'changed ';
$lang->action->label->edited                = 'edited ';
$lang->action->label->assigned              = 'assigned ';
$lang->action->label->closed                = 'closed ';
$lang->action->label->deleted               = 'deleted ';
$lang->action->label->deletedfile           = 'deleted ';
$lang->action->label->editfile              = 'edit ';
$lang->action->label->erased                = 'erased ';
$lang->action->label->undeleted             = 'restored ';
$lang->action->label->hidden                = 'hid ';
$lang->action->label->commented             = 'commented ';
$lang->action->label->communicated          = 'communicated';
$lang->action->label->activated             = 'activated ';
$lang->action->label->blocked               = 'blocked ';
$lang->action->label->resolved              = 'resolved ';
$lang->action->label->reviewed              = 'reviewed ';
$lang->action->label->recalled              = 'recalled';
$lang->action->label->moved                 = 'moved ';
$lang->action->label->confirmed             = 'Confirm Story';
$lang->action->label->bugconfirmed          = 'Confirmed';
$lang->action->label->tostory               = 'Convert to Story';
$lang->action->label->frombug               = 'Converted from Bug';
$lang->action->label->fromlib               = 'Import from library';
$lang->action->label->totask                = 'Convert to Task';
$lang->action->label->svncommited           = 'SVN Commit';
$lang->action->label->gitcommited           = 'Git Commit';
$lang->action->label->linked2plan           = 'Link to Plan';
$lang->action->label->unlinkedfromplan      = 'Unlink';
$lang->action->label->changestatus          = 'Change Status';
$lang->action->label->marked                = 'marked';
$lang->action->label->linked2execution      = "Link {$lang->executionCommon}";
$lang->action->label->unlinkedfromexecution = "Unlink {$lang->executionCommon}";
$lang->action->label->linked2project        = "Link Project";
$lang->action->label->unlinkedfromproject   = "Unlink Project";
$lang->action->label->unlinkedfrombuild     = "Unlink Build";
$lang->action->label->linked2release        = "Link Release";
$lang->action->label->unlinkedfromrelease   = "Unlink Release";
$lang->action->label->linkrelatedbug        = "Link to Bug";
$lang->action->label->unlinkrelatedbug      = "Unlink";
$lang->action->label->linkrelatedcase       = "Link to Case";
$lang->action->label->unlinkrelatedcase     = "Unlink";
$lang->action->label->linkrelatedstory      = "Link to Story";
$lang->action->label->unlinkrelatedstory    = "Unlink";
$lang->action->label->subdividestory        = "Decompose Story";
$lang->action->label->unlinkchildstory      = "Unlink";
$lang->action->label->started               = 'started ';
$lang->action->label->restarted             = 'continued ';
$lang->action->label->recordestimate        = 'recorded ';
$lang->action->label->editestimate          = 'edited ';
$lang->action->label->canceled              = 'cancelled ';
$lang->action->label->finished              = 'finished ';
$lang->action->label->paused                = 'paused ';
$lang->action->label->verified              = 'verified ';
$lang->action->label->delayed               = 'delayed ';
$lang->action->label->suspended             = 'suspended ';
$lang->action->label->login                 = 'Login';
$lang->action->label->logout                = "Logout";
$lang->action->label->deleteestimate        = "deleted ";
$lang->action->label->linked2build          = "linked ";
$lang->action->label->linked2bug            = "linked ";
$lang->action->label->linked2testtask       = "linked";
$lang->action->label->unlinkedfromtesttask  = "unlinked";
$lang->action->label->linkchildtask         = "linked a child task";
$lang->action->label->unlinkchildrentask    = "unlinked a child task";
$lang->action->label->linkparenttask        = "linked a parent task";
$lang->action->label->unlinkparenttask      = "unlink from parent task";
$lang->action->label->batchcreate           = "batch created tasks";
$lang->action->label->createchildren        = "create child tasks";
$lang->action->label->managed               = "managed";
$lang->action->label->managedteam           = "managed";
$lang->action->label->managedwhitelist      = "managed";
$lang->action->label->deletechildrentask    = "delete children task";
$lang->action->label->createchildrenstory   = "create child stories";
$lang->action->label->linkchildstory        = "linked a child story";
$lang->action->label->unlinkchildrenstory   = "unlinked a child story";
$lang->action->label->linkparentstory       = "linked a parent story";
$lang->action->label->unlinkparentstory     = "unlink from parent story";
$lang->action->label->deletechildrenstory   = "delete children story";
$lang->action->label->tracked               = 'tracked';
$lang->action->label->hangup                = 'hangup';
$lang->action->label->run                   = 'run';
$lang->action->label->estimated             = 'estimated';
$lang->action->label->reviewpassed          = 'Pass';
$lang->action->label->reviewrejected        = 'Reject';
$lang->action->label->reviewclarified       = 'Clarify';
$lang->action->label->commitsummary         = 'Commit Summary';
$lang->action->label->updatetrainee         = 'Update Trainee';

/* 动态信息按照对象分组 */
$lang->action->dynamicAction                    = new stdclass;
$lang->action->dynamicAction->todo['opened']    = 'Create Todo';
$lang->action->dynamicAction->todo['edited']    = 'Edit Todo';
$lang->action->dynamicAction->todo['erased']    = 'Delete Todo';
$lang->action->dynamicAction->todo['finished']  = 'Finish Todo';
$lang->action->dynamicAction->todo['activated'] = 'Activate Todo';
$lang->action->dynamicAction->todo['closed']    = 'Close Todo';
$lang->action->dynamicAction->todo['assigned']  = 'Assign Todo';
$lang->action->dynamicAction->todo['undeleted'] = 'Restore Todo';
$lang->action->dynamicAction->todo['hidden']    = 'Hide Todo';

$lang->action->dynamicAction->program['create']   = 'Create Program';
$lang->action->dynamicAction->program['edit']     = 'Edit Program';
$lang->action->dynamicAction->program['activate'] = 'Activate Program';
$lang->action->dynamicAction->program['delete']   = 'Delete Program';
$lang->action->dynamicAction->program['close']    = 'Close Program';

$lang->action->dynamicAction->project['create']   = 'Create Project';
$lang->action->dynamicAction->project['edit']     = 'Edit Project';
$lang->action->dynamicAction->project['start']    = 'Start Project';
$lang->action->dynamicAction->project['suspend']  = 'Suspend Project';
$lang->action->dynamicAction->project['activate'] = 'Activate Project';
$lang->action->dynamicAction->project['close']    = 'Close Project';

$lang->action->dynamicAction->product['opened']    = 'Create ' . $lang->productCommon;
$lang->action->dynamicAction->product['edited']    = 'Edit ' . $lang->productCommon;
$lang->action->dynamicAction->product['deleted']   = 'Delete ' . $lang->productCommon;
$lang->action->dynamicAction->product['closed']    = 'Close ' . $lang->productCommon;
$lang->action->dynamicAction->product['undeleted'] = 'Restore ' . $lang->productCommon;
$lang->action->dynamicAction->product['hidden']    = 'Hide ' . $lang->productCommon;

$lang->action->dynamicAction->productplan['opened'] = 'Create Plan';
$lang->action->dynamicAction->productplan['edited'] = 'Edit Plan';

$lang->action->dynamicAction->release['opened']       = 'Create Release';
$lang->action->dynamicAction->release['edited']       = 'Edit Release';
$lang->action->dynamicAction->release['changestatus'] = 'Change Release Status';
$lang->action->dynamicAction->release['undeleted']    = 'Restore Release';
$lang->action->dynamicAction->release['hidden']       = 'Hide Release';

$lang->action->dynamicAction->story['opened']                = 'Create Story';
$lang->action->dynamicAction->story['edited']                = 'Edit Story';
$lang->action->dynamicAction->story['activated']             = 'Activate Story';
$lang->action->dynamicAction->story['reviewed']              = 'Review Story';
$lang->action->dynamicAction->story['recalled']              = 'Revoke';
$lang->action->dynamicAction->story['closed']                = 'Close Story';
$lang->action->dynamicAction->story['assigned']              = 'Assign Story';
$lang->action->dynamicAction->story['changed']               = 'Change Story';
$lang->action->dynamicAction->story['linked2plan']           = 'Link Story to Plan';
$lang->action->dynamicAction->story['unlinkedfromplan']      = 'Unlink Story from Plan';
$lang->action->dynamicAction->story['linked2release']        = 'Link Story to Release';
$lang->action->dynamicAction->story['unlinkedfromrelease']   = 'Unlink Story from Plan';
$lang->action->dynamicAction->story['linked2build']          = 'Link Story to Build';
$lang->action->dynamicAction->story['unlinkedfrombuild']     = 'Unlink Story from Build';
$lang->action->dynamicAction->story['unlinkedfromproject']   = 'Unlink Project';
$lang->action->dynamicAction->story['undeleted']             = 'Restore Story';
$lang->action->dynamicAction->story['hidden']                = 'Hide Story';
$lang->action->dynamicAction->story['linked2execution']      = "Link Story";
$lang->action->dynamicAction->story['unlinkedfromexecution'] = "Unlink Story";
$lang->action->dynamicAction->story['estimated']             = "Estimate $lang->SRCommon";

$lang->action->dynamicAction->execution['opened']    = 'Create ' . $lang->executionCommon;
$lang->action->dynamicAction->execution['edited']    = 'Edit ' . $lang->executionCommon;
$lang->action->dynamicAction->execution['deleted']   = 'Delete ' . $lang->executionCommon;
$lang->action->dynamicAction->execution['started']   = 'Start ' . $lang->executionCommon;
$lang->action->dynamicAction->execution['delayed']   = 'Delay ' . $lang->executionCommon;
$lang->action->dynamicAction->execution['suspended'] = 'Suspend ' . $lang->executionCommon;
$lang->action->dynamicAction->execution['activated'] = 'Activate ' . $lang->executionCommon;
$lang->action->dynamicAction->execution['closed']    = 'Close ' . $lang->executionCommon;
$lang->action->dynamicAction->execution['managed']   = 'Manage ' . $lang->executionCommon;
$lang->action->dynamicAction->execution['undeleted'] = 'Restore ' . $lang->executionCommon;
$lang->action->dynamicAction->execution['hidden']    = 'Hide ' . $lang->executionCommon;
$lang->action->dynamicAction->execution['moved']     = 'Improt Task';

$lang->action->dynamicAction->team['managedTeam'] = 'Manage Team';

$lang->action->dynamicAction->task['opened']              = 'Create Task';
$lang->action->dynamicAction->task['edited']              = 'Edit Task';
$lang->action->dynamicAction->task['commented']           = 'Task Comment';
$lang->action->dynamicAction->task['assigned']            = 'Assign Task';
$lang->action->dynamicAction->task['confirmed']           = 'Confirm Task';
$lang->action->dynamicAction->task['started']             = 'Start Task';
$lang->action->dynamicAction->task['finished']            = 'Finish Task';
$lang->action->dynamicAction->task['recordestimate']      = 'Add Estimates';
$lang->action->dynamicAction->task['editestimate']        = 'Edit Estimates';
$lang->action->dynamicAction->task['deleteestimate']      = 'Delete Estimates';
$lang->action->dynamicAction->task['paused']              = 'Pause Task';
$lang->action->dynamicAction->task['closed']              = 'Close Task';
$lang->action->dynamicAction->task['canceled']            = 'Cancel Task';
$lang->action->dynamicAction->task['activated']           = 'Activate Task';
$lang->action->dynamicAction->task['createchildren']      = 'Create Child Task';
$lang->action->dynamicAction->task['unlinkparenttask']    = 'Unlink Parent Task';
$lang->action->dynamicAction->task['deletechildrentask']  = 'Delete children task';
$lang->action->dynamicAction->task['linkparenttask']      = 'Link Parent Task';
$lang->action->dynamicAction->task['linkchildtask']       = 'Link Child Task';
$lang->action->dynamicAction->task['createchildrenstory'] = 'Create Child Story';
$lang->action->dynamicAction->task['unlinkparentstory']   = 'Unlink Parent Story';
$lang->action->dynamicAction->task['deletechildrenstory'] = 'Delete children story';
$lang->action->dynamicAction->task['linkparentstory']     = 'Link Parent Story';
$lang->action->dynamicAction->task['linkchildstory']      = 'Link Child Story';
$lang->action->dynamicAction->task['undeleted']           = 'Restore Task';
$lang->action->dynamicAction->task['hidden']              = 'Hide Task';
$lang->action->dynamicAction->task['svncommited']         = 'SVN Commit';
$lang->action->dynamicAction->task['gitcommited']         = 'GIT Commit';

$lang->action->dynamicAction->build['opened']  = 'Create Build';
$lang->action->dynamicAction->build['edited']  = 'Edit Build';
$lang->action->dynamicAction->build['deleted'] = 'Delete Build';

$lang->action->dynamicAction->bug['opened']              = 'Report Bug';
$lang->action->dynamicAction->bug['edited']              = 'Edit Bug';
$lang->action->dynamicAction->bug['activated']           = 'Activate Bug';
$lang->action->dynamicAction->bug['assigned']            = 'Assign Bug';
$lang->action->dynamicAction->bug['closed']              = 'Close Bug';
$lang->action->dynamicAction->bug['bugconfirmed']        = 'Confirm Bug';
$lang->action->dynamicAction->bug['resolved']            = 'Resolve Bug';
$lang->action->dynamicAction->bug['undeleted']           = 'Restore Bug';
$lang->action->dynamicAction->bug['hidden']              = 'Hide Bug';
$lang->action->dynamicAction->bug['deleted']             = 'Delete Bug';
$lang->action->dynamicAction->bug['confirmed']           = 'Confirm Story Change';
$lang->action->dynamicAction->bug['tostory']             = 'Convert to Story';
$lang->action->dynamicAction->bug['totask']              = 'Convert to Task';
$lang->action->dynamicAction->bug['linked2plan']         = 'Link Plan';
$lang->action->dynamicAction->bug['unlinkedfromplan']    = 'Unlink Plan';
$lang->action->dynamicAction->bug['linked2release']      = 'Link Release';
$lang->action->dynamicAction->bug['unlinkedfromrelease'] = 'Unlink Plan';
$lang->action->dynamicAction->bug['linked2bug']          = 'Link Build';
$lang->action->dynamicAction->bug['unlinkedfrombuild']   = 'Unlink Build';

$lang->action->dynamicAction->testtask['opened']    = 'Create Test Request';
$lang->action->dynamicAction->testtask['edited']    = 'Edit Test Request';
$lang->action->dynamicAction->testtask['started']   = 'Start Test Request';
$lang->action->dynamicAction->testtask['activated'] = 'Activate Test Request';
$lang->action->dynamicAction->testtask['closed']    = 'Close Test Request';
$lang->action->dynamicAction->testtask['blocked']   = 'Blocked Test Request';

$lang->action->dynamicAction->case['opened']    = 'Create Case';
$lang->action->dynamicAction->case['edited']    = 'Edit Case';
$lang->action->dynamicAction->case['deleted']   = 'Delete Case';
$lang->action->dynamicAction->case['undeleted'] = 'Restore Case';
$lang->action->dynamicAction->case['hidden']    = 'Hide Case';
$lang->action->dynamicAction->case['reviewed']  = 'Add Review Result';
$lang->action->dynamicAction->case['confirmed'] = 'Confirm Case';
$lang->action->dynamicAction->case['fromlib']   = 'Import from Case Lib';

$lang->action->dynamicAction->testreport['opened']    = 'Create Test Report';
$lang->action->dynamicAction->testreport['edited']    = 'Edit Test Report';
$lang->action->dynamicAction->testreport['deleted']   = 'Delete Test Report';
$lang->action->dynamicAction->testreport['undeleted'] = 'Restore Test Report';
$lang->action->dynamicAction->testreport['hidden']    = 'Hide Test Report';

$lang->action->dynamicAction->testsuite['opened']    = 'Create Test Suite';
$lang->action->dynamicAction->testsuite['edited']    = 'Edit Test Suite';
$lang->action->dynamicAction->testsuite['deleted']   = 'Delete Test Suite';
$lang->action->dynamicAction->testsuite['undeleted'] = 'Restore Test Suite';
$lang->action->dynamicAction->testsuite['hidden']    = 'Hide Test Suite';

$lang->action->dynamicAction->caselib['opened']    = 'Create Case Lib';
$lang->action->dynamicAction->caselib['edited']    = 'Edit Case Lib';
$lang->action->dynamicAction->caselib['deleted']   = 'Delete Case Lib';
$lang->action->dynamicAction->caselib['undeleted'] = 'Restore Case Lib';
$lang->action->dynamicAction->caselib['hidden']    = 'Hide Case Lib';

$lang->action->dynamicAction->doclib['created'] = 'Create Doc Library';
$lang->action->dynamicAction->doclib['edited']  = 'Edit Doc Library';
$lang->action->dynamicAction->doclib['deleted'] = 'Delete Doc Library';

$lang->action->dynamicAction->doc['created']   = 'Create Document';
$lang->action->dynamicAction->doc['edited']    = 'Edit Document';
$lang->action->dynamicAction->doc['commented'] = 'Comment Document';
$lang->action->dynamicAction->doc['deleted']   = 'Delete Document';
$lang->action->dynamicAction->doc['undeleted'] = 'Restore Document';
$lang->action->dynamicAction->doc['hidden']    = 'Hide Document';

$lang->action->dynamicAction->user['created']       = 'Create User';
$lang->action->dynamicAction->user['edited']        = 'Edit User';
$lang->action->dynamicAction->user['deleted']       = 'Delete User';
$lang->action->dynamicAction->user['login']         = 'Login';
$lang->action->dynamicAction->user['logout']        = 'Logout';
$lang->action->dynamicAction->user['undeleted']     = 'Restore User';
$lang->action->dynamicAction->user['hidden']        = 'Hide User';
$lang->action->dynamicAction->user['loginxuanxuan'] = 'Login Desktop';

$lang->action->dynamicAction->entry['created'] = 'Add Application';
$lang->action->dynamicAction->entry['edited']  = 'Edit Application';

/* 用来生成相应对象的链接。*/
global $config;
$lang->action->label->product     = $lang->productCommon . '|product|view|productID=%s';
$lang->action->label->productplan = 'Plan|productplan|view|productID=%s';
$lang->action->label->release     = 'Release|release|view|productID=%s';
$lang->action->label->story       = 'Story|story|view|storyID=%s';
$lang->action->label->program     = "Program|program|pgmproduct|programID=%s";
$lang->action->label->project     = "Project|project|index|projectID=%s";
if($config->systemMode == 'new')
{
    $lang->action->label->execution = "Execution|execution|task|executionID=%s";
}
else
{
    $lang->action->label->execution = "$lang->executionCommon|execution|task|executionID=%s";
}
$lang->action->label->task        = 'Aufgaben|task|view|taskID=%s';
$lang->action->label->build       = 'Builds|build|view|buildID=%s';
$lang->action->label->bug         = 'Bugs|bug|view|bugID=%s';
$lang->action->label->case        = 'Fälle|testcase|view|caseID=%s';
$lang->action->label->testtask    = 'Testaufgaben|testtask|view|caseID=%s';
$lang->action->label->testsuite   = 'Test Suite|testsuite|view|suiteID=%s';
$lang->action->label->caselib     = 'Fallbibliothek|testsuite|libview|libID=%s';
$lang->action->label->todo        = 'Todo|todo|view|todoID=%s';
$lang->action->label->doclib      = 'Dok Bibliothek|doc|browse|libID=%s';
$lang->action->label->doc         = 'Dok|doc|view|docID=%s';
$lang->action->label->user        = 'Benutzer|user|view|account=%s';
$lang->action->label->testreport  = 'Berichte|testreport|view|report=%s';
$lang->action->label->entry       = 'Eintrag|entry|browse|';
$lang->action->label->webhook     = 'Webhook|webhook|browse|';
$lang->action->label->space       = ' ';
$lang->action->label->risk        = 'Risk|risk|view|riskID=%s';
$lang->action->label->issue       = 'Issue|issue|view|issueID=%s';
$lang->action->label->design      = 'Design|design|view|designID=%s';
$lang->action->label->stakeholder = 'Stakeholder|stakeholder|view|userID=%s';

/* Object type. */
$lang->action->search = new stdclass();
$lang->action->search->objectTypeList['']            = '';
$lang->action->search->objectTypeList['product']     = $lang->productCommon;
$lang->action->search->objectTypeList['program']     = 'Program';
$lang->action->search->objectTypeList['project']     = 'Project';
$lang->action->search->objectTypeList['execution']   = 'Execution';
$lang->action->search->objectTypeList['bug']         = 'Bug';
$lang->action->search->objectTypeList['case']        = 'Fälle';
$lang->action->search->objectTypeList['caseresult']  = 'Fallergebnisse';
$lang->action->search->objectTypeList['stepresult']  = 'Fallschritte';
$lang->action->search->objectTypeList['story']       = "$lang->SRCommon/$lang->URCommon";
$lang->action->search->objectTypeList['task']        = 'Aufgaben';
$lang->action->search->objectTypeList['testtask']    = 'Testaufgaben';
$lang->action->search->objectTypeList['user']        = 'Benutzer';
$lang->action->search->objectTypeList['doc']         = 'Dok';
$lang->action->search->objectTypeList['doclib']      = 'Dok Bibliothek';
$lang->action->search->objectTypeList['todo']        = 'Todo';
$lang->action->search->objectTypeList['build']       = 'Build';
$lang->action->search->objectTypeList['release']     = 'Release';
$lang->action->search->objectTypeList['productplan'] = 'Plan';
$lang->action->search->objectTypeList['branch']      = 'Branch';
$lang->action->search->objectTypeList['testsuite']   = 'Suite';
$lang->action->search->objectTypeList['caselib']     = 'Bibliothek';
$lang->action->search->objectTypeList['testreport']  = 'Berichte';

/* 用来在动态显示中显示动作 */
$lang->action->search->label['']                      = '';
$lang->action->search->label['created']               = $lang->action->label->created;
$lang->action->search->label['opened']                = $lang->action->label->opened;
$lang->action->search->label['changed']               = $lang->action->label->changed;
$lang->action->search->label['edited']                = $lang->action->label->edited;
$lang->action->search->label['assigned']              = $lang->action->label->assigned;
$lang->action->search->label['closed']                = $lang->action->label->closed;
$lang->action->search->label['deleted']               = $lang->action->label->deleted;
$lang->action->search->label['deletedfile']           = $lang->action->label->deletedfile;
$lang->action->search->label['editfile']              = $lang->action->label->editfile;
$lang->action->search->label['erased']                = $lang->action->label->erased;
$lang->action->search->label['undeleted']             = $lang->action->label->undeleted;
$lang->action->search->label['hidden']                = $lang->action->label->hidden;
$lang->action->search->label['commented']             = $lang->action->label->commented;
$lang->action->search->label['activated']             = $lang->action->label->activated;
$lang->action->search->label['blocked']               = $lang->action->label->blocked;
$lang->action->search->label['resolved']              = $lang->action->label->resolved;
$lang->action->search->label['reviewed']              = $lang->action->label->reviewed;
$lang->action->search->label['moved']                 = $lang->action->label->moved;
$lang->action->search->label['confirmed']             = $lang->action->label->confirmed;
$lang->action->search->label['bugconfirmed']          = $lang->action->label->bugconfirmed;
$lang->action->search->label['tostory']               = $lang->action->label->tostory;
$lang->action->search->label['frombug']               = $lang->action->label->frombug;
$lang->action->search->label['totask']                = $lang->action->label->totask;
$lang->action->search->label['svncommited']           = $lang->action->label->svncommited;
$lang->action->search->label['gitcommited']           = $lang->action->label->gitcommited;
$lang->action->search->label['linked2plan']           = $lang->action->label->linked2plan;
$lang->action->search->label['unlinkedfromplan']      = $lang->action->label->unlinkedfromplan;
$lang->action->search->label['changestatus']          = $lang->action->label->changestatus;
$lang->action->search->label['marked']                = $lang->action->label->marked;
$lang->action->search->label['linked2project']        = $lang->action->label->linked2project;
$lang->action->search->label['unlinkedfromproject']   = $lang->action->label->unlinkedfromproject;
$lang->action->search->label['linked2execution']      = $lang->action->label->linked2execution;
$lang->action->search->label['unlinkedfromexecution'] = $lang->action->label->unlinkedfromexecution;
$lang->action->search->label['started']               = $lang->action->label->started;
$lang->action->search->label['restarted']             = $lang->action->label->restarted;
$lang->action->search->label['recordestimate']        = $lang->action->label->recordestimate;
$lang->action->search->label['editestimate']          = $lang->action->label->editestimate;
$lang->action->search->label['canceled']              = $lang->action->label->canceled;
$lang->action->search->label['finished']              = $lang->action->label->finished;
$lang->action->search->label['paused']                = $lang->action->label->paused;
$lang->action->search->label['verified']              = $lang->action->label->verified;
$lang->action->search->label['login']                 = $lang->action->label->login;
$lang->action->search->label['logout']                = $lang->action->label->logout;
