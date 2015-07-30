Ext.define('SenchaTouchMVC.view.AddressDetail', {
    extend: 'Ext.Container',
    xtype: 'addressdetail',
    updateData : function(data) {
        this.callParent(arguments);
        var panel = this.down('panel');
        panel.setData(data);
    },
    
    config: {
        title: 'Details',
        
        scrollable: true,
        
        layout: {
            type: 'vbox',
            align: 'stretch'
        },
        items: [
            
            {
                styleHtmlContent: true,
                layout: {
                    type: 'fit'
                },
                xtype: 'panel',
                tpl: [
                    '<h3>{name} {surname}</h3>Raum: {room}<br/><br/>Telefon: {phone}'
                ]
            }
            
        ]
    }
});
