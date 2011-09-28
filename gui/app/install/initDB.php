//
// Creates permission per group/controller action
// Run from ff_users controller, remove when done.
//
//
   function initDB() {
    $group =& $this->FfUser->Group;

    //Allow Admins to everything
    $group->id = 1;     
    $this->Acl->allow($group, 'controllers');
 
    //Allow Users to read but not write
    $group->id = 2;
    $this->Acl->deny($group, 'controllers');

    //Polls
    $this->Acl->deny($group, 'controllers/Polls');
    $this->Acl->allow($group, 'controllers/Polls/index');
    $this->Acl->allow($group, 'controllers/Polls/view');


    //Leave a message
    $this->Acl->deny($group, 'controllers/Messages');
    $this->Acl->allow($group, 'controllers/Messages/index');
    $this->Acl->allow($group, 'controllers/Messages/disp');
    $this->Acl->allow($group, 'controllers/Messages/archive');
    $this->Acl->allow($group, 'controllers/Messages/edit');
    $this->Acl->allow($group, 'controllers/Messages/view');


    //Categories
    $this->Acl->deny($group, 'controllers/Categories');
    $this->Acl->allow($group, 'controllers/Categories/index');

    //Tags
    $this->Acl->deny($group, 'controllers/Tags');
    $this->Acl->allow($group, 'controllers/Tags/index');


    //Leave-a-message
    $this->Acl->deny($group, 'controllers/LmMenus');
    $this->Acl->allow($group, 'controllers/LmMenus/index');

    //Incoming SMS
    $this->Acl->deny($group, 'controllers/Bin');
    $this->Acl->allow($group, 'controllers/Bin/index');

    //Language Selectors and Voice menus
    $this->Acl->deny($group, 'controllers/IvrMenus');
    $this->Acl->allow($group, 'controllers/IvrMenus/index');
    $this->Acl->allow($group, 'controllers/IvrMenus/selectors');

    //Content
    $this->Acl->deny($group, 'controllers/Nodes');
    $this->Acl->allow($group, 'controllers/Nodes/index');

    //Users
    $this->Acl->deny($group, 'controllers/Users');
    $this->Acl->allow($group, 'controllers/Users/index');
    $this->Acl->allow($group, 'controllers/Users/view');

    //Phone books
    $this->Acl->deny($group, 'controllers/PhoneBooks');
    $this->Acl->allow($group, 'controllers/PhoneBooks/index');

    //System data (CDR)
    $this->Acl->deny($group, 'controllers/Cdr');
    $this->Acl->allow($group, 'controllers/Cdr/index');
    $this->Acl->allow($group, 'controllers/Cdr/statistics');
    $this->Acl->allow($group, 'controllers/Cdr/general');
    $this->Acl->allow($group, 'controllers/Cdr/overview');


    //Monitor IVR
    $this->Acl->deny($group, 'controllers/MonitorIvr');
    $this->Acl->allow($group, 'controllers/MonitorIvr/index');

    
    //Dashboard
    $this->Acl->deny($group, 'controllers/Processes');
    $this->Acl->allow($group, 'controllers/Processes/index');
    $this->Acl->allow($group, 'controllers/Processes/refresh');
    $this->Acl->allow($group, 'controllers/Processes/system');
    
    //Settings
    $this->Acl->deny($group, 'controllers/Settings');
    $this->Acl->allow($group, 'controllers/Settings/index');

    //GSM channels
    $this->Acl->deny($group, 'controllers/Channels');
    $this->Acl->allow($group, 'controllers/Channels/index');
    $this->Acl->allow($group, 'controllers/Channels/refresh');
    $this->Acl->deny($group, 'controllers/OfficeRoute');
    $this->Acl->allow($group, 'controllers/OfficeRoute/refresh');

    //Logs
    $this->Acl->deny($group, 'controllers/Logs');

    //Authentication
    $this->Acl->deny($group, 'controllers/FfUsers');
    $this->Acl->deny($group, 'controllers/Groups');

    echo "All done";
    exit;
}