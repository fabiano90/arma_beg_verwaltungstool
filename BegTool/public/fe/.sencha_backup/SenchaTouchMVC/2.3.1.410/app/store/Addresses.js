Ext.define('SenchaTouchMVC.store.Addresses', {
    extend: 'Ext.data.Store',
    config: {
        model: 'SenchaTouchMVC.model.Address',
        sorters: [
              {
                property: 'name',
                direction: 'DESC'
              }
        ],
        grouper : function(record) {
            return record.get('name')[0];
        },
        storeId: 'addressStore',
        proxy: {
            type: 'ajax',
            url: 'resources/json/addresses.json',
            reader: {
                type: 'json',
                id  : 'id'
            }
        },
        autoLoad:true
    }
});
