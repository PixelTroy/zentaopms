<?php
$lang->custom->common             = 'Personnalisation';
$lang->custom->index              = 'Accueil';
$lang->custom->set                = 'Personnaliser';
$lang->custom->restore            = 'Réinitialiser';
$lang->custom->key                = 'Clé';
$lang->custom->value              = 'Valeur';
$lang->custom->flow               = 'Concept';
$lang->custom->working            = 'Mode';
$lang->custom->select             = 'Choix du Concept';
$lang->custom->branch             = 'Multi-Branches';
$lang->custom->owner              = 'Propriétaire';
$lang->custom->module             = 'Module';
$lang->custom->section            = 'Section';
$lang->custom->lang               = 'Langue';
$lang->custom->setPublic          = 'Set Public';
$lang->custom->required           = 'Champ Obligatoire';
$lang->custom->score              = 'Point';
$lang->custom->timezone           = 'Timezone';
$lang->custom->scoreReset         = 'Réinit Points';
$lang->custom->scoreTitle         = 'Fonctionnalité des Points';
$lang->custom->project            = $lang->sprintCommon;
$lang->custom->product            = $lang->productCommon;
$lang->custom->estimate           = 'Estimated configuration';
$lang->custom->estimateConfig     = 'Estimated configuration';
$lang->custom->estimateUnit       = 'Estimating Unit';
$lang->custom->estimateEfficiency = 'Productivity';
$lang->custom->estimateCost       = 'Unit Labour Cost';
$lang->custom->estimateHours      = 'Daily Working Hours';
$lang->custom->estimateDays       = 'Working Days Per Week';
$lang->custom->convertRelations   = 'Convert Relations';
$lang->custom->region             = 'Interval';
$lang->custom->tips               = 'Tips';
$lang->custom->setTips            = 'Set Tips';
$lang->custom->isRange            = 'Is Target Control';
$lang->custom->concept            = "Concept";
$lang->custom->URStory            = "User requirements";
$lang->custom->SRStory            = "Software requirements";
$lang->custom->epic               = "Epic";
$lang->custom->scrumStory         = "Story";
$lang->custom->waterfallCommon    = "Waterfall";
$lang->custom->buildin            = "Buildin";
$lang->custom->isDefault          = 'Is Default';
$lang->custom->editStoryConcept   = "Edit Story Concept";
$lang->custom->setStoryConcept    = "Set Story Concept";
$lang->custom->setDefaultConcept  = "Set Default Concept";
$lang->custom->browseStoryConcept = "List of story concepts";
$lang->custom->deleteStoryConcept = "Delete story Concept";
$lang->custom->configureScrum     = "Scrum Model Custom";
$lang->custom->URConcept          = "UR Concept";
$lang->custom->SRConcept          = "SR Concept";
$lang->custom->one                = "One";

$lang->custom->unitList['efficiency'] = 'Working Hours/';
$lang->custom->unitList['manhour']    = 'Man-hour/';
$lang->custom->unitList['cost']       = 'Yuan/Hour';
$lang->custom->unitList['hours']      = 'Hours';
$lang->custom->unitList['days']       = 'Days';
$lang->custom->unitList['loc']        = 'KLOC';

$lang->custom->tipProgressList['SPI'] = 'Schedule Performance Index(SPI)';
$lang->custom->tipProgressList['SV']  = 'Schedule Variance(SV%)';

$lang->custom->tipCostList['CPI'] = 'Cost Performed Index(CPI)';
$lang->custom->tipCostList['CV']  = 'Cost Variance(CV%)';

$lang->custom->tipRangeList[0]  = 'No';
$lang->custom->tipRangeList[1]  = 'Yes';

$lang->custom->regionMustNumber     = 'The interval must be a number!';
$lang->custom->tipNotEmpty          = 'The prompt can not be empty!';
$lang->custom->currencyNotEmpty     = 'You have to select one currency at least.';
$lang->custom->mainCurrencyNotEmpty = 'The main currency can not bu empty';

$lang->custom->numberError = 'The interval must be greater than zero!';

$lang->custom->closedProject = 'Closed ' . $lang->sprintCommon;
$lang->custom->closedProduct = 'Closed ' . $lang->productCommon;

$lang->custom->object['program']  = 'Project';
$lang->custom->object['product']  = $lang->productCommon;
$lang->custom->object['project']  = $lang->sprintCommon;
$lang->custom->object['story']    = 'Story';
$lang->custom->object['task']     = 'Tâche';
$lang->custom->object['bug']      = 'Bug';
$lang->custom->object['testcase'] = 'CasTest';
$lang->custom->object['testtask'] = 'Build';
$lang->custom->object['todo']     = 'Agenda';
$lang->custom->object['user']     = 'Utilisateur';
$lang->custom->object['block']    = 'Bloc';

$lang->custom->program = new stdClass();
$lang->custom->program->currencySetting    = 'Currency Setting';
$lang->custom->program->mainCurrency       = 'Main Currency';
$lang->custom->program->fields['unitList'] = 'Unit List';

$lang->custom->story = new stdClass();
$lang->custom->story->fields['priList']          = 'Priorité';
$lang->custom->story->fields['sourceList']       = 'Source';
$lang->custom->story->fields['reasonList']       = 'Raison Fermeture';
$lang->custom->story->fields['stageList']        = 'Phase';
$lang->custom->story->fields['statusList']       = 'Statut';
$lang->custom->story->fields['reviewResultList'] = 'Valider Résultats';
$lang->custom->story->fields['review']           = 'Validation Requise';

$lang->custom->task = new stdClass();
$lang->custom->task->fields['priList']    = 'Priorité';
$lang->custom->task->fields['typeList']   = 'Type';
$lang->custom->task->fields['reasonList'] = 'Raison Fermeture';
$lang->custom->task->fields['statusList'] = 'Statut';
$lang->custom->task->fields['hours']      = 'Effort';

$lang->custom->bug = new stdClass();
$lang->custom->bug->fields['priList']        = 'Priorité';
$lang->custom->bug->fields['severityList']   = 'Sévérité';
$lang->custom->bug->fields['osList']         = 'OS';
$lang->custom->bug->fields['browserList']    = 'Browser';
$lang->custom->bug->fields['typeList']       = 'Type';
$lang->custom->bug->fields['resolutionList'] = 'Résolution';
$lang->custom->bug->fields['statusList']     = 'Statut';
$lang->custom->bug->fields['longlife']       = 'Jours Calage';

$lang->custom->testcase = new stdClass();
$lang->custom->testcase->fields['priList']    = 'Priorité';
$lang->custom->testcase->fields['typeList']   = 'Type';
$lang->custom->testcase->fields['stageList']  = 'Phase';
$lang->custom->testcase->fields['resultList'] = 'Résultat';
$lang->custom->testcase->fields['statusList'] = 'Statut';
$lang->custom->testcase->fields['review']     = 'Validation Requise';

$lang->custom->testtask = new stdClass();
$lang->custom->testtask->fields['priList']    = 'Priorité';
$lang->custom->testtask->fields['statusList'] = 'Statut';

$lang->custom->todo = new stdClass();
$lang->custom->todo->fields['priList']    = 'Priorité';
$lang->custom->todo->fields['typeList']   = 'Type';
$lang->custom->todo->fields['statusList'] = 'Statut';

$lang->custom->user = new stdClass();
$lang->custom->user->fields['roleList']     = 'Rôle';
$lang->custom->user->fields['statusList']   = 'Statut';
$lang->custom->user->fields['contactField'] = 'Contact';
$lang->custom->user->fields['deleted']      = 'Parti';

$lang->custom->system = array('required', 'score');

$lang->custom->block->fields['closed'] = 'Bloc Fermé';

$lang->custom->currentLang = 'Langage Courant';
$lang->custom->allLang     = 'Toutes les Langues';

$lang->custom->confirmRestore = 'Voulez-vous réinitialiser ?';

$lang->custom->notice = new stdclass();
$lang->custom->notice->userFieldNotice   = 'Contrôlez si les champs ci-dessus sont affichés sur la page utilisateur. Laissez-le vide pour tout afficher.';
$lang->custom->notice->canNotAdd         = "Il sera calculé, donc la personnalisation n'est pas activée.";
$lang->custom->notice->forceReview       = '%s un examen est requis pour les valideurs sélectionnés.';
$lang->custom->notice->forceNotReview    = "%s un examen n'est pas requis pour les valideurs sélectionnés.";
$lang->custom->notice->longlife          = 'Définir les bugs bloqués.';
$lang->custom->notice->invalidNumberKey  = 'La clé devrait être =< 255.';
$lang->custom->notice->invalidStringKey  = 'La clé devrait être composée de miniscules, de chiffres et du caractère souligné.';
$lang->custom->notice->cannotSetTimezone = "date_default_timezone_set n'existe pas ou est désactivé. Timezone ne peut pas être fixée.";
$lang->custom->notice->noClosedBlock     = "Vous n'avez aucun bloc fermé définitivement.";
$lang->custom->notice->required          = 'Le champ sélectionné est obligatoire.';
$lang->custom->notice->conceptResult     = 'Selon votre préférence, <b> %s-%s </b> peut être fixé pour vous. Utilisez <b>%s</b> + <b> %s</b>。';
$lang->custom->notice->conceptPath       = 'Allez à Admin -> Custom -> Concept pour le paramétrer.';
$lang->custom->notice->readOnlyOfProduct = 'If Change Forbidden, any change on stories, bugs, cases, efforts, releases and plans of the closed product is also forbidden.';
$lang->custom->notice->readOnlyOfProject = 'If Change Forbidden, any change on tasks, builds, efforts and stories of the closed project is also forbidden.';
$lang->custom->notice->URSREmpty         = 'Custom requirement name can not be empty!';
$lang->custom->notice->confirmDelete     = 'Are you sure you want to delete it?';

$lang->custom->notice->indexPage['product'] = "ZenTao 8.2+ possède une page d'accueil. Voulez-vous consulter la page d'accueil du produit ?";
$lang->custom->notice->indexPage['project'] = "ZenTao 8.2+ possède une page d'accueil. Voulez-vous consulter la page d'accueil du produit ?";
$lang->custom->notice->indexPage['qa']      = "ZenTao 8.2+ possède une FAQ. Voulez-vous consulter la FAQ ?";

$lang->custom->notice->invalidStrlen['ten']        = 'La clé devrait être <= 10 caractères.';
$lang->custom->notice->invalidStrlen['twenty']     = 'La clé devrait être <= 20 caractères.';
$lang->custom->notice->invalidStrlen['thirty']     = 'La clé devrait être <= 30 caractères.';
$lang->custom->notice->invalidStrlen['twoHundred'] = 'La clé devrait être <= 225 caractères.';

$lang->custom->storyReview    = 'Validation';
$lang->custom->forceReview    = 'Validation Requise';
$lang->custom->forceNotReview = 'Aucune Validation Requise';
$lang->custom->reviewList[1]  = 'On';
$lang->custom->reviewList[0]  = 'Off';

$lang->custom->deletedList[1] = 'Montrer';
$lang->custom->deletedList[0] = 'Cacher';

$lang->custom->workingHours   = 'Heures/Jour';
$lang->custom->weekend        = 'Weekend';
$lang->custom->weekendList[2] = '2-Jour';
$lang->custom->weekendList[1] = '1-Jour';

$lang->custom->sprintConceptList[0] = 'Program - Product - Iteration';
$lang->custom->sprintConceptList[1] = 'Program - Product - Sprint';

$lang->custom->workingList['full'] = 'Application Lifecycle Management';

$lang->custom->menuTip  = "Cliquez pour montrer/cacher le menu. Déplacez pour changer l'ordre d'affichage.";
$lang->custom->saveFail = 'Echec de la sauvegarde !';
$lang->custom->page     = ' Page';

$lang->custom->scoreStatus[1] = 'On';
$lang->custom->scoreStatus[0] = 'Off';

$lang->custom->CRProduct[1] = 'Change Allowed';
$lang->custom->CRProduct[0] = 'Change Forbidden';

$lang->custom->CRProject[1] = 'Change Allowed';
$lang->custom->CRProject[0] = 'Change Forbidden';

$lang->custom->moduleName['product']     = $lang->productCommon;
$lang->custom->moduleName['productplan'] = 'Plan';
$lang->custom->moduleName['project']     = $lang->sprintCommon;

$lang->custom->conceptQuestions['overview']         = "1. Quelle combinaison de gestion convient le mieux à votre entreprise ?";
$lang->custom->conceptQuestions['story']            = "2. Utilisez-vous le concept d'exigence ou de user story dans votre entreprise ?";
$lang->custom->conceptQuestions['requirementpoint'] = "3. Utilisez-vous des heures ou des points de fonction pour faire des estimations dans votre entreprise ?";
$lang->custom->conceptQuestions['storypoint']       = "3. Utilisez-vous des heures ou des points de Story pour faire des estimations dans votre entreprise ?";

$lang->custom->conceptOptions             = new stdclass;
$lang->custom->conceptOptions->story      = array();
$lang->custom->conceptOptions->story['0'] = 'Exigence';
$lang->custom->conceptOptions->story['1'] = 'Story';

$lang->custom->conceptOptions->hourPoint      = array();
$lang->custom->conceptOptions->hourPoint['0'] = 'Heures';
$lang->custom->conceptOptions->hourPoint['1'] = 'Story Point';
$lang->custom->conceptOptions->hourPoint['2'] = 'Function Point';

$lang->custom->conceptOptions->estimateUnit      = array();
$lang->custom->conceptOptions->estimateUnit['0'] = 'Stunde(H)';
$lang->custom->conceptOptions->estimateUnit['1'] = 'Story Point(SP)';
$lang->custom->conceptOptions->estimateUnit['2'] = 'Function Point(FP)';

$lang->custom->scrum = new stdclass();
$lang->custom->scrum->setConcept = 'Set concept';
