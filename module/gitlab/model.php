<?php
/**
 * The model file of gitlab module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chenqi <chenqi@cnezsoft.com>
 * @package     product
 * @version     $Id: $
 * @link        http://www.zentao.net
 */

class gitlabModel extends model
{
    /**
     * Get a gitlab by id.
     *
     * @param  int $id
     * @access public
     * @return object
     */
    public function getByID($id)
    {
        return $this->loadModel('pipeline')->getByID($id);
    }

    /**
     * Get gitlab list.
     *
     * @param  string $orderBy
     * @param  object $pager
     * @access public
     * @return array
     */
    public function getList($orderBy = 'id_desc', $pager = null)
    {
        $gitlabList = $this->loadModel('pipeline')->getList('gitlab', $orderBy, $pager);

        return $gitlabList;
    }

    /**
     * Get gitlab pairs.
     *
     * @access public
     * @return array
     */
    public function getPairs()
    {
        return $this->loadModel('pipeline')->getPairs('gitlab');
    }

    /**
     * Get gitlab api base url by gitlab id.
     *
     * @param  int $id
     * @access public
     * @return string
     */
    public function getApiRoot($id)
    {
        $gitlab = $this->getByID($id);
        if(!$gitlab) return '';
        return rtrim($gitlab->url, '/') . '/api/v4%s' . "?private_token={$gitlab->token}";
    }

    /**
     * Get gitlab user id and realname pairs of one gitlab.
     *
     * @param  int $gitlabID
     * @access public
     * @return array
     */
    public function getUserIdRealnamePairs($gitlabID)
    {
        return $this->dao->select('oauth.openID as openID,user.realname as realname')
            ->from(TABLE_OAUTH)->alias('oauth')
            ->leftJoin(TABLE_USER)->alias('user')
            ->on("oauth.account = user.account")
            ->where('providerType')->eq('gitlab')
            ->andWhere('providerID')->eq($gitlabID)
            ->fetchPairs();
    }

    /**
     * Get gitlab user id and zentao account pairs of one gitlab.
     *
     * @param  int $gitlabID
     * @access public
     * @return array
     */
    public function getUserIdAccountPairs($gitlabID)
    {
        return $this->dao->select('openID,account')->from(TABLE_OAUTH)
            ->where('providerType')->eq('gitlab')
            ->andWhere('providerID')->eq($gitlabID)
            ->fetchPairs();
    }

    /**
     * Get zentao account gitlab user id pairs of one gitlab.
     *
     * @param  int $gitlabID
     * @access public
     * @return array
     */
    public function getUserAccountIdPairs($gitlabID)
    {
        return $this->dao->select('account,openID')->from(TABLE_OAUTH)
            ->where('providerType')->eq('gitlab')
            ->andWhere('providerID')->eq($gitlabID)
            ->fetchPairs();
    }

    /**
     * Get project pairs of one gitlab.
     *
     * @param  int $gitlabID
     * @access public
     * @return array
     */
    public function getProjectPairs($gitlabID)
    {
        $projects = $this->apiGetProjects($gitlabID);

        $projectPairs = array();
        foreach($projects as $project) $projectPairs[$project->id] = $project->name_with_namespace;

        return $projectPairs;
    }

    /**
     * Get matched gitlab users.
     *
     * @param  array $gitlabUsers
     * @param  array $zentaoUsers
     * @access public
     * @return array
     */
    public function getMatchedUsers($gitlabID, $gitlabUsers, $zentaoUsers)
    {
        $matches = new stdclass;
        foreach($gitlabUsers as $gitlabUser)
        {
            foreach($zentaoUsers as $zentaoUser)
            {
                if($gitlabUser->account == $zentaoUser->account) $matches->accounts[$gitlabUser->account][] = $zentaoUser->account;
                if($gitlabUser->realname == $zentaoUser->realname) $matches->names[$gitlabUser->realname][] = $zentaoUser->account;
                if($gitlabUser->email == $zentaoUser->email) $matches->emails[$gitlabUser->email][] = $zentaoUser->account;
            }
        }

        $bindedUsers = $this->dao->select('openID,account')
            ->from(TABLE_OAUTH)
            ->where('providerType')->eq('gitlab')
            ->andWhere('providerID')->eq($gitlabID)
            ->fetchPairs();

        $matchedUsers = array();
        foreach($gitlabUsers as $gitlabUser)
        {
            if(isset($bindedUsers[$gitlabUser->id]))
            {
                $gitlabUser->zentaoAccount = $bindedUsers[$gitlabUser->id];
                $matchedUsers[]            = $gitlabUser;
                continue;
            }

            $matchedZentaoUsers = array();
            if(isset($matches->accounts[$gitlabUser->account])) $matchedZentaoUsers = array_merge($matchedZentaoUsers, $matches->accounts[$gitlabUser->account]);
            if(isset($matches->emails[$gitlabUser->email])) $matchedZentaoUsers = array_merge($matchedZentaoUsers, $matches->emails[$gitlabUser->email]);
            if(isset($matches->names[$gitlabUser->realname])) $matchedZentaoUsers = array_merge($matchedZentaoUsers, $matches->names[$gitlabUser->realname]);

            $matchedZentaoUsers = array_unique($matchedZentaoUsers);
            if(count($matchedZentaoUsers) == 1)
            {
                $gitlabUser->zentaoAccount = current($matchedZentaoUsers);
                $matchedUsers[]            = $gitlabUser;
            }
        }

        return $matchedUsers;
    }

    /**
     * Get gitlab projects by executionID.
     *
     * @param  int $executionID
     * @access public
     * @return array
     */
    public function getProjectsByExecution($executionID)
    {
        $products      = $this->loadModel('execution')->getProducts($executionID, false);
        $productIdList = array_keys($products);

        return $this->dao->select('AID,BID as gitlabProject')
            ->from(TABLE_RELATION)
            ->where('relation')->eq('interrated')
            ->andWhere('AType')->eq('gitlab')
            ->andWhere('BType')->eq('gitlabProject')
            ->andWhere('product')->in($productIdList)
            ->fetchGroup('AID');
    }

    /**
     * Get executions by one product for gitlab module.
     *
     * @param  int $productID
     * @access public
     * @return object
     */
    public function getExecutionsByProduct($productID)
    {
        return $this->dao->select('distinct execution')->from(TABLE_RELATION)
            ->where('relation')->eq('interrated')
            ->andWhere('AType')->eq('gitlab')
            ->andWhere('BType')->eq('gitlabProject')
            ->andWhere('product')->eq($productID)
            ->fetchAll('execution');
    }

    /**
     * Get gitlabID and projectID.
     *
     * @param  string $objectType
     * @param  int    $objectID
     * @access public
     * @return object
     */
    public function getRelationByObject($objectType, $objectID)
    {
        return $this->dao->select('*, extra as gitlabID, BVersion as projectID, BID as issueID')->from(TABLE_RELATION)
            ->where('relation')->eq('gitlab')
            ->andWhere('Atype')->eq($objectType)
            ->andWhere('AID')->eq($objectID)
            ->fetch();
    }

    /**
     * Get issue id list group by object.
     *
     * @param  string $objectType
     * @param  int    $objectID
     * @access public
     * @return object
     */
    public function getIssueListByObjects($objectType, $objects)
    {
        return $this->dao->select('*, extra as gitlabID, BVersion as projectID, BID as issueID')->from(TABLE_RELATION)
            ->where('relation')->eq('gitlab')
            ->andWhere('Atype')->eq($objectType)
            ->andWhere('AID')->in($objects)
            ->fetchAll('AID');
    }


    /**
     * Get gitlab userID by account.
     *
     * @param  int    $gitlabID
     * @param  string $account
     * @access public
     * @return object
     */
    public function getGitlabUserID($gitlabID, $account)
    {
        return $this->dao->select('openID')->from(TABLE_OAUTH)
            ->where('providerType')->eq('gitlab')
            ->andWhere('providerID')->eq($gitlabID)
            ->andWhere('account')->eq($account)
            ->fetch('openID');
    }

    /**
     * Get gitlab project name of one gitlab project.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @access public
     * @return string|false
     */
    public function getProjectName($gitlabID, $projectID)
    {
        $project = $this->apiGetSingleProject($gitlabID, $projectID);
        if(is_object($project) and isset($project->name)) return $project->name;
        return false;
    }

    /**
     * Get reference option menus.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @access public
     * @return array
     */
    public function getReferenceOptions($gitlabID, $projectID)
    {
        $refList = array();

        $branches = $this->apiGetBranches($gitlabID, $projectID);
        foreach($branches as $branch) $refList[$branch->name] = "Branch::" . $branch->name;

        $tags = $this->apiGetTags($gitlabID, $projectID);
        foreach($tags as $tag) $refList[$tag->name] = "Tag::" . $tag->name;

        return $refList;

    }

    /**
     * Get branches.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @access public
     * @return array
     */
    public function getBranches($gitlabID, $projectID)
    {
        $rawBranches = $this->apiGetBranches($gitlabID, $projectID);

        $branches = array();
        foreach($rawBranches as $branch)
        {
            $branches[] = $branch->name;
        }
        return $branches;
    }

    /**
     * Create a gitlab.
     *
     * @access public
     * @return bool
     */
    public function create()
    {
        return $this->loadModel('pipeline')->create('gitlab');
    }

    /**
     * Update a gitlab.
     *
     * @param  int $id
     * @access public
     * @return bool
     */
    public function update($id)
    {
        return $this->loadModel('pipeline')->update($id);
    }

    /**
     * Send an api get request.
     *
     * @param  int|string $host gitlab server ID | gitlab host url.
     * @param  int        $api
     * @param  int        $data
     * @param  int        $options
     * @access public
     * @return object
     */
    public function apiGet($host, $api, $data = array(), $options = array())
    {
        if(is_numeric($host)) $host = $this->getApiRoot($host);
        if(strpos($host, 'http://') !== 0 and strpos($host, 'https://') !== 0) return false;

        $url = sprintf($host, $api);
        return json_decode(commonModel::http($url, $data, $options));
    }

    /**
     * Send an api post request.
     *
     * @param  int|string $host gitlab server ID | gitlab host url.
     * @param  int        $api
     * @param  int        $data
     * @param  int        $options
     * @access public
     * @return object
     */
    public function apiPost($host, $api, $data = array(), $options = array())
    {
        if(is_numeric($host)) $host = $this->getApiRoot($host);
        if(strpos($host, 'http://') !== 0 and strpos($host, 'https://') !== 0) return false;

        $url = sprintf($apiRoot, $api);
        return json_decode(commonModel::http($url, $data, $options));
    }

    /**
     * Get a list of to-do items by API.
     *
     * @docs   https://docs.gitlab.com/ee/api/todos.html
     * @param  int $gitlabID
     * @param  int $projectID
     * @param  int $sudo
     * @access public
     * @return object
     */
    public function apiGetTodoList($gitlabID, $projectID, $sudo)
    {
        $gitlab = $this->loadModel('gitlab')->getByID($gitlabID);
        if(!$gitlab) return '';
        $url = rtrim($gitlab->url, '/') . "/api/v4/todos?project_id=$projectID&type=MergeRequest&state=pending&private_token={$gitlab->token}&sudo={$sudo}";
        return json_decode(commonModel::http($url));
    }

    /**
     * Get current user.
     *
     * @param  string $host
     * @param  string $token
     * @access public
     * @return array
     */
    public function apiGetCurrentUser($host, $token)
    {
        $host = rtrim($host, '/') . "/api/v4%s?private_token=$token";
        return $this->apiGet($host, '/user');
    }

    /**
     * Get gitlab user list.
     *
     * @param  int    $gitlabID
     * @access public
     * @return array
     */
    public function apiGetUsers($gitlabID)
    {
        /* GitLab API '/users' can only return 20 users per page in default, so we use a loop to fetch all users. */
        $page     = 1;
        $response = array();
        $apiRoot  = $this->getApiRoot($gitlabID);
        while(true)
        {
            /* Also use `per_page=20` to fetch users in API. Fetch active users only. */
            $url      = sprintf($apiRoot, "/users") . "&page={$page}&per_page=20&active=true";
            $result   = json_decode(commonModel::http($url));
            if(!empty($result))
            {
                $response = array_merge($response, $result);
                $page += 1;
            }
            else
            {
                break;
            }
        }

        if(!$response) return array();

        $users = array();
        foreach($response as $gitlabUser)
        {
            $user           = new stdclass;
            $user->id       = $gitlabUser->id;
            $user->realname = $gitlabUser->name;
            $user->account  = $gitlabUser->username;
            $user->email    = $gitlabUser->email;
            $user->avatar   = $gitlabUser->avatar_url;

            $users[] = $user;
        }

        return $users;
    }

    /**
     * Get projects of one gitlab.
     *
     * @param  int $gitlabID
     * @access public
     * @return void
     */
    public function apiGetProjects($gitlabID)
    {
        $gitlab = $this->getByID($gitlabID);
        if(!$gitlab) return array();

        $host = rtrim($gitlab->url, '/');
        $host .= '/api/v4/projects';

        $allResults = array();
        for($page = 1; true; $page++)
        {
            $results = json_decode(commonModel::http($host . "?private_token={$gitlab->token}&simple=true&page={$page}&per_page=100"));
            if(empty($results) or $page > 10) break;
            $allResults = array_merge($allResults, $results);
        }

        return $allResults;
    }

    /**
     * Get single project by API.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @access public
     * @return object
     */
    public function apiGetSingleProject($gitlabID, $projectID)
    {
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/$projectID");
        return json_decode(commonModel::http($url));
    }

    /**
     * Get project users.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @access public
     * @return object
     */
    public function apiGetProjectUsers($gitlabID, $projectID)
    {
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/$projectID/users");
        return json_decode(commonModel::http($url));
    }

    /**
     * Get project all members(users and users in groups).
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @access public
     * @return object
     */
    public function apiGetProjectMembers($gitlabID, $projectID)
    {
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/$projectID/members/all");
        return json_decode(commonModel::http($url));
    }

    /**
     * Get the member detail in project.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @param  int $userID
     * @access public
     * @return object
     */
    public function apiGetProjectMember($gitlabID, $projectID, $userID)
    {
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/$projectID/members/all/$userID");
        return json_decode(commonModel::http($url));
    }

    /**
     * Get single branch by API.
     *
     * @param  int    $gitlabID
     * @param  int    $projectID
     * @param  string $branch
     * @access public
     * @return object
     */
    public function apiGetSingleBranch($gitlabID, $projectID, $branch)
    {
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/$projectID/repository/branches/$branch");
        return json_decode(commonModel::http($url));
    }

    /**
     * Get Forks of a project by API.
     *
     * @docs   https://docs.gitlab.com/ee/api/projects.html#list-forks-of-a-project
     * @param  int $gitlabID
     * @param  int $projectID
     * @access public
     * @return object
     */
    public function apiGetForks($gitlabID, $projectID)
    {
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/$projectID/forks");
        return json_decode(commonModel::http($url));
    }

    /**
     * Get upstream project by API.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @access public
     * @return void
     */
    public function apiGetUpstream($gitlabID, $projectID)
    {
        $currentProject = $this->apiGetSingleProject($gitlabID, $projectID);
        if(isset($currentProject->forked_from_project)) return $currentProject->forked_from_project;
        return array();
    }

    /**
     * Get hooks.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @access public
     * @return array
     */
    public function apiGetHooks($gitlabID, $projectID)
    {
        $apiRoot  = $this->getApiRoot($gitlabID);
        $apiPath  = "/projects/{$projectID}/hooks";
        $url      = sprintf($apiRoot, $apiPath);
        $response = json_decode(commonModel::http($url));
        return $response;
    }

    /**
     * Get specific hook by api.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @param  int $hookID
     * @access public
     * @return object
     */
    public function apiGetHook($gitlabID, $projectID, $hookID)
    {
        $apiRoot  = $this->getApiRoot($gitlabID);
        $apiPath  = "/projects/$projectID/hooks/$hookID)";
        $url      = sprintf($apiRoot, $apiPath);
        $response = commonModel::http($url);
        return $response;
    }

    /**
     * Create hook by api.
     *
     * @param  int    $gitlabID
     * @param  int    $projectID
     * @param  string $url
     * @access public
     * @return object
     */
    public function apiCreateHook($gitlabID, $projectID, $url)
    {
        $apiRoot = $this->getApiRoot($gitlabID);

        $accessToken = $this->dao->select('private as accessToken')->from(TABLE_PIPELINE)
            ->where('id')->eq($gitlabID)
            ->fetch('accessToken');

        $postData                          = new stdclass;
        $postData->enable_ssl_verification = "false";
        $postData->issues_events           = "true";
        $postData->merge_requests_events   = "true";
        $postData->push_events             = "true";
        $postData->tag_push_events         = "true";
        $postData->url                     = $url;
        $postData->token                   = $accessToken;

        $url = sprintf($apiRoot, "/projects/{$projectID}/hooks");
        return commonModel::http($url, $postData);
    }

    /**
     * Delete hook by api.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @param  int $hookID
     * @access public
     * @return null|object
     */
    public function apiDeleteHook($gitlabID, $projectID, $hookID)
    {
        $apiRoot = $this->getApiRoot($gitlabID);
        $url     = sprintf($apiRoot, "/projects/{$projectID}/hooks/{$hookID}");

        return commonModel::http($url, null, array(CURLOPT_CUSTOMREQUEST => 'delete'));
    }

    /**
     * Update hook by api.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @param  int $hookID
     * @access public
     * @return object
     */
    public function apiUpdateHook($gitlabID, $projectID, $hookID)
    {
        $apiRoot = $this->getApiRoot($gitlabID);

        $postData                          = new stdclass;
        $postData->enable_ssl_verification = "false";
        $postData->issues_events           = "true";
        $postData->merge_requests_events   = "true";
        $postData->push_events             = "true";
        $postData->tag_push_events         = "true";
        $postData->note_events             = "true";
        $postData->url                     = $url;
        $postData->token                   = $token;

        $url = sprintf($apiRoot, "/projects/{$projectID}/hooks/{$hookID}");
        return commonModel::http($url, $postData, $options = array(CURLOPT_CUSTOMREQUEST => 'PUT'));
    }

    /**
     * Create Label for gitlab project.
     *
     * @param  int    $gitlabID
     * @param  int    $projectID
     * @param  object $label
     * @access public
     * @return object
     */
    public function apiCreateLabel($gitlabID, $projectID, $label)
    {
        if(empty($label->name) or empty($label->color)) return false;

        $apiRoot = $this->getApiRoot($gitlabID);
        $url     = sprintf($apiRoot, "/projects/{$projectID}/labels/");
        return json_decode(commonModel::http($url, $label));
    }

    /**
     * Get labels of project by api.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @access public
     * @return array
     */
    public function apiGetLabels($gitlabID, $projectID)
    {
        $apiRoot  = $this->getApiRoot($gitlabID);
        $url      = sprintf($apiRoot, "/projects/{$projectID}/labels/");
        $response = commonModel::http($url);

        return json_decode($response);
    }

    /**
     * Delete a Label with labelName by api.
     *
     * @param  int    $gitlabID
     * @param  int    $projectID
     * @param  string $labelName
     * @access public
     * @return object
     */
    public function apiDeleteLabel($gitlabID, $projectID, $labelName)
    {
        $labels = $this->apiGetLabels($gitlabID, $projectID);
        foreach($labels as $label)
        {
            if($label->name == $labelName) $labelID = $label->id;
        }

        if(empty($labelID)) return false;

        $apiRoot = $this->getApiRoot($gitlabID);
        $url     = sprintf($apiRoot, "/projects/{$projectID}/labels/{$labelID}");

        return json_decode(commonModel::http($url, null, $options = array(CURLOPT_CUSTOMREQUEST => 'DELETE')));
    }

    /**
     * Get single issue by api.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @param  int $issueID
     * @access public
     * @return object
     */
    public function apiGetSingleIssue($gitlabID, $projectID, $issueID)
    {
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/$projectID/issues/{$issueID}");
        return json_decode(commonModel::http($url));
    }

    /**
     * Get gitlab issues by api.
     *
     * @param  int    $gitlabID
     * @param  int    $projectID
     * @param  string $options
     * @access public
     * @return object
     */
    public function apiGetIssues($gitlabID, $projectID, $options = null)
    {
        if($options)
        {
            $url = sprintf($this->getApiRoot($gitlabID), "/projects/{$projectID}/issues") . '&per_page=20' . $options;
        }
        else
        {
            $url = sprintf($this->getApiRoot($gitlabID), "/projects/{$projectID}/issues") . '&per_page=20';
        }

        return json_decode(commonModel::http($url));
    }

    /**
     * Create issue by api.
     *
     * @param  int    $gitlabID
     * @param  int    $projectID
     * @param  string $objectType
     * @param  int    $objectID
     * @param  object $object
     * @access public
     * @return object
     */
    public function apiCreateIssue($gitlabID, $projectID, $objectType, $objectID, $object)
    {
        if(!isset($object->id)) $object->id = $objectID;

        $issue = $this->parseObjectToIssue($gitlabID, $projectID, $objectType, $object);
        $label = $this->createZentaoObjectLabel($gitlabID, $projectID, $objectType, $objectID);
        if(isset($label->name)) $issue->labels = $label->name;

        foreach($this->config->gitlab->skippedFields->issueCreate[$objectType] as $field)
        {
            if(isset($issue->$field)) unset($issue->$field);
        }

        $apiRoot = $this->getApiRoot($gitlabID);
        $url     = sprintf($apiRoot, "/projects/{$projectID}/issues/");

        $response = json_decode(commonModel::http($url, $issue));
        if(!$response) return false;

        return $this->saveIssueRelation($objectType, $object, $gitlabID, $response);
    }

    /**
     * Update issue by gitlab API.
     *
     * @param  int    $gitlabID
     * @param  int    $projectID
     * @param  int    $issueID
     * @param  string $objectType
     * @param  object $object
     * @param  int    $objectID
     * @access public
     * @return object
     */
    public function apiUpdateIssue($gitlabID, $projectID, $issueID, $objectType, $object, $objectID = null)
    {
        $oldObject = clone $object;

        /* Get full object when desc is empty. */
        if(!isset($object->description) or (isset($object->description) and $object->description == '')) $object = $this->loadModel($objectType)->getByID($objectID);
        foreach($oldObject as $index => $attribute)
        {
            if($index != 'description') $object->$index = $attribute;
        }

        if(!isset($object->id) && !empty($objectID)) $object->id = $objectID;
        $issue   = $this->parseObjectToIssue($gitlabID, $projectID, $objectType, $object);
        $apiRoot = $this->getApiRoot($gitlabID);
        $url     = sprintf($apiRoot, "/projects/{$projectID}/issues/{$issueID}");
        return json_decode(commonModel::http($url, $issue, $options = array(CURLOPT_CUSTOMREQUEST => 'PUT')));
    }

    /**
     * Delete an issue by api.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @param  int $issueID
     * @access public
     * @return object
     */
    public function apiDeleteIssue($gitlabID, $projectID, $issueID)
    {
        $apiRoot = $this->getApiRoot($gitlabID);
        $url     = sprintf($apiRoot, "/projects/{$projectID}/issues/{$issueID}");
        return json_decode(commonModel::http($url, null, array(CURLOPT_CUSTOMREQUEST => 'DELETE')));
    }

    /**
     * Create a new pipeline by api.
     *
     * @param  int    $gitlabID
     * @param  int    $projectID
     * @param  object $params
     * @access public
     * @return object
     * @docment https://docs.gitlab.com/ee/api/pipelines.html#create-a-new-pipeline
     */
    public function apiCreatePipeline($gitlabID, $projectID, $params)
    {
        if(!is_string($params)) $params = json_encode($params);
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/{$projectID}/pipeline");
        return json_decode(commonModel::http($url, $params, null, array("Content-Type: application/json")));
    }

    /**
     * Get single pipline by api.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @param  int $pipelineID
     * @access public
     * @return object
     * @docment https://docs.gitlab.com/ee/api/pipelines.html#get-a-single-pipeline
     */
    public function apiGetSinglePipeline($gitlabID, $projectID, $pipelineID)
    {
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/{$projectID}/pipelines/{$pipelineID}");
        return json_decode(commonModel::http($url));
    }

    /**
     * List pipeline jobs by api.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @param  int $pipelineID
     * @return object
     * @docment https://docs.gitlab.com/ee/api/jobs.html#list-pipeline-jobs
     */
    public function apiGetJobs($gitlabID, $projectID, $pipelineID)
    {
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/{$projectID}/pipelines/{$pipelineID}/jobs");
        return json_decode(commonModel::http($url));
    }

    /**
     * Get a single job by api.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @param  int $jobID
     * @return object
     * @docment https://docs.gitlab.com/ee/api/jobs.html#get-a-single-job
     */
    public function apiGetSingleJob($gitlabID, $projectID, $jobID)
    {
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/{$projectID}/jobs/{$jobID}");
        return json_decode(commonModel::http($url));
    }

    /**
     * Get a log file by api.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @param  int $jobID
     * @return string
     * @docment https://docs.gitlab.com/ee/api/jobs.html#get-a-log-file
     */
    public function apiGetJobLog($gitlabID, $projectID, $jobID)
    {
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/{$projectID}/jobs/{$jobID}/trace");
        return commonModel::http($url);
    }

    /**
     * Get project repository branches by api.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @access public
     * @return object
     */
    public function apiGetBranches($gitlabID, $projectID)
    {
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/{$projectID}/repository/branches");
        return json_decode(commonModel::http($url));
    }

    /**
     * Get project repository tags by api.
     *
     * @param  int $gitlabID
     * @param  int $projectID
     * @access public
     * @return object
     */
    public function apiGetTags($gitlabID, $projectID)
    {
        $url = sprintf($this->getApiRoot($gitlabID), "/projects/{$projectID}/repository/tags");
        return json_decode(commonModel::http($url));
    }

    /**
     * Check webhook token by HTTP_X_GITLAB_TOKEN.
     *
     * @access public
     * @return void
     */
    public function webhookCheckToken()
    {
        $gitlab = $this->getByID($this->get->gitlab);
        if($gitlab->private != $_SERVER["HTTP_X_GITLAB_TOKEN"]) die('Token error.');
    }

    /**
     * Parse webhook body function.
     *
     * @param  object $body
     * @param  int    $gitlabID
     * @access public
     * @return object
     */
    public function webhookParseBody($body, $gitlabID)
    {
        $type = zget($body, 'object_kind', '');
        if(!$type or !is_callable(array($this, "webhookParse{$type}"))) return false;
        // fix php 8.0 bug. link: https://www.php.net/manual/zh/function.call-user-func-array.php#125953
        //return call_user_func_array(array($this, "webhookParse{$type}"), array('body' => $body, $gitlabID));
        return call_user_func_array(array($this, "webhookParse{$type}"), [$body, $gitlabID]);
    }

    /**
     * Parse Webhook issue.
     *
     * @param  object $body
     * @param  int    $gitlabID
     * @access public
     * @return object
     */
    public function webhookParseIssue($body, $gitlabID)
    {
        $object = $this->webhookParseObject($body->labels);
        if(empty($object)) return null;

        $issue             = new stdclass;
        $issue->action     = $body->object_attributes->action . $body->object_kind;
        $issue->issue      = $body->object_attributes;
        $issue->changes    = $body->changes;
        $issue->objectType = $object->type;
        $issue->objectID   = $object->id;

        $issue->issue->objectType = $object->type;
        $issue->issue->objectID   = $object->id;

        /* Parse markdown description to html. */
        $issue->issue->description = $this->app->loadClass('hyperdown')->makeHtml($issue->issue->description);

        if(!isset($this->config->gitlab->maps->{$object->type})) return false;
        $issue->object = $this->issueToZentaoObject($issue->issue, $gitlabID, $body->changes);
        return $issue;
    }

    /**
     * Webhook parse note.
     *
     * @param  object $body
     * @access public
     * @return void
     */
    public function webhookParseNote($body)
    {
        //@todo
    }

    /**
     * Webhook sync issue.
     *
     * @param  object $issue
     * @param  int    $objectType
     * @param  int    $objectID
     * @access public
     * @return void
     */
    public function webhookSyncIssue($gitlabID, $issue)
    {
        $tableName = zget($this->config->gitlab->objectTables, $issue->objectType, '');
        if($tableName) $this->dao->update($tableName)->data($issue->object)->where('id')->eq($issue->objectID)->exec();
        return !dao::isError();
    }

    /**
     * Parse zentao object from labels.
     *
     * @param  array $labels
     * @access public
     * @return object
     */
    public function webhookParseObject($labels)
    {
        $object     = null;
        $objectType = '';
        foreach($labels as $label)
        {
            if(preg_match($this->config->gitlab->labelPattern->story, $label->title)) $objectType = 'story';
            if(preg_match($this->config->gitlab->labelPattern->task, $label->title)) $objectType = 'task';
            if(preg_match($this->config->gitlab->labelPattern->bug, $label->title)) $objectType = 'bug';

            if($objectType)
            {
                list($prefix, $id) = explode('/', $label->title);
                $object       = new stdclass;
                $object->id   = $id;
                $object->type = $objectType;
            }
        }

        return $object;
    }

    /**
     * Process webhook issue assign option.
     *
     * @param  object $issue
     * @access public
     * @return bool
     */
    public function webhookAssignIssue($issue)
    {
        $tableName = zget($this->config->gitlab->objectTables, $issue->objectType, '');
        if(!$tableName) return false;

        $data               = $issue->object;
        $data->assignedDate = $issue->object->lastEditedDate;
        $data->assignedTo   = $issue->object->assignedTo;

        $this->dao->update($tableName)->data($data)->where('id')->eq($issue->objectID)->exec();
        if(dao::isError()) return false;

        $oldObject = $this->dao->findById($issue->objectID)->from($tableName)->fetch();
        $changes   = common::createChanges($oldObject, $data);
        $actionID  = $this->loadModel('action')->create($issue->objectType, $issue->objectID, 'Assigned', "Assigned by webhook by gitlab issue : {$issue->issue->url}", $data->assignedTo);
        $this->action->logHistory($actionID, $changes);

        return true;
    }

    /**
     * Process issue close option.
     *
     * @param  object $issue
     * @access public
     * @return bool
     */
    public function webhookCloseIssue($issue)
    {
        $tableName = zget($this->config->gitlab->objectTables, $issue->objectType, '');
        if(!$tableName) return false;

        $data             = $issue->object;
        $data->assignedTo = 'closed';
        $data->status     = 'closed';
        $data->closedBy   = $issue->object->lastEditedBy;
        $data->closedDate = $issue->object->lastEditedDate;

        $this->dao->update($tableName)->data($data)->where('id')->eq($issue->objectID)->exec();
        if(dao::isError()) return false;

        $oldObject = $this->dao->findById($issue->objectID)->from($tableName)->fetch();
        $changes   = common::createChanges($oldObject, $data);
        $actionID  = $this->loadModel('action')->create($issue->objectType, $issue->objectID, 'Closed', "Closed by gitlab issue: {$issue->issue->url}.");
        $this->action->logHistory($actionID, $changes);
        return true;
    }


    /**
     * Create zentao object label for gitlab project.
     *
     * @param  int    $gitlabID
     * @param  int    $projectID
     * @param  string $objectType
     * @param  string $objectID
     * @access public
     * @return object
     */
    public function createZentaoObjectLabel($gitlabID, $projectID, $objectType, $objectID)
    {
        $label              = new stdclass;
        $label->name        = sprintf($this->config->gitlab->zentaoObjectLabel->name, $objectType, $objectID);
        $label->color       = $this->config->gitlab->zentaoObjectLabel->color->$objectType;
        $label->description = common::getSysURL() . helper::createLink($objectType, 'view', "id={$objectID}");

        return $this->apiCreateLabel($gitlabID, $projectID, $label);
    }

    /**
     * Create relationship between zentao product and  gitlab project.
     *
     * @param  array $products
     * @param  int   $gitlabID
     * @param  int   $gitlabProjectID
     * @access public
     * @return void
     */
    public function saveProjectRelation($products, $gitlabID, $gitlabProjectID)
    {
        $programs = $this->dao->select('id,program')->from(TABLE_PRODUCT)->where('id')->in($products)->fetchPairs();

        $relation            = new stdclass;
        $relation->execution = 0;
        $relation->AType     = 'gitlab';
        $relation->AID       = $gitlabID;
        $relation->AVersion  = '';
        $relation->relation  = 'interrated';
        $relation->BType     = 'gitlabProject';
        $relation->BID       = $gitlabProjectID;
        $relation->BVersion  = '';
        $relation->extra     = '';

        foreach($products as $product)
        {
            $relation->project = zget($programs, $product, 0);
            $relation->product = $product;
            $this->dao->replace(TABLE_RELATION)->data($relation)->exec();
        }
        return true;
    }

    /**
     * Delete project relation.
     *
     * condition: when user deleting a repo.
     *
     * @param  int $repoID
     * @access public
     * @return void
     */
    public function deleteProjectRelation($repoID)
    {
        $repo = $this->dao->select('product,path as gitlabProjectID,client as gitlabID')->from(TABLE_REPO)
            ->where('id')->eq($repoID)
            ->andWhere('deleted')->eq(0)
            ->fetch();
        if(empty($repo)) return false;

        $productIDList = explode(',', $repo->product);
        foreach($productIDList as $product)
        {
            $this->dao->delete()->from(TABLE_RELATION)
                ->where('product')->eq($product)
                ->andWhere('AType')->eq('gitlab')
                ->andWhere('BType')->eq('gitlabProject')
                ->andWhere('relation')->eq('interrated')
                ->andWhere('AID')->eq($repo->gitlabID)
                ->andWhere('BID')->eq($repo->gitlabProjectID)
                ->exec();
        }
    }

    /**
     * Create webhook for zentao.
     *
     * @param  int $products
     * @param  int $gitlabID
     * @param  int $projectID
     * @access public
     * @return bool
     */
    public function initWebhooks($products, $gitlabID, $projectID)
    {
        $gitlab   = $this->getByID($gitlabID);
        $webhooks = $this->apiGetHooks($gitlabID, $projectID);
        foreach($products as $index => $product)
        {
            $url = sprintf($this->config->gitlab->webhookURL, commonModel::getSysURL(), $product, $gitlabID);
            foreach($webhooks as $webhook) if($webhook->url == $url) continue;
            $response = $this->apiCreateHook($gitlabID, $projectID, $url);
        }

        return true;
    }

    /**
     * Delete an issue from zentao and gitlab.
     *
     * @param  string $objectType
     * @param  int    $objectID
     * @param  int    $issueID
     * @access public
     * @return void
     */
    public function deleteIssue($objectType, $objectID, $issueID)
    {
        $object   = $this->loadModel($objectType)->getByID($objectID);
        $relation = $this->getRelationByObject($objectType, $objectID);
        if(!empty($relation)) $this->dao->delete()->from(TABLE_RELATION)->where('id')->eq($relation->id)->exec();
        $this->apiDeleteIssue($relation->gitlabID, $relation->projectID, $issueID);
    }

    /**
     * Save synced issue to relation table.
     *
     * @param  string $objectType
     * @param  object $object
     * @param  int    $gitlabID
     * @param  object $issue
     * @access public
     * @return void
     */
    public function saveIssueRelation($objectType, $object, $gitlabID, $issue)
    {
        if(empty($issue->iid) or empty($issue->project_id)) return false;

        $relation            = new stdclass;
        $relation->product   = zget($object, 'product', 0);
        $relation->execution = zget($object, 'execution', 0);
        $relation->AType     = $objectType;
        $relation->AID       = $object->id;
        $relation->AVersion  = '';
        $relation->relation  = 'gitlab';
        $relation->BType     = 'issue';
        $relation->BID       = $issue->iid;
        $relation->BVersion  = $issue->project_id;
        $relation->extra     = $gitlabID;
        $this->dao->replace(TABLE_RELATION)->data($relation)->exec();
    }

    /**
     * Save imported issue.
     *
     * @param  int    $gitlabID
     * @param  int    $projectID
     * @param  string $objectType
     * @param  int    $objectID
     * @param  object $issue
     * @access public
     * @return void
     */
    public function saveImportedIssue($gitlabID, $projectID, $objectType, $objectID, $issue, $object)
    {
        $label = $this->createZentaoObjectLabel($gitlabID, $projectID, $objectType, $objectID);
        $data  = new stdclass;
        if(isset($label->name)) $data->labels = $label->name;

        $apiRoot = $this->getApiRoot($gitlabID);
        $url     = sprintf($apiRoot, "/projects/{$projectID}/issues/{$issue->iid}");
        commonModel::http($url, $data, $options = array(CURLOPT_CUSTOMREQUEST => 'PUT'));
        $this->saveIssueRelation($objectType, $object, $gitlabID, $issue);
    }

    /**
     * Parse task to issue.
     *
     * @param  int    $gitlabID
     * @param  int    $gitlabProjectID
     * @param  object $task
     * @access public
     * @return object
     */
    public function taskToIssue($gitlabID, $gitlabProjectID, $task)
    {
        $map         = $this->config->gitlab->maps->task;
        $gitlabUsers = $this->getUserAccountIdPairs($gitlabID);

        $issue = new stdclass;
        foreach($map as $taskField => $config)
        {
            $value = '';
            list($field, $optionType, $options) = explode('|', $config);

            if($optionType == 'field') $value = $task->$taskField;
            if($optionType == 'userPairs') $value = zget($gitlabUsers, $task->$taskField);
            if($optionType == 'configItems') $value = zget($this->config->gitlab->$options, $task->$taskField, '');

            if($value) $issue->$field = $value;
        }

        if($isset($issue->assignee_id) and $issue->assignee_id == 'closed') unset($issue->assignee_id);

        /* issue->state is null when creating it, we should put status_event when updating it. */
        if(isset($issue->state) and $issue->state == 'closed') $issue->state_event = 'close';
        if(isset($issue->state) and $issue->state == 'opened') $issue->state_event = 'reopen';

        /* Append this object link in zentao to gitlab issue description. */
        $zentaoLink         = common::getSysURL() . helper::createLink('task', 'view', "taskID={$task->id}");
        $issue->description = $issue->description . "\n\n" . $zentaoLink;

        return $issue;
    }

    /**
     * Parse story to issue.
     *
     * @param  int    $gitlabID
     * @param  int    $gitlabProjectID
     * @param  object $story
     * @access public
     * @return object
     */
    public function storyToIssue($gitlabID, $gitlabProjectID, $story)
    {
        $map         = $this->config->gitlab->maps->story;
        $issue       = new stdclass;
        $gitlabUsers = $this->getUserAccountIdPairs($gitlabID);
        if(empty($gitlabUsers)) return false;

        foreach($map as $storyField => $config)
        {
            $value = '';
            list($field, $optionType, $options) = explode('|', $config);
            if($optionType == 'field') $value = $story->$storyField;
            if($optionType == 'fields') $value = $story->$storyField . "\n\n" . $story->$options;
            if($optionType == 'userPairs')
            {
                $value = zget($gitlabUsers, $story->$storyField);
            }
            if($optionType == 'configItems')
            {
                $value = zget($this->config->gitlab->$options, $story->$storyField, '');
            }
            if($value) $issue->$field = $value;
        }

        if($issue->assignee_id == 'closed') unset($issue->assignee_id);

        /* issue->state is null when creating it, we should put status_event when updating it. */
        if(isset($issue->state) and $issue->state == 'closed') $issue->state_event = 'close';
        if(isset($issue->state) and $issue->state == 'opened') $issue->state_event = 'reopen';

        /* Append this object link in zentao to gitlab issue description */
        $zentaoLink         = common::getSysURL() . helper::createLink('story', 'view', "storyID={$story->id}");
        $issue->description = $issue->description . "\n\n" . $zentaoLink;

        return $issue;
    }

    /**
     * Parse bug to issue.
     *
     * @param  int    $gitlabID
     * @param  int    $projectID
     * @param  object $bug
     * @access public
     * @return object
     */
    public function bugToIssue($gitlabID, $projectID, $bug)
    {
        $map         = $this->config->gitlab->maps->bug;
        $issue       = new stdclass;
        $gitlabUsers = $this->getUserAccountIdPairs($gitlabID);
        if(empty($gitlabUsers)) return false;

        foreach($map as $bugField => $config)
        {
            $value = '';
            list($field, $optionType, $options) = explode('|', $config);
            if($optionType == 'field') $value = $bug->$bugField;
            if($optionType == 'fields') $value = $bug->$bugField . "\n\n" . $bug->$options;
            if($optionType == 'userPairs')
            {
                $value = zget($gitlabUsers, $bug->$bugField);
            }
            if($optionType == 'configItems')
            {
                $value = zget($this->config->gitlab->$options, $bug->$bugField, '');
            }
            if($value) $issue->$field = $value;
        }

        if($issue->assignee_id == 'closed') unset($issue->assignee_id);

        /* issue->state is null when creating it, we should put status_event when updating it. */
        if(isset($issue->state) and $issue->state == 'closed') $issue->state_event = 'close';
        if(isset($issue->state) and $issue->state == 'opened') $issue->state_event = 'reopen';

        /* Append this object link in zentao to gitlab issue description */
        $zentaoLink         = common::getSysURL() . helper::createLink('bug', 'view', "bugID={$bug->id}");
        $issue->description = $issue->description . "\n\n" . $zentaoLink;

        return $issue;
    }

    /**
     * Parse zentao object to issue. object can be task, bug and story.
     *
     * @param  int    $gitlabID
     * @param  int    $projectID
     * @param  string $objectType
     * @param  object $object
     * @access public
     * @return object
     */
    public function parseObjectToIssue($gitlabID, $projectID, $objectType, $object)
    {
        $gitlabUsers = $this->getUserAccountIdPairs($gitlabID);
        if(empty($gitlabUsers)) return false;
        $issue = new stdclass;
        $map   = $this->config->gitlab->maps->$objectType;
        foreach($map as $objectField => $config)
        {
            $value = '';
            list($field, $optionType, $options) = explode('|', $config);
            if($optionType == 'field') $value = $object->$objectField;
            if($optionType == 'fields') $value = $object->$objectField . "\n\n" . $object->$options;
            if($optionType == 'userPairs')
            {
                $value = zget($gitlabUsers, $object->$objectField);
            }
            if($optionType == 'configItems')
            {
                $value = zget($this->config->gitlab->$options, $object->$objectField, '');
            }
            if($value) $issue->$field = $value;
        }
        if(isset($issue->assignee_id) and $issue->assignee_id == 'closed') unset($issue->assignee_id);

        /* issue->state is null when creating it, we should put status_event when updating it. */
        if(isset($issue->state) and $issue->state == 'closed') $issue->state_event = 'close';
        if(isset($issue->state) and $issue->state == 'opened') $issue->state_event = 'reopen';

        /* Append this object link in zentao to gitlab issue description */
        $zentaoLink = common::getSysURL() . helper::createLink($objectType, 'view', "id={$object->id}");
        if(strpos($issue->description, $zentaoLink) == false) $issue->description = $issue->description . "\n\n" . $zentaoLink;

        return $issue;
    }

    /**
     * Parse issue to zentao object.
     *
     * @param  object $issue
     * @param  int    $gitlabID
     * @param  object $changes
     * @access public
     * @return object
     */
    public function issueToZentaoObject($issue, $gitlabID, $changes = null)
    {
        if(!isset($this->config->gitlab->maps->{$issue->objectType})) return null;

        if(isset($changes->assignees)) $changes->assignee_id = true;
        $maps        = $this->config->gitlab->maps->{$issue->objectType};
        $gitlabUsers = $this->getUserIdAccountPairs($gitlabID);

        $object     = new stdclass;
        $object->id = $issue->objectID;
        foreach($maps as $zentaoField => $config)
        {
            $value = '';
            list($gitlabField, $optionType, $options) = explode('|', $config);
            if(!isset($changes->$gitlabField) and $object->id != 0) continue;
            if($optionType == 'field' or $optionType == 'fields') $value = $issue->$gitlabField;
            if($options == 'date') $value = $value ? date('Y-m-d', strtotime($value)) : '0000-00-00';
            if($options == 'datetime') $value = $value ? date('Y-m-d H:i:s', strtotime($value)) : '0000-00-00 00:00:00';
            if($optionType == 'userPairs' and isset($issue->$gitlabField)) $value = zget($gitlabUsers, $issue->$gitlabField);
            if($optionType == 'configItems' and isset($issue->$gitlabField)) $value = array_search($issue->$gitlabField, $this->config->gitlab->$options);

            /* Execute this line even `$value == ""`, such as `$issue->description == ""`. */
            if($value or $value == "") $object->$zentaoField = $value;

            if($gitlabField == "description") $object->$zentaoField .= "<br><br><a href=\"{$issue->web_url}\" target=\"_blank\">{$issue->web_url}</a>";
        }
        return $object;
    }
}
