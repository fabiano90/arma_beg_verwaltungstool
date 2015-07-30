Ext.define('SenchaTouchMVC.view.UserList', {
    extend: 'Ext.List',
    xtype: 'userlist',
    config: {
        scrollToTopOnRefresh: true,
        disableSelection: true,
        title: 'Benutzer',
        grouped: true,
        layout: 'fit',
        itemTpl: '{lastname}, {firstname}',
        
        store: 'userStore'/*,
        listeners: {
            painted: function (element, options) {
                this.refresh();
            }
        }*/
    }
});
