Ext.define('SenchaTouchMVC.view.Main', {
    extend: 'Ext.TabPanel', 
    xtype: 'mainpanel', 
    

    config: {
        fullscreen: true,
        tabBarPosition: 'bottom',
        items: [
            {
                title: 'Benutzer',
                xtype: 'userview',
                iconCls: 'info'
            },
            {
                title: 'Benutzer',
                xtype: 'postlist',
                iconCls: 'info'
            }
        ]
    }
});