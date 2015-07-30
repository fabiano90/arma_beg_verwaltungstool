Ext.define('SenchaTouchMVC.controller.Post', {
    extend: 'SenchaTouchMVC.controller.Standard',
    requires: [
        'SenchaTouchMVC.controller.Standard',

        'SenchaTouchMVC.view.PostList',

    ],
    config: {
        storeKey: 'userStore',
        formKey: 'userform',
        titleKey: 'lastname',
        modelKey: 'SenchaTouchMVC.model.User',
        touchstarttime: 0,
        refs: {
            itemlist: 'userlist',
            mainpanel: 'mainpanel',
            itemsave: 'userform #usersave',
            itemnew: 'userview #usernew',
            itemdelete: 'userform #userdelete',
            
        }
    }
});
