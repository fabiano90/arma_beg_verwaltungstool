Ext.define('SenchaTouchMVC.store.Posts', {
    extend: 'Ext.data.Store',
    config: {
        model: 'SenchaTouchMVC.model.Post',
        sorters: [
              {
                property: 'created_at',
                direction: 'DESC'
              }
        ],
        storeId: 'postStore',
        autoLoad: true
    }
});
