Ext.define('SenchaTouchMVC.controller.Main', {
    extend: 'Ext.app.Controller',
    requires: [
        'SenchaTouchMVC.view.AddressView',
        'SenchaTouchMVC.view.AddressList',
        'SenchaTouchMVC.view.AddressDetail'
    ],
    config: {
        touchstarttime: 0,
        refs: {
            addressview: 'addressview',
            mainpanel: 'mainpanel'
        },
        control: {
            'addresslist': {
                itemtap: 'showDetail'
            }
        }
    },
    showDetail: function(list, index, item, record) 
    {
        this.getAddressview().push(
        {
            xtype: 'addressdetail',
            title: record.get('surname')+', '+record.get('name'),
            data: record.getData()
        });
        
    }
});
