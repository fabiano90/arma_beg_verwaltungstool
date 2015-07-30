Ext.define('SenchaTouchMVC.controller.Standard', {
    extend: 'Ext.app.Controller',
    config: {
        touchstarttime: 0,
        
        control: {
            'itemlist': {
                itemtap: 'showDetail'
                //itemdoubletap: 'test'
            },
            'itemsave': {
                tap: 'save'
            },
            'itemnew': {
                tap: 'new'
            },
            'itemdelete': {
                tap: 'delete'
            }
            
        }
    },
    save: function(button, e, eOpts) {
        var that = this;
        var form = this.getItemform();
        var record = form.getRecord();
        var store = Ext.getStore(this.config.storeKey);
        var values = form.getValues();  

        record.set(values); 
        
        record.save({
            success: function( ) 
            {
                store.load();
                that.getItemview().pop();
            }

        });
    },
    new: function(button, e, eOpts) {
        var that = this;
        var record = Ext.create(that.config.modelKey);
        this.getItemview().push(
        {
            xtype: that.config.formKey,
            title: record.get(that.config.formKey),
            data: record.getData()
        });
        var form = this.getItemform();
        form.reset();
        this.getItemform().setRecord(record);

        
    },
    delete: function(button, e, eOpts) {
        var that = this;
        var form = this.getItemform();
        var record = form.getRecord();
        var store = Ext.getStore(this.config.storeKey); 
        Ext.Msg.confirm('Wirklich löschen?', 'Möchten Sie diesen Eintrag wirklich löschen?', function (result) {
            if (result == 'yes')
            {
                record.erase({
                    success: function( ) 
                    {
                        store.load();
                        that.getItemview().pop();
                    }

                });            
            }
        });
            
    },

    showDetail: function(list, index, item, record) 
    {
        var that = this;
        this.getItemview().push(
        {
            xtype: that.config.formKey,
            title: record.get(that.config.titleKey),
            data: record.getData()
        });
        this.getItemform().setRecord(record);
        
    }
});
