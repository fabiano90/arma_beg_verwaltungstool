Ext.define('SenchaTouchMVC.model.Post', {
    extend: 'Ext.data.Model',
    config: {
        fields: [
            { name: 'id', type: 'integer' },
        	{ name: 'user_id', type: 'string' },
        	{ name: 'title',  type: 'string' },
            { name: 'content',  type: 'string' },

        	{ name: 'created_at',  type: 'date', dateFormat: 'Y-m-d H:i:s', dateReadFormat: 'Y-m-d H:i:s', dateWriteFormat: 'Y-m-d H:i:s' },
        	{ name: 'updated_at',  type: 'date', dateFormat: 'Y-m-d H:i:s', dateReadFormat: 'Y-m-d H:i:s', dateWriteFormat: 'Y-m-d H:i:s' },
            { name: 'deleted_at',  type: 'date', dateFormat: 'Y-m-d H:i:s', dateReadFormat: 'Y-m-d H:i:s', dateWriteFormat: 'Y-m-d H:i:s' }
        ],
        proxy: {
            type: 'rest',
            url: '../rest/posts',
            reader: {
                type: 'json',
                rootProperty: 'data'
            },
            writer: {
                type: 'json',
                writeAllFields: true
            }
        }
    }

});
