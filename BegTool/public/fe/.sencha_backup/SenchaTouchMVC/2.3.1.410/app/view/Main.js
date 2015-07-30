Ext.define('SenchaTouchMVC.view.Main', {
    extend: 'Ext.TabPanel', 
    xtype: 'mainpanel', 
    requires: [
        'SenchaTouchMVC.view.AddressView',
        'SenchaTouchMVC.view.AddressList',
        'SenchaTouchMVC.view.AddressDetail',
        'SenchaTouchMVC.view.TemplateView'
    ],

    config: {
        fullscreen: true,
        tabBarPosition: 'bottom',
        items: [
            {
                title: 'Home',
                iconCls: 'home',
                xtype: 'templateview',
                templateFile: 'resources/templates/start.tpl'
                
            },
            {
                title: 'Heute',
                iconCls: 'home',
                xtype: 'templateview',
                templateFile: 'resources/templates/heute.tpl'
                
            },
            {
                title: 'Bilder',
                xtype: 'addressview',
                iconCls: 'favorites'
            },
            {
                title: 'Hilfe',
                xtype: 'templateview',
                templateFile: 'resources/templates/hilfe.tpl',
                iconCls: 'info'
            }
            ,
            {
                title: 'Hallo',
                xtype: 'templateview',
                templateFile: 'resources/templates/hallo.tpl',
                iconCls: 'star'
            }
        ]
    }
});