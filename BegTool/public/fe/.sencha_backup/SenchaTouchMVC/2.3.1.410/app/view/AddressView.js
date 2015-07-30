Ext.define('SenchaTouchMVC.view.AddressView', {
    extend: 'Ext.navigation.View',
    xtype: 'addressview',
    requires: [
        'SenchaTouchMVC.view.AddressList'
    ],
    fullscreen: true,
    config: {
        items: [
        {
            xtype: 'addresslist'
        }
    ]
          
    }
    
});