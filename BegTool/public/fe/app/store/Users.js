Ext.define('SenchaTouchMVC.store.Users', {
    extend: 'Ext.data.Store',
    config: {
        model: 'SenchaTouchMVC.model.User',
        sorters: [
              {
                property: 'lastname',
                direction: 'DESC'
              }
        ],
        grouper : function(record) {
            return record.get('lastname')[0];
        },
        storeId: 'userStore',
        autoLoad: true
    }
});
