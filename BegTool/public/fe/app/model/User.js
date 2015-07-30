Ext.define('SenchaTouchMVC.model.User', {
    extend: 'Ext.data.Model',
    config: {
        fields: [
            { name: 'id', type: 'integer' },
        	{ name: 'firstname', type: 'string' },
        	{ name: 'lastname',  type: 'string' },
            { name: 'email',  type: 'string' },
            { name: 'username',  type: 'string' },
        	{ name: 'created_at',  type: 'date', dateFormat: 'Y-m-d H:i:s', dateReadFormat: 'Y-m-d H:i:s', dateWriteFormat: 'Y-m-d H:i:s' },
        	{ name: 'updated_at',  type: 'date', dateFormat: 'Y-m-d H:i:s', dateReadFormat: 'Y-m-d H:i:s', dateWriteFormat: 'Y-m-d H:i:s' },
            { name: 'deleted_at',  type: 'date', dateFormat: 'Y-m-d H:i:s', dateReadFormat: 'Y-m-d H:i:s', dateWriteFormat: 'Y-m-d H:i:s' }
        ],
        proxy: {
            type: 'rest',
            url: '../rest/users',
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
