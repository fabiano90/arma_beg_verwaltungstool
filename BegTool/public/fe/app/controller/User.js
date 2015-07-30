Ext.define('SenchaTouchMVC.controller.User', {
    extend: 'SenchaTouchMVC.controller.Standard',
    requires: [
        'SenchaTouchMVC.controller.Standard',
        'SenchaTouchMVC.view.UserView',
        'SenchaTouchMVC.view.UserList',
        'SenchaTouchMVC.view.UserForm'
    ],
    config: {
        storeKey: 'userStore',
        formKey: 'userform',
        titleKey: 'lastname',
        modelKey: 'SenchaTouchMVC.model.User',
        touchstarttime: 0,
        refs: {
            itemlist: 'userlist',
            itemview: 'userview',
            mainpanel: 'mainpanel',
            itemsave: 'userform #usersave',
            itemnew: 'userview #usernew',
            itemdelete: 'userform #userdelete',
            
            itemform: 'userform'
        }
    }
});
